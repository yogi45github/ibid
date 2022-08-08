<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>
<?php
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_single_post_pic1200x500' );
$product_cause = get_post_meta( $post->ID, 'product_cause', true );
$side = "";
$class = "col-md-12";

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ( $ibid_redux['ibid_single_product_layout'] == 'ibid_shop_fullwidth' ) {
        $class = "col-md-12";
    }elseif ( $ibid_redux['ibid_single_product_layout'] == 'ibid_shop_right_sidebar' or $ibid_redux['ibid_single_product_layout'] == 'ibid_shop_left_sidebar') {
        $class = "col-md-9";
        if ( $ibid_redux['ibid_single_product_layout'] == 'ibid_shop_right_sidebar' ) {
        	$side = "right";
        }else{
        	$side = "left";
        }
    }
}
?>
<?php 
  if ( class_exists( 'ReduxFrameworkPlugin' ) ) {        
      if ( ibid_redux('ibid_layout_version') == 'main') {
          $prod_template = 'single-product';
      }else if( ibid_redux('ibid_layout_version') == 'project'){
          $prod_template = 'single-project';
      }
  } else { 
    $prod_template = 'single-product';
  }
  if(class_exists('Mt_Freelancer_Mode')) {
        if((get_option("freelancer_enabled") == "yes")) {
            $mtfm = 'mtfm ';
        } else {
            $mtfm = '';
        }
  } else {
        $mtfm = '';
  }
?>
<?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
    <?php if ($ibid_redux['ibid_layout_version'] == 'main' or $ibid_redux['ibid_layout_version'] == 'project') { ?>
        <!-- Breadcrumbs -->
        <div class="ibid-single-product-v1 <?php echo esc_attr($prod_template) ?>">
            <div class="ibid-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <?php ibid_breadcrumb(); ?>
                            </ol>
                        </div>
                        <div class="col-md-12">
                            <h1><?php the_title(); ?></h1>
                            <?php if ($ibid_redux['ibid_view_counter'] == true) { ?>
                                <?php echo ibid_count_views();?>
                            <?php } ?>
                        </div>
                        <?php if($ibid_redux['ibid_layout_version'] == 'project') { ?>
                            <div class="description col-md-8">
                                <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php if(class_exists('Mt_Freelancer_Mode')) { ?>
                <?php if($ibid_redux['ibid_layout_version'] == 'project' || (get_option("mtfm_enable_styling") == "yes")) { ?>
                    <div class="ibid-breadcrumbs-b sticky-wrapper">
                        <div class="container">
                            <div class="row">
                                <?php echo ibid_tab_header()?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
              
        	<?php
        		/**
        		 * woocommerce_before_main_content hook
        		 *
        		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
        		 * @hooked woocommerce_breadcrumb - 20
        		 */
        		do_action( 'woocommerce_before_main_content' );
        	?>
        		<!-- Page content -->
        	<div class="high-padding">
        	    <!-- Blog content -->
                <div class="container blog-posts">
                    <div class="row">
            	        <?php if ( $side == 'left' ) { ?>
                	        <div class="col-md-3 sidebar-content">
                	            <?php
                					/**
                					 * woocommerce_sidebar hook
                					 *
                					 * @hooked woocommerce_get_sidebar - 10
                					 */
                					do_action( 'woocommerce_sidebar' );
                				?>
                	        </div>
            	        <?php } ?>
                        <div class="<?php echo esc_attr($class); ?> <?php echo esc_attr($mtfm); ?>main-content">
                			<?php while ( have_posts() ) : the_post(); ?>
                				<?php wc_get_template_part( 'content', ''.esc_attr($prod_template).'' ); ?>
                			<?php endwhile; // end of the loop. ?>
            			</div>
            	        <?php if ( $side == 'right' ) { ?>
            	        <div class="col-md-3 sidebar-content">
            	            <?php //dynamic_sidebar( $sidebar ); ?>
            	            <?php
            					/**
            					 * woocommerce_sidebar hook
            					 *
            					 * @hooked woocommerce_get_sidebar - 10
            					 */
            					do_action( 'woocommerce_sidebar' );
            				?>
            	        </div>
            	        <?php } ?>
            	    </div>
                </div>
        	</div>
        	<?php
        		/**
        		 * woocommerce_after_main_content hook
        		 *
        		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        		 */
        		do_action( 'woocommerce_after_main_content' );
        	?>
        <?php get_footer( 'shop' ); ?>

        </div>
    <?php } else { ?>
        <div class="ibid-single-product-v2"> 
            <div class="single-product-header">
                <div class="article-details relative text-center">         

                    <?php the_post_thumbnail( 'ibid_single_prod_2' ); ?>         
                    <div class="header-title-blog text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div class="header-title-blog-box">
                                        <h1><?php the_title(); ?></h1>
                                         <?php global $ibid_redux;
                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') { ?>
                                            <?php if($product_cause){ ?>
                                            <p><?php echo esc_html__('Donated money will go to ','ibid') ?><a class="cause_prod" href="<?php echo get_permalink($product_cause) ?>" title="<?php  echo get_the_title($product_cause) ?>"><?php echo get_the_title($product_cause) ?></a></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action( 'woocommerce_before_main_content' );
            ?>
                <!-- Page content -->
            <div class="high-padding">
                <!-- Blog content -->
                <div class="container blog-posts">
                    <div class="row">
                        <?php if ( $side == 'left' ) { ?>
                            <div class="col-md-3 sidebar-content">
                                <?php
                                    /**
                                     * woocommerce_sidebar hook
                                     *
                                     * @hooked woocommerce_get_sidebar - 10
                                     */
                                    do_action( 'woocommerce_sidebar' );
                                ?>
                            </div>
                        <?php } ?>
                        <div class="<?php echo esc_attr($class); ?> <?php echo esc_attr($mtfm); ?> main-content">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            <?php endwhile; // end of the loop. ?>
                        </div>
                        <?php if ( $side == 'right' ) { ?>
                        <div class="col-md-3 sidebar-content">
                            <?php //dynamic_sidebar( $sidebar ); ?>
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action( 'woocommerce_after_main_content' );
            ?>
            <?php get_footer( 'shop' ); ?>
        </div>
    <?php } ?>
<?php }else{ ?>
    <!-- Breadcrumbs -->
    <div class="ibid-single-product-v1">
        <div class="ibid-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <?php ibid_breadcrumb(); ?>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <?php
            /**
             * woocommerce_before_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             */
            do_action( 'woocommerce_before_main_content' );
        ?>
            <!-- Page content -->
        <div class="high-padding">
            <!-- Blog content -->
            <div class="container blog-posts">
                <div class="row">
                    <?php if ( $side == 'left' ) { ?>
                        <div class="col-md-3 sidebar-content">
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </div>
                    <?php } ?>
                    <div class="<?php echo esc_attr($class); ?> main-content">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php wc_get_template_part( 'content', 'single-product' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    <?php if ( $side == 'right' ) { ?>
                    <div class="col-md-3 sidebar-content">
                        <?php //dynamic_sidebar( $sidebar ); ?>
                        <?php
                            /**
                             * woocommerce_sidebar hook
                             *
                             * @hooked woocommerce_get_sidebar - 10
                             */
                            do_action( 'woocommerce_sidebar' );
                        ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
            /**
             * woocommerce_after_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>
    <?php get_footer( 'shop' ); ?>

    </div>
<?php } ?>