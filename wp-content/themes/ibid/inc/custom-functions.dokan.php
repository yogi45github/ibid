<?php
defined( 'ABSPATH' ) || exit;

/**
* Template Products
*
* For displaying the single edit product view.
*
* @since 1.1
*
* @package ibid
*/
class IBID_Dokan_Template_Products extends Dokan_Template_Products{
   /**
    * __construct()
    */
    function __construct()
    {
        remove_action( 'template_redirect', array( $this, 'handle_product_update' ), 11 );
        add_action( 'template_redirect', array( $this, 'ibid_handle_product_update' ), 11);
    }

    /**
     * Handle product update
     *
     * @return void
     */
    public function ibid_handle_product_update() {

        if ( ! is_user_logged_in() ) {
            return;
        }

        if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
            return;
        }

        if ( ! isset( $_POST['dokan_update_product'] ) ) {
            return;
        }

        $postdata = wp_unslash( $_POST );

        if ( ! wp_verify_nonce( sanitize_key( $postdata['dokan_edit_product_nonce'] ), 'dokan_edit_product' ) ) {
            return;
        }

        $errors     = array();
        $post_title = sanitize_text_field( $postdata['post_title'] );

        if ( empty( $post_title ) ) {
            $errors[] = __( 'Please enter product title', 'ibid' );
        }

