<?php
namespace Elementor;

class ibid_heading_title_subtitle_v2_widget extends Widget_Base {
	
	public function get_name() {
		return 'title-subtitle-v2';
	}
	
	public function get_title() {
		return 'iBid - Section Title and Subtitle w/ button';
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
			'title',
			[
				'label' => __( 'Section Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'modeltheme' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Section subtitle', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your subtitle', 'modeltheme' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your "Button Text', 'modeltheme' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your "Button link', 'modeltheme' ),
			]
		);


		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 			= $this->get_settings_for_display();
        $title 				= $settings['title'];
        $subtitle 			= $settings['subtitle'];
        $button_text		= $settings['button_text'];
        $button_link		= $settings['button_link'];


    $content = '<div class="title-subtile-holder v2">';
        $content .= '<div class="title-content" >';
            $content .= '<h1 class="section-title text-left">'.$title.'</h1>';
            $content .= '<div class="section-subtitle text-left">'.$subtitle.'</div>';
        $content .= '</div>';
         $content .= '<a class="button title-btn " href="'.$button_link.'">'.$button_text.'</a>';
    $content .= '</div>';
    echo $content;
}
	
	protected function _content_template() {

    }
	
	
}