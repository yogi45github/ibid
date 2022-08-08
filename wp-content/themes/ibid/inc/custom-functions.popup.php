<?php
/*
 File name:          Custom Popup
*/

defined( 'ABSPATH' ) || exit;

if ( !function_exists( 'ibid_popup_modal' ) ) {
    function ibid_popup_modal() { 
        // REDUX VARIABLE
        global $ibid_redux;
        $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
        echo'<div class="popup modeltheme-modal" id="modal-log-in" data-expire="'.esc_attr($ibid_redux['ibid-enable-popup-expire-date']).'" show="'.esc_attr($ibid_redux['ibid-enable-popup-show-time']).'">
            
            <div class="mt-popup-wrapper col-md-12" id="popup-modal-wrapper">
                <div class="dismiss">
                <a id="exit-popup"></a>
            </div>
                <div class="mt-popup-image col-md-4">
                    <img src="'.esc_url($ibid_redux['ibid-enable-popup-img']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />
                </div>
                <div class="mt-popup-content col-md-8 text-center">
                    <img src="'.esc_url($ibid_redux['ibid-enable-popup-company']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
                    if($ibid_redux['ibid-enable-popup-desc']) {
                        echo '<p class="mt-popup-desc">'.$ibid_redux['ibid-enable-popup-desc'].'</p>';
                    }
                    echo '<p class="mt-popup-desc">'.do_shortcode(''.$ibid_redux["ibid-enable-popup-form"].'').'</p>';
                    if($ibid_redux['ibid-enable-popup-additional'] == false) {
                        echo '<p class="mt-additional">'.esc_html__('Already a member?','ibid').' <a href="'.esc_url($user_url).'">'.esc_html__('Log In.','ibid').'</a></p>';
                    }
                echo '</div>          
            </div>
        </div>';
    }
}