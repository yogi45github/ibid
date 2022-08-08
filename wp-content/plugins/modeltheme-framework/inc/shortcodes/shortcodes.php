<?php
/*------------------------------------------------------------------
[ibid - SHORTCODES]
Project:    ibid – Multi-Purpose WordPress Template
Author:     ModelTheme
[Table of contents]
1. Recent Tweets
2. Contact Form
4. Recent Posts
5. Featured Post with thumbnail
6. Testimonials
7. Subscribe form
8. Services style 1
9. Services style 2
10. Recent Portfolios
11. Recent testimonials
12. Skill
13. Google map
14. Pricing tables
15. Jumbotron
16. Alert
17. Progress bars
18. Custom content
19. Responsive video (YouTube)
20. Heading With Border
21. Testimonials
22. List group
23. Thumbnails custom content
24. Section heading with title and subtitle
25. Heading with bottom border
26. Portfolio square
27. Call to action
28. Blog posts
29. Social Media
30. Countdown Version 2
-------------------------------------------------------------------*/
global $ibid_redux;

include_once( 'mt-typed-text/mt-typed-text.php' ); # Typed text
include_once( 'mt-products-filter/mt-products-filters.php' ); # Typed text
include_once( 'mt-causes-grid/mt-causes-grid.php' );
include_once( 'mt-map-pins/mt-map-pins.php' );
include_once( 'mt-video/mt-video.php' );
include_once( 'mt-search-auctions/mt-searchform.php' );
include_once( 'mt-category-tabs/mt-category-tab.php' );
/*---------------------------------------------*/
/*--- 2. Contact Form ---*/
/*---------------------------------------------*/
function ibid_contact_form_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => ''
        ), $params ) );
    global $ibid_redux;
    if (isset($_POST['contact_me'])) {
        $to = $ibid_redux['ibid_contact_email'];
        $subject = $_POST['user_subject'];
        $form_user_name = $_POST['user_name'];
        $form_user_email = $_POST['user_email'];
        $form_comment = $_POST['user_message'];
        $message = '';
        $message .= "Subject: " . $subject . "\r\n";
        $message .= "From: " .  $form_user_name . "\r\n";
        $message .= "Email: " . $form_user_email . "\r\n" . "\r\n";
        $message .= $form_comment . "\r\n";
        $headers = 'From: ' . $form_user_name . '<'. $form_user_email . '>';
        if( mail( $to, $subject, $message, $headers ) ) {
            #echo "<p>Your email has been sent! Thank you</p>";
        }
    }
    
    $contact_form = '';
    $contact_form .= '<form method="POST" class="animateIn" id="contact_form" novalidate="novalidate" data-animate="'.$animation.'">';
        #Name
        $contact_form .= '<div class="vc_col-md-4">';
            $contact_form .= '<input type="text" placeholder="'.__('Your Name','modeltheme').'" class="form-control" name="user_name">';
        $contact_form .= '</div>';
        #Email
        $contact_form .= '<div class="vc_col-md-4">';
            $contact_form .= '<input type="text" placeholder="'.__('Your Email','modeltheme').'" class="form-control" name="user_email">';
        $contact_form .= '</div>';
        #Subject
        $contact_form .= '<div class="vc_col-md-4">';
            $contact_form .= '<input type="text" placeholder="'.__('Subject','modeltheme').'" class="form-control" name="user_subject">';
        $contact_form .= '</div>';
        $contact_form .= '<div class="mt-half-spacer"></div>';
        #Message
        $contact_form .= '<div class="vc_col-md-12">';
            $contact_form .= '<textarea name="user_message" rows="10" placeholder="'.__('Your Message','modeltheme').'" class="form-control"></textarea>';
        $contact_form .= '</div>';
        $contact_form .= '<div class="mt-half-spacer"></div>';
        #Submit button
        $contact_form .= '<div class="vc_col-md-12">';
            $contact_form .= '<input type="submit" class="solid-button button form-control" value="Send Now" name="contact_me">';
            $contact_form .= '<p class="success_message">'.__('Thank you! We\'ll get back to you as soon as possible.','modeltheme').'</p>';
        $contact_form .= '</div>';
    $contact_form .= '</form>';
    return $contact_form;
}
add_shortcode('contact_form', 'ibid_contact_form_shortcode');

/*---------------------------------------------*/
/*--- 4. Recent Posts ---*/
/*---------------------------------------------*/
function ibid_posts_calendar_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'     => '',
            'number'    => ''
        ), $params ) );
    $posts_calendar = '';
    $posts_calendar .= '<div class="latest-posts animateIn" data-animate="'.$animation.'">';
        $posts_calendar .= '<h3 class=""><i class="fa fa-calendar"></i>'.$title.'</h3>';
        $args_recenposts = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish' 
                ); 
        $recentposts = get_posts($args_recenposts);
        foreach ($recentposts as $post) {
            #Content
            $content_post = get_post($post->ID);
            $content = $content_post->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            #Author
            $post_author_id = get_post_field( 'post_author', $post->ID );
            $user_info = get_userdata($post_author_id);
            $posts_calendar .= '<div class="single-post">';
                $posts_calendar .= '<div class="vc_col-md-3 text-center">';
                    $posts_calendar .= '<div class="row post-date-month">'.get_the_date('M', $post->ID).'</div>';
                    $posts_calendar .= '<div class="row post-date-day">'.get_the_date('j', $post->ID).'</div>';
                $posts_calendar .= '</div>';
                $posts_calendar .= '<div class="vc_col-md-9 post-description">';
                    $posts_calendar .= '<div class="post-name">';
                        $posts_calendar .= '<a href="'. get_permalink($post->ID) .'">'. $post->post_title .'</a>';
                    $posts_calendar .= '</div>';
                    $posts_calendar .= '<div class="post-details">'.get_the_date('F j, Y', $post->ID).'</div>';
                $posts_calendar .= '</div>';
                $posts_calendar .= '<div class="clearfix"></div>';
            $posts_calendar .= '</div>';
        }
        $posts_calendar .= '</div>';
    return $posts_calendar;
}
add_shortcode('posts_calendar', 'ibid_posts_calendar_shortcode');
/*---------------------------------------------*/
/*--- 5. Featured Post with thumbnail ---*/
/*---------------------------------------------*/
function ibid_featured_post_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'      => '',
            'icon'      => '',
            'postid'    => '',
            'title'     => ''
        ), $params ) );
    $featured_post = '';
    #Content
    $content_post = get_post($postid);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    #Author
    $post_author_id = get_post_field( 'post_author', $postid );
    $user_info = get_userdata($post_author_id);
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ),'ibid_featured_post_pic500x230' );
    $featured_post .= '<div class="latest-videos animateIn" data-animate="'.$animation.'">';
        $featured_post .= '<h3 class=""><i class="'.$icon.'"></i>'.$title.'</h3>';
        $featured_post .= '<a href="'.get_permalink( $postid ).'">';
            if($thumbnail_src) { $featured_post .= '<img class="img-responsive" src="'. $thumbnail_src[0] . '" alt="" />';
            }else{ $featured_post .= '<img class="img-responsive" src="http://placehold.it/500x230" alt="" />'; }
        $featured_post .= '</a>';
        $featured_post .= '<div class="video-title">';
            $featured_post .= '<a href="'.get_permalink( $postid ).'">'.get_the_title( $postid ).'</a>';
            $featured_post .= '<span class="post-date"><i class="fa fa-calendar"></i>'.get_the_date('', $postid ).'</span>';
            $featured_post .= '</div>';
        $featured_post .= '<div class="video-excerpt">'.ibid_excerpt_limit($content,20).'</div>';
    $featured_post .= '</div>';
    return $featured_post;
}
add_shortcode('featured_post', 'ibid_featured_post_shortcode');
/*---------------------------------------------*/
/*--- 6. Testimonials ---*/
/*---------------------------------------------*/
function ibid_testimonials_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                 =>'',
            'number'                    =>'',
            'testimonial_border_color'  =>'',
            'visible_items'             =>''
        ), $params ) );
    $myContent = '';
    $myContent .= '<style type="text/css" scoped>
        .testimonial-img-holder .testimonial-img {
            border-color: '.$testimonial_border_color.' !important;
        }
    </style>';
    $myContent .= '<div class="vc_row">';
        $myContent .= '<div data-animate="'.$animation.'" class="testimonials-container-'.$visible_items.' owl-carousel owl-theme animateIn">';
        $args_testimonials = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial',
                'post_status'      => 'publish' 
                ); 
        $testimonials = get_posts($args_testimonials);
            foreach ($testimonials as $testimonial) {
                #metaboxes
                $metabox_job_position = get_post_meta( $testimonial->ID, 'job-position', true );
                $metabox_company = get_post_meta( $testimonial->ID, 'company', true );
                $testimonial_id = $testimonial->ID;
                $content_post   = get_post($testimonial_id);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $testimonial->ID ),'ibid_portfolio_pic400x400' );
                
                $myContent.='
                    <div class="wow '.$animation.' item vc_col-md-12 relative">
                        <div class="testimonial01_item">            
                            <div class="testimonial01-img-holder pull-left">
                        <div class="testimonail01-content"><p>'.$content.'</p></div>
                        <div class="testimonial-info-content">';
                          
                          $cls = '';
                          if(!empty($thumbnail_src)) {

                              $myContent.='<div class="testimonail01-profile-img">';                        
                                 $myContent.='<img alt="testimonial-image" src="'.$thumbnail_src[0].'">';
                            $myContent.='</div>';
                          } else {
                             $cls .= 'text-center';                           
                          }
                         
                            $myContent.='<div class="testimonail01-name-position '.$cls.'">
                                <h2 class="name-test"><strong>'. $testimonial->post_title .'</strong></h2>
                                <p class="position-test">'. $metabox_job_position .'</p>
                            </div>
                       </div>
                        </div>
                      
                        </div>
                    </div>';
            }
        $myContent .= '</div>';
    $myContent .= '</div>';
    return $myContent;
}
add_shortcode('testimonials', 'ibid_testimonials_shortcode');


/*---------------------------------------------*/
/*--- 8. Services style 1 ---*/
/*---------------------------------------------*/
function ibid_service_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon'          => '', 
            'title'         => '', 
            'description'   => '',
            'animation'     => ''
        ), $params ) );
    $service = '';
    $service .= '<div class="block-container">';
        $service .= '<div class="block-icon">';
            $service .= '<div class="block-triangle">';
                $service .= '<div>';
                    $service .= '<i class="'.$icon.'"></i>';
                $service .= '</div>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="block-title">';
            $service .= '<p>'.$title.'</p>';
        $service .= '</div>';
        $service .= '<div class="block-content">';
            $service .= '<p>'.$description.'</p>';
        $service .= '</div>';
    $service .= '</div>';
    return $service;
}
add_shortcode('service', 'ibid_service_shortcode');
/*---------------------------------------------*/
/*--- 9. Services style 2 ---*/
/*---------------------------------------------*/
function ibid_service_style2_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon'          => '', 
            'title'         => '', 
            'description'   => '',
            'animation'     => ''
        ), $params ) );
    $service = '';
    $service .= '<div class="left-block-container services2 animateIn" data-animate="'.$animation.'">';
        $service .= '<div class="block-icon vc_col-md-2">';
            $service .= '<div class="block-triangle">';
                $service .= '<div>';
                    $service .= '<i class="'.$icon.'"></i>';
                $service .= '</div>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="vc_col-md-9 vc_col-md-offset-1">';
            $service .= '<div class="block-title">';
                $service .= '<p>'.$title.'</p>';
            $service .= '</div>';
            $service .= '<div class="block-content">';
                $service .= '<p>'.$description.'</p>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="clearfix"></div>';
    $service .= '</div>';
    return $service;
}
add_shortcode('service_style2', 'ibid_service_style2_shortcode');

