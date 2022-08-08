<?php 


/* ========= social_icons ===================================== */
class ibid_social_icons extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('ibid_social_icons', esc_attr__('iBid - Social icons widget','modeltheme'),array( 'description' => esc_attr__( 'iBid - Social icons widget','modeltheme' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        global $ibid_redux;
        $widget_title = $instance[ 'widget_title' ];

        echo  $args['before_widget']; ?>

        <div class="sidebar-social-networks">
            <?php if($widget_title) { ?>
               <h3 class="widget-title"><?php echo esc_attr($widget_title); ?></h3>
            <?php } ?>
            <ul>
            <?php if ( isset($ibid_redux['ibid_social_fb']) && $ibid_redux['ibid_social_fb'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_fb'] ) ?>"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_tw']) && $ibid_redux['ibid_social_tw'] != '' ) { ?>
                <li><a target="_blank" href="https://twitter.com/<?php echo esc_attr( $ibid_redux['ibid_social_tw'] ) ?>"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_youtube']) && $ibid_redux['ibid_social_youtube'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_youtube'] ) ?>"><i class="fa fa-youtube"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_pinterest']) && $ibid_redux['ibid_social_pinterest'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_pinterest'] ) ?>"><i class="fa fa-pinterest"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_linkedin']) && $ibid_redux['ibid_social_linkedin'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_linkedin'] ) ?>"><i class="fa fa-linkedin"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_skype']) && $ibid_redux['ibid_social_skype'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_skype'] ) ?>"><i class="fa fa-skype"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_instagram']) && $ibid_redux['ibid_social_instagram'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_instagram'] ) ?>"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_dribbble']) && $ibid_redux['ibid_social_dribbble'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_dribbble'] ) ?>"><i class="fa fa-dribbble"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_deviantart']) && $ibid_redux['ibid_social_deviantart'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_deviantart'] ) ?>"><i class="fa fa-deviantart"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_digg']) && $ibid_redux['ibid_social_digg'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_digg'] ) ?>"><i class="fa fa-digg"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_flickr']) && $ibid_redux['ibid_social_flickr'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_flickr'] ) ?>"><i class="fa fa-flickr"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_stumbleupon']) && $ibid_redux['ibid_social_stumbleupon'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_stumbleupon'] ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_tumblr']) && $ibid_redux['ibid_social_tumblr'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_tumblr'] ) ?>"><i class="fa fa-tumblr"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_vimeo']) && $ibid_redux['ibid_social_vimeo'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_vimeo'] ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
            <?php } ?>
            </ul>
        </div>
        <?php echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'widget_title' ] ) ) {
            $widget_title = $instance[ 'widget_title' ];
        } else {
            $widget_title = esc_attr__( 'Social icons','modeltheme' );;
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e( 'Widget Title:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
        </p>
        <p><?php esc_attr_e( '* Social Network account must be set from iBid - Theme Panel.','modeltheme' ); ?></p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ?  $new_instance['widget_title']  : '';

        return $instance;
    }

}












/* ========= social_icons ===================================== */
class ibid_address_social_icons extends WP_Widget {



    function __construct() {
        parent::__construct('ibid_address_social_icons', esc_attr__('iBid - Contact + Social links','modeltheme'),array( 'description' => esc_attr__( 'iBid - Contact information + Social icons','modeltheme' ), ) );
    }



