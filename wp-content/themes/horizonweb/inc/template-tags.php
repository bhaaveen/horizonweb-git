<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Stag Theme
 */


if ( ! function_exists( 'stag_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function stag_posted_on() {
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

	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$stag_categories_list = get_the_category_list( esc_html__( ', ', 'stag' ) );
		if ( $stag_categories_list && stag_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'stag' ) . '</span>', $stag_categories_list ); // WPCS: XSS OK.
		}
	}	


	if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'stag' ), esc_html__( '1 Comment', 'stag' ), esc_html__( '% Comments', 'stag' ) );
		echo '</span>';
	}	

}
endif;

if ( ! function_exists( 'stag_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function stag_entry_footer() {
	$stag_data = stag_dt_data();
	if(is_single()) { 
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			if(isset($stag_data['stag_tags_list'])) { if($stag_data['stag_tags_list'] =='1') {
			/* translators: used between list items, there is a space after the comma */
			$stag_tags_list = get_the_tag_list();
			if ( $stag_tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'stag' ) . '</span>', $stag_tags_list ); // WPCS: XSS OK.
			}
			}}
		}

		edit_post_link( esc_html__( 'Edit', 'stag' ), '<span class="edit-link">', '</span>' );
	}
}
endif;

if(! function_exists('stag_author')) {
	function stag_author() {
		if ( 'post' === get_post_type() ) {
				echo '<div class="author-bio">';
					echo get_avatar( get_the_author_meta('user_email'), '70', '' );
					echo '<div class="author-description">';
						echo '<span>'.esc_html__('Author', 'stag').'</span>';
						echo '<h3>'. get_the_author_link().'</h3>';
						echo '<p>'.get_the_author_meta('description').'</p>';
					echo '</div>';
				echo '</div>';
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function stag_categorized_blog() {
	if ( false === ( $stag_the_cool_cats = get_transient( 'stag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$stag_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$stag_the_cool_cats = count( $stag_the_cool_cats );

		set_transient( 'stag_categories', $stag_the_cool_cats );
	}

	if ( $stag_the_cool_cats > 1 ) {
		// This blog has more than 1 category so stag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so stag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in stag_categorized_blog.
 */
function stag_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'stag_categories' );
}
add_action( 'edit_category', 'stag_category_transient_flusher' );
add_action( 'save_post',     'stag_category_transient_flusher' );
