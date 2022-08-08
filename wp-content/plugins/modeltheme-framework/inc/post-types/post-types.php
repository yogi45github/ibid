<?php

/**
 * Custom Post Type [Testimonial]
 */
function ibid_testimonial_custom_post() {
    register_post_type('testimonial', array(
                        'label' => __('Testimonials','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'testimonial', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-format-status',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Testimonials','modeltheme'),
                            'singular_name' => __('Testimonial','modeltheme'),
                            'menu_name' => __('MT Testimonials','modeltheme'),
                            'add_new' => __('Add Testimonial','modeltheme'),
                            'add_new_item' => __('Add New Testimonial','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Testimonial','modeltheme'),
                            'new_item' => __('New Testimonial','modeltheme'),
                            'view' => __('View Testimonial','modeltheme'),
                            'view_item' => __('View Testimonial','modeltheme'),
                            'search_items' => __('Search Testimonials','modeltheme'),
                            'not_found' => __('No Testimonials Found','modeltheme'),
                            'not_found_in_trash' => __('No Testimonials Found in Trash','modeltheme'),
                            'parent' => __('Parent Testimonial','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'ibid_testimonial_custom_post');


/**

||-> CPT - [member]

*/
function smartowl_members_custom_post() {

    register_post_type('member', array(
                        'label' => __('Members','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'member', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-businessman',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Members','modeltheme'),
                            'singular_name' => __('Member','modeltheme'),
                            'menu_name' => __('MT Members','modeltheme'),
                            'add_new' => __('Add Member','modeltheme'),
                            'add_new_item' => __('Add New Member','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Member','modeltheme'),
                            'new_item' => __('New Member','modeltheme'),
                            'view' => __('View Member','modeltheme'),
                            'view_item' => __('View Member','modeltheme'),
                            'search_items' => __('Search Members','modeltheme'),
                            'not_found' => __('No Members Found','modeltheme'),
                            'not_found_in_trash' => __('No Members Found in Trash','modeltheme'),
                            'parent' => __('Parent Member','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'smartowl_members_custom_post');


/**

||-> CPT - [member]

*/
function smartowl_members_category_custom_post() {
    
    $labels = array(
        'name'                       => _x( 'Categories', 'Taxonomy General Name', 'modeltheme' ),
        'singular_name'              => _x( 'Members', 'Taxonomy Singular Name', 'modeltheme' ),
        'menu_name'                  => __( 'Members Categories', 'modeltheme' ),
        'all_items'                  => __( 'All Items', 'modeltheme' ),
        'parent_item'                => __( 'Parent Item', 'modeltheme' ),
        'parent_item_colon'          => __( 'Parent Item:', 'modeltheme' ),
        'new_item_name'              => __( 'New Item Name', 'modeltheme' ),
        'add_new_item'               => __( 'Add New Item', 'modeltheme' ),
        'edit_item'                  => __( 'Edit Item', 'modeltheme' ),
        'update_item'                => __( 'Update Item', 'modeltheme' ),
        'view_item'                  => __( 'View Item', 'modeltheme' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'modeltheme' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'modeltheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'modeltheme' ),
        'popular_items'              => __( 'Popular Items', 'modeltheme' ),
        'search_items'               => __( 'Search Items', 'modeltheme' ),
        'not_found'                  => __( 'Not Found', 'modeltheme' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'mt-member-category', array( 'member' ), $args );
}
add_action( 'init', 'smartowl_members_category_custom_post' );

/**
 * Custom Post Type [Causes]
 */

function ibid_cause_custom_post() {
    global $ibid_redux;
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
            register_post_type('cause', array(
                        'label' => __('MT Charity Causes','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'cause', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-format-status',
                        'supports' => array('title','editor','thumbnail','author','excerpt','comments'),
                        'labels' => array (
                            'name' => __('Causes','modeltheme'),
                            'singular_name' => __('Cause','modeltheme'),
                            'menu_name' => __('MT Charity Causes','modeltheme'),
                            'add_new' => __('Add Cause','modeltheme'),
                            'add_new_item' => __('Add New Cause','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Cause','modeltheme'),
                            'new_item' => __('New Cause','modeltheme'),
                            'view' => __('View Cause','modeltheme'),
                            'view_item' => __('View Cause','modeltheme'),
                            'search_items' => __('Search Causes','modeltheme'),
                            'not_found' => __('No Causes Found','modeltheme'),
                            'not_found_in_trash' => __('No Causes Found in Trash','modeltheme'),
                            'parent' => __('Parent Cause','modeltheme'),
                            )
                        ) 
                    ); 
        }
    }
}
add_action('init', 'ibid_cause_custom_post');

?>