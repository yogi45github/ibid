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
                <div class="article-header woocommerce-product-gallery__image">
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_single_post_pic1200x500' ); $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID),$size = 'large' );
                    if($thumbnail_src) { ?>
                        <a data-rel="lightbox-gallery-1" href="<?php echo $img_url[0]; ?>">
                        <?php the_post_thumbnail(); ?>
                        </a>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
                <?php
                    $id=get_the_id();
                    $mattype = get_post_meta( $id, '_ad_image_gallery', true );
                    $custom_default_img = get_option('redux_demo')['ibid_custom_image'];
                    //print_r (explode(",",$mattype));
                    $img_ids = explode(",",$mattype);
                    $no_of_imgs = count($img_ids);
                    if ($no_of_imgs > 4) {
                    
                    ?> 
                    <div class="row post-gal-imgs" id="container1">
                    <div id="slider-container">
                    <span onclick="slideRight()" class="btn"></span>
                    <div id="slider">
                    <?php 
                    foreach($img_ids as $value ){
                      ?> 
                      <div class="col-md-3 col-xs-6 post-img-pad woocommerce-product-gallery__image slide"><?php
                        $img_content = wp_get_attachment_image($value, $size = 'large');
                        $img_url = wp_get_attachment_image_url( $value, $size = 'large' );
                        if(!empty($img_url)){ ?>
                            <a data-rel="lightbox-gallery-1" href="<?php echo $img_url ?>"><img class="set-img-size" src="<?php  echo $img_url; ?>"></a>  
                            <?php } else { ?> 
                                <a data-rel="lightbox-gallery-1" href="<?php echo $custom_default_img ?>"><img class="set-img-size" src="<?php echo $custom_default_img; ?>"></a>
                            <?php } ?>
                      </div><?php
                    }
                    ?>
                    </div>
                    <span onclick="slideLeft()" class="btn"></span>
                    </div>
                   </div>
                   <?php } else { ?> 
                    <div class="row post-gal-imgs"><?php 
                    foreach($img_ids as $value ){
                      ?> 
                      <div class="col-md-3 col-xs-6 post-img-pad woocommerce-product-gallery__image"><?php
                          $img_content = wp_get_attachment_image($value, $size = 'large');
                          $img_url = wp_get_attachment_image_url( $value, $size = 'large' );
                          if(!empty($img_url)){ ?>
                            <a data-rel="lightbox-gallery-1" href="<?php echo $img_url ?>"><img class="set-img-size" src="<?php  echo $img_url; ?>"></a>  
                            <?php } else { ?> 
                                <a data-rel="lightbox-gallery-1" href="<?php echo $custom_default_img ?>"><img class="set-img-size" src="<?php echo $custom_default_img; ?>"></a>
                            <?php } ?>
                      </div><?php
                    }
                    ?>
                   </div>
                   <?php } ?>
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
                <h2 class="custom-h3-ad"> <?php echo get_the_title( $post->ID ); ?> </h2>
                <?php 
                        $mattype = get_post_meta(get_the_ID(),'mat_type',true);
                        $matgrade = get_post_meta(get_the_ID(),'mat_grade',true);
                        $matprice = get_post_meta(get_the_ID(),'asking_price_ad',true);
                        $matlocation = get_post_meta(get_the_ID(),'ad_location',true);
                        $ad_state = get_post_meta(get_the_ID(),'ad_province',true);
                        $ad_city = get_post_meta(get_the_ID(),'ad_city',true);
                        $amount_available = get_post_meta(get_the_ID(),'adau_amount_available',true);
                        if ($mattype == "Other") {
                            $custommattype = get_post_meta(get_the_ID(),'custom_mat_type',true);
                        }
                        //echo "Mat Type ".$matprice;
                ?>
                <div class="article-detail-meta post-date">
                    <span class="custom-data-bold calender"><i class="fa-solid fa-calendar-days"></i>
                    <?php echo esc_html(get_the_date()); ?></span>
                    <?php if ($mattype) { ?>
                        <ul class="padding-0"><li class="custom-data-bold"> Mat Type: </li><?php echo $mattype; 
                        if ($mattype == "Other") {
                            echo " (".$custommattype.")"; 
                        }
                        ?>
                        </ul>
                    <?php } ?>
                    <?php if ($matgrade) { ?>
                        <ul class="padding-0"><li class="custom-data-bold"> Mat Grade:</li> <?php echo $matgrade; ?></ul>
                    <?php } ?>
                    <?php if ($matprice) { ?>
                        <ul class="padding-0"><li class="custom-data-bold"> Mat Price(per mat): </li>$ <?php echo $matprice; ?></ul>
                    <?php } ?>
                    <?php if ($amount_available) { ?>
                        <ul class="padding-0"><li class="custom-data-bold"> Amount available: </li><?php echo $amount_available; ?></ul>
                    <?php } ?>
                    <?php if (!empty($ad_city) && !empty($ad_state)) { ?>
                        <div class="location"><span class="custom-data-bold"><i class="fa-solid fa-location-dot"></i> </span> <?php echo $ad_city .', '.$ad_state; ?></div>
                    <?php } ?>
                </div>
                <?php
                    $p_id = get_the_ID();
                    $user_id=get_current_user_id();
                    $Author = get_post($p_id);
                    $author_id = $Author->post_author;
                    //echo "<pre>";print_r($Author)
                    //echo "Author ".$Author->post_author;
                    if ($user_id == $author_id) {
                        //echo "<h3>You can't make offer on your own ad</h3>";
                        //echo "<div style='pointer-events: none; opacity:0.4;'>".do_shortcode('[post_quote]')."</div>";
                    }else{
                        //echo do_shortcode('[post_quote]'); 
                    }
                ?>
                <div class="ad-intrest-form-btn">
                    <button type="button" class="btn btn-common" data-toggle="modal" data-target="#intrestModal">Make Offer</button>
                </div>
            </div>
        </div>
        <!-- <div id="container1">
            <div id="slider-container">
                <span onclick="slideRight()" class="btn"></span>
                  <div id="slider">
                    <div class="slide"><span>1</span></div>
                    <div class="slide"><span>2</span></div>
                    <div class="slide"><span>3<span></div>
                    <div class="slide"><span>4</span></div>
                    <div class="slide"><span>5</span></div>
                    <div class="slide"><span>6</span></div>
                    <div class="slide"><span>7</span></div>
                    <div class="slide"><span>8</span></div>
                    <div class="slide"><span>9</span></div>
                    <div class="slide"><span>10</span></div>
                </div>
                <span onclick="slideLeft()" class="btn"></span>
            </div>
        </div> -->
        <div class="ad-post-des">
            <h3 class="description-tab-ad">Description</h2>
            <?php
                echo the_content(); 
            ?>
            <?php //echo the_excerpt(); ?>
        </div>
    </div>
</article>