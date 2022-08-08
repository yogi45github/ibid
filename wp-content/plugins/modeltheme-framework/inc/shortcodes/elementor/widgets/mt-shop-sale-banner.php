<?php
namespace Elementor;

class ibid_shop_sale_banner_widget extends Widget_Base {
	
	public function get_name() {
		return 'shop-sale-banner';
	}
	
	public function get_title() {
		return 'iBid - Sale Banner';
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
				'label' => __( 'Banner Imag', 'modeltheme' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
		$this->add_control(
			'banner_button_text',
			[
				'label' => __( 'Banner Title', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'banner_button_count',
			[
				'label' => __( 'Banner Subtitle', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'banner_button_url',
			[
				'label' => __( 'Banner url', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your "Banner url', 'modeltheme' ),
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Title Position', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        			   => 'Select Layout',
                    'bottom'          => 'Bottom Left',
                    'center'               => 'Center',
                    'right'           => 'Half Right',

				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Subtitle color', 'modeltheme' ),
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
        $settings 	= $this->get_settings_for_display();
        $banner_img 		= $settings['banner_img'];
        $banner_button_text 	= $settings['banner_button_text'];
        $banner_button_count = $settings['banner_button_count'];
        $banner_button_url = $settings['banner_button_url'];
        $layout = $settings['layout'];
        $title_color = $settings['title_color'];
        $subtitle_color = $settings['subtitle_color'];



    $banner = wp_get_attachment_image_src($banner_img, "large");
    if (isset($layout)) {
        if ($layout == '' || $layout == 'bottom') {
            $layout_type = 'sale_banner_holder';
        }elseif($layout == 'center'){
            $layout_type = 'sale_banner_center';
        }elseif($layout == 'right'){
            $layout_type = 'sale_banner_right';
        }
    }else{
        $layout_type = 'sale_banner_holder';
    }

    $shortcode_content = '';
    #SALE BANNER
    $shortcode_content .= '<div class="sale_banner relative">';
            $shortcode_content .= '<img src="'. $settings['banner_img']['url'] .'" alt="'.$banner_button_text.'" />';
            $shortcode_content .= '<a href="'.$banner_button_url.'">
                                    <div class="'.$layout_type.'">';
                $shortcode_content .= '<div class="masonry_holder">';
                    $shortcode_content .= '<h3 style="color:'.$title_color.';" class="category_name">'.$banner_button_text.'</h3>';
                        $shortcode_content .= '<p style="color:'.$subtitle_color.'" class="category_count">'.$banner_button_count.'</p>';
                        if($layout == 'right'){
                             $shortcode_content .= '<span class="read-more ">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        }
                    $shortcode_content .= '</div>';
            $shortcode_content .= '</div></a>';
    $shortcode_content .= '</div>';
       
    echo $shortcode_content;
}
	
	protected function _content_template() {

    }
		
}