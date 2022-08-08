<?php 
defined( 'ABSPATH' ) || exit;

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


	/**
	 * IBID_WC_List_Grid class
	 **/
	if ( ! class_exists( 'IBID_WC_List_Grid' ) ) {

		class IBID_WC_List_Grid {

			public function __construct() {
				// Hooks
  				add_action( 'wp' , array( $this, 'ibid_setup_gridlist' ) , 20);
			}

			/*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/

			// Setup
			function ibid_setup_gridlist() {
				if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
					add_action( 'wp_enqueue_scripts', array( $this, 'ibid_setup_scripts_script' ), 20);
					add_action( 'woocommerce_before_shop_loop', array( $this, 'ibid_gridlist_toggle_button' ), 30);
					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'ibid_gridlist_buttonwrap_open' ), 9);
					add_action( 'woocommerce_after_shop_loop_item', array( $this, 'ibid_gridlist_buttonwrap_close' ), 11);
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
					add_action( 'woocommerce_after_subcategory', array( $this, 'ibid_gridlist_cat_desc' ) );
				}
			}

			function ibid_setup_scripts_script() {
				add_action( 'wp_footer', array( $this, 'ibid_gridlist_set_default_view' ) );
			}

			// Toggle button
			function ibid_gridlist_toggle_button() {

				$grid_view = __( 'Grid view', 'ibid' );
				$list_view = __( 'List view', 'ibid' );

				$output = sprintf( '<nav class="gridlist-toggle"><a href="#" id="grid" title="%1$s"><span class="dashicons dashicons-grid-view"></span> <em>%1$s</em></a><a href="#" id="list" title="%2$s"><span class="dashicons dashicons-exerpt-view"></span> <em>%2$s</em></a></nav>', $grid_view, $list_view );

				echo apply_filters( 'ibid_gridlist_toggle_button_output', $output, $grid_view, $list_view );
			}

			// Button wrap
			function ibid_gridlist_buttonwrap_open() {
				echo apply_filters( 'gridlist_button_wrap_start', '<div class="gridlist-buttonwrap">' );
			}
			function ibid_gridlist_buttonwrap_close() {
				echo apply_filters( 'gridlist_button_wrap_end', '</div>' );
			}

			function ibid_gridlist_set_default_view() {
				global $ibid_redux;
				$default = 'grid';
				if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
					if ($ibid_redux['ibid_shop_grid_list_switcher'] && !empty($ibid_redux['ibid_shop_grid_list_switcher'])) {
						$default = $ibid_redux['ibid_shop_grid_list_switcher'];
					}
				}
				?>
					<script>
					if ( 'function' == typeof(jQuery) ) {
						jQuery(document).ready(function($) {
							if ($.cookie( 'gridcookie' ) == null) {
								$( 'ul.products' ).addClass( '<?php echo esc_html($default); ?>' );
								$( '.gridlist-toggle #<?php echo esc_html($default); ?>' ).addClass( 'active' );
							}
						});
					}
					</script>
				<?php
			}

			function ibid_gridlist_cat_desc( $category ) {
				global $woocommerce;
				echo apply_filters( 'ibid_gridlist_cat_desc_wrap_start', '<div itemprop="description">' );
					echo wp_kses_post($category->description);
				echo apply_filters( 'ibid_gridlist_cat_desc_wrap_end', '</div>' );

			}
		}

		$IBID_WC_List_Grid = new IBID_WC_List_Grid();
	}
}


// WooCommerce My account tab: My Auction Bids
if ( class_exists( 'WooCommerce_simple_auction' ) ) {
	/**
	* 1. Register new endpoint slug to use for My Account page
	*/
	if (!function_exists('ibid_my_auctions_tab_endpoint')) {
		function ibid_my_auctions_tab_endpoint() {
		    add_rewrite_endpoint( 'my-auction-bids', EP_ROOT | EP_PAGES );
		}
		add_action( 'init', 'ibid_my_auctions_tab_endpoint' );
	}

	/**
	 * 2. Add new query var
	 */
	if (!function_exists('ibid_my_auctions_tab_query_vars')) {
		function ibid_my_auctions_tab_query_vars( $vars ) {
		    $vars[] = 'my-auction-bids';
		    return $vars;
		}
		add_filter( 'woocommerce_get_query_vars', 'ibid_my_auctions_tab_query_vars', 0 );
	}

	/**
	 * 3. Insert the new endpoint into the My Account menu
	 */
	if (!function_exists('ibid_my_auctions_tab_link_my_account')) {
		function ibid_my_auctions_tab_link_my_account( $items ) {
		    $items['my-auction-bids'] = esc_html__('My Auction Bids', 'ibid');
		    return $items;
		}
		add_filter( 'woocommerce_account_menu_items', 'ibid_my_auctions_tab_link_my_account' );
	}

	/**
	* 4. Add content to the new endpoint
	*/
	if (!function_exists('ibid_my_auctions_tab_content')) {
		function ibid_my_auctions_tab_content() {
			echo do_shortcode( '[woocommerce_simple_auctions_my_auctions]' );
		}
		add_action( 'woocommerce_account_my-auction-bids_endpoint', 'ibid_my_auctions_tab_content' );
	}
}


if (!function_exists('ibid_custom_search_form')) {
	add_action('ibid_products_search_form','ibid_custom_search_form');
	function ibid_custom_search_form(){ ?>
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
		        <input type="hidden" name="post_type" value="product" />
				<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search...', 'ibid' ); ?>" value="" name="s">
				<input type="submit" class="search-submit" value="&#xf002">
			</label>
		</form>
	<?php }
}


if (!function_exists('ibid_auction_mask_display_name')) {
	if ( class_exists( 'WooCommerce_simple_auction' ) && class_exists( 'WooCommerce' )) {
		add_filter( 'woocommerce_simple_auctions_displayname', 'ibid_auction_mask_display_name' );
		function ibid_auction_mask_display_name( $displayname ) {
		    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
		    	return $displayname;
		    } else {
		    	if (class_exists('ReduxFrameworkPlugin')) {
		    		if (ibid_redux('ibid_single_product_auction_history_username_format') == 'original') {
		    			return $displayname;
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'hide_username') {
				        $length      = strlen( $displayname );
				        $displayname = $displayname[0] . str_repeat( '*', $length - 2 ) . $displayname[ $length - 1 ];
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'show_message') {
				    	return esc_html__( 'Bidder Name Hidden', 'ibid' );
		    		}elseif (ibid_redux('ibid_single_product_auction_history_username_format') == 'hidden') {
				    	return '';
		    		}
		    	}

		    }

		    return $displayname;
		}
	}
}