/*---------------------------------------------*/
/*--- 11. Recent testimonials ---*/
/*---------------------------------------------*/
function ibid_testimonials2_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'number'=>'',
            'animation'=>''
        ), $params ) );
        $args_recenposts = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial',
                'post_status'      => 'publish' 
                );
        $recentposts = get_posts($args_recenposts);
        $content  = "";
        $content .= '<div class="testimonials_slider owl-carousel owl-theme animateIn" data-animate="'.$animation.'">';
        foreach ($recentposts as $post) {
            $job_position = get_post_meta( $post->ID, 'job-position', true );
            $content .= '<div class="item">';
                $content .= '<div class="testimonial-content relative">';
                    $content .= '<span>'.get_post_field('post_content', $post->ID).'</span>';
                    $content .= '<div class="testimonial-client-details">';
                        $content .= '<div class="testimonial-name">'.$post->post_title.'</div>';
                        $content .= '<div class="testimonial-job">'.$job_position.'</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        }
        $content .= '</div>';
        return $content;
}
add_shortcode('testimonials-style2', 'ibid_testimonials2_shortcode');
/*---------------------------------------------*/
/*--- 12. Skill ---*/
/*---------------------------------------------*/
function ibid_skills_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon_or_image'            => '', 
            'animation'                => '', 
            'icon'                     => '', 
            'title'                    => '',
            'skillvalue'               => '',
            'border_color'             => '',
            'bg_color'                 => '',
            'title_color'              => '',
            'skill_color_value'        => '',
            'image_skill'              => ''
        ), $params ) );

    $image_skill      = wp_get_attachment_image_src($image_skill, "linify_skill_counter_65x65");
    $image_skillsrc  = $image_skill[0];

    $skill = '';
    $skill .= '<div class="stats-block statistics col-md-12 wow '.esc_attr($animation).'">';
        $skill .= '<div class="stats-heading-img col-md-5">';
         $skill .= '<div class="stats-img">';

                if($icon_or_image == 'choosed_icon'){
                  $skill .= '<i class="'.esc_attr($icon).'"></i>';
                } elseif($icon_or_image == 'choosed_image') {
                  $skill .= '<img src="'.esc_attr($image_skillsrc).'" data-src="'.esc_attr($image_skillsrc).'" alt="">';
                }
         $skill .= '</div>';
        $skill .= '</div>';

        $skill .= '<div class="stats-content percentage col-md-7" data-perc="'.esc_attr($skillvalue).'" style="background:'.$bg_color.'">';
          $skill .= '<span class="skill-count" style="color: '.esc_attr($skill_color_value).'">'.esc_attr($skillvalue).'</span>';
            
              $skill .= '<p style="color: '.esc_attr($title_color).'">'.esc_attr($title).'</p>';
              
            $skill .= '</div>';

        

    $skill .= '</div>';
    return $skill;
}
add_shortcode('mt_skill', 'ibid_skills_shortcode');


/*---------------------------------------------*/
/*--- 14. Pricing tables ---*/
/*---------------------------------------------*/
function ibid_pricing_table_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'package_currency'  => '',
            'package_price'     => '',
            'package_name'      => '',
            'package_basis'     => '',
            'package_feature1'  => '',
            'package_feature2'  => '',
            'package_feature3'  => '',
            'package_feature4'  => '',
            'package_feature5'  => '',
            'package_feature6'  => '',
            'animation'         => '',
            'button_url'        => '',
            'recommended'       => '',
            'button_text'       => ''
        ), $params ) );
    $pricing_table = '';
    $pricing_table .= '<div class="pricing-table animateIn '.$recommended.'" data-animate="'.$animation.'">';
        $pricing_table .= '<div class="triangle-container">';
            $pricing_table .= '<div class="block-triangle">';
                $pricing_table .= '<div class="triangle-content">';
                    $pricing_table .= '<p class="text-center">';
                        $pricing_table .= '<small>'.$package_currency.'</small><span class="price">'.$package_price.'</span>';
                    $pricing_table .= '</p>';
                    $pricing_table .= '<p class="sub text-center">'.$package_basis.'</p>';
                $pricing_table .= '</div>';
            $pricing_table .= '</div>';
        $pricing_table .= '</div>';
        $pricing_table .= '<div class="table-content">';
            $pricing_table .= '<h2 class="text-center">'.$package_name.'</h2>';
            $pricing_table .= '<ul class="text-center">';
                $pricing_table .= '<li>'.$package_feature1.'</li>';
                $pricing_table .= '<li>'.$package_feature2.'</li>';
                $pricing_table .= '<li>'.$package_feature3.'</li>';
                $pricing_table .= '<li>'.$package_feature4.'</li>';
                $pricing_table .= '<li>'.$package_feature5.'</li>';
                $pricing_table .= '<li>'.$package_feature6.'</li>';
            $pricing_table .= '</ul>';
            $pricing_table .= '<div class="button-holder text-center">';
                $pricing_table .= '<a href="'.$button_url.'" class="solid-button button">'.$button_text.'</a>';
            $pricing_table .= '</div>';
        $pricing_table .= '</div>';
    $pricing_table .= '</div>';
    return $pricing_table;
}
add_shortcode('pricing-table', 'ibid_pricing_table_shortcode');
/*---------------------------------------------*/
/*--- 15. Jumbotron ---*/
/*---------------------------------------------*/
function ibid_jumbotron_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'heading'       => '', 
            'sub_heading'   => '', 
            'button_text'   => '',
            'button_url'    => '',
            'animation'    => ''
        ), $params ) ); 
    $content = '';
    $content .= '<div class="jumbotron animateIn" data-animate="'.$animation.'">';
        $content .= '<h1>'.$heading.'</h1>';
        $content .= '<p>'.$sub_heading.'</p>';
        $content .= '<p><a role="button" href="'.$button_url.'" class="btn btn-primary btn-lg">'.$button_text.'</a></p>';
    $content .= '</div>';
    return $content;
}
add_shortcode('jumbotron', 'ibid_jumbotron_shortcode');
/*---------------------------------------------*/
/*--- 16. Alert ---*/
/*---------------------------------------------*/
function ibid_alert_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'alert_style'           => '', 
            'alert_dismissible'     => '', // yes/no
            'alert_text'            => '',
            'animation'            => ''
        ), $params ) );
    $content = '';
    $content .= '<div role="alert" class="alert alert-'.$alert_style.' animateIn" data-animate="'.$animation.'">';
        if ($alert_dismissible == 'yes') {
            $content .= '<button aria-label="'.esc_attr__('Close', 'modeltheme').'" data-dismiss="alert" class="close" type="button"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>';
        }
        $content .= $alert_text;
    $content .= '</div>';
    return $content;
}
add_shortcode('alert', 'ibid_alert_shortcode');
/*---------------------------------------------*/
/*--- 17. Progress bars ---*/
/*---------------------------------------------*/
function ibid_progress_bar_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'bar_scope'  => '', // success/info/warning/danger
            'bar_style'  => '', // normal/progress-bar-striped
            'bar_label'  => '', // optional
            'bar_value'  => '',
            'animation'  => ''
        ), $params ) );
    $content = '';
    $content .= '<div class="animateIn progress" data-animate="'.$animation.'" >';
        $content .= '<div class="progress-bar progress-bar-'.$bar_scope . ' ' . $bar_style.'" role="progressbar" aria-valuenow="'.$bar_value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$bar_value.'%">';
            if(!isset($bar_label)){
                $content .= '<span class="sr-only">'.$bar_label.'</span>.';
            }else{ 
                $content .= $bar_label;
            }
        $content .= '</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('progress_bar', 'ibid_progress_bar_shortcode');
/*---------------------------------------------*/
/*--- 18. Custom content ---*/
/*---------------------------------------------*/
function ibid_panel_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'panel_style'    => '', // success/info/warning/danger
            'panel_title'    => '', 
            'panel_content'  => '',
            'animation'  => ''
        ), $params ) ); ?>
    <div class="panel animateIn panel-<?php echo esc_attr($panel_style); ?>" data-animate="<?php echo esc_attr($animation); ?>">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo esc_attr($panel_title); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $panel_content; ?>
        </div>
    </div>
    
<?php }
add_shortcode('panel', 'ibid_panel_shortcode');
/*---------------------------------------------*/
/*--- 20. Heading With Border ---*/
/*---------------------------------------------*/
function ibid_heading_with_border( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'align'       => 'left',
            'animation'   => ''
        ), $params ) );
    $content = do_shortcode($content);
    echo '<h2 data-animate="'.$animation.'" class="'.$align.'-border animateIn">'.$content.'</h2>';
}
add_shortcode('heading-border', 'ibid_heading_with_border');


/*---------------------------------------------*/
/*--- 21. Testimonials ---*/
/*---------------------------------------------*/
function ibid_clients_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'=>'',
            'number'=>''
        ), $params ) );
    $myContent = '';
    $myContent .= '<div data-animate="'.$animation.'" class="clients-container animateIn owl-carousel owl-theme ">';
    $args_clients = array(
            'posts_per_page'   => $number,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'client',
            'post_status'      => 'publish' 
            ); 
    $clients = get_posts($args_clients);
        foreach ($clients as $client) {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $client->ID ),'full' );
            
            $myContent .= '<div class="item">';
                if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $client->post_title .'" />';
                }else{ $myContent .= '<img src="http://placehold.it/110x110" alt="'. $client->post_title .'" />'; }
            $myContent .= '</div>';
        }
    $myContent .= '</div>';
    return $myContent;
}
add_shortcode('clients', 'ibid_clients_shortcode');
/*---------------------------------------------*/
/*--- 22. List group ---*/
/*---------------------------------------------*/
function ibid_list_group_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'animation'     => ''
        ), $params ) ); 
    $content = '';
    $content .= '<a href="#" class="list-group-item '.$active.' animateIn" data-animate="'.$animation.'">';
        $content .= '<h4 class="list-group-item-heading">'.$heading.'</h4>';
        $content .= '<p class="list-group-item-text">'.$description.'</p>';
    $content .= '</a>';
    return $content;
}
add_shortcode('list_group', 'ibid_list_group_shortcode');

