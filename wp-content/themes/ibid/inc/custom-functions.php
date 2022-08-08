<?php
defined( 'ABSPATH' ) || exit;

// Logo Source
if (!function_exists('ibid_logo_source')) {
    function ibid_logo_source(){
        
        // REDUX VARIABLE
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        // Metaboxes
        $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
        $mt_metabox_header_logo = get_post_meta( get_the_ID(), 'ibid_metabox_header_logo', true );
        if (is_page()) {
            if (isset($mt_custom_header_options_status) && isset($mt_metabox_header_logo) && $mt_custom_header_options_status == 'yes') {
                $html .='<img src="'.esc_url($mt_metabox_header_logo).'" alt="'.esc_attr(get_bloginfo()).'" />';
            }else{
                if(!empty($ibid_redux['ibid_logo']['url'])){
                    $html .='<img src="'.esc_url($ibid_redux['ibid_logo']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
                }else{ 
                    $html .= $ibid_redux['ibid_logo_text'];
                }
            }
        }else{
            if(!empty($ibid_redux['ibid_logo']['url'])){
                $html .='<img src="'.esc_url($ibid_redux['ibid_logo']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
            }elseif(isset($ibid_redux['ibid_logo_text'])){ 
                $html .= $ibid_redux['ibid_logo_text'];
            }else{
                $html .= esc_html(get_bloginfo());
            }
        }
        return $html; 
    }
}
// Logo Area
if (!function_exists('ibid_logo')) {
    function ibid_logo(){
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        $html .='<h1 class="logo logo-image">';
            $html .='<a href="'.esc_url(get_site_url()).'">';
                $html .= ibid_logo_source();
            $html .='</a>';
        $html .='</h1>';
        return $html;
        // REDUX VARIABLE
     } else {
        global $ibid_redux;
        // html VARIABLE
        $html = '';
        $html .='<h1 class="logo logo-h">';
            $html .='<a href="'.esc_url(get_site_url()).'">';
                $html .= esc_html(get_bloginfo());
            $html .='</a>';
        $html .='</h1>';
        return $html;
     } 
    }
}
// Add specific CSS class by filter
if (!function_exists('ibid_body_classes')) {
    function ibid_body_classes( $classes ) {
        global  $ibid_redux;
        $plugin_redux_status = '';
        if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {
            $plugin_redux_status = 'missing-redux-framework';
        }
        $plugin_modeltheme_status = '';
        if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {
            $plugin_modeltheme_status = 'missing-modeltheme-framework';
        }
        // CHECK IF FEATURED IMAGE IS FALSE(Disabled)
        $post_featured_image = '';
        if (is_single()) {
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                if ($ibid_redux['post_featured_image'] == false) {
                    $post_featured_image = 'hide_post_featured_image';
                }else{
                    $post_featured_image = '';
                }
            }
        }
        // CHECK IF THE NAV IS STICKY
        $is_nav_sticky = '';
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if ($ibid_redux['is_nav_sticky'] == true) {
                // If is sticky
                $is_nav_sticky = 'is_nav_sticky';
            }else{
                // If is not sticky
                $is_nav_sticky = '';
            }
        }
        // CHECK IF THE NAV IS STICKY
        $is_category_menu = '';
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if ($ibid_redux['ibid_header_category_menu_mobile'] == true) {
                // If is sticky
                $is_category_menu = 'is_category_menu';
            }else{
                // If is not sticky
                $is_category_menu = '';
            }
        }
        // DIFFERENT HEADER LAYOUT TEMPLATES
        $header_version = 'first_header';
        if (is_page()) {
            $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
            $mt_header_custom_variant = get_post_meta( get_the_ID(), 'ibid_header_custom_variant', true );
            $header_version = 'first_header';
            if (isset($mt_custom_header_options_status) AND $mt_custom_header_options_status == 'yes') {
                if ($mt_header_custom_variant == '1') {
                    // Header Layout #1
                    $header_version = 'first_header';
                }elseif ($mt_header_custom_variant == '2') {
                    // Header Layout #2
                    $header_version = 'second_header';
                }elseif ($mt_header_custom_variant == '3') {
                    // Header Layout #3
                    $header_version = 'third_header';
                }elseif ($mt_header_custom_variant == '4') {
                    // Header Layout #4
                    $header_version = 'fourth_header';
                }elseif ($mt_header_custom_variant == '5') {
                    // Header Layout #5
                    $header_version = 'fifth_header';
                }elseif ($mt_header_custom_variant == '6') {
                    // Header Layout #6
                    $header_version = 'sixth_header';
                }elseif ($mt_header_custom_variant == '7') {
                    // Header Layout #7
                    $header_version = 'seventh_header';
                }elseif ($mt_header_custom_variant == '8') {
                    // Header Layout #8
                    $header_version = 'eighth_header';
                }else{
                    // if no header layout selected show header layout #1
                    $header_version = 'first_header';
                }
            }else{
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    if ($ibid_redux['header_layout'] == 'first_header') {
                        // Header Layout #1
                        $header_version = 'first_header';
                    }elseif ($ibid_redux['header_layout'] == 'second_header') {
                        // Header Layout #2
                        $header_version = 'second_header';
                    }elseif ($ibid_redux['header_layout'] == 'third_header') {
                        // Header Layout #3
                        $header_version = 'third_header';
                    }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        $header_version = 'fourth_header';
                    }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                        // Header Layout #5
                        $header_version = 'fifth_header';
                    }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                        // Header Layout #6
                        $header_version = 'sixth_header';
                    }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #7
                        $header_version = 'seventh_header';
                    }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                        // Header Layout #8
                        $header_version = 'eighth_header';
                    }else{
                        // if no header layout selected show header layout #1
                        $header_version = 'first_header';
                    }
                }
            }
        }else{
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                if ($ibid_redux['header_layout'] == 'first_header') {
                    // Header Layout #1
                    $header_version = 'first_header';
                }elseif ($ibid_redux['header_layout'] == 'second_header') {
                    // Header Layout #2
                    $header_version = 'second_header';
                }elseif ($ibid_redux['header_layout'] == 'third_header') {
                    // Header Layout #3
                    $header_version = 'third_header';
                }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                    // Header Layout #4
                    $header_version = 'fourth_header';
                }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                    // Header Layout #5
                    $header_version = 'fifth_header';
                }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                    // Header Layout #6
                    $header_version = 'sixth_header';
                }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                    // Header Layout #7
                    $header_version = 'seventh_header';
                }elseif ($ibid_redux['header_layout'] == 'eighth_header') {
                    // Header Layout #8
                    $header_version = 'eighth_header';
                }else{
                    // if no header layout selected show header layout #1
                    $header_version = 'first_header';
                }
            }
        }

        $wc_vendors_status = '';
        if (class_exists('WC_Vendors')) {
            $wc_vendors_status = 'wc_vendors_active';
        }


        $mt_footer_row1 = '';
        $mt_footer_row2 = '';
        $mt_footer_row3 = '';
        $mt_footer_row4 = '';
        $mt_footer_bottom = '';
        
        $mt_footer_row1_status = get_post_meta( get_the_ID(), 'mt_footer_row1_status', true );
        $mt_footer_row2_status = get_post_meta( get_the_ID(), 'mt_footer_row2_status', true );
        $mt_footer_row3_status = get_post_meta( get_the_ID(), 'mt_footer_row3_status', true );
        $mt_footer_bottom_bar = get_post_meta( get_the_ID(), 'mt_footer_bottom_bar', true );

        if (isset($mt_footer_row1_status) && !empty($mt_footer_row1_status)) {
            $mt_footer_row1 = 'hide-footer-row-1';
        }
        if (isset($mt_footer_row2_status) && !empty($mt_footer_row2_status)) {
            $mt_footer_row2 = 'hide-footer-row-2';
        }
        if (isset($mt_footer_row3_status) && !empty($mt_footer_row3_status)) {
            $mt_footer_row3 = 'hide-footer-row-3';
        }
        if (isset($mt_footer_bottom_bar) && !empty($mt_footer_bottom_bar)) {
            $mt_footer_bottom = 'hide-footer-bottom';
        }


        $classes[] = esc_attr($mt_footer_row1) . ' ' . esc_attr($mt_footer_row2) . ' ' . esc_attr($mt_footer_row3) . ' ' . esc_attr($mt_footer_bottom) . ' ' . esc_attr($wc_vendors_status) . ' ' . esc_attr($plugin_modeltheme_status) . ' ' . esc_attr($plugin_redux_status) . ' ' . esc_attr($is_nav_sticky) . ' ' . esc_attr($is_category_menu) . ' ' . esc_attr($header_version) . ' ' . esc_attr($post_featured_image) . ' ';

        return $classes;
    }
    add_filter( 'body_class', 'ibid_body_classes' );
}


