<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://intrif.com/
 * @since      1.0.0
 *
 * @package    The_Ridge_Core
 * @subpackage The_Ridge_Core/elementor
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    The_Ridge_Core
 * @subpackage The_Ridge_Core/elementor
 * @author     Ardika <ardikadev@gmail.com>
 */

function add_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'the-ridge-category',
        [
            'title' => esc_html__( 'The Ridge Widget', 'textdomain' ),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

function register_the_ridge_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/the-ridge-widget-1.php' );
    require_once( __DIR__ . '/widgets/the-ridge-widget-2.php' );

    $widgets_manager->register( new \Elementor_The_Ridge_Widget_1() );
    $widgets_manager->register( new \Elementor_The_Ridge_Widget_2() );

}
add_action( 'elementor/widgets/register', 'register_the_ridge_widget' );