// Add to cart Projects
if (!function_exists('ibid_single_price')) {
	function ibid_single_price(){
		 if ( class_exists( 'WooCommerce_simple_auction' ) ) {
            $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
            $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
            $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
            $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );

            $_product = wc_get_product( get_the_ID() );
            if( $_product->is_type( 'auction' ) ) {
                if ($meta_auction_closed == '') {
                    if (!empty($meta_auction_current_bid)) {
                        echo '<span class ="price">'.esc_html__('Current Bid: ', 'ibid').wc_price($meta_auction_current_bid).'</span>';
                    }else{
                        echo '<span class ="price">'.esc_html__('Starting bid: ', 'ibid').wc_price($meta_auction_start_price).'</span>';
                    }
                }else{
                    echo esc_html__('Auction Ended', 'ibid');
                }
            }else{
                wc_get_template( 'loop/price.php' );
            }
        }else{
            wc_get_template( 'loop/price.php' );
        }
        echo '<div class="modeltheme-button-bid text-center">
                <a href ="'.esc_url(get_permalink(get_the_ID())).'">'.esc_html__('Bid Now','ibid').'</a>
             </div>';
    }
}

// Add project breadcrumbs
if (!function_exists('ibid_tab_header')) {
	function ibid_tab_header(){
		 echo '<div class="project-tabs"> 
			 	<ul>
			 		<li><a data-scroll href="#tab-description"> '.esc_html__('Details','ibid').'</a></li>
			 		<li><a data-scroll href="#tab-simle_auction_history"> '.esc_html__('Proposals','ibid').'</a></li>
			 	</ul>
			 </div>';
    }
}