// Mobile Dropdown Menu Button
if (!function_exists('ibid_burger_dropdown_button')) {
    function ibid_burger_dropdown_button(){
        if ( !class_exists( 'mega_main_init' ) ) {
        echo'<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>';
        }
    }
    add_action('ibid_burger_dropdown_button', 'ibid_burger_dropdown_button');
}


// Mobile Burger Aside variant
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ($ibid_redux['ibid_mobile_burger_select'] == 'sidebar') {
        if (!function_exists('ibid_burger_aside_button')) {
            function ibid_burger_aside_button(){
                if ( !class_exists( 'mega_main_init' ) ) { 
                    echo '<button id="aside-menu" type="button" class="navbar-toggle" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>';
                }
            }
        add_action('ibid_before_mobile_navigation_burger', 'ibid_burger_aside_button');
        }
    }
}

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ($ibid_redux['ibid_mobile_burger_select'] == 'sidebar') {
        if (!function_exists('ibid_burger_aside_menu')) {
            function ibid_burger_aside_menu(){

                global $ibid_redux;
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }

                echo'<div class="mt-header">
                        <div class="header-aside">
                            <div class="aside-navbar">
                                <div class="aside-tabs">
                                    <a href="#mt-first-menu">'.esc_html__('Menu','ibid').'</a>
                                    <a href="#mt-second-menu">'.esc_html__('Categories','ibid').'</a>
                                </div>
                                <div class="nav-title">'.esc_html__('Menu','ibid').'</div>
                                    <div class="mt-nav-content">
                                        <div class="mt-first-menu">
                                            <div class="bot_nav_wrap">
                                                <ul class="menu nav navbar-nav pull-left nav-effect nav-menu">';
                                                    if ( has_nav_menu( 'primary' ) ) {
                                                    $defaults = array(
                                                        'menu'            => '',
                                                        'container'       => false,
                                                        'container_class' => '',
                                                        'container_id'    => '',
                                                        'menu_class'      => 'menu',
                                                        'menu_id'         => '',
                                                        'echo'            => true,
                                                        'fallback_cb'     => false,
                                                        'before'          => '',
                                                        'after'           => '',
                                                        'link_before'     => '',
                                                        'link_after'      => '',
                                                        'items_wrap'      => '%3$s',
                                                        'depth'           => 0,
                                                        'walker'          => ''
                                                    );
                                                    $defaults['theme_location'] = 'primary';
                                                    wp_nav_menu( $defaults );
                                                    }else{
                                                    echo '<p class="no-menu text-right">';
                                                        echo esc_html__('Primary navigation menu is missing.', 'ibid');
                                                    echo '</p>';
                                                    }   
                                                echo '</ul>
                                            </div>
                                        </div>
                                        <div class="mt-second-menu">';

                                        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                                        echo'<div class="bot_nav_cat_inner">
                                                <div class="bot_nav_cat">
                                                    <ul class="bot_nav_cat_wrap">';
                                                    if ( has_nav_menu( 'category' ) ) {
                                                        $defaults = array(
                                                            'menu'            => '',
                                                            'container'       => false,
                                                            'container_class' => '',
                                                            'container_id'    => '',
                                                            'menu_class'      => 'menu',
                                                            'menu_id'         => '',
                                                            'echo'            => true,
                                                            'fallback_cb'     => false,
                                                            'before'          => '',
                                                            'after'           => '',
                                                            'link_before'     => '',
                                                            'link_after'      => '',
                                                            'items_wrap'      => '%3$s',
                                                            'depth'           => 0,
                                                            'walker'          => ''
                                                        );
                                                        $defaults['theme_location'] = 'category';
                                                        wp_nav_menu( $defaults );
                                                    }else{
                                                        echo '<p class="no-menu text-right">';
                                                            echo esc_html__('Category navigation menu is missing.', 'ibid');
                                                        echo '</p>';
                                                    }
                                            echo'</ul>
                                            </div>
                                        </div>';
                                       }
                                    echo '</div>
                                    </div>
                                    <div class="aside-footer">';
                                        if (isset($ibid_redux['ibid_top_header_order_tracking_link']) && $ibid_redux['ibid_top_header_order_tracking_link'] != '') {
                                            echo '<a class="top-order" href="'.esc_url($ibid_redux['ibid_top_header_order_tracking_link']).'">
                                                <i class="fa fa-truck"></i>'.esc_html__('Order Tracking', 'ibid').'</a>';
                                        }
                                        if( function_exists( 'YITH_WCWL' ) ){
                                            echo '<a class="top-payment" href="'.esc_url($wishlist_url).'">
                                            <i class="fa fa-heart-o"></i>'.esc_html__('Wishlist', 'ibid').'</a>';
                                        }
                                    echo '</div>
                                </div>
                            </div>
                        </div>';
                echo '<div class="aside-bg"></div>';
            }
    add_action('ibid_after_mobile_navigation_burger', 'ibid_burger_aside_menu');
    }
}}


