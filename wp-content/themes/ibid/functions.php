<?php
/**
 * ibid functions and definitions
 *
 * @package ibid
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'ibid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ibid_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ibid, use a find and replace
     * to change 'ibid' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'ibid', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'woocommerce', array(
        'gallery_thumbnail_image_width' => 200,
        'woocommerce_thumbnail' => 768,
    ));
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );

    
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ibid' ),
        'menu_header_2' => esc_html__( 'Header 2 Menu', 'ibid' ),
    ) );

    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if (ibid_redux('ibid_header_category_menu') != '') {
            if (ibid_redux('ibid_header_category_menu') != '0') {
                register_nav_menus( array(
                    'category' => esc_html__( 'Category Menu', 'ibid' ),
                ) );
            }
        }
    }

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    /*
     * Enable support for Post Formats.
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'ibid_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif; // ibid_setup
add_action( 'after_setup_theme', 'ibid_setup' );

/**
 * Register widget area.
 *
 */
if (!function_exists('ibid_widgets_init')) {
    function ibid_widgets_init() {

        global $ibid_redux;

        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'ibid' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Sidebar 1', 'ibid' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
        if ( class_exists( 'WooCommerce' ) ) {
            register_sidebar( array(
                'name'          => esc_html__( 'WooCommerce sidebar', 'ibid' ),
                'id'            => 'woocommerce',
                'description'   => esc_html__( 'Used on WooCommerce pages', 'ibid' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            if (isset($ibid_redux['dynamic_sidebars']) && !empty($ibid_redux['dynamic_sidebars'])){
                foreach ($ibid_redux['dynamic_sidebars'] as &$value) {
                    $id           = str_replace(' ', '', $value);
                    $id_lowercase = strtolower($id);
                    if ($id_lowercase) {
                        register_sidebar( array(
                            'name'          => esc_html($value),
                            'id'            => esc_html($id_lowercase),
                            'description'   => esc_html($value),
                            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                            'after_widget'  => '</aside>',
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>',
                        ) );
                    }
                }
            }

            // Footer Widgets Row 1
            if (isset($ibid_redux['ibid_number_of_footer_columns'])) {
                for ($i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns'] ) ; $i++) { 
                    register_sidebar( array(
                        'name'          => esc_html__( 'Footer Row 1, Sidebar ', 'ibid' ).esc_html($i),
                        'id'            => 'footer_column_'.esc_html($i),
                        'description'   => esc_html__( 'Footer sidebar to show widgets by different column grid.', 'ibid' ),
                        'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    ) );
                }
            }

            // Footer Widgets Row 2
            if ($ibid_redux['ibid-enable-footer-widgets-row2'] != '') {
                if (isset($ibid_redux['ibid_number_of_footer_columns_row2'])) {
                    for ($i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns_row2'] ) ; $i++) { 
                        register_sidebar( array(
                            'name'          => esc_html__( 'Footer Row 2, Sidebar ', 'ibid' ).esc_html($i),
                            'id'            => 'footer_column_row2'.esc_html($i),
                            'description'   => esc_html__( 'Footer sidebar to show widgets by different column grid.', 'ibid' ),
                            'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                            'after_widget'  => '</aside>',
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>',
                        ) );
                    }
                }
            }

            // Footer Widgets Row 3
            if ($ibid_redux['ibid-enable-footer-widgets-row3']) {
                if (isset($ibid_redux['ibid_number_of_footer_columns_row3'])) {
                    for ($i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns_row2'] ) ; $i++) { 
                        register_sidebar( array(
                            'name'          => esc_html__( 'Footer Row 3, Sidebar ', 'ibid' ).esc_html($i),
                            'id'            => 'footer_column_row3'.esc_html($i),
                            'description'   => esc_html__( 'Footer sidebar to show widgets by different column grid.', 'ibid' ),
                            'before_widget' => '<aside id="%1$s" class="widget vc_column_vc_container %2$s">',
                            'after_widget'  => '</aside>',
                            'before_title'  => '<h3 class="widget-title">',
                            'after_title'   => '</h3>',
                        ) );
                    }
                }
            }
        }
    }
    add_action( 'widgets_init', 'ibid_widgets_init' );
}


/**
 * Enqueue scripts and styles.
 */
if (!function_exists('ibid_scripts')) {
    function ibid_scripts() {

        //STYLESHEETS
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );
        wp_enqueue_style( 'ibid-responsive', get_template_directory_uri().'/css/responsive.css' );
        wp_enqueue_style( 'ibid-media-screens', get_template_directory_uri().'/css/media-screens.css' );
        wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css' );
        wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css' );
        wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css' );
        wp_enqueue_style( 'simple-line-icons', get_template_directory_uri().'/css/simple-line-icons.css' );
        wp_enqueue_style( 'ibid-styles', get_template_directory_uri().'/css/style.css' );
        if ( !class_exists( 'ReduxFrameworkPlugin' ) ) {
            wp_enqueue_style( 'ibid-skin-default', get_template_directory_uri().'/css/skin-colors/skin-default.css' );
        }
        wp_enqueue_style( 'ibid-style', get_stylesheet_uri() );
        wp_enqueue_style( 'ibid-gutenberg-frontend', get_template_directory_uri().'/css/gutenberg-frontend.css' );
        wp_enqueue_style( 'ibid-dataTables.min', get_template_directory_uri().'/css/dataTables.min.css' );
        if (class_exists('Dokan_Template_Products') || class_exists('WCFM') || class_exists('WCMp')) {
            wp_enqueue_style( 'jquery-datetimepicker', get_template_directory_uri().'/css/jquery.datetimepicker.min.css' );
        }

        //SCRIPTS
        wp_enqueue_script( 'modernizr-custom', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '2.6.2', true );
        wp_enqueue_script( 'js-mtlisitings-dataTables', get_template_directory_uri() . '/js/dataTables.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'jquery-form', get_template_directory_uri() . '/js/jquery.form.js', array('jquery'), '3.51', true );
        wp_enqueue_script( 'jquery-ketchup', get_template_directory_uri() . '/js/jquery.ketchup.all.min.js', array('jquery'), '0.3.1', true );
        wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.13.1', true );
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'uisearch', get_template_directory_uri() . '/js/uisearch.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'jquery-flatshadow', get_template_directory_uri() . '/js/jquery.flatshadow.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/js/jquery.parallax.js', array('jquery'), '1.1.3', true );
        wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/js/count/jquery.appear.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'jquery-countTo', get_template_directory_uri() . '/js/count/jquery.countTo.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'modernizr-viewport', get_template_directory_uri() . '/js/modernizr.viewport.js', array('jquery'), '2.6.2', true );
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.1', true );
        wp_enqueue_script( 'animate', get_template_directory_uri() . '/js/animate.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'jquery-plugin', get_template_directory_uri() . '/js/countdown/jquery.plugin.min.js', array('jquery'), '2.1.0', true );
        wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/js/countdown/jquery.countdown.js', array('jquery'), '2.1.0', true );
        wp_enqueue_script( 'cookie', get_template_directory_uri() . '/js/jquery.cookie.min.js', array('jquery'), '1.0.0', true );
        if ( class_exists( 'WooCommerce' ) ) {
            wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/js/jquery.matchHeight.js', array('jquery'), '1.0.0', true );
        }
        // Color picker for dokan
        if (class_exists('Dokan_Template_Products') || class_exists('WCFM') || class_exists('WCMp')) {
            wp_enqueue_script( 'jquery-datetimepicker', get_template_directory_uri() . '/js/jquery.datetimepicker.full.min.js', array('jquery'), '1.0.0', true );
        }

        // GRID LIST TOGGLE
        if ( class_exists( 'WooCommerce' ) ) {
            if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
                wp_enqueue_script( 'custom-woocommerce', get_template_directory_uri() . '/js/custom-woocommerce.js', array('jquery'), '1.0.0', true );
                wp_enqueue_style( 'dashicons' );
            }
        }

        wp_enqueue_script( 'ibid-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'ibid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'ibid_scripts' );
}



/**
 * Load jQuery datepicker.
 *
 * By using the correct hook you don't need to check `is_admin()` first.
 * If jQuery hasn't already been loaded it will be when we request the
 * datepicker script.
 */
function ibid_enqueue_datepicker() {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
    wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );  
}
add_action( 'wp_enqueue_scripts', 'ibid_enqueue_datepicker' );

/**
 * Enqueue scripts and styles for admin dashboard.
 */
if (!function_exists('ibid_enqueue_admin_scripts')) {
    function ibid_enqueue_admin_scripts( $hook ) {
        wp_enqueue_style( 'admin-style-css', get_template_directory_uri().'/css/admin-style.css' );
        if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
            wp_enqueue_style( 'ibid-admin-style', get_template_directory_uri().'/css/admin-style.css' );
        }
    }
    add_action('admin_enqueue_scripts', 'ibid_enqueue_admin_scripts');
}


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory().'/inc/tgm/include_plugins.php';
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'ibid_vcSetAsTheme' );
function ibid_vcSetAsTheme() {
    vc_set_as_theme( true );
}


add_action( 'vc_base_register_front_css', 'ibid_enqueue_front_css_foreever' );

function ibid_enqueue_front_css_foreever() {
    wp_enqueue_style( 'js_composer_front' );
}

/* ========= LOAD - REDUX - FRAMEWORK ===================================== */
require_once(get_template_directory() . '/redux-framework/ibid-config.php');

// CUSTOM FUNCTIONS
require_once(get_template_directory() . '/inc/custom-functions.php');
require_once(get_template_directory() . '/inc/custom-functions.header.php');
require_once get_template_directory() . '/inc/custom-functions.gutenberg.php';
require_once get_template_directory() . '/inc/custom-functions.popup.php';
if (class_exists( 'WooCommerce' )) {
    require_once get_template_directory() . '/inc/custom-functions.woocommerce.php';
}
// DOKAN MARKETPLACE PLUGIN FUNCTIONS
if (class_exists('Dokan_Template_Products')) {
    require_once get_template_directory() . '/inc/custom-functions.dokan.php';
}
// WCFM MARKETPLACE PLUGIN FUNCTIONS
if (class_exists('WCFM')) {
    require_once get_template_directory() . '/inc/custom-functions.wcfm.php';
}
// WCMP MARKETPLACE PLUGIN FUNCTIONS
if (class_exists('WCMp')) {
    require_once get_template_directory() . '/inc/custom-functions.wcmp.php';
}

/* ========= CUSTOM COMMENTS ===================================== */
require get_template_directory() . '/inc/custom-comments.php';

/* ========= RESIZE IMAGES ===================================== */
add_image_size( 'ibid_member_pic350x350',        350, 350, true );
add_image_size( 'ibid_testimonials_pic110x110',  110, 110, true );
add_image_size( 'ibid_portfolio_pic400x400',     400, 400, true );
add_image_size( 'ibid_portfolio_230x350',     230, 350, true );
add_image_size( 'ibid_product_simple_285x380',     295, 390, true );
add_image_size( 'ibid_featured_post_pic500x230', 500, 230, true );
add_image_size( 'ibid_related_post_pic500x300',  500, 300, true );
add_image_size( 'ibid_post_pic700x450',          700, 450, true );
add_image_size( 'ibid_cat_pic500x500',          500, 500, true );
add_image_size( 'ibid_portfolio_pic500x350',     500, 350, true );
add_image_size( 'ibid_portfolio_pic700x450',     700, 450, true );
add_image_size( 'ibid_single_post_pic1200x500',   1200, 500, true );
add_image_size( 'ibid_single_prod_2',   1200, 200, true );
add_image_size( 'ibid_posts_1100x600',     1100, 600, true );
add_image_size( 'ibid_post_widget_pic70x70',     70, 70, true );
add_image_size( 'ibid_pic100x75',                100, 75, true );


/* ========= LIMIT POST CONTENT ===================================== */
function ibid_excerpt_limit($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit) {
        array_pop($words);
    }
    return implode(' ', $words);
}

/* ========= BREADCRUMBS ===================================== */
if (!function_exists('ibid_breadcrumb')) {
    function ibid_breadcrumb() {
        global $ibid_redux;

         if (  class_exists( 'ReduxFrameworkPlugin' ) ) {
            if ( !$ibid_redux['ibid-enable-breadcrumbs'] ) {
               return false;
            }
        }

        $delimiter = '';
        //text for the 'Home' link
        $name = esc_html__("Home", "ibid");
            if (!is_home() && !is_front_page() || is_paged()) {
                global $post;
                global $product;
                $home = home_url();
                echo '<li><a href="' . esc_url($home) . '">' . esc_html($name) . '</a></li> ' . esc_html($delimiter) . '';
            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                    if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, true, '' . esc_html($delimiter) . ''));
                echo   '<li class="active">' . esc_html(single_cat_title('', false)) .  '</li>';
            } elseif (is_day()) {
                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ' . esc_html($delimiter) . '';
                echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a></li> ' . esc_html($delimiter) . ' ';
                echo  '<li class="active">' . get_the_time('d') . '</li>';
            } elseif (is_month()) {
                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a></li> ' . esc_html($delimiter) . '';
                echo  '<li class="active">' . get_the_time('F') . '</li>';
            } elseif (is_year()) {
                echo  '<li class="active">' . get_the_time('Y') . '</li>';
            } elseif (is_attachment()) {
                echo  '<li class="active">';
                the_title();
                echo '</li>';
            } elseif (class_exists( 'WooCommerce' ) && is_shop()) {
                echo  '<li class="active">';
                echo esc_html__('Shop','ibid');
                echo '</li>';
            }elseif (class_exists('WooCommerce') && is_product()) {
                if (get_the_category()) {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo '<li>' . get_category_parents($cat, true, ' ' . esc_html($delimiter) . '') . '</li>';
                }
                echo  '<li class="active">';
                the_title();
                echo  '</li>';
            } elseif (is_single()) {
                if (get_the_category()) {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo '<li>' . get_category_parents($cat, true, ' ' . esc_html($delimiter) . '') . '</li>';
                }
                echo  '<li class="active">';
                the_title();
                echo  '</li>';
            } elseif (is_page() && !$post->post_parent) {
                echo  '<li class="active">';
                the_title();
                echo  '</li>';
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></li>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb)
                    echo  wp_kses($crumb, 'link') . ' ' . esc_html($delimiter) . ' ';
                echo  '<li class="active">';
                the_title();
                echo  '</li>';
            } elseif (is_search()) {
                echo  '<li class="active">' . get_search_query() . '</li>';
            } elseif (is_tag()) {
                echo  '<li class="active">' . single_tag_title( '', false ) . '</li>';
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo  '<li class="active">' . esc_html($userdata->display_name) . '</li>';
            } elseif (is_404()) {
                echo  '<li class="active">' . esc_html__('404 Not Found','ibid') . '</li>';
            }
            if (get_query_var('paged')) {
                if (is_home() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo  '<li class="active">';
                echo esc_html__('Page','ibid') . ' ' . get_query_var('paged');
                if (is_home() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo  '</li>';
            }
        }
    }
}
// Ensure cart contents update when products are added to the cart via AJAX
if (!function_exists('ibid_woocommerce_header_add_to_cart_fragment')) {
    function ibid_woocommerce_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'View your shopping cart','ibid' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'ibid' ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
        <?php
        $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
    } 
    add_filter( 'woocommerce_add_to_cart_fragments', 'ibid_woocommerce_header_add_to_cart_fragment' );
}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
if (!function_exists('ibid_woocommerce_header_add_to_cart_fragment_qty_only')) {
    function ibid_woocommerce_header_add_to_cart_fragment_qty_only( $fragments ) {
        ob_start();
        ?>
        <span class="cart-contents_qty"><?php echo sprintf ( esc_html__('(%d)', 'ibid'), WC()->cart->get_cart_contents_count() ); ?></span>
        <?php
        $fragments['span.cart-contents_qty'] = ob_get_clean();
        return $fragments;
    } 
    add_filter( 'woocommerce_add_to_cart_fragments', 'ibid_woocommerce_header_add_to_cart_fragment_qty_only' );
}

