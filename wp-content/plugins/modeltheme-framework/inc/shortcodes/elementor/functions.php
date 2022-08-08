<?php

class My_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once('widgets/mt-title-subtitle.php');
		require_once('widgets/mt-blog-posts.php');
		require_once('widgets/category-product-v2.php');
		require_once('widgets/mt-recent-products.php');
		require_once('widgets/mt-list-group.php');
		require_once('widgets/mt-masonry-banners.php');
		require_once('widgets/mt-members-slider.php');
		require_once('widgets/mt-testimonials.php');
		require_once('widgets/mt-skill.php');
		require_once('widgets/mt-products-expiring-soon.php');
		require_once('widgets/category-expired-soon.php');
		require_once('widgets/mt-featured-auctions.php');
		require_once('widgets/mt-countdown.php');
		require_once('widgets/mt-featured-no-image.php');
		require_once('widgets/mt-shop-feature.php');
		require_once('widgets/mt-title-subtitle-v2.php');
		require_once('widgets/featured_simple_product.php');
		require_once('widgets/mt-domain-banners.php');
		require_once('widgets/mt-blog-posts-boxed.php');
		require_once('widgets/mt-shop-sale-banner.php');
		require_once('widgets/mt-latest-products-styled.php');
		require_once('widgets/mt-latest-products-boxed.php');
		require_once('widgets/mt-domain-categories.php');
		require_once('widgets/mt-domains-list-grid.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_heading_title_subtitle_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_show_blog_post_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\shop_categories_with_xsthumbnails_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_recent_products_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\mt_list_group_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_shop_masonry_banners_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_members_slider_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_testimonials_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_skill_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\shop_expiring_soon_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\shop_expired_with_thumbnails_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\modeltheme_shortcode_featured_product_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\modeltheme_shortcode_countdown_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\modeltheme_shortcode_featured_product_no_image_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\shop_feature_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_heading_title_subtitle_v2_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\modeltheme_featured_simple_product_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_domain_banners_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_show_blog_post_boxed_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_shop_sale_banner_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_latest_styled_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_latest_products_boxed_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_domain_categories_with_thumbnails_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ibid_latest_domains_widget() );
	}

}

add_action( 'init', 'my_elementor_init' );
function my_elementor_init() {
	My_Elementor_Widgets::get_instance();
}

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'ibid-widgets',
		[
			'title' => __( 'iBid', 'modeltheme' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );