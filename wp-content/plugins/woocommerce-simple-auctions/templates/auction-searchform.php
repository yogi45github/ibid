<?php  $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
<form role="search" method="get" action="<?php echo $shop_page_url; ?>" class="woocommerce-auction-search">
	<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Auctions&hellip;', 'placeholder', 'wc_simple_auctions' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
	<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
    <input type="hidden" name="search_auctions" value="true" />
</form>