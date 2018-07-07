<?php
/**
 * The header for the theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Stag Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">

<?php wp_head(); ?>
</head>

<?php $stag_data = stag_dt_data(); ?>

<?php if(isset($stag_data['stag_main_layout'])) { $stag_mainlayout = $stag_data['stag_main_layout']; } ?>

<body <?php esc_attr(body_class()); ?>>

	<!-- preloader-->
<?php 
	if(isset($stag_data['stag_enable_preloader'])) {
		if($stag_data['stag_enable_preloader'] != 0) { ?>
	<div id="qLoverlay"></div>

	<?php }} ?>
	
<div id="page" class="hfeed site <?php echo esc_attr($stag_mainlayout); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'stag' ); ?></a>

	<?php if(isset($stag_data['stag_header_scheme'])) { $stag_headerscheme = $stag_data['stag_header_scheme']; } ?>

	<header id="header" class="site-header initial-state" role="banner">
		<div class="container">
			<div class="three columns logo-container">
				<div class="site-branding">
					<div class="logo animated fadeInUp">
					<?php 
						if(isset($stag_data['stag_svg_enabled']) && ($stag_data['stag_svg_enabled'] == '1')) { 
							if(isset($stag_data['stag_svg_logo']['url']) && ($stag_data['stag_svg_logo']['url'] !='')) {
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-svg" src="<?php echo esc_url($stag_data['stag_svg_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="<?php echo esc_attr($stag_data['stag_svg_logo_width']); ?>" height="<?php echo esc_attr($stag_data['stag_svg_logo_height']); ?>" /></a>
					<?php	} }
					else if(isset($stag_data['stag_custom_logo']['url']) && ($stag_data['stag_custom_logo']['url'] !='')) { ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-png" src="<?php echo esc_url($stag_data['stag_custom_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
					<?php } 
					
					else { ?>			
				
						<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
					<?php } ?>	

					<?php
					if(isset($stag_data['stag_site_desc_enabled']) && ($stag_data['stag_site_desc_enabled'] == '1')) {
					 $sta_description = get_bloginfo( 'description', 'display' );
						if ( $sta_description || is_customize_preview() ) {  ?>
							<span class="site-description"><?php echo esc_html($sta_description); ?></span>
						<?php } }
					?>			
					</div><!--end logo-->

				</div><!-- .site-branding -->
			</div><!-- .three.columns -->

		<?php 
			$stag_menu_type = 'classic-menu';
			$stag_redux_menu_type = 'classic-menu';
			if(isset($stag_data['stag_menu_type'])) {
				$stag_redux_menu_type = $stag_data['stag_menu_type'];
			}

			$stag_pagenav_behavior_switch = rwmb_meta('stag_pagenav_behavior_switch');
			$stag_page_menu_type = rwmb_meta('stag_page_menu_style');			

			if($stag_pagenav_behavior_switch != 1) {
				$stag_menu_type = $stag_redux_menu_type;
			} 
			else $stag_menu_type = $stag_page_menu_type;

			$stag_header_social = '';
			if(isset($stag_data['stag_header_social']) && ($stag_data['stag_header_social'] == '1')) {
				$stag_header_social = 'is-header-social';
			}

		?>
			
		<?php if($stag_menu_type !='fullscreen-menu') { ?> 			
			
			<div class="nine columns nav-trigger <?php echo esc_attr($stag_menu_type).' '.esc_attr($stag_header_social)?>">

				<div class="header-nav">

					<nav id="site-navigation" class="main-navigation <?php echo esc_attr($stag_menu_type).' '. esc_attr($stag_headerscheme); ?>" role="navigation">

					<?php if(isset($stag_data['stag_search_header']) && ($stag_data['stag_search_header'] == '1')) { ?>
						<div class="searchform-wrapper <?php echo esc_attr($stag_headerscheme); ?>">
							<div class="searchform-switch">
								<i class="fa fa-search"></i>
								<i class="fa fa-times-circle"></i>
							</div>
							
							<form class="header-search-form display-none" method="get" action="<?php echo esc_url(home_url()); ?>/">
								<input class="header-search-input" type="text" placeholder="<?php echo esc_html__("Search...", "stag"); ?>" id="s" name="s" value="<?php the_search_query(); ?>">
								<button type="submit">
									<i class="fa fa-search"></i>
								</button>
							</form>							
						</div>
					
					<?php } ?>							

					<?php if (function_exists('stag_language_selector')) { 
							if (function_exists('icl_get_languages')) {
						?>
						<div class="flags_language_selector <?php echo esc_attr($stag_headerscheme); ?>"><?php stag_language_selector(); ?></div>
					<?php }} ?>							

					<?php 
					if (is_page_template('template-onepage.php')) { 
						$stag_nav_menu = get_post_meta($post->ID, 'stag_onepage_menu_select', true); 
						wp_nav_menu( array(
							'menu' 		=> $stag_nav_menu, 
							'menu_id'	=> 'primary-menu',
							'container_class' => 'dt-onepage-menu-container',
							'menu-class' => 'dt-onepage-menu'
							)
						); 
					} else { 
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
					} 
					?>
					</nav><!-- #site-navigation -->		
				</div> <!-- .header-nav -->	
			</div><!-- .nine.columns-->
			<?php } ?>
			
			<?php if(isset($stag_data['stag_header_social']) && ($stag_data['stag_header_social'] == '1')) { ?>
				<ul id="headersocial" class="<?php echo esc_attr($stag_menu_type).' '.esc_attr($stag_headerscheme); ?>">
					<?php
						$stag_social_links = array('rss','facebook','twitter','flickr','google-plus', 'dribbble' , 'linkedin', 'pinterest', 'youtube', 'github-alt', 'vimeo-square', 'instagram', 'tumblr', 'behance', 'vk', 'xing', 'soundcloud', 'codepen', 'yelp', 'slideshare', 'houzz');
						if($stag_social_links) {
							foreach($stag_social_links as $stag_social_link) {
								if(!empty($stag_data[$stag_social_link])) { echo '<li><a href="'. esc_url($stag_data[$stag_social_link]) .'" title="'. esc_attr($stag_social_link) .'" class="'.esc_attr($stag_social_link).'"  target="_blank"><i class="fa fa-'.esc_attr($stag_social_link).'"></i></a></li>';
								}								
							}
							if(!empty($stag_data['skype'])) { echo '<li><a href="skype:'. esc_attr($stag_data['skype']) .'?call" title="'. esc_attr($stag_data['skype']) .'" class="'.esc_attr($stag_data['skype']).'"  target="_blank"><i class="fa fa-skype"></i></a></li>';
							}							
						}
					?>
				</ul>	
			<?php } ?>		

				<!-- burger menu -->
				<div class="bm <?php echo esc_attr($stag_headerscheme) . ' ' .esc_attr($stag_menu_type)?>">
					<div class="bi burger-icon">
						<div id="burger-menu">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div>	
				</div>		
		</div>

		<?php if($stag_menu_type == 'fullscreen-menu') { ?> 	
		<div class="overlay">
			<div class="wrap centered-wrapper">
					<?php 
					if (is_page_template('template-onepage.php')) { 
						$stag_nav_menu = get_post_meta($post->ID, 'stag_onepage_menu_select', true); 
						wp_nav_menu( array(
							'menu' 		=> $stag_nav_menu, 
							'menu_id'	=> 'wrap-navigation',
							'container_class' => 'dt-onepage-menu-container',
							'menu_class' => 'wrap-nav'
							)
						); 
					} else {

						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id' => 'wrap-navigation',
							'menu_class' => 'wrap-nav',
							'sort_column' => 'menu_order',
							'fallback_cb' => ''					
						));
						} 
					?>
				<div class="clear"></div>

				<?php if (function_exists('stag_language_selector')) { ?>
					<div class="flags_language_selector <?php echo esc_attr($stag_headerscheme); ?>"><?php stag_language_selector(); ?></div>
				<?php } ?>					
						
			</div>
		</div>		
		<?php } ?>
			

	</header><!-- #masthead -->


	<div id="hello"></div>

	<div class="menu-fixer"></div>

	<div id="content" class="site-content">