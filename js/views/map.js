(function($, C) {

	google.maps.Polyline.prototype.getBounds = function() {
		var bounds = new google.maps.LatLngBounds();
		this.getPath().forEach(function(e) {
			bounds.extend(e);
		});
		return bounds;
	};


	C.Map = Backbone.View.extend({

		el: $('#map_container'),

		lines: [],
		startPoint: null,
		stopPoint: null,

		
		initialize: function () {
			var self = this;
			this.initGoogleMap();

			this.map.overlays = [];
			this.map.startPoints = [];
			this.bounds = new google.maps.LatLngBounds();
			
			_.bindAll(this, 'addOne', 'addAll');
			this.collection.bind('add',   this.addOne, this);
			this.collection.bind('reset', this.addAll, this);

/*			var is_first_time = true;
			google.maps.event.addListener(this.map, 'click', function (e) {
				is_first_time ? self.addStartPoint(e.latLng) : self.addStopPoint(e.latLng);
				is_first_time = !is_first_time;
			});*/

			
			$('.selectFromOnMap').click(function(){
				var $this = $(this);
				$this.addClass('on');
				var listenerHandle = google.maps.event.addListener(self.map, 'click', function (e) {
					self.addStartPoint(e.latLng);
					google.maps.event.removeListener(listenerHandle);
					$this.removeClass('on');
				});
			});

			$('.selectToOnMap').click(function(){
				var $this = $(this);
				$this.addClass('on');
				var listenerHandle = google.maps.event.addListener(self.map, 'click', function (e) {
					self.addStopPoint(e.latLng);
					google.maps.event.removeListener(listenerHandle);
					$this.removeClass('on');
				});
			});
			
		},

		initGoogleMap: function () {
			this.map = new google.maps.Map(this.el[0], {
				zoom: 13,
				center: new google.maps.LatLng(49.9938, 36.231), // Kharkiv
				mapTypeId: google.maps.MapTypeId.ROADMAP,

				mapTypeControl: true,
				mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DEFAULT ,
						position: google.maps.ControlPosition.TOP_RIGHT
				},
				panControl: false,
				zoomControl: true,
				zoomControlOptions: {
						style: google.maps.ZoomControlStyle.LARGE,
						position: google.maps.ControlPosition.RIGHT_TOP
				},
				scaleControl: false,
				streetViewControl: false
			});
		},


		addOne: function(model) {
			model.set({'color': this.get_random_color()});
			var routeLineView = new C.MapRouteView({model: model, map: this.map});
			var routeLine = routeLineView.render();

			var $mapLegend = $('#map_legend ul');
			var stopItemView = new C.RouteLegend({model: model});
			$mapLegend.append(stopItemView.render().el);

			this.bounds.union(routeLine.getBounds());
			
			this.map.fitBounds(this.bounds);

			this.lines.push(routeLine);
		},


        addAll: function() {
            this.clearLines();
            this.clearStopList();
            this.clearMapOverlays(this.map.overlays);
            this.collection.each(this.addOne);
        },

		
		clearLines: function() {
			for (var i in this.lines) {
				this.lines[i].setMap(null);
			}
			this.lines = [];
		},

		clearStopList: function () {
		  $('#streetsList ul').empty().css({left: 0});
			$('#map_legend ul').empty();
		},

		addStartPoint: function (latLng) {

			this.clearMapOverlays(this.map.startPoints);

			this.startPoint = new C.Point({
				'lat': latLng.lat(),
				'lng': latLng.lng()
			});
			
			var startPointView = new C.MapStartPointView({model: this.startPoint, map: this.map})
			this.map.startPoints.push(startPointView.render());
		},
		
		addStopPoint: function (latLng) {
			this.stopPoint = new C.Point({
				'lat': latLng.lat(),
				'lng': latLng.lng()
			});

			var stopPointView = new C.MapStopPointView({model: this.stopPoint, map: this.map})
			this.map.startPoints.push(stopPointView.render());

			this.search();
		},


		search: function() {

			
			this.collection.searchDirection(this.startPoint, this.stopPoint);

		},

		clearMapOverlays: function(arr) {
			_.each(arr, function(el, i) {
				el.setMap(null);
			});
		},

		 get_random_color: function () {
			 var letters = '0123456789ABCDEF'.split('');
			 var color = '#';
			 for (var i = 0; i < 6; i++ ) {
				 color += letters[Math.round(Math.random() * 15)];
			 }
			 return color;
		 }

	});



}(jQuery, Classes));