/**
 * Rename product data tabs
 */
if (class_exists('Dokan_Template_Products')) {
    add_filter( 'woocommerce_product_tabs', 'ibid_rename_tabs', 98 );
    function ibid_rename_tabs( $tabs ) {
        $tabs['more_seller_product']['title'] = __('More from Vendor', 'ibid');
        return $tabs;
    }
}

add_filter( 'woocommerce_widget_cart_is_hidden', 'ibid_always_show_cart', 40, 0 );
function ibid_always_show_cart() {
    return false;
}




// SINGLE PRODUCT
// Unhook functions
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


// Hook functions
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


if ( !function_exists( 'ibid_show_whislist_button_on_single' ) ) {
    function ibid_show_whislist_button_on_single() {
        if ( class_exists( 'YITH_WCWL' ) ) {
            echo '<div class="wishlist-container">';
                echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
            echo '</div>';
        }
    }
    if ( class_exists( 'YITH_WCWL' ) ) {
        add_action( 'woocommerce_single_product_summary', 'ibid_show_whislist_button_on_single', 36 );
    }
}

if (!function_exists('ibid_auction_move_add_to_cart_form_after_auction_form')) {
    function ibid_auction_move_add_to_cart_form_after_auction_form() {
        if ( class_exists('WooCommerce_simple_auction') && class_exists('WooCommerce')) {
            if (is_product()) {
                $product = wc_get_product( get_the_ID() );
                if( $product->is_type( 'auction' ) ){
                    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
                    add_action( 'woocommerce_after_bid_form', 'woocommerce_template_single_add_to_cart');

                    remove_action( 'woocommerce_single_product_summary', 'ibid_show_whislist_button_on_single', 36 );
                    add_action( 'woocommerce_after_bid_form', 'ibid_show_whislist_button_on_single', 36 );

                }elseif( $product->is_type( 'variable' ) ){
                    remove_action( 'woocommerce_single_product_summary', 'ibid_show_whislist_button_on_single', 36 );
                    add_action( 'woocommerce_after_add_to_cart_button', 'ibid_show_whislist_button_on_single', 36 );
                }
            }
        }
    }

    add_action( 'template_redirect', 'ibid_auction_move_add_to_cart_form_after_auction_form' );
}


