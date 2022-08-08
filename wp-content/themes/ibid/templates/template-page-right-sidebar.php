<?php
/**
 *
 * Template Name: Page - right sidebar
 *
 * @package ibid
 */

get_header(); 

global $ibid_redux;

$page_slider              = get_post_meta( get_the_ID(), 'select_revslider_shortcode', true );
$page_sidebar             = get_post_meta( get_the_ID(), 'select_page_sidebar',        true );
$breadcrumbs_on_off       = get_post_meta( get_the_ID(), 'breadcrumbs_on_off',         true );

?>
    <?php if ($breadcrumbs_on_off == 'yes') { ?>

    <!-- Breadcrumbs -->
    <?php echo ibid_header_title_breadcrumbs(); ?>
    
    <?php } ?>


    <!-- Revolution slider -->
    <?php 
    if (!empty($page_slider)) {
        echo '<div class="ibid_header_slider">';
        echo do_shortcode('[rev_slider '.esc_html($page_slider).']');
        echo '</div>';
    }
    ?>


    <!-- Page content -->
    <div id="primary" class="high-padding content-area">
        <div class="container">
            <div class="row">
                <main id="main" class="col-md-8 site-main main-content">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'page' ); ?>

                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>
                </main>

            <?php if ( is_active_sidebar( $page_sidebar )) { ?>
                <div class="col-md-4 sidebar-content">
                    <?php  dynamic_sidebar( $page_sidebar ); ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>