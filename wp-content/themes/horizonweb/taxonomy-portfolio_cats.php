<?php
	get_header(); 

$stag_data = stag_dt_data();	
?>

	<div class="page-title-wrapper">
		<div class="container">
			<h2 class="section-title"><?php _e('Category: ', 'stag'); ?><strong><?php single_cat_title(); ?></strong></h2>
			<?php
				$categ_desc = category_description( get_the_category( $id ) ); 

				if($categ_desc != '') { 
				?>
					<h4 class="section-tagline"><?php echo $categ_desc ?> </h4>
				<?php } ?>			
		</div>
	</div>
	<div class="space"></div>

	<div class="container">
	<section class="delicious-grid" id="gridwrapper_portfolio">		

		<section id="portfolio-wrapper">		
			<ul class="portfolio grid three-cols dt-gap-15 isotope dt-gallery grid_portfolio">
			
				<?php

				// Begin The Loop
				if (have_posts()) : while (have_posts()) : the_post(); 	

				// Get The Taxonomy 'Filter' Categories
				$stag_terms = get_the_terms( get_the_ID(), 'portfolio_cats' ); 

				$stag_portf_icon = get_post_meta($post->ID,'stag_portf_icon',true);						
				$stag_portf_link = get_post_meta($post->ID,'stag_portf_link',true);						
				$portf_video = get_post_meta($post->ID,'stag_portf_video',true);						
				$stag_portf_thumbnail = get_post_meta($post->ID,'stag_portf_thumbnail',true);	
				
				$stag_lgal = rwmb_meta( 'stag_portf_gallery', 'type=image_advanced&size=full', $post->ID );

				$stag_gal_output = '';
				if(!empty($stag_lgal)) { 
					$stag_gal_output .= '<div class="dt-single-gallery">';
					
					foreach($stag_lgal as $stag_gal_item) {
						$stag_gal_output .= '<a href="'.esc_url($stag_gal_item['url']).'" title="'.esc_attr($stag_gal_item['title']).'"></a>';
					}
					$stag_gal_output .= '</div>';
				}

				$stag_thumb_id = get_post_thumbnail_id($post->ID);
				$stag_image_url = wp_get_attachment_url($stag_thumb_id);
				
				$stag_grid_thumbnail = $stag_image_url;
				$stag_item_class = 'item-small';
				
				switch ($stag_portf_thumbnail) {
					case 'landscape':
						$stag_grid_thumbnail = aq_resize($stag_image_url, 640, 480, true);
						$stag_item_class = 'item-wide';
						break;
					case 'portrait':
						$stag_grid_thumbnail = aq_resize($stag_image_url, 640, 853, true);
						$stag_item_class = 'item-small';
						break;								
				}				
					
				
				?>
				<li class="grid-item">
					<?php	
						if ($stag_portf_icon == 'lightbox_to_image') { ?>
							<a href="<?php echo esc_url(wp_get_attachment_url($stag_thumb_id));?>" class="img-anchor dt-lightbox-gallery" title="<?php esc_attr(the_title()); ?>">
								<div class="project-hover">
									<i class="fa fa-search"></i>
								</div>
								<img src="<?php echo esc_url($stag_grid_thumbnail); ?>" alt="" />
							</a>
						<?php } 
						else if ($stag_portf_icon == 'link_to_page') {  ?>
							<a class="img-anchor" href="<?php esc_url(the_permalink()); ?>">
								<div class="project-hover">
									<i class="fa fa-external-link"></i>
								</div>								
								<img src="<?php echo esc_url($stag_grid_thumbnail); ?>" alt="" />
							</a>
						<?php } 
						else if ($stag_portf_icon == 'link_to_link') {  ?>
							<a class="img-anchor" href='<?php echo esc_url($stag_portf_link); ?>'>
								<div class="project-hover">
									<i class="fa fa-external-link"></i>
								</div>								
								<img src="<?php echo esc_url($stag_grid_thumbnail); ?>" alt="" />
							</a>
						<?php }	
						else if ($stag_portf_icon == 'lightbox_to_video') {  ?>
							<a class="img-anchor dt-lightbox-gallery mfp-iframe" href="<?php echo esc_url($portf_video); ?>" title="<?php esc_attr(the_title()); ?>">
								<div class="project-hover">
									<i class="fa fa-play-circle"></i>
								</div>								
								<img src="<?php echo esc_url($stag_grid_thumbnail); ?>" alt="" />
							</a>
						<?php }	
						if ($stag_portf_icon == 'lightbox_to_gallery') {  ?> 
							<a class="dt-gallery-trigger img-anchor" title="<?php esc_attr(the_title()); ?>" >
								<div class="project-hover">
									<i class="fa fa-picture-o"></i>
								</div>								
								<img src="<?php echo esc_url($stag_grid_thumbnail); ?>" alt="" />
							</a>
						<?php echo $stag_gal_output; } ?>

						<div class="grid-item-on-hover">
							<div class="grid-text">
								<h3><a href="<?php esc_url(the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
								<div class="grid-item-cat">
								<?php
								$stag_copy = $stag_terms;
								if(isset($stag_data['stag_taxonomy_links']) && ($stag_data['stag_taxonomy_links'] =='1')) {
									foreach ( $stag_terms as $stag_term ) {
										$stag_term_link = get_term_link($stag_term->slug, 'portfolio_cats');
										if (function_exists('icl_t')) { 
										   echo '<a href="'.esc_url($stag_term_link).'">'.icl_t('Portfolio Category', 'Term '.delicious_get_taxonomy_cat_ID( $stag_term->name ).'', $stag_term->name).'</a>'; 
										}
										else 
											echo '<a href="'.esc_url($stag_term_link).'">'.esc_html($stag_term->name).'</a>';
											if (next($stag_copy )) {
												echo esc_html__(', ', 'stag');
											}
										}	
								}
								else {
									foreach ( $stag_terms as $stag_term ) {
									if (function_exists('icl_t')) { 
									   echo icl_t('Portfolio Category', 'Term '.delicious_get_taxonomy_cat_ID( $stag_term->name ).'', $stag_term->name);
									}
									else 
										echo esc_html($stag_term->name);
										if (next($stag_copy )) {
											echo esc_html__(', ', 'stag');
										}
									}										
								}

								?>
								</div>									
							</div>

						</div>							
						

				</li>

	
				<?php endwhile; endif; // END the Wordpress Loop ?>
			</ul>
			<?php stag_navigation(); ?>
			<?php wp_reset_postdata(); // Reset the Query Loop ?>			
					
		</section>
	</section>
	</div><!--end centered-wrapper-->
	<div class="space"></div>

<?php get_footer(); ?>