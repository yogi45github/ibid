<?php
namespace Elementor;

class ibid_testimonials_widget extends Widget_Base {
	
	public function get_name() {
		return 'testimonials';
	}
	
	public function get_title() {
		return 'iBid - Testimonials v1';
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
			'number',
			[
				'label' => __( 'Number of testimonials to show', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '3',
			]
		);

		$this->add_control(
			'visible_items',
			[
				'label' => __( 'Visible Testimonials per slide', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( '1', 'modeltheme' ),
					'2' => __( '2', 'modeltheme' ),
					'3' => __( '3', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'testimonial_border_color',
			[
				'label' => __( 'Testimonials border color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 					= $this->get_settings_for_display();
        $testimonial_border_color 	= $settings['testimonial_border_color'];
        $visible_items 				= $settings['visible_items'];
        $number 					= $settings['number'];

        $myContent = '';
	    $myContent .= '<style type="text/css" scoped>
	        .testimonial-img-holder .testimonial-img {
	            border-color: '.$testimonial_border_color.' !important;
	        }
	    </style>';
	    $myContent .= '<div class="vc_row">';
	        $myContent .= '<div class="testimonials-container-'.$visible_items.' owl-carousel owl-theme animateIn">';
	        $args_testimonials = array(
	                'posts_per_page'   => $number,
	                'orderby'          => 'post_date',
	                'order'            => 'DESC',
	                'post_type'        => 'testimonial',
	                'post_status'      => 'publish' 
	                ); 
	        $testimonials = get_posts($args_testimonials);
	            foreach ($testimonials as $testimonial) {
	                #metaboxes
	                $metabox_job_position = get_post_meta( $testimonial->ID, 'job-position', true );
	                $metabox_company = get_post_meta( $testimonial->ID, 'company', true );
	                $testimonial_id = $testimonial->ID;
	                $content_post   = get_post($testimonial_id);
	                $content        = $content_post->post_content;
	                $content        = apply_filters('the_content', $content);
	                $content        = str_replace(']]>', ']]&gt;', $content);
	                #thumbnail
	                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $testimonial->ID ),'ibid_portfolio_pic400x400' );
	                
	                $myContent.='
	                    <div class="wow item vc_col-md-12 relative">
	                        <div class="testimonial01_item">            
	                            <div class="testimonial01-img-holder pull-left">
	                        <div class="testimonail01-content"><p>'.$content.'</p></div>
	                        <div class="testimonial-info-content">';
	                          
	                          $cls = '';
	                          if(!empty($thumbnail_src)) {

	                              $myContent.='<div class="testimonail01-profile-img">';                        
	                                 $myContent.='<img alt="testimonial-image" src="'.$thumbnail_src[0].'">';
	                            $myContent.='</div>';
	                          } else {
	                             $cls .= 'text-center';                           
	                          }
	                         
	                            $myContent.='<div class="testimonail01-name-position '.$cls.'">
	                                <h2 class="name-test"><strong>'. $testimonial->post_title .'</strong></h2>
	                                <p class="position-test">'. $metabox_job_position .'</p>
	                            </div>
	                       </div>
	                      </div>
	                      
	                    </div>
	                 </div>';
	            }
	        $myContent .= '</div>';
	    $myContent .= '</div>';
    echo  $myContent;
	}
	
	protected function _content_template() {

    }
	
	
}