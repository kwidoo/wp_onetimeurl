<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 * @author     Oleg Pashkovsky <oleg@pashkovsky.me>
 */
class One_Time_Url_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$table = $wpdb->prefix . 'otu_mapping';
		//phpcs:ignore
		$wpdb->query( "DROP TABLE IF EXISTS " . $table );
	}
}
