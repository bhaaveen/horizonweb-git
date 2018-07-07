<?php

// Stag Theme functions and definitions.

if ( file_exists( get_template_directory() . '/framework/admin/admin-init.php' ) ) {
    require_once( get_template_directory() . '/framework/admin/admin-init.php' );
}

if ( file_exists( get_template_directory() . '/framework/meta-box/meta-box-framework/meta-box.php' ) ) {
    require_once( get_template_directory() . '/framework/meta-box/meta-box-framework/meta-box.php' );
}

// Extensions
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-conditional-logic/meta-box-conditional-logic.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-tabs/meta-box-tabs.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-columns/meta-box-columns.php');
include( get_template_directory() . '/framework/meta-box/meta-box-config.php' );

require_once ( get_template_directory() . '/framework/plugins/class-tgm-plugin-activation.php');

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/navigation.php';
require get_template_directory() . '/inc/jetpack.php';

include (get_template_directory()."/inc/image-resizer.php");
include (get_template_directory()."/framework/widgets/widget-social.php");

include (get_template_directory()."/framework/extend_woocommerce.php");


class Stag_Delicious {

	function __construct() {
		add_action( 'init', array($this, 'stag_wooc_init' ));
		add_action( 'after_setup_theme', array($this, 'stag_setup' ) );
		add_action( 'after_setup_theme', array($this, 'stag_content_width'), 0 );
		add_action( 'widgets_init', array($this, 'stag_widgets_init') );
		add_action( 'init', array($this, 'stag_image_sizes') );
		add_action( 'wp_enqueue_scripts', array($this, 'stag_scripts') );
		add_action( 'wp_head', array($this, 'stag_header_custom_js') ) ;	
		add_action( 'wp_footer', array($this, 'stag_footer_custom_js') );	
		add_action( 'admin_print_footer_scripts', array($this, 'stag_add_quicktags') );	
		add_action( 'tgmpa_register',  array($this, 'stag_register_required_plugins') ); 	
		add_action( 'init', array($this, 'stag_remove_redux_notices') );	

		add_filter( 'the_content_more_link', array($this, 'stag_wrap_readmore'), 10, 1 );
		add_filter( 'excerpt_length', array($this, 'stag_custom_excerpt_length'), 999 );	
		add_filter( 'excerpt_more', array($this, 'stag_excerpt_more') );	
		add_filter( 'the_content_more_link', array($this, 'stag_remove_more_link_scroll') );	
		add_filter( 'upload_mimes', array($this, 'stag_mime_types') );	

		add_filter('loop_shop_columns', array($this, 'stag_loop_columns') );

		add_filter( 'the_password_form', array($this, 'stag_password_form' ));
	}
	


	// woocommerce theme support
	public function stag_wooc_init () {
		add_theme_support( 'woocommerce' );
	}	



