<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Implements features of FREE version of YITH WooCommerce Request A Quote
 *
 * @class   YITH_YWRAQ_Frontend
 * @package YITH WooCommerce Request A Quote
 * @since   1.0.0
 * @author  YITH
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'YITH_YWRAQ_VERSION' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'YITH_YWRAQ_Frontend' ) ) {

	/**
	 * YITH_YWRAQ_Frontend
	 */
	class YITH_YWRAQ_Frontend {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_YWRAQ_Frontend
		 */
		protected static $instance;

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_YWRAQ_Frontend
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since  1.0
		 * @author Emanuela Castorina
		 */
		public function __construct() {

			// start the session.
			if ( ! headers_sent() && ! session_id() ) {
				session_start();
			}

			add_action( 'wp_loaded', array( $this, 'update_raq_list' ) );

			add_filter( 'body_class', array( $this, 'custom_body_class_in_quote_page' ) );

			// show button in single page.
			add_action( 'woocommerce_single_product_summary', array( $this, 'add_button_single_page' ), 35 );

			// custom styles and javascripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );

			if ( get_option( 'ywraq_hide_add_to_cart' ) === 'yes' ) {
				add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'hide_add_to_cart_loop' ), 10, 2 );
			}

			$shortcodes = new YITH_YWRAQ_Shortcodes();

		}

		/**
		 * Hide add to cart in single page
		 *
		 * Hide the button add to cart in the single product page
		 *
		 * @since  1.0
		 * @author Emanuela Castorina
		 */
		public function hide_add_to_cart_single() {

			global $post;

			if ( ! $post || ! is_object( $post ) || ! is_singular() ) {
				return;
			}

			$product = wc_get_product( $post->ID );
			if ( ! $product ) {
				return;
			}
			if ( get_option( 'ywraq_hide_add_to_cart' ) === 'yes' ) {
				if ( isset( $product ) && $product && $product->is_type( 'variable' ) ) {
					$css = '.single_variation_wrap .variations_button button{
	                 display:none!important;
	                }';
				} elseif ( ! $product->is_type( 'gift-card' ) ) {
					$css = '.cart button.single_add_to_cart_button{
	                 display:none!important;
	                }';
				}
				wp_add_inline_style( 'yith_ywraq_frontend', $css );

			}

		}

		/**
		 * Hide add to cart in loop
		 *
		 * Hide the button add to cart in the shop page
		 *
		 * @param string     $link Link.
		 * @param WC_Product $product Product.
		 * @return mixed|string
		 *
		 * @since  1.0
		 */
		public function hide_add_to_cart_loop( $link, $product ) {

			if ( ! $product->is_type( 'variable' ) ) {
				return '';
			}

			return $link;
		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function enqueue_styles_scripts() {

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_register_script( 'yith_ywraq_frontend', YITH_YWRAQ_ASSETS_URL . '/js/frontend' . $suffix . '.js', array( 'jquery' ), YITH_YWRAQ_VERSION, true );

			$localize_script_args = array(
				'ajaxurl'                 => admin_url( 'admin-ajax.php' ),
				'no_product_in_list'      => esc_html__( 'Your list is empty', 'yith-woocommerce-request-a-quote' ),
				'yith_ywraq_action_nonce' => wp_create_nonce( 'yith-ywraq-ajax-action' ),
				'go_to_the_list'          => ( get_option( 'ywraq_after_click_action', 'no' ) === 'yes' ) ? 'yes' : 'no',
				'rqa_url'                 => YITH_Request_Quote()->get_raq_page_url(),
				'raq_table_refresh_check' => apply_filters( 'yith_ywraq_table_refresh_check', true ),
			);

			wp_localize_script( 'yith_ywraq_frontend', 'ywraq_frontend', $localize_script_args );

			wp_enqueue_style( 'yith_ywraq_frontend', YITH_YWRAQ_ASSETS_URL . '/css/frontend.css', array(), YITH_YWRAQ_VERSION );
			wp_enqueue_script( 'yith_ywraq_frontend' );

			$custom_css = require_once YITH_YWRAQ_TEMPLATE_PATH . 'layout/css.php';
			wp_add_inline_style( 'yith_ywraq_frontend', $custom_css );

			$this->hide_add_to_cart_single();
		}

		/**
		 * Check if the button can be showed in single page
		 *
		 * @since  1.0.0
		 */
		public function add_button_single_page() {

			$show_button = apply_filters( 'yith_ywraq-show_btn_single_page', 'yes' ); //phpcs:ignore

			if ( 'yes' !== $show_button ) {
				return false;
			};

			$this->print_button();
		}

		/**
		 * Print button
		 *
		 * @param mixed $product Product.
		 */
		public function print_button( $product = false ) {

			if ( ! $product ) {
				global $product;
			}

			if ( ! apply_filters( 'yith_ywraq_before_print_button', true, $product ) ) {
				return;
			}

			$style_button = ( get_option( 'ywraq_show_btn_link' ) === 'button' ) ? 'button' : 'ywraq-link';

			$args         = array(
				'class'         => 'add-request-quote-button ' . $style_button,
				'wpnonce'       => wp_create_nonce( 'add-request-quote-' . $product->get_id() ),
				'product_id'    => $product->get_id(),
				'label'         => ywraq_get_label( 'btn_link_text' ),
				'label_browse'  => ywraq_get_label( 'browse_list' ),
				'template_part' => 'button',
				'rqa_url'       => YITH_Request_Quote()->get_raq_page_url(),
				'exists'        => ( $product->is_type( 'variable' ) ) ? false : YITH_Request_Quote()->exists( $product->get_id() ),
			);
			$args['args'] = $args;

			wc_get_template( 'add-to-quote.php', $args, '', YITH_YWRAQ_TEMPLATE_PATH );

		}

		/**
		 * Update the Request Quote List
		 *
		 * @return void
		 * @since  1.0.0
		 */
		public function update_raq_list() {
			if ( isset( $_POST['raq'] ) ) { //phpcs:ignore
				foreach ( $_POST['raq'] as $key => $value ) {  //phpcs:ignore
					if ( 0 !== $value['qty'] ) {
						YITH_Request_Quote()->update_item( $key, 'quantity', $value['qty'] );
					} else {
						YITH_Request_Quote()->remove_item( $key );
					}
				}
			}
		}

		/**
		 * Add a custom body class on quote page.
		 *
		 * @param array $classes Array of body class.
		 * @return array
		 * @since 2.3.0
		 */
		public function custom_body_class_in_quote_page( $classes ) {
			if ( is_page( YITH_Request_Quote()->get_raq_page_id() ) ) {
				$classes[] = 'yith-request-a-quote-page';
			}

			return $classes;
		}


	}

	/**
	 * Unique access to instance of YITH_YWRAQ_Frontend class
	 *
	 * @return YITH_YWRAQ_Frontend
	 */
	function YITH_YWRAQ_Frontend() { //phpcs:ignore
		return YITH_YWRAQ_Frontend::get_instance();
	}
}
