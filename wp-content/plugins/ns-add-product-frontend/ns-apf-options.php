<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ns_apf_activate_set_options()
{
    /*Option page*/
    add_option('apf_plugin_page_id', '');
    add_option('apf_plugin_default_product_status', 'publish');

}

register_activation_hook( __FILE__, 'ns_apf_activate_set_options');



function ns_apf_register_options_group()
{
    /*Option page*/
    register_setting('ns_apf_options_group', 'apf_plugin_page_id'); 
    register_setting('ns_apf_options_group', 'apf_plugin_default_product_status'); 

}
 
add_action ('admin_init', 'ns_apf_register_options_group');

?>