function ibid_btn_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'btn_text'      => '',
            'btn_url'       => '',
            'btn_size'      => '',
            'align'      => ''
        ), $params ) ); 
    $content = '';
    $content .= '<div class="'.$align.'">';
    $content .= '<a href="'.$btn_url.'" class="button-winona '.$btn_size.'">'.$btn_text.'</a>';
    $content .= '</div>';
    return $content;
}
add_shortcode('ibid_btn', 'ibid_btn_shortcode');
/*---------------------------------------------*/
/*--- 23. Thumbnails custom content ---*/
/*---------------------------------------------*/
function ibid_thumbnails_custom_content_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'image'         => '',
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'button_url'    => '',
            'button_text'   => '',
            'animation'     => ''
        ), $params ) ); 
    $thumb      = wp_get_attachment_image_src($image, "large");
    $thumb_src  = $thumb[0]; 
    $content = '';
    $content .= '<div class="thumbnail animateIn" data-animate="'.$animation.'">';
        $content .= '<img data-holder-rendered="true" src="'.$thumb_src.'" data-src="'.$thumb_src.'" alt="'.$heading.'">';
        $content .= '<div class="caption">';
            if (!empty($heading)) {
                $content .= '<h3>'.$heading.'</h3>';  
            }
            if (!empty($description)) {
                $content .= '<p>'.$description.'</p>';
            }
            if (!empty($button_text)) {
                $content .= '<p><a href="'.$button_url.'" class="btn btn-primary" role="button">'.$button_text.'</a></p>';
            }
        $content .= '</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('thumbnails_custom_content', 'ibid_thumbnails_custom_content_shortcode');
/*---------------------------------------------*/
/*--- 24. Section heading with title and subtitle ---*/
/*---------------------------------------------*/
function ibid_heading_title_subtitle_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'         => '',
            'separator'     => '',
            'subtitle'      => '',
            'disable_sep'   => '',
            'title_style'   => '',
            'title_color'   => '',
            'delimitator_color' => ''
        ), $params ) ); 

    $separator = wp_get_attachment_image_src($separator, "full");

    if ($delimitator_color) {
        $delimitator_color_value = $delimitator_color;
    }else{
        $delimitator_color_value = '#2695FF';
    }

    $content = '<div class="title-subtile-holder">';
    $content .= '<h2 class="section-title '.$title_style.' '.$title_color.'">'.$title.'</h2>';
    if (isset($separator) && !empty($separator)) {
        $content .= '<div class="section-border" style="background: url('.$separator[0].') no-repeat center center;"></div>';
    }else{
        $content .= '<div class="svg-border '.$disable_sep.'"><svg width="515" height="25" viewBox="0 0 275 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect y="7" width="120" height="1" fill="#CCCCCC"/>
        <rect x="155" y="7" width="120" height="1" fill="#CCCCCC"/>
        <path d="M144.443 14.6458C144.207 14.8818 143.897 15 143.588 15C143.278 15 142.968 14.8818 142.732 14.6454L137.874 9.78689C137.517 9.43023 137.43 8.90654 137.612 8.46798L136.617 7.47264L135.242 8.84723C135.517 9.2862 135.458 9.8809 135.066 10.2714C134.614 10.7245 133.888 10.7342 133.448 10.2936L130.324 7.17126C129.883 6.73028 129.893 6.00566 130.347 5.55298C130.738 5.16122 131.332 5.10231 131.771 5.37788L135.378 1.77014C135.102 1.33158 135.161 0.737682 135.553 0.346326C136.006 -0.10676 136.73 -0.116443 137.171 0.324136L140.295 3.44732C140.736 3.8879 140.726 4.61251 140.272 5.0656C139.88 5.45736 139.287 5.51586 138.849 5.2407L137.472 6.6169L138.59 7.73449C138.945 7.69334 139.314 7.80348 139.586 8.07622L144.444 12.9347C144.916 13.4071 144.916 14.1729 144.443 14.6458Z" fill="'.$delimitator_color_value.'"/>
        </svg></div>';
    }
    $content .= '<div class="section-subtitle '.$title_color.'">'.$subtitle.'</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('heading_title_subtitle', 'ibid_heading_title_subtitle_shortcode');


/*---------------------------------------------*/
/*--- 24. Section heading with title and subtitle ---*/
/*---------------------------------------------*/
function ibid_heading_title_subtitle_shortcode_v2($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'         => '',
            'separator'     => '',
            'button_link'   => '',
            'button_text'   => '',
            'subtitle'      => ''
        ), $params ) ); 

    $separator = wp_get_attachment_image_src($separator, "full");

    $content = '<div class="title-subtile-holder v2">';
        $content .= '<div class="title-content" >';
            $content .= '<h1 class="section-title text-left">'.$title.'</h1>';
            $content .= '<div class="section-subtitle text-left">'.$subtitle.'</div>';
        $content .= '</div>';
         $content .= '<a class="button title-btn " href="'.$button_link.'">'.$button_text.'</a>';
    $content .= '</div>';
    return $content;
}
add_shortcode('heading_title_subtitle_v2', 'ibid_heading_title_subtitle_shortcode_v2');

/*---------------------------------------------*/
/*--- 25. Heading with bottom border ---*/
/*---------------------------------------------*/
function ibid_heanding_bottom_border_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'    => '',
            'text_align' => ''
        ), $params ) );
    $content = '<h2 class="heading-bottom '.$text_align.'">'.$heading.'</h2>';
    return $content;
}
add_shortcode('heading_border_bottom', 'ibid_heanding_bottom_border_shortcode');
/*---------------------------------------------*/
/*--- 26. Portfolio square ---*/
/*---------------------------------------------*/
function ibid_portfolio_sqare_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'       => ''
           ), $params ) 
        );

    $args = array(
        'posts_per_page'   => $number,
        'post_type'        => 'portfolio',
        'post_status'      => 'publish',
    );
    $posts = new WP_Query( $args );
    $content = '<div class="portfolio-overlay"></div>';
    $content = '<div class="blog-posts portfolio-posts portfolio-shortcode quick-view-items">';
    foreach ( $posts->posts as $portfolio ) {
        
        $project_url = get_post_meta( $portfolio->ID, 'av-project-url', true );
        $project_skills = get_post_meta( $portfolio->ID, 'av-project-category', true );
        $excerpt = get_post_field( 'post_content', $portfolio->ID );
        $thumbnail_src      = wp_get_attachment_image_src( get_post_thumbnail_id( $portfolio->ID ), 'ibid_portfolio_pic700x450' );
        $content .= '<article id="post-'.$portfolio->ID.'" class="vc_col-md-4 single-portfolio-item ibid-item relative portfolio">';
        
        if($thumbnail_src) { 
            $content .= '<img src="'. $thumbnail_src[0] . '" alt="'.$portfolio->post_title.'" />';
        }else{ 
            $content .= '<img src="http://placehold.it/700x450" alt="'.$portfolio->post_title.'" />'; 
        }
            $content .= '<div class="item-description absolute">';
                $content .= '<div class="holder-top">';
                    $content .= '<a class="ibid-trigger" href="#"><i class="fa fa-expand"></i></a>';
                    $content .= '<a href="'.get_the_permalink($portfolio->ID).'"><i class="fa fa-plus"></i></a>';
                $content .= '</div>';
                $content .= '<div class="holder-bottom">';
                    $content .= '<h3>'.$portfolio->post_title.'</h3>';
                    $content .= '<h5>'.$project_skills.'</h5>';
                $content .= '</div>';
            $content .= '</div>';



            $content .= '<div class="ibid-quick-view portfolio-shortcode high-padding post-'.$portfolio->ID.'">';
                $content .= '<div class="ibid-slider-wrapper">';
                    $content .= '<ul class="ibid-slider">';
                        if($thumbnail_src) { 
                            $content .= '<li class="selected single-slide"><img class="portfolio-item-img" src="'. $thumbnail_src[0] . '" alt="'.$portfolio->post_title.'" /></li>';
                        }
                        if( class_exists('Dynamic_Featured_Image') ) {
                            global $dynamic_featured_image;
                            $featured_images = $dynamic_featured_image->get_featured_images($portfolio->ID);

                            $i = 0;
                            foreach ($featured_images as $row=>$innerArray) {
                                $id = $featured_images[$i]['attachment_id'];
                                $mediumSizedImage = $dynamic_featured_image->get_image_url($id,'ibid_portfolio_pic700x450'); 
                                $caption = $dynamic_featured_image->get_image_caption( $mediumSizedImage );
                                $content .= '<li class="single-slide"><img src="'.$mediumSizedImage.'" alt="'.$caption.'"></li>';
                                $i++;
                            }
                        }            
                    $content .= '</ul>';
                    $content .= '<ul class="ibid-slider-navigation">';
                        $content .= '<li><a class="ibid-next" href="#0"><i class="fa fa-angle-left"></i></a></li>';
                        $content .= '<li><a class="ibid-prev" href="#0"><i class="fa fa-angle-right"></i></a></li>';
                    $content .= '</ul>';
                $content .= '</div>';

                $content .= '<div class="ibid-item-info col-md-5">';
                    $content .= '<h2 class="heading-bottom top">'.$portfolio->post_title.'</h2>';
                    $content .= '<div class="desc">'.get_post_field('post_content', $portfolio->ID).'</div>';

                    $content .= '<div class="portfolio-details">';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Customer:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.get_the_author().'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Live demo:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.$project_url.'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Skills:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.$project_skills.'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Date post:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.get_the_date().'</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<a href="'.get_the_permalink($portfolio->ID).'" class="vc_btn vc_btn-blue">More details</a>';
                $content .= '</div>';
                $content .= '<a href="#0" class="ibid-close"><i class="fa fa-times"></i></a>';
            $content .= '</div>';
        $content .= '</article>';
    }
    $content .= '<div class="clearfix"></div>';
    $content .= '<div class="portfolio-overlay"></div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('portfolio-square', 'ibid_portfolio_sqare_shortcode');
/*---------------------------------------------*/
/*--- 27. Call to action ---*/
/*---------------------------------------------*/
function ibid_call_to_action_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'heading_type'  => '',
            'subheading'    => '',
            'align'         => '',
            'button_text'   => '',
            'url'           => ''
        ), $params ) );
    $shortcode_content = '<div class="ibid_call-to-action">';
    $shortcode_content .= '<div class="vc_col-md-12">';
    $shortcode_content .= '<'.$heading_type.' class="'.$align.'">'.$heading.'</'.$heading_type.'>';
    $shortcode_content .= '<p class="'.$align.'">'.$subheading.'</p>';
    $shortcode_content .= '</div>';
    $shortcode_content .= '<div class="clearfix"></div>';
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('ibid-call-to-action', 'ibid_call_to_action_shortcode');


/*---------------------------------------------*/
/*--- 27. Call to action ---*/
/*---------------------------------------------*/
function ibid_shop_feature_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'subheading'    => '',
            'icon'          => ''
        ), $params ) );

    $shortcode_content = '<div class="shop_feature">';
        $shortcode_content .= '<div class="pull-left shop_feature_icon">';
            $shortcode_content .= '<i class="'.$icon.'"></i>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '<div class="pull-left shop_feature_description">';
            $shortcode_content .= '<h4>'.$heading.'</h4>';
            $shortcode_content .= '<p>'.$subheading.'</p>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('shop-feature', 'ibid_shop_feature_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Categories List ---*/
/*---------------------------------------------*/

