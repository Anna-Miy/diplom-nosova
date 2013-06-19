(function($, C) {

	var Application = Backbone.Router.extend({

		 initialize: function() {

			 this.routesCollection = new C.Routes();
			 
			 var map = new C.Map({collection: this.routesCollection});
			 this.controlPanel = new C.ViewRouteControls({collection: this.routesCollection, mapView: map});
		 },

		routes: {
			'show/:id': 'showRoute',
			'stop/:id': 'showStop',
			'show': 'show',
			'search': 'search',
			'stops': 'stops',
			'': 'show'
		},

		showRoute: function(id) {
			this.routesCollection.getRoute(id);
			this.controlPanel.getRouteStopsOptions(id);
		},

		showStop: function(id) {
			this.routesCollection.getStopRoutes(id);
		},

		show: function(){
			this.controlPanel.setActive('show');
		},

		search: function() {
			this.controlPanel.setActive('search');
		},

		stops: function () {
		  this.controlPanel.setActive('stops');
		}

	});



	
	$(function () {
		App = new Application;
		Backbone.history.start();
	})

}(jQuery, Classes));