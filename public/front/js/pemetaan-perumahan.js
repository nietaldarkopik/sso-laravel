$(document).ready(function () {
    // Var Declare
    var kecamatanLayer,
        zoom = L.control.zoom({
        zoomInText: '<i class="fa fa-plus" aria-hidden="true"></i>',
        zoomOutText: '<i class="fa fa-minus" aria-hidden="true"></i>',
    }),
        baseMapOptions = {
        osm: L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contributors',
                maxZoom: 18,
            }
        ),
        google_satellite: L.tileLayer('http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}',
            {
                attribution: '&copy; Google Hybrid',
                maxZoom: 18,
            }
        ),
        google_street:L.tileLayer('http://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}',
            {
                attribution: '&copy; Google Street',
                maxZoom: 18,
            }
        )
    },
        overlayMapOptions = {
        'Admin Desa': L.tileLayer.wms('http://103.180.59.42:6002/geoserver/gwc/service/wms?', {
            layers: geoserverWorkspace + ':peta_sumedang',
            format: 'image/png',
            transparent: true,
            tiled: true,
            srs: 'EPSG:4326',
            style: geoserverWorkspace + ':biru_transparan'
        })
    };

    // Function Declare
    function setBaseMap(baseMap) {
        map.removeLayer(baseMapOptions['osm']);
        map.removeLayer(baseMapOptions['google_satellite']);
        map.removeLayer(baseMapOptions['google_street']);
        map.removeLayer(overlayMapOptions['Admin Desa']);
        map.addLayer(baseMapOptions[baseMap]);
        map.addLayer(overlayMapOptions['Admin Desa']);
    }

    function getMarkers() {
        var markers = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
        });

        for (var i = 0; i < locations.length; i++) {
            var id = locations[i][0];
            var lat = locations[i][1];
            var lng = locations[i][2];
            var marker = new L.marker([lat, lng], {
                icon: L.divIcon({
                        iconAnchor: [20, 51],
                        popupAnchor: [0, -51],
                        className: 'listeo-marker-icon',
                        html: '<div class="marker-container">' +
                            '<div class="marker-card">' +
                            '<div class="front face"><i class="im im-icon-Home-5"></i></div>' +
                            '<div class="back face"><i class="im im-icon-Home-5"></i></div>' +
                            '<div class="marker-arrow"></div>' +
                            '</div>' +
                            '</div>'
                    }
                )
            }).bindPopup('Loading...', {
                'maxWidth': '270',
                'className': 'leaflet-infoBox'
            });
            marker.id = id;
            marker.on('click', function (e) {
                var popup = e.target.getPopup();
                $.get(baseURL+'/perumahan/' + this.id + '/popup', function(data) {
                    popup.setContent(data);
                    popup.update();
                });
            });
            markers.addLayer(marker);
        }
        return markers;
    }

    // Init Map
    window.map = L.map('map', {
        center: [-6.848 , 107.924],
        zoom: 10,
    });
    map.removeControl(map.zoomControl);
    map.addControl(zoom);
    map.addLayer(baseMapOptions['osm']);
    map.addLayer(overlayMapOptions['Admin Desa']);
    map.addLayer(getMarkers());
    map.on('popupopen', function (e) {
        L.DomUtil.addClass(e.popup._source._icon, 'clicked');
    }).on('popupclose', function (e) {
        if (e.popup) {
            L.DomUtil.removeClass(e.popup._source._icon, 'clicked');
        }
    });

    // Event
    $('#base-map').on('change', function () {
        setBaseMap($(this).val());
    });
    $('#search').on('change', function(){
        var search = $(this).val();
        if(search == ''){
            map.removeLayer(kecamatanLayer);
            map.setView([-6.848 , 107.924], 10);
        }else{
            $.getJSON(baseURL+'/search', {
                'search': search
            }, function(data) {
                if (map.hasLayer(kecamatanLayer)) {
                    map.removeLayer(kecamatanLayer);
                }
                kecamatanLayer = L.geoJSON(data, {
                    style: {
                        color: '#fff',
                        weight: 1.6
                    }
                });
                map.addLayer(kecamatanLayer);
                map.fitBounds(kecamatanLayer.getBounds());
            });
        }
    });
});
