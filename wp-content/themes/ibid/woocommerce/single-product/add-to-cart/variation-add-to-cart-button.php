<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input( array(
		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
		'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	) );

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<?php $add_to_cart = ''; ?>
	<?php $add_to_cart_class = ''; ?>
	<?php $add_to_cart_tooltip = 'data-tooltip="'.esc_attr__('Add to cart', 'ibid').'"'; ?>
	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
		<?php if(ibid_redux('ibid_single_product_add_to_cart_btn_style') == 'style_text'){ ?>
			<?php $add_to_cart = esc_html__('Add to cart', 'ibid'); ?>
			<?php $add_to_cart_class = ibid_redux('ibid_single_product_add_to_cart_btn_style'); ?>
			<?php $add_to_cart_tooltip = ''; ?>
		<?php }else{ ?>
			<?php $add_to_cart_class = ibid_redux('ibid_single_product_add_to_cart_btn_style'); ?>
		<?php } ?>
	<?php } ?>

	<button type="submit" <?php echo wp_kses_post($add_to_cart_tooltip); ?> name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt <?php echo esc_attr($add_to_cart_class); ?>"><i class="fa fa-shopping-basket"></i> <?php echo esc_html($add_to_cart); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
