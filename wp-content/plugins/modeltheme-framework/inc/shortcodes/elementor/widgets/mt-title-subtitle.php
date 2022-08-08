<?php
namespace Elementor;

class ibid_heading_title_subtitle_widget extends Widget_Base {
	
	public function get_name() {
		return 'title-subtitle';
	}
	
	public function get_title() {
		return 'iBid - Section Title and Subtitle';
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
			'separator',
			[
				'label' => __( 'Separator (Optional)', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
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
			'disable_sep',
			[
				'label' => __( 'Disable separator?', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'No', 'modeltheme' ),
					'disable_sep' => __( 'Yes', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title style', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' 			 => __( 'Uppercase', 'modeltheme' ),
					'capitalize' => __( 'Capitalize', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' 			 => __( 'Dark', 'modeltheme' ),
					'light' => __( 'Light', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'delimitator_color',
			[
				'label' => __( 'Choose Delimitator color', 'modeltheme' ),
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
        $settings 			= $this->get_settings_for_display();
        $title 				= $settings['title'];
        $subtitle 			= $settings['subtitle'];
        $title_color		= $settings['title_color'];
        $title_style		= $settings['title_style'];
        $separator 			= $settings['separator'];
        $disable_sep 		= $settings['disable_sep'];
        $delimitator_color 	= $settings['delimitator_color'];

        $separator = wp_get_attachment_image_src($separator, "full");

        if ($delimitator_color) {
	        $delimitator_color_value = $delimitator_color;
	    }else{
	        $delimitator_color_value = '#2695FF';
	    }

		$content = '<div class="title-subtile-holder">';
		    $content .= '<h2 class="section-title '.$title_style.' '.$title_color.'">'.$title.'</h2>';
		    if ( !empty($settings['separator']['url'])) {
		        $content .= '<div class="section-border" style="background: url('. $settings['separator']['url'] .') no-repeat center center;"></div>';
		    }else{
		        $content .= '<div class="svg-border '.$disable_sep.'"><svg width="515" height="25" viewBox="0 0 275 15" fill="none" xmlns="http://www.w3.org/2000/svg">
		        <rect y="7" width="120" height="1" fill="#CCCCCC"/>
		        <rect x="155" y="7" width="120" height="1" fill="#CCCCCC"/>
		        <path d="M144.443 14.6458C144.207 14.8818 143.897 15 143.588 15C143.278 15 142.968 14.8818 142.732 14.6454L137.874 9.78689C137.517 9.43023 137.43 8.90654 137.612 8.46798L136.617 7.47264L135.242 8.84723C135.517 9.2862 135.458 9.8809 135.066 10.2714C134.614 10.7245 133.888 10.7342 133.448 10.2936L130.324 7.17126C129.883 6.73028 129.893 6.00566 130.347 5.55298C130.738 5.16122 131.332 5.10231 131.771 5.37788L135.378 1.77014C135.102 1.33158 135.161 0.737682 135.553 0.346326C136.006 -0.10676 136.73 -0.116443 137.171 0.324136L140.295 3.44732C140.736 3.8879 140.726 4.61251 140.272 5.0656C139.88 5.45736 139.287 5.51586 138.849 5.2407L137.472 6.6169L138.59 7.73449C138.945 7.69334 139.314 7.80348 139.586 8.07622L144.444 12.9347C144.916 13.4071 144.916 14.1729 144.443 14.6458Z" fill="'.$delimitator_color_value.'"/>
		        </svg></div>';
		    }
		    $content .= '<div class="section-subtitle '.$title_color.'">'.$subtitle.'</div>';
		$content .= '</div>';
		echo  $content;
	}
	
	protected function _content_template() {

    }
	
	
}