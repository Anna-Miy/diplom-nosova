(function($, C) {

	C.MapRouteView = Backbone.View.extend({

		render: function() {

            var map = this.options.map,

                route = this.model.toJSON(),
                path = _.map(route.points, function (point) {
                    return new google.maps.LatLng(point.lat, point.lng);
                }),

                routeLine = new google.maps.Polyline({
                    path: path,
                    strokeColor: this.model.get('color'),
                    strokeOpacity: 0.8,
                    strokeWeight: 8
                });

			routeLine.setMap(map);

//			map.fitBounds(routeLine.getBounds());

			this.renderStops();

			return routeLine;
		},


		renderStops: function() {
			var self = this;
			var map = this.options.map;
			var $streetLIst = $('#streetsList ul');

			_.each(this.model.get('points'), function(pointObj, index){
				var stop, stopView, stopItemView;
				if (pointObj.stop_id) {
					stop = new C.Stop(pointObj);

					stopView = new C.MapStopView({model: stop, map: map});
					stopItemView = new C.StopListItem({model: stop, route: self.model});
					$streetLIst.append(stopItemView.render().el);
					var marker = stopView.render();
					map.overlays.push(marker);
				}
			});

		}

	});

}(jQuery, Classes));