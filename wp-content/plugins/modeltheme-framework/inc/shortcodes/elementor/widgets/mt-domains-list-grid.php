<?php
namespace Elementor;

class ibid_latest_domains_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-products-domains';
	}
	
	public function get_title() {
		return 'iBid -  Domains List Grid';
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
					'col-md-6' => __( '2', 'modeltheme' ),
					'col-md-4' => __( '3', 'modeltheme' ),
					'col-md-3' => __( '4', 'modeltheme' ),
				]
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 										= $this->get_settings_for_display();
        $category 										= $settings['category'];
        $number_of_products_by_category 				= $settings['number_of_products_by_category'];
        $number_of_columns 								= $settings['number_of_columns'];

    $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => $number_of_products_by_category,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $prods = new \WP_Query($args);
    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_simple_domain">';
       
        $shortcode_content .= '<div class="products_category">';
        if ( $prods->have_posts() ) {
             while ($prods->have_posts()) {
                $prods->the_post();
                global $product; 
                $shortcode_content .= '
                    <div class="'.$number_of_columns.' domain-list-shortcode">
                        <div class="col-md-12 post">
                            <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title(). '</a>
                                </h3>
                            </div>
                            <div class="domain-bid">';
                             if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                  // metas
                                  $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                                    $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
                                    $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );
                                    $date = date_create($meta_auction_dates_to);
                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $shortcode_content .= '<p class="start-bid">'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
                                                  </div>';
                                      }else if($meta_auction_start_price){
                                        $shortcode_content .= '<p class="start-bid">'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
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
  }

    echo $shortcode_content;
}
	
	protected function _content_template() {

    }
	
	
}