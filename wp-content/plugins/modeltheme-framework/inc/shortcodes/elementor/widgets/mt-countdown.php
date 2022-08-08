<?php
namespace Elementor;

class modeltheme_shortcode_countdown_widget extends Widget_Base {
	
	public function get_name() {
		return 'countdown';
	}
	
	public function get_title() {
		return 'iBid - CountDown';
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
			'insert_date',
			[
				'label' => __( 'Date', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'el_class',
			[
				'label' => __( 'Extra class name', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 		= $this->get_settings_for_display();
        $insert_date 	= $settings['insert_date'];
        $el_class 		= $settings['el_class'];

        $html = '';
    
	    $uniqueID = 'countdown_'.uniqid();

		    $html .= '<div class="countdownv2_holder '.$el_class.'" data-insert-date="'.$insert_date.'" data-unique-id="'.$uniqueID.'">';
	        $html .= '<div class="countdownv2 clock " id="'.$uniqueID.'"></div>';
	    $html .= '</div>';
        echo  $html;
	}
	
	protected function _content_template() {

    }
		
}