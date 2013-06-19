define([
    // modules:
    'views/route/route_polyline',
    // other dependencies:
    '/js/models/route.js'
], function(RoutePolyline){

    return Backbone.View.extend({

        el: $('#routes_map'),

        initialize: function () {

            this.initMap();
            console.log('wef')

            if(this.options.editedRouteId) {
                this.route = new Classes.Route({id: this.options.editedRouteId});
                this.route.fetch();
            } else {
                this.route = new Classes.Route({points: []});
            }

            this.routeView = new RoutePolyline({
                model: this.route,
                map: this.map
            });
        },

        initMap: function () {

            this.map = new google.maps.Map(this.el[0], {
                zoom: 15,
                center: new google.maps.LatLng(49.9938, 36.231), // Kharkiv
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            this.map.overlays = [];
            this.map.startPoints = [];
        }
    });
});