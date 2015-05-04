<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wordpress.org/plugins/genesis-post-info-meta
 * @since      1.0.0
 *
 * @package    Genesis_Post_Info_Meta
 * @subpackage Genesis_Post_Info_Meta/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Genesis_Post_Info_Meta
 * @subpackage Genesis_Post_Info_Meta/public
 * @author     MIGHTYminnow Web Studio & School info@mightyminnow.com
 */
class Genesis_Post_Info_Meta_Public {

	/**
	 * The main plugin instance.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Genesis_Post_Info_Meta    $plugin    The main plugin instance.
	 */
	private $plugin;

	/**
	 * The slug of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_slug    The slug of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The display name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The plugin display name.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The instance of this class.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Genesis_Post_Info_Meta_Public    $instance    The instance of this class.
	 */
	private static $instance = null;

	/**
     * Creates or returns an instance of this class.
     *
     * @return    Genesis_Post_Info_Meta_Public    A single instance of this class.
     */
    public static function get_instance( $plugin ) {

        if ( null == self::$instance ) {
            self::$instance = new self( $plugin );
        }

        return self::$instance;

    }

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_slug    The name of the plugin.
	 * @var      string    $version        The version of this plugin.
	 */
	public function __construct( $plugin ) {

		$this->plugin = $plugin;
		$this->plugin_slug = $this->plugin->get( 'slug' );
		$this->plugin_name = $this->plugin->get( 'name' );
		$this->version = $this->plugin->get( 'version' );

	}

	/**
	 * Remove post info/meta as specified.
	 *
	 * @since    1.0.0
	 */
	public function maybe_remove_post_info_meta() {

		// Only proceed if we're on the front end and in the loop.
		if ( is_admin() || ! in_the_loop() ) {
			return;
		}

		global $post;

		// Get post type.
		$post_type = get_post_type( $post->ID );

		// Get plugin option.
		$plugin_option = get_option( $this->plugin_slug );

		// Single
		if ( is_singular() ) {

			$show_info = $plugin_option[ $post_type . '_info_single' ];
			$show_meta = $plugin_option[ $post_type . '_meta_single' ];

			// Post Info
			if ( ! $show_info ) {
				remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
			}

			// Post Meta
			if ( ! $show_meta ) {
				remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
			}

		}

		// Archive
		if ( ! is_singular() ) {

			$show_info = $plugin_option[ $post_type . '_info_archive' ];
			$show_meta = $plugin_option[ $post_type . '_meta_archive' ];

			// Post Info
			if ( ! $show_info ) {
				remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
			}

			// Post Meta
			if ( ! $show_meta ) {
				remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
			}

		}

	}

}
