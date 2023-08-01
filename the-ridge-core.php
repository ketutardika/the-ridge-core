<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://intrif.com/
 * @since             1.0.0
 * @package           The_Ridge_Core
 *
 * @wordpress-plugin
 * Plugin Name:       The Ridge Core
 * Plugin URI:        https://intrif.com/
 * Description:       Plugin Core for Theme Wordpress The Ridge
 * Version:           1.0.0
 * Author:            Ardika
 * Author URI:        https://intrif.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       the-ridge-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'THE_RIDGE_CORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-the-ridge-core-activator.php
 */
function activate_the_ridge_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-the-ridge-core-activator.php';
	The_Ridge_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-the-ridge-core-deactivator.php
 */
function deactivate_the_ridge_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-the-ridge-core-deactivator.php';
	The_Ridge_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_the_ridge_core' );
register_deactivation_hook( __FILE__, 'deactivate_the_ridge_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-the-ridge-core.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-the-ridge-core-elementor.php';

function filter_action_the_ridge_core_links( $links ) {
     $links['settings'] = '<a href="#">' . __( 'Settings', 'the-ridge-core' ) . '</a>';
     $links['support'] = '<a href="#">' . __( 'Documentation', 'the-ridge-core' ) . '</a>';
     return $links;
}
add_filter( 'plugin_action_links_the-ridge-core/the-ridge-core.php', 'filter_action_the_ridge_core_links', 10, 1 );



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_the_ridge_core() {

	$plugin = new The_Ridge_Core();
	$plugin->run();

}
run_the_ridge_core();