function ibid_shop_categories_with_thumbnails_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'hide_empty'                           => ''
        ), $params ) );

    $prod_categories = get_terms( 'product_cat', array(
        'number'        => $number,
        'hide_empty'    => $hide_empty,
        'parent' => 0
    ));

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_categories list">';
        $shortcode_content .= '<div class="categories-list categories_shortcode categories_shortcode_'.$number_of_columns.' owl-carousel owl-theme">';
        foreach( $prod_categories as $prod_cat ) {
            if ( class_exists( 'WooCommerce' ) ) {
                $cat_thumb_id   = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            } else {
                $cat_thumb_id = '';
            }
            $cat_thumb_url  = wp_get_attachment_image_src( $cat_thumb_id, 'pic100x75' );
            $term_link      = get_term_link( $prod_cat, 'product_cat' );

            $shortcode_content .= '<div class="category item ">';
                    $shortcode_content .= '<a class="#categoryid_'.$prod_cat->term_id.'">';
                        $shortcode_content .= '<span class="cat-name">'.$prod_cat->name.'</span>';                    
                    $shortcode_content .= '</a>';    
            $shortcode_content .= '</div>';
        }
        $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="products_category">';
                foreach( $prod_categories as $prod_cat ) {
                        $shortcode_content .= '<div id="categoryid_'.$prod_cat->term_id.'" class="products_by_category '.$prod_cat->name.'">'.do_shortcode('[product_category columns="1" per_page="'.$number_of_products_by_category.'" category="'.$prod_cat->slug.'"]').'</div>';
                }
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-categories-with-thumbnails', 'ibid_shop_categories_with_thumbnails_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Domain Categories List ---*/
/*---------------------------------------------*/

function ibid_domain_categories_with_thumbnails_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
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
    $shortcode_content .= '<div class="domain woocommerce_categories list">';

            $shortcode_content .= '<div class="domains_category">';
                while ($blogposts->have_posts()) {
                $blogposts->the_post();
                global $product; 
                $shortcode_content .= '
                    <div class="'.$items_per_row.' domain-list-shortcode">
                        <div class="col-md-12 post">
                            <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title().'</a>
                                </h3>
                            </div>';
                            $shortcode_content .= '
                            <div class="domain-bid">';
                             if ( class_exists( 'WooCommerce_simple_auction' ) ) {

                                  // metas
                                  $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                                    $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
                                    $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );

                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $shortcode_content .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $shortcode_content .= '<p>'.esc_html__('Expires on: ','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
                                                  </div>';
                                      }else if($meta_auction_start_price){
                                        $shortcode_content .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $shortcode_content .= '<p>'.esc_html__('Expires on: ','modeltheme').' '.$product->get_auction_end_time(). '</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
                                                  </div>';
                                      }

                                    }else {
                                      $shortcode_content .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
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
add_shortcode('domain-categories', 'ibid_domain_categories_with_thumbnails_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Products Slider ---*/
/*---------------------------------------------*/

function mt_shortcode_products($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'false',
            'order' => 'desc',
            'pagination' => 'false',
            'autoPlay' => 'false',
            'layout'  => '',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';



    // CLASSES
    $class_slider = 'mt_slider_products_'.uniqid();



    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';


        $html .= '<div class="mt_products_slider '.$class_slider.' row  ">';
        $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
         ); 
        $blogposts = get_posts($args_blogposts);
        
        foreach ($blogposts as $blogpost) {
                #metaboxes

                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_portfolio_pic400x400' );
                $product_cause = get_post_meta( $blogpost->ID, 'product_cause', true );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col = 'col-md-12';
                }else{
                    $post_col = 'col-md-12 no-featured-image';
                    $post_img = '';
                }
                $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_related_post_pic500x300' );
                if ($thumbnail_src2) {
                    $post_img2 = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src2[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col2 = 'col-md-12';
                }else{
                    $post_col2 = 'col-md-12 no-featured-image';
                    $post_img2 = '';
                }
            $html .= '<div id="product-id-'.esc_attr($blogpost->ID).'">
                        <div class="slider-wrapper">';
                        if($layout == "vertical" || $layout == "") {

                            $html .= '<div class="col-md-12 post ">
                              <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>
                              </div>
                              <div class="woocommerce-title-metas text-center">
                                <h3 class="archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';



                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                  $product = wc_get_product( $blogpost->ID );
                                  // metas
                                  $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                                  $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                                  $meta_auction_closed = get_post_meta( $blogpost->ID, '_auction_closed', true );
                                  global $ibid_redux;
      
                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $html .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $html .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                        if($product_cause){
                                            $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                        }
                                        $html .= '<div class="button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                      }else if($meta_auction_start_price){
                                        $html .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $html .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
                                            if($product_cause){
                                                $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                            }
                                        }
                                        $html .= '<div class="button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                      }

                                    }else {
                                      $html .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
                                    }
                                  }
                                }
                    $html .= '</div>
                            </div>';
                        }else {
                            $html .= '<div class="col-md-12 post full ">
                              <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img2.'</a>
                              </div>
                              <div class="woocommerce-title-metas text-center">
                                <h3 class="archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';



                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                  $product = wc_get_product( $blogpost->ID );
                                  // metas
                                  $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                                  $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                                  $meta_auction_closed = get_post_meta( $blogpost->ID, '_auction_closed', true );
                                  global $ibid_redux;
      
                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $html .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        if($product_cause){
                                            $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                        }
 
                                      }else if($meta_auction_start_price){
                                        $html .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';

                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
                                            if($product_cause){
                                                $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                            }
                                        }
                                      }

                                    }else {
                                      $html .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
                                    }
                                  }
                                }
                    $html .= '</div>
                            </div>';
                        }


                            $html .= '</div>                     
                          </div>';

            }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt_products_slider', 'mt_shortcode_products');
/*---------------------------------------------*/
/*--- Woocommerce Categories Grid ---*/
/*---------------------------------------------*/

function ibid_shop_categories_with_grids( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'product_image_width'                           => '',
            'column_sku'                           => '',
            'column_current_bid_price'                           => '',
            'column_current_bid_price_label' => '',
            'column_expires_on'                           => '',
            'column_stock'                           => '',
            'column_place_bid'                           => '',
            'column_place_bid_label'                           => '',
        ), $params ) );


    $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => -1,
        // 'tax_query' => array(
        //     array(
        //         'taxonomy' => 'product_type',
        //         'field'    => 'slug',
        //         'terms'    => 'auction', 
        //     ),
        // ),
        'posts_per_page'  => $number,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $prods = new WP_Query( $args );

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_categories grid">';


        $image_width = '';
        if ($product_image_width == 'small_tile') {
            $image_width = 'small_tile70';
        }

        $shortcode_content .= '<table id="DataTable-icondrops-active" class="table" cellspacing="0" width="100%">';
            $shortcode_content .= '<thead>';
                $shortcode_content .= '<tr>';
                    $shortcode_content .= '<th>'.esc_html__('Image','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('Title','modeltheme').'</th>';
                    // SKU
                    if ($column_sku == true) {
                        $shortcode_content .= '<th>'.esc_html__('SKU','modeltheme').'</th>';
                    }
                    // Current Bid/Price
                    if ($column_current_bid_price == true) {
                        if ($column_current_bid_price_label != '') {
                            $current_bid_price_label = $column_current_bid_price_label;
                        }else{
                            $current_bid_price_label = esc_html__('Current Bid','modeltheme');
                        }
                        $shortcode_content .= '<th>'.$current_bid_price_label.'</th>';
                    }
                    // expires on
                    if ($column_expires_on == true) {
                        $shortcode_content .= '<th>'.esc_html__('Expires On','modeltheme').'</th>';
                    }
                    // stock
                    if ($column_stock == true) {
                        $shortcode_content .= '<th>'.esc_html__('In stock','modeltheme').'</th>';
                    }
                    // place bid
                    if ($column_place_bid == true) {
                        if ($column_place_bid_label != '') {
                            $place_bid_label = $column_place_bid_label;
                        }else{
                            $place_bid_label = esc_html__('Place Bid','modeltheme');
                        }
                        $shortcode_content .= '<th>'.$place_bid_label.'</th>';
                    }
                $shortcode_content .= '</tr>';
            $shortcode_content .= '</thead>';

            $shortcode_content .= '<tbody>';
            while ($prods->have_posts()) {
                $prods->the_post();
                global $product;

                    $end_time = '';
                    if ($product->get_type() == 'auction'){
                        $end_time = $product->get_auction_end_time();
                    }

                    $shortcode_content .= '<tr>';
                        $shortcode_content .= '<td class="featured-image '.$image_width.'">'.get_the_post_thumbnail( $prods->post->ID, 'ibid_member_pic350x350' ).'</td>';
                        $shortcode_content .= '<td class="product-title"><a href="'.get_permalink().'">'.$product->get_title().'</a></td>';
                        // SKU
                        if ($column_sku == true) {
                            $shortcode_content .= '<td>'.$product->get_sku().'</td>';
                        }
                        // Current Bid/Price
                        if ($column_current_bid_price == true) {
                            $shortcode_content .= '<td>'.$product->get_price_html().'</td>';
                        }
                        // expires on
                        if ($column_expires_on == true) {
                            $shortcode_content .= '<td>' .$end_time.'</td>';
                        }
                        // stock
                        if ($column_stock == true) {
                            if ($product->get_stock_status() == 'instock') {
                                $stock_text = '<span class="label label-success">'.__('In Stock','modeltheme').'</span>';
                            }elseif ($product->get_stock_status() == 'outofstock') {
                                $stock_text = '<span class="label label-danger">'.__('Out Of Stock','modeltheme').'</span>';
                            }elseif ($product->get_stock_status() == 'onbackorder') {
                                $stock_text = '<span class="label label-info">'.__('On backorder','modeltheme').'</span>';
                            }else{
                                $stock_text = '<span class="label label-default">'.$product->get_stock_status().'</span>';
                            }
                            $shortcode_content .= '<td class="'.$product->get_stock_status().'">'.$stock_text.'</td>';
                        }
                        // place bid
                        if ($column_place_bid == true) {
                            $shortcode_content .= '<td class="add-cart"><a href="' . esc_url( $product->add_to_cart_url() ) . '" data-quantity="1" class="button product_type_'.$product->get_type().' add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr(get_the_ID()).'" aria-label="Add <'.esc_attr(get_the_title()).'> to your cart" rel="nofollow">'.$product->add_to_cart_text().'</a></td>';   
                        }

                    $shortcode_content .= '</tr>';
            }
                            
        $shortcode_content .= '</tbody>';
        $shortcode_content .= '</table>';
                       
    $shortcode_content .= '</div>';

    wp_reset_postdata();


    return $shortcode_content;
}
add_shortcode('shop-categories-with-grids', 'ibid_shop_categories_with_grids');


