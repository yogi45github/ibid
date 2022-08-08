<?php
/**
 * Auction bid
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
if(!(method_exists( $product, 'get_type') && $product->get_type() == 'auction')){
	return;
}
global $redux, $ibid_redux;
$current_user = wp_get_current_user();
$product_id =  $product->get_id();
$user_max_bid = $product->get_user_max_bid($product_id ,$current_user->ID );
$max_min_bid_text = $product->get_auction_type() == 'reverse' ? __( 'Your min bid is', 'ibid' ) : __( 'Your max bid is', 'ibid' );
$gmt_offset = get_option('gmt_offset') > 0 ? '+'.get_option('gmt_offset') : get_option('gmt_offset')

?>
	
<p class="auction-condition"><?php echo apply_filters('conditiond_text', __( 'Item condition:', 'ibid' ), $product); ?><span class="curent-bid"> <?php  echo esc_attr($product->get_condition(),'ibid' )  ?></span></p>

<?php if(($product->is_closed() === FALSE ) and ($product->is_started() === TRUE )) : ?>			
		
	<div class="auction-time" id="countdown"><?php echo apply_filters('time_text', __( 'Time left:', 'ibid' ), $product_id); ?> 
		<div class="main-auction auction-time-countdown" data-time="<?php echo esc_attr($product->get_seconds_remaining()) ?>" data-auctionid="<?php echo esc_attr($product_id) ?>" data-format="<?php echo get_option( 'simple_auctions_countdown_format' ) ?>"></div>
	</div>

	<div class='auction-ajax-change' >
	    
		<p class="auction-end"><?php echo apply_filters('time_left_text', __( 'Auction ends:', 'ibid' ), $product); ?> <?php echo  date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() ));  ?>  <?php echo  date_i18n( get_option( 'time_format' ),  strtotime( $product->get_auction_end_time() ));  ?> <br />
			<?php printf(__('Timezone: %s','ibid') , get_option('timezone_string') ? get_option('timezone_string') : __('UTC ','ibid').$gmt_offset) ?>
		</p>

		<?php if ($product->get_auction_sealed() != 'yes'){ ?>
		    <p class="auction-bid"><?php echo esc_url($product->get_price_html()) ?> </p>
			
			<?php if(($product->is_reserved() === TRUE) &&( $product->is_reserve_met() === FALSE )  ) : ?>
				<p class="reserve hold"  data-auction-id="<?php echo esc_attr( $product_id ); ?>" ><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo apply_filters('reserve_bid_text', __( "Reserve price has not been met", 'ibid' )); ?></p>
			<?php endif; ?>	
			
			<?php if(($product->is_reserved() === TRUE) &&( $product->is_reserve_met() === TRUE )  ) : ?>
				<p class="reserve free"  data-auction-id="<?php echo esc_attr( $product_id ); ?>"><?php echo apply_filters('reserve_met_bid_text', __( "Reserve price has been met", 'ibid' )); ?></p>
			<?php endif; ?>
		<?php } elseif($product->get_auction_sealed() == 'yes'){?>
				<p class="sealed-text"><?php echo apply_filters('sealed_bid_text', __( "This auction is <a href='#'>sealed</a>.", 'ibid' )); ?>
					<span class='sealed-bid-desc' style="display:none;"><?php echo esc_attr( "In this type of auction all bidders simultaneously submit sealed bids so that no bidder knows the bid of any other participant. The highest bidder pays the price they submitted. If two bids with same value are placed for auction the one which was placed first wins the auction.", 'ibid' ) ?></span>
				</p>
				<?php 
				if (!empty($product->get_auction_start_price())) {?>
					<?php if($product->get_auction_type() == 'reverse' ) : ?>
							<p class="sealed-min-text"><?php echo apply_filters('sealed_min_text', sprintf(__( "Maximum bid for this auction is %s.", 'ibid' ), wc_price($product ->get_auction_start_price()))); ?></p>
					<?php else : ?>
							<p class="sealed-min-text"><?php echo apply_filters('sealed_min_text', sprintf(__( "Minimum bid for this auction is %s.", 'ibid' ), wc_price($product ->get_auction_start_price()))); ?></p>			
					<?php endif; ?>			
				<?php } ?>	
		<?php } ?>	

		<?php if($product->get_auction_type() == 'reverse' ) : ?>
			<p class="reverse"><?php echo apply_filters('reverse_auction_text', __( "This is reverse auction.", 'ibid' )); ?></p>
		<?php endif; ?>	
		<?php if ($product->get_auction_sealed() != 'yes'){ ?>
			<?php if ($product->get_auction_proxy() &&  $product->get_auction_max_current_bider() && get_current_user_id() == $product->get_auction_max_current_bider()) {?>

				<p class="max-bid"><?php  echo esc_attr( $max_min_bid_text , 'ibid' ) ?> <?php echo wc_price($product->get_auction_max_bid()) ?>
			<?php } ?>
		<?php } elseif($user_max_bid > 0){ ?>
			<p class="max-bid"><?php  echo esc_attr( $max_min_bid_text , 'ibid' ) ?> <?php echo wc_price($user_max_bid) ?>
		<?php } ?>	
		<?php do_action('woocommerce_before_bid_form'); ?>
		<form class="auction_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo esc_attr($product_id); ?>">
			
			<?php do_action('woocommerce_before_bid_button'); ?>
			
			<input type="hidden" name="bid" value="<?php echo esc_attr( $product_id ); ?>" />	
			<?php if($product->get_auction_type() == 'reverse' ) : ?>
				<div class="quantity buttons_added">
					<input type="button" value="+" class="plus" />	
					<input type="number" name="bid_value" data-auction-id="<?php echo esc_attr( $product_id ); ?>"  <?php if ($product->get_auction_sealed() != 'yes'){ ?> value="<?php echo esc_attr($product->bid_value()) ?>" max="<?php echo esc_attr($product->bid_value())  ?>"  <?php } ?> step="any" size="<?php echo strlen($product->get_curent_bid())+2 ?>" title="bid"  class="input-text  qty bid text left">
					<input type="button" value="-" class="minus" />
				</div>
				<?php if($ibid_redux['ibid_layout_version'] == 'project') { ?>	
				 	<button type="submit" class="bid_button button alt"><?php echo esc_attr__('Place Bid', 'ibid'); ?></button>
				<?php } else { ?>
					<button type="submit" data-tooltip="<?php echo esc_attr__('Bid Now', 'ibid'); ?>" class="bid_button button alt"><i class="fa fa-gavel"></i></button>
				<?php } ?>		
			<?php else : ?>	
			<?php 
		        $meta_auction_bid_increment = 'any';
			    if (null !== get_post_meta( get_the_ID(), '_auction_bid_increment', true )) {
			        $meta_auction_bid_increment = get_post_meta( get_the_ID(), '_auction_bid_increment', true );
			    }
			?>	
				<div class="quantity buttons_added">
					<input type="button" value="-" class="minus" />
					<?php if(ibid_redux('ibid_single_auction_price_bid_box_currency') != false) { ?>
						<?php if(get_option( 'woocommerce_currency_pos' ) != '' && get_option( 'woocommerce_currency_pos' ) == 'left') { ?>
							<div class="ibid-woo-symbol">
								<?php echo get_woocommerce_currency_symbol(); ?>
							</div>
						<?php } ?>
					<?php } ?>
					<input type="number" name="bid_value" data-auction-id="<?php echo esc_attr( $product_id ); ?>" <?php if ($product->get_auction_sealed() != 'yes'){ ?>  value="<?php echo esc_attr($product->bid_value())  ?>" min="<?php echo esc_attr($product->bid_value())  ?>" <?php } ?>  step="<?php echo esc_attr($meta_auction_bid_increment); ?>" size="<?php echo strlen($product->get_curent_bid())+2 ?>" title="bid"  class="input-text qty  bid text left">
					<?php if(ibid_redux('ibid_single_auction_price_bid_box_currency') != false) { ?>
						<?php if(get_option( 'woocommerce_currency_pos' ) != '' && get_option( 'woocommerce_currency_pos' ) == 'right') { ?>
							<div class="ibid-woo-symbol">
								<?php echo get_woocommerce_currency_symbol(); ?>
							</div>
						<?php } ?>
					<?php } ?>
				 	<input type="button" value="+" class="plus" />		 	
				</div>	
		 	<?php if($ibid_redux['ibid_layout_version'] == 'project') { ?>	
				 	<button type="submit" class="bid_button button alt"><?php echo esc_attr__('Place Bid', 'ibid'); ?></button>
				<?php } else { ?>
					<button type="submit" data-tooltip="<?php echo esc_attr__('Bid Now', 'ibid'); ?>" class="bid_button button alt"><i class="fa fa-gavel"></i></button>
				<?php } ?>
		 	<?php endif; ?>
		 	
		 	<input type="hidden" name="place-bid" value="<?php echo esc_attr($product_id); ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $product_id ); ?>" />
			<?php if ( is_user_logged_in() ) { ?>
				<input type="hidden" name="user_id" value="<?php echo  get_current_user_id(); ?>" />
			<?php  } ?> 
			<?php do_action('woocommerce_after_bid_button'); ?>
		</form>
		
				
		<?php do_action('woocommerce_after_bid_form'); ?>
		
		
	</div>			 	

<?php elseif (($product->is_closed() === FALSE ) and ($product->is_started() === FALSE )):?>
	
	<div class="auction-time future" id="countdown"><?php echo apply_filters('auction_starts_text', __( 'Auction starts in:', 'ibid' ), $product); ?> 
		<div class="auction-time-countdown future" data-time="<?php echo esc_attr($product->get_seconds_to_auction()) ?>" data-format="<?php echo get_option( 'simple_auctions_countdown_format' ) ?>"></div>
	</div>
	
	<p class="auction-starts"><?php echo apply_filters('time_text', __( 'Auction starts:', 'ibid' ), $product_id); ?> <?php echo  date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_start_time() ));  ?>  <?php echo  date_i18n( get_option( 'time_format' ),  strtotime( $product->get_auction_start_time() ));  ?></p>
	<p class="auction-end"><?php echo apply_filters('time_text', __( 'Auction ends:', 'ibid' ), $product_id); ?> <?php echo  date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() ));  ?>  <?php echo  date_i18n( get_option( 'time_format' ),  strtotime( $product->get_auction_end_time() ));  ?> </p>
	
<?php endif; ?>