<?php
// This function will create the main FE plugin page on activation
function apf_add_plugin_main_page() {
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Add Product Frontend' ),
      'post_name' => 'add-product-frontend',
      'post_content'  => '',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
    );
    $the_page_id = wp_insert_post( $my_post );
    delete_option( 'apf_plugin_page_id' );
    add_option( 'apf_plugin_page_id', $the_page_id );

    // On plugin activation, set the default template
    add_option( 'apf_plugin_template', 'apf-wc-standard-template' );
}
register_activation_hook( RAC_NS_PLUGIN_DIR.'ns-apf-home.php', 'apf_add_plugin_main_page');


// This function will delete the main FE plugin page on deactivation
function apf_plugin_remove_main_page() {
    global $wpdb;
    $the_page_id = get_option( 'apf_plugin_page_id' );
    if( $the_page_id ) {
        wp_delete_post( $the_page_id );
    }
    delete_option("apf_plugin_page_id");
    delete_option("apf_plugin_default_product_status");
    delete_option("apf_plugin_template");
}
register_deactivation_hook( RAC_NS_PLUGIN_DIR.'ns-apf-home.php', 'apf_plugin_remove_main_page');
?>