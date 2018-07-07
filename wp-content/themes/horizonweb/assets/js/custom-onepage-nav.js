function stag_onepage_nav() {
	'use strict';

	jQuery(".dt-onepage-menu-container ul li").css({ "overflow":"visible"});

	jQuery('.dt-onepage-menu-container ul li.external').each(function() {
		jQuery(this).children('a').addClass('external');
		jQuery(this).removeClass('external');
	});


	var navn = jQuery(".page-template-template-onepage #site-navigation");
	jQuery(navn).find('a').on('click', function () {
		if (navn.is(":visible") && navn.hasClass("is-nav-mobile")) {
			jQuery('#burger-menu').trigger('click');
		}
	});		


	jQuery('.dt-onepage-menu-container ul li.initial').addClass('current')

	var bool = false;
	if(stag_onepage.stag_hashtags == 1) {
		bool = true;
	}

	//Scroll Nav
	jQuery('.dt-onepage-menu-container ul').onePageNav({
		currentClass: 'current',
		filter: ':not(.external)',
		changeHash: bool,
		scrollOffset: stag_onepage.stag_offset
	});		    		
}

jQuery(window).load(function() {

	stag_onepage_nav();	

});