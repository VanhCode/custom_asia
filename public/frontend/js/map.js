$(function () {


    $(document).ready(function () {
        loadMap();
        //loadMap2(); // Thêm hàm để tải map2
    });

    function loadMap() {
        var $listItems = $('#list-address li');
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

        // Xóa polyline và marker cũ
        if (typeof polyline !== 'undefined') {
            map.removeLayer(polyline);
        }
        if (typeof movingMarker !== 'undefined') {
            map.removeLayer(movingMarker);
        }
        if (typeof startMarker !== 'undefined') {
            map.removeLayer(startMarker);
        }
        if (typeof endMarker !== 'undefined') {
            map.removeLayer(endMarker);
        }

        // Tạo polyline mới
        var points = [startPoint, ...otherPoints, endPoint];
        polyline = L.polyline(points, {
            color: 'blue'
        }).addTo(map);

        // Điều chỉnh bản đồ để vừa với polyline
        map.fitBounds(polyline.getBounds());

        // Tạo marker cho điểm bắt đầu
        startMarker = L.marker(startPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/start-image.svg',
                iconSize: [32, 32], // Kích thước biểu tượng
                iconAnchor: [16, 16] // Điểm neo biểu tượng (từ góc trái trên)
            })
        }).addTo(map);

        var bounds = L.latLngBounds(points);
        map.fitBounds(bounds, { padding: [5, 5] });

        // Tạo marker cho điểm kết thúc
        endMarker = L.marker(endPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/end-image.svg',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        }).addTo(map);

        // Tạo marker cho các điểm giữa
        otherPoints.forEach(point => {
            L.marker(point, {
                icon: L.icon({
                    iconUrl: myEnvValue + '/admin_asset/images/mid-image.svg',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8] // Giữa biểu tượng
                })
            }).addTo(map);
        });

        // Tạo marker di chuyển
        movingMarker = L.marker(startPoint, {
            icon: L.divIcon({
                className: 'custom-marker',
                html: '<div style="width: 12px; height: 12px; background-color: white; border: 2px solid blue; border-radius: 50%;"></div>',
                iconSize: [12, 12],
                iconAnchor: [6, 6]
            })
        }).addTo(map);

        // Di chuyển marker
        moveMarker(movingMarker, points, 0);
    }

    // Hàm tương tự để tải map2
    function loadMap2() {
        var $listItems = $('#list-address li');
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

        // Xóa polyline và marker cũ cho map2
        if (typeof polyline2 !== 'undefined') {
            map2.removeLayer(polyline2);
        }
        if (typeof movingMarker2 !== 'undefined') {
            map2.removeLayer(movingMarker2);
        }
        if (typeof startMarker2 !== 'undefined') {
            map2.removeLayer(startMarker2);
        }
        if (typeof endMarker2 !== 'undefined') {
            map2.removeLayer(endMarker2);
        }

        // Tạo polyline mới cho map2
        var points = [startPoint, ...otherPoints, endPoint];
        polyline2 = L.polyline(points, {
            color: 'blue'
        }).addTo(map2);

        var bounds = L.latLngBounds(points);
        map2.fitBounds(bounds, { padding: [10, 10] });

        // Tạo marker cho điểm bắt đầu trên map2
        startMarker2 = L.marker(startPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/start-image.svg',
                iconSize: [32, 32], // Kích thước biểu tượng
                iconAnchor: [16, 16] // Điểm neo biểu tượng (từ góc trái trên)
            })
        }).addTo(map2);

        // Tạo marker cho điểm kết thúc trên map2
        endMarker2 = L.marker(endPoint, {
            icon: L.icon({
                iconUrl: myEnvValue + '/admin_asset/images/end-image.svg',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        }).addTo(map2);

        // Tạo marker cho các điểm giữa trên map2
        otherPoints.forEach(point => {
            L.marker(point, {
                icon: L.icon({
                    iconUrl: myEnvValue + '/admin_asset/images/mid-image.svg',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8] // Giữa biểu tượng
                })
            }).addTo(map2);
        });

        // Tạo marker di chuyển cho map2
        movingMarker2 = L.marker(startPoint, {
            icon: L.divIcon({
                className: 'custom-marker',
                html: '<div style="width: 12px; height: 12px; background-color: white; border: 2px solid blue; border-radius: 50%;"></div>',
                iconSize: [12, 12],
                iconAnchor: [6, 6]
            })
        }).addTo(map2);

        // Di chuyển marker trên map2
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

    // Khởi tạo bản đồ
    var xxx = getCenterPoint();
    var map = L.map('map').setView(xxx, 8);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Khởi tạo map2
    //var map2 = L.map('map2').setView([21.028511, 105.804817], 6);
    //L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //    attribution: '&copy; OpenStreetMap contributors'
    //}).addTo(map2);

    var polyline;
    var movingMarker;
    var startMarker;
    var endMarker;

    // Khởi tạo các biến cho map2
    var map2;
    var polyline2;
    var movingMarker2;
    var startMarker2;
    var endMarker2;

    function getCenterPoint() {
        var $listItems = $('#list-address li');
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



    $(document).on("click", ".map-btn", function (event) {
        event.preventDefault();
        $("#pdf_popup-map").show();
        $("#pdf_popup-map-2").hide();
        if (!map2) {
            // Khởi tạo map2 nếu chưa tồn tại
            map2 = L.map('map2').setView([21.028511, 105.804817], 4);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map2);
        } else {
            // Cập nhật kích thước bản đồ nếu nó đã tồn tại
            map2.invalidateSize();
        }
        loadMap2();
    });

    $(document).on("click", ".map-btn-2", function (event) {
        event.preventDefault();
        $("#pdf_popup-map").hide();
        $("#pdf_popup-map-2").show();
        if (map2) {
            map2.remove();
            map2 = null;
        }
    });
});
