/* Map admin scripts */
var sbvcgmap;
(function($) {
	
	sbvcgmap = {
		init: function() {
			
		},
		autocomplete: function(selector) {
			if($(selector).length) {
				$(selector).each(function() {
					var autocomplete_address = ($(this)[0]);
					var autocomplete = new google.maps.places.Autocomplete(autocomplete_address);
				});
			}
		}
	}
	
	$(document).ready(function() {
		sbvcgmap.init();
	});
	
})(jQuery);