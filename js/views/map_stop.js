(function($, C) {

	C.MapStopView = Backbone.View.extend({

		initialize: function() {
			var self = this;

			this.model.bind('change:hovered', function(model, hovered) {
				if(hovered) {
					self.overlay.$div.css('box-shadow', '0 0 21px #fff, 0 0 20px #fff inset');
					self.overlay.$div.addClass('active');
				} else {
					self.overlay.$div.css('box-shadow', '');
					self.overlay.$div.removeClass('active');
				}
			});

		},

		render: function() {

			var overlay = new C.Overlay({
				lat: this.model.get('lat'),
				lng: this.model.get('lng'),
                draggable: true
			}, this.model.get('stop_id'));

			overlay.setMap(this.options.map);
			this.overlay = overlay;
			return overlay;
		}

	});

}(jQuery, Classes));