/*---------------------------------------------*/
/*--- Woocommerce Categories with thumbnails version 2 ---*/
/*---------------------------------------------*/
function ibid_shop_categories_with_xsthumbnails_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'button_text'                          => '',
            'products_label_text'                  => '',
            'category'                             => '',
            'overlay_color1'                       => '',
            'overlay_color2'                       => '',
            'bg_image'                             => '',
            'hide_empty'                           => '',
            'products_layout'                      => '',
            'styles'                               => '',
            'button_style'                         => '',
            'banner_pos'                           => ''
        ), $params ) );

    if (isset($bg_image) && !empty($bg_image)) {
        $bg_image = wp_get_attachment_image_src($bg_image, "full");
    }

    $category_style_bg = '';
    if (isset($bg_image) && !empty($bg_image)) {
        $category_style_bg .= 'background: url('.$bg_image[0].') no-repeat center center;';
    }else{
        $category_style_bg .= 'background: radial-gradient('.$overlay_color1.','.$overlay_color2.');';
    }

    if ($button_text) {
        $button_text_value = $button_text;
    }else{
        $button_text_value = __('View All Items', 'modeltheme');
    }

    if ($products_label_text) {
        $products_label_text_value = $products_label_text;
    }else{
        $products_label_text_value = __('Products', 'modeltheme');
    }


    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = ''; 

    if (isset($products_layout)) {
        if ($products_layout == '' || $products_layout == 'image_left') {
            if( $styles == '' || $styles == "style_1") {
                $block_type = 'woocommerce_categories2';
            }elseif($styles == "style_2") {
                $block_type = 'woocommerce_simple_styled';
            }
        }elseif($products_layout == 'image_top'){
            $block_type = 'woocommerce_categories2_top';
        }
    }else{
        $block_type = 'woocommerce_categories2';
    }

    if (!isset($number_of_columns) || (isset($number_of_columns) && $number_of_columns == '')) {
        $number_of_columns = '2';
    }

    if ($cat) {
        $shortcode_content .= '<div class="'.$block_type.'">';
            $shortcode_content .= '<div class="products_category">';
                $shortcode_content .= '<div class="category item col-md-3 '.$banner_pos.'" >';
                    $shortcode_content .= '<div style="'.$category_style_bg.'" class="category-wrapper">';
                        $shortcode_content .= '<a class="#categoryid_'.$cat->term_id.'">';
                            $shortcode_content .= '<span class="cat-name">'.$category.'</span>';                    
                        $shortcode_content .= '</a>';
                        $shortcode_content .= '<br>'; 

                        $shortcode_content .= '<span class="cat-count"><strong>'.$cat->count.'</strong> '.esc_html($products_label_text_value).'</span>';
                        $shortcode_content .= '<br>';
                        $shortcode_content .= '<div class="category-button '.$button_style.'">';
                           $shortcode_content .= '<a href="'.get_term_link($cat->slug, 'product_cat').'" class="button" title="'.__('View more', 'modeltheme').'" ><span>'.$button_text_value.'</span></a>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';    
                $shortcode_content .= '</div>';
                            $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-9 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '<div class="clearfix"></div>';
    }

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-categories-with-xsthumbnails', 'ibid_shop_categories_with_xsthumbnails_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Only Product Categories  ---*/
/*---------------------------------------------*/

function ibid_shortcode_categories_image($params, $content) {
    extract( shortcode_atts( 
        array(
            'category'            => '',
            'category_title'      => '',
            'layout'              => '',
            'animation'           => ''
        ), $params ) );
    
    $term = get_term_by('slug', $category, 'product_cat');
    $img_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 
    $img_id_2 = get_term_meta( $term->term_id, 'thumbnail_id', true );
    // get the image URL
    $thumbnail_src = wp_get_attachment_image_src( $img_id, 'ibid_testimonials_pic110x110' ); 
    $thumbnail_src_2 = wp_get_attachment_image_src( $img_id_2, 'ibid_cat_pic500x500' ); 

    $query_count = new WP_Query( array( 'product_cat' => $term->name ) );
    $count_tax = $query_count->found_posts;
    if($count_tax == 1) {
        $count_string = __(' Product in this Category', 'modeltheme');
    } else {
        $count_string = __(' Products in this Category', 'modeltheme');
    }

    if (isset($layout)) {
        if ($layout == '' || $layout == 'horizontal') {
            $block_type = 'products_category_image_shortcode_holder';
            $thumbnail_type = $thumbnail_src;
        }elseif($layout == 'vertical'){
            $block_type = 'products_category_vertical_shortcode_holder';
            $thumbnail_type = $thumbnail_src_2;
        }
    }else{
        $block_type = 'products_category_image_shortcode_holder';
    }

    $html = '';
    $html .= '<div class="products_category_image_shortcode">';
      $html .= '<div class="'.$block_type.'">';
        $html .= '<a href="'.get_term_link($term->slug, 'product_cat').'"><img class="cat-image" alt="cat-image" src="'.$thumbnail_type[0].'"></a>';
        $html .= '<div class="listings_category_footer">';
          $html .= '<h4 class="heading"><a href="'.get_term_link($term->slug, 'product_cat').'">'. $category .'</a></h4>';
          $html .= '<div class="description"><p>'. $count_tax . esc_attr($count_string) .'</p></div>';
        $html .= '</div>';
      $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode('mt_ibid_category_image', 'ibid_shortcode_categories_image');

/*---------------------------------------------*/
/*--- Woocommerce Expired Products with thumbnails ---*/
/*---------------------------------------------*/

function ibid_shop_expiring_thumbnail_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'button_text'                    => '',
            'products_label_text'                    => '',
            'category'                             => '',
            'overlay_color1'                       => '',
            'overlay_color2'                       => '',
            'bg_image'                       => '',
            'hide_empty'                           => ''
        ), $params ) );

    if (isset($bg_image) && !empty($bg_image)) {
        $bg_image = wp_get_attachment_image_src($bg_image, "full");
    }

    $category_style_bg = '';
    if (isset($bg_image) && !empty($bg_image)) {
        $category_style_bg .= 'background: url('.$bg_image[0].') no-repeat center center;';
    }else{
        $category_style_bg .= 'background: radial-gradient('.$overlay_color1.','.$overlay_color2.');';
    }

    if ($button_text) {
        $button_text_value = $button_text;
    }else{
        $button_text_value = __('View All Items', 'modeltheme');
    }

    if ($products_label_text) {
        $products_label_text_value = $products_label_text;
    }else{
        $products_label_text_value = __('Products', 'modeltheme');
    }


    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_expired2">';
       
        $shortcode_content .= '<div class="products_category">';
            $shortcode_content .= '<div class="category item col-md-3" >';
                $shortcode_content .= '<div style="'.$category_style_bg.'" class="category-wrapper">';
                    $shortcode_content .= '<a class="#categoryid_'.$cat->term_id.'">';
                        $shortcode_content .= '<span class="cat-name">'.$category.'</span>';                    
                    $shortcode_content .= '</a>';
                    $shortcode_content .= '<br>'; 

                    $shortcode_content .= '<span class="cat-count"><strong>'.$cat->count.'</strong> '.esc_html($products_label_text_value).'</span>';
                    $shortcode_content .= '<br>';
                    $shortcode_content .= '<div class="category-button">';
                       $shortcode_content .= '<a href="'.get_term_link($cat->slug, 'product_cat').'" class="button" title="'.esc_attr__('View more','modeltheme').'" ><span>'.$button_text_value.'</span></a>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</div>';    
            $shortcode_content .= '</div>';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-9 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';


    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-expired-with-thumbnails', 'ibid_shop_expiring_thumbnail_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Expired Products Simple ---*/
/*---------------------------------------------*/

function ibid_expiring_soon_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'category'                             => '',
            'hide_empty'                           => ''
        ), $params ) );


    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_expiring">';
       
        $shortcode_content .= '<div class="products_category">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';


    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-expiring-soon', 'ibid_expiring_soon_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Latest Products Simple ---*/
/*---------------------------------------------*/

function ibid_latest_products_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'category'                             => '',
            'layout'                               => '',
            'hide_empty'                           => ''
        ), $params ) );

    $cat = get_term_by('slug', $category, 'product_cat');

    if (isset($number_of_columns)) {
        if ($number_of_columns == '' || $number_of_columns == '3') {
            $column_type = 'col-md-4';
        }elseif($number_of_columns == '4'){
            $column_type = 'col-md-3';
         }elseif($number_of_columns == '6'){
            $column_type = 'col-md-2';
        }
    }else{
        $column_type = 'col-md-3';
    }

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_simple_boxed">';
       
       if($layout == "box-border") {

        $shortcode_content .= '<div class="products_category">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "box-shadow") {

        $shortcode_content .= '<div class="modeltheme_products_shadow">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "v4") {

        $shortcode_content .= '<div class="modeltheme_products_v4">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

        } elseif($layout == "simple") {

        $shortcode_content .= '<div class="modeltheme_products_simple row">';
        $args_prods = array(
              'posts_per_page'   => $number_of_products_by_category,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category
                )
                ),
              'post_status'      => 'publish' 
         ); 
        $prods = get_posts($args_prods);
        
        foreach ($prods as $prod) {
            #thumbnail
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $prod->ID ), 'ibid_product_simple_285x38' );
            $product_cause = get_post_meta( $prod->ID, 'product_cause', true );
            if ($thumbnail_src) {
                $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$prod->post_title.'" />';
                $post_col = 'col-md-12';
            }else{
                $post_col = 'col-md-12 no-featured-image';
                $post_img = '';
            }
            $shortcode_content .= '<div id="product-id-'.esc_attr($prod->ID).'">
                                    <div class="'.$column_type.' modeltheme-product ">
                                        <div class="modeltheme-product-wrapper"> 
                                            <div class="modeltheme-thumbnail-and-details">
                                                <a class="modeltheme_media_image" title="'.esc_attr($prod->post_title).'" href="'.esc_url(get_permalink($prod->ID)).'"> '.$post_img.'</a>
                                                <a href="'.esc_url(get_permalink()).'products/?add-to-cart='.esc_attr($prod->ID).'" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.esc_attr($prod->ID).'" aria-label="Add “Berry Energizer” to your cart" rel="nofollow">'.esc_html__('Add to Cart','modeltheme').'</a>
                                            </div>

                                            <div class="modeltheme-title-metas">
                                                <h3 class="modeltheme-archive-product-title">
                                                    <a href="'.esc_url(get_permalink($prod->ID)).'" title="'. $prod->post_title .'">'. $prod->post_title .'</a>
                                                </h3>';
                                                
                                                global $product;
                                                $product = wc_get_product( $prod->ID );
                                                if( $product->post_type !== 'auction' ) {
                                                     $shortcode_content .= '<p>'.$product->get_price_html().'</p>';
                                                }
                                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                                  $product = wc_get_product( $prod->ID );
                                                  // metas
                                                  $meta_auction_current_bid = get_post_meta( $prod->ID, '_auction_current_bid', true );
                                                  $meta_auction_start_price = get_post_meta( $prod->ID, '_auction_start_price', true );
                                                  $meta_auction_closed = get_post_meta( $prod->ID, '_auction_closed', true );
                                                  global $ibid_redux;
                      
                                                  if( $product->post_type !== 'auction' ) {
                                                    if ($meta_auction_closed == '') {
                                                      if ($meta_auction_current_bid) {
                                                        
                                                        $shortcode_content .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                                        if($product_cause){
                                                            $shortcode_content .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                                        }
                                                        $shortcode_content .= '<div class="modeltheme-button-bid text-center">
                                                                <a href ="'.esc_url(get_permalink($prod->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                                              </div>';
                                                      }else if($meta_auction_start_price){
                                                        $shortcode_content .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                                        $shortcode_content .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
                                                            if($product_cause){
                                                                $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                                            }
                                                        }
                                                        $shortcode_content .= '<div class="modeltheme-button-bid text-center">
                                                                <a href ="'.esc_url(get_permalink($prod->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                                              </div>';
                                                      }

                                                    }
                                                  } 
                                                }
                      $shortcode_content .= '</div>
                                        </div>
                                    </div>                     
                                </div>';
                                }
    $shortcode_content .= '</div>';
                            }
    $shortcode_content .= '</div>';


    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-products-boxed', 'ibid_latest_products_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Latest Products Simple ---*/
