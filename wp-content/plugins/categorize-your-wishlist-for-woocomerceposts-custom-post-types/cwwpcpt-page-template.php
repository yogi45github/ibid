<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
    $cwwpcpt_before = "";
    $cwwpcpt_options = get_option('cwwpcpt_options');
    if($cwwpcpt_options['cwwpcpt_template_view'] == 'grid_view')
    {
        echo "<div class='cwwpcpt-span'>";
        if (!empty($cwwpcpt_user_info)) {    
                $cwwpcpt_before = "$cwwpcpt_user_name's Favourite Posts.";
        }
        else{
                $cwwpcpt_before = $cwwpcpt_options['cwwpcpt_alert_message'];
        }

        if ($cwwpcpt_before):
            echo '<div class="cwwpcpt-page-before">'.$cwwpcpt_before.'</div>';
        endif;

        if(isset($cwwpcpt_posts_ids) && !empty($cwwpcpt_posts_ids))
        {
                global $wpdb;
                $table_name = $wpdb->prefix."favourite_posts";
                $cwwpcpt_user_id = get_current_user_id();
                $cwwpcpt_posts_ids = array(array_reverse($cwwpcpt_posts_ids)); 
                $cwwpcpt_post_per_page = $cwwpcpt_options['cwwpcpt_post_per_page'];
                $cwwpcpt_page = intval(get_query_var('paged'));
                $posts_in_db = get_option('cwwpcpt_multi_posts_options');
                if(empty($posts_in_db ) || $posts_in_db == '')
                {
                  $posts_in_db = array();
                  $posts_in_db[] = "post";
                }
                else
                {
                  $len = count($posts_in_db);
                  $posts_in_db[$len] = "post";
                }
                $new_post = array();
                foreach($cwwpcpt_posts_ids[0] as $row)
                {
                    $new_post[] = $row->post_id;
                    $cwwpcpt_wish_ids[] = $wpdb->get_results( "SELECT wishlist_id,wishlist_name FROM $table_name WHERE post_id = $row->post_id AND user_id = $cwwpcpt_user_id");
                }
                $cwwpcpt_user_wishlists = array_map("unserialize", array_unique(array_map("serialize", $cwwpcpt_wish_ids))); 
                foreach ($cwwpcpt_user_wishlists as $cwwpcpt_user_wishlist) 
                {
                    echo "<div class='cwwpcpt-row cwwpcpt-gridview'><h2><a href='#'>".$cwwpcpt_user_wishlist[0]->wishlist_name."</a></h2>";
                    $cwwpcpt_wishlist_id = $cwwpcpt_user_wishlist[0]->wishlist_id;
                    $cwwpcpt_user_wishlist_posts = $wpdb->get_results( "SELECT post_id FROM $table_name WHERE user_id = $cwwpcpt_user_id AND wishlist_id = $cwwpcpt_wishlist_id");
                    $new_wishlist_id = array();
                    foreach ($cwwpcpt_user_wishlist_posts as $cwwpcpt_user_wishlist_post) 
                    {
                        $new_wishlist_id[] = $cwwpcpt_user_wishlist_post->post_id;
                    }   
                    $cwwpcpt_query = array('post_type' => $posts_in_db,'post__in' => $new_wishlist_id, 'posts_per_page'=> $cwwpcpt_post_per_page, 'orderby' => 'post__in', 'paged' => $cwwpcpt_page);
                    $cwwpcpt_query_result = query_posts($cwwpcpt_query);
                        $i = 0; 
                        echo '<div class="cwwpcpt-masonry-layout">';
                      
                    while ( have_posts() ) : the_post();
                    $thecontent = get_the_content(); /* or you can use get_the_title() */
                    $getlength = strlen($thecontent);
                    $thelength = 100;
                    $content_trim = substr($thecontent, 0, $thelength);

                        echo "<div class='cwwpcpt-masonry-layout__panel'><div class='cwwpcpt-masonry-layout__panel-content'><div class='cwwpcpt-gridview-img'>".get_the_post_thumbnail($post_id, 'medium')."</div><div class='cwwpcpt-gridview-title'><a href='".get_permalink()."' title='". get_the_title() ."'>" . get_the_title() . "</a><div class='cwwpcpt-gridview-content'>$content_trim</div></div>";
                        $cwwpcpt_current_post_type = get_post_type( $post->ID );
                        if($cwwpcpt_current_post_type == 'product')
                        {
                            $add_to_cart = do_shortcode('[add_to_cart_url id="'.$post->ID.'"]'); 
                            echo '<a href="'. $add_to_cart .'" class="cwwpcpt-buy-now" style="background-color:'.$cwwpcpt_options['cwwpcpt_buynow_btn_back_color'].';color:'.$cwwpcpt_options['cwwpcpt_buynow_btn_text_back_color'].';">Buy Now</a>';
                        }
                        CWWPCPT_remove_favourite_link(get_the_ID());
                        echo "</div></div>";
                    
                    endwhile; wp_reset_query();
                     echo '</div>';
                    
                    echo '<div>'.CWWPCPT_clear_all_list($cwwpcpt_wishlist_id).'</div></div>';
                }  
                 
                echo '<div class="navigation">';
                    if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                    <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
                    <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
                    <?php }
                echo '</div>';
                   
        } 
        else 
        {
            echo "<ul><li>";
            echo $cwwpcpt_options['cwwpcpt_favourites_empty'];
            echo "</li></ul>";
        }
        echo "</div>";
    }
    else if($cwwpcpt_options['cwwpcpt_template_view'] == 'post_view')
    {
        echo "<div class='cwwpcpt-span'>";
        if (!empty($cwwpcpt_user_info)) {    
                $cwwpcpt_before = "$cwwpcpt_user_name's Favourite Posts.";
        }
        else{
                $cwwpcpt_before = $cwwpcpt_options['cwwpcpt_alert_message'];
        }

        if ($cwwpcpt_before):
            echo '<div class="cwwpcpt-page-before">'.$cwwpcpt_before.'</div>';
        endif;

        if(isset($cwwpcpt_posts_ids) && !empty($cwwpcpt_posts_ids))
        {
                global $wpdb;
                $table_name = $wpdb->prefix."favourite_posts";
                $cwwpcpt_user_id = get_current_user_id();
                $cwwpcpt_posts_ids = array(array_reverse($cwwpcpt_posts_ids)); 
                $cwwpcpt_post_per_page = $cwwpcpt_options['cwwpcpt_post_per_page'];
                $cwwpcpt_page = intval(get_query_var('paged'));
                $posts_in_db = get_option('cwwpcpt_multi_posts_options');
                if(empty($posts_in_db ) || $posts_in_db == '')
                {
                  $posts_in_db = array();
                  $posts_in_db[] = "post";
                }
                else
                {
                  $len = count($posts_in_db);
                  $posts_in_db[$len] = "post";
                }
                $new_post = array();
                foreach($cwwpcpt_posts_ids[0] as $row)
                {
                    $new_post[] = $row->post_id;
                    $cwwpcpt_wish_ids[] = $wpdb->get_results( "SELECT wishlist_id,wishlist_name FROM $table_name WHERE post_id = $row->post_id AND user_id = $cwwpcpt_user_id");
                }
                $cwwpcpt_user_wishlists = array_map("unserialize", array_unique(array_map("serialize", $cwwpcpt_wish_ids))); 
                foreach ($cwwpcpt_user_wishlists as $cwwpcpt_user_wishlist) 
                {
                    echo "<div class='cwwpcpt-row'><div class='cwwpcpt-col-12'><h2><a href='#'>".$cwwpcpt_user_wishlist[0]->wishlist_name."</a></h2>";
                    $cwwpcpt_wishlist_id = $cwwpcpt_user_wishlist[0]->wishlist_id;
                    $cwwpcpt_user_wishlist_posts = $wpdb->get_results( "SELECT post_id FROM $table_name WHERE user_id = $cwwpcpt_user_id AND wishlist_id = $cwwpcpt_wishlist_id");
                    $new_wishlist_id = array();
                    foreach ($cwwpcpt_user_wishlist_posts as $cwwpcpt_user_wishlist_post) 
                    {
                        $new_wishlist_id[] = $cwwpcpt_user_wishlist_post->post_id;
                    }   
                    $cwwpcpt_query = array('post_type' => $posts_in_db,'post__in' => $new_wishlist_id, 'posts_per_page'=> $cwwpcpt_post_per_page, 'orderby' => 'post__in', 'paged' => $cwwpcpt_page);
                    $cwwpcpt_query_result = query_posts($cwwpcpt_query);
                    
                    while ( have_posts() ) : the_post();
                    $thecontent = get_the_content(); /* or you can use get_the_title() */
                    $getlength = strlen($thecontent);
                    $thelength = 500;
                    $content_trim = substr($thecontent, 0, $thelength);
                        echo "<div class='cwwpcpt-postview'>";
                        echo "<div class='cwwpcpt-postview-info'><div class='cwwpcpt-postviewimg'>".get_the_post_thumbnail($post_id, 'thumbnail')."</div><div class='cwwpcpt-postviewtitle'><a href='".get_permalink()."' title='". get_the_title() ."'>" . get_the_title() . "</a><div class='cwwpcpt-postview-content'>$content_trim</div></div></div>";
                        CWWPCPT_remove_favourite_link(get_the_ID());
                        $cwwpcpt_current_post_type = get_post_type( $post->ID );
                        if($cwwpcpt_current_post_type == 'product')
                        {
                            $add_to_cart = do_shortcode('[add_to_cart_url id="'.$post->ID.'"]'); 
                            echo '<a href="'. $add_to_cart .'" class="cwwpcpt-buy-now" style="background-color:'.$cwwpcpt_options['cwwpcpt_buynow_btn_back_color'].';color:'.$cwwpcpt_options['cwwpcpt_buynow_btn_text_back_color'].';">Buy Now</a>';
                        }
                         echo "</div>";
                         
                    endwhile; wp_reset_query();
                   
                    echo '<p>'.CWWPCPT_clear_all_list($cwwpcpt_wishlist_id).'</p></div></div>';
                }  
                 
                echo '<div class="navigation">';
                    if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                    <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
                    <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
                    <?php }
                echo '</div>';
                   
        } 
        else 
        {
            echo "<ul><li>";
            echo $cwwpcpt_options['cwwpcpt_favourites_empty'];
            echo "</li></ul>";
        }
        echo "</div>";
    }
    else
    {
        echo "<div class='cwwpcpt-span'>";
        if (!empty($cwwpcpt_user_info)) {    
                $cwwpcpt_before = "$cwwpcpt_user_name's Favourite Posts.";
        }
        else{
                $cwwpcpt_before = $cwwpcpt_options['cwwpcpt_alert_message'];
        }

        if ($cwwpcpt_before):
            echo '<div class="cwwpcpt-page-before">'.$cwwpcpt_before.'</div>';
        endif;

        if(isset($cwwpcpt_posts_ids) && !empty($cwwpcpt_posts_ids))
        {
                global $wpdb;
                $table_name = $wpdb->prefix."favourite_posts";
                $cwwpcpt_user_id = get_current_user_id();
        		$cwwpcpt_posts_ids = array(array_reverse($cwwpcpt_posts_ids)); 
                $cwwpcpt_post_per_page = $cwwpcpt_options['cwwpcpt_post_per_page'];
                $cwwpcpt_page = intval(get_query_var('paged'));
                $posts_in_db = get_option('cwwpcpt_multi_posts_options');
                if(empty($posts_in_db ) || $posts_in_db == '')
                {
                  $posts_in_db = array();
                  $posts_in_db[] = "post";
                }
                else
                {
                  $len = count($posts_in_db);
                  $posts_in_db[$len] = "post";
                }
                $new_post = array();
                foreach($cwwpcpt_posts_ids[0] as $row)
                {
                    $new_post[] = $row->post_id;
                    $cwwpcpt_wish_ids[] = $wpdb->get_results( "SELECT wishlist_id,wishlist_name FROM $table_name WHERE post_id = $row->post_id AND user_id = $cwwpcpt_user_id");
                }
                $cwwpcpt_user_wishlists = array_map("unserialize", array_unique(array_map("serialize", $cwwpcpt_wish_ids))); 
                foreach ($cwwpcpt_user_wishlists as $cwwpcpt_user_wishlist) 
                {
                    echo "<ul class='cwwpcpt-listview'><li><a href='#'>".$cwwpcpt_user_wishlist[0]->wishlist_name."</a>";
                    $cwwpcpt_wishlist_id = $cwwpcpt_user_wishlist[0]->wishlist_id;
                    $cwwpcpt_user_wishlist_posts = $wpdb->get_results( "SELECT post_id FROM $table_name WHERE user_id = $cwwpcpt_user_id AND wishlist_id = $cwwpcpt_wishlist_id");
                    $new_wishlist_id = array();
                    foreach ($cwwpcpt_user_wishlist_posts as $cwwpcpt_user_wishlist_post) 
                    {
                        $new_wishlist_id[] = $cwwpcpt_user_wishlist_post->post_id;
                    }   
                    $cwwpcpt_query = array('post_type' => $posts_in_db,'post__in' => $new_wishlist_id, 'posts_per_page'=> $cwwpcpt_post_per_page, 'orderby' => 'post__in', 'paged' => $cwwpcpt_page);
                    $cwwpcpt_query_result = query_posts($cwwpcpt_query);
                        echo "<ul>";
                    while ( have_posts() ) : the_post();
                        echo "<li><a href='".get_permalink()."' title='". get_the_title() ."'>" . get_the_title() . "</a> ";
                        CWWPCPT_remove_favourite_link(get_the_ID());
                        $cwwpcpt_current_post_type = get_post_type( $post->ID );
                        if($cwwpcpt_current_post_type == 'product')
                        {
                            $add_to_cart = do_shortcode('[add_to_cart_url id="'.$post->ID.'"]'); 
                            echo '<a href="'. $add_to_cart .'">Buy Now</a>';
                        }
                        echo "</li>";
                    endwhile; wp_reset_query();
                    echo "</ul></li></ul>";
                    echo '<p>'.CWWPCPT_clear_all_list($cwwpcpt_wishlist_id).'</p>';
                }  
                 
                echo '<div class="navigation">';
                    if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                    <div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ) ?></div>
                    <div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ) ?></div>
                    <?php }
                echo '</div>';
                   
        } 
        else 
        {
            echo "<ul><li>";
            echo $cwwpcpt_options['cwwpcpt_favourites_empty'];
            echo "</li></ul>";
        }
        echo "</div>";
    }
