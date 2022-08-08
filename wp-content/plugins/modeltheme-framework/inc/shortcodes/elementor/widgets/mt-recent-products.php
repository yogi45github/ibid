<?php
namespace Elementor;

class ibid_recent_products_widget extends Widget_Base {
	
	public function get_name() {
		return 'recent-products';
	}
	
	public function get_title() {
		return 'iBid - Recent Products';
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
        $number_of_products_by_category = $settings['number_of_products_by_category'];
        $number_of_columns 				= $settings['number_of_columns'];

        $shortcode_content = '';
    		$shortcode_content .= '<div id="categoryid" class="products_by_categories ">'.do_shortcode('[recent_products columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'"]').'</div>';

        echo  $shortcode_content;
	}
	
	protected function _content_template() {

    }
	
	
}