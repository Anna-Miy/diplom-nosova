(function($, C) {

	C.RouteLegend = Backbone.View.extend({

    tagName: 'li',

		render: function() {

			console.debug(this.model.toJSON());

			var routeTypes = {
				'1': 'Метро',
				'2': 'Трамвай',
				'3': 'Тролейбус'
			};

			var html = _.template(
				'<span class="colorBox" style="background: <%= color %>"></span><%= name %> ('+ routeTypes[this.model.get('route_type_id')] +')',
				this.model.toJSON()
			);

			$(this.el).html(html);
			return this;
		}

	});

	C.MapStartPointView = C.MapPintView.extend({});
	C.MapStopPointView = C.MapPintView.extend({});

}(jQuery, Classes));