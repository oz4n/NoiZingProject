var Contact = function() {
    return {
        //Map
        initMap: function() {
            var map;
            $(document).ready(function() {

                $("#google-map").gmap3({
                    marker: {
                        latLng: [-8.765186666316078, 116.27105787161736],
                        options: {
                            draggable: true
                        },
                        events: {
                            click: function(marker) {
                                $(this).gmap3({
                                    getaddress: {
                                        latLng: marker.getPosition(),
                                        callback: function(results) {
                                            var map = $(this).gmap3("get"),
                                                    infowindow = $(this).gmap3({get: "infowindow"}),
                                            content = results && results[1] ? results && results[1].formatted_address : "no address";
                                            if (infowindow) {
                                                infowindow.open(map, marker);
                                                infowindow.setContent(content);
                                            } else {
                                                $(this).gmap3({
                                                    infowindow: {
                                                        anchor: marker,
                                                        options: {content: content}
                                                    }
                                                });
                                            }
                                        }
                                    }
                                });
                            },
                            dragend: function(marker) {
                                $(this).gmap3({
                                    getaddress: {
                                        latLng: marker.getPosition(),
                                        callback: function(results) {
                                            var map = $(this).gmap3("get"),
                                                    infowindow = $(this).gmap3({get: "infowindow"}),
                                            content = results && results[1] ? results && results[1].formatted_address : "no address";
                                            if (infowindow) {
                                                infowindow.open(map, marker);
                                                infowindow.setContent(content);
                                            } else {
                                                $(this).gmap3({
                                                    infowindow: {
                                                        anchor: marker,
                                                        options: {content: content}
                                                    }
                                                });
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    },
                    map: {
                        options: {
                            mapTypeControlOptions: {
                                mapTypeIds: [
                                    google.maps.MapTypeId.ROADMAP,
                                    google.maps.MapTypeId.SATELLITE,
                                    google.maps.MapTypeId.HYBRID,
                                    google.maps.MapTypeId.TERRAIN,
                                    "offline"]
                            },
                            zoom: 12,
                        },
                    },
                    imagemaptype: {
                        id: "offline",
                        options: {
                            getTileUrl: function(coord, zoom) {
                                var z = zoom;
                                var x = coord.x;
                                var y = coord.y;
                                var dw = "http://tile.openstreetmap.org/" + z + "/" + x + "/" + y + ".png";
                                return dw;
                            },
                            tileSize: new google.maps.Size(256, 256),
                            isPng: true,
                            name: "Aps",
                            minZoom: 1,
                            maxZoom: 18
                        },
                        callback: function() {
                            $(this).gmap3("get").setMapTypeId("offline");
                        }
                    },
                });
            });
        }
    };
}();