/* ========= PAGINATION ===================================== */
if ( ! function_exists( 'ibid_pagination' ) ) {
    function ibid_pagination($query = null) {

        if (!$query) {
            global $wp_query;
            $query = $wp_query;
        }
        
        $big = 999999999; // need an unlikely integer
        $current = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : '1');
        echo paginate_links( 
            array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => '?paged=%#%',
                'current'       => max( 1, $current ),
                'total'         => $query->max_num_pages,
                'prev_text'     => esc_html__('&#171;','ibid'),
                'next_text'     => esc_html__('&#187;','ibid'),
            ) 
        );
    }
}

/* ========= SEARCH FOR POSTS ONLY ===================================== */
function ibid_search_filter($query) {
    if ($query->is_search && !isset($_GET['post_type'])) {
        $query->set('post_type', 'post');
    }
    return $query;
}
if( !is_admin() ){
    add_filter('pre_get_posts','ibid_search_filter');
}

/* ========= CHECK FOR PINGBACKS ===================================== */
function ibid_post_has( $type, $post_id ) {
    $comments = get_comments('status=approve&type=' . esc_html($type) . '&post_id=' . esc_html($post_id) );
    $comments = separate_comments( $comments );
    return 0 < count( $comments[ $type ] );
}

/* ========= REGISTER FONT-AWESOME TO REDUX ===================================== */
if (!function_exists('ibid_register_fontawesome_to_redux')) {
    function ibid_register_fontawesome_to_redux() {
        wp_register_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), time(), 'all' );  
        wp_enqueue_style( 'font-awesome' );
    }
    add_action( 'redux/page/redux_demo/enqueue', 'ibid_register_fontawesome_to_redux' );
}


