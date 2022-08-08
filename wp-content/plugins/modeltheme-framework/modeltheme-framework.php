<?php
/**
* Plugin Name: ModelTheme Framework
* Plugin URI: http://modeltheme.com/
* Description: ModelTheme Framework required by the iBid Theme.
* Version: 3.1
* Author: ModelTheme
* Author http://modeltheme.com/
* Text Domain: modeltheme
* Last Plugin Update: 22-APR-2021
*/
$plugin_dir = plugin_dir_path( __FILE__ );


// CMB METABOXES
function modeltheme_cmb_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once ('init.php');
}
add_action( 'init', 'modeltheme_cmb_initialize_cmb_meta_boxes', 9999 );


function modeltheme_load_textdomain(){
    $domain = 'modeltheme';
    load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'modeltheme_load_textdomain' );


/**

||-> Function: modeltheme_framework()

*/
function modeltheme_framework() {
    // SCRIPTS
    wp_enqueue_script( 'js-mt-plugins', plugin_dir_url( __FILE__ ) . 'js/mt-plugins.js', array(), '1.0.0', true );
    wp_enqueue_script( 'filters-main', plugin_dir_url( __FILE__ ) . 'js/filters-main.js', array(), '1.0.0', true );
    wp_enqueue_script( 'filters-mixitup.min', plugin_dir_url( __FILE__ ) . 'js/filters-mixitup.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'flipclock', plugin_dir_url( __FILE__ ) . 'js/mt-coundown-version2/flipclock.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'map-pins', plugin_dir_url( __FILE__ ) . 'js/map-pins.js', array(), '1.0.0', true );
    wp_enqueue_script( 'tabs-custom', plugin_dir_url( __FILE__ ) . 'js/tabs-custom.js', array(), '1.0.0', true );
    wp_enqueue_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'js/mt-video/jquery.magnific-popup.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'modeltheme_framework' );


/**
||-> Function: modeltheme_enqueue_admin_scripts()
*/
function modeltheme_enqueue_admin_scripts( $hook ) {
    // CSS
    wp_register_style( 'modelteme-framework-admin-style',  plugin_dir_url( __FILE__ ) . 'css/modelteme-framework-admin-style.css' );
    wp_enqueue_style( 'modelteme-framework-admin-style' );
    // JS
    wp_enqueue_script( 'js-modeltheme-admin-custom', plugin_dir_url( __FILE__ ) . 'js/modeltheme-custom-admin.js', array(), '1.0.0', true );
    
}
add_action('admin_enqueue_scripts', 'modeltheme_enqueue_admin_scripts');

function ibid_RemoveDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'ibid_RemoveDemoModeLink');

// Remove the demo link and the notice of integrated demo from the redux-framework plugin
 function remove_demo() {

    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if (class_exists('ReduxFrameworkPlugin')) {
       remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
    }
    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
    remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
}

// WIDGETS
require_once('inc/widgets/widgets.php');
// CUSTOM FUNCTIONS
require_once('inc/custom.functions.php');
// LOAD METABOXES
require_once('inc/metaboxes/metaboxes.php');
// LOAD POST TYPES
require_once('inc/post-types/post-types.php');
// LOAD SHORTCODES
require_once('inc/shortcodes/shortcodes.php');
// DEMO IMPORTER
require_once('inc/demo-importer-v2/wbc907-plugin-example.php');
// Mega Menu
require_once('inc/mega-menu/modeltheme-mega-menu.php'); // MEGA MENU
// GOOGLE MAPS
require_once('inc/sb-google-maps-vc-addon/sb-google-maps-vc-addon.php'); // GMAPS
//Elementor Widgets
if ( class_exists('Elementor\Core\Admin\Admin') ) {
    require_once('inc/shortcodes/elementor/functions.php');
}

function modeltheme_remove_menu_items() {
    if( !current_user_can( 'administrator' ) ):
        remove_menu_page( 'edit.php?post_type=cf_mega_menu' );
        remove_menu_page( 'edit.php?post_type=member' );
        remove_menu_page( 'edit.php?post_type=testimonial' );
        remove_menu_page( 'edit.php?post_type=shop_order' );
        remove_menu_page( 'admin.php?page=vc-welcome' );
    endif;
}
add_action( 'admin_menu', 'modeltheme_remove_menu_items' );