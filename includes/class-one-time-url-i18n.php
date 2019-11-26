<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 * @author     Oleg Pashkovsky <oleg@pashkovsky.me>
 */
class One_Time_Url_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'one-time-url',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
