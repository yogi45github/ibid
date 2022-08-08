<?php
namespace Elementor;

class shop_feature_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-feature';
	}
	
	public function get_title() {
		return 'iBid - Shop feature';
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
			'icon',
			[
				'label' => __( 'Icon class(FontAwesome)', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-youtube-play',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __( 'Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'subheading',
			[
				'label' => __( 'Description', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 	= $this->get_settings_for_display();
        $icon 		= $settings['icon'];
        $heading 	= $settings['heading'];
        $subheading = $settings['subheading'];

        $shortcode_content = '<div class="shop_feature">';
	        $shortcode_content .= '<div class="pull-left shop_feature_icon">';
	             \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
	        $shortcode_content .= '</div>';
	        $shortcode_content .= '<div class="pull-left shop_feature_description">';
	            $shortcode_content .= '<h4>'.$heading.'</h4>';
	            $shortcode_content .= '<p>'.$subheading.'</p>';
	        $shortcode_content .= '</div>';
	    $shortcode_content .= '</div>';
        echo  $shortcode_content;
	}
	
	protected function _content_template() {

    }
		
}