/*---------------------------------------------*/

function ibid_latest_styled_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'category'                             => '',
            'product_1'                            => '',
            'product_2'                            => '',
            'product_3'                            => '',
            'product_4'                            => '',
            'layout'                               => '',
            'hide_empty'                           => ''
        ), $params ) );

    $cat = get_term_by('slug', $category, 'product_cat');


    if (isset($number_of_columns)) {
        if ($number_of_columns == '' || $number_of_columns == '3') {
            $column_type = 'col-md-4';
        }elseif($number_of_columns == '4'){
            $column_type = 'col-md-3';
        }
    }else{
        $column_type = 'col-md-3';
    }

    if (isset($layout)) {
        if ($layout == '' || $layout == 'horizontal') {
            $block_type = 'products_category';
        }elseif($layout == 'vertical'){
            $block_type = 'products_category_vertical';
        }elseif($layout == 'simple'){
            $block_type = 'products_category_simple';
        }
    }else{
        $block_type = 'products_category';
    }

    $shortcode_content = '';
    $shortcode_content .= '<style>
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(1) .products-wrapper{
                                background: '.$product_1.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(2) .products-wrapper{
                                background: '.$product_2.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(3) .products-wrapper{
                                background: '.$product_3.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(4) .products-wrapper{
                                background: '.$product_4.';
                            }
                            </style>';
    $shortcode_content .= '<div class="woocommerce_simple_styled">';
       
        $shortcode_content .= '<div class="'.$block_type.'">';
                        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';

       
    $shortcode_content .= '</div>';


    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-products-styled', 'ibid_latest_styled_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Products Carousel ---*/
/*---------------------------------------------*/

function mt_carousel_products($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'true',
            'navigationText' => '',
            'order' => 'desc',
            'pagination' => 'true',
            'autoPlay' => 'true',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';

    // CLASSES
    $class_slider = 'mt_carousel_products_'.uniqid();

    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        navigationText  : '.$navigationText.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';

        $html .= '<div class="modeltheme_products_carousel '.$class_slider.' row  owl-carousel owl-theme">';
        $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
         ); 
        $blogposts = get_posts($args_blogposts);
        
        foreach ($blogposts as $blogpost) {
                #metaboxes

                #thumbnail
                 $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_portfolio_pic400x400' );
                 $product_cause = get_post_meta( $blogpost->ID, 'product_cause', true );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col = 'col-md-12';
                  }else{
                    $post_col = 'col-md-12 no-featured-image';
                    $post_img = '';
                  }
            $html .= '<div id="product-id-'.esc_attr($blogpost->ID).'">
                        <div class="col-md-12 modeltheme-slider ">
                            <div class="modeltheme-slider-wrapper"> 
                              <div class="modeltheme-thumbnail-and-details">
                                <a class="modeltheme_media_image" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>
                              </div>
                              <div class="modeltheme-title-metas text-center">
                                <h3 class="modeltheme-archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';



                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                  $product = wc_get_product( $blogpost->ID );
                                  // metas
                                  $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                                  $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                                  $meta_auction_closed = get_post_meta( $blogpost->ID, '_auction_closed', true );
                                  global $ibid_redux;
      
                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $html .= '<p>'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $html .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                        if($product_cause){
                                            $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                        }
                                        $html .= '<div class="modeltheme-button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                      }else if($meta_auction_start_price){
                                        $html .= '<p>'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $html .= '<p>'.esc_html__('Expires on:','modeltheme').' <span class="end_date_prod">' .date_i18n( get_option( 'date_format' ),  strtotime( $product->get_auction_end_time() )).'</span></p>';
                                        if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
                                            if($product_cause){
                                                $html .= '<p>'.esc_html__('Cause: ','modeltheme').'<a class="cause_prod" href="'.esc_url(get_permalink($product_cause)).'" title="'. get_the_title($product_cause) .'">'. get_the_title($product_cause) .'</a></p>';
                                            }
                                        }
                                        $html .= '<div class="modeltheme-button-bid text-center">
                                                <a href ="'.esc_url(get_permalink($blogpost->ID)).'">'.esc_html__('Bid Now','modeltheme').'</a>
                                              </div>';
                                      }

                                    }else {
                                      $html .= '<p class="modeltheme-price">'.esc_html__('Auction closed','modeltheme').'</p>';
                                    }
                                  }
                                }
                    $html .= '</div>
                            </div>
                        </div>                     
                    </div>';
                }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt-products-carousel', 'mt_carousel_products');

/*---------------------------------------------*/
/*--- Woocommerce Latest Domains Simple ---*/
/*---------------------------------------------*/

function ibid_latest_domains_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'category'                             => '',
            'hide_empty'                           => ''
        ), $params ) );

   $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => $number_of_products_by_category,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $prods = new WP_Query( $args );
    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_simple_domain">';
       
        $shortcode_content .= '<div class="products_category">';
        while ($prods->have_posts()) {
                $prods->the_post();
                global $product; 
                $shortcode_content .= '
                    <div class="'.$number_of_columns.' domain-list-shortcode">
                        <div class="col-md-12 post">
                            <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                      <a href="'.get_permalink().'"</a>'.$product->get_title(). '</a>
                                </h3>
                            </div>
                            <div class="domain-bid">';
                             if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                  // metas
                                  $meta_auction_dates_to = get_post_meta( get_the_ID(), '_auction_dates_to', true );
                                    $meta_auction_closed = get_post_meta( get_the_ID(), '_auction_closed', true );
                                    $meta_auction_current_bid = get_post_meta( get_the_ID(), '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( get_the_ID(), '_auction_start_price', true );
                                    $date = date_create($meta_auction_dates_to);
                                  if( $product->post_type !== 'auction' ) {
                                    if ($meta_auction_closed == '') {
                                      if ($meta_auction_current_bid) {
                                        $shortcode_content .= '<p class="start-bid">'.esc_html__('Current bid: ','modeltheme').''.wc_price($meta_auction_current_bid).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
                                                  </div>';
                                      }else if($meta_auction_start_price){
                                        $shortcode_content .= '<p class="start-bid">'.esc_html__('Starting bid: ','modeltheme').''.wc_price($meta_auction_start_price).'</p>';
                                        $shortcode_content .= '<div class="button-bid text-center">
                                                    <a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</a>
                                                  </div>';
                                      }

                                    }else {
                                      $shortcode_content .= '<p class="price">'.esc_html__('Auction closed','modeltheme').'</p>';
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
add_shortcode('shop-products-domains', 'ibid_latest_domains_shortcode');

/*---------------------------------------------*/
/*--- Masonry Banners ---*/
/*---------------------------------------------*/
function ibid_shop_masonry_banners_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'default_skin_background_color'      => '',
            'dark_skin_background_color'         => '',
            'banner_1_img'                       => '',
            'banner_1_title'                     => '',
            'banner_1_count'                     => '',
            'banner_1_url'                       => '',
            'banner_2_img'                       => '',
            'banner_2_title'                     => '',
            'banner_2_count'                     => '',
            'banner_2_url'                       => '',
            'banner_3_img'                       => '',
            'banner_3_title'                     => '',
            'banner_3_count'                     => '',
            'banner_3_url'                       => '',
            'banner_4_img'                       => '',
            'banner_4_title'                     => '',
            'banner_4_count'                     => '',
            'banner_4_url'                       => '',
            'button_style'                       => ''
        ), $params ) );

    
    
    $shortcode_content = '';


    $shortcode_content .= '<div class="masonry_banners banners_column">';

        $img1 = wp_get_attachment_image_src($banner_1_img, "large");
        $img2 = wp_get_attachment_image_src($banner_2_img, "large");
        $img3 = wp_get_attachment_image_src($banner_3_img, "large");
        $img4 = wp_get_attachment_image_src($banner_4_img, "large");

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #1
            if (isset($img1) && !empty($img1)) {
                $shortcode_content .= '<div class="masonry_banner default-skin" style=" background-color: '.$default_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_1_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img1[0].'" alt="'.$banner_1_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_1_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_1_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
            #IMG #2
            if (isset($img2) && !empty($img2)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin" style="background-color: '.$dark_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_2_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img2[0].'" alt="'.$banner_2_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_2_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_2_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #3
            if (isset($img3) && !empty($img3)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin">';
                    $shortcode_content .= '<a href="'.$banner_3_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img3[0].'" alt="'.$banner_3_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_3_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_3_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
            #IMG #4
            if (isset($img4) && !empty($img4)) {
                $shortcode_content .= '<div class="masonry_banner default-skin">';
                    $shortcode_content .= '<a href="'.$banner_4_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img4[0].'" alt="'.$banner_4_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_4_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_4_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';

    return $shortcode_content;
}
add_shortcode('shop-masonry-banners', 'ibid_shop_masonry_banners_shortcode');


function ibid_domain_banners_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'default_skin_background_color'      => '',
            'dark_skin_background_color'         => '',
            'banner_1_img'                       => '',
            'banner_1_title'                     => '',
            'banner_1_count'                     => '',
            'banner_1_url'                       => '',
            'banner_2_img'                       => '',
            'banner_2_title'                     => '',
            'banner_2_count'                     => '',
            'banner_2_url'                       => '',
            'banner_3_img'                       => '',
            'banner_3_title'                     => '',
            'banner_3_count'                     => '',
            'banner_3_url'                       => '',
            'banner_1_prefix'                       => '',
            'banner_2_prefix'                       => '',
            'banner_3_prefix'                       => '',
            'button_style'                       => ''
        ), $params ) );

    
    
    $shortcode_content = '';


    $shortcode_content .= '<div class="masonry_banners banners_column domains">';

        $img1 = wp_get_attachment_image_src($banner_1_img, "large");
        $img2 = wp_get_attachment_image_src($banner_2_img, "large");
        $img3 = wp_get_attachment_image_src($banner_3_img, "large");

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #1
            if (isset($img1) && !empty($img1)) {
                $shortcode_content .= '<div class="masonry_banner default-skin" style=" background-color: '.$default_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_1_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img1[0].'" alt="'.$banner_1_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h2 class="category_prefix">'.$banner_1_prefix.'</h2>';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_1_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_1_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #3
            if (isset($img2) && !empty($img2)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin">';
                    $shortcode_content .= '<a href="'.$banner_2_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img2[0].'" alt="'.$banner_2_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h2 class="category_prefix">'.$banner_2_prefix.'</h2>';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_2_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_2_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
            #IMG #4
            if (isset($img3) && !empty($img3)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin">';
                    $shortcode_content .= '<a href="'.$banner_3_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img3[0].'" alt="'.$banner_3_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h2 class="category_prefix">'.$banner_3_prefix.'</h2>';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_3_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_3_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';

    return $shortcode_content;
}
add_shortcode('domain-masonry-banners', 'ibid_domain_banners_shortcode');

/*---------------------------------------------*/
/*--- Masonry Banners ---*/
/*---------------------------------------------*/
function ibid_shop_sale_banner_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'banner_img'            => '',
            'banner_button_text'    => '',
            'banner_button_count'    => '',
            'banner_button_url'     => '',
            'title_color'           => '',
            'subtitle_color'        => '',
            'layout'                => ''
        ), $params ) );

    $banner = wp_get_attachment_image_src($banner_img, "large");
    if (isset($layout)) {
        if ($layout == '' || $layout == 'bottom') {
            $layout_type = 'sale_banner_holder';
        }elseif($layout == 'center'){
            $layout_type = 'sale_banner_center';
        }elseif($layout == 'right'){
            $layout_type = 'sale_banner_right';
        }
    }else{
        $layout_type = 'sale_banner_holder';
    }

    $shortcode_content = '';
    #SALE BANNER
    $shortcode_content .= '<div class="sale_banner relative">';
            $shortcode_content .= '<img src="'.$banner[0].'" alt="'.$banner_button_text.'" />';
            $shortcode_content .= '<a href="'.$banner_button_url.'">
                                    <div class="'.$layout_type.'">';
                $shortcode_content .= '<div class="masonry_holder">';
                    $shortcode_content .= '<h3 style="color:'.$title_color.';" class="category_name">'.$banner_button_text.'</h3>';
                        $shortcode_content .= '<p style="color:'.$subtitle_color.'" class="category_count">'.$banner_button_count.'</p>';
                        if($layout == 'right'){
                             $shortcode_content .= '<span class="read-more ">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        }
                    $shortcode_content .= '</div>';
            $shortcode_content .= '</div></a>';
    $shortcode_content .= '</div>';
       
    return $shortcode_content;
}
add_shortcode('sale-banner', 'ibid_shop_sale_banner_shortcode');






