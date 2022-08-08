<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$add_to_cart_attr = esc_attr__('Add to cart', 'ibid');
$add_to_cart_icon = 'fa-shopping-basket';
if( $product->is_type( 'simple' ) ) {
	$add_to_cart_attr = esc_attr__('Add to cart', 'ibid');
	$add_to_cart_icon = 'fa-shopping-basket';
} elseif( $product->is_type( 'auction' ) ) {
	$add_to_cart_attr = esc_attr__('Bid Now', 'ibid');
	$add_to_cart_icon = 'fa-gavel';
}else{
	$add_to_cart_attr = $product->add_to_cart_text();
	$add_to_cart_icon = 'fa-shopping-basket';
}

$classes = get_post_class();
if (in_array('product-type-auction',$classes)) {
	$meta_auction_closed = get_post_meta( $product->get_id(), '_auction_closed', true );
	if ($meta_auction_closed == '') {
		$add_to_cart_attr = esc_attr__('Bid Now', 'ibid');
		$add_to_cart_icon = 'fa-gavel';
	}else{
		$add_to_cart_attr = esc_attr__('View Auction', 'ibid');
		$add_to_cart_icon = 'fa-eye';
	}
}
echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf( '<a href="%s" data-quantity="%s" data-tooltip="'.esc_attr($add_to_cart_attr).'" class="%s" %s><i class="fa '.esc_attr($add_to_cart_icon).'"></i></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		''
	),
$product, $args );