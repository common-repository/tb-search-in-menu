<?php

/**
 * Customizer options
 *
 * @package Tb_Search_In_Menu
 * @since   1.0.0
 */

function tb_search_in_menu_customizer( $wp_customize ) {
    
    //___Add the section___//
    $wp_customize->add_section(
        'tb_search_in_menu',
        array(
            'title'         => __('TB Search in Menu', 'tb-search-in-menu'),
            'priority'      => 99,
            'description'   => __('Configuration options for the <strong>TB Search in Menu</strong> plugin', 'tb-search-in-menu'),
        )
    );

    //Create the menu locations array
    $locations = get_nav_menu_locations();
    $choices[] = __( '&mdash; Select &mdash;', 'tb_search_in_menu' );
    foreach ($locations as $location=>$key) {
        if ( has_nav_menu($location) ) {
            $choices[] = $location;
        }
    }
    $choices = array_combine($choices, $choices);

    //Menu location
    $wp_customize->add_setting(
        'tb_menu_location',
        array(
            'description' => __('Menu location', 'tb_search_in_menu'),
            'sanitize_callback' => 'tb_search_sanitize_locations',
        )
    );
    $wp_customize->add_control(
        'tb_menu_location',
        array(
            'type' => 'select',
            'label' => __('Menu location', 'tb_search_in_menu'),
            'section' => 'tb_search_in_menu',
            'description' => __('This is a list of active menu locations (for which you have assigned a menu from <em>Appearance > Menus</em>). Select the menu location for which you want to add the search item', 'tb_search_in_menu'),
            'choices' => $choices,
            'priority' => 10
        )
    );
    //Search text
    $wp_customize->add_setting(
        'tb_search_text',
        array(
            'default' => __('Search', 'tb-search-in-menu'),
            'sanitize_callback' => 'tb_search_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'tb_search_text',
        array(
            'label' => __( 'Search item text', 'tb-search-in-menu' ),
            'section' => 'tb_search_in_menu',
            'type' => 'text',
            'priority' => 11
        )
    ); 
    //Placeholder text
    $wp_customize->add_setting(
        'tb_search_placeholder',
        array(
            'default' => __( 'Type and press enter&hellip;', 'tb-search-in-menu' ),
            'sanitize_callback' => 'tb_search_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'tb_search_placeholder',
        array(
            'label' => __( 'Placeholder text', 'tb-search-in-menu' ),
            'section' => 'tb_search_in_menu',
            'type' => 'text',
            'priority' => 12
        )
    ); 
    //Icon color
    $wp_customize->add_setting(
        'tb_icon_color',
        array(
            'default'           => '#333333',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'tb_icon_color',
            array(
                'label'         => __('Search icon color', 'tb-search-in-menu'),
                'section'       => 'tb_search_in_menu',
                'priority'      => 13
            )
        )
    );
    //Overlay color
    $wp_customize->add_setting(
        'tb_overlay_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'tb_overlay_color',
            array(
                'label'         => __('Overlay background color', 'tb-search-in-menu'),
                'section'       => 'tb_search_in_menu',
                'priority'      => 13
            )
        )
    );
    //Overlay text color
    $wp_customize->add_setting(
        'tb_overlay_text_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'tb_overlay_text_color',
            array(
                'label'         => __('Overlay text color', 'tb-search-in-menu'),
                'section'       => 'tb_search_in_menu',
                'priority'      => 14
            )
        )
    );

}
add_action( 'customize_register', 'tb_search_in_menu_customizer' );


/**
* Sanitize
*/

//Text fields
function tb_search_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Menu locations
function tb_search_sanitize_locations( $input ) {
    //Create the menu locations array
    $locations = get_nav_menu_locations();
    $choices[] = __( '&mdash; Select &mdash;', 'tb_search_in_menu' );
    foreach ($locations as $location=>$key) {
        if ( has_nav_menu($location) ) {
            $choices[] = $location;
        }
    }
    $choices = array_combine($choices, $choices);
    //Check the selection
    if ( in_array( $input, $choices, true ) ) {
        return $input;
    }
}

