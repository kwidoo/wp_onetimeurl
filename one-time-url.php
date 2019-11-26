<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/kwidoo/wp_onetimeurl
 * @since             1.0.0
 * @package           One_Time_Url
 *
 * @wordpress-plugin
 * Plugin Name:       One Time URL WordPress Plugin
 * Plugin URI:        https://github.com/kwidoo/wp_onetimeurl
 * Description:       Serves One Time Urls for WordPress
 * Version:           1.0.0
 * Author:            smart2be
 * Author URI:        https://pashkovsky.me
 * License:           MIT
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       one-time-url
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
define( 'ONE_TIME_URL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-one-time-url-activator.php
 */
function activate_one_time_url() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-one-time-url-activator.php';
	One_Time_Url_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-one-time-url-deactivator.php
 */
function deactivate_one_time_url() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-one-time-url-deactivator.php';
	One_Time_Url_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_one_time_url' );
register_deactivation_hook( __FILE__, 'deactivate_one_time_url' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-one-time-url.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_one_time_url() {

	$plugin = new One_Time_Url();
	$plugin->run();

}
run_one_time_url();
