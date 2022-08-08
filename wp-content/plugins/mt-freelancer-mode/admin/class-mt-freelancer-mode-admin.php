<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://modeltheme.com
 * @since      1.0.0
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/admin
 * @author     ModelTheme <support@modeltheme.com>
 */
class Mt_Freelancer_Mode_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Store plugin main class to allow public access.
	 *
	 * @since    20180622
	 * @access   private
	 * @var object      The main class.
	 */
	private $main;
	// ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_main ) {

		$this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->main = $plugin_main;

    }


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mt_Freelancer_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mt_Freelancer_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mt-freelancer-mode-admin.css', array(), $this->version, 'all' );

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
		 * defined in Mt_Freelancer_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mt_Freelancer_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mt-freelancer-mode-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_menu_page() {
        if ( !empty ( $GLOBALS['admin_page_hooks']['mt_plugins'] ) ) {
            return;
        }

        add_menu_page(
            "MT Plugins", __("MT Plugins", "mt-freelancer-mode"), "NULL", "mt_plugins", array($this, "sc_menu_page"), "", 3611
        );
    }

    public function sc_menu_page() {
	    // do nothing
    }

    public function add_submenu_pages() {
        add_submenu_page(
            "mt_plugins",
             __("MT Freelancer Mode", "mt-freelancer-mode"),
             __("MT Freelancer Mode", "mt-freelancer-mode"),
            "manage_options",
            "mtfm_options",
            array($this, "mtfm_options_page")
        );
    }

    public function mtfm_options_page() {
        $this->save_options();
        ?>
        <div class="wrap">
            <h2><?= __("MT Freelancer Mode Settings", "mt-freelancer-mode") ?></h2>
            <form class="scpotw-settings" method="post">
                <?php settings_fields( "mtfm_settings" ); ?>
                <?php do_settings_sections( "mtfm_settings" ); ?>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    private function save_options() {
        if (isset($_POST["freelancer_enabled"])) {
            update_option("freelancer_enabled", $_POST["freelancer_enabled"]);
        }
        if (isset($_POST["mtfm_enable_styling"])) {
            update_option("mtfm_enable_styling", $_POST["mtfm_enable_styling"]);
        }
    }


    public function render_yesno_field($args) {
        echo '<select id="'. $args['name'] .'" name="'. $args['name'] .'">';
        echo '<option value="no" ' . ($args['value'] == 'no' ? 'selected' : '') . '>' . __('No') . '</option>';
        echo '<option value="yes" ' . ($args['value'] == 'yes' ? 'selected' : '') . '>' . __('Yes') . '</option>';
        echo '</select>';
    }

    public function register_settings() {

        register_setting( "mtfm_settings", "freelancer_enabled" );
        register_setting( "mtfm_settings", "mtfm_enable_styling" );
        add_settings_section(
            "mtfm_settings",
            __("Settings", "mt-freelancer-mode"),
            null,
            "mtfm_settings"
        );

        add_settings_field(
            "freelancer_enabled",
            __("Enable MT Freelancer Mode", "mt-freelancer-mode"),
            array($this, "render_yesno_field"),
            "mtfm_settings",
            "mtfm_settings",
            [
                "name" => "freelancer_enabled",
                "value" => !empty($_POST["freelancer_enabled"]) ? $_POST["freelancer_enabled"] : get_option("freelancer_enabled")
            ]
        );
        
        add_settings_field(
            "mtfm_enable_styling",
            __("Apply Plugin Styling", "mt-freelancer-mode"),
            array($this, "render_yesno_field"),
            "mtfm_settings",
            "mtfm_settings",
            [
                "name" => "mtfm_enable_styling",
                "value" => !empty($_POST["mtfm_enable_styling"]) ? $_POST["mtfm_enable_styling"] : get_option("mtfm_enable_styling")
            ]
        );
    }

}
