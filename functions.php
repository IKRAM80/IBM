<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','hestia-font-sizes' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

function enqueue_child_theme_styles() {
    wp_enqueue_style( 'single-projet', get_stylesheet_directory_uri() . '/css/single-projet.css' );
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/scripts.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles' );

// UTILISER LA SINGLE-PROJET.PHP POUR LE CUSTOM POST TYPE: 'realisation'
function custom_post_type_template($single_template) {
    global $post;

    if ($post->post_type == 'realisation') {
        $single_template = dirname(__FILE__) . '/template/single-projet.php';
    }

    return $single_template;
}
add_filter('single_template', 'custom_post_type_template');


function add_elements_menus($items, $args) {
    
    if ($args->theme_location == 'footer') {
        $items .= '<li class="widget widget_block widget_text"> Tout droit réservé. Site réalisé par ikram-dev. </li>'; // Ajoutez un autre élément au menu de pied de page
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_elements_menus', 10, 2);