<?php

add_filter( 'rwmb_meta_boxes', 'stag_register_meta_boxes' );

function stag_register_meta_boxes( $stag_meta_boxes )
{

	$stag_prefix = 'stag_';

	$stag_img_dir_path = get_template_directory_uri(). '/framework/meta-box/meta-box-extensions/images/';

	$stag_class_var = new Stag_Delicious;
	$stag_all_sidebars = $stag_class_var->stag_my_sidebars();


	$stag_menus = wp_get_nav_menus();
	
	global $stag_menu_array;
	$stag_menu_array = array();
	foreach ($stag_menus as $stag_menu) {
		$stag_option = $stag_menu->name;
		$stag_menu_array[$stag_menu->name] = $stag_option;
	}		

	$stag_meta_boxes[] = array(
		'id'         => 'stag_page_layout_metaboxes',
		'title'      => esc_html__( 'Page Layout', 'stag' ),
		'post_types' => array( 'page' ),
		'context'    => 'side',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'default', 'template-blog.php'),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Sidebar Position', 'stag' ),
				'id'      => "{$stag_prefix}sidebar_position",
				'type'    => 'image_select',
				'options' => array(
					'no-sidebar' => $stag_img_dir_path.'no-blog-sidebar.png',
					'sidebar-right' => $stag_img_dir_path.'sidebar-right.png',
					'sidebar-left' => $stag_img_dir_path.'sidebar-left.png',
				),
				'std'	=> 'no-sidebar',		
	            'multiple' => false,				
			),
			array(
				'name'        => esc_html__( 'Pick a Sidebar', 'stag' ),
				'id'          => "{$stag_prefix}all_sidebars",
				'type'        => 'select_advanced',
				'options'     => $stag_all_sidebars,
				'multiple'    => false,
			),				
		),
	);			

	$stag_meta_boxes[] = array(
		'id'         => 'stag_onepage_metaboxes',
		'title'      => esc_html__( 'One Page Template Options', 'stag' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'template-onepage.php' ),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'One Page Menu', 'stag' ),
				'id'      => "{$stag_prefix}onepage_menu_select",
				'type'    => 'select_advanced',
				'options' => $stag_menu_array,
				'multiple'    => false,			
			),	
	
			array(
				'name' => esc_html__( 'Navigation Offset', 'stag' ),
				'id'   => "{$stag_prefix}onepage_nav_offset",
				'type' => 'slider',
				'desc'    => esc_html__( 'You can adjust the position at which the scrolling effect stops when a menu item is clicked. You can use it to set an offset value to the top of each section stop. For example, the 100 value will stop the navigation 100px above the section.', 'stag' ),
				'suffix' => esc_html__( ' px', 'stag' ),
				'js_options' => array(
					'min'   => -200,
					'max'   => 200,
					'step'  => 1,
					'std'	=> 0
				),
			),

			array(
				'name' => esc_html__( 'Enable Hashtags in URLs', 'stag' ),
				'id'   => "{$stag_prefix}onepage_nav_hashtags",
				'desc'  => esc_html__( 'Check the box to enable hashtags in the URL when clicking on menu items to navigate on page.', 'stag' ),
				'type' => 'checkbox',
				'std'  => 0,
			),												
		),
	);			

	$stag_meta_boxes[] = array(
		'id'         => 'stag_blog_metaboxes',
		'title'      => esc_html__( 'Blog Layout Options', 'stag' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'template-blog.php' ),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Blog Layout', 'stag' ),
				'id'      => "{$stag_prefix}blog_layout",
				'type'    => 'image_select',
				'options' => array(
					'masonry' => $stag_img_dir_path.'masonry-2-cols.png',
					'regular-right' => $stag_img_dir_path.'sidebar-right.png',
					'regular-left' => $stag_img_dir_path.'sidebar-left.png',
					'regular' => $stag_img_dir_path.'no-blog-sidebar.png',
				),
				'std'	=> 'masonry',			
			),		
		),
	);		


	$stag_meta_boxes[] = array(
		'id'         => 'stag_blog_video_metaboxes',
		'title'      => esc_html__( 'Video Post Format Options', 'stag' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'video' ),		
		'fields'     => array(
			array(
				'name'  => esc_html__( 'External URL(embed YouTube or Vimeo videos )', 'stag' ),
				'id'    => "{$stag_prefix}external_video_block",
				'desc'  => esc_html__( 'Use an YouTube or Vimeo page URL(ex: http://www.youtube.com/watch?v=x6qe_kVaBpg). The embed code will be automatically created.', 'stag' ),
				'type'  => 'text',
				'size'	=> 50,
			),	
		),
	);	

	$stag_meta_boxes[] = array(
		'id'         => 'stag_blog_gallery_metaboxes',
		'title'      => esc_html__( 'Gallery Post Format Options', 'stag' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'gallery' ),		
		'fields'     => array(
			array(
				'name'             => esc_html__( 'Post Slider Images', 'stag' ),
				'id'               => "{$stag_prefix}blog_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 30,
				'desc'			   => esc_html__( 'Upload new images or select them from the media library. (Ctrl/CMD + Click for selecting multiple items at once)', 'stag' )
			),	
		),
	);				