// Mobile Icons Top Group
if (!function_exists('ibid_header_mobile_icons_group')) {
    function ibid_header_mobile_icons_group(){

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) { 
            if (ibid_redux('ibid_header_mobile_switcher_top') == true) {

                $cart_url = "#";
                if ( class_exists( 'WooCommerce' ) ) {
                    $cart_url = wc_get_cart_url();
                }
                #YITH Wishlist rul
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }

                if (ibid_redux('ibid_header_mobile_switcher_top_search') == true) {
                    echo '<div class="mobile_only_icon_group search">
                                <a href="#" class="mt-search-icon">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </div>';
                }
                if (ibid_redux('ibid_header_mobile_switcher_top_cart') == true) {
                    echo '<div class="mobile_only_icon_group cart">
                                <a  href="' .esc_url($cart_url).'">
                                    <i class="fa fa-shopping-basket"></i>
                                </a>
                            </div>';
                }
                if (ibid_redux('ibid_header_mobile_switcher_top_wishlist') == true) {
                    echo '<div class="mobile_only_icon_group wishlist">
                                <a class="top-payment" href="'.esc_url($wishlist_url).'">
                                  <i class="fa fa-heart-o"></i>
                                </a>
                            </div>';
                }

                if(ibid_redux('is_popup_enabled') == true) {
                    if (is_user_logged_in() || is_account_page()) {
                        $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                        $data_attributes = '';
                    }else{
                        $user_url = '#';
                        $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
                    }
                }else{
                    $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                    $data_attributes = '';
                }

                if (ibid_redux('ibid_header_mobile_switcher_top_account') == true) {
                    echo '<div class="mobile_only_icon_group account">
                                <a href="' .esc_url($user_url). '" '.wp_kses_post($data_attributes).'>
                                    <i class="fa fa-user"></i>
                                </a>
                        </div>';
               }
            }
        }

    }
    add_action('ibid_before_mobile_navigation_burger', 'ibid_header_mobile_icons_group');
}

