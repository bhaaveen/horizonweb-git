// Gallery Blog Slider //
function stag_gallery_slider() {		
	'use strict';	
	jQuery('.gallery-slider[id^="gs-"]').each( function() { 	
	
		var $div = jQuery(this);
		var token = $div.data('token');
		var settingObj = window['stag_gallery_' + token];
		
		jQuery('#gs-'+settingObj.stag_post_id+'').owlCarousel({
			autoHeight : true,
			items : 1,
			nav: true,
			navText: [
				  "<i class='fa fa-angle-left'></i>",
				  "<i class='fa fa-angle-right'></i>"
				  ],				
			rewind: true,
			autoplay: false,
			rtl: false,
			autoplayTimeout: 7000,		
			autoplayHoverPause: true,
			dots: true,
			smartSpeed: 900,

		});				
		
	});

}

jQuery(window).bind("load", function() {
	stag_gallery_slider();
});