/* Custom functions for woocommerce */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


if (!function_exists('ibid_woocommerce_show_top_custom_block')) {
    function ibid_woocommerce_show_top_custom_block() {
        $args = array();
        global $product;
        global $ibid_redux;
        echo '<div class="thumbnail-and-details">';    
                  
            wc_get_template( 'loop/sale-flash.php' );
            
            echo '<div class="overlay-container">';
                echo '<div class="thumbnail-overlay"></div>';
                echo '<div class="overlay-components">';

                    echo '<div class="component add-to-cart">';
                        woocommerce_template_loop_add_to_cart();
                    echo '</div>';

                    if ( class_exists( 'YITH_WCWL' ) ) {
    	                echo '<div class="component wishlist">';
    	                    echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
    	                echo '</div>';
    	            }

                    if (  class_exists( 'YITH_WCQV' ) ) {
                        echo '<div class="component quick-view">';
                            echo '<a href="'.esc_url('#').'" class="button yith-wcqv-button" data-tooltip="'.esc_attr__('Quickview', 'ibid').'" data-product_id="' . esc_attr(yit_get_prop( $product, 'id', true )) . '"><i class="fa fa-search"></i></a>';
                        echo '</div>';
                    }

                echo '</div>';
            echo '</div>';

            echo '<a class="woo_catalog_media_images" title="'.the_title_attribute('echo=0').'" href="'.esc_url(get_the_permalink(get_the_ID())).'">'.woocommerce_get_product_thumbnail();
                if (class_exists('ReduxFrameworkPlugin')) {
	                if (ibid_redux('ibid-archive-secondary-image-on-hover') != '0' && ibid_redux('ibid-archive-secondary-image-on-hover') != '') {
		                // SECONDARY IMAGE (FIRST IMAGE FROM WOOCOMMERCE PRODUCT GALLERY)
		                $product = new WC_Product( get_the_ID() );
		                $attachment_ids = $product->get_gallery_image_ids();

		                if ( is_array( $attachment_ids ) && !empty($attachment_ids) ) {
		                    $first_image_url = wp_get_attachment_image_url( $attachment_ids[0], 'ibid_portfolio_pic400x400' );
		                    echo '<img class="woo_secondary_media_image" src="'.esc_url($first_image_url).'" alt="'.the_title_attribute('echo=0').'" />';
		                }
	                }
                }
                if ( function_exists('modeltheme_framework') && class_exists( 'ReduxFrameworkPlugin' )) {
                    if ( $ibid_redux['ibid-countdown-status'] == true ) {
                        if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                            $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                            $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );

                            if ($meta_auction_closed == '') {
                                if ($meta_auction_dates_to && !empty($meta_auction_dates_to)) {
                                    $date = date_create($meta_auction_dates_to);
                                    echo do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d H:i:s')).'"]');
                                }
                            }
                        }
                    }
                }
            echo '</a>';
        echo '</div>';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'ibid_woocommerce_show_top_custom_block' );
}