    public function widget( $args, $instance ) {
        global $ibid_redux;
        $widget_title = $instance[ 'widget_title' ];

        echo  $args['before_widget']; ?>

        <div class="sidebar-social-networks address-social-links">
            <?php if($widget_title) { ?>
               <h3 class="widget-title"><?php echo esc_attr($widget_title); ?></h3>
            <?php } ?>

            <div class="contact-details">
                <?php if($ibid_redux['ibid_contact_address']) { ?><span><i class="fa fa-map-marker"></i><?php echo esc_attr($ibid_redux['ibid_contact_address']); ?></span> <?php } ?>
                <?php if($ibid_redux['ibid_contact_email']) { ?><span><i class="fa fa-envelope"></i><?php echo esc_attr($ibid_redux['ibid_contact_email']); ?></span> <?php } ?>
                <?php if($ibid_redux['ibid_contact_phone']) { ?><span><i class="fa fa-phone"></i><?php echo esc_attr($ibid_redux['ibid_contact_phone']); ?></span> <?php } ?>
            </div>


            <ul class="social-links">
            <?php if ( isset($ibid_redux['ibid_social_fb']) && $ibid_redux['ibid_social_fb'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_fb'] ) ?>"><i class="fa fa-facebook"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_tw']) && $ibid_redux['ibid_social_tw'] != '' ) { ?>
                <li><a target="_blank" href="https://twitter.com/<?php echo esc_attr( $ibid_redux['ibid_social_tw'] ) ?>"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_youtube']) && $ibid_redux['ibid_social_youtube'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_youtube'] ) ?>"><i class="fa fa-youtube"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_pinterest']) && $ibid_redux['ibid_social_pinterest'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_pinterest'] ) ?>"><i class="fa fa-pinterest"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_linkedin']) && $ibid_redux['ibid_social_linkedin'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_linkedin'] ) ?>"><i class="fa fa-linkedin"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_skype']) && $ibid_redux['ibid_social_skype'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_skype'] ) ?>"><i class="fa fa-skype"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_instagram']) && $ibid_redux['ibid_social_instagram'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_instagram'] ) ?>"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_dribbble']) && $ibid_redux['ibid_social_dribbble'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_dribbble'] ) ?>"><i class="fa fa-dribbble"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_deviantart']) && $ibid_redux['ibid_social_deviantart'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_deviantart'] ) ?>"><i class="fa fa-deviantart"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_digg']) && $ibid_redux['ibid_social_digg'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_digg'] ) ?>"><i class="fa fa-digg"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_flickr']) && $ibid_redux['ibid_social_flickr'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_flickr'] ) ?>"><i class="fa fa-flickr"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_stumbleupon']) && $ibid_redux['ibid_social_stumbleupon'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_stumbleupon'] ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_tumblr']) && $ibid_redux['ibid_social_tumblr'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_tumblr'] ) ?>"><i class="fa fa-tumblr"></i></a></li>
            <?php } ?>
            <?php if ( isset($ibid_redux['ibid_social_vimeo']) && $ibid_redux['ibid_social_vimeo'] != '' ) { ?>
                <li><a target="_blank" href="<?php echo esc_attr( $ibid_redux['ibid_social_vimeo'] ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
            <?php } ?>
            </ul>
        </div>
        <?php echo  $args['after_widget'];
    }





    public function form( $instance ) {

        # Widget Title
        if ( isset( $instance[ 'widget_title' ] ) ) {
            $widget_title = $instance[ 'widget_title' ];
        } else {
            $widget_title = esc_attr__( 'Social icons','modeltheme' );;
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e( 'Widget Title:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
        </p>
        <p><?php esc_attr_e( '* Social Network account must be set from iBid - Theme Panel.','modeltheme' ); ?></p>
        <?php 
    }




    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ?  $new_instance['widget_title']  : '';

        return $instance;
    }
}



/*ibid contact information*/

class ibid_contact_information extends WP_Widget {



    function __construct() {
        parent::__construct('ibid_contact_information', esc_attr__('iBid - Contact','modeltheme'),array( 'description' => esc_attr__( 'iBid - Contact information','modeltheme' ), ) );
    }




    public function widget( $args, $instance ) {
        global $ibid_redux;
        $widget_title = $instance[ 'widget_title' ];

        echo  $args['before_widget']; ?>

        <div class="sidebar-social-networks address-social-links">
            <?php if($widget_title) { ?>
               <h3 class="widget-title"><?php echo esc_attr($widget_title); ?></h3>
            <?php } ?>

            <div class="contact-details">
                <?php if($ibid_redux['ibid_contact_address']) { ?><span><i class="fa fa-map-marker"></i><?php echo esc_attr($ibid_redux['ibid_contact_address']); ?></span> <?php } ?>
                <?php if($ibid_redux['ibid_contact_email']) { ?><span><i class="fa fa-envelope"></i><?php echo esc_attr($ibid_redux['ibid_contact_email']); ?></span> <?php } ?>
                <?php if($ibid_redux['ibid_contact_phone']) { ?><span><i class="fa fa-phone"></i><?php echo esc_attr($ibid_redux['ibid_contact_phone']); ?></span> <?php } ?>
            </div>

        </div>
        <?php echo  $args['after_widget'];
    }





