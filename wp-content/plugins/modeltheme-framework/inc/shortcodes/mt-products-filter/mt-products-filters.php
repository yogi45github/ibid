<?php 
/**
||-> Shortcode: BlogPos01
*/
function modeltheme_shortcode_product_filters($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'           =>'',
            'number'              =>'',
            'searchfilter'        =>'',
            'categoriesfilter'    =>'',
            'tagsfilter'          =>'',
            'search_placeholder'  =>'',
            'attribute'           =>'',
            'all_products'        =>'',
        ), $params ) );

    if ($all_products == 'auction') {
      $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'tax_query' => array(
                  array(
                      'taxonomy' => 'product_type',
                      'field'    => 'slug',
                      'terms'    => $all_products, 
                  ),
              ),
              'post_status'      => 'publish' 
      ); 
    }else{
      $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
      ); 
    }



    $blogposts = get_posts($args_blogposts);
  
    $prod_categories = get_terms( 'product_cat', array(
        'number'        => 10,
        'hide_empty'    => true,
        'parent' => 0
    ));
    $product_categories = get_terms( 'product_cat', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
    $product_tags = get_terms( 'product_tag', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
    $html = '';

    $html .= '<div class="iconfilter-shortcode portfolio-posts-list portfolio-posts-list2 wow '.esc_attr($animation).'">';
      $html .= '<div class="row">';
        $html .= '<main class="cd-main-content">';
          $html .= '<div class="cd-tab-filter-wrapper">';
            $html .= '<div class="cd-tab-filter filter-is-visible">';
              $html .= '<ul class="cd-filters">';
                $html .= '<li class="placeholder"><a data-type="all">'.esc_html__('All','modeltheme').'</a></li>';
                $html .= '<li class="filter"><a class="selected" data-type="all">'.esc_html__('All ','modeltheme').'</a></li>';     
                  foreach( $prod_categories as $prod_cat ) {
                    $html .= '<li class="filter" data-filter=".'.esc_attr($prod_cat->slug).'">
                          <a href="#0" data-type="'.esc_attr($prod_cat->slug).'">'.esc_attr($prod_cat->name).'<span></span></a>';
                    $html .= '</li>';
                  }
              $html .= '</ul>';
            $html .= '</div>';
          $html .= '</div>';

          $html .= '<section class="cd-gallery filter-is-visible">';
            $html .= '<ul>';

            // ALL WOOCOMMERCE AVAILABLE ATTRIBUTES
            $all_available_attributes = array();
            $taxonomy_terms = array();
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ( $attribute_taxonomies ){
              foreach ( $attribute_taxonomies as $tax ){
                array_push($all_available_attributes, $tax->attribute_name);
              }
            }

            $attributes_to_list = array();
            if ($attribute) {
              $attributes_to_list = explode(",", $attribute);
            }

              // echo '<pre>' . var_export($attributes_to_list, true) . '</pre>';

            foreach ($blogposts as $blogpost) { 

              $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_portfolio_pic400x400' );

              $categories_list = wp_get_post_terms($blogpost->ID, 'product_cat');
              $cat_slugs = implode(' ',wp_list_pluck($categories_list,'slug'));
              
              $tags_list = wp_get_post_terms($blogpost->ID, 'product_tag');
              $tags_slugs = implode(' ',wp_list_pluck($tags_list,'slug'));


              if ($thumbnail_src) {
                $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                $post_col = 'col-md-12';
              }else{
                $post_col = 'col-md-12 no-featured-image';
                $post_img = '';
              }

              global $product;
              $attributes_final = '';
              $all_product_attr = get_post_meta($blogpost->ID, '_product_attributes', true);
              if ($all_product_attr) {
                foreach ($all_product_attr as $attr) {
                  $attributes = wc_get_product_terms( $blogpost->ID, $attr['name'], array( 'fields' => 'all' ) );
                  if ($attributes) {
                    foreach ($attributes as $single_attr_value) {
                      $attributes_final .=  $single_attr_value->slug.' ';
                    }
                  }
                }
              }

            $html .= '<li id="product-id-'.esc_attr($blogpost->ID).'" class="mix '.esc_attr($attributes_final).' '.esc_attr($cat_slugs).' '.esc_attr($blogpost->post_title).' '.esc_attr($tags_slugs).'"> 
                        <div class="col-md-12 post ">
                          <div class="product-wrapper">
                          <div class="thumbnail-and-details">
                            <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>
                          </div>
                          <div class="woocommerce-title-metas">
                            <h3 class="archive-product-title">
                              <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                            </h3>';

                            $product = wc_get_product( $blogpost->ID );

                            if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                              // metas
                              $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                              $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                              $meta_auction_closed = get_post_meta( $blogpost->ID, '_auction_closed', true );

                              if( $product->post_type !== 'auction' ) {
                                if ($meta_auction_closed == '') {
                                  if ($meta_auction_current_bid) {
                                    $html .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                    $html .= '<p>'.esc_html__('Expires on: ','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                    $html .= '<div class="button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                  }else if($meta_auction_start_price){
                                    $html .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                    $html .= '<p>'.esc_html__('Expires on: ','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                    $html .= '<div class="button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                  }

                                }else {
                                  $html .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
                                }
                              }else{
                                $html .= '<p>'.wc_price($product->get_price()).'</p>';
                                $html .= '<div class="button-bid button-other-type text-center"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></div>'; 
                              }
                            }else{
                                $html .= '<p>'.wc_price($product->get_price()).'</p>';
                                $html .= '<div class="button-bid button-other-type text-center"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></div>'; 
                            }
                $html .= '</div>
                          </div>
                        </div>                     
                      </li>';        
            }
          $html .= '</ul>';
          $html .= '<div class="cd-fail-message">'.esc_html__('No results found','modeltheme').'</div>';
        $html .= '</section>';

          $html .= '<div class="cd-filter filter-is-visible">';
            $html .= '<form>';

              // SIDEBAR: SEARCH FORM
              if($searchfilter == 'search_on') {
                $html .= '<div class="cd-filter-block">';
                  $html .= '<h4>'.esc_html__('Search','modeltheme').'</h4>';
                  $html .= '<div class="cd-filter-content">';
                    if($search_placeholder) {
                      $html .= '<input type="search" placeholder="'.esc_attr($search_placeholder).'...">';
                    } else {
                      $html .= '<input type="search" placeholder="'.esc_attr__('Search...','modeltheme').'">'; 
                    }
                  $html .= '</div>';
                $html .= '</div>';
              }

              // SIDEBAR: ATTRIBUTES
              if($attribute) {
                $html .= '<div class="cd-filter-block">';
                  $attributes_taxonomies = wc_get_attribute_taxonomies();
                  foreach ( $attributes_taxonomies as $tax ) {
                    if (in_array($tax->attribute_name, $attributes_to_list)) {
                      $html .= '<h4>'.$tax->attribute_label.'</h4>';
                      $html .= '<ul class="cd-filter-content cd-filters list">';
                      $attributes_array = array();
                      $taxonomies_terms = array();
                      if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ){
                        $attributes_array[ $tax->attribute_name ] = $tax->attribute_name;                                    
                        $taxonomies_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name));
                      }

                      foreach ($attributes_array as $key ) {
                        foreach ($taxonomies_terms[$key] as $term) {
                          $html .= '<li>';
                            $html .= '<input class="filter" data-filter=".'.$term->slug.'" type="checkbox" id="'.$term->slug.'">';
                            $html .= '<label class="checkbox-label" for="'.$term->slug.'">'.$term->name.'</label>';
                          $html .= '</li>'; 
                        }
                      }
                    }
                    $html .= '</ul>';
                  }
                $html .= '</div>';  
              }

              // SIDEBAR: CATEGORIES
              if($categoriesfilter == 'categories_on') {
                $html .= '<div class="cd-filter-block">';
                  $html .= '<h4>'.esc_html__('Categories','modeltheme').'</h4>';
                  $html .= '<ul class="cd-filter-content cd-filters list">';                
                    foreach($product_categories as $category){
                      $html .= '<li>';
                        $html .= '<input class="filter" data-filter=".'.$category->slug.'" type="checkbox" id="'.$category->slug.'">';
                        $html .= '<label class="checkbox-label" for="'.$category->slug.'">'.$category->name.'</label>';
                      $html .= '</li>';                 
                    }    
                  $html .= '</ul>';  
                $html .= '</div>';  
              }

              // SIDEBAR: TAGS
              if($tagsfilter == 'tags_on') {
                $html .= '<div class="cd-filter-block">';
                  $html .= '<h4>'.esc_html__('Most used Tags','modeltheme').'</h4>';
                  $html .= '<ul class="cd-filter-content cd-filters list">';                
                    foreach($product_tags as $tag){
                      $html .= '<li>';
                        $html .= '<input class="filter" data-filter=".'.$tag->slug.'" type="checkbox" id="'.$tag->slug.'">';
                        $html .= '<label class="checkbox-label" for="'.$tag->slug.'">'.$tag->name.'</label>';
                      $html .= '</li>';                 
                    }    
                  $html .= '</ul>';  
                $html .= '</div>';  
              }

            $html .= '</form>';
            $html .= '<a class="cd-close">'.esc_html__('Close','modeltheme').'</a>';
          $html .= '</div>';

         $html .= '<a class="cd-filter-trigger filter-is-visible">'.esc_html__('Filters','modeltheme').'</a>';
        $html .= '</main>';
      $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode('product_filters', 'modeltheme_shortcode_product_filters');