if (!function_exists('ibid_woocommerce_show_price_and_review')) {
    function ibid_woocommerce_show_price_and_review() {
        $args = array();
        global $product;
        global $ibid_redux;

        echo '<div class="details-container">';
            echo '<div class="details-price-container details-item">';

            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                if (ibid_redux('ibid_enable_fundraising') != 'disable' && ibid_redux('ibid_fundraising_in_archives') != false) {
                    $product_cause = get_post_meta( get_the_ID(), 'product_cause', true );
                    if ($product_cause) {
                        echo '<div class="ibid-supported-cause"><i class="fa fa-heart-o" aria-hidden="true"></i> '.esc_html__('Supporting: ', 'ibid').'<a class="cause-child" href="'.get_the_permalink($product_cause).'">'.get_the_title($product_cause).'</a></div>';
                    }
                    echo '<div class="clearfix"></div>';
                }
            }

            wc_get_template( 'single-product/short-description.php' );

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
                
                echo '<div class="details-review-container details-item">';
                    wc_get_template( 'loop/rating.php' );
                echo '</div>';
                    
                echo '<div class="bottom-components">';
                    // Add to cart button
                    echo '<div class="component add-to-cart">';
                        echo woocommerce_template_loop_add_to_cart();
                    echo '</div>';
                    // Wishlist button
                    if ( class_exists( 'YITH_WCWL' ) ) {
                        echo '<div class="component wishlist">';
                            echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
                        echo '</div>';
                    }
                    // Quick View button
                    if ( class_exists( 'YITH_WCQV' ) ) {
                        echo '<div class="component quick-view">';
                            echo '<a href="'.esc_url('#') .'" class="button yith-wcqv-button" data-tooltip="'.esc_attr__('Quickview', 'ibid').'" data-product_id="' . esc_attr(yit_get_prop( $product, 'id', true )) . '"><i class="fa fa-search"></i></a>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="bottom-components-list">';
            // Add to cart button
            echo '<div class="component add-to-cart">';
                echo woocommerce_template_loop_add_to_cart();
            echo '</div>';
            // Wishlist button
            if ( class_exists( 'YITH_WCWL' ) ) {
                echo '<div class="component wishlist">';
                    echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
                echo '</div>';
            }
            // Quick View button
            if ( class_exists( 'YITH_WCQV' ) ) {
                echo '<div class="component quick-view">';
                    echo '<a href="'.esc_url('#') .'" class="button yith-wcqv-button" data-tooltip="'.esc_attr__('Quickview', 'ibid').'" data-product_id="' . esc_attr(yit_get_prop( $product, 'id', true )) . '"><i class="fa fa-search"></i></a>';
                echo '</div>';
            }
        echo '</div>';
    }
    add_action( 'woocommerce_after_shop_loop_item_title', 'ibid_woocommerce_show_price_and_review' );
}



