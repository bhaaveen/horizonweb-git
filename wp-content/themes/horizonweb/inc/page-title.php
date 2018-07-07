<?php
/**
 * Page title section for this theme
 *
 * @package Stag Theme
 */
if((!is_404()) || (!is_search() ) ) { 
	$stag_tagline = get_post_meta($post->ID, 'stag_page_tagline', true);
	$stag_title = get_post_meta($post->ID, 'stag_page_title', true);
	$stag_position = get_post_meta($post->ID, 'stag_page_title_position', true);
	$stag_blog_post_title = get_post_meta($post->ID, 'stag_blog_post_tagline', true);
}
?>
<?php if($stag_title != '1') { ?>
	<div class="page-title-wrapper">
		<div class="container <?php echo esc_attr($stag_position); ?>">
		<?php
			if(is_home()) { ?>
				<div class="nine columns flexbase">
					<h1><?php esc_html_e("Blog", "stag"); ?></h1>
					<?php
					if(!empty($stag_tagline)) {
					 	echo '<h4>'. esc_html($stag_tagline) . '</h4>';
					} ?>
				</div>
		
				<div class="three columns flexbase">
					<?php get_search_form(); ?>
				</div>				
			<?php }
			else if (is_archive()) { 
				if (have_posts()) : 
					$stag_post = $posts[0];				
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<h4>', '</h4>' ); 
				endif; 					
			}
			else if (is_page_template('template-blog.php')) { ?>	
				<div class="nine columns flexbase">
					<?php echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
					if(!empty($stag_tagline)) {
					 	echo '<h4>'. esc_html($stag_tagline) . '</h4>';
					} ?>
				</div>
		
				<div class="three columns flexbase">
					<?php get_search_form(); ?>
				</div>
			<?php }
			else if (is_page()) {
				 echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
				if(!empty($stag_tagline)) {
				 	echo '<h4>'. esc_html($stag_tagline) . '</h4>';
				}
			} 	
			else if ('portfolio' == get_post_type()) {
				 echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
				if(!empty($stag_tagline)) {
				 	echo '<h4>'. esc_html($stag_tagline) . '</h4>';
				}				
			}					
			else if (is_single()) {
				echo '<h1>'. wp_kses_post(get_the_title()) . '</h1>'; 
				if(isset($stag_blog_post_title)) {
					if($stag_blog_post_title != '') {
						echo '<h3 class="stag-post-title">'.wp_kses_post($stag_blog_post_title).'</h3>';
					}
				}
				echo '<header class="entry-header"><div class="entry-meta">';
				stag_posted_on();
				echo '</div></header>';
			}
			?>

		</div>
	</div>	

<?php get_template_part( 'inc/page-title-breadcrumbs' ); ?>

	<div class="space under-title"></div>

<?php } ?> 