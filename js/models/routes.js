(function($, C) {


	C.Routes = Backbone.Collection.extend({

		model: C.Route,

		getRoute: function(id) {
			this.fetch({url: '/AjaxRoute/',  type: 'post', data: 'id=' + id});
		},


		getStopRoutes: function(id) {
			this.fetch({url: '/AjaxRoute/stopRoutes',  type: 'post', data: 'id=' + id});
		},


		searchDirection: function(startPointModel, endPointModel) {

			var data = {
				start: {
					'lat': startPointModel.get('lat'),
					'lng': startPointModel.get('lng')
				},
				end: {
					'lat': endPointModel.get('lat'),
					'lng': endPointModel.get('lng')
				}
			};

			this.fetch({url: '/AjaxRoute/search/', type: 'post', data: $.param(data)});

		}


	});


}(jQuery, Classes));