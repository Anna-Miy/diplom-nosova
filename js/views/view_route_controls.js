(function($, C) {


	C.ViewRouteControls = Backbone.View.extend({

//		el: $('header.main'),
		el: $('div#form-block'),

		initialize: function(){
			var self = this;
			this.streets_panen_is_hidden = true;

			this.$('.typeSelect a').click(function (e) {
				e.preventDefault();
				var $this = $(this);
				var route_type_id = $this.data('type-id');
				var name = $this.find('.label').text();

				if(route_type_id) {
					$this.closest('.dropdown').find('.button .label').text(name);
					var params = {
						routeTypes: route_type_id
					}
					$.post('/AjaxRoute/routesOfType/', params, function (resp) {
						$('.routeOptions').closest('.dropdown').find('.button .label').text('Маршрут')
						self.$('.routeOptions').html(resp)
					});
				}
			});

			this.$('.routeOptions a').live('click', function (e) {
				var $this = $(this);
				var name = $this.find('.label').text();
				$this.closest('.dropdown').find('.button .label').text(name);
			});

			$('.showStopsCheckbox').change(function () {
				var stops = $('.custom_overlay.stop');
				
				if($(this).is(':checked')) {
				  stops.show();
			  } else {
				  stops.hide();
			  }
			});

			$('.scrollLeft').click(function () {
                console.log("animate");
			  $('#streetsList ul').animate({left: '+=558px'}, 500);
			});

			$('.scrollRight').click(function () {
                console.log("animate");
			  $('#streetsList ul').animate({left: '-=558px'}, 500);
			});
			
			$('#dirFrom').blur(function () {
			  var from = $(this).val();
				self.getCoordsFromAddress(from, function (res) {
					var mapView = self.options.mapView;
					mapView.map.setCenter(res);
					mapView.addStartPoint(res);
				});
			});

			$('#dirTo').blur(function () {
			  var to = $(this).val();
				self.getCoordsFromAddress(to, function (res) {
					var mapView = self.options.mapView;
					mapView.map.setCenter(res);
					mapView.addStopPoint(res);
				});
			});

		},

		events: {
			'change #routes': 'showRoute',
			'click .toggleStreets': 'hideShowPanel'
		},


		showRoute: function(e) {
			var id = $(e.target).val();
			this.collection.getRoute(id);
		},

		setActive: function (hash) {
            $('#controlsNavigation a').removeClass('active');
            $('#controlsNavigation a[href="#'+ hash +'"]').addClass('active');
            // hide all tabs
            $('#routes_controls .tab').hide();
            //show current
            $('#routes_controls .tab.' + hash).show();
		},

		hideShowPanel: function() {
			if(this.streets_panen_is_hidden) {
				$('#streetsList').slideDown(100);
				this.streets_panen_is_hidden = false;
			} else {
				$('#streetsList').slideUp(100);
				this.streets_panen_is_hidden = true;
			}
		},

		getRouteStopsOptions: function (route_id) {
			var params = {
				route_id: route_id
			};
			$.post('/AjaxRoute/stopsOfRoute/', params, function (resp) {
				$('.stopOptions').closest('.dropdown').find('.button .label').text('Остановка')
				self.$('.stopOptions').html(resp)
			});
		},


		getCoordsFromAddress: function (address, cb) {

			var Geocoder = new google.maps.Geocoder();
			var SW = new google.maps.LatLng(49.872, 36.087);
			var NE = new google.maps.LatLng(50.116, 36.441);
			var Bounds = new google.maps.LatLngBounds(SW,NE);


			var requestData = {
				address : address,
				region : 'UA',
				bounds: Bounds
			};

			Geocoder.geocode(requestData, function(GeocoderResult, GeocoderStatus){

				if(GeocoderStatus == 'OK'){
					for(var j=0,ln=GeocoderResult.length; j<ln; j++){
						var location = GeocoderResult[j].geometry.location;
						if(Bounds.contains(location)) {
							cb && cb(location);
							return;
						}
					}
				}

				alert('Адрес не найден');

			});

		}


	});


}(jQuery, Classes));