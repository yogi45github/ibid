<?php
namespace Elementor;

class modeltheme_shortcode_featured_product_widget extends Widget_Base {
	
	public function get_name() {
		return 'featured-auction';
	}
	
	public function get_title() {
		return 'iBid - Featured Auction';
	}
	
	public function get_icon() {
		return 'fab fa-elementor';
	}
	
	public function get_categories() {
		return [ 'ibid-widgets' ];
	}
	
	

	protected function _register_controls() {

		$this->start_controls_section(
			'options',
			[
				'label' => __( 'Options', 'modeltheme' ),
			]
		);

		$this->add_control(
			'select_product',
			[
				'label' => __( 'Write Product ID', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '4450',
			]
		);

		$this->add_control(
			'subtitle_product',
			[
				'label' => __( 'Write Subtitle Product', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styling',
			[
				'label' => __( 'Styling', 'modeltheme' ),
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Featured product background color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'category_text_color',
			[
				'label' => __( 'Product category color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'product_name_text_color',
			[
				'label' => __( 'Product name color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label' => __( 'Product price color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button text', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'button_background_color1',
			[
				'label' => __( 'Button gradient color - 1', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'button_background_color2',
			[
				'label' => __( 'Button gradient color - 2', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Button text color', 'modeltheme' ),
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
        $settings 					= $this->get_settings_for_display();
        $background_color 			= $settings['background_color'];
        $select_product 			= $settings['select_product'];
        $category_text_color 		= $settings['category_text_color'];
        $subtitle_product 			= $settings['subtitle_product'];
        $product_name_text_color 	= $settings['product_name_text_color'];
        $price_text_color 			= $settings['price_text_color'];
        $button_background_color1 	= $settings['button_background_color1'];
        $button_text 				= $settings['button_text'];
        $button_text_color 			= $settings['button_text_color'];
        
        $html = '';
	    $html .= '<div class="featured_product_shortcode col-md-12 wow " style=" background-color: '.$background_color.';">';
	      $args_blogposts = array(
	              'posts_per_page'   => 1,
	              'order'            => 'DESC',
	              'post_type'        => 'product',
	              'post_status'      => 'publish' 
	              ); 
	              
	      $blogposts = get_posts($args_blogposts);
	      

	      foreach ($blogposts as $blogpost) {
	      global $woocommerce, $product, $post;
	   
	      $content_post = get_post($select_product);
	      $content = $content_post->post_content;
	      $meta_auction_dates_to = get_post_meta( $select_product, '_auction_dates_to', true );
	      $date = date_create($meta_auction_dates_to);
	      $content = apply_filters('the_content', $content);
	      $content = str_replace(']]>', ']]&gt;', $content);


	        $html .= '<div class="featured_product_details_holder  col-md-6">';
	          $html.='<h2 class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</h2>';
	          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
	                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>

	                  </h1>';
	          
	          $html.='<div class="featured_product_description">'.$content.'</div>';
	          $html.='<div class="featured_product_countdown">
	                    
	                 '.do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d H:i:s')).'"]').'</div>';
	       
	          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';

	        $html .= '</div>';

	        $html .= '<div class="featured_product_image_holder col-md-6">';
	          if ( has_post_thumbnail( $select_product ) ) {
	              $attachment_ids[0] = get_post_thumbnail_id( $select_product );
	              $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
	              $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
	             }
	        $html .= '</div>';

	      }
	    $html .= '</div>';
        echo  $html;
	}
	
	protected function _content_template() {

    }
		
}