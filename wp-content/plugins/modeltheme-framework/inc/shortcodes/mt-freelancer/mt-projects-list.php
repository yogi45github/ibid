<?php 
require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

function ibid_projects_list_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'button_text'                          => '',
            'hide_empty'                           => '',
            'items_per_row'                        => ''
        ), $params ) );

    $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => $number_of_products_by_category,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $blogposts = new WP_Query( $args );

    $shortcode_content = '';
    $shortcode_content .= '<div class="freelancer woocommerce_categories list">';

            $shortcode_content .= '<div class="freelancer_category">';
                while ($blogposts->have_posts()) {
                $blogposts->the_post();
                global $product;
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'ibid_cat_pic500x500' );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_the_title().'" />';
                  }else{
                    $post_img = '';
                  }
                $shortcode_content .= '
                    <div class="'.$items_per_row.' freelancer-list-shortcode">
                        <div class="post">
                            
                            <div class="woocommerce-title-metas">
                                <div class="modeltheme-thumbnail-and-details">
                                    <a class="modeltheme_media_image" title="'.esc_attr(get_the_title()).'" href="'.esc_url(get_permalink(get_the_ID())).'"> '.$post_img.'</a>
                                </div>
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title().'</a>
                                </h3>
                                <p>'.ibid_excerpt_limit($product->get_description(),40).'</p>
                                <div class="woocommerce_product__category">
                                    <span class="posted_in">';
                                    $cat_name = get_the_term_list(get_the_ID(), 'product_cat', '', ' , ');          
                                    $shortcode_content .= ''.wp_kses_post($cat_name).'</span>
                                </div>
                            </div>';
                            $shortcode_content .= '
                            <div class="project-bid">';
                             if ( class_exists( 'WooCommerce_simple_auction' ) ) {

                                  // metas
                                  $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                                    $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
                                    $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );

                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $shortcode_content .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a class="button btn" href="'.get_permalink().'"</a>'.$button_text.'</a>
                                                  </div>';
                                      }else if($meta_auction_start_price){
                                        $shortcode_content .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a class="button btn" href="'.get_permalink().'"</a>'.$button_text.'</a>
                                                  </div>';
                                      }
                                    }else {
                                      $shortcode_content .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
                                    }
                                  }
                                }
                            $shortcode_content .= '</div>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';
                }
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('projects-list', 'ibid_projects_list_shortcode');

?>