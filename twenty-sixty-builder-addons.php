<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.2060digital.com/
 * @since             1.0.0
 * @package           Twenty_Sixty_Builder_Addons
 *
 * @wordpress-plugin
 * Plugin Name:       2060 Digital Builder Addons
 * Plugin URI:        http://www.2060digital.com
 * Description:       This plugin adds in custom functionality to the 2060 Digital Page Builder
 * Version:           1.0.3
 * Author:            Marc Palmer
 * Author URI:        http://www.2060digital.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twenty-sixty-builder-addons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twenty-sixty-builder-addons-activator.php
 */
function activate_twenty_sixty_builder_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twenty-sixty-builder-addons-activator.php';
	Twenty_Sixty_Builder_Addons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twenty-sixty-builder-addons-deactivator.php
 */
function deactivate_twenty_sixty_builder_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twenty-sixty-builder-addons-deactivator.php';
	Twenty_Sixty_Builder_Addons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twenty_sixty_builder_addons' );
register_deactivation_hook( __FILE__, 'deactivate_twenty_sixty_builder_addons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twenty-sixty-builder-addons.php';

// Only pull in the file is the class does not exist
if( ! class_exists ( 'GitHubPluginUpdater' ) )
	require_once( 'github-plugin-updater.php' );

if( is_admin() ) {
    new GitHubPluginUpdater( __FILE__, 'palmermarc', "twenty-sixty-builder-addons" );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twenty_sixty_builder_addons() {
	$plugin = new Twenty_Sixty_Builder_Addons();
	$plugin->run();
}

run_twenty_sixty_builder_addons();