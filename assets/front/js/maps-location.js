function initMap() {
    var center = {
        lat: -6.5976289,
        lng: 106.7995698
    };
    var locations = [
        ['<h4 class="mb-0">RS PMI Bogo</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', -6.5986988,106.8048715],
        ['<h4 class="mb-0">Indramayu Medical Center Hospital</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', -6.6080762,106.8088326],
        ['<h4 class="mb-0">Rumah Sakit Azra Indramayu</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', -6.5794704,106.8053118],
        ['<h4 class="mb-0">Vania Hospital</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', -6.6128607,106.8055445],
        ['<h4 class="mb-0">Rumah Sakit Salah</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', 6.5916516,106.795073],
        ['<h4 class="mb-0">Indramayu City Hospital</h4><br>\
        <table class="table table-bordered info-window">\
            <tbody>\
                <tr>\
                    <td scope="col">Kamar Kelas III</td>\
                    <td scope="col">20</td>\
                    <td scope="col">Ambulan</td>\
                    <td scope="col">1</td>\
                </tr>\
                <tr>\
                    <td>ICU</td>\
                    <td>2</td>\
                    <td>Ventilator</td>\
                    <td>1</td>\
                </tr>\
            </tbody>\
            </table>', -6.5813741,106.7784203]
    ];
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: center
    });
    var infowindow = new google.maps.InfoWindow({});
    var markerIcon = {
        url: 'https://image.flaticon.com/icons/svg/119/119065.svg',
        scaledSize: new google.maps.Size(54, 54),
        origin: new google.maps.Point(0, 0), // used if icon is a part of sprite, indicates image position in sprite
        anchor: new google.maps.Point(20,40) // lets offset the marker image
    };
    var marker, count;
    for (count = 0; count < locations.length; count++) {
        marker = new google.maps.Marker({
            icon: markerIcon,
            position: new google.maps.LatLng(locations[count][1], locations[count][2]),
            map: map,
            title: locations[count][0]
        });
        google.maps.event.addListener(marker, 'click', (function (marker, count) {
            return function () {
                infowindow.setContent(locations[count][0]);
                infowindow.open(map, marker);
            }
        })(marker, count));
    }
}