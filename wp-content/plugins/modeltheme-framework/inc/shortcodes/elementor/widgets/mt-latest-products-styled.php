<?php
namespace Elementor;

class ibid_latest_styled_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-products-styled';
	}
	
	public function get_title() {
		return 'iBid - Latest Products Styled';
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
					'2' => __( '2', 'modeltheme' ),
					'3' => __( '3', 'modeltheme' ),
					'4' => __( '4', 'modeltheme' ),
				]
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout Version', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
                  	'Select Layout'        => '',
					'horizontal' => __( 'Horizontal & Shadow', 'modeltheme' ),
					'vertical' => __( 'Vertical', 'modeltheme' ),
					'simple' => __( 'Vertical Simple', 'modeltheme' ),
				]
			]
		);


		$this->add_control(
			'product_1',
			[
				'label' => __( 'Background First Product', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'product_2',
			[
				'label' => __( 'Background Second Product', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);
		$this->add_control(
			'product_3',
			[
				'label' => __( 'Background Thirds Product', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);
		$this->add_control(
			'product_4',
			[
				'label' => __( 'Background Fourth Product', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
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
        $product_1 				        = $settings['product_1'];
        $product_2 						= $settings['product_2'];
        $product_3 						= $settings['product_3'];
        $product_4 					    = $settings['product_4'];

        $cat = get_term_by('slug', $category, 'product_cat');


	    if (isset($number_of_columns)) {
	        if ($number_of_columns == '' || $number_of_columns == '3') {
	            $column_type = 'col-md-4';
	        }elseif($number_of_columns == '4'){
	            $column_type = 'col-md-3';
	        }
	    }else{
	        $column_type = 'col-md-3';
	    }

	    if (isset($layout)) {
	        if ($layout == '' || $layout == 'horizontal') {
	            $block_type = 'products_category';
	        }elseif($layout == 'vertical'){
	            $block_type = 'products_category_vertical';
	        }elseif($layout == 'simple'){
	            $block_type = 'products_category_simple';
	        }
	    }else{
	        $block_type = 'products_category';
	    }

	    $shortcode_content = '';
	    $shortcode_content .= '<style>
	                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(1) .products-wrapper{
	                                background: '.$product_1.';
	                            }
	                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(2) .products-wrapper{
	                                background: '.$product_2.';
	                            }
	                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(3) .products-wrapper{
	                                background: '.$product_3.';
	                            }
	                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(4) .products-wrapper{
	                                background: '.$product_4.';
	                            }
	                            </style>';
	    $shortcode_content .= '<div class="woocommerce_simple_styled">';
	       
	        $shortcode_content .= '<div class="'.$block_type.'">';
	                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
	        $shortcode_content .= '</div>';

	       
	    $shortcode_content .= '</div>';


	    wp_reset_postdata();

	    echo $shortcode_content;
	}
	
	protected function _content_template() {

    }
		
}