        if ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'single' ) {
            $product_cat = absint( $postdata['product_cat'] );

            if ( $product_cat < 0 ) {
                $errors[] = __( 'Please select a category', 'ibid' );
            }

        } else {
            if ( ! isset( $postdata['product_cat'] ) && empty( $postdata['product_cat'] ) ) {
                $errors[] = __( 'Please select AT LEAST ONE category', 'ibid' );
            }
        }

        $post_id = isset( $postdata['dokan_product_id'] ) ? absint( $postdata['dokan_product_id'] ) : 0;

        if ( ! $post_id ) {
            $errors[] = __( 'No product found!', 'ibid' );
        }

        if ( ! dokan_is_product_author( $post_id ) ) {
            $errors[] = __( 'I swear this is not your product!', 'ibid' );
        }

        self::$errors = apply_filters( 'dokan_can_edit_product', $errors );

        if ( !self::$errors ) {
            $product_info = apply_filters( 'dokan_update_product_post_data', array(
                'ID'             => $post_id,
                'post_title'     => $post_title,
                'post_content'   => wp_kses_post( $postdata['post_content'] ),
                'post_excerpt'   => wp_kses_post( $postdata['post_excerpt'] ),
                'post_status'    => isset( $postdata['post_status'] ) ? sanitize_text_field( $postdata['post_status'] ) : 'pending',
                'comment_status' => isset( $postdata['_enable_reviews'] ) ? 'open' : 'closed',
            ) );

            wp_update_post( $product_info );

            /** Set Product tags */
            if ( isset( $postdata['product_tag'] ) ) {
                $tags_ids = array_map( 'absint', (array) $postdata['product_tag'] );
            } else {
                $tags_ids = array();
            }

            wp_set_object_terms( $post_id, $tags_ids, 'product_tag' );

            /** set product category * */
            if ( 'single' == dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) ) {
                wp_set_object_terms( $post_id, (int) $postdata['product_cat'], 'product_cat' );
            } else {
                if ( isset( $postdata['product_cat'] ) && ! empty( $postdata['product_cat'] ) ) {
                    $cat_ids = array_map( 'absint', (array) $postdata['product_cat'] );
                    wp_set_object_terms( $post_id, $cat_ids, 'product_cat' );
                }
            }

            //set prodcuct type default is simple
            $product_type = empty( $postdata['product_type'] ) ? 'simple' : sanitize_text_field( $postdata['product_type'] );
            wp_set_object_terms( $post_id, $product_type, 'product_type' );

            if(isset($postdata['_auction'])){
                wp_set_object_terms( $post_id, 'auction', 'product_type' );
            }
            if(isset($postdata['_auction_item_condition'])){
                update_post_meta( $post_id, '_auction_item_condition', $postdata['_auction_item_condition'] );
            }
            if(isset($postdata['_auction_type'])){
                update_post_meta( $post_id, '_auction_type', $postdata['_auction_type'] );
            }
            if(isset($postdata['_auction_proxy'])){
                update_post_meta( $post_id, '_auction_proxy', 'yes' );
            }else{
                update_post_meta( $post_id, '_auction_proxy', 'no' );
            }
            if(isset($postdata['_auction_sealed'])){
                update_post_meta( $post_id, '_auction_sealed', 'yes' );
            }else{
                update_post_meta( $post_id, '_auction_sealed', 'no' );
            }
            if(isset($postdata['_auction_start_price'])){
                update_post_meta( $post_id, '_auction_start_price', $postdata['_auction_start_price'] );
            }
            if(isset($postdata['_auction_bid_increment'])){
                update_post_meta( $post_id, '_auction_bid_increment', $postdata['_auction_bid_increment'] );
            }
            if(isset($postdata['_auction_reserved_price'])){
                update_post_meta( $post_id, '_auction_reserved_price', $postdata['_auction_reserved_price'] );
            }
            if(isset($postdata['_regular_price'])){
                update_post_meta( $post_id, '_regular_price', $postdata['_regular_price'] );
            }
            if(isset($postdata['_regular_price'])){
                update_post_meta( $post_id, '_price', $postdata['_price'] );
            }
            if(isset($postdata['_auction_dates_from'])){
                update_post_meta( $post_id, '_auction_dates_from', $postdata['_auction_dates_from'] );
            }
            if(isset($postdata['_auction_dates_to'])){
                update_post_meta( $post_id, '_auction_dates_to', $postdata['_auction_dates_to'] );
            }

            // RELIST OPTIONS
            if(isset($postdata['_auction_automatic_relist'])){
                update_post_meta( $post_id, '_auction_automatic_relist', 'yes' );
            }else{
                update_post_meta( $post_id, '_auction_automatic_relist', 'no' );
            }
            if(isset($postdata['_auction_relist_fail_time'])){
                update_post_meta( $post_id, '_auction_relist_fail_time', $postdata['_auction_relist_fail_time'] );
            }
            if(isset($postdata['_auction_relist_not_paid_time'])){
                update_post_meta( $post_id, '_auction_relist_not_paid_time', $postdata['_auction_relist_not_paid_time'] );
            }
            if(isset($postdata['_auction_relist_duration'])){
                update_post_meta( $post_id, '_auction_relist_duration', $postdata['_auction_relist_duration'] );
            }
            //CHARITY META
            if(isset($postdata['product_cause'])){
                update_post_meta( $post_id, 'product_cause', $postdata['product_cause'] );
            }
            //PDF Attach
            if(isset($postdata['ibid_pdf_attach'])){
                update_post_meta( $post_id, 'ibid_pdf_attach', $postdata['ibid_pdf_attach'] );
            }
            
            /**  Process all variation products meta */
            dokan_process_product_meta( $post_id, $postdata );

            /** set images **/
            $featured_image = absint( $postdata['feat_image_id'] );

            if ( $featured_image ) {
                set_post_thumbnail( $post_id, $featured_image );
            } else {
                delete_post_thumbnail( $post_id );
            }

            do_action( 'dokan_product_updated', $post_id, $postdata );


            $redirect = apply_filters( 'dokan_add_new_product_redirect', dokan_edit_product_url( $post_id ), $post_id );

            // if any error inside dokan_process_product_meta function
            global $woocommerce_errors;

            if ( $woocommerce_errors ) {
                wp_redirect( add_query_arg( array( 'errors' => array_map( 'urlencode', $woocommerce_errors ) ), $redirect ) );
                exit;
            }

            wp_redirect( add_query_arg( array( 'message' => 'success' ), $redirect ) );
            exit;
        }
    }
}
new IBID_Dokan_Template_Products();

