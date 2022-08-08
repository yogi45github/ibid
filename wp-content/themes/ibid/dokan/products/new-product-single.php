<?php

use WeDevs\Dokan\Walkers\CategoryDropdownSingle;
use WeDevs\Dokan\Walkers\TaxonomyDropdown;

global $post;

$from_shortcode = false;

if ( !isset( $post->ID ) && ! isset( $_GET['product_id'] ) ) {
    wp_die( esc_html__( 'Access Denied, No product found', 'ibid' ) );
}

if ( isset( $post->ID ) && $post->ID && 'product' == $post->post_type ) {
    $post_id      = $post->ID;
    $post_title   = $post->post_title;
    $post_content = $post->post_content;
    $post_excerpt = $post->post_excerpt;
    $post_status  = $post->post_status;
    $product      = wc_get_product( $post_id );
}

if ( isset( $_GET['product_id'] ) ) {
    $post_id        = intval( $_GET['product_id'] );
    $post           = get_post( $post_id );
    $post_title     = $post->post_title;
    $post_content   = $post->post_content;
    $post_excerpt   = $post->post_excerpt;
    $post_status    = $post->post_status;
    $product        = wc_get_product( $post_id );
    $from_shortcode = true;
}

if ( ! dokan_is_product_author( $post_id ) ) {
    wp_die( esc_html__( 'Access Denied', 'ibid' ) );
    exit();
}

$_regular_price         = get_post_meta( $post_id, '_regular_price', true );
$_sale_price            = get_post_meta( $post_id, '_sale_price', true );
$is_discount            = !empty( $_sale_price ) ? true : false;
$_sale_price_dates_from = get_post_meta( $post_id, '_sale_price_dates_from', true );
$_sale_price_dates_to   = get_post_meta( $post_id, '_sale_price_dates_to', true );

$_sale_price_dates_from = !empty( $_sale_price_dates_from ) ? date_i18n( 'Y-m-d', $_sale_price_dates_from ) : '';
$_sale_price_dates_to   = !empty( $_sale_price_dates_to ) ? date_i18n( 'Y-m-d', $_sale_price_dates_to ) : '';
$show_schedule          = false;

if ( !empty( $_sale_price_dates_from ) && !empty( $_sale_price_dates_to ) ) {
    $show_schedule = true;
}

$_featured        = get_post_meta( $post_id, '_featured', true );
$terms            = wp_get_object_terms( $post_id, 'product_type' );
$product_type     = ( ! empty( $terms ) ) ? sanitize_title( current( $terms )->name ): 'simple';
$variations_class = ($product_type == 'simple' ) ? 'dokan-hide' : '';
$_visibility      = ( version_compare( WC_VERSION, '2.7', '>' ) ) ? $product->get_catalog_visibility() : get_post_meta( $post_id, '_visibility', true );

if ( ! $from_shortcode ) {
    get_header();
}

if ( ! empty( $_GET['errors'] ) ) {
    Dokan_Template_Products::$errors = $_GET['errors'];
}

/**
 *  dokan_dashboard_wrap_before hook
 *
 *  @since 2.4
 */
do_action( 'dokan_dashboard_wrap_before', $post, $post_id );
?>


