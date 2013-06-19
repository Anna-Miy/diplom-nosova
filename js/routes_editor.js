(function($, C){

	'use strict';

	function RoutesEditor(wrapper_selector) {
		var self = this;

		var wrapper = {};
		var elems = {};


		self.map = {};
		self.route = {};


		self.init = function () {

			wrapper = $(wrapper_selector);
			elems = {
				'map': $('#routes_map'),
				'undoBtn': $('.undoBtn', wrapper),
				'form': $('#route-form'),
				'stopsList': $('#stopsList'),
				'routePoints': $('#routePoints')
			};

			self.map = new Map(elems.map[0]);
			self.route = new Route(self.map);

			if(elems.routePoints.val() !== '') {
				var routePath = JSON.parse(elems.routePoints.val());
				self.route.displayPoints(routePath);
			}

			self.attachMapEvents();
			self.attachEvents();

			return self;
		};


		self.attachMapEvents = function() {

			self.on(self.map, 'click', function(e){
				var selectedOption = elems.stopsList.find(':selected');
				var stopId = selectedOption.val();
				self.route.addPoint(e.latLng, stopId);
				if(+stopId)
					selectedOption.removeAttr('selected');

				elems.stopsList.trigger("liszt:updated");

			});

		};

		self.attachEvents = function () {

			elems.undoBtn.click(function (e) {
				e.preventDefault();
				self.route.undo();
			});

			elems.form.submit(function (e) {
				var serializePoints = self.route.serializePoints();
				if(!serializePoints) {
					alert('error');
					e.preventDefault();
				}

				elems.routePoints.val(serializePoints);
			});

		  return self;
		};


		self.on = function(element, eventType, callback) {
			google.maps.event.addListener(element, eventType, callback);
		};


		return self.init();
	}


	function Map(div) {

		return new google.maps.Map(div, {
			zoom: 15,
			center: new google.maps.LatLng(49.9938, 36.231), // Kharkiv
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

	}


	function Route(map) {
		var self = this;

		self.points = [];
		self.routeLine = {};


		self.init = function () {

			$(document).bind('pathChanged', function() {
				self.drawRouteLine();
			});

			return self;
		};


		self.addPoint = function (latLng, stopId) {

			var options = {
				position: latLng,
				map: map,
				previous: self.getLastPoint()
			};

			stopId = +stopId;

			if(stopId === 0) {
				self.points.push(new Point(options));
			} else {
				options.stopId = stopId;
				options.title = $('#stopsList').find('[value="'+ stopId +'"]').text();
				self.points.push(new Stop(options));
			}

		};


		self.getLastPoint = function () {
		  return self.points[self.points.length - 1];
		};


		self.getRoutePath = function () {
			var i = 1,
				points = self.points,
				points_count = points.length,
				routePath = [], path;

			for(; i < points_count; i++) {
				path = points[i].getPath();
				if (i === points_count - 1) {
					routePath = routePath.concat(path);
				} else {
					routePath = routePath.concat(self.withoutLast(path));
				}
			}

			return routePath;
		};


		self.getRoute = function () {

		  return self;
		};


		self.withoutLast = function (array) {
			var i = 0, length = array.length, newArray = [];
			for (; i < length-1; i++) {
				newArray.push(array[i]);
			}
			return newArray;
		};


		self.drawRouteLine = function () {

			self.deleteRouteLine();

			var routePath = self.getRoutePath();

			if (routePath.length === 0) {
				return;
			}

			self.routeLine = new google.maps.Polyline({
			  path: routePath,
			  strokeColor: "#4B8DF8",
			  strokeOpacity: 0.8,
			  strokeWeight: 6
			});

			self.routeLine.setMap(map);

			return self.routeLine;
		};


		self.deleteRouteLine = function () {

			if($.isEmptyObject(self.routeLine)) {
				return;
			}

			self.routeLine.setMap(null);
			self.routeLine = null;
			return self;
		};


		self.undo = function () {
			self.getLastPoint().removePoint();
			self.points.splice(self.points.length - 1, 1);
			$(document).triggerHandler('pathChanged');
		};


		self.serializePoints = function () {
			var routePath = self.getRoutePath(),
				result = [],
				i, element, pathPoint,
				length = routePath.length;

			for(i = 0; i < length; i++ ) {
				pathPoint = routePath[i];
				element = {
					lat: pathPoint.lat(),
					lng: pathPoint.lng()
				};
				if(pathPoint.stopId) {
					element.stopId = pathPoint.stopId;
				}
				result.push(element);
			}

			return JSON.stringify(result);
		};

		self.displayPoints = function (routePath) {
			var latLng, stopId, polylinePoints;
			polylinePoints = [];
			for(var i = 0; i < routePath.length; i++) {
				latLng = new google.maps.LatLng(routePath[i].lat, routePath[i].lng);
				stopId = routePath[i].stopId || 0;
				polylinePoints.push(latLng);

				if (stopId) {
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(routePath[i].lat,  routePath[i].lng),
						map: map
					});
				}


				var overlay = new C.Overlay({
					lat: routePath[i].lat,
					lng: routePath[i].lng
				},'<div class="editRoutePoint"><a href="/admin/point/update/id/'+ routePath[i].id +'">'+ routePath[i].id +'</a></div>');
				overlay.setMap(map);

			}
			var line = new google.maps.Polyline({
			  path: polylinePoints,
			  strokeColor: "#9999ff",
			  strokeOpacity: 1.0,
			  strokeWeight: 4
			});

			map.setCenter(polylinePoints[0]);
			line.setMap(map);
		};

		return self.init();
	}


	function Point(settings) {

		var options = {
//			draggable: true
		};
		$.extend(options, settings);

		var self = new google.maps.Marker(options);


		self.previous = {};
		self.path = {};

		self.init = function () {

			var there_is_previous = options.previous !== undefined;

			if(there_is_previous) {
				self.previous = options.previous;
				self.retrievePath(function (coords) {
					self.setPath(coords);
					$(document).triggerHandler('pathChanged');
				});
			}

			return self;
		};


		self.retrievePath = function (callback) {

			var directionsService = new google.maps.DirectionsService();

			var request = {
				origin: self.previous.position,
				destination: self.position,
				travelMode: google.maps.TravelMode.WALKING
			};

			directionsService.route(request, function(result, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					var coordinates = self.parseDirectionServiceResult(result);
					callback && callback(coordinates);
				}
			});
		};


		self.parseDirectionServiceResult = function (result) {

			var i = 0, j = 0, steps, step, steps_length, step_length, coordinates = [];

			steps = result.routes[0].legs[0].steps;

			var startPoint = result.routes[0].legs[0].start_location;
			if (self.previous && self.previous.stopId !== undefined) {
				startPoint.stopId = self.previous.stopId;
			}
			startPoint.pointType = 'start';
			coordinates.push(startPoint);

			if($('#alongTheRoad').is(':checked')) {
				for (steps_length = steps.length; i < steps_length; i++) {
					step = steps[i];
					for (step_length = step.lat_lngs.length; j < step_length; j++) {
						coordinates.push(step.lat_lngs[j]);
					}
				}
			}

			var endPoint = result.routes[0].legs[0].end_location;
			if (self.stopId !== undefined) {
				endPoint.stopId = self.stopId;
			}
			endPoint.pointType = 'end';
			coordinates.push(endPoint);

			return coordinates;
		};


		self.setPath = function (coordinates) {
		  self.path = coordinates;
            console.log("path = ")
            console.log(path)
		};


		self.getPath = function () {
		  return self.path;
		};

		self.removePoint = function () {
		  self.setMap(null);
//		  self = null;
		};

		return self.init();
	}


	function Stop(settings) {

		settings.icon = '/images/icons/transportation/busstop.png';

		var self = new Point(settings);

		self.stopId = settings.stopId;

		return self;
	}




	$(function() {
//		window.RoutesEdit = new RoutesEditor('#routes_editor');
	});


}(jQuery, Classes));