// Mobile Icons Bottom Group
if (!function_exists('ibid_footer_mobile_icons_group')) {
    function ibid_footer_mobile_icons_group(){

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) { 
            if (ibid_redux('ibid_header_mobile_switcher_footer') == true) {

                $cart_url = "#";
                if ( class_exists( 'WooCommerce' ) ) {
                    $cart_url = wc_get_cart_url();
                }

                #YITH Wishlist rul
                if( function_exists( 'YITH_WCWL' ) ){
                    $wishlist_url = YITH_WCWL()->get_wishlist_url();
                }else{
                    $wishlist_url = '#';
                }
                
                echo '<div class="mobile_footer_icon_wrapper">';
                    if (ibid_redux('ibid_header_mobile_switcher_footer_search') == true) {
                        echo '<div class="col-md-3 search">
                                    <a href="#" class="mt-search-icon">
                                        <i class="fa fa-search" aria-hidden="true"></i>'.esc_html__('Search','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_cart') == true) {
                        echo '<div class="col-md-3 cart">
                                    <a  href="' .esc_url($cart_url). '">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>'.esc_html__('Cart','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_wishlist') == true) {
                        echo '<div class="col-md-3 wishlist">
                                    <a class="top-payment" href="'  .esc_url($wishlist_url).'">
                                      <i class="fa fa-heart-o"></i>'.esc_html__('Wishlist','ibid').'
                                    </a>
                                </div>';
                    }
                    if (ibid_redux('ibid_header_mobile_switcher_footer_account') == true) {

                        if(ibid_redux('is_popup_enabled') == true) {
                            if (is_user_logged_in() || is_account_page()) {
                                $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                                $data_attributes = '';
                            }else{
                                $user_url = '#';
                                $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
                            }
                        }else{
                            $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                            $data_attributes = '';
                        }

                        echo '<div class="col-md-3 account">
                                    <a href="' .esc_url($user_url). '" '.wp_kses_post($data_attributes).'>
                                      <i class="fa fa-user"></i>'.esc_html__('Account','ibid').'
                                    </a>
                                </div>';
                    }
                echo '</div>';
            }
        }
    }
    add_action('ibid_before_footer_mobile_navigation', 'ibid_footer_mobile_icons_group');
}

