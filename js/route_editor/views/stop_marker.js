define([], function () {

    return Backbone.View.extend({

        initialize: function() {

            var model = this.model;
            var route = this.options.route;

            this.overlay = new google.maps.Marker({
                map: this.options.map,
                draggable: true,
                title: model.get('name')
            });

            google.maps.event.addListener(this.overlay, 'dragend', function() {
                model.set({
                    lat: this.getPosition().lat(),
                    lng: this.getPosition().lng()
                });
                route.trigger('stopPosChanged', model);
            });

        },

        render: function() {

            var lat = +this.model.get('lat'),
                lng = +this.model.get('lng');
            this.overlay.setPosition(new google.maps.LatLng(lat, lng));

            return this.overlay;
        }

    });

});