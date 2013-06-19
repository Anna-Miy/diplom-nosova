(function($, C) {

	C.StopListItem = Backbone.View.extend({

		 tagName: 'li',

		events: {
			'mouseenter': 'activate',
			'mouseleave': 'deactivate'
		},

		render: function() {

			var html = _.template('<a href="#"><%= name %></a>' +
			                      '<span class="decor l" style="background: '+ this.options.route.get('color') +'"></span>', this.model.toJSON());

			$(this.el).html(html);
			return this;
		},

		activate: function () {
		  this.model.set({'hovered': true})
		},
		
		deactivate: function () {
		  this.model.set({'hovered': false})
		}

	});

}(jQuery, Classes));