/*---------------------------------------------*/
/*--- 28. BLOG POSTS ---*/
/*---------------------------------------------*/
function ibid_show_blog_post_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'            => '',
            'category'          => '',
            'overlay_color'     => '',
            'text_color'        => '',
            'columns'           => '',
            'layout'            => ''
           ), $params ) );
    $args_posts = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);

    $shortcode_content = '';
    $shortcode_content .= '<div class="ibid_shortcode_blog vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_portfolio_pic400x400' );
        $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_related_post_pic500x300' );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID); 
        $shortcode_content .= '<div class="'.$columns.' post '.$layout.'">';

        if($layout == "image_left" || $layout == "") {
            $shortcode_content .= '<div class="col-md-4 blog-thumbnail">';
                $shortcode_content .= '<a href="'.$url.'" class="relative">';
                    if($thumbnail_src) { 
                        $shortcode_content .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                    }else{ 
                        $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                    }
                    $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                        $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</a>';
            $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="col-md-8 blog-content">';
                $shortcode_content .= '<div class="head-content">';
                    $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '<div class="post-excerpt">'.wp_trim_words($excerpt,9).'</div>';
            $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        }else{
            $shortcode_content .= '<div class="col-md-12 blog-thumbnail ">';
                $shortcode_content .= '<a href="'.$url.'" class="relative">';
                    if($thumbnail_src) { 
                        $shortcode_content .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                    }else{ 
                        $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                    }
                    $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                        $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</a>';
            $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="col-md-12 blog-content">';
                $shortcode_content .= '<div class="text-center content-element">';
                        $shortcode_content .= '<p class="author">';
                            $shortcode_content .= '<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )).'">'.esc_html(get_the_author()).'</a> | <span>' . get_the_time('j ',$post->ID) . '</span>' . get_the_time('M, Y',$post->ID) . '';
                        $shortcode_content .= '</p>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '<div class="head-content">';
                    $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        }
    } 
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('ibid-blog-posts', 'ibid_show_blog_post_shortcode');

/*---------------------------------------------*/
/*--- 28. BLOG POSTS BOXED---*/
/*---------------------------------------------*/
function ibid_show_blog_boxed_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'            => '',
            'category'          => '',
            'overlay_color'     => '',
            'text_color'        => '',
            'columns'           => ''
           ), $params ) );
    $args_posts = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);

    $shortcode_content = '';
    $shortcode_content .= '<div class="ibid_shortcode_blog boxed vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_portfolio_230x350' );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID); 
        $shortcode_content .= '<div class="'.$columns.' post">';
             $shortcode_content .= '<div class="col-md-12 post-wrapper">';
                $shortcode_content .= '<div class="col-md-4 blog-thumbnail">';
                    $shortcode_content .= '<a href="'.$url.'" class="relative">';
                        if($thumbnail_src) { 
                            $shortcode_content .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                        }else{ 
                            $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                        }
                        $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                            $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';

                $shortcode_content .= '<div class="col-md-8 blog-content">';
                    $shortcode_content .= '<div class="head-content">';
                        $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                    $shortcode_content .= '</div>';
                    $shortcode_content .= '<div class="post-excerpt">'.wp_trim_words($excerpt,9).'</div>';
                    $shortcode_content .= '<div class="post-button">
                                        <a href="'.$url.'" class="more-link">
                                            '. esc_html__( 'Read more', 'modeltheme' ).'
                                        </a>
                                    </div>';
                $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
    } 
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('ibid-blog-boxed', 'ibid_show_blog_boxed_shortcode');


