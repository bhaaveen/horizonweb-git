<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stag Theme
 */

?>
<?php $stag_data = stag_dt_data(); ?>

	</div><!-- #content -->

	<?php  
		$stag_fclass = '';
		if(isset($stag_data['stag_footer_layout'])) {
				$stag_fclass = $stag_data['stag_footer_layout'];
		} 
	?>	

	<footer id="colophon" class="site-footer <?php echo esc_attr($stag_fclass); ?>" role="contentinfo">

		
		<?php
		if ( is_active_sidebar( 'footer' ) ) : ?>	
		<div class="container">	
			<div id="topfooter">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div><!--end topfooter-->
			
		</div><!--end container-->
		<?php endif; ?>	


		<div class="container">
			<?php 
			if(isset($stag_data['stag_svg_footer_enabled']) && ($stag_data['stag_svg_footer_enabled'] == '1')) { 
					if(isset($stag_data['stag_svg_footer_logo']['url']) && ($stag_data['stag_svg_footer_logo']['url'] !='')) {
					?>
				<div class="footer-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-svg" src="<?php echo esc_url($stag_data['stag_svg_footer_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="<?php echo esc_attr($stag_data['stag_svg_footer_logo_width']); ?>" height="<?php echo esc_attr($stag_data['stag_svg_footer_logo_height']); ?>" /></a>
				</div>
			<?php	
			} }
			else if(isset($stag_data['stag_footer_logo']['url']) && ($stag_data['stag_footer_logo']['url'] !='')) { ?>
				<div class="footer-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img src="<?php echo esc_url($stag_data['stag_footer_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
				</div>
			<?php } ?>		

			<ul id="social" class="align-center">
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
			<div class="site-info">
				<?php if(isset($stag_data['stag_copyright_textarea']) && ($stag_data['stag_copyright_textarea'] !='')) { 
					echo wp_kses_post($stag_data['stag_copyright_textarea']);
				 		} else {  
				 	esc_html_e('Copyright - Stag | All Rights Reserved', 'stag'); 
				 } ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

	<a class="upbtn" href="#">
		<svg class="arrow-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="25 25 50 50" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M42.8,47.5c0.4,0.4,1,0.4,1.4,0l4.8-4.8v21.9c0,0.6,0.4,1,1,1s1-0.4,1-1V42.7l4.8,4.8c0.4,0.4,1,0.4,1.4,0   c0.4-0.4,0.4-1,0-1.4L50,38.9l-7.2,7.2C42.4,46.5,42.4,47.1,42.8,47.5z"/></g></svg>
	</a></div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
