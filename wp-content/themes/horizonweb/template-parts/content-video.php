<?php
/**
 * Template part for displaying posts.
 *
 * @package Stag Theme
 */

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>

	<?php 
		$stag_video_class = new Stag_Delicious;
		$stag_video_class->stag_video($post->ID); 
	 ?>

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
