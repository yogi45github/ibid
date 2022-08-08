<?php
namespace Elementor;

class mt_list_group_widget extends Widget_Base {
	
	public function get_name() {
		return 'list-group-item';
	}
	
	public function get_title() {
		return 'iBid - Icon List Group Item';
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
				'label' => __( 'Image Setup', 'modeltheme' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'attach_images',
			[
				'label' => __( 'Choose image', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'list_image_max_width',
			[
				'label' => __( 'Image max width', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '50',
				'placeholder' => __( 'Default: 50(px)', 'modeltheme' ),
			]
		);

		$this->add_control(
			'list_image_margin',
			[
				'label' => __( 'Image Margin right (px)', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_setup',
			[
				'label' => __( 'Icon Setup', 'modeltheme' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list_icon_size',
			[
				'label' => __( 'Icon Size (px)', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '18',
				'placeholder' => __( 'Default: 18(px)', 'modeltheme' ),
			]
		);

		$this->add_control(
			'list_icon_margin',
			[
				'label' => __( 'Icon Margin right (px)', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'list_icon_color',
			[
				'label' => __( 'Icon Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'list_icon__hover_color',
			[
				'label' => __( 'Icon Hover Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'label_setup',
			[
				'label' => __( 'Label Setup', 'modeltheme' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list_icon_title',
			[
				'label' => __( 'Label/Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'list_icon_subtitle',
			[
				'label' => __( 'Label/SubTitle', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'list_icon_url',
			[
				'label' => __( 'Label/Icon URL', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'http://modeltheme.com', 'modeltheme' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'list_icon_title_size',
			[
				'label' => __( 'Title Font Size', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'list_icon_title_color',
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
			'list_icon_subtitle_size',
			[
				'label' => __( 'SubTitle Font Size', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'list_icon_subtitle_color',
			[
				'label' => __( 'SubTitle Color', 'modeltheme' ),
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
        $settings 				= $this->get_settings_for_display();
        $attach_images 			= $settings['attach_images'];
        $list_icon__hover_color = $settings['list_icon__hover_color'];
        $list_icon_url 			= $settings['list_icon_url']['url'];
        $list_icon_margin 		= $settings['list_icon_margin'];
        $list_icon_color 		= $settings['list_icon_color'];
        $list_icon_size 		= $settings['list_icon_size'];
        $list_image_margin 		= $settings['list_image_margin'];
        $list_icon_title_size 	= $settings['list_icon_title_size'];
        $list_icon_title_color 	= $settings['list_icon_title_color'];
        $list_icon_title 		= $settings['list_icon_title'];
        $list_icon_subtitle_size= $settings['list_icon_subtitle_size'];
        $list_icon_subtitle_color = $settings['list_icon_subtitle_color'];
        $list_icon_subtitle 	= $settings['list_icon_subtitle'];

        $thumb      = wp_get_attachment_image_src($attach_images, "full");
        $thumb_src  = $thumb[0];
        $html = '';
        if(!empty($list_icon__hover_color)) {
		    $html .= '<style type="text/css">
		                  .mt-icon-listgroup-holder:hover i {
		                      color: '.$list_icon__hover_color.' !important;
		                  }
		              </style>';
		 }
		  $html .= '<div class="mt-icon-listgroup-item wow ">';
		              if (!empty($list_icon_url)) {
		                $html .= '<a href="'.$list_icon_url.'">';
		              }
		      $html .= '<div class="mt-icon-listgroup-holder">
		                  <div class="mt-icon-listgroup-icon-holder-inner">';
		                      $html .='<img alt="list-image" style="margin-right:'.esc_attr($list_image_margin).'px;" class="mt-image-list" src="'. $settings['attach_images']['url'] .'">';
		                  $html .= '</div>
		                <div class="mt-icon-listgroup-content-holder-inner">
		                  <p class="mt-icon-listgroup-title" style="font-size: '.esc_attr($list_icon_title_size).'px; color: '.esc_attr($list_icon_title_color).'">'.esc_attr($list_icon_title).'</p>
		                  <p class="mt-icon-listgroup-text" style="font-size: '.esc_attr($list_icon_subtitle_size).'px; color: '.esc_attr($list_icon_subtitle_color).'">'.esc_attr($list_icon_subtitle).'</p>                  
		                </div>
		              </div>';
		              if (!empty($list_icon_url)) {
		                $html .= '</a>';
		              }
		            $html .= '</div>';

        echo  $html;
	}
	
	protected function _content_template() {

    }
	
	
}