// Add "Attachments" Tab
if (!function_exists('ibid_attach_pdf_product_tab')) {
	add_filter( 'woocommerce_product_tabs', 'ibid_attach_pdf_product_tab' );
	function ibid_attach_pdf_product_tab( $tabs ) {
	// Adds the new tab
		$ibid_pdf_attach = get_post_meta( get_the_ID(), 'ibid_pdf_attach', true );
	  	if($ibid_pdf_attach) {
		    $tabs['attach_tab'] = array(
		        'title'     => esc_html__( 'Attachments', 'ibid' ),
		        'callback'  => 'ibid_attach_pdf_product_tab_content'
		    );
		}
	    return $tabs;
	}
}
if (!function_exists('ibid_attach_pdf_product_tab_content')) {
	function ibid_attach_pdf_product_tab_content() {
	  $ibid_pdf_attach = get_post_meta( get_the_ID(), 'ibid_pdf_attach', true );
	  if($ibid_pdf_attach) {
		  echo '<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--attach panel entry-content wc-tab" id="attach-pdf" role="tabpanel" aria-labelledby="tab-attach-pdf">';
		  	echo '<h2>'.esc_html__('Attachments','ibid').'</h2>';
		  	echo '<a class="button btn" target="_blank" href="'.esc_url($ibid_pdf_attach).'">'.esc_html__('Download Brief','ibid').'</a>';
		  echo '</div>';
		}
	}
}

// Views counter on single
if (!function_exists('ibid_count_views')) {
	function ibid_count_views() {
	    global $product;   
	    $product_pageviews = get_post_meta(  get_the_ID(), 'pageview', true );
	    if ($product_pageviews) {
		    echo '<div class="mt-view-count"><i class="fa fa-eye"></i>';
		        echo '<span class="views">'.sprintf( _n( '%s view', '%s views', $product_pageviews, 'ibid' ), number_format_i18n( $product_pageviews ) ).'</span>';
		    echo '</div>';
	    }
	}
}


if(!class_exists('Mt_Freelancer_Mode') or get_option("freelancer_enabled") == "no") {
  if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if($ibid_redux['ibid_bid_message'] == true) {

	// Add note with bid
	if (!function_exists('ibid_custom_add_coment_textarea_on_bid')) { 
		function ibid_custom_add_coment_textarea_on_bid(){
			global $product, $ibid_redux;
			
			echo '<div class="coment-on-bid theme" style="clear:both">';
				echo '<textarea name="coment_on_bid" placeholder="'.esc_html__('Send a message with this bid*','ibid').'"></textarea>';
			echo '</div>';	
		}
	}
	add_action( 'woocommerce_after_bid_button', 'ibid_custom_add_coment_textarea_on_bid'); 

	if (!function_exists('ibid_check_if_there_is_note_on_bid')) { 
		function ibid_check_if_there_is_note_on_bid($product_data){
			global $_POST, $ibid_redux;

			if( (!isset($_POST['coment_on_bid'] ) or !$_POST['coment_on_bid']) ){
				wc_add_notice(esc_html__('You must add a note to your bid!', 'ibid'), 'error');
				return false;	
			}
			return $product_data;						
		}
	}
	add_filter( 'woocommerce_simple_auctions_before_place_bid_filter', 'ibid_check_if_there_is_note_on_bid');

	if (!function_exists('ibid_add_note_woocommerce_simple_auction_admin_history_header')) { 
		function ibid_add_note_woocommerce_simple_auction_admin_history_header(){
			global $_POST, $ibid_redux;
			echo '<th>';
				esc_html_e('Note', 'ibid');
			echo '</th>';	
		}
	}
	add_action( 'woocommerce_simple_auction_admin_history_header', 'ibid_add_note_woocommerce_simple_auction_admin_history_header');

	if (!function_exists('ibid_custom_save_comment_on_bid')) {
		function ibid_custom_save_comment_on_bid($log_bid_id, $product_id,$bid, $current_user ){
			global $_POST, $ibid_redux;
			
			if(isset($_POST['coment_on_bid'] ) AND $_POST['coment_on_bid']  AND ($log_bid_id )){
				add_post_meta($product_id, 'bid_note_'.$log_bid_id , sanitize_text_field( $_POST['coment_on_bid']),true);
			} 	
		}
	}
	add_action( 'woocommerce_simple_auctions_log_bid', 'ibid_custom_save_comment_on_bid', 10, 4);

	if (!function_exists('ibid_add_note_woocommerce_simple_auction_admin_history_row')) {
		function ibid_add_note_woocommerce_simple_auction_admin_history_row($product, $auction_history){
			global $ibid_redux;
	
			$bid_note = get_post_meta( $product->get_id(), 'bid_note_'.$auction_history->id, true );
			echo '<td>';
				echo esc_attr($bid_note);
			echo '</td>';		
		}
	}
	add_action( 'woocommerce_simple_auction_admin_history_row', 'ibid_add_note_woocommerce_simple_auction_admin_history_row',10,2);
 } 
}}

