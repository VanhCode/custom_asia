$(function () {

    $(document).ready(function(){
        if($('#list-address li').length > 0){
            loadMap();
        }
    })

    //save map
    $(document).on('click', '#save_map', function () {
        var url = $('#url_save').val();
        var id = $('#tour_id').val();

        var lat = $('#list-address li').map(function () {
            return $(this).data('lat');
        }).toArray();

        var long = $('#list-address li').map(function () {
            return $(this).data('long');
        }).toArray();

        var name = $('#list-address li span').map(function () {
            return $(this).html();
        }).toArray();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            dataType: "JSON",
            method: 'POST',
            data: {
                id: id,
                name:name,
                lat: lat,
                long: long
            },
            success: function (response) {
                if (response.code === 200) {
                    toastr.success("Thành công", {
                        timeOut: 5000
                    });
                }
            },
            error: function (err) {
                toastr.error("Thất bại", {
                    timeOut: 5000
                });
            },
        });
    })
    // select2
    $('#choose-destination').select2();
    var threeDot = myEnvValue + '/admin_asset/images/three-dot.svg';
    var startLocation = myEnvValue + '/admin_asset/images/start-image.svg';
    var endLocation = myEnvValue + '/admin_asset/images/end-image.svg';
    var midLocation = myEnvValue + '/admin_asset/images/mid-image.svg';
    var trash = myEnvValue + '/admin_asset/images/trash-image.svg';
    // append destination

    var data = JSON.parse($('#dataResult').val());

    function removeDiacritics(str) {
        return str.normalize('NFKD').replace(/[^\w\s]/g, '');
    }

    $("#search").autocomplete({
        source: function (request, response) {
            var term = removeDiacritics(request.term.toLowerCase());
            var results = $.map(data, function (item) {
                var itemName = removeDiacritics(item.name.toLowerCase());
                if (itemName.indexOf(term) !== -1) {
                    return {
                        name: item.name,
                        id: item.id,
                        lat: item.lat,
                        long: item.long
                    };
                }
                return null; // Trả về null nếu không khớp
            }).filter(function (item) {
                return item !== null; // Loại bỏ các giá trị null
            });

            // Hiển thị kết quả
            response(results);
        },
        select: function (event, ui) {
            console.log('Selected name:', ui.item.name);
            console.log('Latitude:', ui.item.lat);
            console.log('Longitude:', ui.item.long);

            addLocation(ui.item.lat, ui.item.long, ui.item.name);
        }
    }).data('ui-autocomplete')._renderItem = function (ul, item) {
        return $('<li>')
            .append('<span class="w-100 d-block option-location" data-lat="' + item.lat + '" data-long="' + item.long + '" data-id="' + item.id + '">' + item.name + '</span>')
            .appendTo(ul);
    };

    function addLocation(latitude, longitude, name) {

        var countLi = $('#list-address li').length;
        var html = '';

        if (countLi == 0) {
            html = `
                <li data-lat="${latitude}" data-long="${longitude}">
                    <div
                        class="info-location">
                        <div class="d-flex align-items-center">
                            <img class="mr-8 move-destination" src="${threeDot}" alt="">
                            <img class="mark-point" src="${startLocation}" alt="">
                            <span class="ml-8">${name}</span>
                        </div>
                        <div class="trash-destination">
                            <img src="${trash}" alt="">
                        </div>
                    </div>
                </li>
            `;
        } else {
            html = `
                <li data-lat="${latitude}" data-long="${longitude}">
                    <div
                        class="info-location">
                        <div class="d-flex align-items-center">
                            <img class="mr-8 move-destination" src="${threeDot}" alt="">
                            <img class="mark-point" id="end-location" src="${endLocation}" alt="">
                            <span class="ml-8">${name}</span>
                        </div>
                        <div class="trash-destination">
                            <img src="${trash}" alt="">
                        </div>
                    </div>
                </li>
            `;
        }

        $('#end-location').attr('src', midLocation);
        $('#end-location').attr('id', '');
        $('#list-address').append(html);

        // refreshSelect2();

        loadMap();
    }

    $('#list-address').sortable({
        placeholder: "ui-sortable-placeholder",
        update: function (event, ui) {
            updateListOrder();
            loadMap();
        }
    });

    $(document).on('click', '.trash-destination', function () {
        $(this).closest('li').remove();
        loadMap();
    })

    function updateListOrder() {
        var listItems = $('#list-address li');
        listItems.first().find('.mark-point').attr('src', startLocation);
        listItems.last().find('.mark-point').attr('src', endLocation);

        listItems.slice(1, -1).each(function () {
            $(this).find('.mark-point').attr('src', midLocation);
        });
    }

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
    var map = L.map('map').setView([21.028511, 105.804817], 8);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var polyline;
    var movingMarker;
    var startMarker;
    var endMarker;
});
