<?php
/**
 * Template part for displaying posts.
 *
 * @package Stag Theme
 */

?>

<?php

	$stag_thumb_id = get_post_thumbnail_id($post->ID);
	$stag_alt = get_post_meta($stag_thumb_id, '_wp_attachment_image_alt', true);

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<?php if(is_single()) { ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail('stag-blog-thumbnail', array('alt'   => $stag_alt)); ?>
			</div><!--end post-thumbnail-->		
		<?php } else { ?>	
			<div class="post-thumbnail">
				<a href="<?php esc_url(the_permalink()); ?>">
					<?php the_post_thumbnail('stag-blog-thumbnail', array('alt'   => $stag_alt)); ?>
				</a>
			</div><!--end post-thumbnail-->		
		<?php } ?>
	<?php } ?>
	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if(!is_single()) { ?>
				<?php stag_posted_on(); ?>
			<?php } ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
				
		<?php if(!is_single()) { ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php } ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			stag_more_tag();
			the_content(esc_html__('Continue Reading', 'stag'));
		
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'stag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php stag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
