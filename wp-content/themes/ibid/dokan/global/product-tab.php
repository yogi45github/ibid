<?php
/**
 * Dokan Seller Single product tab Template
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<?php
global $ibid_redux;

if(class_exists('Mt_Freelancer_Mode')) {
    if ((get_option("freelancer_enabled") == "yes") ) {
        do_action('mtfb_change_role_placeholder');
    } else { ?>
        <h2><?php echo esc_html('The Vendor','ibid')?></h2>
    <?php } 
} else { ?>
    <h2><?php echo esc_html('The Vendor','ibid')?></h2>
<?php } ?>

<ul class="list-unstyled">
    <?php do_action( 'dokan_product_seller_tab_start', $author, $store_info ); ?>

    <?php if ( !empty( $store_info['store_name'] ) ) { ?>
        <li class="store-name">
            <span><?php esc_html_e( 'Store Name:', 'ibid' ); ?></span>
            <span class="details">
                <?php echo esc_html( $store_info['store_name'] ); ?>
            </span>
        </li>
    <?php } ?>

    <li class="seller-name">
        <span>
            <?php esc_html_e( 'Vendor:', 'ibid' ); ?>
        </span>

        <span class="details">
            <?php printf( '<a href="%s">%s</a>', esc_url( dokan_get_store_url( $author->ID ) ), esc_attr( $author->display_name ) ); ?>
        </span>
    </li>
    <?php if ( ! dokan_is_vendor_info_hidden( 'address' ) && ! empty( $store_info['address'] ) ) { ?>
        <li class="store-address">
            <span><b><?php esc_html_e( 'Address:', 'ibid' ); ?></b></span>
            <span class="details">
                <?php echo wp_kses_post( dokan_get_seller_address( $author->ID ) ) ?>
            </span>
        </li>
    <?php } ?>

    <li class="clearfix">
        <?php echo wp_kses_post( dokan_get_readable_seller_rating( $author->ID ) ); ?>
    </li>

    <?php do_action( 'dokan_product_seller_tab_end', $author, $store_info ); ?>
</ul>