<?php do_action( 'dokan_dashboard_wrap_start' ); ?>

    <div class="dokan-dashboard-wrap container">

        <?php

            /**
             *  dokan_dashboard_content_before hook
             *  dokan_before_product_content_area hook
             *
             *  @hooked get_dashboard_side_navigation
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_before' );
            do_action( 'dokan_before_product_content_area' );
        ?>

        <div class="dokan-dashboard-content dokan-product-edit">

            <?php

                /**
                 *  dokan_product_content_inside_area_before hook
                 *
                 *  @since 2.4
                 */
                do_action( 'dokan_product_content_inside_area_before' );
            ?>

            <header class="dokan-dashboard-header dokan-clearfix">
                <h1 class="entry-title">
                    <?php esc_html_e( 'Edit Product', 'ibid' ); ?>
                    <span class="dokan-label <?php echo esc_attr( dokan_get_post_status_label_class( $post->post_status ) ); ?> dokan-product-status-label">
                        <?php echo esc_html( dokan_get_post_status( $post->post_status ) ); ?>
                    </span>

                    <?php if ( $post->post_status == 'publish' ) { ?>
                        <span class="dokan-right">
                            <a class="dokan-btn dokan-btn-theme dokan-btn-sm" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" target="_blank"><?php esc_html_e( 'View Product', 'ibid' ); ?></a>
                        </span>
                    <?php } ?>

                    <?php if ( $_visibility == 'hidden' ) { ?>
                        <span class="dokan-right dokan-label dokan-label-default dokan-product-hidden-label"><i class="fa fa-eye-slash"></i> <?php esc_html_e( 'Hidden', 'ibid' ); ?></span>
                    <?php } ?>
                </h1>
            </header><!-- .entry-header -->

            <div class="product-edit-new-container product-edit-container">
                <?php if ( Dokan_Template_Products::$errors ) { ?>
                    <div class="dokan-alert dokan-alert-danger">
                        <a class="dokan-close" data-dismiss="alert">&times;</a>

                        <?php foreach ( Dokan_Template_Products::$errors as $error) { ?>
                            <strong><?php esc_html_e( 'Error!', 'ibid' ); ?></strong> <?php echo esc_html( $error ) ?>.<br>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ( isset( $_GET['message'] ) && $_GET['message'] == 'success') { ?>
                    <div class="dokan-message">
                        <button type="button" class="dokan-close" data-dismiss="alert">&times;</button>
                        <strong><?php esc_html_e( 'Success!', 'ibid' ); ?></strong> <?php esc_html_e( 'The product has been saved successfully.', 'ibid' ); ?>

                        <?php if ( $post->post_status == 'publish' ) { ?>
                            <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" target="_blank"><?php esc_html_e( 'View Product &rarr;', 'ibid' ); ?></a>
                        <?php } ?>
                    </div>

                <?php } ?>

                <?php
                $can_sell = apply_filters( 'dokan_can_post', true );

                if ( $can_sell ) {

                    if ( dokan_is_seller_enabled( get_current_user_id() ) ) { ?>
                        <form class="dokan-product-edit-form" role="form" method="post">

                            <?php do_action( 'dokan_product_data_panel_tabs' ); ?>
                            <?php do_action( 'dokan_product_edit_before_main' ); ?>

                            <div class="dokan-form-top-area">

                                <div class="content-half-part dokan-product-meta">

                                    <div class="dokan-form-group">
                                        <input type="hidden" name="dokan_product_id" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>

                                        <label for="post_title" class="form-label"><?php esc_html_e( 'Title', 'ibid' ); ?></label>
                                        <?php dokan_post_input_box( $post_id, 'post_title', array( 'placeholder' => __( 'Product name..', 'ibid' ), 'value' => $post_title ) ); ?>
                                        <div class="dokan-product-title-alert dokan-hide">
                                            <?php esc_html_e( 'Please enter product title!', 'ibid' ); ?>
                                        </div>
                                    </div>

                                    <?php $product_types = apply_filters( 'dokan_product_types', 'simple' ); ?>

                                    <?php if( 'simple' === $product_types ): ?>
                                            <input type="hidden" id="product_type" name="product_type" value="simple">
                                    <?php endif; ?>

                                    <?php if ( is_array( $product_types ) ): ?>
                                        <div class="dokan-form-group">
                                            <label for="product_type" class="form-label"><?php esc_html_e( 'Product Type', 'ibid' ); ?> <i class="fa fa-question-circle tips" aria-hidden="true" data-title="<?php esc_html_e( 'Choose Variable if your product has multiple attributes - like sizes, colors, quality etc', 'ibid' ); ?>"></i></label>
                                            <select name="product_type" class="dokan-form-control" id="product_type">
                                                <?php foreach ( $product_types as $key => $value ) { ?>
                                                    <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $product_type, $key ) ?>><?php echo esc_html( $value ) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <?php do_action( 'dokan_product_edit_after_title', $post, $post_id ); ?>

                                    <?php
                                    $_product = wc_get_product( $post_id );
                                    ?>
                                    <div class="content-half-part auction-checkbox">
                                        <label>
                                            <input type="checkbox" <?php if( $_product->is_type( 'auction' ) ) {echo esc_attr__('checked', 'ibid');} ?> class="ibid_is_auction _is_auction" name="_auction" id="_auction"> <?php esc_html_e( 'Auction', 'ibid' ); ?> <i class="fa fa-question-circle tips" aria-hidden="true" data-title="<?php esc_attr_e( 'Enable Auction for the current product', 'ibid' ); ?>"></i>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="show_if_simple dokan-clearfix">

                                        <div class="dokan-form-group dokan-clearfix dokan-price-container">

                                            <div class="content-half-part regular-price">
                                                <label for="_regular_price" class="form-label"><?php esc_html_e( 'Price', 'ibid' ); ?>
                                                    <span
                                                        class="vendor-earning simple-product"
                                                        data-commission="<?php echo esc_attr( dokan()->commission->get_earning_by_product( $post_id ) ); ?>"
                                                        data-product-id="<?php echo esc_attr( $post_id ); ?>">
                                                            ( <?php esc_html_e( ' You Earn : ', 'ibid' ) ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?>
                                                                <span class="vendor-price">
                                                                    <?php echo esc_attr( dokan()->commission->get_earning_by_product( $post_id ) ); ?>
                                                                </span>
                                                            )
                                                    </span>
                                                </label>
                                                <div class="dokan-input-group">
                                                    <span class="dokan-input-group-addon"><?php echo esc_html( get_woocommerce_currency_symbol() ); ?></span>
                                                    <?php dokan_post_input_box( $post_id, '_regular_price', array( 'class' => 'dokan-product-regular-price', 'placeholder' => __( '0.00', 'ibid' ) ), 'number' ); ?>
                                                </div>
                                            </div>

                                            <div class="content-half-part sale-price">
                                                <label for="_sale_price" class="form-label">
                                                    <?php esc_html_e( 'Discounted Price', 'ibid' ); ?>
                                                    <a href="#" class="sale_schedule <?php echo (esc_attr($show_schedule) ) ? 'dokan-hide' : ''; ?>"><?php esc_html_e( 'Schedule', 'ibid' ); ?></a>
                                                    <a href="#" class="cancel_sale_schedule <?php echo ( ! $show_schedule ) ? 'dokan-hide' : ''; ?>"><?php esc_html_e( 'Cancel', 'ibid' ); ?></a>
                                                </label>

                                                <div class="dokan-input-group">
                                                    <span class="dokan-input-group-addon"><?php echo esc_html( get_woocommerce_currency_symbol() ); ?></span>
                                                    <?php dokan_post_input_box( $post_id, '_sale_price', array( 'class' => 'dokan-product-sales-price','placeholder' => __( '0.00', 'ibid' ) ), 'number' ); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dokan-form-group dokan-clearfix dokan-price-container">
                                            <div class="dokan-product-less-price-alert dokan-hide">
                                                <?php esc_html_e('Product price can\'t be less than the vendor fee!', 'ibid' ); ?>
                                            </div>
                                        </div>

                                        <div class="sale_price_dates_fields dokan-clearfix dokan-form-group <?php echo ( ! $show_schedule ) ? 'dokan-hide' : ''; ?>">
                                            <div class="content-half-part from">
                                                <div class="dokan-input-group">
                                                    <span class="dokan-input-group-addon"><?php esc_html_e( 'From', 'ibid' ); ?></span>
                                                    <input type="text" name="_sale_price_dates_from" class="dokan-form-control datepicker" value="<?php echo esc_attr( $_sale_price_dates_from ); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="<?php esc_html_e( 'YYYY-MM-DD', 'ibid' ); ?>">
                                                </div>
                                            </div>

                                            <div class="content-half-part to">
                                                <div class="dokan-input-group">
                                                    <span class="dokan-input-group-addon"><?php esc_html_e( 'To', 'ibid' ); ?></span>
                                                    <input type="text" name="_sale_price_dates_to" class="dokan-form-control datepicker" value="<?php echo esc_attr( $_sale_price_dates_to ); ?>" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="<?php esc_html_e( 'YYYY-MM-DD', 'ibid' ); ?>">
                                                </div>
                                            </div>
                                        </div><!-- .sale-schedule-container -->
                                    </div>

                                    <?php do_action( 'dokan_product_edit_after_pricing', $post, $post_id ); ?>

                                    <?php if ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'single' ): ?>
                                        <div class="dokan-form-group">
                                            <label for="product_cat" class="form-label"><?php esc_html_e( 'Category', 'ibid' ); ?></label>
                                            <?php
                                            $product_cat = -1;
                                            $term = array();
                                            $term = wp_get_post_terms( $post_id, 'product_cat', array( 'fields' => 'ids') );

                                            if ( $term ) {
                                                $product_cat = reset( $term );
                                            }
                                            include_once DOKAN_LIB_DIR.'/class.category-walker.php';

                                            $category_args =  array(
                                                'show_option_none' => __( '- Select a category -', 'ibid' ),
                                                'hierarchical'     => 1,
                                                'hide_empty'       => 0,
                                                'name'             => 'product_cat',
                                                'id'               => 'product_cat',
                                                'taxonomy'         => 'product_cat',
                                                'title_li'         => '',
                                                'class'            => 'product_cat dokan-form-control dokan-select2',
                                                'exclude'          => '',
                                                'selected'         => $product_cat,
                                                'walker'           => new CategoryDropdownSingle( $post_id )
                                            );

                                            wp_dropdown_categories( apply_filters( 'dokan_product_cat_dropdown_args', $category_args ) );
                                        ?>
                                            <div class="dokan-product-cat-alert dokan-hide">
                                                <?php esc_html_e('Please choose a category!', 'ibid' ); ?>
                                            </div>
                                        </div>
                                    <?php elseif ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'multiple' ): ?>
                                        <div class="dokan-form-group">
                                            <label for="product_cat" class="form-label"><?php esc_html_e( 'Category', 'ibid' ); ?></label>
                                            <?php
                                            $term = array();
                                            $term = wp_get_post_terms( $post_id, 'product_cat', array( 'fields' => 'ids') );
                                            include_once DOKAN_LIB_DIR.'/class.taxonomy-walker.php';
                                            $drop_down_category = wp_dropdown_categories( apply_filters( 'dokan_product_cat_dropdown_args', array(
                                                'show_option_none' => __( '', 'ibid' ),
                                                'hierarchical'     => 1,
                                                'hide_empty'       => 0,
                                                'name'             => 'product_cat[]',
                                                'id'               => 'product_cat',
                                                'taxonomy'         => 'product_cat',
                                                'title_li'         => '',
                                                'class'            => 'product_cat dokan-form-control dokan-select2',
                                                'exclude'          => '',
                                                'selected'         => $term,
                                                'echo'             => 0,
                                                'walker'           => new DokanTaxonomyWalker( $post_id )
                                            ) ) );

                                            echo str_replace( '<select', '<select data-placeholder="' . esc_html__( 'Select product category', 'ibid' ) . '" multiple="multiple" ', $drop_down_category );
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="dokan-form-group">
                                        <label for="product_tag" class="form-label"><?php esc_html_e( 'Tags', 'ibid' ); ?></label>
                                        <?php
                                        require_once DOKAN_LIB_DIR.'/class.taxonomy-walker.php';
                                        $term = wp_get_post_terms( $post_id, 'product_tag', array( 'fields' => 'ids') );
                                        $selected = ( $term ) ? $term : array();
                                        $drop_down_tags = wp_dropdown_categories( array(
                                            'show_option_none' => __( '', 'ibid' ),
                                            'hierarchical'     => 1,
                                            'hide_empty'       => 0,
                                            'name'             => 'product_tag[]',
                                            'id'               => 'product_tag',
                                            'taxonomy'         => 'product_tag',
                                            'title_li'         => '',
                                            'class'            => 'product_tags dokan-form-control dokan-select2',
                                            'exclude'          => '',
                                            'selected'         => $selected,
                                            'echo'             => 0,
                                            'walker'           => new DokanTaxonomyWalker( $post_id )
                                        ) );

                                        echo str_replace( '<select', '<select data-placeholder="' . esc_html__( 'Select product tags', 'ibid' ) . '" multiple="multiple" ', $drop_down_tags );

                                        ?>
                                    </div>

                                    <?php do_action( 'dokan_product_edit_after_product_tags', $post, $post_id ); ?>
                                </div><!-- .content-half-part -->

                                <div class="content-half-part featured-image">

                                    <div class="dokan-feat-image-upload dokan-new-product-featured-img">
                                        <?php
                                        $wrap_class        = ' dokan-hide';
                                        $instruction_class = '';
                                        $feat_image_id     = 0;

                                        if ( has_post_thumbnail( $post_id ) ) {
                                            $wrap_class        = '';
                                            $instruction_class = ' dokan-hide';
                                            $feat_image_id     = get_post_thumbnail_id( $post_id );
                                        }
                                        ?>

                                        <div class="instruction-inside<?php echo esc_attr( $instruction_class ); ?>">
                                            <input type="hidden" name="feat_image_id" class="dokan-feat-image-id" value="<?php echo esc_attr( $feat_image_id ); ?>">

                                            <i class="fa fa-cloud-upload"></i>
                                            <a href="#" class="dokan-feat-image-btn btn btn-sm"><?php esc_html_e( 'Upload a product cover image', 'ibid' ); ?></a>
                                        </div>

                                        <div class="image-wrap<?php echo esc_attr( $wrap_class ); ?>">
                                            <a class="close dokan-remove-feat-image">&times;</a>
                                            <?php if ( $feat_image_id ) { ?>
                                                <?php echo get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'height' => '', 'width' => '' ) ); ?>
                                            <?php } else { ?>
                                                <img height="" width="" src="" alt="<?php esc_attr_e( 'Image', 'ibid' ); ?>">
                                            <?php } ?>
                                        </div>
                                    </div><!-- .dokan-feat-image-upload -->

                                    <?php if ( apply_filters( 'dokan_product_gallery_allow_add_images', true ) ): ?>
                                        <div class="dokan-product-gallery">
                                            <div class="dokan-side-body" id="dokan-product-images">
                                                <div id="product_images_container">
                                                    <ul class="product_images dokan-clearfix">
                                                        <?php
                                                        $product_images = get_post_meta( $post_id, '_product_image_gallery', true );
                                                        $gallery = explode( ',', $product_images );

                                                        if ( $gallery ) {
                                                            foreach ($gallery as $image_id) {
                                                                if ( empty( $image_id ) ) {
                                                                    continue;
                                                                }

                                                                $attachment_image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
                                                                ?>
                                                                <li class="image" data-attachment_id="<?php echo esc_attr( $image_id ); ?>">
                                                                    <img src="<?php echo esc_url( $attachment_image[0] ); ?>" alt="<?php esc_attr_e( 'Image', 'ibid' ); ?>">
                                                                    <a href="#" class="action-delete" title="<?php esc_attr_e( 'Delete image', 'ibid' ); ?>">&times;</a>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <li class="add-image add-product-images tips" data-title="<?php esc_html_e( 'Add gallery image', 'ibid' ); ?>">
                                                            <a href="#" class="add-product-images"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        </li>
                                                    </ul>

                                                    <input type="hidden" id="product_image_gallery" name="product_image_gallery" value="<?php echo esc_attr( $product_images ); ?>">
                                                </div>
                                            </div>
                                        </div> <!-- .product-gallery -->
                                    <?php endif; ?>
                                </div><!-- .content-half-part -->
                            </div><!-- .dokan-form-top-area -->


                            <?php #if( $_product->is_type( 'auction' ) ) { ?>
                                <?php 
                                $meta_auction_item_condition = get_post_meta( $post->ID, '_auction_item_condition', true );
                                $meta_auction_type = get_post_meta( $post->ID, '_auction_type', true );
                                $meta_auction_proxy = get_post_meta( $post->ID, '_auction_proxy', true );
                                $meta_auction_sealed = get_post_meta( $post->ID, '_auction_sealed', true );

                                $meta_auction_start_price = get_post_meta( $post->ID, '_auction_start_price', true );
                                $meta_auction_bid_increment = get_post_meta( $post->ID, '_auction_bid_increment', true );
                                $meta_auction_reserved_price = get_post_meta( $post->ID, '_auction_reserved_price', true );
                                $meta_regular_price = get_post_meta( $post->ID, '_regular_price', true );

                                $meta_auction_dates_from = get_post_meta( $post->ID, '_auction_dates_from', true );
                                $meta_auction_dates_to = get_post_meta( $post->ID, '_auction_dates_to', true );

                                // RELIST OPTIONS
                                $meta_auction_automatic_relist = get_post_meta( $post->ID, '_auction_automatic_relist', true );
                                $meta_auction_relist_fail_time = get_post_meta( $post->ID, '_auction_relist_fail_time', true );
                                $meta_auction_relist_not_paid_time = get_post_meta( $post->ID, '_auction_relist_not_paid_time', true );
                                $meta_auction_relist_duration = get_post_meta( $post->ID, '_auction_relist_duration', true );

                                //Charity metas
                                $meta_product_cause = get_post_meta( $post->ID, 'product_cause', true );

                                //Attach PDF
                                $meta_attach_pdf = get_post_meta( $post->ID, 'ibid_pdf_attach', true );
                                ?>

                                <?php 
                            	$style = 'display: none;';
                                if( $_product->is_type( 'auction' ) ) {
                                	$style = 'display: block;';
                                } 
                                ?>

                                <div class="ibid-auction-settings" style="<?php echo esc_attr($style); ?>">

                                    <h3 class="ebid-relist-auction"><?php esc_html_e( 'Charity Cause', 'ibid' ); ?></h3>
                                    <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class=" form-field _auction_item_condition_field">
                                                    <select id="product_cause" name="product_cause" class="form-control select short">
                                                        <option value=""><?php esc_html_e( 'Select a Charity Cause', 'ibid' ); ?></option>
                                                        <?php
                                                        $cause_posts = get_posts( array( 'post_type' => 'cause', 'posts_per_page' => -1) );
                                                        foreach ($cause_posts as $cause_post) {
                                                            $selected = '';
                                                            if ((isset($meta_product_cause) && !empty($meta_product_cause)) && $meta_product_cause == $cause_post->ID) {
                                                                $selected = 'selected';
                                                            } ?>
                                                            <option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($cause_post->ID); ?>"><?php echo esc_html($cause_post->post_title); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-8">
                                                <p><i><?php esc_html_e( 'If this auction will be charity auction you can select a cause to support, from the dropdown. Otherwise, leave it unselected.', 'ibid' ); ?></i></p>
                                            </div>
                                        </div>
                                    </div>

                                    <h3><?php esc_html_e( 'Auction Settings', 'ibid' ); ?></h3>
                                    <div id="auction_tab" class="panel woocommerce_options_panel" style="display: block;">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class=" form-field _auction_item_condition_field">
                                                    <label for="_auction_item_condition"><?php esc_html_e( 'Item condition', 'ibid' ); ?></label>
                                                    <select style="" id="_auction_item_condition" name="_auction_item_condition" class="form-control select short">
                                                        <option value="new" <?php if($meta_auction_item_condition == 'new'){echo esc_attr__('selected', 'ibid');} ?>>New</option>
                                                        <option value="used" <?php if($meta_auction_item_condition == 'used'){echo esc_attr__('selected', 'ibid');} ?>>Used</option>
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class=" form-field _auction_type_field">
                                                    <label for="_auction_type"><?php esc_html_e( 'Auction type', 'ibid' ); ?></label>
                                                    <select style="" id="_auction_type" name="_auction_type" class="form-control select short">
                                                        <option value="normal" <?php if($meta_auction_type == 'normal'){echo esc_attr__('selected', 'ibid');} ?>>Normal</option>
                                                        <option value="reverse" <?php if($meta_auction_type == 'reverse'){echo esc_attr__('selected', 'ibid');} ?>>Reverse</option>
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="form-field _auction_proxy_field ">
                                                    <label for="_auction_proxy"><?php esc_html_e( 'Proxy bidding?', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                                                    <input type="checkbox" class="checkbox" style="" name="_auction_proxy" id="_auction_proxy" value="<?php if($meta_auction_proxy == 'yes'){echo esc_attr__('yes', 'ibid');} ?>" <?php if($meta_auction_proxy == 'yes'){echo esc_attr__('checked', 'ibid');} ?>>
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="form-field _auction_sealed_field ">
                                                    <label for="_auction_sealed"><?php esc_html_e( 'Sealed bidding?', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                                                    <input type="checkbox" class="checkbox" style="" name="_auction_sealed" id="_auction_sealed" value="<?php if($meta_auction_sealed == 'yes'){echo esc_attr__('yes', 'ibid');} ?>" <?php if($meta_auction_sealed == 'yes'){echo esc_attr__('checked', 'ibid');} ?>>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="form-field _auction_start_price_field ">
                                                    <label for="_auction_start_price"><?php esc_html_e( 'Start Price', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                                                    <input type="text" class="form-control wc_input_price short wc_input_price" style="" name="_auction_start_price" id="_auction_start_price" value="<?php echo esc_attr($meta_auction_start_price); ?>" step="any" min="0">
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="form-field _auction_bid_increment_field ">
                                                    <label for="_auction_bid_increment"><?php esc_html_e( 'Bid increment', 'ibid' ); ?> <?php echo esc_html( get_woocommerce_currency_symbol() ); ?></label>
                                                    <input type="text" class="form-control wc_input_price short wc_input_price" style="" name="_auction_bid_increment" id="_auction_bid_increment" value="<?php echo esc_attr($meta_auction_bid_increment); ?>" step="any" min="0">
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="form-field _auction_reserved_price_field ">
                                                    <label for="_auction_reserved_price"><?php esc_html_e( 'Reserve price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ')', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                                                    <input type="text" class="form-control wc_input_price short wc_input_price" style="" name="_auction_reserved_price" id="_auction_reserved_price" value="<?php echo esc_attr($meta_auction_reserved_price); ?>" step="any" min="0">
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="_regular_price_field ">
                                                    <label for="_regular_price"><?php esc_html_e( 'Buy it now price (', 'ibid' ); ?><?php echo esc_html( get_woocommerce_currency_symbol() ); ?><?php esc_html_e( ') = Regular Price', 'ibid' ); ?></label><span class="woocommerce-help-tip"></span>
                                                    <input type="text" class="form-control wc_input_price short wc_input_price" style="" name="_regular_price" id="_regular_price" value="<?php echo esc_attr($meta_regular_price); ?>">
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="auction_dates_fields">
                                                    <label for="_auction_dates_from"><?php esc_html_e( 'Auction Date - Start', 'ibid' ); ?></label>
                                                    <input type="text" class="form-control ibid_datetime_picker" name="_auction_dates_from" id="_auction_dates_from" value="<?php echo esc_attr($meta_auction_dates_from); ?>" placeholder="From… YYYY-MM-DD HH:MM">
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="auction_dates_fields">
                                                    <label for="_auction_dates_to"><?php esc_html_e( 'Auction Date - End', 'ibid' ); ?></label>
                                                    <input type="text" class="form-control ibid_datetime_picker" name="_auction_dates_to" id="_auction_dates_to" value="<?php echo esc_attr($meta_auction_dates_to); ?>" placeholder="To… YYYY-MM-DD HH:MM">
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="ebid-relist-auction"><?php esc_html_e( 'Automatic relist auction', 'ibid' ); ?></h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class=" form-field field_auction_automatic_relist">
                                                <input type="checkbox" class="checkbox" style="" name="_auction_automatic_relist" id="_auction_automatic_relist" value="<?php if($meta_auction_automatic_relist == 'yes'){echo esc_attr__('yes', 'ibid');} ?>" <?php if($meta_auction_automatic_relist == 'yes'){echo esc_attr__('checked', 'ibid');} ?>><label for="_auction_automatic_relist"><?php esc_html_e( 'Automatic relist auction', 'ibid' ); ?></label>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-4">
                                            <p class=" form-field _auction_item_condition_field">
                                                <label for="_auction_relist_fail_time"><?php esc_html_e( 'Relist if fail after n hours', 'ibid' ); ?></label>
                                                <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_fail_time" id="_auction_relist_fail_time" value="<?php echo esc_attr($meta_auction_relist_fail_time); ?>" step="any" min="0">
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-4">
                                            <p class=" form-field _auction_item_condition_field">
                                                <label for="_auction_relist_not_paid_time"><?php esc_html_e( 'Relist if not paid after n hours', 'ibid' ); ?></label>
                                                <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_not_paid_time" id="_auction_relist_not_paid_time" value="<?php echo esc_attr($meta_auction_relist_not_paid_time); ?>" step="any" min="0">
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-4">
                                            <p class=" form-field _auction_item_condition_field">
                                                <label for="_auction_item_condition"><?php esc_html_e( 'Relist auction duration in h', 'ibid' ); ?></label>
                                                <input type="number" class="form-control wc_input_price short" style="" name="_auction_relist_duration" id="_auction_relist_duration" value="<?php echo esc_attr($meta_auction_relist_duration); ?>" step="any" min="0">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php #} ?>


                            <div class="dokan-product-short-description">
                                <label for="post_excerpt" class="form-label"><?php esc_html_e( 'Short Description', 'ibid' ); ?></label>
                                <?php wp_editor( $post_excerpt , 'post_excerpt', apply_filters( 'dokan_product_short_description', array( 'editor_height' => 50, 'quicktags' => false, 'media_buttons' => false, 'teeny' => true, 'editor_class' => 'post_excerpt' ) ) ); ?>
                            </div>

                            <div class="dokan-product-description">
                                <label for="post_content" class="form-label"><?php esc_html_e( 'Description', 'ibid' ); ?></label>
                                <?php wp_editor( $post_content , 'post_content', apply_filters( 'dokan_product_description', array( 'editor_height' => 50, 'quicktags' => false, 'media_buttons' => false, 'teeny' => true, 'editor_class' => 'post_content' ) ) ); ?>
                            </div>

                            <div class="dokan-product-attach-pdf">
                                <label for="post_content" class="form-label"><?php esc_html_e( 'Input Attach PDF', 'ibid' ); ?></label>
                                <input type="text" class="form-control wc_input_attach_pdf short wc_attach_pdf" style="" name="ibid_pdf_attach" id="ibid_pdf_attach" value="<?php echo esc_attr($meta_attach_pdf); ?>">
                            </div>

                            <?php do_action( 'dokan_new_product_form', $post, $post_id ); ?>
                            <?php do_action( 'dokan_product_edit_after_main', $post, $post_id ); ?>

                            <?php do_action( 'dokan_product_edit_after_inventory_variants', $post, $post_id ); ?>

                            <?php if ( $post_id ): ?>
                                <?php do_action( 'dokan_product_edit_after_options', $post_id ); ?>
                            <?php endif; ?>

                            <?php wp_nonce_field( 'dokan_edit_product', 'dokan_edit_product_nonce' ); ?>

                            <!--hidden input for Firefox issue-->
                            <input type="hidden" name="dokan_update_product" value="<?php esc_attr_e( 'Save Product', 'ibid' ); ?>"/>
                            <input type="submit" name="dokan_update_product" class="dokan-btn dokan-btn-theme dokan-btn-lg dokan-right" value="<?php esc_attr_e( 'Save Product', 'ibid' ); ?>"/>
                            <div class="dokan-clearfix"></div>
                        </form>
                    <?php } else { ?>
                        <div class="dokan-alert dokan-alert">
                            <?php echo esc_html( dokan_seller_not_enabled_notice() ); ?>
                        </div>
                    <?php } ?>

                <?php } else { ?>

                    <?php do_action( 'dokan_can_post_notice' ); ?>

                <?php } ?>
            </div> <!-- #primary .content-area -->

            <?php

                /**
                 *  dokan_product_content_inside_area_after hook
                 *
                 *  @since 2.4
                 */
                do_action( 'dokan_product_content_inside_area_after' );
            ?>
        </div>

        <?php

            /**
             *  dokan_dashboard_content_after hook
             *  dokan_after_product_content_area hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_after' );
            do_action( 'dokan_after_product_content_area' );
        ?>

    </div><!-- .dokan-dashboard-wrap -->

<?php do_action( 'dokan_dashboard_wrap_end' ); ?>

<div class="dokan-clearfix"></div>

<?php

    /**
     *  dokan_dashboard_content_before hook
     *
     *  @since 2.4
     */
    do_action( 'dokan_dashboard_wrap_after', $post, $post_id );

    wp_reset_postdata();

    if ( ! $from_shortcode ) {
        get_footer();
    }
?>
