<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wordpress.org/plugins/genesis-post-info-meta
 * @since             1.0.0
 * @package           Genesis_Post_Info_Meta
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Post Info & Meta
 * Plugin URI:        http://wordpress.org/plugins/genesis-post-info-meta
 * Description:       Choose where to show/hide post info and meta for Genesis themes.
 * Version:           1.1.0
 * Author:            MIGHTYminnow Web Studio & School
 * Author URI:        http://mightyminnow.com/plugin-landing-page?utm_source=genesis-post-info-meta&utm_medium=plugin-repo&utm_campaign=WordPress%20Plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       genesis-post-info-meta
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-genesis-post-info-meta-activator.php
 */
function activate_genesis_post_info_meta() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-info-meta-activator.php';
	Genesis_Post_Info_Meta_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-genesis-post-info-meta-deactivator.php
 */
function deactivate_genesis_post_info_meta() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-info-meta-deactivator.php';
	Genesis_Post_Info_Meta_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_genesis_post_info_meta' );
register_deactivation_hook( __FILE__, 'deactivate_genesis_post_info_meta' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-genesis-post-info-meta.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_genesis_post_info_meta() {

	// Set up main plugin object args from main file.
	$args = array(
		'plugin_file' => __FILE__,
	);

	$plugin = Genesis_Post_Info_Meta::get_instance( $args );
	$plugin->run();

}
run_genesis_post_info_meta();