function ibid_woocommerce_get_sidebar() {
    global $ibid_redux;

    if ( is_shop() ) {
        if (is_active_sidebar($ibid_redux['ibid_shop_layout_sidebar'])) {
            dynamic_sidebar( $ibid_redux['ibid_shop_layout_sidebar'] );
        }else{
            if (is_active_sidebar('woocommerce')) {
                dynamic_sidebar( 'woocommerce' );
            } 
        }
    }elseif ( is_product() ) {
        if (is_active_sidebar($ibid_redux['ibid_single_shop_sidebar'])) {
            dynamic_sidebar( $ibid_redux['ibid_single_shop_sidebar'] );
        }else{
            if (is_active_sidebar('woocommerce')) {
                dynamic_sidebar( 'woocommerce' );
            }
        }
    }
}
add_action ( 'woocommerce_sidebar', 'ibid_woocommerce_get_sidebar' );


/*
 * Return a new number of maximum columns for shop archives
 * @param int Original value
 * @return int New number of columns
 */
add_filter( 'loop_shop_columns', 'ibid_wc_loop_shop_columns', 1, 13 );
function ibid_wc_loop_shop_columns( $number_columns ) {
    global $ibid_redux;

    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if ( $ibid_redux['ibid-shop-columns'] ) {
            return $ibid_redux['ibid-shop-columns'];
        }else{
            return 3;
        }
    }else{
        return 3;
    }
}

