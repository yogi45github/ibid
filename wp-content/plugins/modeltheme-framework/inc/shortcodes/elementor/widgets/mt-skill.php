<?php
namespace Elementor;

class ibid_skill_widget extends Widget_Base {
	
	public function get_name() {
		return 'skill';
	}
	
	public function get_title() {
		return 'iBid - Skill counter';
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
			'image_skill',
			[
				'label' => __( 'Choose image', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'modeltheme' ),
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'skill_color_value',
			[
				'label' => __( 'Skill value color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'skillvalue',
			[
				'label' => __( 'Skill value', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 			= $this->get_settings_for_display();
        $skillvalue 		= $settings['skillvalue'];
        $bg_color 			= $settings['bg_color'];
        $skill_color_value 	= $settings['skill_color_value'];
        $title_color 		= $settings['title_color'];
        $title 				= $settings['title'];

	    $skill = '';
	    $skill .= '<div class="stats-block statistics col-md-12 wow">';
	        $skill .= '<div class="stats-heading-img col-md-5">';
	         $skill .= '<div class="stats-img">';
	            $skill .= '<img src="'. $settings['image_skill']['url'] .'" data-src="'. $settings['image_skill']['url'] .'" alt="">';

	         $skill .= '</div>';
	        $skill .= '</div>';

	        $skill .= '<div class="stats-content percentage col-md-7" data-perc="'.esc_attr($skillvalue).'" style="background:'.$bg_color.'">';
	          $skill .= '<span class="skill-count" style="color: '.esc_attr($skill_color_value).'">'.esc_attr($skillvalue).'</span>';
	            
	              $skill .= '<p style="color: '.esc_attr($title_color).'">'.esc_attr($title).'</p>';
	              
	         $skill .= '</div>';

	    $skill .= '</div>';
        echo  $skill;
	}
	
	protected function _content_template() {

    }
	
	
}