//Extend Auction End Time
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if ($ibid_redux['ibid_extend_bid_time'] == true) {

		add_action( 'woocommerce_simple_auctions_outbid', 'ibid_woocommerce_simple_auctions_extend_timer', 50 );
		add_action( 'woocommerce_simple_auctions_proxy_outbid', 'ibid_woocommerce_simple_auctions_extend_timer', 50 );

		if (!function_exists('ibid_woocommerce_simple_auctions_extend_timer')) {
			function ibid_woocommerce_simple_auctions_extend_timer($data) {
				global $ibid_redux;
				$product = wc_get_product( $data['product_id'] );
				if ('auction' === $product->get_type() ){
					$date1 = new DateTime($product->get_auction_dates_to());
					$date1->add(new DateInterval('PT'.$ibid_redux['ibid_extend_bid_time_nr'].''.$ibid_redux['ibid_extend_bid_time_type'].''));
					update_post_meta( $data['product_id'], '_auction_dates_to', $date1->format('Y-m-d H:i:s') );
				}
			}
		}
	}
}


//Nextend Social Links
if (class_exists('NextendSocialLogin') && !class_exists('NextendSocialLoginPRO')) {
	if (!function_exists('ibid_get_social_btns_form')) {

		function ibid_get_social_btns_form() {
			echo do_shortcode('[nextend_social_login]');
		}

		add_action('woocommerce_after_customer_login_form','ibid_get_social_btns_form');
		// add_action('woocommerce_login_form_end','ibid_get_social_btns_form');
		// add_action('woocommerce_register_form_end','ibid_get_social_btns_form');
	}
}




//Shortcode : Selling value
if (!function_exists('ibid_product_selling_value')) {
	function ibid_product_selling_value( $id='' ) {
	       
	    // GET CURRENT USER ORDERS
	    $all_orders = wc_get_orders(
	        array(
	            'limit'    => -1,
	            'status'   => array( 'completed', 'processing'),
	        )
	    );
	    
	    $count = 0;
	    if($id) {
		    if($all_orders) {
			    foreach ( $all_orders as $single_order ) {
			        $order = wc_get_order( $single_order->get_id() );
			        $items = $order->get_items();
			        foreach ( $items as $item ) {
			            $product_id = $item->get_product_id();
			            if ( $product_id == $id ) {
			                $count = $count + absint( $item->get_total() ); 
			            }
			        }
			    }
		    }
		}
	    // RETURN HTML
	    return $count;
	}
}

// define the woocommerce_before_add_to_cart_form callback
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
		if (!function_exists('ibid_fundraising_stats_before_add_to_cart_form')) { 
		function ibid_fundraising_stats_before_add_to_cart_form() { 
		
		    $money_goal = get_post_meta( get_the_ID(), 'mt_money_goal', true );
		    $variable_end_date = get_post_meta( get_the_ID(), 'mt_variable_end_date', true );
		    ?>
		    <?php if ( is_product() ){ ?>
		        <?php if (isset($money_goal) && !empty($money_goal)) { ?>
		            <?php 
		            $current_raised_money = ibid_product_selling_value(get_the_ID());
		            $goal_percentage = ($current_raised_money !== 0 ? ($current_raised_money / $money_goal) : 0) * 100;
		            $ending_datetime = date('Y-m-d H:i', strtotime($variable_end_date));
		            $blogtime = current_time( 'mysql' );
		            $blogtime_format = date('Y-m-d H:i', strtotime($blogtime));

		            ?>
		            <div class="campaign_donation_holder col-md-12 col-xs-12">
		                <div class="campaign_summary">

		                    <?php if($ending_datetime < $blogtime_format){ ?>
		                        <h3 class="text-center"><?php echo esc_html__('This campaign is now over.','ibid') ?></h3> 
		                    <?php } ?>
		                    <div class="progress_text center">
		                        <?php echo number_format($goal_percentage, 2); ?><?php echo esc_html__('% Funded','ibid'); ?>
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="campaign_procentage progress col-md-12">
		                        <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format($goal_percentage, 2); ?>%;"></div>
		                    </div>

		                    <div class="campaign_donated ">
		                        <h3 class="campaign_donated_value"><span class="amount"><?php echo wc_price($current_raised_money); ?></span> <?php echo esc_html__('donated of','ibid'); ?> <span class="goal-amount"><?php echo wc_price($money_goal); ?></span> <?php echo esc_html__('goal','ibid'); ?></h3>
		                    </div>
		                    <?php if (!empty($variable_end_date)) { ?>
		                        <?php if($ending_datetime > $blogtime_format){ ?>
		                            <div class="campaign_days_left ">
		                                <h3 class="campaign_days_left_value"><?php echo esc_html__('Available until ','ibid') .  date('Y-m-d H:i', strtotime($variable_end_date)); ?></h3>
		                            </div>
		                        <?php } ?>
		                    <?php } ?>
		                </div>
		            </div>
		        <?php } ?>
		    <?php } ?>
		 <?php } ?>
	<?php } 
         
	// add the action 
	add_action( 'woocommerce_single_product_summary', 'ibid_fundraising_stats_before_add_to_cart_form', 5, 0 ); 
	}	
}