    public function form( $instance ) {

        # Widget Title
        if ( isset( $instance[ 'widget_title' ] ) ) {
            $widget_title = $instance[ 'widget_title' ];
        } else {
            $widget_title = esc_attr__( 'Contact information','modeltheme' );;
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e( 'Widget Title:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
        </p>
        <p><?php esc_attr_e( 'Contact information must be set from iBid - Theme Panel.','modeltheme' ); ?></p>
        <?php 
    }




    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ?  $new_instance['widget_title']  : '';

        return $instance;
    }
}




/* ========= ibid_Recent_Posts_Widget ===================================== */
class ibid_recent_entries_with_thumbnail extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('ibid_recent_entries_with_thumbnail', esc_attr__('iBid - Recent Posts with thumbnails','modeltheme'),array( 'description' => esc_attr__( 'iBid - Recent Posts with thumbnails','modeltheme' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $recent_posts_title = $instance[ 'recent_posts_title' ];
        $recent_posts_number = $instance[ 'recent_posts_number' ];

        echo  $args['before_widget'];

        $args_recenposts = array(
                'posts_per_page'   => $recent_posts_number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish' 
                );

        $recentposts = get_posts($args_recenposts);
        $myContent  = "";
        $myContent .= '<h3 class="widget-title">'.$recent_posts_title.'</h3>';
        $myContent .= '<ul class="widget_recent_entries_with_thumbnail_ul">';

        foreach ($recentposts as $post) {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_post_widget_pic70x70' );

            $myContent .= '<li class="row">';
            if($thumbnail_src) {
                $myContent .= '<div class="vc_col-md-3 post-thumbnail relative">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                         $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                    $myContent .= '</a>';
                $myContent .= '</div>';
            }
                $myContent .= '<div class="vc_col-md-9 post-details">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">'. $post->post_title.'</a>';
                    $myContent .= '<span class="post-date">'.get_the_date( "F j, Y" ).'</span>';
                $myContent .= '</div>';
            $myContent .= '</li>';
        }
        $myContent .= '</ul>';

        echo  $myContent;
        echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'recent_posts_title' ] ) ) {
            $recent_posts_title = $instance[ 'recent_posts_title' ];
        } else {
            $recent_posts_title = esc_attr__( 'Recent posts','modeltheme' );;
        }

        # Number of posts
        if ( isset( $instance[ 'recent_posts_number' ] ) ) {
            $recent_posts_number = $instance[ 'recent_posts_number' ];
        } else {
            $recent_posts_number = esc_attr__( '5','modeltheme' );;
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>"><?php esc_attr_e( 'Widget Title:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>"><?php esc_attr_e( 'Number of posts:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_number ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['recent_posts_title'] = ( ! empty( $new_instance['recent_posts_title'] ) ) ?  $new_instance['recent_posts_title']  : '';
        $instance['recent_posts_number'] = ( ! empty( $new_instance['recent_posts_number'] ) ) ? strip_tags( $new_instance['recent_posts_number'] ) : '';
        return $instance;
    }

} 






/* ========= post_thumbnails_slider ===================================== */
class ibid_post_thumbnails_slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('ibid_post_thumbnails_slider', esc_attr__('iBid - Post thumbnails slider','modeltheme'),array( 'description' => esc_attr__( 'iBid - Post thumbnails slider','modeltheme' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $recent_posts_title = $instance[ 'recent_posts_title' ];
        $recent_posts_number = $instance[ 'recent_posts_number' ];

        echo  $args['before_widget'];

        $args_recenposts = array(
                'posts_per_page'   => $recent_posts_number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish' 
                );

        $recentposts = get_posts($args_recenposts);
        $myContent  = "";
        $myContent .= '<h3 class="widget-title">'.$recent_posts_title.'</h3>';
        $myContent .= '<div class="slider_holder relative">';
            $myContent .= '<div class="slider_navigation absolute">';
                $myContent .= '<a class="btn prev pull-left"><i class="fa fa-angle-left"></i></a>';
                $myContent .= '<a class="btn next pull-right"><i class="fa fa-angle-right"></i></a>';
            $myContent .= '</div>';
            $myContent .= '<div class="post_thumbnails_slider owl-carousel owl-theme">';

            foreach ($recentposts as $post) {
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'ibid_post_pic700x450' );
                if($thumbnail_src) { 
                $myContent .= '<div class="item">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                        $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                        
                    $myContent .= '</a>';
                $myContent .= '</div>';
                }
            }
            $myContent .= '</div>';
        $myContent .= '</div>';

        echo  $myContent;
        echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'recent_posts_title' ] ) ) {
            $recent_posts_title = $instance[ 'recent_posts_title' ];
        } else {
            $recent_posts_title = esc_attr__( 'Post thumbnails slider','modeltheme' );;
        }

        # Number of posts
        if ( isset( $instance[ 'recent_posts_number' ] ) ) {
            $recent_posts_number = $instance[ 'recent_posts_number' ];
        } else {
            $recent_posts_number = esc_attr__( '5','modeltheme' );;
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>"><?php esc_attr_e( 'Widget Title:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>"><?php esc_attr_e( 'Number of posts:','modeltheme' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_number ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['recent_posts_title'] = ( ! empty( $new_instance['recent_posts_title'] ) ) ?  $new_instance['recent_posts_title']  : '';
        $instance['recent_posts_number'] = ( ! empty( $new_instance['recent_posts_number'] ) ) ? strip_tags( $new_instance['recent_posts_number'] ) : '';
        return $instance;
    }

} 






// Register Widgets
function ibid_register_widgets() {
    register_widget( 'ibid_address_social_icons' );
    register_widget( 'ibid_social_icons' );
    register_widget( 'ibid_recent_entries_with_thumbnail' );
    register_widget( 'ibid_post_thumbnails_slider' );
    register_widget( 'ibid_contact_information' );
}
add_action( 'widgets_init', 'ibid_register_widgets' );
?>