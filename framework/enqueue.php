<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style';
    
    $theme = wp_get_theme();
    // parent;
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),
        $theme->parent()->get('Version')
    );
    // child;
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version')
    );
	
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/js/script.js?t='.time(), array('jquery'), null, true); 
}