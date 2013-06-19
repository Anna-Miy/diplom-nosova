/**
* Route view on the google map
*/
define([
    'views/stop_marker',
    '/js/views/map_route.js',
    '/js/views/map_stop.js',
    '/js/overlay.js',
    '/js/models/stop.js'
], function (StopMarker) {

    return Classes.MapRouteView.extend({

        initialize: function () {

            var self = this;
            console.log("route_polyline")

            this.routeOverlay = new google.maps.Polyline({
                strokeColor: this.model.get('color'),
                strokeOpacity: 0.8,
                strokeWeight: 8
            });

            this.model.bind('change', this.repaintRoute, this);

            this.model.bind('stopPosChanged', this.changeStopPosition, this);

            _.bindAll(this, 'addControlPoint');
            google.maps.event.addListener(this.routeOverlay, 'click', this.addControlPoint);

            $("#cancelPolyEdit").click(function (e) {
                e.preventDefault();
                self.routeOverlay.setEditable(false);
                self.repaintRoute();
                $('.reoutePolyEditControls').hide();
            });

            $("#applyPolyEdit").click(function (e) {
                e.preventDefault();
                self.routeOverlay.setEditable(false);
                var overlayPath = self.routeOverlay.getPath();

                self.model.attributes.points = [];
                overlayPath.forEach(function (el, num) {
                    var updatedPoint = {};
                    if(el.myPoint !== undefined) {
                        _.extend(updatedPoint, el.myPoint, {
                            lat: el.lat(),
                            lng: el.lng()
                        });
                    } else {
                        // new point
                        updatedPoint = {
                            id: null,
                            lat: el.lat(),
                            lng: el.lng(),
                            name: null,
                            pos: null,
        //                    route_id: "27"
                            stop_id: null
                        }
                    }
                    self.model.attributes.points.push(updatedPoint)
                });
                self.repaintRoute();
                $('.reoutePolyEditControls').hide();
            });

            $('#routes_editor .undoBtn').click(function (e) {
                e.preventDefault();
                self.undo();
            });

            google.maps.event.addListener(this.options.map, 'click', function(e){
                var selectedOption = $('#stopsList').find(':selected');
                var stopId = selectedOption.val();
                self.addPoint(e.latLng, stopId);
                if(+stopId)
                    selectedOption.removeAttr('selected');
                $('#stopsList').trigger("liszt:updated");
            });

            $('#route-form').submit(function (e) {
                var serializePoints = JSON.stringify(self.model.toJSON().points);
                if(!serializePoints) {
                    alert('error');
                    e.preventDefault();
                }
                $('#routePoints').val(serializePoints);
            });

        },


        render: function() {

            var map = this.options.map;
            var path = _.map(this.model.toJSON().points, function (point) {
                var gPoint = new google.maps.LatLng(point.lat, point.lng);
                gPoint.myPoint = point;
                return gPoint;
            });

            this.routeOverlay.setPath(path);
            console.log(path)
            this.routeOverlay.setMap(map);
            this.renderStops();
            return this.routeOverlay;
        },


        repaintRoute: function () {
            this.clearRoute();
            this.clearStops();
            this.render();
        },


        addControlPoint: function (latLng) {
            $('.reoutePolyEditControls').show();
            this.routeOverlay.setEditable(true);
        },


        renderStops:function () {
            var self = this;
            this.clearStops();
            _.each(this.model.get('points'), function (pointObj, index) {
                if (pointObj.stop_id) {
                    self.createPoint(pointObj);
                }
            });
        },

        createPoint: function (pointObj) {
            var self = this, stop, stopView, map = this.options.map;
            // create model:
            stop = new Classes.Stop(pointObj);
            // create view:
            stopView = new StopMarker({
                model: stop,
                route: self.model,
                map: map
            });
            // render view:
            map.overlays.push(stopView.render());
        },


        changeStopPosition: function (stop) {
            var self = this,
                path = self.model.attributes.points,
                current_stop_id = stop.get('stop_id'),
                current = self.getStopById(current_stop_id),
                prev = self.getPrevStop(_.indexOf(path, current)),
                next = self.getNextStop(_.indexOf(path, current));

            current.lat = stop.get('lat');
            current.lng = stop.get('lng');

            if(prev) {
                self.updatePathPart(prev, current, function () {
                    if(next) {
                        self.updatePathPart(current, next);
                    }
                });
            } else if(next) {
                self.updatePathPart(current, next);
            }

        },


        updatePathPart: function (fromPoint, toPoint, cb) {

            console.debug(fromPoint.name + '('+ fromPoint.lat +','+ fromPoint.lng +') - ' + toPoint.name + '('+ toPoint.lat +','+ toPoint.lng +')');


            var from = new google.maps.LatLng(fromPoint.lat, fromPoint.lng),
                to = new google.maps.LatLng(toPoint.lat, toPoint.lng),
                path = this.model.attributes.points,
                self = this,
                delete_from = _.indexOf(path, fromPoint) + 1,
                delete_to = _.indexOf(path, toPoint) - 1;

            if(delete_to < delete_from) {
                return;
            }

            Array.remove(path, delete_from, delete_to);

            this.retrievePath(from, to, function (coords) {
                coords.unshift(delete_from, 0);
                Array.prototype.splice.apply(path, coords);
                self.repaintRoute();
                cb && cb();
            });
        },


        retrievePath: function (from, to, callback) {

            var self = this,
                directionsService = new google.maps.DirectionsService(),
                request = {
                    origin: from,
                    destination: to,
                    travelMode: google.maps.TravelMode.WALKING
                };
//            console.debug('request: ');
//            console.debug(from.lat() + ',' + from.lng());
//            console.debug(to.lat() + ',' + to.lng());

            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    var coordinates = self.makePoints(self.parseDirectionServiceResult(result));
                    callback && callback(coordinates);
                } else {
                    console.debug('error', google.maps.DirectionsStatus);
                }
            });
        },


        makePoints: function (latLngs) {
            return _.map(latLngs, function (el) {
                return {
                    id: null,
                    lat: el.lat(),
                    lng: el.lng(),
                    name: null,
                    pos: null,
//                    route_id: "27"
                    stop_id: null
                }
            })
        },


        parseDirectionServiceResult: function (result) {

            var i = 0, j = 0, steps, step, steps_length, step_length, coordinates = [];

            steps = result.routes[0].legs[0].steps;

            var startPoint = result.routes[0].legs[0].start_location;
            startPoint.pointType = 'start';
            coordinates.push(startPoint);

            if($('#alongTheRoad').is(':checked')) {
                for (steps_length = steps.length; i < steps_length; i++) {
                    step = steps[i];
                    coordinates.push(step.start_point);
                    for (step_length = step.lat_lngs.length; j < step_length; j++) {
                        coordinates.push(step.lat_lngs[j]);
                    }
                    coordinates.push(step.end_point);
                }
            }

            var endPoint = result.routes[0].legs[0].end_location;
            endPoint.pointType = 'end';
            coordinates.push(endPoint);

            return coordinates;
        },


        getStopById: function (id) {
            var path = this.model.attributes.points,
                i = path.length;
            while(i--) {
                if(path[i].stop_id === id ) {
                    return path[i];
                }
            }
        },


        getPrevStop: function (index) {
            var path = this.model.attributes.points;
            while(--index > -1) {
                if(path[index].stop_id) {
                    return path[index];
                }
            }
        },


        getNextStop: function (index) {
            var path = this.model.attributes.points;
            while(++index < path.length) {
                if(path[index].stop_id) {
                    return path[index];
                }
            }
        },


        clearRoute: function () {
            if(this.routeOverlay) {
                this.routeOverlay.setMap(null);
            }
        },


        clearStops: function() {
            this.clearMapOverlays(this.options.map.overlays);
        },


        clearMapOverlays: function(arr) {
            if(arr.length) {
                _.each(arr, function(el) {
                    el.setMap(null);
                });
            }
        },


        addPoint: function (latLng, stop_id) {
            var self = this,
                lastPoint = this.getLastPoint(),
                path = this.model.attributes.points;
            stop_id = +stop_id;

            if(lastPoint === undefined) {
                // first point (new Route)
                if(!stop_id) {
                    alert('Выберете остановку!');
                    return;
                }
                var pointObj = {
                    id: null,
                    lat: latLng.lat(),
                    lng: latLng.lng(),
                    name: $('#stopsList').find('[value="'+ stop_id +'"]').text(),
                    pos: null,
                    stop_id: stop_id
                };
                path.push(pointObj);
                self.createPoint(pointObj);
                self.repaintRoute();
            }
            else {
                // get path from last point to currently added
                this.retrievePath(new google.maps.LatLng(lastPoint.lat, lastPoint.lng), latLng, function(coords){
                    var last = _.last(coords);
                    if(stop_id){
                        last.name = $('#stopsList').find('[value="'+ stop_id +'"]').text();
                        last.stop_id = stop_id;
                        self.createPoint(last);
                    }
                    // update path
                    Array.prototype.push.apply(path, coords);
                    self.repaintRoute();
                });
            }
        },

        getLastPoint: function () {
            return _.last(this.model.attributes.points);
        },

        undo: function () {
            var path = this.model.attributes.points,
                prev = this.getPrevStop(path.length - 1);
            Array.remove(path, _.indexOf(path, prev)+1, path.length);
            this.repaintRoute();
        }

    });

});