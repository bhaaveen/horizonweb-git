jQuery(document).ready(function() {	
	// Responsive Navigation 
	'use strict';
	var nava = jQuery(".nav-btn"),
		navb = jQuery("#site-navigation"),
		wind = jQuery(window).width(),	
		winh;
		
		if(wind < 1024) {
			 winh = jQuery(window).height()
		}
		else {
			winh = jQuery(window).outerHeight() -jQuery('#header').outerHeight()
		}

	// Add classes		
    jQuery(window).resize(function () {
		var nava = jQuery(".nav-btn"),
			navb = jQuery("#site-navigation"),
			wind = jQuery(window).width(),
			winh;

		if(wind < 1024) {
			 winh = jQuery(window).height()
		}
		else {
			winh = jQuery(window).outerHeight() -jQuery('#header').outerHeight()
		}
		
		if (wind > 1023) {
			navb.addClass("is-nav-desktop");
			navb.removeClass("is-nav-mobile")
		}
		if (wind < 1024) {
			navb.addClass("is-nav-mobile");
			navb.removeClass("is-nav-desktop")
		}

		// Nav CSS adjustment for mobile
		if (wind < 1024) {
		jQuery('#site-navigation.is-nav-mobile').css({'max-height': winh-200, 'overflow-y': 'scroll', 'overflow-x': 'hidden'});
		}
		if (wind > 1023) {
			jQuery('#site-navigation.is-nav-desktop').css({'overflow': 'visible'});
		}		

    });
			
		if (wind > 1023) {
			navb.addClass("is-nav-desktop");
			navb.removeClass("is-nav-mobile")
		}
		if (wind < 1024) {
			navb.addClass("is-nav-mobile");
			navb.removeClass("is-nav-desktop");
		}	
		// Nav CSS adjustment for is-nav-mobile
		if (wind < 1024) {
		jQuery('#site-navigation.is-nav-mobile').css({'max-height': winh-200, 'overflow-y': 'scroll', 'overflow-x': 'hidden'});
		}
		if (wind > 1023) {
			jQuery('#site-navigation.is-nav-desktop').css({'overflow': 'visible'});
		}				

});