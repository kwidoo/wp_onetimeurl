<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/admin
 * @author     Oleg Pashkovsky <oleg@pashkovsky.me>
 */
class One_Time_Url_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $one_time_url    The ID of this plugin.
	 */
	private $one_time_url;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $one_time_url The name of this plugin.
	 * @param string $version      The version of this plugin.
	 */
	public function __construct( $one_time_url, $version ) {

		$this->one_time_url = $one_time_url;
		$this->version      = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	//phpcs:disable
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in One_Time_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The One_Time_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/** wp_enqueue_style( $this->one_time_url, plugin_dir_url( __FILE__ ) . 'css/one-time-url-admin.css', array(), $this->version, 'all' );*/

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in One_Time_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The One_Time_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/** wp_enqueue_script( $this->one_time_url, plugin_dir_url( __FILE__ ) . 'js/one-time-url-admin.js', array( 'jquery' ), $this->version, false );*/

	}

}
