<?php
/*
Plugin Name: NS Add product Frontend
Version: 2.0.0
Description: This plugin allow users to insert products from a frontend page
Requires PHP: 5.6
Author: NsThemes
Author URI: https://www.nsthemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-add-product-frontend',
    'main_file_name'            => 'ns-apf-home.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-add-product-frontend%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '205',
    'plugin_token'              => 'NWNmZTNjMjk1ZmVlNGU1YmFhYmJiNTRiY2VhNTk5NzkzZWRlNmY3MTQ4NTEwNzIwMzE4NjI3NGVhZjhlZGY5ZDU1ZTRmNGNjNTgxZjM=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj205 = new pluginEye($plugineye);
$plugineyeobj205->pluginEyeStart();  

if ( ! defined( 'RAC_NS_PLUGIN_DIR' ) )
    define( 'RAC_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'RAC_NS_PLUGIN_DIR_URL' ) )
    define( 'RAC_NS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );


/*========================================================*/
/*						   REQUIRE FILES				  */
/*========================================================*/

/* *** plugin review trigger *** */
require_once( plugin_dir_path( __FILE__ ) .'/inc/class-plugin-theme-review-request.php');

require_once( RAC_NS_PLUGIN_DIR.'ns-apf-options.php');

require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');

require_once( plugin_dir_path( __FILE__ ).'inc/apf-activate-deactivate.php');
require_once( plugin_dir_path( __FILE__ ).'inc/apf-create-product-variations.php');
require_once( plugin_dir_path( __FILE__ ).'inc/apf-print-tooltip.php');
require_once( plugin_dir_path( __FILE__ ).'inc/apf-include-template.php');
require_once( RAC_NS_PLUGIN_DIR.'async/apf-save-simple-product.php');
require_once( RAC_NS_PLUGIN_DIR.'async/apf-product-attributes.php');

/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'apf_add_action_links' );

function apf_add_action_links ( $links ) {	
 $mylinks = array('<a style ="color: #d54e21; font-weight: bold;"id="nswatlinkpremiumlinkpremium" href="https://www.nsthemes.com/product/frontend-add-product/?ref-ns=2&campaign=APF-linkpremium" target="_blank">'.__( 'Premium Version', 'ns-woocommerce-watermark' ).'</a>');
return array_merge( $links, $mylinks );
}