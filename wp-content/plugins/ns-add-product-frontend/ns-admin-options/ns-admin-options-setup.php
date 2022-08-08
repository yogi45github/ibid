<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* *** *********************************************************************** *** */
/* *** REMEMBER TO CHANGE $ns_plugin_prefix IN  admin_enqueue_scripts FUNCTION *** */
/* *** *********************************************************************** *** */


/* *** add menu page and add sub menu page *** */
add_action( 'admin_menu', function()  {
    add_menu_page( 'Add Product Frontend', 'Add Product Frontend', 'manage_options', plugin_dir_path( __FILE__ ) .'/ns_admin_option_dashboard.php', '', plugin_dir_url( __FILE__ ).'img/backend-sidebar-icon.png', 60);
});


/* *** *********************************************************************** *** */
/* ***     REMEMBER TO CHANGE FUNCTION NAME WITH THE PREFIX OF THIS PLUGIN     *** */
/* *** *********************************************************************** *** */
/* *** add menu page and add sub menu page *** */
function nsapf_preprocess_pages($value){
    global $pagenow;
    $page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : false);
    if($pagenow=='admin.php' && $page=='how-to-install-premium-version'){
        wp_redirect('https://www.nsthemes.com/how-to-install-the-premium-version/');
        exit;
    }
}
add_action('admin_init', 'nsapf_preprocess_pages');


/* *** add style *** */
add_action( 'admin_enqueue_scripts', function() {
	$ns_plugin_prefix = 'apf';
    wp_enqueue_style('ns-'.$ns_plugin_prefix.'-option-css-a-page', plugin_dir_url( __FILE__ ) . 'css/ns-option-apf-custom-page.css');
    wp_enqueue_script( 'ns-'.$ns_plugin_prefix.'-option-js-page', plugins_url( '/js/ns-option-js-page.js' , __FILE__ ), array( 'jquery' ) );
});

/* *** Frontend scripts *** */
add_action( 'wp_enqueue_scripts', function() {
    $ns_plugin_prefix = 'apf';
    wp_enqueue_script( 'ns-'.$ns_plugin_prefix.'ajax-save-simple-product', plugins_url( '/js/frontend/save-simple-product.js', __FILE__ ), array('jquery') );
    wp_localize_script( 'ns-'.$ns_plugin_prefix.'ajax-save-simple-product', 'savesimpleproduct', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'security' => wp_create_nonce( 'ns-apf-special-string' )));

    wp_enqueue_script( 'ns-'.$ns_plugin_prefix.'ajax-product-attributes', plugins_url( '/js/frontend/product-attributes.js', __FILE__ ), array('jquery') );
    wp_localize_script( 'ns-'.$ns_plugin_prefix.'ajax-product-attributes', 'productattributes', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'security' => wp_create_nonce( 'ns-apf-special-string' )));
});

?>