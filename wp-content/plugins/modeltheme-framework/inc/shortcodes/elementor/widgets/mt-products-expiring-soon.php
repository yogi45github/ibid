<?php
namespace Elementor;

class shop_expiring_soon_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop_expiring_soon';
	}
	
	public function get_title() {
		return 'iBid - Expiring Soon';
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

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 						= $this->get_settings_for_display();
        $category 						= $settings['category'];
        $number_of_products_by_category = $settings['number_of_products_by_category'];
        $number_of_columns 				= $settings['number_of_columns'];
 

        $cat = get_term_by('slug', $category, 'product_cat');

	    $shortcode_content = '';
	    $shortcode_content .= '<div class="woocommerce_expiring">';
	       
	        $shortcode_content .= '<div class="products_category">';
	                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
	        $shortcode_content .= '</div>';
	    $shortcode_content .= '</div>';
        echo  $shortcode_content;
	}
	
	protected function _content_template() {

    }
		
}