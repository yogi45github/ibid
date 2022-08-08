<?php
/**
 * @package ibid
 */

#Redux global variable
global $ibid_redux;


$class = "col-md-12";
$sidebar = "sidebar-1";
$post_slug = get_post_field( 'post_name', get_post() );

// Check if active sidebar
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    // Get redux framework sidebar position
    if ( $ibid_redux['ibid_single_blog_layout'] == 'ibid_blog_fullwidth' ) {
        $class = "col-md-6";
    }elseif ( $ibid_redux['ibid_single_blog_layout'] == 'ibid_blog_right_sidebar' or $ibid_redux['ibid_single_blog_layout'] == 'ibid_blog_left_sidebar') {
        $class = "col-md-8";
    }
    $sidebar = $ibid_redux['ibid_single_blog_sidebar'];
}else{
    $class = "col-md-12";
}
if (!is_active_sidebar( $sidebar )) {
    $class = "col-md-6";
}
?>

<!-- Breadcrumbs -->
<?php echo ibid_header_title_breadcrumbs(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post high-padding '. esc_attr($post_slug)); ?>>
    <div class="container">
       <div class="row">
            <div class="<?php echo esc_attr($class); ?> main-content">
                <div class="article-header">
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_single_post_pic1200x500' ); 
                    if($thumbnail_src) { ?>
                        <?php the_post_thumbnail( 'ibid_single_post_pic1200x500' ); ?>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <div class="article-details">
                        <!-- POST AUTHOR -->
                         <div class="article-detail-meta post-author">
                            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>">
                                <i class="icon-user"></i>
                                <?php echo esc_html(get_the_author()); ?>
                            </a>
                        </div> 
                        <!-- POST CATEGORY -->
                        <?php if (get_the_category()) { ?>
                             <div class="article-detail-meta post-categories post-author">
                                <?php echo get_the_term_list( get_the_ID(), 'category', '<i class="icon-tag"></i>', ', ' ); ?>
                            </div> 
                        <?php } ?>
                        <!-- POST DATE -->
                        <div class="article-detail-meta post-date">
                            <i class="icon-calendar"></i>
                            <?php echo esc_html(get_the_date()); ?>
                        </div>
                    </div>
                </div>
                
                <div class="article-content">
                    <?php the_content(); ?>

                    <div class="clearfix"></div>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ibid' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div>

                <div class="article-footer">
                    <?php if (get_the_tags()) { ?>
                        <div class="single-post-tags">
                            <span><?php echo esc_html__('Tags:', 'ibid') ?></span> <?php echo get_the_term_list( get_the_ID(), 'post_tag', '', ' ' ); ?>
                        </div>
                    <?php } ?>
                </div>


                <div class="clearfix"></div>
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
             </div>

                
             <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $ibid_redux['ibid_single_blog_layout'] == 'ibid_blog_right_sidebar' && is_active_sidebar( $sidebar )) { ?>
                <div class="col-md-4 sidebar-content sidebar-content-right-side">
                    <?php dynamic_sidebar( $sidebar ); ?>
                </div>
                <?php } ?>
            <?php }else{ ?>
                <?php if ( is_active_sidebar( $sidebar ) && $class != 'col-md-12') { ?>
                    <div class="col-md-4 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>                    
            <?php } ?>
            
            <div class="ad-interest col-md-6">
                    <?php echo do_shortcode('[post_quote]'); ?>
            </div>
        </div>
    </div>
</article>