// if (!function_exists('ibid_ajax_login_init')) {
//     function ibid_ajax_login_init(){

//         wp_register_script('ibid-ajax-login', get_template_directory_uri() . '/js/ajax-login.js', array('jquery') ); 
//         wp_enqueue_script('ibid-ajax-login');

//         wp_localize_script( 'ibid-ajax-login', 'ajax_login_object', array( 
//             'ajaxurl' => admin_url( 'admin-ajax.php' ),
//             'redirecturl' => home_url(),
//             'loadingmessage' => esc_html__('Sending user info, please wait...', 'ibid')
//         ));

//         // Enable the user with no privileges to run ajax_login() in AJAX
//         add_action( 'wp_ajax_nopriv_ajaxlogin', 'ibid_ajax_login' );
//     }
// }
// if (!function_exists('ibid_ajax_login')) {
//     function ibid_ajax_login(){

//         // First check the nonce, if it fails the function will break
//         check_ajax_referer( 'ajax-login-nonce', 'security' );

//         // Nonce is checked, get the POST data and sign user on
//         $info = array();
//         $info['user_login'] = $_POST['username'];
//         $info['user_password'] = $_POST['password'];
//         $info['remember'] = true;

//         $user_signon = wp_signon( $info, false );
//         if ( is_wp_error($user_signon) ){
//             echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Wrong username or password.', 'ibid')));
//         } else {
//             echo json_encode(array('loggedin'=>true, 'message'=> esc_html__('Login successful, redirecting...', 'ibid')));
//         }

//         die();
//     }
// }

// if(!function_exists('ibid_ajax_register_init')) {
//     function ibid_ajax_register_init(){

//     wp_register_script('ajax-register-script', get_template_directory_uri() . '/js/ajax-register.js', array('jquery') );
//     wp_enqueue_script('ajax-register-script');

//     wp_localize_script( 'ajax-register-script', 'ajax_register_object', array(
//         'ajaxurl' => admin_url( 'admin-ajax.php' ),
//         'redirecturl' => home_url(),
//         'loadingmessage' => __('Sending user info, please wait...','ibid')
//     ));

//     // Enable the user with no privileges to run ajax_login() in AJAX

//     }
//     add_action('init', 'ibid_ajax_register_init');
// }

// if (!function_exists('ibid_ajax_register')) {
//     function ibid_ajax_register(){

//         // Nonce is checked, get the POST data and sign user on
//         $info = array();
//         $info['user_login'] = $_POST['username'];
//         $info['user_email'] = $_POST['email'];
//         $info['user_password'] = $_POST['password'];
//         $user_signup = wp_insert_user( $info);  

//             if (!is_wp_error($user_signup) ){
//                 echo json_encode(array('loggedin'=>true, 'message'=>__('Registration complete, redirecting...','ibid')));
//             } else {
//                 echo json_encode(array('loggedin'=>false, 'message'=>__('Username or email already taken.','ibid')));
//             }
//             wp_set_current_user($user_signup);
//             wp_set_auth_cookie($user_signup);
        
//         die();
//     }
//     add_action( 'wp_ajax_register_user', 'ibid_ajax_register' );
//     add_action( 'wp_ajax_nopriv_register_user', 'ibid_ajax_register' );
// }
// // Execute the action only if the user isn't logged in
// if (!is_user_logged_in()) {
//     add_action('init', 'ibid_ajax_login_init');
// }