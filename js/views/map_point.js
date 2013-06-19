(function($, C) {

	C.MapPintView = Backbone.View.extend({

		render: function() {

			var overlay = new google.maps.Marker({
				position: new google.maps.LatLng(this.model.get('lat'), this.model.get('lng')),
				map: this.options.map
			});

			return overlay;
		}

	});

	C.MapStartPointView = C.MapPintView.extend({});
	C.MapStopPointView = C.MapPintView.extend({});

}(jQuery, Classes));