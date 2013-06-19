(function($, C) {



	function USGSOverlay(point, html) {
		this.pos_ = new google.maps.LatLng(+point.lat, +point.lng);
		this.html_ = html;
	}

	USGSOverlay.prototype = new google.maps.OverlayView();


	USGSOverlay.prototype.onAdd = function() {

		// Note: an overlay's receipt of onAdd() indicates that
		// the map's panes are now available for attaching
		// the overlay to the map via the DOM.

		// Set the overlay's div_ property to this DIV
		this.$div = $('<div class="custom_overlay stop tram" style="position:absolute;">'+ this.html_ +'</div>');

		// We add an overlay to a map via one of the map's panes.
		// We'll add this overlay to the overlayImage pane.
		var panes = this.getPanes();
		panes.overlayLayer.appendChild(this.$div[0]);
	}

	USGSOverlay.prototype.draw = function() {

		// Size and position the overlay. We use a southwest and northeast
		// position of the overlay to peg it to the correct position and size.
		// We need to retrieve the projection from this overlay to do this.
		var overlayProjection = this.getProjection();

		// Retrieve the southwest and northeast coordinates of this overlay
		// in latlngs and convert them to pixels coordinates.
		// We'll use these coordinates to resize the DIV.
		var pos = overlayProjection.fromLatLngToDivPixel(this.pos_);

		// Resize the image's DIV to fit the indicated dimensions.
		this.$div.css({
			'left': pos.x - 15,
			'top': pos.y - 35,
			'width': 32,
			'height': 37
		});
	}


	USGSOverlay.prototype.onRemove = function() {
		this.$div.remove();
	}


	C.Overlay = USGSOverlay;

}(jQuery, Classes));