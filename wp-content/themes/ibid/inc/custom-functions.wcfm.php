<?php
defined( 'ABSPATH' ) || exit;

/**
* Template Products
*
* Saves the metas for auction settings
*
* @since 1.4
*
* @package ibid
*/
if (!function_exists('ibid_save_auction_metas')) {
    function ibid_save_auction_metas( $new_product_id, $wcfm_products_manage_form_data ) {

        global $WCFM;
        if (!class_exists('WCFMu')){
            if(isset($wcfm_products_manage_form_data['_auction'])){
                wp_set_object_terms( $new_product_id, 'auction', 'product_type' );
            }
            if(isset($wcfm_products_manage_form_data['_auction_item_condition'])){
                update_post_meta( $new_product_id, '_auction_item_condition', $wcfm_products_manage_form_data['_auction_item_condition'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_type'])){
                update_post_meta( $new_product_id, '_auction_type', $wcfm_products_manage_form_data['_auction_type'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_proxy'])){
                update_post_meta( $new_product_id, '_auction_proxy', 'yes' );
            }else{
                update_post_meta( $new_product_id, '_auction_proxy', 'no' );
            }
            if(isset($wcfm_products_manage_form_data['_auction_sealed'])){
                update_post_meta( $new_product_id, '_auction_sealed', 'yes' );
            }else{
                update_post_meta( $new_product_id, '_auction_sealed', 'no' );
            }
            if(isset($wcfm_products_manage_form_data['_auction_start_price'])){
                update_post_meta( $new_product_id, '_auction_start_price', $wcfm_products_manage_form_data['_auction_start_price'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_bid_increment'])){
                update_post_meta( $new_product_id, '_auction_bid_increment', $wcfm_products_manage_form_data['_auction_bid_increment'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_reserved_price'])){
                update_post_meta( $new_product_id, '_auction_reserved_price', $wcfm_products_manage_form_data['_auction_reserved_price'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction'])){
                if(isset($wcfm_products_manage_form_data['_regular_price'])){
                    update_post_meta( $new_product_id, '_regular_price', $wcfm_products_manage_form_data['_regular_price'] );
                }
            }
            if(isset($wcfm_products_manage_form_data['_auction_dates_from'])){
                update_post_meta( $new_product_id, '_auction_dates_from', $wcfm_products_manage_form_data['_auction_dates_from'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_dates_to'])){
                update_post_meta( $new_product_id, '_auction_dates_to', $wcfm_products_manage_form_data['_auction_dates_to'] );
            }


            // RELIST OPTIONS
            if(isset($wcfm_products_manage_form_data['_auction_automatic_relist'])){
                update_post_meta( $new_product_id, '_auction_automatic_relist', 'yes' );
            }else{
                update_post_meta( $new_product_id, '_auction_automatic_relist', 'no' );
            }
            if(isset($wcfm_products_manage_form_data['_auction_relist_fail_time'])){
                update_post_meta( $new_product_id, '_auction_relist_fail_time', $wcfm_products_manage_form_data['_auction_relist_fail_time'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_relist_not_paid_time'])){
                update_post_meta( $new_product_id, '_auction_relist_not_paid_time', $wcfm_products_manage_form_data['_auction_relist_not_paid_time'] );
            }
            if(isset($wcfm_products_manage_form_data['_auction_relist_duration'])){
                update_post_meta( $new_product_id, '_auction_relist_duration', $wcfm_products_manage_form_data['_auction_relist_duration'] );
            }
        }

        //CHARITY META
        if(isset($wcfm_products_manage_form_data['product_cause'])){
            update_post_meta( $new_product_id, 'product_cause', $wcfm_products_manage_form_data['product_cause'] );
        }

        //CHARITY META
        if(isset($wcfm_products_manage_form_data['ibid_pdf_attach'])){
            update_post_meta( $new_product_id, 'ibid_pdf_attach', $wcfm_products_manage_form_data['ibid_pdf_attach'] );
        }   
        

    }
    add_action( 'after_wcfm_products_manage_meta_save', 'ibid_save_auction_metas', 50, 2 );
}
