<?php
// Saving async simple product
add_action( 'wp_ajax_save_simple_product', 'save_simple_product' );
add_action( 'wp_ajax_nopriv_save_simple_product', 'save_simple_product' );
function save_simple_product() {
    check_ajax_referer( 'ns-apf-special-string', 'security' );
    
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $values = array();
    foreach ($_POST['formdata'] as $form_elem) {
        if($form_elem['value']) {
            $values[$form_elem['name']] = $form_elem['value'];
        }
    }

    $is_virtual        = $values['is_virtual'];
    $is_on_sale        = $values['is_on_sale'];
    $product           = new WC_Product();

    if(trim($values['name']) == '') {
        $error = new WP_Error( '001', 'Product name is required and cannot be blank.' );       
        wp_send_json_error( $error );
        die();
    }

    $product->set_props( array (
        'name'               => $values['name'],
        'featured'           => $values['featured'],
        'catalog_visibility' => $values['catalog_visibility'],
        'description'        => $values['apf_description_editor'],
        'short_description'  => $values['apf_excerpt_editor'],
        'sku'                => $values['sku'],
        'regular_price'      => $values['regular_price'],
        'sale_price'         => $values['sale_price'],
        'date_on_sale_from'  => '',
        'date_on_sale_to'    => '',
        'total_sales'        => 0,
        'tax_status'         => $values['tax_status'],
        'tax_class'          => $values['tax_class'],
        'manage_stock'       => $values['manage_stock'] == 'on' ? true : false,
        'stock_quantity'     => $values['apf_stock'], // Stock quantity or null
        'stock_status'       => $values['stock_status'],
        'backorders'         => $values['apf_backorders'],
        'low_stock_amount'   => $values['apf_low_stock_amount'],
        'sold_individually'  => $values['sold_individually'] == 'on' ? true : false,
        'weight'             => $is_virtual ? '' : $values['weight'],
        'length'             => $is_virtual ? '' : $values['length'],
        'width'              => $is_virtual ? '' : $values['width'],
        'height'             => $is_virtual ? '' : $values['height'],
        'upsell_ids'         => $values['upsell_ids'],
        'cross_sell_ids'     => $values['crossell_ids'],
        'parent_id'          => $values['parent_id'],
        'reviews_allowed'    => $values['reviews_allowed'] == 'on' ? true : false,
        'purchase_note'      => $values['purchase_note'],
        'menu_order'         => $values['menu_order'],
        'virtual'            => $values['virtual'],
        'downloadable'       => $values['downloadable'],
        'category_ids'       => $values['category_ids'],
        'tag_ids'            => $values['tag_ids'],
        'shipping_class_id'  => $values['shipping_class'],
        'image_id'           => $values['apf_product_image'],
        'gallery_image_ids'  => $values['apf_product_gallery_ids'],
    ) );
    // https://docs.woocommerce.com/wc-apidocs/class-WC_Product.html CTRL+F 'data'

    // Custom attributes
    $cus_attributes = array();
    foreach ($_POST['custom_attributes'] as $key => $value) {
        if($value) {
            $cus_attribute = new WC_Product_Attribute();
            $cus_attribute->set_id(0);
            $cus_attribute->set_name($key);
            $cus_attribute->set_options(explode ("|", $value['val']));
            $cus_attribute->set_position(0);
            $cus_attribute->set_visible($value['visibility'] == 'on' ? true : false );
            array_push ($cus_attributes, $cus_attribute);
        }
    }

    $product->set_attributes( $cus_attributes );

    // Categories
    $product->set_category_ids($_POST['categories']);

    // Tags
    if($values['apf_tags']) {
        $exploded_tags = explode(",", $values['apf_tags']);
        $all_tags = array();
        foreach ($exploded_tags as $tag) {
            $res = wp_insert_term(
                $tag,
                'product_tag'
            );
            if ( is_wp_error( $res ) ) {
                if($res->errors['term_exists']) {
                    array_push($all_tags, $res->error_data['term_exists']);
                }
            }
            else {
                array_push($all_tags, $res['term_id']);
            }
            
        }
        if(!empty($all_tags)) {
            $product->set_tag_ids($all_tags);
        }
    }

    // Get the user selected default status and update it to product
    $user_selected_prod_status = get_option('apf_plugin_default_product_status', 'publish');
    $product->set_status( $user_selected_prod_status );

    $pid = $product->save();
    
    // Attributes
    foreach ($_POST['attributes'] as $key => $value) {
        if($value) {
            wp_set_object_terms( $pid, intval($value['val']), $key, true );

            $att = Array($key => Array(
                'name'=> $key,
                'value'=> intval($value['val']),
                'is_visible' => $value['visibility'] == 'on' ? '1' : '0' ,
                'is_taxonomy' => '1'
              ));
              $prev = get_post_meta($pid, '_product_attributes', true);
              if($prev) {
                update_post_meta( $pid, '_product_attributes',  array_merge($prev,$att));
              }
              else {
                update_post_meta( $pid, '_product_attributes',  $att);
              }
             
        }
    }

    if ( is_wp_error( $pid ) ) {
        $response_array['status'] = 'ko';
        $response_array['description'] = 'Something went wrong during the saving of this product.';    
        wp_send_json_error( $response_array );
        die();
    }

    $response_array['status'] = 'ok';
    $response_array['prod_name'] = $product->get_title();
    $response_array['prod_id'] = $pid;
    $response_array['permalink'] = get_permalink( $product->get_id() );
    wp_send_json_success($response_array);
	die();
}
?>