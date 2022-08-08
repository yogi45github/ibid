<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://modeltheme.com
 * @since      1.0.0
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/includes
 * @author     ModelTheme <support@modeltheme.com>
 */
class Mt_Freelancer_Mode {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mt_Freelancer_Mode_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/*************************************************************
	 * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
	 *
	 * @tutorial access_plugin_admin_public_methodes_from_inside.php
	 */
	/**
	 * Store plugin main class to allow public access.
	 *
	 * @since    20180622
	 * @var object      The main class.
	 */
	public $main;
	
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MT_FREELANCER_MODE_VERSION' ) ) {
			$this->version = MT_FREELANCER_MODE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mt-freelancer-mode';
		$this->main = $this;
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mt_Freelancer_Mode_Loader. Orchestrates the hooks of the plugin.
	 * - Mt_Freelancer_Mode_i18n. Defines internationalization functionality.
	 * - Mt_Freelancer_Mode_Admin. Defines all hooks for the admin area.
	 * - Mt_Freelancer_Mode_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mt-freelancer-mode-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mt-freelancer-mode-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mt-freelancer-mode-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mt-freelancer-mode-public.php';

		$this->loader = new Mt_Freelancer_Mode_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mt_Freelancer_Mode_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mt_Freelancer_Mode_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mt_Freelancer_Mode_Admin( $this->get_plugin_name(), $this->get_version(), $this->main );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings');
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu_page');
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_submenu_pages');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Mt_Freelancer_Mode_Public( $this->get_plugin_name(), $this->get_version(), $this->main );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		if ((get_option("freelancer_enabled") == "yes")) {
			$this->loader->add_action( 'woocommerce_edit_account_form_start', $plugin_public, 'mtfm_profile_freelancer_user');
			$this->loader->add_action( 'woocommerce_edit_account_form', $plugin_public, 'mtfm_add_job_pos_to_edit_account_form');
			$this->loader->add_action( 'woocommerce_save_account_details', $plugin_public, 'mtfm_save_job_pos_account_details');
			$this->loader->add_action( 'mt_before_dashboard', $plugin_public, 'mtfm_my_freelancer_profile');
			$this->loader->add_action( 'mtfb_change_role_placeholder', $plugin_public, 'mtfm_change_role_placeholder');
			$this->loader->add_action( 'init', $plugin_public, 'mtfm_vc_shortcodes' );
			$this->loader->add_action( 'woocommerce_before_bid_button', $plugin_public, 'mtfm_custom_add_coment_textarea_on_bid');
			$this->loader->add_action( 'woocommerce_simple_auction_admin_history_header', $plugin_public,'mtfm_add_note_woocommerce_simple_auction_admin_history_header');
			$this->loader->add_action( 'woocommerce_simple_auctions_log_bid', $plugin_public, 'mtfm_custom_save_comment_on_bid', 10, 4);
			$this->loader->add_action( 'woocommerce_simple_auction_admin_history_row', $plugin_public,'mtfm_add_note_woocommerce_simple_auction_admin_history_row',10,2);
			$this->loader->add_action( 'mtfm_breadcrumb', $plugin_public, 'mtfm_breadcrumb' );

		   	$this->loader->add_shortcode('mtfm_projects_list', $plugin_public, 'mtfm_projects_list_shortcode');
		   	$this->loader->add_shortcode('mtfm_custom_categories_short', $plugin_public, 'mtfm_custom_categories');

		   	$this->loader->add_filter('theme_page_templates', $plugin_public, 'add_new_template');
		   	$this->loader->add_filter('wp_insert_post_data', $plugin_public, 'register_project_templates');
		   	$this->loader->add_filter('template_include', $plugin_public, 'view_project_template');
		  	$this->loader->add_filter('get_product_search_form', $plugin_public, 'mtfm_custom_product_searchform');
		  	$this->loader->add_filter('woocommerce_simple_auctions_before_place_bid_filter', $plugin_public, 'mtfm_check_if_there_is_note_on_bid');
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}
	
	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mt_Freelancer_Mode_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
