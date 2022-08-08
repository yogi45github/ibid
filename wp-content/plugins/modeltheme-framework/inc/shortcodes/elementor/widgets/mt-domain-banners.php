<?php
namespace Elementor;

class ibid_domain_banners_widget extends Widget_Base {
	
	public function get_name() {
		return 'domain-masonry-banners';
	}
	
	public function get_title() {
		return 'iBid - Domain Masonry Banners';
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
			'banner_img',
			[
				'label' => __( 'Banner Image', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_control(
			'banner_title',
			[
				'label' => __( 'Banner Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'modeltheme' ),
			]
		);
		$this->add_control(
			'banner_prefix',
			[
				'label' => __( 'Banner Prefix', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'modeltheme' ),
			]
		);

		$this->add_control(
			'banner_subtitle',
			[
				'label' => __( 'Banner Subtitle', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'modeltheme' ),
			]
		);

		$this->add_control(
			'banner_url',
			[
				'label' => __( 'Banner Link', 'modeltheme' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'modeltheme' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'dark_skin_background_color',
			[
				'label' => __( 'Dark skin background color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'default_skin_background_color',
			[
				'label' => __( 'Default skin background color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);
		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Styles', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded',
				'options' => [
					'rounded' => __( 'Rounded', 'modeltheme' ),
					'boxed' => __( 'Boxed with Color', 'modeltheme' ),
				]
			]
		);


		$this->end_controls_section();

	}
	
		protected function render() {
		global $ibid_redux;
        $settings 						= $this->get_settings_for_display();
        $banner_title 					= $settings['banner_title'];
        $banner_img 					= $settings['banner_img'];
        $banner_subtitle 				= $settings['banner_subtitle'];
        $banner_prefix 					= $settings['banner_prefix'];
        $banner_url 					= $settings['banner_url']['url'];
        $default_skin_background_color 	= $settings['default_skin_background_color'];
        $button_style 					= $settings['button_style'];
        $dark_skin_background_color 	= $settings['dark_skin_background_color'];


	$shortcode_content = '';


    $shortcode_content .= '<div class="masonry_banners banners_column domains">';

                $shortcode_content .= '<div class="masonry_banner default-skin" style=" background-color: '.$default_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_url.'" class="relative">';
                        $shortcode_content .= '<img src="'. $settings['banner_img']['url'] .'" alt="'.$banner_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h2 class="category_prefix">'.$banner_prefix.'</h2>';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_subtitle.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

        echo  $shortcode_content;
	}


	
	protected function _content_template() {

    }
	
}