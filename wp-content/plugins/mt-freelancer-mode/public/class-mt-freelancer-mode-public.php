<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://modeltheme.com
 * @since      1.0.0
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/public
 * @author     ModelTheme <support@modeltheme.com>
 */
class Mt_Freelancer_Mode_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
     * The page templates this plugin adds.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $templates    The page templates this plugin adds.
     */
	private $templates;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_main ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->main = $plugin_main;
		$this->templates = array(
            'template-freelancers.php' => __('Freelancers List', 'mt-freelancer-mode'),
        );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mt_Freelancer_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mt_Freelancer_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ((get_option("mtfm_enable_styling") == "yes")) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mt-freelancer-mode-public.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mt_Freelancer_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mt_Freelancer_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ((get_option("mtfm_enable_styling") == "yes")) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mt-freelancer-mode-public.js', array( 'jquery' ), $this->version, false );
		}
	}

	/**
     * Adds our template to the page dropdown
     *
     */
    public function add_new_template( $posts_templates )
    {
        $posts_templates = array_merge( $posts_templates, $this->templates );
        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */
    public function register_project_templates( $atts )
    {

        $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

        $templates = wp_get_theme()->get_page_templates();
        if ( empty( $templates ) ) {
            $templates = array();
        }

        wp_cache_delete( $cache_key , 'themes');

        $templates = array_merge( $templates, $this->templates );

        wp_cache_add( $cache_key, $templates, 'themes', 1800 );

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template( $template )
    {

        global $post;

        if ( ! $post ) {
            return $template;
        }

        if ( ! isset( $this->templates[get_post_meta(
                $post->ID, '_wp_page_template', true
            )] ) ) {
            return $template;
        }

        $file = plugin_dir_path( __FILE__ ). get_post_meta(
                $post->ID, '_wp_page_template', true
            );

        if ( file_exists( $file ) ) {
            return $file;
        } else {
            echo $file;
        }

        return $template;
    }

    
    // Overwrite Search Field
	public function mtfm_custom_product_searchform( $form ) {

	    $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
			<div>
				<label class="screen-reader-text" for="woocommerce-product-search-field-0">' . __( 'Search for:', 'mt-freelancer-mode' ) . '</label>
				<input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="'.esc_attr('Search projects...','mt-freelancer-mode').'" value="' . get_search_query() . '" name="s" />
				<input type="submit" value="'. esc_attr__( 'Search', 'mt-freelancer-mode' ) .'" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';
	    return $form;
	}


	// Add Go to Profile button on Freelancer
	public function mtfm_profile_freelancer_user() {
	 	$user = wp_get_current_user();
	 	$profile_url = get_the_permalink().'freelancers/?username='.$user->user_nicename;
	 	if ( in_array( 'customer', (array) $user->roles )) {
	  		echo '<div class="woocommerce-form-row">
	  			<a class="button btn" href="'.esc_url($profile_url).'">'.esc_html('Your Freelancer Profile','mt-freelancer-mode').'</a>
	  		</div><br>';
	  }
	}


	// Add custom fields for Freelancer
	public function mtfm_add_job_pos_to_edit_account_form() {
	    	$user = wp_get_current_user(); ?>

	    	<h3><?php echo esc_html__('Freelancer Account Information','mt-freelancer-mode')?></h3><br>
	        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="job_position"><?php _e( 'Job Position', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="job_position" id="job_position" value="<?php echo esc_attr( $user->job_position ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="job_experience"><?php _e( 'Job Experience', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="job_experience" id="job_experience" value="<?php echo esc_attr( $user->job_experience ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="fee_hour"><?php _e( 'Fee per hour', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="fee_hour" id="fee_hour" value="<?php echo esc_attr( $user->fee_hour ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="description"><?php _e( 'A few words about you', 'mt-freelancer-mode' ); ?></label>
	        <textarea  name="description" id="description" value="<?php echo esc_attr( $user->description ); ?>"><?php echo esc_attr( $user->description ); ?></textarea>
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="location"><?php _e( 'Location', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="location" id="location" value="<?php echo esc_attr( $user->location ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="user_url"><?php _e( 'Website', 'mt-freelancer-mode' ); ?></label>
	        <input type="url" class="woocommerce-Input woocommerce-Input--user_url input-text" name="user_url" id="user_url" value="<?php echo esc_attr( $user->user_url ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="skills"><?php _e( 'Your Skills (separated with spaces)', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="skills" id="skills" value="<?php echo esc_attr( $user->skills ); ?>" />
	    	</p>

	    	<h3><?php echo esc_html__('Freelancer Social Links','mt-freelancer-mode')?></h3><br>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="fb_link"><?php _e( 'Facebook Link', 'mt-freelancer-mode' ); ?></label>
	        <input type="url" class="woocommerce-Input woocommerce-Input--fb_link input-text" name="fb_link" id="fb_link" value="<?php echo esc_attr( $user->fb_link ); ?>" />
	    	</p>

	    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	        <label for="tw_link"><?php _e( 'Twitter Link', 'mt-freelancer-mode' ); ?></label>
	        <input type="text" class="woocommerce-Input woocommerce-Input--tw_link input-text" name="tw_link" id="tw_link" value="<?php echo esc_attr( $user->tw_link ); ?>" />
	    	</p>
    <?php
	}

	// Save the custom fields for Freelancer
	public function mtfm_save_job_pos_account_details( $user_id ) {
	    if( isset( $_POST['job_position'] ) )
	        update_user_meta( $user_id, 'job_position', sanitize_text_field( $_POST['job_position'] ) );
	    if( isset( $_POST['job_experience'] ) )
	        update_user_meta( $user_id, 'job_experience', sanitize_text_field( $_POST['job_experience'] ) );
	    if( isset( $_POST['fee_hour'] ) )
	        update_user_meta( $user_id, 'fee_hour', sanitize_text_field( $_POST['fee_hour'] ) );
	    if( isset( $_POST['description'] ) )
	        update_user_meta( $user_id, 'description', sanitize_text_field( $_POST['description'] ) );
	    if( isset( $_POST['skills'] ) )
	        update_user_meta( $user_id, 'skills', sanitize_text_field( $_POST['skills'] ) );
	    if( isset( $_POST['location'] ) )
	        update_user_meta( $user_id, 'location', sanitize_text_field( $_POST['location'] ) );
	    if( isset( $_POST['user_url'] ) )
	        update_user_meta( $user_id, 'user_url', sanitize_text_field( $_POST['user_url'] ) );
	    if( isset( $_POST['fb_link'] ) )
	        update_user_meta( $user_id, 'fb_link', sanitize_text_field( $_POST['fb_link'] ) );
	    if( isset( $_POST['tw_link'] ) )
	        update_user_meta( $user_id, 'tw_link', sanitize_text_field( $_POST['tw_link'] ) );
	}

	// Add Profile link to dropdown
	public function mtfm_my_freelancer_profile() {
		$user = wp_get_current_user();
        $profile_url = get_the_permalink().'freelancers/?username='.$user->user_nicename;
        if ( in_array( 'customer', (array) $user->roles )) {
        echo '<li class="profile"><a href="'.esc_url($profile_url).'"><i class="icon-trophy icons"></i>'.esc_html__('My Public Profile','mt-freelancer-mode').' </a></li>';
        }
	}

	// Add Go to Profile button on Freelancer
	public function mtfm_change_role_placeholder() {
	 	echo '<h2>'.esc_html('The Employer','mt-freelancer-mode').'</h2>';
	}	

	// Functionality : Add note with bid
	public function mtfm_custom_add_coment_textarea_on_bid(){
	 	global $product;
		 	echo '<div class="coment-on-bid" style="clear:both">';
		 	echo '<textarea name="coment_on_bid" placeholder="Send a message with this bid*"></textarea>';
		 	echo '</div>';

	}

	public function mtfm_check_if_there_is_note_on_bid($product_data){
		global $_POST;
		if( (!isset($_POST['coment_on_bid'] ) or !$_POST['coment_on_bid']) ){
	 		wc_add_notice(__('You must add note to your bid!', 'mt-freelancer-mode'), 'error');
	 		return false;	
	 	}
		return $product_data;

	}

	public function mtfm_add_note_woocommerce_simple_auction_admin_history_header(){
	        echo '<th>';
	        _e('Note', 'mt-freelancer-mode');
	        echo '</th>';
	}

	public function mtfm_custom_save_comment_on_bid($log_bid_id, $product_id,$bid, $current_user ){
		global $_POST;		
		if(isset($_POST['coment_on_bid'] ) AND $_POST['coment_on_bid']  AND ($log_bid_id )){
	 		 add_post_meta($product_id, 'bid_note_'.$log_bid_id , sanitize_text_field( $_POST['coment_on_bid']),true);
	 	} 	
	}

	function mtfm_add_note_woocommerce_simple_auction_admin_history_row($product, $auction_history){
		$bid_note = get_post_meta( $product->get_id(), 'bid_note_'.$auction_history->id, true );
		echo '<td>';
		echo $bid_note;
		echo '</td>';	
	}
	public function mtfm_breadcrumb() {
		echo '<div class="mtfm-breadcrumbs">
          		<div class="container">
              		<div class="row">
                  		<div class="col-md-12">
                      		<ol class="breadcrumb">';
                          		$home      = home_url();
                          		$name      = esc_html__("Home", "mt-freelancer-mode");
                          echo '<li><a href="'.esc_attr($home).'">'.esc_attr($name).'</a></li><span>'.get_the_title().'</span></li>';
                      echo '</ol>
                  </div>   
                  <div class="col-md-12">
                      <h1>'.get_the_title().'</h1>';
                  echo '</div>               
              </div>
          </div>
      </div>';
	}
	// Shortcode : MT Projects List
	 public function mtfm_projects_list_shortcode( $params ){
        extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'button_text'                          => '',
            'hide_empty'                           => '',
            'items_per_row'                        => ''
        ), $params ) );

    $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => $number_of_products_by_category,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $blogposts = new WP_Query( $args );

    $shortcode_content = '';
    $shortcode_content .= '<div class="freelancer woocommerce_categories list">';

            $shortcode_content .= '<div class="freelancer_category">';
                while ($blogposts->have_posts()) {
                $blogposts->the_post();
                global $product;
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'ibid_cat_pic500x500' );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.get_the_title().'" />';
                  }else{
                    $post_img = '';
                  }
                $shortcode_content .= '
                    <div class="'.$items_per_row.' freelancer-list-shortcode">
                        <div class="post">
                            
                            <div class="woocommerce-title-metas">
                                <div class="modeltheme-thumbnail-and-details">
                                    <a class="modeltheme_media_image" title="'.esc_attr(get_the_title()).'" href="'.esc_url(get_permalink(get_the_ID())).'"> '.$post_img.'</a>
                                </div>
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title().'</a>
                                </h3>
                                <p>'.ibid_excerpt_limit($product->get_description(),40).'</p>
                                <div class="woocommerce_product__category">
                                    <span class="posted_in">';
                                    $cat_name = get_the_term_list(get_the_ID(), 'product_cat', '', ' , ');          
                                    $shortcode_content .= ''.wp_kses_post($cat_name).'</span>
                                </div>
                            </div>';
                            $shortcode_content .= '
                            <div class="project-bid">';
                             if ( class_exists( 'WooCommerce_simple_auction' ) ) {

                                  // metas
                                  $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                                    $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
                                    $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );

                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $shortcode_content .= '<p>'.esc_html__('Current bid: ','mt-freelancer-mode').''.wc_price($meta_auction_current_bid).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a class="button btn" href="'.get_permalink().'"</a>'.$button_text.'</a>
                                                  </div>';
                                      }else if($meta_auction_start_price){
                                        $shortcode_content .= '<p>'.esc_html__('Starting bid: ','mt-freelancer-mode').''.wc_price($meta_auction_start_price).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a class="button btn" href="'.get_permalink().'"</a>'.$button_text.'</a>
                                                  </div>';
                                      }
                                    }else {
                                      $shortcode_content .= '<p class="price">'.esc_html__('Auction closed','mt-freelancer-mode').'</p>';
                                    }
                                  }
                                }
                            $shortcode_content .= '</div>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';
                }
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
    }

	//Shortcode : MT Custom Categories

	function mtfm_custom_categories($params, $content = NULL) {

	    extract( shortcode_atts( 
	        array(
	          'additional_title' => '',
	          'category'         => '',
	          'image'            => ''
	        ), $params ) );

	    $thumb      = wp_get_attachment_image_src($image, "ibid_post_widget_pic70x70");
	    $cat 		= get_term_by('slug', $category, 'product_cat');
	    $thumb_src  = $thumb[0]; 
	    $html = '';
	    if ($cat) {
		    $html .= '<div class="categories-wrapper">';
		        $html .= '<div class="mt-categories-content">'; 
			      $html .= '<ul class="single-category-wrapper">'; 
			        $html .= '<a href="'.get_term_link($cat->slug, 'product_cat').'"><li class="single-category">';
			          if($thumb_src) { 
			              $html .= '<img src="'.$thumb_src.'" data-src="'.$thumb_src.'" alt="'.$additional_title.'">';
			          }else{ 
			              $html .= '<img src="http://placehold.it/50x50" alt="'.$additional_title.'" />'; 
			          }
			          $html .= '<span class="mt-title">'.$additional_title.'</span>'; 
			          $html .= '<span class="cat-count"><strong>('.$cat->count.')</strong></span>';   
			        $html .= '</li></a>';
			      $html .= '</ul>';
			     $html .= '</div>';
	    	$html .= '</div>';
	    }
	      return $html;
	}
    /**

	||-> Map Shortcode in Visual Composer with: vc_map();

	*/
	public function mtfm_vc_shortcodes(){
	  if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
	    vc_map(
          array(
          "name" => esc_attr__("MT Freelancer Mode - Projects List Type", 'mt-freelancer-mode'),
          "base" => "mtfm_projects_list",
          "category" => esc_attr__('MTFM', 'mt-freelancer-mode'),
          "icon" => "modeltheme_shortcode",
          "params" => array(
            array(
               "group" => "Settings",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Number of items to show", 'mt-freelancer-mode'),
               "param_name" => "number"
            ),
            array(
               "group" => "Settings",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Custom Button Text", 'mt-freelancer-mode'),
               "param_name" => "button_text"
            ),
            array(
              "group" => "Settings",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Items Per Row", 'mt-freelancer-mode'),
              "param_name" => "items_per_row",
              "std" => '',
              "description" => "",
              "value" => array(
                  esc_attr__('1 Items/Row', 'mt-freelancer-mode')         => 'col-md-12',
                  esc_attr__('2 Items/Row', 'mt-freelancer-mode')         => 'col-md-6',
              )
            )
         )
        ));
        $category = array();
        $category_title = array();
        if ( class_exists( 'WooCommerce' ) ) {
          $terms = get_terms('product_cat',array('hide_empty' => 0));
          if ($terms) {
            foreach ($terms as $term) {
              $category[$term->slug] = $term->name;
            }
          }

          if ($terms) {
            foreach ($terms as $term) {
              $category_title[$term->name] = $term->slug;
            }
          }
        }
        vc_map( array(
            "name" => esc_attr__("MT Freelancer Mode - Categories", 'mt-freelancer-mode'),
            "base" => "mtfm_custom_categories_short",
            "category" => esc_attr__('MTFM', 'mt-freelancer-mode'),
            "icon" => "modeltheme_shortcode",
            "params" => array(
                 array(
                   "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Set additional title",'mt-freelancer-mode'),
                   "param_name" => "additional_title",
                   "std" => ''
                ),
                array(
	               "type" => "dropdown",
	               "group" => "Options",
	               "class" => "",
	               "heading" => esc_attr__("Select Category Slug", "mt-freelancer-mode"),
	               "param_name" => "category",
	               "description" => esc_attr__("Please select base category", "mt-freelancer-mode"),
	               "std" => '',
	               "value" => $category
	            ), 
                array(
                   "group" => "Options",
                   "type" => "attach_image",
                      "class" => "",
                      "heading" => esc_attr__( "Image Icon", 'mt-freelancer-mode' ),
                      "param_name" => "image",
                      "value" => esc_attr__( "#", "mt-freelancer-mode" )
                   ),  
                
            )
        ) );
    	}
	}
}