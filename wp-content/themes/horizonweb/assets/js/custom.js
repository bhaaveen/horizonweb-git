/**
 * custom.js
 */

function stag_wpml_widget_position() {
	'use strict';
    var stag_sitenavheight = jQuery('.is-nav-desktop #primary-menu').height();
    var stag_flagsheight = jQuery('.is-nav-desktop .flags_language_selector ul').outerHeight();
    var stag_search = jQuery('.is-nav-desktop .searchform-switch').outerHeight();
    jQuery("#site-navigation.is-nav-desktop .flags_language_selector").css({'margin-top': (stag_sitenavheight - stag_flagsheight) / 2 });      	
    jQuery("#site-navigation.is-nav-desktop .searchform-switch").css({'margin-top': (stag_sitenavheight - stag_search) / 2 });  
}

function stag_wordinstring(s, word){
  return new RegExp( '\\b' + word + '\\b', 'i').test(s);
}


jQuery(document).ready( function() {
	'use strict';

    jQuery("#typed").typed({
        stringsElement: jQuery('#typed-strings'),
        cursorChar: ".",
        typeSpeed: 100,
        startDelay: 2000,
        backSpeed: 80,
        backDelay: 2000,
        loop: true,
        loopCount: 3
    });	

    jQuery("#text-typed").typed({
        stringsElement: jQuery('#text-typed-strings'),
        cursorChar: "_",
        typeSpeed: 100,
        startDelay: 2000,
        backSpeed: 80,
        backDelay: 2000,
        loop: true,
        loopCount: 3        
    });	    
	
	// Fixed Element Height
	var stag_headerheight = jQuery('#header').outerHeight();
	
	jQuery('.menu-fixer').css({'height': stag_headerheight});	

    if(typeof stag_custom !== 'undefined') {
        if(stag_custom.stag_header_top == '1') {
            var ptop = jQuery('.page-id-'+stag_custom.stag_id+' .page-title-wrapper').css("padding-top");
            jQuery('.page-id-'+stag_custom.stag_id+' .page-title-wrapper').css({"padding-top": 'calc('+ptop+' + '+stag_headerheight+'px)'});
        }
    }

    var hswidth = jQuery('#headersocial').width();
    jQuery('.is-header-social .main-navigation.classic-menu').css({'margin-right': hswidth + 40})
    jQuery('.is-header-social .main-navigation.minimal-menu').css({'margin-right': hswidth + 110})

	var open = false;

	jQuery("ul#wrap-navigation > li").each(function(i) {
		jQuery(this).addClass("animated fadeInUp").addClass("fm-item-" + (i+1));
	});

	jQuery("ul#primary-menu > li").each(function(i) {
		jQuery(this).addClass("animated fadeInUp").addClass("fm-item-" + (i+1));
	});	
    jQuery('.bm').on('click', function() {
        jQuery(this).find("#burger-menu").toggleClass("active");
        jQuery(this).find(".burger-icon").toggleClass("active");
        if (open == false) {
            jQuery('.nav-trigger').fadeIn(300);
            jQuery('#header').addClass('is-triggered');
            jQuery('#headersocial').addClass('is-triggered');
            // if (jQuery('#site-navigation').hasClass('dark-header')) {
            // 	jQuery('#header.initial-state').css({'background': '#323232'});
            // }
            // else if (jQuery('#site-navigation').hasClass('light-header')) {
            // 	jQuery('#header.initial-state').css({'background': '#fff'});
            // }

            open = true;

            // fullscreen menu open
            jQuery('.overlay').fadeIn(200);
        } else {
            jQuery('.nav-trigger').fadeOut(300);
            jQuery('#header').removeClass('is-triggered');
            jQuery('#headersocial').removeClass('is-triggered');
            open = false;

            // fullscreen menu close
            jQuery('.overlay').fadeOut(200);

        }   
        stag_wpml_widget_position();
    });

    if(jQuery("#site-navigation").hasClass('classic-menu')) {
    	stag_wpml_widget_position();
    }


	jQuery('#header #site-navigation .switch-lang').tipsy({fade: true, gravity: 'n', className: 'wpml-switcher'});
	jQuery('#header .overlay .switch-lang').tipsy({fade: true, gravity: 's', className: 'wpml-switcher'});    

    jQuery('.wrap-nav a').on('click', function() {
        jQuery('.overlay').fadeOut(400);
        jQuery('#burger-menu, .burger-icon').removeClass('active');
        open = false;
    });	

    
	var fullscreenul = jQuery('.wrap li.menu-item-has-children');
	fullscreenul.on({
	    mouseenter: function() {
	        jQuery(this).children('ul').slideDown(700);
	    },
	    mouseleave: function() {
	        jQuery(this).children('ul').slideUp(700);
	    }
	})	    


	// // fix for menu hover on mobile
	// if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {	

	// 	jQuery('.main-navigation li.menu-item-has-children > a').click(function() {
	// 		return(false);
	// 		});
	// 	var timeout = 500;

	// 	jQuery('.main-navigation li').hover(function() {
	// 		var $parent = jQuery(this);
	// 		var $dropdown = $parent.children('ul');
				
	// 		$dropdown.show(0,function() {
					
	// 			$parent.mouseleave(function() {
	// 				var $this = jQuery(this);
	// 				setTimeout(function() {$this.children('ul').fadeOut(300);}, timeout);
	// 			});
	// 		});
	// 	});	
	// }

	// Minimum height for content, based on viewport:
	var vph = jQuery(window).height();	
	var sf = jQuery('.site-footer').outerHeight();
	var sh = jQuery('.site-header').outerHeight();
	jQuery(".site-content").css({"min-height": vph - sf -sh});

	// Magnific Popup
	var stag_ightbox = jQuery(".dt-lightbox");
	stag_ightbox.magnificPopup({

	});

	jQuery(".with-lightbox a").magnificPopup({
		type: 'image'
	});

	var stag_mfpgallery = jQuery('.dt-gallery');
	stag_mfpgallery.each(function() {
	    jQuery(this).find('.dt-lightbox-gallery').magnificPopup({
	    	type: 'image',
	        gallery: {
	          enabled:true,
	          preload: [0,1]
	        }
	    });
	});				

	var stag_del_gallery = jQuery('.dt-gallery-trigger');
	stag_del_gallery.on('click', function () {
	    jQuery(this).next().magnificPopup('open');
	});

	jQuery('.dt-single-gallery').each(function () {
	    jQuery(this).magnificPopup({
	        delegate: 'a',
	        type: 'image',
	        gallery: {
	            enabled: true,
	            navigateByImgClick: true
	        },
	        fixedContentPos: false
	    });
	});			


	// smoothscroll effect for custom links
	var stag_smoothscrollbtn = jQuery('.smooth-scroll, .smooth-scroll a');
	stag_smoothscrollbtn.on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = jQuery(this.hash);
		  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
		    jQuery('html,body').animate({
		      scrollTop: target.offset().top
		    }, 900);
		    return false;
		  }
		}
	});	

	jQuery(".searchform-switch .fa-times-circle").fadeOut();
	jQuery(".searchform-switch .fa-search").click(function() {
		jQuery(".searchform-switch .fa-search").fadeOut("slow");
		
		jQuery(".header-search-form").fadeIn("slow", function(){
			  jQuery(this).removeClass("display-none");
		});
		jQuery(".searchform-switch .fa-times-circle").fadeIn("slow");
	});
	
	jQuery(".searchform-switch .fa-times-circle").click(function() {
		jQuery(".searchform-switch .fa-times-circle").fadeOut("slow");
		jQuery(".header-search-form").fadeOut("slow", function(){
			  jQuery(this).addClass("display-none");
		});			
		jQuery(".searchform-switch .fa-search").fadeIn("slow");
	});				

	// tooltips for slider hexagons
	jQuery('.dt-hexagon').tipsy({
		gravity: 's',
		fade: true,
		delayIn: 100, 
		title: 'title',
		offset: 34
	})

	// Video in Posts
	var postvideo = jQuery(".post-video");
	postvideo.fitVids();		

	// page title height for flexbox
	var pagetitleheight = jQuery('.page-title-wrapper .container').height();
	jQuery('.page-title-wrapper .flexbase').css({'height': pagetitleheight});	 

	jQuery('.grid-content').isotope({
		masonry: {
		  columnWidth: '.grid-item',
		  gutter: '.gutter-sizer'
		},
		itemSelector: '.grid-item',
		percentPosition: true
	});	

	var $grid = jQuery('.grid').imagesLoaded( function() {
		$grid.isotope({
			masonry: {
			  columnWidth: '.grid-item',
			},
			itemSelector: '.grid-item',
			percentPosition: true
		});	
	});	

	// bind filter button click
	jQuery('#filters').on( 'click', 'li a', function() {
		var filterValue = jQuery( this ).attr('data-filter');
		// use filterFn if matches value
		$grid.isotope({ filter: filterValue });
	});
	// change selected class on buttons
	jQuery('.option-set').each( function( i, buttonGroup ) {
		var $buttonGroup = jQuery( buttonGroup );
		$buttonGroup.on( 'click', 'li a', function() {
		  $buttonGroup.find('.selected').removeClass('selected');
		  jQuery( this ).addClass('selected');
		});
	});	

	// to top btn
	var stag_offset = 500,
	$back_to_top = jQuery('.upbtn');

	jQuery(window).scroll(function(){
		( jQuery(this).scrollTop() > stag_offset ) ? $back_to_top.addClass('dt-is-visible') : $back_to_top.removeClass('dt-is-visible');
	});	
	
	$back_to_top.on('click', function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 700);
        return false;
    });			

    jQuery('.related.products li').removeClass('four three five six').addClass('three');

	//sticky support
	jQuery('.stag-is-sticky').hcSticky({
		top: 150,
  		bottomEnd: 100
	});	


});


jQuery(window).load(function(){
	// rtl 
	var row_full = jQuery('body.rtl div[data-vc-full-width="true"]');
	var row_pos = row_full.css("left");
	row_full.css({"left": "auto", "right": row_pos});

});
