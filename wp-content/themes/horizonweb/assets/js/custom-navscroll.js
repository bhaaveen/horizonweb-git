jQuery(document).ready(function() {
	'use strict';
	// Header Effect on Scroll

	var def_color = stag_styles.stag_default_color;	
	var header_logo = jQuery("#header .logo img");

	if(stag_styles.stag_pagenav_behavior_switch != 1) { 
		jQuery("#header").css({'background': stag_styles.stag_header_bg});
	}
	else { 
		jQuery('#site-navigation, .bm, #headersocial').removeClass(stag_styles.stag_scheme).addClass(stag_styles.stag_initial_navigation_style);
		jQuery("#header").css({"background": "rgba("+stag_styles.stag_initial_header_color+","+(stag_styles.stag_initial_header_color_opacity / 100)+")"});
		if(typeof(stag_styles.stag_initial_logo_image_url) != "undefined" && stag_styles.stag_initial_logo_image_url != '') { 
			header_logo.attr("src",""+stag_styles.stag_initial_logo_image_url+"");		

			if(typeof(stag_styles.stag_initial_logo_svg_retina) != "undefined" && stag_styles.stag_initial_logo_svg_retina != '') { 
				header_logo.attr("width",""+stag_styles.stag_initial_svg_retina_logo_width+"").attr("height",""+stag_styles.stag_initial_svg_retina_logo_height+"").css({"height": ""+stag_styles.stag_initial_svg_retina_logo_height+"px", "width": ""+stag_styles.stag_initial_svg_retina_logo_width+"px"});
			}
		}
	}

	if(stag_styles.stag_scrolling_effect != 0) {
		jQuery(window).scroll( function() {
			var value = jQuery(this).scrollTop();
			if ( value > 150 )	{

					jQuery("#header").removeClass("initial-state").addClass("scrolled-header").css({"padding-top": stag_styles.stag_scroll_pt+"px", "padding-bottom": stag_styles.stag_scroll_pb+"px"});
					jQuery(".no-rgba .scrolled-header").css({"background": def_color});
					jQuery(".logo img").css({"height": ""+stag_styles.stag_logo_onscroll_height+"px", "width": "auto"});
					if(stag_styles.stag_alternativelogo == 1) {
						if(stag_styles.stag_alternative_svg_logo_enabled == 0) {
							jQuery("#header.scrolled-header .logo img").attr("src",""+stag_styles.stag_alternativelogosrc+"");
						}
						else if(stag_styles.stag_alternative_svg_logo_enabled == 1) {
							jQuery("#header.scrolled-header .logo img").attr("src",""+stag_styles.stag_alternative_svg_logo_src+"").attr("width",""+stag_styles.stag_alternative_svg_logo_width+"").attr("height",""+stag_styles.stag_alternative_svg_logo_height+"").css({"height": ""+stag_styles.stag_alternative_svg_logo_height+"px", "width": ""+stag_styles.stag_alternative_svg_logo_width+"px"});
						}
						
					}

				if(stag_styles.stag_pagenav_behavior_switch != 1) { 
					jQuery(".scrolled-header").css({"background": stag_styles.stag_header_scroll_bg});
					jQuery(".scrolled-header .main-navigation ul ul").css({'background': stag_styles.stag_header_scroll_bg});
					if(stag_styles.stag_scheme != stag_styles.stag_scheme_on_scroll) {
						jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(stag_styles.stag_scheme).addClass(stag_styles.stag_scheme_on_scroll);
					}						
				}				

				else {
					// custom page background color
					jQuery(".scrolled-header").css({"background": "rgba("+stag_styles.stag_onscroll_header_color+","+(stag_styles.stag_onscroll_header_color_opacity / 100)+")"});

					// custom page menu style
					jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(stag_styles.stag_scheme).removeClass(stag_styles.stag_initial_navigation_style).addClass(stag_styles.stag_onscroll_navigation_style);

					// custom logo
					if(typeof(stag_styles.stag_onscroll_logo_image_url) != "undefined" && stag_styles.stag_onscroll_logo_image_url !== '') { 					
						header_logo.attr("src",""+stag_styles.stag_onscroll_logo_image_url+"").attr("height", ""+stag_styles.stag_logo_onscroll_height+"").css({"height": ""+stag_styles.stag_logo_onscroll_height+"px", "width": "auto"});

						if(typeof(stag_styles.stag_onscroll_logo_svg_retina) != "undefined" && stag_styles.stag_onscroll_logo_svg_retina !== '') { 
							header_logo.attr("width",""+stag_styles.stag_onscroll_svg_retina_logo_width+"").attr("height",""+stag_styles.stag_onscroll_svg_retina_logo_height+"").css({"height": ""+stag_styles.stag_onscroll_svg_retina_logo_height+"px", "width": ""+stag_styles.stag_onscroll_svg_retina_logo_width+"px"});
						}

					}
				}
			}
			else {
				jQuery("#header").removeClass("scrolled-header").addClass("initial-state");
				jQuery("#header").css({"padding-top": stag_styles.stag_init_pt+"px", "padding-bottom": stag_styles.stag_init_pb+"px"});
				jQuery(".logo img").css({"width": stag_styles.stag_logo_width, "height": stag_styles.stag_logo_height});

				if((stag_styles.stag_alternativelogo == 1) && (stag_styles.stag_logo_svg_enabled == 1)) {
					header_logo.attr("src",""+stag_styles.stag_logo_svg_url+"");
				}							
				else if((stag_styles.stag_alternativelogo == 1) && (stag_styles.stag_logo_svg_enabled == 0)) {
					header_logo.attr("src",""+stag_styles.stag_mainlogosrc+"");
				}

				if(stag_styles.stag_pagenav_behavior_switch != 1) { 
					jQuery(".initial-state").css({'background': stag_styles.stag_header_bg});	
					if(stag_styles.stag_scheme != stag_styles.stag_scheme_on_scroll) {
						jQuery('#site-navigation, .bm').removeClass(stag_styles.stag_scheme_on_scroll).addClass(stag_styles.stag_scheme);
					}	
					jQuery(".initial-state .main-navigation ul ul").css({'background': stag_styles.stag_header_bg});
					if(stag_styles.stag_scheme != stag_styles.stag_scheme_on_scroll) {
						jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(stag_styles.stag_scheme_on_scroll).addClass(stag_styles.stag_scheme); 
					}	
				}		
				else {
					// custom page background color
					jQuery(".initial-state").css({"background": "rgba("+stag_styles.stag_initial_header_color+","+(stag_styles.stag_initial_header_color_opacity / 100)+")"});


					// custom page menu style
					jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(stag_styles.stag_scheme_on_scroll).removeClass(stag_styles.stag_onscroll_navigation_style).addClass(stag_styles.stag_initial_navigation_style);

					// custom logo
					if(typeof(stag_styles.stag_initial_logo_image_url) != "undefined" && stag_styles.stag_initial_logo_image_url !== '') { 					
						header_logo.removeAttr("src").attr("src",""+stag_styles.stag_initial_logo_image_url+"").attr("height",""+stag_styles.stag_initial_logo_image_height+"").css({"height": ""+stag_styles.stag_initial_logo_image_height+"px", "width": ""+stag_styles.stag_initial_logo_image_width+"px"});;

						if(typeof(stag_styles.stag_initial_logo_svg_retina) != "undefined" && stag_styles.stag_initial_logo_svg_retina !== '') { 
							header_logo.attr("width",""+stag_styles.stag_initial_svg_retina_logo_width+"").attr("height",""+stag_styles.stag_initial_svg_retina_logo_height+"").css({"height": ""+stag_styles.stag_initial_svg_retina_logo_height+"px", "width": ""+stag_styles.stag_initial_svg_retina_logo_width+"px"});
						} else { 
							header_logo.css({"width": stag_styles.stag_initial_logo_image_width, "height": stag_styles.stag_initial_logo_image_height});
						}						
								
					}
				}				
			}
		});	
	}
});


jQuery(window).load(function() {
	var headernavheight = jQuery('.site-header .container').height();
	var socialaheight = jQuery('#headersocial li a').height();
	jQuery('.logo-container').css({'height': headernavheight});	 
	jQuery('#headersocial').css({'height': headernavheight});	 
	jQuery('#headersocial li').css({'margin-top': (headernavheight - socialaheight)/2 });		
	jQuery('.header-nav').css({'min-height': headernavheight});		
})