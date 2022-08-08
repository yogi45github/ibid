<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://modeltheme.com
 * @since             1.0.0
 * @package           Mt_Freelancer_Mode
 *
 * @wordpress-plugin
 * Plugin Name:       MT Freelancer Mode for WooCommerce
 * Plugin URI:        https://modeltheme.com/
 * Description:       MT Freelancer Mode for WooCommerce - created by ModelTheme.
 * Version:           1.0.0
 * Author:            ModelTheme
 * Author URI:        https://modeltheme.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mt-freelancer-mode
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
define( 'MT_FREELANCER_MODE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mt-freelancer-mode-activator.php
 */
function activate_mt_freelancer_mode() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mt-freelancer-mode-activator.php';
	Mt_Freelancer_Mode_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mt-freelancer-mode-deactivator.php
 */
function deactivate_mt_freelancer_mode() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mt-freelancer-mode-deactivator.php';
	Mt_Freelancer_Mode_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mt_freelancer_mode' );
register_deactivation_hook( __FILE__, 'deactivate_mt_freelancer_mode' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mt-freelancer-mode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mt_freelancer_mode() {
	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];
	$plugin = new Mt_Freelancer_Mode($version);
	$plugin->run();

	return $plugin;
}


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('woocommerce-simple-auctions/woocommerce-simple-auctions.php') ) && (is_plugin_active('dokan-lite/dokan.php')  ||  is_plugin_active('wc-multivendor-marketplace/wc-multivendor-marketplace.php') ||  is_plugin_active('wc-frontend-manager/wc_frontend_manager.php') ) ){
	$Mt_Freelancer_Mode = run_mt_freelancer_mode();
} else {
	add_action( 'admin_notices', 'mt_freelancer_mode_installed_notice' );
}

function mt_freelancer_mode_installed_notice()
{
	?>
    <div class="error">
      <p><?php _e( 'MT Freelancer Mode requires  WooCommerce, WooCommerce Simple Auctions and a multivendor plugin. Please install or activate them before by checking Appearences > Install Plugins.', 'mt-freelancer-mode'); ?></p>
    </div>
    <?php
}