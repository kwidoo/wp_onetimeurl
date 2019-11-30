<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/kwidoo/wp_onetimeurl
 * @since      1.0.0
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/public
 */

use Ramsey\Uuid\Uuid;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    One_Time_Url
 * @subpackage One_Time_Url/public
 * @author     Oleg Pashkovsky <oleg@pashkovsky.me>
 */
class One_Time_Url_Public {

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
	 * @param string $one_time_url The name of the plugin.
	 * @param string $version      The version of this plugin.
	 */
	public function __construct( $one_time_url, $version ) {

		$this->one_time_url = $one_time_url;
		$this->version      = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
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

		/** phpcs:ignore
		 *  wp_enqueue_style( $this->one_time_url, plugin_dir_url( __FILE__ ) . 'css/one-time-url-public.css', array(), $this->version, 'all' );
		 */

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		/** phpcs:ignore
		 *  wp_enqueue_script( $this->one_time_url, plugin_dir_url( __FILE__ ) . 'js/one-time-url-public.js', array( 'jquery' ), $this->version, false );
		 */
	}

	/**
	 * Register Shorcode 'otu_iframe'
	 *
	 * @since    1.0.0
	 */
	public function register_filters() {
		add_shortcode( 'otu_iframe', array( $this, 'otu_shortcode_iframe' ), 1, 2 );
		add_shortcode( 'otu', array( $this, 'otu_shortcode' ), 1, 2 );
		//add_action( 'init', array( $this, 'mce_otu_iframe_init' ) );

	}

	/**
	 * Shorcode otu_iframe
	 *
	 * @since    1.0.0
	 *
	 * @param array  $params  Other Params, currently null.
	 * @param string $content Content between tags.
	 */
	public function otu_shortcode_iframe( $params, $content ) {
		if ( get_current_user_id() ) {
			global $wpdb;
			$table = $wpdb->prefix . 'otu_mapping';
			$uuid4 = Uuid::uuid4();

			$data = array(
				'url'     => $content,
				'uuid'    => (string) $uuid4,
				'referer' => get_permalink( get_the_ID() ),
				'user_id' => get_current_user_id(),
				'time'    => gmdate( 'Y-m-d H:i:s' ),
			);
			if ( $params ) {
				$output = implode(
					', ',
					array_map(
						function ( $v, $k ) {
							return sprintf( "%s='%s'", $k, $v );
						},
						$params,
						array_keys( $params )
					)
				);
			}
			// phpcs:ignore
			$wpdb->insert( $table, $data );
			include_once 'partials/one-time-url-public-iframe-display.php';
		}

	}
	/**
	 * Shorcode otu
	 *
	 * @since    1.0.0
	 *
	 * @param array  $params  Other Params, currently null.
	 * @param string $content Content between tags.
	 */
	public function otu_shortcode( $params, $content ) {
		global $wp_embed;
		global $wpdb;
		$table = $wpdb->prefix . 'otu_mapping';
		$uuid4 = Uuid::uuid4();

		$data   = array(
			'url'     => $content,
			'uuid'    => (string) $uuid4,
			'referer' => get_permalink( get_the_ID() ),
			'user_id' => get_current_user_id(),
			'time'    => gmdate( 'Y-m-d H:i:s' ),
		);
		if ( $params ) {
			$output = implode(
				', ',
				array_map(
					function ( $v, $k ) {
						return sprintf( "%s='%s'", $k, $v );
					},
					$params,
					array_keys( $params )
				)
			);
		}
		//phpcs:ignore
		$wpdb->insert( $table, $data );
		$content = 'https://turk-flix.local/wp-content/plugins/OneTimeUrl/download2.php?uuid=' . $uuid4;
		return '<video controls ' . $output . ' >
		<source src="' . $content . '" type="video/mp4">
		</video>';
	}
	/**
	 * Add tinymce filter
	 *
	 * @since    1.0.0
	 */
	public function mce_otu_iframe_init() {
		add_filter( 'mce_external_plugins', array( $this, 'add_mce_plugin' ) );
	}

	/**
	 * Add tinyMCE plugin
	 *
	 * @since    1.0.0
	 *
	 * @param array $plugin_array Plugin Array.
	 */
	public function add_mce_plugin( $plugin_array ) {
		$plugin_array['xbbcode']    = plugins_url() . '/OneTimeUrl/public/js/xbbcode.js';
		$plugin_array['otu_plugin'] = plugins_url() . '/OneTimeUrl/public/js/otu_iframe_plugin.js';
		return $plugin_array;
	}
}
