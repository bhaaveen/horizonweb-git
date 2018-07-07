<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Stag Theme
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area percent-sidebar" role="complementary">
		<?php	
		$stag_sidebars = get_post_meta($post->ID, 'stag_all_sidebars', true);
		if(!empty($stag_sidebars)) { 
				dynamic_sidebar( $stag_sidebars );
		}

		else {
			if ( is_active_sidebar( 'sidebar' ) ) { 
				dynamic_sidebar( 'sidebar' ); 
				}		
			}
		?>
</div><!-- #secondary -->
