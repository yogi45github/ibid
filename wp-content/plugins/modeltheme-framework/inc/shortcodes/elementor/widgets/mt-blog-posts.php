<?php
namespace Elementor;

class ibid_show_blog_post_widget extends Widget_Base {
	
	public function get_name() {
		return 'blog-posts';
	}
	
	public function get_title() {
		return 'iBid - Blog Posts';
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
				'label' => __( 'Number', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '3',
			]
		);

		$post_category_tax = get_terms('category');
        $post_category = array();
        if ($post_category_tax) {
          foreach ( $post_category_tax as $term ) {
             $post_category[$term->name] = $term->slug;
          }
        }

		$this->add_control(
			'category',
			[
				'label' => __( 'Select Blog Category', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'gadgets',
				'options' => $post_category,
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '3 columns',
				'options' => [
					'vc_col-md-6' => __( '2 columns', 'modeltheme' ),
					'vc_col-md-4' => __( '3 columns', 'modeltheme' ),
					'vc_col-md-3' => __( '4 columns', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'image_left',
				'options' => [
					'image_left' => __( 'Image Left', 'modeltheme' ),
					'image_top' => __( 'Image Top', 'modeltheme' ),
				]
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Choose overlay color', 'modeltheme' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Choose text color', 'modeltheme' ),
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
        $settings 		= $this->get_settings_for_display();
        $category 		= $settings['category'];
        $number 		= $settings['number'];
        $columns 		= $settings['columns'];
        $layout 		= $settings['layout'];
        $overlay_color 	= $settings['overlay_color'];
        $text_color 	= $settings['text_color'];

 $args_posts = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);

    $shortcode_content = '';
    $shortcode_content .= '<div class="ibid_shortcode_blog vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_portfolio_pic400x400' );
        $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_related_post_pic500x300' );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID); 
        $shortcode_content .= '<div class="'.$columns.' post '.$layout.'">';

        if($layout == "image_left" || $layout == "") {
            $shortcode_content .= '<div class="col-md-4 blog-thumbnail">';
                $shortcode_content .= '<a href="'.$url.'" class="relative">';
                    if($thumbnail_src) { 
                        $shortcode_content .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                    }else{ 
                        $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                    }
                    $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                        $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</a>';
            $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="col-md-8 blog-content">';
                $shortcode_content .= '<div class="head-content">';
                    $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '<div class="post-excerpt">'.wp_trim_words($excerpt,9).'</div>';
            $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        }else{
            if($layout == "image_top" || $layout == ""){ 
                $shortcode_content .= '<div class="col-md-12 blog-thumbnail ">';
                    $shortcode_content .= '<a href="'.$url.'" class="relative">';
                        if($thumbnail_src) { 
                            $shortcode_content .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                        }else{ 
                            $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                        }
                        $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                            $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';

                $shortcode_content .= '<div class="col-md-12 blog-content">';
                    $shortcode_content .= '<div class="text-center content-element">';
                            $shortcode_content .= '<p class="author">';
                                $shortcode_content .= '<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )).'">'.esc_html(get_the_author()).'</a> | <span>' . get_the_time('j ',$post->ID) . '</span>' . get_the_time('M, Y',$post->ID) . '';
                            $shortcode_content .= '</p>';
                    $shortcode_content .= '</div>';
                    $shortcode_content .= '<div class="head-content">';
                        $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '</div>';
            }
        }
    }
    
    $shortcode_content .= '</div>';
    echo $shortcode_content;
}
	
	protected function _content_template() {

    }
	
	
}