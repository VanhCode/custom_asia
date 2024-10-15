$(function () {
    // Hàm tương tự để tải map3
    function loadmap3() {
        var $listItems = $('#list-address-map li');
        var startPoint = [
            parseFloat($listItems.first().data('lat')),
            parseFloat($listItems.first().data('long'))
        ];
        var endPoint = [
            parseFloat($listItems.last().data('lat')),
            parseFloat($listItems.last().data('long'))
        ];

        var otherPoints = [];
        $listItems.slice(1, -1).each(function () {
            var lat = parseFloat($(this).data('lat'));
            var long = parseFloat($(this).data('long'));
            otherPoints.push([lat, long]);
        });

        // Xóa polyline và marker cũ cho map3
        if (typeof polyline2 !== 'undefined') {
            map3.removeLayer(polyline2);
        }
        if (typeof movingMarker2 !== 'undefined') {
            map3.removeLayer(movingMarker2);
        }
        if (typeof startMarker2 !== 'undefined') {
            map3.removeLayer(startMarker2);
        }
        if (typeof endMarker2 !== 'undefined') {
            map3.removeLayer(endMarker2);
        }

        // Tạo polyline mới cho map3
        var points = [startPoint, ...otherPoints, endPoint];
        polyline2 = L.polyline(points, {
            color: 'blue'
        }).addTo(map3);

        var bounds = polyline2.getBounds();

        // Fit bounds cho bản đồ với padding
        map3.fitBounds(bounds, { padding: [20, 20], maxZoom: 8 });

        // Đảm bảo kích thước bản đồ được làm mới
        map3.invalidateSize();



        // Tạo marker cho điểm bắt đầu trên map3
        startMarker2 = L.marker(startPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/start-image.svg',
                iconSize: [32, 32], // Kích thước biểu tượng
                iconAnchor: [16, 16] // Điểm neo biểu tượng (từ góc trái trên)
            })
        }).addTo(map3);

        // Tạo marker cho điểm kết thúc trên map3
        endMarker2 = L.marker(endPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/end-image.svg',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        }).addTo(map3);

        // Tạo marker cho các điểm giữa trên map3
        otherPoints.forEach(point => {
            L.marker(point, {
                icon: L.icon({
                    iconUrl: myEnvValue + '/admin_asset/images/mid-image.svg',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8] // Giữa biểu tượng
                })
            }).addTo(map3);
        });

        // Tạo marker di chuyển cho map3
        movingMarker2 = L.marker(startPoint, {
            icon: L.divIcon({
                className: 'custom-marker',
                html: '<div style="width: 12px; height: 12px; background-color: white; border: 2px solid blue; border-radius: 50%;"></div>',
                iconSize: [12, 12],
                iconAnchor: [6, 6]
            })
        }).addTo(map3);

        // Di chuyển marker trên map3
        moveMarker(movingMarker2, points, 0);
    }

    function moveMarker(marker, points, index) {
        if (index >= points.length - 1) {
            index = 0; // Quay lại điểm đầu tiên
        }
        var startPoint = points[index];
        var endPoint = points[index + 1];
        var duration = 5000; // Thời gian di chuyển (ms)
        var startTime = null;

        function animateMarker(timestamp) {
            if (!startTime) startTime = timestamp;
            var elapsed = timestamp - startTime;
            var progress = Math.min(elapsed / duration, 1);
            var lat = startPoint[0] + (endPoint[0] - startPoint[0]) * progress;
            var lng = startPoint[1] + (endPoint[1] - startPoint[1]) * progress;
            marker.setLatLng([lat, lng]);

            if (progress < 1) {
                requestAnimationFrame(animateMarker);
            } else {
                moveMarker(marker, points, index + 1);
            }
        }

        requestAnimationFrame(animateMarker);
    }

    // Khởi tạo các biến cho map3
    var map3;
    var polyline2;
    var movingMarker2;
    var startMarker2;
    var endMarker2;


    function getCenterPoint() {
        var $listItems = $('#list-address-map li');
        var startPoint = [
            parseFloat($listItems.first().data('lat')),
            parseFloat($listItems.first().data('long'))
        ];
        var endPoint = [
            parseFloat($listItems.last().data('lat')),
            parseFloat($listItems.last().data('long'))
        ];

        var otherPoints = [];
        $listItems.slice(1, -1).each(function () {
            var lat = parseFloat($(this).data('lat'));
            var long = parseFloat($(this).data('long'));
            otherPoints.push([lat, long]);
        });

        // Tạo danh sách các điểm
        var points = [startPoint, ...otherPoints, endPoint];

        // Tính toán điểm trung tâm
        var latSum = 0;
        var lngSum = 0;
        var totalPoints = points.length;

        points.forEach(point => {
            latSum += point[0];
            lngSum += point[1];
        });

        var centroid = [
            latSum / totalPoints,
            lngSum / totalPoints
        ];

        return centroid;
    }

    $(document).on('click', '.trip-map', function () {
        if (map3) {
            map3.remove();
            map3 = null;
        }
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: "/load-maps",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            success: function (response) {
                if (response.code == 200) {
                    $("#loadMap").html(response.html);

                    $("#popup-map-common").show();

                    if (!map3) {
                        var xxx3 = getCenterPoint();
                        map3 = L.map('map3').setView(xxx3, 4); // Điều chỉnh zoom ban đầu

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map3);
                    } else {
                        map3.invalidateSize(); // Đảm bảo bản đồ được làm mới
                    }

                    // Cập nhật các marker và polyline
                    loadmap3();

                    // Đảm bảo rằng bounds bao phủ tất cả các điểm cần thiết
                    if (typeof polyline2 !== 'undefined') {
                        var bounds = polyline2.getBounds();
                        map3.fitBounds(bounds, { padding: [20, 20] });
                    }
                }

            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu có
            }
        });
    });


    $(document).on("click", ".map-btn-2", function (event) {
        event.preventDefault();
        $("#popup-map-common").hide();
    });
});