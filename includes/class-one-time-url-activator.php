<?php
/**
 * Fired during plugin activation
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    One_Time_Url
 * @subpackage One_Time_Url/includes
 * @author     Oleg Pashkovsky <oleg@pashkovsky.me>
 */
class One_Time_Url_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		$table           = $wpdb->prefix . 'otu_mapping';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = 'CREATE TABLE `' . $table . '` (`id` mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,`url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,`uuid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,`referer` text COLLATE utf8mb4_general_ci NOT NULL,`clicked` tinyint(1) NOT NULL DEFAULT \'0\', `user_id` mediumint(8) UNSIGNED NOT NULL, `time` datetime NOT NULL)' . $charset_collate;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}
}
