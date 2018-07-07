<?php
/*

Template Name: Blog Template

 */

$stag_blog_layout = get_post_meta($post->ID, 'stag_blog_layout', true);

$stag_layout_class = '';
$stag_sidebar_class = '';

if($stag_blog_layout == 'masonry') {
	$stag_layout_class = 'blog-grid';
}

if($stag_blog_layout == 'regular-right') {
	$stag_sidebar_class = 'sidebar-right';
}
else if($stag_blog_layout == 'regular-left') {
	$stag_sidebar_class = 'sidebar-left';
}
else if($stag_blog_layout == 'regular') {
	$stag_sidebar_class = 'no-sidebar';
}

$stag_data = stag_dt_data();
$stag_thumbnailsize = 'fullwidth-thumbnail';
if(isset($stag_data['stag_blog_thumbnail_size'])) { if($stag_data['stag_blog_thumbnail_size'] !='fullwidth-thumbnail') { 
	$stag_thumbnailsize = $stag_data['stag_blog_thumbnail_size']; } } ; 

?>

<?php get_header(); ?>

<?php get_template_part( 'inc/page-title' ); ?>

	<?php
		if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>		

	<?php endwhile; ?>

	<?php endif;
	 ?>		
	
	<div class="container">

	<?php

		$stag_args = array(
			'post_type'=> 'post',
			'paged'=>$paged
		);	

		$stag_blog_query = new WP_Query($stag_args);
	?>

	<?php if ($stag_blog_layout != 'masonry') { ?>
	<div id="primary" class="content-area percent-blog <?php echo esc_attr($stag_sidebar_class) .' '. esc_attr($stag_thumbnailsize); ?>">
	<?php } ?>
		<main id="main" class="site-main <?php echo esc_attr($stag_layout_class); ?>" role="main">
			<?php if ($stag_blog_layout == 'masonry') { ?>
				<div class="grid-content">
					<div class="gutter-sizer"></div>
			<?php } ?>
				
			<?php 
			if ($stag_blog_query->have_posts()) :  while ($stag_blog_query->have_posts()) : $stag_blog_query->the_post(); 

				if ($stag_blog_layout != 'masonry') {
					get_template_part( 'template-parts/content', get_post_format() );
				} else {
					get_template_part( 'template-parts/content', 'masonry' );
				}	
				endwhile;
			endif;  
			?>	
				<div class="clear"></div>
			<?php if ($stag_blog_layout == 'masonry') { ?>	
				</div><!-- .grid-content -->
			<?php } ?> 

			<?php stag_navigation(); ?>
			
			<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
	
<?php if ($stag_blog_layout != 'masonry') { ?>		
	</div><!-- #primary -->

	<?php if ($stag_blog_layout != 'regular') { 
		get_sidebar(); 
	} 
} ?>

	<div class="space"></div>
</div><!--end container-->

<?php get_footer(); ?>