if ( post_type_exists( 'portfolio' ) ) {
	$stag_meta_boxes[] = array(
		'id'         => 'stag_portfolio_metaboxes',
		'title'      => esc_html__( 'Portfolio Options', 'stag' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'template-portfolio.php' ),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Layout', 'stag' ),
				'id'      => "{$stag_prefix}portfolio_columns",
				'type'    => 'image_select',
				'options' => array(
					'grid' => $stag_img_dir_path.'masonry-3-cols.png'
				),
				'std'	=> 'grid',			
			),		
			array(
				'name'        => esc_html__( 'Grid Columns', 'stag' ),
				'id'          => "{$stag_prefix}masonry_grid_columns",
				'type'        => 'select_advanced',
				'options'     => array(
						'two-cols' => esc_html__( '2', 'stag' ),
						'three-cols' => esc_html__( '3', 'stag' ),
						'four-cols' => esc_html__( '4', 'stag' ),
						'five-cols' => esc_html__( '5', 'stag' ),
					),
				'std' 		  => 'three-cols',
				'multiple'    => false,
			),				
			array(
				'name' => esc_html__( 'With Filter', 'stag' ),
				'id'   => "{$stag_prefix}portfolio_navigation",
				'desc'  => esc_html__( 'Check the box to enable filters above the portfolio grid.', 'stag' ),
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name'    => esc_html__( 'Categories/Filters', 'stag' ),
				'id'      => "{$stag_prefix}cats_field",
				'type'    => 'taxonomy',
				'desc'	  => esc_html__('Select from which categories to display projects in the grid.', 'stag'),
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'portfolio_cats',
					'type'     => 'checkbox_tree',
					'args'     => array()
				),
			),						
		),
	);	
}


	$stag_meta_boxes[] = array(
		'id'         => 'stag_standard',
		'title'      => esc_html__( 'Page Options (optional)', 'stag' ),
		'post_types' => array( 'page', 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'        => esc_html__( 'Title Position', 'stag' ),
				'id'          => "{$stag_prefix}page_title_position",
				'type'        => 'select_advanced',
				'options'     => array(
					'left-title'	=> esc_html__( 'Left', 'stag' ),
					'center-title'	=> esc_html__( 'Center', 'stag' ),					
					),
				'multiple'    => false,
			),				
			array(
				'name'  => esc_html__( 'Title Tagline', 'stag' ),
				'id'    => "{$stag_prefix}page_tagline",
				'desc'  => esc_html__( 'You can set a tagline for the title.', 'stag' ),
				'type'  => 'text',
				'size'	=> 50,
			),
			array(
				'id'               => "{$stag_prefix}page_title_bg",
				'name'             => esc_html__( 'Title Background Image', 'stag' ),
				'type'             => 'image_advanced',
				'force_delete'     => false,
				// Maximum image uploads
				'max_file_uploads' => 1,
			),			
			array(
				'name' => esc_html__( 'Disable Title Section', 'stag' ),
				'id'   => "{$stag_prefix}page_title",
				'desc'  => esc_html__( 'Disable the entire page title section and use Visual Composer to build your page on a blank canvas.', 'stag' ),
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'name' => esc_html__( 'Disable Solid Header', 'stag' ),
				'id'   => "{$stag_prefix}solid_header_switch",
				'desc'  => esc_html__( 'Disable the solid header and set it as an overlay for the content. This is known as a fixed header or absolute positioned header.', 'stag' ),
				'type' => 'checkbox',
				'std'  => 0,
			),	
			array(
				'name' => esc_html__( 'Push Header at Top', 'stag' ),
				'id'   => "{$stag_prefix}push_header_top",
				'desc'  => esc_html__( 'Disabling the solid header will position it over the title. Push the header back to top by selecting the checkbox. Best to use when setting a background image for the page title. ', 'stag' ),
				'hidden' 	  => array('stag_solid_header_switch', '!=', '1'),
				'type' => 'checkbox',
				'std'  => 0,
			),				

			array(
				'type' => 'divider',
				'id'   => 'page_divider', // Not used, but needed
			),

			array(
				'name' => esc_html__( 'Customize the Header Behavior', 'stag' ),
				'id'   => "{$stag_prefix}pagenav_behavior_switch",
				'desc'  => esc_html__( 'Set a new behavior for the header, like setting new background colors for it or other logo.', 'stag' ),
				'type' => 'checkbox',
				'std'  => 0,
			),			

			array(
				'name'        => esc_html__( 'Menu Style', 'stag' ),
				'id'          => "{$stag_prefix}page_menu_style",
				'type'        => 'select_advanced',
				'hidden' 	  => array('stag_pagenav_behavior_switch', '!=', '1'),
				'desc'		  => esc_html__('Overwrite the global menu style, set in Appearance->Delicious Options->Header.','stag'),
				'options'     => array(
					'classic-menu' => esc_html__('Classic', 'stag'),  
					'minimal-menu' => esc_html__('Minimal', 'stag'), 
					'fullscreen-menu' => esc_html__('Fullscreen', 'stag')
					),
				'std' 		  => 'classic-menu',
				'multiple'    => false,
			),						

			array(
				'name'        => esc_html__( 'Initial Navigation Style', 'stag' ),
				'id'          => "{$stag_prefix}initial_navigation_style",
				'type'        => 'select_advanced',
				'columns'	  => '6',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'options'     => array(
						'light-header' => esc_html__( 'Light Background / Dark Navigation', 'stag' ),
						'dark-header' => esc_html__( 'Dark Background / Light Navigation', 'stag' ),
					),
				'std' 		  => 'light-header',
				'multiple'    => false,
			),
			
			array(
				'name'        => esc_html__( 'On Scroll Navigation Style', 'stag' ),
				'id'          => "{$stag_prefix}onscroll_navigation_style",
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'type'        => 'select_advanced',
				'columns'	  => '6',
				'options'     => array(
						'light-header' => esc_html__( 'Light Background / Dark Navigation', 'stag' ),
						'dark-header' => esc_html__( 'Dark Background / Light Navigation', 'stag' ),
					),
				'std' 		  => 'light-header',
				'multiple'    => false,
			),	

			array(
				'name' => esc_html__( 'Initial Header Background Color', 'stag' ),
				'id'   => "{$stag_prefix}initial_header_color",
				'type' => 'color',
				'columns'	  => '6',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'std'  => '#ffffff'
			),	

			array(
				'name' => esc_html__( 'On Scroll Header Background Color', 'stag' ),
				'id'   => "{$stag_prefix}onscroll_header_color",
				'type' => 'color',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',
				'std'  => '#ffffff'
			),			

			array(
				'name'       => esc_html__( 'Initial Header Background Color Opacity', 'stag' ),
				'id'         => "{$stag_prefix}initial_header_color_opacity",
				'type'       => 'slider',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',				
				'suffix'     => esc_html__( '%', 'stag' ),
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
					'value' => 100
				),
			),		
			array(
				'name'       => esc_html__( 'On Scroll Header Background Color Opacity', 'stag' ),
				'id'         => "{$stag_prefix}onscroll_header_color_opacity",
				'type'       => 'slider',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',				
				'suffix'     => esc_html__( '%', 'stag' ),
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
					'value'=> 100
				),
			),		

			array(
				'name' => esc_html__( 'Initial Logo Image(Optional)', 'stag' ),
				'id'   => "{$stag_prefix}initial_logo_image",
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',						
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),		
			array(
				'name' => esc_html__( 'On Scroll Logo Image(Optional)', 'stag' ),
				'id'   => "{$stag_prefix}onscroll_logo_image",
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',						
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name' => esc_html__( 'SVG or Retina Ready?', 'stag' ),
				'id'   => "{$stag_prefix}initial_logo_svg_retina",
				'desc'  => esc_html__( 'If your logo is an .svg file or retina-ready .png file, set a width and height for it.', 'stag' ),
				'columns'	  => '6',	
				'type' => 'checkbox',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'std'  => 0,
			),
			array(
				'name' => esc_html__( 'SVG or Retina Ready?', 'stag' ),
				'id'   => "{$stag_prefix}onscroll_logo_svg_retina",
				'desc'  => esc_html__( 'If your logo is an .svg file or retina-ready .png file, set a width and height for it.', 'stag' ),
				'columns'	  => '6',	
				'type' => 'checkbox',
				'hidden' => array('stag_pagenav_behavior_switch', '!=', '1'),
				'std'  => 0,
			),			
			array(
				'name'  => esc_html__( 'Initial Logo Width(px)', 'stag' ),
				'id'    => "{$stag_prefix}initial_svg_retina_logo_width",
				'type'  => 'number',
				'columns'	  => '6',	
				'hidden' => array('stag_initial_logo_svg_retina', '!=', '1'),
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'OnScroll Logo Width(px)', 'stag' ),
				'id'    => "{$stag_prefix}onscroll_svg_retina_logo_width",
				'hidden' => array('stag_onscroll_logo_svg_retina', '!=', '1'),
				'type'  => 'number',
				'columns'	  => '6',	
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'Initial Logo Height(px)', 'stag' ),
				'id'    => "{$stag_prefix}initial_svg_retina_logo_height",
				'type'  => 'number',
				'columns'	  => '6',	
				'hidden' => array('stag_initial_logo_svg_retina', '!=', '1'),
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'OnScroll Logo Height(px)', 'stag' ),
				'id'    => "{$stag_prefix}onscroll_svg_retina_logo_height",
				'hidden' => array('stag_onscroll_logo_svg_retina', '!=', '1'),
				'type'  => 'number',
				'columns'	  => '6',	
				'size'	=> 50,
			),																										
		),
	);	

	$stag_meta_boxes[] = array(
		'id'         => 'stag_blog_post_tagline_metaboxes',
		'title'      => esc_html__( 'Blog Post Options', 'stag' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'  => esc_html__( 'Blog Post Title Tagline', 'stag' ),
				'id'    => "{$stag_prefix}blog_post_tagline",
				'desc'  => esc_html__( 'You can set a tagline for the blog post title(optional). It will appear on single blog post pages.', 'stag' ),
				'type'  => 'text',
				'size'	=> 50,
			),	
		),
	);


	$stag_meta_boxes[] = array(
		'id'         => 'stag_portfolio_thumbnail_metaboxes',
		'title'      => esc_html__( 'Featured Image / Thumbnail Options', 'stag' ),
		'post_types' => array( 'portfolio' ),
		'context'    => 'side',
		'priority'   => 'low',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'        => esc_html__( 'Thumbnail Behavior', 'stag' ),
				'id'          => "{$stag_prefix}portf_icon",
				'type'        => 'select_advanced',
				'options'     => array(
					'link_to_page'	=> esc_html__( 'Opens the Project Page', 'stag' ),
					'lightbox_to_image'	=> esc_html__( 'Is Opening in a Lightbox', 'stag' ),
					'link_to_link'	=> esc_html__( 'Opens a Custom URL', 'stag' ),
					'lightbox_to_video'	=> esc_html__( 'Opens a Video in a Lightbox', 'stag' ),
					'lightbox_to_gallery'	=> esc_html__( 'Opens an Image Gallery in a Lightbox', 'stag' ),
					),
				'multiple'    => false,
			),		

			array(
				'name'  => esc_html__( 'Custom URL: ', 'stag' ),
				'id'    => "{$stag_prefix}portf_link",
				'desc'  => esc_html__( 'You can set the thumbnail to open a custom URL.', 'stag' ),
				'type'  => 'text',
				'hidden' => array( 'stag_portf_icon', '!=', 'link_to_link' ),
			),

			array(
				'name'  => esc_html__( 'Video URL: ', 'stag' ),
				'id'    => "{$stag_prefix}portf_video",
				'desc'  => esc_html__( 'You can set the thumbnail to open a video from third-party websites(Vimeo, YouTube) in an URL. Ex: http://www.youtube.com/watch?v=y6Sxv-sUYtM', 'stag' ),
				'type'  => 'text',
				'hidden' => array( 'stag_portf_icon', '!=', 'lightbox_to_video' ),
			),

			array(
				'name'             => esc_html__( 'Gallery Images', 'stag' ),
				'id'               => "{$stag_prefix}portf_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 30,
				'desc'			   => esc_html__( 'Upload new images or select them from the media library. (Ctrl/CMD + Click for selecting multiple items at once)', 'stag' ),
				'hidden' => array( 'stag_portf_icon', '!=', 'lightbox_to_gallery' ),
			),			

			array(
				'name'    => esc_html__( 'Thumbnail Orientation', 'stag' ),
				'id'      => "{$stag_prefix}portf_thumbnail",
				'type'    => 'image_select',
				'options' => array(
					'landscape' => $stag_img_dir_path.'half-horizontal.png',
					'portrait' => $stag_img_dir_path.'half-vertical.png'
				),
				'std'	=> 'landscape',					
			),
		),
	);		


	$stag_meta_boxes[] = array(
		'id'         => 'stag_project_description_metabox',
		'title'      => esc_html__( 'Project Options', 'stag' ),
		'post_types' => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(

			array(
				'name'  => esc_html__( 'Small Project Description', 'stag' ),
				'id'    => "{$stag_prefix}small_pr_description",
				'desc'  => esc_html__( 'Add a small description for the project. It will be applied to certain portfolio styles.(HTML tags allowed)', 'stag' ),
				'type'  => 'textarea',
			),	
		),
	);		
	
	return $stag_meta_boxes;

}
?>