global $ibid_redux;

if ( isset($ibid_redux['ibid-enable-related-products']) && !$ibid_redux['ibid-enable-related-products'] ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

if ( !function_exists( 'ibid_related_products_args' ) ) {
    add_filter( 'woocommerce_output_related_products_args', 'ibid_related_products_args' );
    function ibid_related_products_args( $args ) {
        global $ibid_redux;

        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            $args['posts_per_page'] = $ibid_redux['ibid-related-products-number'];
        }else{
            $args['posts_per_page'] = 4;
        }
        $args['columns'] = 4;
        return $args;
    }
}


function ibid_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'ibid_add_editor_styles' );


if (!function_exists('ibid_new_loop_shop_per_page')) {
    add_filter( 'loop_shop_per_page', 'ibid_new_loop_shop_per_page', 20 );
    function ibid_new_loop_shop_per_page( $cols ) {
      // $cols contains the current number of products per page based on the value stored on Options -> Reading
      // Return the number of products you wanna show per page.
      $cols = 9;
      return $cols;
    }
}

// KSES ALLOWED HTML
if (!function_exists('ibid_kses_allowed_html')) {
    function ibid_kses_allowed_html($tags, $context) {
      switch($context) {
        case 'link': 
          $tags = array( 
            'a' => array('href' => array()),
          );
          return $tags;
        default: 
          return $tags;
      }
    }
    add_filter( 'wp_kses_allowed_html', 'ibid_kses_allowed_html', 10, 2);
}

