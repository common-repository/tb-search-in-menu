<?php

/**
 * Plugin Name:       TB Search in Menu
 * Plugin URI:        http://theme.blue/plugins/search-in-menu
 * Description:       This plugin adds a search item in the nav menu of your choice
 * Version:           1.0.0
 * Author:            theme.blue
 * Author URI:        http://theme.blue
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tb-search-in-menu
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


require_once plugin_dir_path( __FILE__ ) . 'includes/customizer.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/styles.php';

/**
* Scripts and styles
*/
function tb_search_in_menu_scripts() {
	wp_enqueue_style( 'tb-search-in-menu-styles', plugin_dir_url( __FILE__ ) . 'css/front.css' );
	wp_enqueue_script( 'tb-search-in-menu-scripts', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'),'', true );
}
add_action( 'wp_enqueue_scripts', 'tb_search_in_menu_scripts' );

/**
* Search form
*/
function tb_search_form() {
	$placeholder = get_theme_mod('tb_search_placeholder', __( 'Type and press enter&hellip;', 'tb-search-in-menu' ));
	$form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '">';
	$form .= 	'<label>';
	$form .= 	'<span class="screen-reader-text">' . __( 'Search for:', 'tb-search-in-menu' ) . '</span>';
	$form .= 	'<input type="search" class="search-field" placeholder="' . $placeholder . '" value="' . get_search_query() . '" name="s" title="' . __( 'Search for:', 'tb-search-in-menu' ) . '" />';
	$form .= 	'</label>';
	$form .= '</form>';

	return $form;
}

/**
* Add search item to menu
*/
function tb_search_menu_item( $items, $args ) {
	$location 		= get_theme_mod('tb_menu_location');
	$search_text 	= get_theme_mod('tb_search_text', __('Search', 'tb-search-in-menu'));

    if ($args->theme_location == $location) {
        $items .= '<li id="tb-search-item" class="tb-search-item"><a href="#"><span class="icon-search tb-search"></span>' . $search_text . '</a></li>';
        $items .= '<div id="tb-search" class="tb-menu-search"><div class="search-close"><span class="icon-cancel tb-close"></span></div><div class="tb-search-inner">' . tb_search_form() . '</div></div>';      
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'tb_search_menu_item', 10, 2 );