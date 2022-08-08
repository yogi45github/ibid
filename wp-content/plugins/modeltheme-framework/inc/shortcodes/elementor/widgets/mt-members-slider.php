<?php
namespace Elementor;

class ibid_members_slider_widget extends Widget_Base {
	
	public function get_name() {
		return 'members-slider';
	}
	
	public function get_title() {
		return 'iBid - Members Slider';
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
				'label' => __( 'Slider Options', 'modeltheme' ),
			]
		);
		
		$this->add_control(
			'number',
			[
				'label' => __( 'Number of members', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter number of members to show.', 'modeltheme' ),
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order options', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc' => __( 'Ascending', 'modeltheme' ),
					'desc' => __( 'Descending', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'Disabled', 'modeltheme' ),
					'true' => __( 'Enabled', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'Disabled', 'modeltheme' ),
					'true' => __( 'Enabled', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'autoPlay',
			[
				'label' => __( 'Auto Play', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'Disabled', 'modeltheme' ),
					'true' => __( 'Enabled', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'paginationSpeed',
			[
				'label' => __( 'Pagination Speed', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Pagination Speed(Default: 700)', 'modeltheme' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'modeltheme' ),
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button Link', 'modeltheme' ),
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background Color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'slideSpeed',
			[
				'label' => __( 'Slide Speed', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Slide Speed(Default: 700)', 'modeltheme' ),
			]
		);

		$this->add_control(
			'number_desktop',
			[
				'label' => __( 'Items for Desktops', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Default - 4', 'modeltheme' ),
			]
		);

		$this->add_control(
			'number_tablets',
			[
				'label' => __( 'Items for Tablets', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Default - 2', 'modeltheme' ),
			]
		);

		$this->add_control(
			'number_mobile',
			[
				'label' => __( 'Items for Mobile', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Default - 1', 'modeltheme' ),
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
		global $ibid_redux;
        $settings 			= $this->get_settings_for_display();
        $navigation 		= $settings['navigation'];
        $pagination 		= $settings['pagination'];
        $autoPlay 			= $settings['autoPlay'];
        $paginationSpeed 	= $settings['paginationSpeed'];
        $slideSpeed 		= $settings['slideSpeed'];
        $number_mobile 		= $settings['number_mobile'];
        $number_tablets 	= $settings['number_tablets'];
        $number_desktop 	= $settings['number_desktop'];
        $number 			= $settings['number'];
        $order 				= $settings['order'];

        $html = '';

	    // CLASSES
	    $class_slider = 'mt_slider_members_'.uniqid();
    	$html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );

                });
              </script>';

        $html .= '<div class="mt_members1 '.$class_slider.' row animateIn wow ">';
        $args_members = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => $order,
                'post_type'        => 'member',
                'post_status'      => 'publish' 
                ); 
        $members = get_posts($args_members);
            foreach ($members as $member) {
                #metaboxes
                $metabox_member_position = get_post_meta( $member->ID, 'av-job-position', true );

                $metabox_facebook_profile = get_post_meta( $member->ID, 'av-facebook-link', true );
                $metabox_twitter_profile  = get_post_meta( $member->ID, 'av-twitter-link', true );
                $metabox_linkedin_profile = get_post_meta( $member->ID, 'av-gplus-link', true );
                $metabox_vimeo_url = get_post_meta( $member->ID, 'av-instagram-link', true );

                $member_title = get_the_title( $member->ID );

                $testimonial_id = $member->ID;
                $content_post   = get_post($member);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ),'full' );

                if($metabox_facebook_profile) {
                    $profil_fb = '<a target="_new" href="'. $metabox_facebook_profile .'" class="member01_profile-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i></a> ';
                }

                if($metabox_twitter_profile) {
                    $profil_tw = '<a target="_new" href="https://twitter.com/'. $metabox_twitter_profile .'" class="member01_profile-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i></a> ';
                }

                if($metabox_linkedin_profile) {
                    $profil_in = '<a target="_new" href="'. $metabox_linkedin_profile .'" class="member01_profile-linkedin"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a> ';
                }

                if($metabox_vimeo_url) {
                    $profil_vi = '<a target="_new" href="'. $metabox_vimeo_url .'" class="member01_vimeo_url"> <i class="fa fa-vimeo" aria-hidden="true"></i> </a> ';
                }
                
                $html.='
                    <div class="col-md-12 relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="member_hover" class="members_img_holder">
                                    <div class="member01-content">
                                        <div class="member01-content-inside">
                                            <h3 class="member01_name">'.$member_title.'</h3>
                                            <div class="content-div"><p class="member01_content-desc">'.  $metabox_member_position. '</p></div>
                                            <div class="member01_social">' . $profil_fb . $profil_tw . $profil_in . $profil_vi . '</div>
                                        </div>
                                    </div>
                                    <div class="memeber01-img-holder">';
                                        if($thumbnail_src) { 
                                            $html .= '<div class="grid">
                                                        <div class="effect-duke">
                                                            <img src="'. $thumbnail_src[0] . '" alt="'. $member->post_title .'" />
                                                        </div>
                                                      </div>';
                                        }else{ 
                                            $html .= '<img src="http://placehold.it/450x1000" alt="'. $member->post_title .'" />'; 
                                        }
                                    $html.='</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    $html .= '</div>';
        echo  $html;
	}
	
	protected function _content_template() {

    }
	
	
}