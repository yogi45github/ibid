<?php
namespace Elementor;

class shop_expired_with_thumbnails_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-expired-with-thumbnails';
	}
	
	public function get_title() {
		return 'iBid - Expired Products by Category';
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
				'label' => __( 'Number of products to show for each category', 'modeltheme' ),
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
					'1' => __( '1', 'modeltheme' ),
					'2' => __( '2', 'modeltheme' ),
					'3' => __( '3', 'modeltheme' ),
					'4' => __( '4', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button text', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'products_label_text',
			[
				'label' => __( 'Label text', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'overlay_color1',
			[
				'label' => __( 'Background Banner Color 1', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'overlay_color2',
			[
				'label' => __( 'Background Banner Color 2', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Background Image (Optional)', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
        $bg_image 						= $settings['bg_image'];
        $overlay_color1 				= $settings['overlay_color1'];
        $overlay_color2 				= $settings['overlay_color2'];
        $button_text 					= $settings['button_text'];
        $products_label_text 			= $settings['products_label_text'];

        $cat = get_term_by('slug', $category, 'product_cat');

        if (isset($bg_image) && !empty($bg_image)) {
        $bg_image = wp_get_attachment_image_src($bg_image, "full");
	    }

	    $category_style_bg = '';
	    if ($settings['bg_image']['url']) {
	        $category_style_bg .= 'background: url('.$settings['bg_image']['url'].') no-repeat center center;';
	    }else{
	        $category_style_bg .= 'background: radial-gradient('.$overlay_color1.','.$overlay_color2.');';
	    }

	    if ($button_text) {
	        $button_text_value = $button_text;
	    }else{
	        $button_text_value = __('View All Items', 'modeltheme');
	    }

	    if ($products_label_text) {
	        $products_label_text_value = $products_label_text;
	    }else{
	        $products_label_text_value = __('Products', 'modeltheme');
	    }

        $cat = get_term_by('slug', $category, 'product_cat');

	    $shortcode_content = '';
	    $shortcode_content .= '<div class="woocommerce_expired2">';
	       
	        $shortcode_content .= '<div class="products_category">';
	            $shortcode_content .= '<div class="category item col-md-3" >';
	                $shortcode_content .= '<div style="'.$category_style_bg.'" class="category-wrapper">';
	                    $shortcode_content .= '<a class="#categoryid_'.$cat->term_id.'">';
	                        $shortcode_content .= '<span class="cat-name">'.$category.'</span>';                    
	                    $shortcode_content .= '</a>';
	                    $shortcode_content .= '<br>'; 

	                    $shortcode_content .= '<span class="cat-count"><strong>'.$cat->count.'</strong> '.esc_html($products_label_text_value).'</span>';
	                    $shortcode_content .= '<br>';
	                    $shortcode_content .= '<div class="category-button">';
	                       $shortcode_content .= '<a href="'.get_term_link($cat->slug, 'product_cat').'" class="button" title="'.esc_attr__('View more','modeltheme').'" ><span>'.$button_text_value.'</span></a>';
	                    $shortcode_content .= '</div>';
	                $shortcode_content .= '</div>';    
	            $shortcode_content .= '</div>';
	                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-9 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
	        $shortcode_content .= '</div>';
	    $shortcode_content .= '</div>';
        echo  $shortcode_content;
	}
	
	protected function _content_template() {

    }
		
}