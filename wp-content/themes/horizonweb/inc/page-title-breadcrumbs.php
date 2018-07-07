<?php 
$stag_data = stag_dt_data();

if((!is_404()) || (!is_search() ) ) { 
	$stag_position = get_post_meta($post->ID, 'stag_page_title_position', true);
}

if (is_singular('portfolio')) {
	if(($stag_data['stag_breadcrumbs_enabled'] == 1) && ($stag_data['stag_breadcrumbs_for']['projects'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($stag_position); ?>">
			<div class="dt-breadcrumbs">
				<?php stag_breadcrumbs(); ?>
			</div>
		</div>
	<?php } 
} else if (is_singular() || is_page_template('template-blog.php')) {
	if(($stag_data['stag_breadcrumbs_enabled'] == 1) && ($stag_data['stag_breadcrumbs_for']['posts'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($stag_position); ?>">
			<div class="dt-breadcrumbs">
				<?php stag_breadcrumbs(); ?>
			</div>
		</div>
	<?php } } else if (is_page()) {
	if(($stag_data['stag_breadcrumbs_enabled'] == 1) && ($stag_data['stag_breadcrumbs_for']['pages'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($stag_position); ?>">
			<div class="dt-breadcrumbs">
				<?php stag_breadcrumbs(); ?>
			</div>
		</div>
	<?php } }