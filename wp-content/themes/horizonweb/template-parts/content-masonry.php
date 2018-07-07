<?php
/**
 * Template part for displaying posts on the masonry blog page template.
 *
 * @package Stag Theme
 */

?>

<?php

	$stag_thumb_id = get_post_thumbnail_id($post->ID);
	$stag_alt = get_post_meta($stag_thumb_id, '_wp_attachment_image_alt', true);
	$stag_image_url = wp_get_attachment_url($stag_thumb_id);

	$stag_array_classes = array('grid-item');

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class($stag_array_classes)); ?> style="background: url(<?php echo esc_url($stag_image_url) ?>); background-size: cover;">
	<div class="post-overlay">

			<header class="entry-header">

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php stag_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
						
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_excerpt();
				?>
	</div><!-- .post-overlay -->
</article><!-- #post-## -->
