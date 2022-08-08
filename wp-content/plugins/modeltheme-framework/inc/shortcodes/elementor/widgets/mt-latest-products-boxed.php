<?php
namespace Elementor;

class ibid_latest_products_boxed_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-products-boxed';
	}
	
	public function get_title() {
		return 'iBid - Latest Products Boxed';
	}
	
	public function get_icon() {
		return 'fab fa-elementor';
	}
	
	public function get_categories() {
		return [ 'ibid-widgets' ];
	}
	
	

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme' ),
			]
		);

		$product_category = array();
        if ( class_exists( 'WooCommerce' ) ) {
          $product_category_tax = get_terms( 'product_cat', array(
            'parent'      => '0'
          ));
          if ($product_category_tax) {
            foreach ( $product_category_tax as $term ) {
              if ($term) {
                $product_category[$term->name] = $term->slug;
              }
            }
          }
        }

		$this->add_control(
			'category',
			[
				'label' => __( 'Select Products Category', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => $product_category,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout Version', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'v4',
				'options' => [
					'box-border'    => __( 'Style 1', 'modeltheme' ),
					'simple'        => __( 'Style 2', 'modeltheme' ),
					'box-shadow'    => __( 'Style 3', 'modeltheme' ),
					'v4'            => __( 'Style 4', 'modeltheme' ),

				]
			]
		);

		$this->add_control(
			'number_of_products_by_category',
			[
				'label' => __( 'Number of products to show', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '4',
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label' => __( 'Products per column', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'2' => __( '2', 'modeltheme' ),
					'3' => __( '3', 'modeltheme' ),
					'4' => __( '4', 'modeltheme' ),
					'6' => __( '6', 'modeltheme' ),

				]
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 						= $this->get_settings_for_display();
        $category 						= $settings['category'];
        $number_of_products_by_category = $settings['number_of_products_by_category'];
        $number_of_columns 				= $settings['number_of_columns'];
        $layout 					    = $settings['layout'];

    $cat = get_term_by('slug', $category, 'product_cat');

    if (isset($number_of_columns)) {
        if ($number_of_columns == '' || $number_of_columns == '3') {
            $column_type = 'col-md-4';
        }elseif($number_of_columns == '4'){
            $column_type = 'col-md-3';
         }elseif($number_of_columns == '6'){
            $column_type = 'col-md-2';
        }
    }else{
        $column_type = 'col-md-3';
    }

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_simple_boxed">';
       
       if($layout == "box-border") {

        $shortcode_content .= '<div class="products_category">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "box-shadow") {

        $shortcode_content .= '<div class="modeltheme_products_shadow">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "v4") {

        $shortcode_content .= '<div class="modeltheme_products_v4">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "simple") {

        $shortcode_content .= '<div class="modeltheme_products_simple row">';
        $args_prods = array(
              'posts_per_page'   => $number_of_products_by_category,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category
                )
                ),
              'post_status'      => 'publish' 
         ); 
        $prods = get_posts($args_prods);
        
        foreach ($prods as $prod) {
            #thumbnail
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $prod->ID ), 'ibid_product_simple_285x38' );
            $product_cause = get_post_meta( $prod->ID, 'product_cause', true );
            if ($thumbnail_src) {
                $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$prod->post_title.'" />';
                $post_col = 'col-md-12';
            }else{
                $post_col = 'col-md-12 no-featured-image';
                $post_img = '';
            }
            $shortcode_content .= '<div id="product-id-'.esc_attr($prod->ID).'">
                                    <div class="'.$column_type.' modeltheme-product ">
                                        <div class="modeltheme-product-wrapper"> 
                                            <div class="modeltheme-thumbnail-and-details">
                                                <a class="modeltheme_media_image" title="'.esc_attr($prod->post_title).'" href="'.esc_url(get_permalink($prod->ID)).'"> '.$post_img.'</a>
                                                <a href="'.esc_url(get_permalink()).'products/?add-to-cart='.esc_attr($prod->ID).'" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr($prod->ID).'" aria-label="Add “Berry Energizer” to your cart" rel="nofollow">'.esc_html__('Add to Cart','modeltheme').'</a>
                                            </div>

                                            <div class="modeltheme-title-metas">
                                                <h3 class="modeltheme-archive-product-title">
                                                    <a href="'.esc_url(get_permalink($prod->ID)).'" title="'. $prod->post_title .'">'. $prod->post_title .'</a>
                                                </h3>';
                                                
                                                global $product;
                                                $product = wc_get_product( $prod->ID );
                                                if( $product->post_type !== 'auction' ) {
                                                     $shortcode_content .= '<p>'.$product->get_price_html().'</p>';
                                                }
                                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                                  $product = wc_get_product( $prod->ID );
                                                  // metas
                                                  $meta_auction_current_bid = get_post_meta( $prod->ID, '_auction_current_bid', true );
                                                  $meta_auction_start_price = get_post_meta( $prod->ID, '_auction_start_price', true );
                                                  $meta_auction_closed = get_post_meta( $prod->ID, '_auction_closed', true );
                                                  global $ibid_redux;
                      
                                                  if( $product->post_type !== 'auction' ) {
                                                    if ($meta_auction_closed == '') {
                                                      if ($meta_auction_current_bid) {
                                                        
                                                        $shortcode_content .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                                        if($product_cause){
                                                            $shortcode_content .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                                        }
                                                        $shortcode_content .= '<div class="modeltheme-button-bid text-center">
                                                                <a href ="'.esc_url(get_permalink($prod->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                                              </div>';
                                                      }else if($meta_auction_start_price){
                                                        $shortcode_content .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                                        $shortcode_content .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
                                                            if($product_cause){
                                                                $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                                            }
                                                        }
                                                        $shortcode_content .= '<div class="modeltheme-button-bid text-center">
                                                                <a href ="'.esc_url(get_permalink($prod->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                                              </div>';
                                                      }

                                                    }
                                                  } 
                                                }
                      $shortcode_content .= '</div>
                                        </div>
                                    </div>                     
                                </div>';
                                }
    $shortcode_content .= '</div>';
                            }
    $shortcode_content .= '</div>';


    wp_reset_postdata();

    echo $shortcode_content;
}
	protected function _content_template() {

    }
		
}