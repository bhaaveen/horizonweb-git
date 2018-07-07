<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "stag_redux_data";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'stag_redux_data',
        'use_cdn' => TRUE,
        'page_slug' => 'delicious_options',
        'page_title' => esc_html__('Delicious Options', 'stag'),
        'update_notice' => FALSE,
        'dev_mode' => FALSE, //SET TO FALSE
        'display_name' => $theme->get('Name'),
        'display_version' => $theme->get('Version'),
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => esc_html__('Delicious Options', 'stag'),
        'allow_sub_menu' => TRUE,
        'customizer' => TRUE,
        'default_mark' => '*',
        'google_api_key' => 'AIzaSyBPVwg6CaFLmKlxYjQu0bJGpxDN1p04S-Q',
        'disable_tracking' => TRUE,
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'fade',
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'http://themeforest.net/user/deliciousthemes/portfolio',
        'title' => esc_html__( 'Check out our Portfolio', 'stag' ),
        'icon'  => 'el el-globe-alt'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/deliciousthemes',
        'title' => esc_html__( 'Like us on Facebook', 'stag' ),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/deliciousthemes',
        'title' => esc_html__( 'Follow us on Twitter', 'stag' ),
        'icon'  => 'el el-twitter'
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'stag' ),
        'id'         => 'general',
        'icon'  => 'el el-globe-alt',
        'fields'     => array(
                    array(
                        'id'        => 'opt-info-field',
                        'type'      => 'info',
                        'title'  => esc_html__('Welcome to Stag Options Panel.', 'stag'),
                        'desc'      => esc_html__('It is meant to make your life easier by offering you options for customizing your website (upload custom logo, choose a color scheme, set up footer social icons, etc.).', 'stag')
                    ),      
 
                    array(
                        'id'        => 'stag_main_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Layout', 'stag'),
                        'desc'  => esc_html__('Select the main content alignment. Choose between wide and boxed layout.', 'stag'),
                        'options'   => array(
                            'wide-layout' => array('alt' => 'Wide Layout',  'img' => ReduxFramework::$_url . 'assets/img/1c.png'),
                            'boxed-layout' => array('alt' => 'Boxed Layout',  'img' => ReduxFramework::$_url . 'assets/img/3cm.png')
                        ),
                        'default'   => 'wide-layout'
                    ),    
                    array(
                        'id'        => 'stag_enable_preloader',
                        'type'      => 'switch',
                        'title'     => esc_html__('Website Preloader', 'stag'),
                        'subtitle'  => esc_html__('You can enable/disable the website`s spinning wheel preloader.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                                       
                    array(
                        'id'        => 'stag_site_desc_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('WordPress Site Tagline', 'stag'),
                        'desc'  => esc_html__('Enable/Disable the WordPress site tagline near logo. You can set a tagline in Settings->General.', 'stag'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),      
                    array(
                        'id'        => 'stag_smoothscroll_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Smooth Scrolling Effect', 'stag'),
                        'subtitle'  => esc_html__('Enable/Disable the Smooth Scrolling effect for the website.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),  
                    array(
                        'id'        => 'stag_breadcrumbs_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Breadcrumbs', 'stag'),
                        'subtitle'  => esc_html__('Enable/Disable breadcrumbs. Breadcrumbs are a type of navigation which appears under a page title).', 'stag'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),    
                   array(
                        'id'        => 'section-breadcrumbs-start',
                        'type'      => 'section',
                        'indent'    => true, 
                        'required'  => array('stag_breadcrumbs_enabled', '=', '1'),
                    ),                    
                    array(
                        'id'       => 'stag_breadcrumbs_for',
                        'type'     => 'checkbox',
                        'title'    => esc_html__('Enable Breadcrumbs for:', 'stag'), 
                        'desc'     => esc_html__('Select on what types of pages to display breadcrumbs.', 'stag'),
                        'options'  => array(
                            'pages' => 'Pages',                            
                            'posts' => 'Posts',
                            'projects' => 'Projects'
                        ),
                        'default' => array(
                            'pages' => '1', 
                            'posts' => '0', 
                            'projects' => '0'
                        )
                    ),
                    array(
                        'id'        => 'section-breadcrumbs-end',
                        'type'      => 'section',
                        'indent'    => false,
                        'required'  => array('stag_breadcrumbs_enabled', "=", 1),
                    ),                       


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'stag' ),
        'id'         => 'logo',
        'icon'  => 'el el-picasa',
        'fields'     => array(
                   array(
                        'id'        => 'stag_custom_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Main Logo', 'stag'),
                        'desc'  => esc_html__('Upload an image that will represent your website`s logo.', 'stag'),
                        'default'   => array('url' => 'https://deliciousthemes.com/logo-stag.png')                
                    ),

                    array(
                        'id'        => 'stag_svg_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use SVG Logo', 'stag'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'stag'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'stag_section-svglogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_svg_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'stag_svg_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an SVG Logo', 'stag'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'stag'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'stag_svg_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Width', 'stag'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '85'
                    ),        

                    array(
                        'id'        => 'stag_svg_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Height', 'stag'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '25'
                    ),                                            

                    array(
                        'id'        => 'section-svglogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_svg_enabled', "=", 1),
                    ),                        

                    array(
                        'id'        => 'stag_alternativelogo_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Alternative Logo', 'stag'),
                        'desc'  => esc_html__('You can choose to display an alternative logo for the scrolling state of the header(when header is scrolled down). Make sure to have the Scrolling Effect enabled in the Theme Options->Header section.', 'stag'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'section-alternativelogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_alternativelogo_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'stag_alternative_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload Alternative Logo', 'stag'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('You can upload an alternative logo for the scrolling state of the header.', 'stag'),
                        'required'  => array('stag_alternativelogo_enabled', '=', '1'),
                        'default'   => ''                
                    ),  

                   array(
                        'id'        => 'stag_alternative_svg_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use Alternative SVG Logo', 'stag'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'stag'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'stag_section-alternative-svglogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_alternative_svg_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'stag_alternative_svg_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an Alternative SVG Logo', 'stag'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'stag'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'stag_alternative_svg_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Alternative SVG Logo Width', 'stag'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '85'
                    ),        

                    array(
                        'id'        => 'stag_alternative_svg_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('Alternative SVG Logo Height', 'stag'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '25'
                    ),                                            

                    array(
                        'id'        => 'section-alternative-svglogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_alternative_svg_enabled', "=", 1),
                    ),                                                                         

                    array(
                        'id'        => 'section-alternativelogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_alternativelogo_enabled', '=', '1'),
                    ),         

                    array(
                        'id'        => 'stag_margin_logo',
                        'type'      => 'slider',
                        'title'     => esc_html__('Margin-Top Value for Header`s Logo', 'stag'),
                        'desc'  => esc_html__('You can adjust the logo position in header by setting a top-margin to it. You can use negative values as well. For example, if you enter 10, the logo will be lowered by 10px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'default'       => 0,
                        'min'           => -100,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'                           
                    ),   

                    array(
                        'id'        => 'stag_onscroll_logo_height',
                        'type'      => 'slider',
                        'title'     => esc_html__('Logo Height on Scroll', 'stag'),
                        'desc'  => esc_html__('Adjust the logo height on scroll. Currently is set to 25px', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'default'       => 25,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 200,
                        'display_value' => 'text'                           
                    )                                      

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'stag' ),
        'icon'       => 'el el-icon-star-empty',
        'id'         => 'admin-header',
        'fields'     => array(
                    array(
                        'id'        => 'stag_menu_type',
                        'type'      => 'select',
                        'title'     => esc_html__('Menu Style', 'stag'),
                        'desc'  => esc_html__('Select the menu style of the theme.', 'stag'),
                        'options'   => array('classic-menu' => 'Classic',  'minimal-menu' => 'Minimal', 'fullscreen-menu' => 'Fullscreen'),
                        'default'   => 'minimal-menu',
                    ),                    


                    array(
                        'id'        => 'stag_header_scheme',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mood Scheme', 'stag'),
                        'desc'  => esc_html__('Select a scheme for the header. Dark or Light. This will mainly affect the navigation. Then pick a color from below.', 'stag'),
                        'options'   => array('light-header' => 'Light Background / Dark Navigation', 'dark-header' => 'Dark Background / Light Navigation'),
                        'default'   => 'light-header',
                    ),    

                    array(
                        'id'        => 'stag_header_background',
                        'type'      => 'color_rgba',
                        'compiler'  => 'true',
                        // 'output'    => array('background' => '#header'),
                        'title'     => esc_html__('Header Background Color', 'stag'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the header (default: white).', 'stag'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 1
                        ),
                    ),           

                    array(
                        'id'            => 'stag_initial_header_padding',
                        'type'          => 'spacing',
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'title'         => esc_html__('Padding-Top/Padding-Bottom values for header`s initial position', 'stag'),
                        'desc'      => esc_html__('Set new padding values for the header`s look on initial position.', 'stag'),
                        'desc'          => esc_html__('Values are defined in pixels. Default: 48 with 48', 'stag'),
                        'default'       => array(
                            'padding-top'    => '48', 
                            'padding-bottom' => '48', 
                        )
                    ),    

                    array(
                        'id'        => 'stag_floating_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sticky Header', 'stag'),
                        'desc'  => esc_html__('You can enable a floating/sticky top-bar header which will include your logo and menu. If disabled, the scrolling effect from below will be ignored.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                 

                    array(
                        'id'        => 'stag_scrolling_effect',
                        'type'      => 'switch',
                        'title'     => esc_html__('Scrolling Effect', 'stag'),
                        'desc'  => esc_html__('You can disable the scrolling effect of the header. If disabled, "Padding-Top/Padding-Bottom values for header`s on scroll position" will be ignored.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),   

                    array(
                        'id'            => 'stag_onscroll_header_padding',
                        'type'          => 'spacing',
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'required'  => array('stag_scrolling_effect', '=', '1'),
                        'title'         => esc_html__('Padding-Top/Padding-Bottom values for header`s on scroll position', 'stag'),
                        'desc'      => esc_html__('Set new padding values for the header`s look on scroll position.', 'stag'),
                        'desc'          => esc_html__('Values are defined in pixels. Default: 16 with 16', 'stag'),
                        'default'       => array(
                            'padding-top'    => '16', 
                            'padding-bottom' => '16', 
                        )
                    ),   

                    array(
                        'id'        => 'stag_header_scheme_on_scroll',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mood Scheme on Scroll', 'stag'),
                        'desc'  => esc_html__('Select a scheme for the header. Dark or Light. This will mainly affect the navigation. Then pick a color from below.', 'stag'),
                        'options'   => array('light-header' => 'Light Background / Dark Navigation', 'dark-header' => 'Dark Background / Light Navigation'),
                        'default'   => 'light-header',
                    ), 

                    array(
                        'id'        => 'stag_header_background_on_scroll',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header Background Color on Scroll', 'stag'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the header (default: white - 90% transparent).', 'stag'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.9
                        ),
                    ),        

                    array(
                        'id'        => 'stag_search_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Search Widget in Header', 'stag'),
                        'desc'  => esc_html__('You can enable a search icon widget in the header.', 'stag'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                                   
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'stag' ),
        'id'         => 'admin-footer',
        'icon'       => 'el el-icon-minus',
        'fields'     => array(
                    array(
                        'id'        => 'stag_copyright_textarea',
                        'type'      => 'editor',
                        'title'     => esc_html__('Footer Text', 'stag'),
                        'desc'  => esc_html__('Place here your copyright line. For ex: Copyright 2016 | My website.', 'stag'),
                        'default'   => 'COPYRIGHT 2016 - STAG. ALL RIGHTS RESERVED',
                    ),   
                    array(
                        'id'        => 'stag_footer_layout',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Footer Layout', 'stag'),
                        'subtitle'  => esc_html__('Set the look of the footer: content on right-left sides, or content centered.', 'stag'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'footer-sides' => 'Content on Sides', 
                            'footer-centered' => 'Content Centered'
                        ), 
                        'default'   => 'footer-centered'
                    ),   
                   array(
                        'id'        => 'stag_footer_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Footer Logo', 'stag'),
                        'desc'  => esc_html__('You can add a logo inside the footer(Optional).', 'stag'),
                        'default'   => array('url' => 'https://deliciousthemes.com/logo-stag.png')                
                    ),  
                   array(
                        'id'        => 'stag_svg_footer_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use SVG Logo', 'stag'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'stag'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'stag_section-svglogo-footer-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_svg_footer_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'stag_svg_footer_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an SVG Logo', 'stag'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'stag'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'stag_svg_footer_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Width', 'stag'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '85'
                    ),        

                    array(
                        'id'        => 'stag_svg_footer_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Height', 'stag'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'validate'  => 'numeric',
                        'default'   => '25'
                    ),                                            

                    array(
                        'id'        => 'section-svglogo-footer-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_svg_footer_enabled', "=", 1),
                    ),                        


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'stag' ),
        'icon'       => 'el el-website',
        'id'         => 'admin-blog',
        'fields'     => array(
                   array(
                        'id'        => 'stag_blog_sidebar_pos',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Sidebar Position for Blog Related Pages', 'stag'),
                        'desc'  => esc_html__('Select a sidebar position for blog related pages. It will be applied to single posts, index page, archive and search pages.', 'stag'),
                        'options'   => array(
                            'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'no-blog-sidebar' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                        ),
                        'default'   => 'sidebar-right'
                    ),  
                    array(
                        'id'        => 'stag_blog_sidebar',
                        'type'      => 'select',
                        'title'     => esc_html__('Sidebar Name for Blog Related Pages', 'stag'),
                        'desc'  => esc_html__('Select the sidebar which will be applied to blog related pages, including single posts, index page, archive pages and search result pages.', 'stag'),
                        'data'      => 'sidebars',
                        'default' => 'sidebar',
                    ),

                    array(
                        'id'        => 'stag_blog_thumbnail_size',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Post Thumbnail Size/Position', 'stag'),
                        'desc'  => esc_html__('Select the position/size of the thumbnail for blog posts.', 'stag'),
                        'options'   => array('fullwidth-thumbnail' => 'Fullwidth Thumbnail', 'small-thumbnail' => 'Small Thumbnail'),
                        'default'   => 'fullwidth-thumbnail',
                    ),                        

                    array(
                        'id'        => 'stag_tags_list',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Tags list on Blog Posts', 'stag'),
                        'desc'  => esc_html__('If the option is on, the tags list will be displayed at the bottom of the post.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),                                                      
                    array(
                        'id'        => 'stag_social_box',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Social Share Icons for Blog Posts Inner Pages', 'stag'),
                        'desc'  => esc_html__('If the option is on, the social icons for sharing the post will be displayed.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ), 
                    array(
                        'id'        => 'stag_author_box',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Author Box for Blog Posts Inner Pages', 'stag'),
                        'desc'  => esc_html__('If the option is on, the author box will be displayed.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),    
                    array(
                        'id'        => 'stag_prev_next_posts',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Prev/Next Posts Links for Blog Posts', 'stag'),
                        'desc'  => esc_html__('If the option is on, links for Prev/Next posts will be displayed.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),   
                    array(
                        'id'        => 'stag_breadcrumbs_blog_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the `Blog` link in breadcrumbs.', 'stag'),
                        'desc'  => esc_html__('Add an URL for the Blog link in the breadcrumbs which appear on posts.', 'stag')
                    ),  
                    array(
                        'id'        => 'stag_breadcrumbs_blog_keyword',
                        'type'      => 'text',
                        'default'   => 'The Journal',
                        'title'     => esc_html__('Breadcrumb Keyword for Blog.', 'stag'),
                        'desc'  => esc_html__('Ex: Blog or Journal.', 'stag')
                    ),                                                                        
        )
    ) ); 

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'stag' ),
        'id'         => 'admin-portfolio',
        'icon'       => 'el el-icon-briefcase',
        'fields'     => array(
                    array(
                        'id'        => 'stag_proj_nav_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Project Navigation', 'stag'),
                        'desc'  => esc_html__('Enable/Disable the project navigation from project pages.', 'stag'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),  
                   array(
                        'id'        => 'section-projnav-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_proj_nav_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'stag_portfolio_back_link',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the portfolio `Back` button icon', 'stag'),
                        'desc'  => esc_html__('Add an URL for the portfolio Back button.', 'stag'),
                        'hint'      => array(
                            //'title'     => '',
                            'content'   => 'Default URL is set to homepage. Ex: http://website.com#work. The URL will be also used to highlight the menu item in the navigation.',
                        )                        
                    ),

                    array(
                        'id'       => 'stag_portfolio_nav_behaviour',
                        'type'     => 'radio',
                        'title'    => esc_html__('Project Navigation Behavior:', 'stag'), 
                        'desc'     => esc_html__('Select how would you like the navigation to behave: Display link to another project from the same category or not.', 'stag'),
                        'options'  => array(
                            'all-categories' => 'Projects from all categories',
                            'same-category' => 'Projects from the same category', 
                        ),
                        'default' => 'all-categories'
                    ),                    

                    array(
                        'id'        => 'section-projnav-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('stag_proj_nav_enabled', '=', '1'),
                    ),     

 
                    array(
                        'id'        => 'stag_portfolio_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio',
                        'title'     => esc_html__('Portfolio Slug URL', 'stag'),
                        'hint'  => array( 
                            'content' => esc_html__('Change the default portfolio slug URL. Currently, this is set to <strong>portfolio</strong>. Ex: http://website.com/portfolio/project-name. Changing it to <strong>works</strong>, the URLs will become http://website.com/works/project-name. Once you`ll change it, you`ll probably get 404 error pages for projects. To fix this, refresh the permalinks: go to Settings->Permalinks and click on Default. Save. Then click on your custom URL structure(Postname) and save again.', 'stag')
                            ),                 
                    ),

                    array(
                        'id'        => 'stag_taxonomy_links',
                        'type'      => 'switch',
                        'title'     => esc_html__('Linkable Categories', 'stag'),
                        'desc'  => esc_html__('Enable/Disable links for categories on project grids.', 'stag'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),  

                    array(
                        'id'        => 'stag_breadcrumbs_portfolio_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the `Portfolio` link in breadcrumbs.', 'stag'),
                        'desc'  => esc_html__('Add an URL for the portfolio link in the breadcrumbs which appear on projects.', 'stag')
                       
                    ),
                    array(
                        'id'        => 'stag_breadcrumbs_portfolio_keyword',
                        'type'      => 'text',
                        'default'   => 'Projects',
                        'title'     => esc_html__('Breadcrumb Keyword for Portfolio.', 'stag'),
                        'desc'  => esc_html__('Ex: Projects or Work.', 'stag')
                    ),                                                  
        )
    ) );     

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'stag' ),
        'id'         => 'admin-typography',
        'icon'       => 'el-icon-filter',
        'fields'     => array(
                   array(
                        'id'        => 'stag_typo_info',
                        'type'      => 'info',
                        'title'  => esc_html__('Typography Options', 'stag'),
                        'desc'      => esc_html__('The theme is using Google Fonts to render the typography style for your website. You can however, make use of default fonts.).', 'stag')
                    ),                    

                    array(
                        'id'        => 'stag_body_font_typo',
                        'type'      => 'typography',
                        'output'    => array('html body'),
                        'title'     => esc_html__('Body Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for the body', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'all_styles'=> true,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#656565',
                            'font-size'     => '15px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '24px',
                            'font-weight'   => '400',
                        ),
                    ),

                    array(
                        'id'        => 'stag_menu_typo',
                        'type'      => 'typography',
                        'output'    => array('html .main-navigation li a'),
                        'title'     => esc_html__('Menu Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for the main menu.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '12px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '24px',
                            'font-weight'   => '400',
                        ),
                    ),

                    array(
                        'id'        => 'stag_submenu_typo',
                        'type'      => 'typography',
                        'output'    => array('html .main-navigation ul ul a'),
                        'title'     => esc_html__('Dropdown Menu Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for the submenu/dropdown items.', 'stag'),
                        'text-align'=> false,
                        'subsets'   => true,
                        'color' => false,
                        'default'   => array(
                            'google'      => true,
                            'font-size'     => '13px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '18px',
                            'font-weight'   => '400'
                        ),
                    ),                    

                    array(
                        'id'        => 'stag_h1_typo',
                        'type'      => 'typography',
                        'output'    => array('html h1'),
                        'title'     => esc_html__('H1 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 1.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '42px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '52px',
                            'font-weight'   => '500',
                        ),
                    ),  

                    array(
                        'id'        => 'stag_h2_typo',
                        'type'      => 'typography',
                        'output'    => array('html h2'),
                        'title'     => esc_html__('H2 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 2.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '30px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '42px',
                            'font-weight'   => '500',
                        ),
                    ),  

                    array(
                        'id'        => 'stag_h3_typo',
                        'type'      => 'typography',
                        'output'    => array('html h3'),
                        'title'     => esc_html__('H3 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 3.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '24px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '32px',
                            'font-weight'   => '500',
                        ),
                    ),  

                    array(
                        'id'        => 'stag_h4_typo',
                        'type'      => 'typography',
                        'output'    => array('html h4'),
                        'title'     => esc_html__('H4 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 4.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '18px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '28px',
                            'font-weight'   => '500',
                        ),
                    ),      

                    array(
                        'id'        => 'stag_h5_typo',
                        'type'      => 'typography',
                        'output'    => array('html h5'),
                        'title'     => esc_html__('H5 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 5.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '15px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '24px',
                            'font-weight'   => '500',
                        ),
                    ),       

                    array(
                        'id'        => 'stag_h6_typo',
                        'type'      => 'typography',
                        'output'    => array('html h6'),
                        'title'     => esc_html__('H6 Font Options', 'stag'),
                        'desc'  => esc_html__('Select font options for Heading 6.', 'stag'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '14px',
                            'font-family'   => 'Raleway',
                            'line-height'   => '20px',
                            'font-weight'   => '500',
                        ),
                    ),   
                                                     
        )
    ) );    

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Styling', 'stag' ),
        'id'         => 'admin-styling',
        'icon'       => 'el-icon-brush',
        'fields'     => array(
                    array(
                        'id'        => 'stag_custom_color_scheme',
                        'type'      => 'color',
                        'title'     => esc_html__('Color Scheme', 'stag'),
                        'desc'  => esc_html__('Set the color for the scheme.', 'stag'),
                        'default'   => '#3e8a6c',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'stag_body_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body'),
                        'title'     => esc_html__('Body Background Color', 'stag'),
                        'desc'  => esc_html__('Leave blank or pick a color for the body. (default: #fafafa).', 'stag'),
                        'default'   => '#fafafa',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'stag_wrapper_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body #page'),
                        'title'     => esc_html__('Content Wrapper Background Color', 'stag'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the content wrapper (default: #fff).', 'stag'),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color'
                    ),           
                    array(
                        'id'        => 'stag_footer_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html .site-footer'),
                        'title'     => esc_html__('Footer Background Color', 'stag'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the footer (default: #ffffff).', 'stag'),
                        'default'   => '#fafafa',
                        'transparent' => false,
                        'validate'  => 'color'
                    ),   
                    array(
                        'id'        => 'stag_selected_text_background',
                        'type'      => 'color',
                        'output'    => array('background' => '-moz::selection,::selection'),
                        'title'     => esc_html__('Selected Text Background Color', 'stag'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the selected text (default: blue, set by the browser).', 'stag'),
                        'default'   => '#3e8a6c',                      
                        'transparent' => false,
                        'validate'  => 'color'
                    ),                                                   

                    array(
                        'id'        => 'stag_pattern',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Patterns for Background', 'stag'),
                        'desc'  => esc_html__('Select a pattern and set it as background. Choose between these patterns. More to come...', 'stag'),
                        'options'   => array(
                            'bg12' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg12.png'),
                            'bg1' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg1.png'),
                            'bg2' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg2.png'),
                            'bg3' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg3.png'),
                            'bg4' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg4.png'),
                            'bg5' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg5.png'),
                            'bg6' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg6.png'),
                            'bg7' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg7.png'),
                            'bg8' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg8.png'),
                            'bg9' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg9.png'),
                            'bg10' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg10.png'),
                            'bg11' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg11.png'),
                            'bg14' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg14.png'),
                            'bg15' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg15.png'),
                            'bg16' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg16.png'),
                            'bg17' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg17.png'),
                            'bg18' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg18.png'),
                            'bg19' => array('alt' => '',  'img' => ReduxFramework::$_url . 'assets/img/bg19.png')
                        ),
                        'default'   => 'bg12'
                    ),                             
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'stag' ),
        'id'         => 'admin-social',
        'icon'       => 'el-icon-network',
        'fields'     => array(
                   array(
                        'id'        => 'stag_social_intro',
                        'type'      => 'info',
                        'title'  => esc_html__('Social Options.', 'stag'),
                        'desc'      => esc_html__('Set your social network references. Add your links for popular platforms like Twitter and Facebook. If you don`t want to include a social icon in the list, just leave the textfield empty.).', 'stag')
                    ),
                    array(
                        'id'        => 'rss',
                        'type'      => 'text',
                        'title'     => esc_html__('Your RSS Feed address', 'stag'),
                        'default'   => 'http://feeds.feedburner.com/EnvatoNotes'
                    ),   
                    array(
                        'id'        => 'facebook',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Facebook page/profile URL', 'stag'),
                        'default'   => 'http://www.facebook.com/envato'
                    ),  
                    array(
                        'id'        => 'twitter',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Twitter URL', 'stag'),
                        'default'   => 'http://twitter.com/envato'
                    ),  
                    array(
                        'id'        => 'flickr',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Flickr Page URL', 'stag'),
                    ),    
                    array(
                        'id'        => 'google-plus',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Google Plus Page URL', 'stag'),
                    ),  
                    array(
                        'id'        => 'dribbble',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Dribbble Profile URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'pinterest',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Pinterest URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'linkedin',
                        'type'      => 'text',
                        'title'     => esc_html__('Your LinkedIn Profile URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'skype',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Skype Username', 'stag'),
                    ), 
                    array(
                        'id'        => 'github-alt',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Github URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'youtube',
                        'type'      => 'text',
                        'title'     => esc_html__('Your YouTube URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'vimeo-square',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Vimeo Page URL', 'stag'),
                    ), 
                    array(
                        'id'        => 'instagram',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Instagram Profile URL', 'stag'),
                    ),

                    array(
                        'id'        => 'tumblr',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Tumblr URL', 'stag'),
                    ),   

                    array(
                        'id'        => 'behance',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Behance Profile URL', 'stag'),
                    ),                      

                    array(
                        'id'        => 'vk',
                        'type'      => 'text',
                        'title'     => esc_html__('Your VK URL', 'stag'),
                    ), 

                    array(
                        'id'        => 'xing',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Xing URL', 'stag'),
                    ),   
                    array(
                        'id'        => 'soundcloud',
                        'type'      => 'text',
                        'title'     => esc_html__('Your SoundCloud URL', 'stag'),
                    ),    
                    array(
                        'id'        => 'codepen',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Codepen URL', 'stag'),
                    ),                                                                                              
                    array(
                        'id'        => 'yelp',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Yelp URL', 'stag'),
                    ),   
                    array(
                        'id'        => 'slideshare',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Slideshare URL', 'stag'),
                    ),        
                    array(
                        'id'        => 'houzz',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Houzz URL', 'stag'),
                    ),                                  

                    array(
                        'id'        => 'stag_header_social',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Icons in Header', 'stag'),
                        'desc'  => esc_html__('Enable/Disable social icons for the header. If enabled, the social icons block will be displayed in the header nav bar.', 'stag'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                     
        )
    ) );


if ( class_exists( 'Woocommerce' ) ) {  
   Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'WooCommerce', 'stag' ),
        'id'         => 'admin-woocommerce',
        'icon'       => 'el-icon-shopping-cart',
        'fields'     => array(
                      array(
                            'id'        => 'stag_woo_layout',
                            'type'      => 'image_select',
                            'title'     => __('Sidebar Position for the Shop Page', 'stag'),
                            'subtitle'  => __('Select a sidebar position for the Shop page.', 'stag'),
                            'options'   => array(
                                'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                'no-sidebar' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                            ),
                            'default'   => 'sidebar-right'
                        ),  
                        array(
                            'id'        => 'stag_woo_sidebar',
                            'type'      => 'select',
                            'title'     => __('Sidebar Name for Shop Page', 'stag'),
                            'subtitle'  => __('Select the sidebar which will be applied to the shop page, if the shop page layout defined from the option from above is set to a sidebar.', 'stag'),
                            'data'      => 'sidebars',
                            'default' => 'sidebar',
                        ),
                    array(
                        'id'        => 'stag_woo_products_per_row',
                        'type'      => 'select',
                        'title'     => __('Products per Row', 'stag'),
                        'subtitle'  => __('Set how many products would you like to display on a single row. In other words, how many columns will the shop page have?', 'stag'),
                        'options'   => array('2' => '2',  '3' => '3', '4' => '4', '6' => '6'),
                        'default'   => '3',
                    ),   
                    array(
                        'id'        => 'stag_woo_products_per_page',
                        'type'      => 'slider',
                        'title'     => __('Products per Page', 'stag'),
                        'subtitle'  => __('Set how many products would you like to display on a page.', 'stag'),
                        'desc'      => esc_html__('Use numbers only', 'stag'),
                        'default'       => 9,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 50,
                        'display_value' => 'text'                           
                    ),                                         
                ),
        )
   );
}


    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom CSS & JS', 'stag' ),
        'id'         => 'admin-custom-code',
        'icon'       => 'el-icon-edit',
        'fields'     => array(
                    array(
                        'id'        => 'stag_more_css',
                        'type'      => 'ace_editor',
                        'mode'      => 'css',
                        'theme'     => 'chrome',
                        'title'     => esc_html__('Custom CSS', 'stag'),
                        'desc'  => esc_html__('Quickly add some CSS to your theme by adding it to this block.', 'stag'),
                        'validate'  => 'css',
                        'options'   => array('minLines' => 12, 'useWorker' => false, 'fontSize' => 13)
                    ),

                    array(
                        'id'        => 'stag__header_custom_js',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Header Custom JS', 'stag'),
                        'desc'  => esc_html__('Paste your JavaScript code here. Use this field to quickly add JS code snippets before </head>.', 'stag'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'options'   => array('minLines' => 12, 'fontSize' => 13),
                        'default'   => ""
                    ),                      

                    array(
                        'id'        => 'stag__footer_custom_js',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Footer Custom JS', 'stag'),
                        'desc'  => esc_html__('Paste your JavaScript code here. Use this field to quickly add JS code snippets.', 'stag'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'options'   => array('minLines' => 12, 'fontSize' => 13),
                        'default'   => ""
                    ),                    

        )
    ) );

    /*
     * <--- END SECTIONS
     */