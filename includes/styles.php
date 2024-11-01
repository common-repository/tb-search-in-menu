<?php

/**
 * Dynamic styles
 *
 * @package Tb_Search_In_Menu
 * @since   1.0.0
 */

/**
* Convert hex to rgba
*/
function tb_search_hex2rgba($color, $opacity = false) {

        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        $rgb =  array_map('hexdec', $hex);
        $opacity = 0.9;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        return $output;
}

/**
* Styles
*/
function tb_search_custom_styles($custom) {

	//Get the custom colors
	$icon_color 	= get_theme_mod( 'tb_icon_color', '#333333' );
	$overlay_bg 	= get_theme_mod( 'tb_overlay_color', '#000000' );
	$overlay_rgba	= tb_search_hex2rgba($overlay_bg, '0.9');
	$overlay_text 	= get_theme_mod( 'tb_overlay_text_color', '#ffffff' );

	//Apply the custom colors
	$custom = '';
	$custom .= ".tb-search { background-color:" . esc_attr($icon_color) . ";}"."\n";
	$custom .= ".tb-menu-search { background-color:" . esc_attr($overlay_rgba) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field, .tb-menu-search .search-field:focus, .search-close span { color:" . esc_attr($overlay_text) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field { border-color:" . esc_attr($overlay_text) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field::-webkit-input-placeholder { color:" . esc_attr($overlay_text) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field:-moz-placeholder { color:" . esc_attr($overlay_text) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field::-moz-placeholder { color:" . esc_attr($overlay_text) . ";}"."\n";
	$custom .= ".tb-menu-search .search-field::-ms-input-placeholder { color:" . esc_attr($overlay_text) . ";}"."\n";

	wp_add_inline_style( 'tb-search-in-menu-styles', $custom );	
}
add_action( 'wp_enqueue_scripts', 'tb_search_custom_styles', 11 );