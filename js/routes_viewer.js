(function ($) {



	window.Route = Backbone.Model.extend({

	});


	window.RouteView = Backbone.View.extend({


		render: function() {

			console.debug(this.model.toJSON());

		}

	});


	window.Routes = Backbone.Collection.extend({
		model: Route,

		getRoutes: function(id){
			console.debug(id);
		}
	});





	window.RoutesControls = Backbone.View.extend({

		el: $('#routes_controls'),

		events: {
			'change #roures': 'showRoute'
		},

		showRoute: function(e) {
			var id = $(e.target).val();
			this.collection.getRoute(id);
		}

	});





}(jQuery));