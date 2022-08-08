<?php 
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wcmp_default_product_types' ) ) {

    function wcmp_default_product_types() {
        return array(
            'simple'   => __( 'Simple product', 'ibid' ),
            'auction'   => __( 'Auction', 'ibid' ),
        );
    }

}

/**
* Add Custom Tab in add product page.
* @author WC Marketplace
* @Version 3.3.0
*/
function add_custom_product_data_tabs( $tabs ) {
   $tabs['advanced'] = array(
       'label'    => __( 'MT Auction Settings', 'ibid' ),
       'target'   => 'custom_tab_product_data',
       'class'    => array(),
       'priority' => 100,
   );
   return $tabs;
}
add_filter( 'wcmp_product_data_tabs', 'add_custom_product_data_tabs' );

/**
* Add Custom Tab content in add product page.
* @author WC Marketplace
* @Version 3.3.0
*/
function add_custom_product_data_content( $pro_class_obj, $product, $post ) {
  $meta_auction_dates_from = get_post_meta( $post->ID, '_auction_dates_from', true );
  $meta_auction_dates_to = get_post_meta( $post->ID, '_auction_dates_to', true );
   ?>
   <div role="tabpanel" class="tab-pane fade" id="custom_tab_product_data"> <!-- just make sure tabpanel id should replace with your added tab target -->
       <div class="row-padding">
           <div class="form-group">
               <label for="_auction_item_condition" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Item condition', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">
                   <select style="" id="_auction_item_condition" name="auction_item_condition" class="select short">
                        <option value="new" selected="selected"><?php echo esc_html__('New', 'ibid') ?></option>
                        <option value="used"><?php echo esc_html__('Used', 'ibid') ?></option>    
                   </select>
               </div>
            </div>
            <div class="form-group">
               <label for="_auction_type" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Auction types', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <select style="" id="_auction_type" name="auction_type" class="select short">
                      <option value="normal" selected="selected"><?php echo esc_html__('Normal', 'ibid') ?></option><option value="reverse"><?php echo esc_html__('Reverse', 'ibid') ?></option>    
                   </select>
               </div>
            </div>
            <div class="form-group">
               <label for="_auction_proxy" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Proxy bidding?', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <select style="" id="_auction_type" name="auction_proxy" class="select short">
                      <option value="normal" selected="selected"><?php echo esc_html__('Normal', 'ibid') ?></option><option value="reverse"><?php echo esc_html__('Reverse', 'ibid') ?></option>    
                   </select>
               </div>
            </div>
            <div class="form-group">
               <label for="_auction_sealed" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Sealed bidding?', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <select style="" id="_auction_type" name="auction_sealed" class="select short">
                      <option value="normal" selected="selected"><?php echo esc_html__('Normal', 'ibid') ?></option><option value="reverse"><?php echo esc_html__('Reverse', 'ibid') ?></option>    
                   </select>
               </div>
            </div>
            <div class="form-group">
               <label for="_auction_start_price" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Start Price', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <input type="text" class="wc_input_price short wc_input_price form-control" style="" name="auction_start_price" id="_auction_start_price" step="any" min="0"> 
               </div>
            </div>
            <div class="form-group">
               <label for=_auction_bid_increment" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Bid incredement', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <input type="text" class="wc_input_price short wc_input_price form-control" style="" name="auction_bid_increment" id="_auction_bid_increment" value="" step="any" min="0">
               </div>
            </div>
            <div class="form-group">
               <label for=_auction_reserved_price" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Reserve price', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <input type="text" class="wc_input_price short wc_input_price form-control" style="" name="auction_reserved_price" id="_auction_reserved_price" value="" step="any" min="0" >
               </div>
            </div>
            <div class="form-group">
               <label for="_regular_price" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Buy it now price', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <input type="text" class="wc_input_price short wc_input_price form-control" style="" name="regular_price" id="_regular_price" value="" >
               </div>
            </div>
            <div class="form-group">
               <label for="_auction_dates_from" class="control-label col-sm-3 col-md-3"><?php echo esc_html__('Auction Dates', 'ibid') ?></label>
               <div class="col-md-9 col-sm-9">           
                   <input type="text" class="form-control ibid_datetime_picker" name="_auction_dates_from" id="_auction_dates_from" value="<?php echo esc_attr($meta_auction_dates_from); ?>" placeholder="From… YYYY-MM-DD HH:MM">
                   <input type="text" class="form-control ibid_datetime_picker" name="_auction_dates_to" id="_auction_dates_to" value="<?php echo esc_attr($meta_auction_dates_to); ?>" placeholder="To… YYYY-MM-DD HH:MM">
               </div>
           </div>
       </div>
   </div>
   <?php
}
add_action( 'wcmp_product_tabs_content', 'add_custom_product_data_content', 10, 3 );

/**
* Save Custom Tab content data.
* @author WC Marketplace
* @Version 3.3.0
*/
function save_custom_product_data( $product, $post_data ) {
   if( isset($post_data['post_ID']) && isset($post_data['auction_item_condition'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_item_condition', $post_data['auction_item_condition']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_type'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_type', $post_data['auction_type']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_type'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_type', $post_data['auction_type']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_proxy'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_proxy', $post_data['auction_proxy']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_sealed'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_sealed', $post_data['auction_sealed']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_start_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_start_price', $post_data['auction_start_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_bid_increment'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_bid_increment', $post_data['auction_bid_increment']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['auction_reserved_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_reserved_price', $post_data['auction_reserved_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['regular_price'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_regular_price', $post_data['regular_price']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['_auction_dates_from'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_dates_from', $post_data['_auction_dates_from']);
   }
   if( isset($post_data['post_ID']) && isset($post_data['_auction_dates_to'])){
       update_post_meta( absint( $post_data['post_ID'] ), '_auction_dates_to', $post_data['_auction_dates_to']);
   }
}
add_action( 'wcmp_process_product_object', 'save_custom_product_data', 10, 2 ); ?>