// Top Header Banner
if (!function_exists('ibid_my_banner_header')) {
 function ibid_my_banner_header() {
    echo '<div class="ibid-top-banner text-center">
                <span class="discount-text">'.ibid_redux('discout_header_text').'</span>
                <div class="text-center row">';
                echo do_shortcode('[shortcode_countdown_v2 insert_date="'.ibid_redux('discout_header_date').'"]');
          echo '</div>
          <a class="button btn" href="'.ibid_redux('discout_header_btn_link').'">'.ibid_redux('discout_header_btn_text').'</a>
          </div>';
}}

//GET HEADER TITLE/BREADCRUMBS AREA
if (!function_exists('ibid_header_title_breadcrumbs')) {
    function ibid_header_title_breadcrumbs(){
        echo '<div class="ibid-breadcrumbs">';
            echo '<div class="container">';
                echo '<div class="row">';

                    if(!function_exists('bcn_display')){
                        echo '<div class="col-md-12">';
                                echo '<ol class="breadcrumb">';
                                    echo ibid_breadcrumb();
                                echo '</ol>';
                        echo '</div>';
                    } else {
                        echo '<div class="col-md-12">';
                                echo '<div class="breadcrumbs breadcrumbs-navxt" typeof="BreadcrumbList" vocab="https://schema.org/">';
                                    echo bcn_display();
                                echo '</div>';
                        echo '</div>';
                    }
                    echo '<div class="col-md-12">';
                        if (is_singular('post')) {
                            echo '<h1>'.get_the_title().'</h1>';
                        }elseif (is_singular('cause')) {
                            echo '<h1>'.get_the_title().'</h1>';    
                        }elseif (is_page()) {
                            echo '<h1>'.get_the_title().'</h1>';
                        }elseif (is_singular('product')) {
                            echo '<h1>'.esc_html__( 'Our Shop', 'ibid' ) . get_search_query().'</h1>';
                        }elseif (is_search()) {
                            echo '<h1>'.esc_html__( 'Search Results for: ', 'ibid' ) . get_search_query().'</h1>';
                        }elseif (is_category()) {
                            echo '<h1>'.esc_html__( 'Category: ', 'ibid' ).' <span>'.single_cat_title( '', false ).'</span></h1>';
                        }elseif (is_tag()) {
                            echo '<h1>'.esc_html__( 'Tag: ', 'ibid' ) . single_tag_title( '', false ).'</h1>';
                        }elseif (is_author() || is_archive()) {
                            if (function_exists("is_shop") && is_shop()) {
                            }else{
                                echo '<h1>'.get_the_archive_title().'</h1>';
                            }
                        }elseif (is_home()) {
                            echo '<h1>'.esc_html__( 'From the Blog', 'ibid' ).'</h1>';
                        }
                        
                    echo'</div>';
                    if (is_singular('cause')) {
                        global $ibid_redux;
                        $cause_goal = get_post_meta( get_the_ID(), 'cause_goal', true );
                            if ($cause_goal) {
                                echo '<div class="col-md-12">';
                                    echo' <h4>'.esc_html__('Goal: ', 'ibid').'</span>'.esc_attr($cause_goal,'ibid').'</h4>';
                                echo'</div>';
                            }
                    }
                echo'</div>';
            echo'</div>';
        echo'</div>';
    }
}


// Mobile Dropdown Menu Button
if (!function_exists('ibid_get_login_link')) {
    function ibid_get_login_link(){

        if(ibid_redux('is_popup_enabled') == true) {
            if (is_user_logged_in() || is_account_page()) {
                $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
                $data_attributes = '';
            }else{
                $user_url = '#';
                $data_attributes = 'data-modal="modal-log-in" class="modeltheme-trigger"';
            }
        }else{
            $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );;
            $data_attributes = '';
        }
        ?>

        <a href="<?php echo esc_url($user_url); ?>" <?php echo $data_attributes; ?>>
            <?php esc_html_e('Sign In','ibid'); ?>
        </a>

        <?php 
    }
    add_action('ibid_login_link_a', 'ibid_get_login_link');
}