	// Theme setups
	public function stag_setup() {

		load_theme_textdomain( 'stag', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'stag' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'video',
			'gallery'
		) );
	}

	// Set the content width in pixels, based on the theme's design and stylesheet.
	public function stag_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'stag_content_width', 762 );
	}

	// Register blog sidebar, footer and custom sidebar
	public function stag_widgets_init() {
		register_sidebar(array(
			'name' => esc_html__( 'Blog Sidebar', 'stag' ),
			'id' => 'sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'stag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => esc_html__( 'Footer', 'stag' ),
			'id' => 'footer',
			'description' => esc_html__( 'Widgets in this area will be shown in the footer.', 'stag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__( 'Page Sidebar', 'stag' ),
			'id' => 'page-sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown in the sidebar of any page.', 'stag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}


	// Set different thumbnail dimensions
	public function stag_image_sizes() {
		add_image_size( 'stag-blog-thumbnail', 1120, 9999, false ); 	// Blog thumbnails
		add_image_size( 'stag-blog-shortcode-thumbnail', 640, 384, true ); 	// Blog thumbnails
		add_image_size( 'stag-full-size',  9999, 9999, false ); 		// Full Size
	}

	
	// Enqueue scripts and styles.

	public function stag_scripts() {
		$stag_data = stag_dt_data();
		global $post;

		$stag_postid = '';
		if( !is_404() || !is_search() ) {
			if($post != NULL) { 
		    	$stag_postid = $post->ID;
			}
		}

		wp_enqueue_style( 'stag-style', get_stylesheet_uri() );

		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css' );	
		wp_enqueue_style( 'et-line', get_template_directory_uri() . '/assets/fonts/et-line-font/et-line.css' );	


		// preloader
		if(isset($stag_data['stag_enable_preloader'])) {
			if($stag_data['stag_enable_preloader'] != 0) {	
				wp_enqueue_script('stag-qloader', get_template_directory_uri() . '/assets/js/plugins/jquery.queryloader2.js', array('jquery'), '1.0', false );
				wp_enqueue_script('stag-custom-loader', get_template_directory_uri() . '/assets/js/custom-loader.js', array('jquery', 'stag-qloader'), '1.0', false );			
			}
		}	
		wp_enqueue_script( 'stag-plugins', get_template_directory_uri() . '/assets/js/plugins/jquery-plugins.js', array('jquery'), false, true );

		if(isset($stag_data['stag_smoothscroll_enabled']) && ($stag_data['stag_smoothscroll_enabled'] =='1')) { 
			wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/js/plugins/smoothScroll.js', array('jquery'), '1.4.0', true );		
		}
		wp_enqueue_script( 'stag-nav', get_template_directory_uri() . '/assets/js/custom-nav.js', array('jquery'), '1.0', true );			
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/plugins/jquery.isotope.js', array('jquery'), '2.2.2', true );		

		wp_enqueue_script( 'stag-navscroll', get_template_directory_uri() . '/assets/js/custom-navscroll.js', array('jquery'), '1.0', true );	
		wp_enqueue_script( 'stag-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true );	

		wp_register_script('stag-social', get_template_directory_uri() . '/assets/js/custom-social.js', array('jquery'), FALSE, true );		

		if (is_page_template('template-onepage.php')) {
			$stag_onepage_nav_offset = rwmb_meta( 'stag_onepage_nav_offset');
			$stag_onepage_nav_hashtags = rwmb_meta( 'stag_onepage_nav_hashtags');

			wp_enqueue_script('stag-onepage-custom-nav', get_template_directory_uri() . '/assets/js/custom-onepage-nav.js', array('jquery'), '1.0', true );

			wp_localize_script( 'stag-onepage-custom-nav', 'stag_onepage', array( 'stag_offset' => $stag_onepage_nav_offset, 'stag_hashtags' => $stag_onepage_nav_hashtags) );	
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if(isset($stag_data['stag_social_box'])) { 
			if($stag_data['stag_social_box'] =='1') {			
				wp_enqueue_script('stag-social');
			}
		}

			//counting footer widgets number and assigning them a width
			$stag_number = self::stag_count_sidebar_widgets( 'footer', false );
			$stag_footer_columns = '';
				if($stag_number == 2) { 
					$stag_footer_columns = '#topfooter aside { width: 48%; }'; }   	
				else if($stag_number == 3) { 
					$stag_footer_columns = '#topfooter aside { width:30.66%; }'; } 	
				
				else if ($stag_number == 4) { 
				$stag_footer_columns = '#topfooter aside { width:22%; }'; } 
				
				else if ($stag_number == 5) { 
				$stag_footer_columns = '#topfooter aside { width:16.8%; }'; } 
				
			wp_add_inline_style( 'stag-style', $stag_footer_columns );		

			//custom css	
			$stag_custom_css = '';
			if(!empty($stag_data['stag_more_css'])) {
				$stag_custom_css .= $stag_data['stag_more_css'];
			}	
			wp_add_inline_style( 'stag-style', $stag_custom_css );	

			// custom color scheme
			$stag_color_scheme = '';
			$stag_output_scheme = '';
			if((isset($stag_data['stag_custom_color_scheme'])) && ($stag_data['stag_custom_color_scheme'] != '')) {
				$stag_color_scheme = $stag_data['stag_custom_color_scheme'];

				if($stag_color_scheme != "#3e8a6c") { 

					$stag_output_scheme = '.dt-button.featured,input[type=submit].solid,input[type=reset].solid,input[type=button].solid{background:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}input[type=submit]:hover,input[type=reset]:hover,input[type=button]:hover{border-color:'.$stag_color_scheme.'; background: '.$stag_color_scheme.'}button:hover{border-color:'.$stag_color_scheme.';background-color:'.$stag_color_scheme.'}.dt-button.button-primary:focus,.dt-button.button-primary:hover,button.button-primary:focus,button.button-primary:hover,input[type=submit].button-primary:focus,input[type=submit].button-primary:hover,input[type=reset].button-primary:focus,input[type=reset].button-primary:hover,input[type=button].button-primary:focus,input[type=button].button-primary:hover{color:#fff;background-color:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}.author-bio .author-description h3 a:hover,.main-navigation a:hover,.main-navigation.dark-header a:hover,.nav-links a:hover,.pagenav a:hover,.pagenav span.current,a{color:'.$stag_color_scheme.'}#spinner:before{border-top:2px solid '.$stag_color_scheme.';border-left:2px solid '.$stag_color_scheme.'}#comments .commentwrap .metacomment a.comment-reply-link{border:1px solid}#comments .commentwrap .metacomment a.comment-reply-link:hover{color:#fff;background:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}.dt-hexagon i,.dt-hexagon span,.dt-services-grid .delicious-service .delicious-service-icon,.entry-header h1.entry-title a:hover,.entry-header h2.entry-title a:hover,.member-wrapper .member-info .member-meta span,.page-template-template-blog .grid-content .has-post-thumbnail .post-overlay:hover .cat-links a:hover,.page-template-template-blog .grid-content .has-post-thumbnail .post-overlay:hover .entry-header h2.entry-title a:hover,.portfolio .grid-item-on-hover h3 a:hover,.process-item-title .pi-title,.projnav li span:hover,.svg-title span,.testimonial-position,.thin-fill .dt-service-icon,.widget-area a:hover{color:'.$stag_color_scheme.'}.no-fill .dt-service-icon * { color:'.$stag_color_scheme.' }#comments #cancel-comment-reply-link{border:1px solid}#comments #cancel-comment-reply-link:hover{background:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}.site-footer #social li a:hover, #headersocial li a:hover,.widget-area .tagcloud a:hover{background-color:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}#dt-social-widget li a:hover{background:'.$stag_color_scheme.'}html .mc4wp-form .form-wrapper input[type=submit]:hover{background-color:'.$stag_color_scheme.'}.share-options a:hover{background:'.$stag_color_scheme.'}.dt-hexagon,.dt-hexagon:before{border-right:2px solid '.$stag_color_scheme.'}.dt-hexagon,.dt-hexagon:after{border-left:2px solid '.$stag_color_scheme.'}.dt-hexagon:before{border-top:2px solid '.$stag_color_scheme.'}.dt-hexagon:after{border-bottom:2px solid '.$stag_color_scheme.'}.dt-hexagon:hover{background-color:'.$stag_color_scheme.'}.bold-fill .dt-service-icon i,.bold-fill .dt-service-icon span,.circle-wrapper,.svg-title svg{border:1px solid}.svg-title svg path,.svg-title svg polygon,.svg-title svg rect{fill:'.$stag_color_scheme.'}.clients-carousel .owl-dot.active,.testimonials-carousel .owl-dot.active,.twitter-carousel .owl-dot.active{background:'.$stag_color_scheme.';border-color:'.$stag_color_scheme.'}.thin-fill .dt-service-icon{border:1px solid}.main-navigation ul ul li.current-menu-item a, .dt-blog-carousel h3.entry-title a:hover{color: '.$stag_color_scheme.'}.dt-blog-carousel a.excerpt-read-more span:hover{color: '.$stag_color_scheme.';border-color: '.$stag_color_scheme.'}.dt-blog-carousel .post-thumbnail .post-icon{background: '.$stag_color_scheme.';} html .member-wrapper .member-info .member-social ul li a:hover,.skillbar-bar,.work-cta:hover{background: '.$stag_color_scheme.';}::-webkit-scrollbar-thumb:hover{background: '.$stag_color_scheme.';}.pagenav span.current,.pagenav a:hover{border-color:'.$stag_color_scheme.';}.contact-footer span[class*="icon-"],.contact-footer a:hover{color: '.$stag_color_scheme.';}.text-on-thumbnail .grid-item-on-hover.style-2 .grid-text{background: '.$stag_color_scheme.' !important;}html ul.dt-tabs li:hover, html ul.dt-tabs li.current span.dt-tab-title , html ul.dt-tabs li.current span.dt-tab-count, .dt-breadcrumbs a, .dt-play-video a:hover, html .contact-footer span[class*="icon-"], aside[id^="woocommerce_"] li a:hover, html .woocommerce ul.products li.product a h3:hover, html .portfolio.portfolio-layout-mosaic li .dt-awesome-project h3 a:hover {color: '.$stag_color_scheme.';}html a.cat-trigger, html .portfolio.portfolio-layout-mosaic li .dt-awesome-project h3 a:after, html .bold-fill .dt-service-icon i, html .bold-fill .dt-service-icon span {background: '.$stag_color_scheme.';} html .thin-fill .dt-service-icon span, html .thin-fill .dt-service-icon i { border-color: '.$stag_color_scheme.'; color: '.$stag_color_scheme.'; }';
					}
			} 

			wp_add_inline_style( 'stag-style', $stag_output_scheme );	

			wp_localize_script( 'stag-custom-loader', 'stag_loader', array( 'stag_bcolor' => $stag_color_scheme) );			


			// custom background colors	
			$stag_style_css ='';

			// solid header switch
			$stag_solid_header_switch = rwmb_meta("stag_solid_header_switch");
			$stag_push_header_top = rwmb_meta("stag_push_header_top");
			if (isset($stag_solid_header_switch) && ($stag_solid_header_switch == 1)) {
				$stag_style_css .= '.menu-fixer { display: none;}';
				if (isset($stag_solid_header_switch) && ($stag_solid_header_switch == 1)) {
					wp_localize_script( 'stag-custom-js', 'stag_custom', array( 'stag_id' => $stag_postid, 'stag_header_top' => $stag_push_header_top) );	
				}
			}


			$stag_page_title_bg = rwmb_meta("stag_page_title_bg");

			if (isset($stag_page_title_bg) && ($stag_page_title_bg != "")) {
				$stag_page_title_bg_img = wp_get_attachment_image_src($stag_page_title_bg, 'stag-full-size');
				$stag_style_css .= 'html .page-id-'.$stag_postid.' .page-title-wrapper, html .postid-'.$stag_postid.' .page-title-wrapper { background: url('.$stag_page_title_bg_img[0].') fixed center center; background-size: cover; -webkit-background-size: cover; }';
			}


			// header background
			$stag_default_header_color = "#fff";

			if((isset($stag_data['stag_header_background'])) || ($stag_data['stag_header_background'] != '')) { 

				if($stag_data['stag_header_background']['alpha'] != '1' ) {
					$stag_default_header_color = $stag_data['stag_header_background']['rgba'];
				}
				else
				$stag_default_header_color = $stag_data['stag_header_background']['color'];
			}

			// header background on scroll
			$stag_header_color_on_scroll = "#fff";
			if(isset($stag_data['stag_header_background_on_scroll'])) {
				if(($stag_data['stag_header_background_on_scroll']['alpha'] != '1' ) && array_key_exists('rgba', $stag_data['stag_header_background_on_scroll'])) { 
					$stag_header_color_on_scroll = $stag_data['stag_header_background_on_scroll']['rgba'];
				}
				else
				$stag_header_color_on_scroll = $stag_data['stag_header_background_on_scroll']['color'];
			}
			else {
				$stag_header_color_on_scroll = "#fff";
			}

			if(!empty($stag_data['stag_body_background'])) {
				$stag_style_css .= 'html body {background: '.$stag_data['stag_body_background'].';}';
			}	
			if(!empty($stag_data['stag_wrapper_background'])) {
				$stag_style_css .= '#wrapper {background: '.$stag_data['stag_wrapper_background'].';}';
			}			
			
			// margin-top for logo
			if(!empty($stag_data['stag_margin_logo'])) {
				$stag_style_css .= '#header .logo img { margin-top: '.$stag_data['stag_margin_logo'].'px;}';
			}

			//background patterns 
			if((!empty($stag_data['stag_pattern'])) && ($stag_data['stag_pattern'] != 'bg12')) {
				$stag_style_css .= 'html body #page { background: url('.get_template_directory_uri().'/assets/images/bg/'.$stag_data['stag_pattern'].'.png) repeat scroll 0 0;}';
			}		
						
			wp_add_inline_style( 'stag-style', $stag_style_css );

			// disable floating header 
			$stag_no_float = '';
			if(isset($stag_data['stag_floating_header'])) {
				if($stag_data['stag_floating_header'] == 0) {
					$stag_no_float .= '#header { position: relative; } .menu-fixer { display: none !important }';
				}
			}

			wp_add_inline_style('stag-style', $stag_no_float);	

			$stag_logo_onscroll_height = '25';
			if(isset($stag_data['stag_onscroll_logo_height'])) {
				$stag_logo_onscroll_height = $stag_data['stag_onscroll_logo_height'];
			}
			
			$stag_mainlogo_src = '';
			$stag_logo_details = array('0', '85', '25');
			if(isset($stag_data['stag_custom_logo']['id']) && ($stag_data['stag_custom_logo']['id'] != '')) {
				$stag_logo_details = wp_get_attachment_image_src($stag_data['stag_custom_logo']['id'], 'stag-full-size');	
				$stag_mainlogo_src = $stag_data['stag_custom_logo']['url'];
			}

			$stag_alternative_logo_src = '';
			$stag_alternative_svg_logo_enabled = '0';
			$stag_alternative_svg_logo_src = '';
			$stag_alternative_svg_logo_width = '85';
			$stag_alternative_svg_logo_height = '25';

			if(isset($stag_data['stag_alternativelogo_enabled']) && ($stag_data['stag_alternativelogo_enabled'] == '1')) {
				if(isset($stag_data['stag_alternative_logo']['id']) && ($stag_data['stag_alternative_logo']['url'] != '')) {
					$stag_alternative_logo_src = $stag_data['stag_alternative_logo']['url'];	
				}		
				if(isset($stag_data['stag_alternativelogo_enabled']) && ($stag_data['stag_alternativelogo_enabled'] == '1')) {
					$stag_alternative_svg_logo_enabled = $stag_data['stag_alternativelogo_enabled'];
					if(isset($stag_data['stag_alternative_svg_logo']['id']) && ($stag_data['stag_alternative_svg_logo']['url'] != '')) {
					$stag_alternative_svg_logo_src = $stag_data['stag_alternative_svg_logo']['url'];	
				}	
				$stag_alternative_svg_logo_width = $stag_data['stag_alternative_svg_logo_width'];
				$stag_alternative_svg_logo_height = $stag_data['stag_alternative_svg_logo_height'];
				}

			}


			$stag_logo_width = $stag_logo_details[1];
			$stag_logo_height = $stag_logo_details[2];

			$stag_logo_svg_url = '';
			$stag_logo_svg_enabled = '0';
			$stag_svg_logo_css = '';

			if(isset($stag_data['stag_svg_enabled']) && ($stag_data['stag_svg_enabled'] == '1')) {
				$stag_logo_svg_enabled = $stag_data['stag_svg_enabled'];
				$stag_logo_svg_url = $stag_data['stag_svg_logo']['url'];
				$stag_logo_width = $stag_data['stag_svg_logo_width'];
				$stag_logo_height = $stag_data['stag_svg_logo_height'];
				$stag_svg_logo_css = '.logo img { width: '.$stag_logo_width.'px; height: '.$stag_logo_height.'px; }';
			}

			wp_add_inline_style('stag-style', $stag_svg_logo_css);				

			$stag_init_pt = 48;
			$stag_init_pb = 48;
			$stag_scroll_pt = 15;
			$stag_scroll_pb = 15;

			if(isset($stag_data['stag_initial_header_padding'])) {
				$stag_init_pt = $stag_data['stag_initial_header_padding']['padding-top'];
				$stag_init_pb = $stag_data['stag_initial_header_padding']['padding-bottom'];
			}	

			if(isset($stag_data['stag_onscroll_header_padding'])) {
				$stag_scroll_pt = $stag_data['stag_onscroll_header_padding']['padding-top'];
				$stag_scroll_pb = $stag_data['stag_onscroll_header_padding']['padding-bottom'];
			}		

			$stag_scrolling_effect = 1;	
			if(isset($stag_data['stag_scrolling_effect'])) {
				if ($stag_data['stag_scrolling_effect'] == 0) {
					$stag_scrolling_effect = 0;
				}
			}

			// theme options header scheme
			$stag_headerscheme = 'light-header';
			if(isset($stag_data['stag_header_scheme'])) { $stag_headerscheme = $stag_data['stag_header_scheme']; }	

			// theme options header scheme on scroll
			$stag_headerscheme_on_scroll = 'light-header';
			if(isset($stag_data['stag_header_scheme_on_scroll'])) { $stag_headerscheme_on_scroll = $stag_data['stag_header_scheme_on_scroll']; }	


			// page custom header options
			$stag_pagenav_behavior_switch = rwmb_meta('stag_pagenav_behavior_switch');

			// page custom navigation style
			$stag_initial_navigation_style = rwmb_meta('stag_initial_navigation_style');			
			$stag_onscroll_navigation_style = rwmb_meta('stag_onscroll_navigation_style');		

			// page custom header background color
			$stag_initial_header_color = self::stag_hex2rgb(rwmb_meta('stag_initial_header_color'));

			$stag_onscroll_header_color = self::stag_hex2rgb(rwmb_meta('stag_onscroll_header_color'));

			// page custom header background color opacity
			$stag_initial_header_color_opacity = rwmb_meta('stag_initial_header_color_opacity');
			$stag_onscroll_header_color_opacity = rwmb_meta('stag_onscroll_header_color_opacity');		

			// page custom header logo
			$stag_init_logo_img = rwmb_meta('stag_initial_logo_image', 'type=image_advanced&size=full', $stag_postid );
			$stag_onscroll_logo_img = rwmb_meta('stag_onscroll_logo_image', 'type=image_advanced&size=full', $stag_postid );


			$stag_initial_logo_image_url = '';
			$stag_initial_logo_image_width = '85';
			$stag_initial_logo_image_height = '25';

			$stag_onscroll_logo_image_url = '';
			$stag_onscroll_logo_image_width = '85';
			$stag_onscroll_logo_image_height = '25';	
					
			if( !is_404() ) {
				if( !is_search() ) {
					foreach($stag_init_logo_img as $stag_init_logo_img_fields) {
						$stag_initial_logo_image_url = $stag_init_logo_img_fields['url'];
						$stag_initial_logo_image_width = $stag_init_logo_img_fields['width'];
						$stag_initial_logo_image_height = $stag_init_logo_img_fields['height'];
					}

					foreach($stag_onscroll_logo_img as $stag_onscroll_logo_img_fields) {
						$stag_onscroll_logo_image_url = $stag_onscroll_logo_img_fields['url'];
						$stag_onscroll_logo_image_width = $stag_onscroll_logo_img_fields['width'];
						$stag_onscroll_logo_image_height = $stag_onscroll_logo_img_fields['height'];
					}
				}
			}

			// page custom header svg logo

			$stag_initial_logo_svg_retina = rwmb_meta('stag_initial_logo_svg_retina');
			$stag_onscroll_logo_svg_retina = rwmb_meta('stag_onscroll_logo_svg_retina');

			$stag_initial_svg_retina_logo_width = rwmb_meta('stag_initial_svg_retina_logo_width');
			$stag_initial_svg_retina_logo_height = rwmb_meta('stag_initial_svg_retina_logo_height');

			$stag_onscroll_svg_retina_logo_width = rwmb_meta('stag_onscroll_svg_retina_logo_width');
			$stag_onscroll_svg_retina_logo_height = rwmb_meta('stag_onscroll_svg_retina_logo_height');			

			wp_localize_script( 'stag-navscroll', "stag_styles", 
				array( 
					'stag_logo_svg_url' => $stag_logo_svg_url,
					'stag_logo_svg_enabled' => $stag_logo_svg_enabled,
					'stag_header_bg' => $stag_default_header_color, 
					'stag_header_scroll_bg' => $stag_header_color_on_scroll, 
					'stag_default_color' => $stag_default_header_color, 
					'stag_logo_width' => $stag_logo_width, 
					'stag_logo_height' => $stag_logo_height, 
					'stag_logo_onscroll_height' => $stag_logo_onscroll_height,
					'stag_init_pt' => $stag_init_pt, 
					'stag_init_pb' => $stag_init_pb, 
					'stag_scroll_pt' => $stag_scroll_pt, 
					'stag_scroll_pb' => $stag_scroll_pb, 
					'stag_scrolling_effect' => $stag_scrolling_effect, 
					'stag_mainlogosrc' => $stag_mainlogo_src , 
					'stag_alternativelogosrc' => $stag_alternative_logo_src , 
					'stag_alternativelogo' => $stag_data['stag_alternativelogo_enabled'], 
					'stag_alternative_svg_logo_src' => $stag_alternative_svg_logo_src,
					'stag_alternative_svg_logo_width' => $stag_alternative_svg_logo_width,
					'stag_alternative_svg_logo_width' => $stag_alternative_svg_logo_width,
					'stag_alternative_svg_logo_height' => $stag_alternative_svg_logo_height,
					'stag_alternative_svg_logo_enabled' => $stag_alternative_svg_logo_enabled,
					'stag_scheme' => $stag_headerscheme, 
					'stag_scheme_on_scroll' => $stag_headerscheme_on_scroll, 

					'stag_pagenav_behavior_switch' => $stag_pagenav_behavior_switch, 
					'stag_initial_navigation_style' => $stag_initial_navigation_style, 
					'stag_onscroll_navigation_style' => $stag_onscroll_navigation_style, 
					'stag_initial_header_color' => $stag_initial_header_color, 
					'stag_onscroll_header_color' => $stag_onscroll_header_color, 
					'stag_initial_header_color_opacity' => $stag_initial_header_color_opacity, 
					'stag_onscroll_header_color_opacity' => $stag_onscroll_header_color_opacity,
					'stag_initial_logo_image_url' => $stag_initial_logo_image_url,
					'stag_initial_logo_image_width' => $stag_initial_logo_image_width,
					'stag_initial_logo_image_height' => $stag_initial_logo_image_height,
					'stag_onscroll_logo_image_url' => $stag_onscroll_logo_image_url,
					'stag_onscroll_logo_image_width' => $stag_onscroll_logo_image_width,
					'stag_onscroll_logo_image_height' => $stag_onscroll_logo_image_height,

					'stag_initial_logo_svg_retina' => $stag_initial_logo_svg_retina,
					'stag_onscroll_logo_svg_retina' => $stag_onscroll_logo_svg_retina,
					'stag_initial_svg_retina_logo_width' => $stag_initial_svg_retina_logo_width,
					'stag_initial_svg_retina_logo_height' => $stag_initial_svg_retina_logo_height,
					'stag_onscroll_svg_retina_logo_width' => $stag_onscroll_svg_retina_logo_width,
					'stag_onscroll_svg_retina_logo_height' => $stag_onscroll_svg_retina_logo_height,


					'page_id' => $stag_postid

				 ) );			
			
			$stag_init_h_padding = '';
			$stag_init_h_padding = '#header { padding-top: '.$stag_init_pt.'px; padding-bottom: '.$stag_init_pb.'px;  }';
			wp_add_inline_style( 'stag-style', $stag_init_h_padding );
				

	}


	// Read More wrapping
	public function stag_wrap_readmore($stag_more_link)
	{
		return '<div class="post-read-more">'.$stag_more_link.'</div>';
	}
	

	//set excerpt length
	public function stag_custom_excerpt_length( $length ) {
		return 18;
	}

	// customize excerpt read more
	public function stag_excerpt_more( $more ) {
		return '... <a class="excerpt-read-more" href="' . esc_url(get_permalink( get_the_ID() )) . '"><span>' . esc_html__( 'Continue Reading', 'stag' ) . '</span></a>';
	}

	// prevent page scroll when clicking the more link
	public function stag_remove_more_link_scroll( $stag_link ) {
		$stag_link = preg_replace( '|#more-[0-9]+|', '', $stag_link );
		return $stag_link;
	}
		

	// header custom js
	public function stag_header_custom_js() {
		$stag_data = stag_dt_data();
		if(isset($stag_data['stag__header_custom_js']) && ($stag_data['stag__header_custom_js'] !='')) { echo '<script>'. $stag_data['stag__header_custom_js'] .'</script>'; }
	}


	// footer custom js
	public function stag_footer_custom_js() {
		$stag_data = stag_dt_data();
		if(isset($stag_data['stag__footer_custom_js']) && ($stag_data['stag__footer_custom_js'] !='')) { echo '<script>'. $stag_data['stag__footer_custom_js'] .'</script>'; }
	}


	// allow svg files to be used with the theme
	public function stag_mime_types($stag_mimes) {
	  $stag_mimes['svg'] = 'image/svg+xml';
	  return $stag_mimes;
	}
	

	public function stag_add_quicktags() {
		if (wp_script_is('quicktags')){ 
			?>
			<script type="text/javascript">
				QTags.addButton( 'section-intro', 'Stag Intro', '<p class="section-intro">', '</p>', '8', 'Stag Section Intro', 201 );
			</script>
			<?php
	 	}
	}


	public function stag_password_form() {
	    global $post;
	    $stag_label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	    $stag_output = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	    ' . esc_html__( "This content is password protected. To view it please enter your password below:", 'stag' ) . '
	    <div class="half-space"></div><input name="post_password" id="' . esc_attr($stag_label) . '" type="password" size="20" maxlength="20" /><input type="submit" class="solid" name="Submit" value="' . esc_attr__( "Submit", 'stag' ) . '" />
	    </form>
	    ';
	    return $stag_output;
	}	


	// UTILITY FUNCTIONS

	// Hex 2 RGB values
	function stag_hex2rgb($stag_hex) {
	   $stag_hex = str_replace("#", "", $stag_hex);

	   if(strlen($stag_hex) == 3) {
	      $stag_r = hexdec(substr($stag_hex,0,1).substr($stag_hex,0,1));
	      $stag_g = hexdec(substr($stag_hex,1,1).substr($stag_hex,1,1));
	      $stag_b = hexdec(substr($stag_hex,2,1).substr($stag_hex,2,1));
	   } else {
	      $stag_r = hexdec(substr($stag_hex,0,2));
	      $stag_g = hexdec(substr($stag_hex,2,2));
	      $stag_b = hexdec(substr($stag_hex,4,2));
	   }
	   $stag_rgb = array($stag_r, $stag_g, $stag_b);
	   return implode(",", $stag_rgb); // returns the rgb values separated by commas
	}	

	// count sidebar widgets
	function stag_count_sidebar_widgets( $stag_sidebar_id, $stag_echo = true ) {
		$stag_the_sidebars = wp_get_sidebars_widgets();
		if( !isset( $stag_the_sidebars[$stag_sidebar_id] ) )
			return esc_html__( 'Invalid sidebar ID', 'stag' );
		if( $stag_echo )
			echo count( $stag_the_sidebars[$stag_sidebar_id] );
		else
			return count( $stag_the_sidebars[$stag_sidebar_id] );
	}		

	// get all sidebars in an array 
	function stag_my_sidebars() {
	    global $wp_registered_sidebars;
	    $stag_all_sidebars = array();
	    if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {
	        
	        foreach ( $wp_registered_sidebars as $stag_sidebar ) {
	            $stag_all_sidebars[ $stag_sidebar['id'] ] = $stag_sidebar['name'];
	        }
	        
	    }
	    return $stag_all_sidebars;
	}	

	//get sidebar position
	static function stag_sidebar_position($stag_postid) {
		global $stag_sidebar_pos;
		$stag_sidebar_pos = get_post_meta($stag_postid, 'stag_sidebar_position', true);
		
		$stag_sidebar_class = '';
		
		if($stag_sidebar_pos == 'sidebar-right')
			$stag_sidebar_class = 'sidebar-right';
		else if($stag_sidebar_pos == 'sidebar-left')
			$stag_sidebar_class = 'sidebar-left';
		else if($stag_sidebar_pos == 'no-sidebar')
			$stag_sidebar_class = 'no-sidebar';
		echo esc_attr($stag_sidebar_class);	
	}


	// Stag Video Function
	function stag_video($stag_postid) { 
	
		$stag_external_item = get_post_meta($stag_postid, 'stag_external_video_block', true);		
		
		if(($stag_external_item != '')) {
			if( strpos($stag_external_item, 'youtube') ) {
				preg_match(
						'/[\\?\\&]v=([^\\?\\&]+)/',
						$stag_external_item,
						$stag_matches
					);
				$stag_id = $stag_matches[1];
				 
				$stag_width = '780';
				$stag_height = '440';
				echo '<div class="post-video"><iframe class="dt-youtube" width="' .esc_attr($stag_width). '" height="'.esc_attr($stag_height).'" src="//www.youtube.com/embed/'.esc_attr($stag_id).'" frameborder="0" allowfullscreen></iframe></div>';
			}
			
			if( strpos($stag_external_item, 'vimeo') ) {
				preg_match(
						'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
						$stag_external_item,
						$stag_matches
					);
				$stag_id = $stag_matches[2];	

				$stag_width = '780';
				$stag_height = '440';		
				
				echo '<div class="post-video"><iframe src="https://player.vimeo.com/video/'.esc_attr($stag_id).'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.esc_attr($stag_width).'" height="'.esc_attr($stag_height).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';	
			}			
		}

	}	

	// Stag Gallery Function
	function stag_gallery($stag_postid) {  

		$stag_token = wp_generate_password(5, false, false);
	   	wp_enqueue_script('stag-custom-gallery', get_template_directory_uri() . '/assets/js/custom-gallery.js', array('jquery'), '1.0', false );	
		wp_localize_script( 'stag-custom-gallery', 'stag_gallery_' . $stag_token, array( 'stag_post_id' => $stag_postid) );
		

		$stag_gallery_images = array();
		if(class_exists('RW_Meta_Box')) {
			$stag_gallery_images = rwmb_meta( 'stag_blog_gallery', 'type=image_advanced&size=full', $stag_postid );
		}

		if(!empty($stag_gallery_images)) {	

				echo '<div class="owl-carousel gallery-slider dt-gallery" id="gs-'.esc_attr($stag_postid).'" data-token="' . $stag_token . '">';	
					
					foreach ($stag_gallery_images as $stag_gallery_item) {
						
						$stag_resizer_url = $stag_gallery_item['url'];
						$stag_resized_image = aq_resize( $stag_resizer_url, 780, 408, true );

							echo  '<div class="slider-item">';
								echo  '<a class="not-link dt-lightbox-gallery" href="'.esc_url($stag_resizer_url).'" >';
									echo  '<img src="'.esc_url($stag_resized_image).'" alt="'.esc_attr($stag_gallery_item['caption']).'" />';
								echo  '</a>';
							echo  '</div>';
					}

				echo  '</div><!--end slides-->';
		}
	}


	public function stag_loop_columns() {
		$stag_data = stag_dt_data();
		return $stag_data["stag_woo_products_per_row"];
	}


	public function stag_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$stag_plugins = array(

			array(
					'name'                  => 'Delicious Addons - Stag Edition', 
					'version'				=> '1.4',
					'slug'                  => 'delicious-addons', 
					'source'                => get_template_directory_uri() . '/framework/plugins/delicious-addons/delicious-addons.zip', 
					'required'              => true,
				),	

			array(
					'name'                  => 'WPBakery Visual Composer', 
					'version'				=> '4.12',
					'slug'                  => 'js_composer', 
					'source'                => get_template_directory_uri() . '/framework/plugins/visual-composer/js_composer.zip', 
					'required'              => true,
				),	

			array(
					'name'                  => 'Templatera Addon for Visual Composer', 
					'version'				=> '1.1.11',
					'slug'                  => 'templatera', 
					'source'                => get_template_directory_uri() . '/framework/plugins/visual-composer/templatera.zip', 
					'required'              => false,
				),			

			array(
					'name'                  => 'Revolution Slider', 
					'version'				=> '5.2.6',
					'slug'                  => 'revslider', 
					'source'                => get_template_directory_uri() . '/framework/plugins/revolution-slider/revslider.zip', 
					'required'              => false,
				),	

			array(
					'name'                  => 'Envato WordPress Toolkit', 
					'version'				=> '1.7.3',
					'slug'                  => 'envato-wordpress-toolkit', 
					'source'                => get_template_directory_uri() . '/framework/plugins/envato-wordpress-toolkit/envato-wordpress-toolkit.zip', 
					'required'              => false,
				),				

			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'version'				=> '',
				'required' 	=> false,
			),					

		);

		$theme_text_domain = 'stag';

		$stag_tgmpa_config = array(
			'id'           => 'tgmpa',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'parent_slug'  => 'themes.php',            
			'capability'   => 'edit_theme_options',    
			'has_notices'  => true,                   
			'dismissable'  => true,                   
			'dismiss_msg'  => '',                      
			'is_automatic' => false,                   
			'message'      => '',                   
		);

		tgmpa( $stag_plugins, $stag_tgmpa_config );

	}

	// remove the theme options panel notices
	public function stag_remove_redux_notices() {
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	    }
	}

} // END CLASS

$stag_delicious = new Stag_Delicious();


// Language Switcher for WPML
if (!function_exists('stag_language_selector')) {
	function stag_language_selector() {
		if (function_exists('icl_get_languages')) {
			$stag_languages = icl_get_languages();
			
			if(!empty($stag_languages)){
				echo '<div id="header_language_list"><ul>';
					foreach($stag_languages as $stag_l){
						if($stag_l['active']) { echo '<li class="active-lang switch-lang" original-title="'.esc_attr($stag_l['native_name']).'">'; }
							else { echo '<li class="switch-lang" original-title="'.esc_attr($stag_l['native_name']).'">'; }
						if(!$stag_l['active']) echo '<a href="'.esc_url($stag_l['url']).'">';
							if($stag_l['code'] != 'zh-hant') {
								if($stag_l['code'] === 'ru') {
									echo "PY";
								}
								else
							 		echo substr($stag_l['native_name'], 0, 2); 
								} 
							else { echo $stag_l['native_name']; }
						if(!$stag_l['active']) echo '</a>';
						echo '</li>';
					}
				echo '</ul></div>';
			}
		}
	}
}


// Sets how comments are displayed
if(!function_exists('stag_comment')) { 
	function stag_comment($stag_comment, $stag_args, $stag_depth) {
		$GLOBALS['comment'] = $stag_comment; ?>
		<li class="comment" <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="commentwrap">
				<div class="avatar">
					<?php echo get_avatar($stag_comment,$size='60'); ?>
				</div><!--end avatar-->
				
				<div class="metacomment">
					<span><?php echo get_comment_author_link() ?></span>
					<?php printf(esc_html__('on %1$s at %2$s', 'stag'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(esc_html__('Edit', 'stag'),'  ','') ?> <?php comment_reply_link(array_merge( $stag_args, array('depth' => $stag_depth, 'max_depth' => $stag_args['max_depth']))) ?> 
					  
				</div><!--end metacomment-->
			
				<div class="bodycomment">
					<?php if ($stag_comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.', 'stag') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div><!--end bodycomment-->
			</div><!--end commentwrap-->
		
	<?php }

	function stag_dt_data() {
		global $stag_redux_data;
		return $stag_redux_data;
	}

	function stag_more_tag() {
		global $more;
		if(!is_single()) { $more = 0; }
	}	

}
