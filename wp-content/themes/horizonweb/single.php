<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Stag Theme
 */

get_header(); ?>

<?php $stag_data = stag_dt_data(); ?>

<?php get_template_part( 'inc/page-title' ); ?>

<?php 
	$stag_ns = '';
	$stag_sidebar_pos = 'sidebar-right';
	if(isset($stag_data['stag_blog_sidebar_pos'])) {
		if($stag_data['stag_blog_sidebar_pos'] == 'no-blog-sidebar') {
			$stag_ns = 'nu-sidebar'; 
		}
		if($stag_data['stag_blog_sidebar_pos'] !='') {
			$stag_sidebar_pos = $stag_data['stag_blog_sidebar_pos'];
		}

	} 
?>

<div class="container">

	<div id="primary" class="content-area percent-blog <?php echo esc_attr($stag_sidebar_pos); ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php if(isset($stag_data['stag_social_box'])) { if($stag_data['stag_social_box'] =='1') { ?>						
				<div class="share-options align-center">
					<h6><?php esc_html_e("Share this Article", "stag"); ?></h6>
					<a href="" class="twitter-sharer" onClick="twitterSharer()"><i class="fa fa-twitter"></i></a>
					<a href="" class="facebook-sharer" onClick="facebookSharer()"><i class="fa fa-facebook"></i></a>
					<a href="" class="pinterest-sharer" onClick="pinterestSharer()"><i class="fa fa-pinterest"></i></a>
					<a href="" class="google-sharer" onClick="googleSharer()"><i class="fa fa-google-plus"></i></a>
					<a href="" class="linkedin-sharer" onClick="linkedinSharer()"><i class="fa fa-linkedin"></i></a>
				</div>
				
			<?php  } } ?>		


			<?php if(isset($stag_data['stag_prev_next_posts'])) { if($stag_data['stag_prev_next_posts'] =='1') { 
			 	the_post_navigation(
				array(
					'prev_text' => '<span>'. esc_html__('Previous Article', 'stag').'</span>%title',
					'next_text' => '<span>'. esc_html__('Next Article', 'stag').'</span>%title'
				));

			 } } ?>
			
			<?php if(isset($stag_data['stag_author_box'])) { if($stag_data['stag_author_box'] =='1') { 
				stag_author(); 
			} } ?>	

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
		echo '<div id="secondary" class="widget-area percent-sidebar '.esc_attr($stag_ns).'"" role="complementary">';
			if(isset($stag_data['stag_blog_sidebar'])) {
				if($stag_data['stag_blog_sidebar'] !='') { 
					$stag_sideb = $stag_data['stag_blog_sidebar']; 
					dynamic_sidebar($stag_sideb); 
				}
			}
		echo '</div>';
	?>


</div>
<div class="space"></div>
<?php get_footer(); ?>