/*---------------------------------------------*/
/*--- 29. Social Media ---*/
/*---------------------------------------------*/
function ibid_social_icons_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'facebook'      => '',
            'twitter'       => '',
            'pinterest'     => '',
            'skype'         => '',
            'instagram'     => '',
            'youtube'       => '',
            'dribbble'      => '',
            'googleplus'    => '',
            'linkedin'      => '',
            'deviantart'    => '',
            'digg'          => '',
            'flickr'        => '',
            'stumbleupon'   => '',
            'tumblr'        => '',
            'vimeo'         => '',
            'animation'     => ''
        ), $params ) ); 
        $content = '';
        $content .= '<div class="sidebar-social-networks vc_social-networks widget_social_icons animateIn vc_row" data-animate="'.$animation.'">';
            $content .= '<ul class="vc_col-md-12">';
            if ( isset($facebook) && $facebook != '' ) {
                $content .= '<li><a href="'.esc_attr( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
            }
            if ( isset($twitter) && $twitter != '' ) {
                $content .= '<li><a href="'.esc_attr( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
            }
            if ( isset($pinterest) && $pinterest != '' ) {
                $content .= '<li><a href="'.esc_attr( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>';
            }
            if ( isset($youtube) && $youtube != '' ) {
                $content .= '<li><a href="'.esc_attr( $youtube ).'"><i class="fa fa-youtube"></i></a></li>';
            }
            if ( isset($instagram) && $instagram != '' ) {
                $content .= '<li><a href="'.esc_attr( $instagram ).'"><i class="fa fa-instagram"></i></a></li>';
            }
            if ( isset($linkedin) && $linkedin != '' ) {
                $content .= '<li><a href="'.esc_attr( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>';
            }
            if ( isset($skype) && $skype != '' ) {
                $content .= '<li><a href="skype:'.esc_attr( $skype ).'?call"><i class="fa fa-skype"></i></a></li>';
            }
            if ( isset($googleplus) && $googleplus != '' ) {
                $content .= '<li><a href="'.esc_attr( $googleplus ).'"><i class="fa fa-google-plus"></i></a></li>';
            }
            if ( isset($dribbble) && $dribbble != '' ) {
                $content .= '<li><a href="'.esc_attr( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>';
            }
            if ( isset($deviantart) && $deviantart != '' ) {
                $content .= '<li><a href="'.esc_attr( $deviantart ).'"><i class="fa fa-deviantart"></i></a></li>';
            }
            if ( isset($digg) && $digg != '' ) {
                $content .= '<li><a href="'.esc_attr( $digg ).'"><i class="fa fa-digg"></i></a></li>';
            }
            if ( isset($flickr) && $flickr != '' ) {
                $content .= '<li><a href="'.esc_attr( $flickr ).'"><i class="fa fa-flickr"></i></a></li>';
            }
            if ( isset($stumbleupon) && $stumbleupon != '' ) {
                $content .= '<li><a href="'.esc_attr( $stumbleupon ).'"><i class="fa fa-stumbleupon"></i></a></li>';
            }
            if ( isset($tumblr) && $tumblr != '' ) {
                $content .= '<li><a href="'.esc_attr( $tumblr ).'"><i class="fa fa-tumblr"></i></a></li>';
            }
            if ( isset($vimeo) && $vimeo != '' ) {
                $content .= '<li><a href="'.esc_attr( $vimeo ).'"><i class="fa fa-vimeo-square"></i></a></li>';
            }
            $content .= '</ul>';
        $content .= '</div>';
        return $content;
}
add_shortcode('social_icons', 'ibid_social_icons_shortcode');


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// check for plugin using plugin name
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
  require_once('vc-shortcodes.inc.php');
} 

/**

||-> Shortcode: Members Slider

*/

function mt_shortcode_members01($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'false',
            'order' => 'desc',
            'pagination' => 'false',
            'autoPlay' => 'false',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';



    // CLASSES
    $class_slider = 'mt_slider_members_'.uniqid();



    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';


        $html .= '<div class="mt_members1 '.$class_slider.' row animateIn wow '.$animation.'">';
        $args_members = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => $order,
                'post_type'        => 'member',
                'post_status'      => 'publish' 
                ); 
        $members = get_posts($args_members);
            foreach ($members as $member) {
                #metaboxes
                $metabox_member_position = get_post_meta( $member->ID, 'av-job-position', true );

                $metabox_facebook_profile = get_post_meta( $member->ID, 'av-facebook-link', true );
                $metabox_twitter_profile  = get_post_meta( $member->ID, 'av-twitter-link', true );
                $metabox_linkedin_profile = get_post_meta( $member->ID, 'av-gplus-link', true );
                $metabox_vimeo_url = get_post_meta( $member->ID, 'av-instagram-link', true );

                $member_title = get_the_title( $member->ID );

                $testimonial_id = $member->ID;
                $content_post   = get_post($member);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ),'full' );

                if($metabox_facebook_profile) {
                    $profil_fb = '<a target="_new" href="'. $metabox_facebook_profile .'" class="member01_profile-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i></a> ';
                }

                if($metabox_twitter_profile) {
                    $profil_tw = '<a target="_new" href="https://twitter.com/'. $metabox_twitter_profile .'" class="member01_profile-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i></a> ';
                }

                if($metabox_linkedin_profile) {
                    $profil_in = '<a target="_new" href="'. $metabox_linkedin_profile .'" class="member01_profile-linkedin"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a> ';
                }

                if($metabox_vimeo_url) {
                    $profil_vi = '<a target="_new" href="'. $metabox_vimeo_url .'" class="member01_vimeo_url"> <i class="fa fa-vimeo" aria-hidden="true"></i> </a> ';
                }
                
                $html.='
                    <div class="col-md-12 relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="member_hover" class="members_img_holder">
                                    <div class="member01-content">
                                        <div class="member01-content-inside">
                                            <h3 class="member01_name">'.$member_title.'</h3>
                                            <div class="content-div"><p class="member01_content-desc">'.  $metabox_member_position. '</p></div>
                                            <div class="member01_social">' . $profil_fb . $profil_tw . $profil_in . $profil_vi . '</div>
                                        </div>
                                    </div>
                                    <div class="memeber01-img-holder">';
                                        if($thumbnail_src) { 
                                            $html .= '<div class="grid">
                                                        <div class="effect-duke">
                                                            <img src="'. $thumbnail_src[0] . '" alt="'. $member->post_title .'" />
                                                        </div>
                                                      </div>';
                                        }else{ 
                                            $html .= '<img src="http://placehold.it/450x1000" alt="'. $member->post_title .'" />'; 
                                        }
                                    $html.='</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt_members_slider', 'mt_shortcode_members01');



function modeltheme_icon_listgroup_shortcode($params, $content) {
  extract( shortcode_atts( 
      array(
          'list_icon'               => '',
          'list_image'              => '',
          'list_image_max_width'    => '',
          'list_image_margin'       => '',
          'list_icon_size'          => '',
          'list_icon_margin'        => '',
          'list_icon_color'         => '',
          'list_icon__hover_color'  => '',
          'list_icon_title'         => '',
          'list_icon_url'           => '',
          'list_icon_title_size'    => '',
          'list_icon_title_color'   => '',
          'list_icon_subtitle'                => '',
          'list_icon_subtitle_size'      => '',
          'list_icon_subtitle_color'          => '',
          'animation'               => '',
      ), $params ) );
  $thumb      = wp_get_attachment_image_src($list_image, "full");
  $thumb_src  = $thumb[0];
  $html = '';
  if(!empty($list_icon__hover_color)) {
    $html .= '<style type="text/css">
                  .mt-icon-listgroup-holder:hover i {
                      color: '.$list_icon__hover_color.' !important;
                  }
              </style>';
  }
  $html .= '<div class="mt-icon-listgroup-item wow '.$animation.'">';
              if (!empty($list_icon_url)) {
                $html .= '<a href="'.$list_icon_url.'">';
              }
      $html .= '<div class="mt-icon-listgroup-holder">
                  <div class="mt-icon-listgroup-icon-holder-inner">';
                    if(empty($list_image)) {
                    $html .= '<i style="margin-right:'.esc_attr($list_icon_margin).'px; color:'.esc_attr($list_icon_color).';font-size:'.esc_attr($list_icon_size).'px" class="'.esc_attr($list_icon).'"></i>';
                    } else {
                      $html .='<img alt="list-image" style="margin-right:'.esc_attr($list_image_margin).'px;" class="mt-image-list" src="'.esc_attr($thumb_src).'">';
                    }
                  $html .= '</div>
                <div class="mt-icon-listgroup-content-holder-inner">
                  <p class="mt-icon-listgroup-title" style="font-size: '.esc_attr($list_icon_title_size).'px; color: '.esc_attr($list_icon_title_color).'">'.esc_attr($list_icon_title).'</p>
                  <p class="mt-icon-listgroup-text" style="font-size: '.esc_attr($list_icon_subtitle_size).'px; color: '.esc_attr($list_icon_subtitle_color).'">'.esc_attr($list_icon_subtitle).'</p>                  
                </div>
              </div>';
              if (!empty($list_icon_url)) {
                $html .= '</a>';
              }
            $html .= '</div>';
  return $html;
}
add_shortcode('mt_list_group', 'modeltheme_icon_listgroup_shortcode');
/**
||-> Map Shortcode in Visual Composer with: vc_map();
*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
  vc_map( array(
     "name" => esc_attr__("iBid - Icon List Group Item", 'modeltheme'),
     "base" => "mt_list_group",
     "category" => esc_attr__('iBid', 'modeltheme'),
     "icon" => plugins_url( 'images/Typed-Text.svg', __FILE__ ),
     "params" => array(
        array(
          "group" => "Image Setup",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "list_image",
          "value" => "",
          "description" => esc_attr__( "If you set this, will overwrite the icon setup.", 'modeltheme' )
        ),
        array(
          "group" => "Image Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image max width", 'modeltheme'),
          "param_name" => "list_image_max_width",
          "value" => "50",
          "description" => "Default: 50(px)"
        ),
        array(
          "group" => "Image Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image Margin right (px)", 'modeltheme'),
          "param_name" => "list_image_margin",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Size (px)", 'modeltheme'),
          "param_name" => "list_icon_size",
          "value" => "",
          "description" => "Default: 18(px)"
        ),
        array(
          "group" => "Icon Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Margin right (px)", 'modeltheme'),
          "param_name" => "list_icon_margin",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Color", 'modeltheme'),
          "param_name" => "list_icon_color",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Hover Color", 'modeltheme'),
          "param_name" => "list_icon__hover_color",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/Title", 'modeltheme'),
          "param_name" => "list_icon_title",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: This is a label"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/SubTitle", 'modeltheme'),
          "param_name" => "list_icon_subtitle",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: This is a label"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/Icon URL", 'modeltheme'),
          "param_name" => "list_icon_url",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: http://modeltheme.com"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Title Font Size", 'modeltheme'),
          "param_name" => "list_icon_title_size",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "colorpicker",
          "heading" => esc_attr__("Title Color", 'modeltheme'),
          "param_name" => "list_icon_title_color",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("SubTitle Font Size", 'modeltheme'),
          "param_name" => "list_icon_subtitle_size",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "colorpicker",
          "heading" => esc_attr__("SubTitle Color", 'modeltheme'),
          "param_name" => "list_icon_subtitle_color",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ), 
     )
  ));
}



/*--------------------------------------------- */
/*--- 30. Countdown version 2 ---*/
/*---------------------------------------------*/
function modeltheme_shortcode_countdown_version_2($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'insert_date'               => '',
            'el_class'              => ''
        ), $params ) );

    $html = '';
    
    $countdown_format = 'DHMS';
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if (ibid_redux('ibid-archive-countdown-date-format') != '') {
            $countdown_format = ibid_redux('ibid-archive-countdown-date-format');
        }
    }

    $countdown_is_rtl = 'false';
    if (is_rtl()) {
        $countdown_is_rtl = 'true';
    }


    $uniqueID = 'countdown_'.uniqid();

    $html .= '<div class="countdownv2_holder '.$el_class.'" data-insert-date="'.$insert_date.'" data-unique-id="'.$uniqueID.'" data-countdown-direction="'.$countdown_is_rtl.'" data-date-format-redux="'.$countdown_format.'">';
        $html .= '<div class="countdownv2 clock " id="'.$uniqueID.'"></div>';
    $html .= '</div>';

    return $html;
}

add_shortcode('shortcode_countdown_v2', 'modeltheme_shortcode_countdown_version_2');


/**

||-> Shortcode: Featured Product

*/
function modeltheme_shortcode_featured_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text'                     =>'',
            'subtitle_product'                =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = ''; 
    $html .= '<div class="featured_product_shortcode col-md-12 wow '.$animation.' " style=" background-color: '.$background_color.';">';
       
      global $woocommerce;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;
      $meta_auction_dates_to = get_post_meta( $select_product, '_auction_dates_to', true );
      $date = date_create($meta_auction_dates_to);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);


        $html .= '<div class="featured_product_details_holder  col-md-6">';
          $html.='<h2 class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</h2>';
          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>
                  </h1>';

          $html.='<h3 class="featured_product_price" style="color: '.$price_text_color.';">' .esc_html__("Current bid :","modeltheme").' '.$product->get_price_html().'</h2>';
          $html.='<div class="featured_product_description">'.$content.'</div>';
          $html.='<div class="featured_product_countdown">
                    
                 '.do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d H:i:s')).'"]').'</div>';
       
          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';

        $html .= '</div>';

        $html .= '<div class="featured_product_image_holder col-md-6">';
          if ( has_post_thumbnail( $select_product ) ) {
              $attachment_ids[0] = get_post_thumbnail_id( $select_product );
              $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
              $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
             }
        $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_product', 'modeltheme_shortcode_featured_product');

/**

||-> Shortcode: Featured Product

*/
function modeltheme_shortcode_featured_simple_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text'                     =>'',
            'subtitle_product'                =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';

    


    $html .= '<div class="featured_product_shortcode simple col-md-12 wow '.$animation.' " style=" background-color: '.$background_color.';">';
      $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
              ); 

              
      $blogposts = get_posts($args_blogposts);
      

      foreach ($blogposts as $blogpost) {
      global $woocommerce, $product, $post;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;
      $meta_auction_dates_to = get_post_meta( $select_product, '_auction_dates_to', true );
      $date = date_create($meta_auction_dates_to);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);


        $html .= '<div class="featured_product_details_holder  col-md-6">';
          
          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>

                  </h1>';
           
          $html.='<div class="featured_product_description">'.$content.'</div>';
        
          $html.='<h3 class="featured_product_price" style="color: '.$price_text_color.';">'.$product->get_price_html().'</h2>';

          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';

          $html.='<p class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</p>';

        $html .= '</div>';

        $html .= '<div class="featured_product_image_holder col-md-6">';
          if ( has_post_thumbnail( $select_product ) ) {
              $attachment_ids[0] = get_post_thumbnail_id( $select_product );
              $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
              $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
             }
        $html .= '</div>';

      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_simple_product', 'modeltheme_shortcode_featured_simple_product');

/**

||-> Shortcode: Featured Product no image

*/
function modeltheme_shortcode_featured_no_image($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text'                     =>'',
            'subtitle_product'                =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';

    


    $html .= '<div class="featured_product_shortcode v2 col-md-12 wow '.$animation.' " style=" background-color: '.$background_color.';">';
      $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
              ); 

              
      $blogposts = get_posts($args_blogposts);


      foreach ($blogposts as $blogpost) {
      global $woocommerce, $product, $post;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;
      $meta_auction_dates_to = get_post_meta( $select_product, '_auction_dates_to', true );
      $date = date_create($meta_auction_dates_to);

      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);


        $html .= '<div class="featured_product_details_holder col-md-12">';
          $html.='<h2 class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</h2>';
          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>

                  </h1>';
          
          
          $html.='<div class="featured_product_description">'.$content.'</div>';
          $html.='<div class="featured_product_countdown">
                    
                 '.do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d H:i:s')).'"]').'</div>';

          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';
          $html.='<p class="featured_product_price" style="color: '.$price_text_color.';">' .esc_html__("Current bid :","modeltheme").' '.$product->get_price_html().'</p>';

        $html .= '</div>';


      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_product_no_image', 'modeltheme_shortcode_featured_no_image');

?>