if (!function_exists('ibid_redux')) {
    function ibid_redux($redux_meta_name1 = '',$redux_meta_name2 = ''){

        global  $ibid_redux;
        if (is_null($ibid_redux)) {
            return;
        }
        
        $html = '';
        if (isset($redux_meta_name1) && !empty($redux_meta_name2)) {
            $html = $ibid_redux[$redux_meta_name1][$redux_meta_name2];
        }elseif(isset($redux_meta_name1) && empty($redux_meta_name2)){
            $html = $ibid_redux[$redux_meta_name1];
        }
        
        return $html;
    }
}


/* search */
if (!function_exists('ibid_search_form_ajax_fetch')) {
    add_action( 'wp_footer', 'ibid_search_form_ajax_fetch' );
    function ibid_search_form_ajax_fetch() { ?>
        <script type="text/javascript">
         function fetchs(){

             jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: { action: 'ibid_search_form_data_fetch', keyword: jQuery('#keyword').val() },
                success: function(data) {
                    jQuery('#datafetch').html( data );
                }
            });

        }
        </script>
    <?php
    }
}


// the ajax function
if (!function_exists('ibid_search_form_data_fetch')) {
    add_action('wp_ajax_ibid_search_form_data_fetch' , 'ibid_search_form_data_fetch');
    add_action('wp_ajax_nopriv_ibid_search_form_data_fetch','ibid_search_form_data_fetch');
    function ibid_search_form_data_fetch(){
        if (  esc_attr( $_POST['keyword'] ) == null ) { die(); }
            $the_query = new WP_Query( array( 'post_type'=> 'product', 'post_per_page' =>  get_option('posts_per_page'), 's' => esc_attr( $_POST['keyword'] ) ) );
            $count_tax = 0;
            if( $the_query->have_posts() ) : ?>
                <ul class="search-result">           
                    <?php while( $the_query->have_posts() ): $the_query->the_post();  $post_type = get_post_type_object( get_post_type() ); ?>   
                        <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'ibid_post_widget_pic70x70' ); ?>             
                        <li>
                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                                <?php if($thumbnail_src) { ?>
                                    <?php the_post_thumbnail( 'ibid_post_widget_pic70x70' ); ?>
                                <?php } ?>
                                <?php the_title(); ?>
                            </a>
                        </li>             
                    <?php endwhile; ?>
                </ul>       
                <?php wp_reset_postdata();  
            
            endif;
        die();
    }
}


// Removing the WPBakery frontend editor
if (!function_exists('ibid_disable_wpbakery_frontend_editor')) {
    function ibid_disable_wpbakery_frontend_editor(){
        /**
        * Removes frontend editor
        */
        if ( function_exists( 'vc_disable_frontend' ) ) {
            vc_disable_frontend();
        }
    }
    add_action('vc_after_init', 'ibid_disable_wpbakery_frontend_editor');
}


if (!function_exists('ibid_account_login_lightbox')) {
    function ibid_account_login_lightbox(){
        if ( class_exists( 'WooCommerce' ) ) {
            if (!is_user_logged_in() && !is_account_page()) {
                ?>
                <div class="modeltheme-modal-holder">
                    <div class="modeltheme-overlay-inner"></div>
                    <div class="modeltheme-modal-container">
                        <div class="modeltheme-modal" id="modal-log-in">
                            <div class="modeltheme-content" id="login-modal-content">
                                <h3 class="relative text-center">
                                    <?php echo esc_html__('Access Your Account', 'ibid'); ?>
                                </h3>
                                <div class="modal-content row">
                                    <div class="col-md-12">
                                        <?php wc_get_template_part('myaccount/form-login'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <?php
            }
        }
    }
    add_action('ibid_after_body_open_tag', 'ibid_account_login_lightbox');
}

/**
 * Minifying the CSS
  */
function ibid_minify_css($css){
  $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
  return $css;
}