<?php

//wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true );
/**
 * Proper way to enqueue scripts and styles.
 */
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-theme-style', get_template_directory_uri() . '/style.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );


function hw_theme_scripts() {
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'hw_theme_scripts' );