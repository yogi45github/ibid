<?php
/**
 * Auction watchlist link
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;

if(!(method_exists( $product, 'get_type') && $product->get_type() == 'auction')){
	return;
}
$user_id = get_current_user_id();

?>
<p class="wsawl-link">	
    <?php if ($product->is_user_watching()): ?>
    	<a href="<?php echo esc_url("#remove from watchlist"); ?>" data-toggle="tooltip" data-placement="top" data-tooltip="<?php echo esc_attr__('Remove Watchlist', 'ibid'); ?>" data-auction-id="<?php echo esc_attr( $product->get_id() ); ?>" class="remove-wsawl sa-watchlist-action"></a>
    <?php else : ?>
    	<a href="<?php echo esc_url("#add_to_watchlist"); ?>" data-toggle="tooltip" data-placement="top" data-tooltip="<?php echo esc_attr__('Add Watchlist', 'ibid'); ?>" data-auction-id="<?php echo esc_attr( $product->get_id() ); ?>" class="add-wsawl sa-watchlist-action <?php if($user_id == 0) echo " no-action ";?> " title="<?php if($user_id == 0) echo esc_attr('You must be logged in to use watchlist feature', 'ibid'); ;?>"></a>
    <?php endif; ?>	
</p>