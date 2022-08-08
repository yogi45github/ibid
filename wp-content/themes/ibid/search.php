<?php
/**
 * The template for displaying search results pages.
 *
 * @package ibid
 */
get_header(); 
#Redux global variable
global $ibid_redux;

$class = "col-md-12";
$sidebar = "sidebar-1";

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_fullwidth' ) {
        $class = "col-md-12";
    }elseif ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_right_sidebar' or $ibid_redux['ibid_blog_layout'] == 'ibid_blog_left_sidebar') {
        $class = "col-md-9";
    }
    // Check if active sidebar
    $sidebar = $ibid_redux['ibid_blog_layout_sidebar'];
}else{
    $class = "col-md-9";
}
if (!is_active_sidebar( $sidebar )) {
    $class = "col-md-12";
}
?>

<!-- Breadcrumbs -->
<?php echo ibid_header_title_breadcrumbs(); ?>

<!-- Page content -->
<div class="high-padding wwe123">
    <div class="container custom_ad_search">
        <?php echo do_shortcode( '[searchandfilter fields="search"]' ); ?>
        <!-- <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="search-field" placeholder="Search …" value="" name="s">
            </label>
            <input type="submit" class="search-submit" value="Search">
        </form> -->
    </div>
    <!-- Blog content -->
    <div class="container blog-posts">
        <div class="row">
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_left_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content">
                        <?php dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="<?php echo esc_attr($class); ?> main-content">
                <div class="row">
                    <?php if ( have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                            ?>
                        <?php endwhile; ?>
                        <div class="ibid-pagination pagination">             
                            <?php ibid_pagination(); ?>
                        </div>
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>
                    <div>
                        <button class="sidebar_button">Filters</button>
                    </div>
                </div>
            </div>
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_right_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-4 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <?php if ( is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-4 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>                    
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>