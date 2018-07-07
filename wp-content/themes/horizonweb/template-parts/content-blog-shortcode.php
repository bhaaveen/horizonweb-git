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
			<div class="post-thumbnail">
				<a href="<?php esc_url(the_permalink()); ?>">
					<?php 
					the_post_thumbnail('stag-blog-shortcode-thumbnail', array('alt'   => $stag_alt)); 

					if(has_post_format('video')) {
						echo '<span class="post-icon"><i class="fa fa-play"></i></span>';
					}
					else if(has_post_format('gallery')) {
						echo '<span class="post-icon"><i class="fa fa-image"></i></span>';
					}
					else echo '<span class="post-icon"><i class="fa fa-pencil"></i></span>';
					?>										
				</a>
			</div><!--end post-thumbnail-->		
		<?php } ?>
	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
				$stag_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$stag_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
				}

				$stag_time_string = sprintf( $stag_time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);

				echo '<span class="posted-on">' . $stag_time_string . '</span>';

			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
				
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			stag_more_tag();
			the_excerpt();
			
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
</article>