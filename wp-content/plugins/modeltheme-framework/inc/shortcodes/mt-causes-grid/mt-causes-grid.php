<?php

function ibid_cause_post_shortcode( $params, $content ) {
    global $ibid_redux;
    if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
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
            'post_type'             => 'cause',
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);

    $shortcode_content = '';
    $shortcode_content .= '<div class="ibid_shortcode_cause vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_portfolio_pic500x350' );
        $cause_tagline = get_post_meta( $post->ID, 'cause_tagline', true );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID); 
        $shortcode_content .= '<div class="'.$columns.' post">';
        $shortcode_content .= '<div class="col-md-12 cause-wrapper">';
        $shortcode_content .= '<div class="cause-thumbnail">';
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

        $shortcode_content .= '<div class="cause-content">';
            $shortcode_content .= '<div class="head-content text-center">';
                $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'. esc_html($cause_tagline).'</a></h3>';
            $shortcode_content .= '</div>';
            $shortcode_content .= '<div class="button-content text-center">';
                $shortcode_content .= '<a href ="'.$url.'">'.esc_html__('View Cause','modeltheme').'</a>';
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';
    } 
    $shortcode_content .= '</div>';
    return $shortcode_content;
}}
add_shortcode('ibid-cause-posts', 'ibid_cause_post_shortcode');