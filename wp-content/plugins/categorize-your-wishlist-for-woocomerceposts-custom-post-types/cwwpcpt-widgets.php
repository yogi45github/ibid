<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
function CWWPCPT_widget_init() {
    function CWWPCPT_widget_view($cwwpcpt_args) {
        extract($cwwpcpt_args);
        $cwwpcpt_options = get_option('cwwpcpt_options');
        if (isset($cwwpcpt_options['cwwpcpt_widget_limit'])) {
            $cwwpcpt_limit = $cwwpcpt_options['cwwpcpt_widget_limit'];
        }
        $cwwpcpt_title = empty($cwwpcpt_options['cwwpcpt_widget_title']) ? 'My Favourited Posts' : $cwwpcpt_options['cwwpcpt_widget_title'];
        if(is_user_logged_in())
        {
            if(isset($cwwpcpt_options['cwwpcpt_widget_limit']) && $cwwpcpt_limit != 0)
            {
                echo "<div class='cwwpcpt-posts-widget'>";
                echo "<h4>" . $cwwpcpt_title . "</h4>";
                CWWPCPT_list_most_favourited($cwwpcpt_limit);
                echo "</div>";
            }
        }
    }

    function CWWPCPT_widget_control() {
        $cwwpcpt_options = get_option('cwwpcpt_options');
        if (isset($_POST["cwwpcpt-widget-submit"])):
            $cwwpcpt_options['cwwpcpt_widget_title'] = sanitize_text_field($_POST['cwwpcpt-title']);
            $cwwpcpt_options['cwwpcpt_widget_limit'] = intval($_POST['cwwpcpt-limit']);
            update_option("cwwpcpt_options", $cwwpcpt_options);
        endif;
        $cwwpcpt_title = $cwwpcpt_options['cwwpcpt_widget_title'];
        $cwwpcpt_limit = $cwwpcpt_options['cwwpcpt_widget_limit'];
    ?>
        <p>
            <label for="cwwpcpt-title">
                <?php _e('Title:'); ?> <input type="text" value="<?php echo $cwwpcpt_title; ?>" class="widefat" id="cwwpcpt-title" name="cwwpcpt-title" />
            </label>
        </p>
        <p>
            <label for="cwwpcpt-limit">
                <?php _e('Number of posts to show:'); ?> <input type="text" value="<?php echo $cwwpcpt_limit; ?>" style="width: 28px; text-align:center;" id="cwwpcpt-limit" name="cwwpcpt-limit" />
            </label>
        </p>
        
        <p>
            You must enable statistics from favourite posts <a href="plugins.php?page=cwwpcpt-favourite-posts-categories" title="favourite Posts Configuration">configuration page</a>.
        </p>
        
        <input type="hidden" name="cwwpcpt-widget-submit" value="1" />
    <?php
    }
    wp_register_sidebar_widget('cwwpcpt-most_favourited_posts', 'User Favourited Posts', 'CWWPCPT_widget_view');
    wp_register_widget_control('cwwpcpt-most_favourited_posts', 'User favourited Posts', 'CWWPCPT_widget_control' );

    //*** users favourites widget ***//
    function CWWPCPT_users_favourites_widget_view($cwwpcpt_args) {
        extract($cwwpcpt_args);
        $cwwpcpt_options = get_option('cwwpcpt_options');
        if (isset($cwwpcpt_options['cwwpcpt_uf_widget_limit'])) {
            $cwwpcpt_limit = $cwwpcpt_options['cwwpcpt_uf_widget_limit'];
        }
        $cwwpcpt_title = empty($cwwpcpt_options['cwwpcpt_uf_widget_title']) ? 'My Wishlists' : $cwwpcpt_options['cwwpcpt_uf_widget_title'];
        if(is_user_logged_in())
        {
            if(isset($cwwpcpt_options['cwwpcpt_uf_widget_limit']) && $cwwpcpt_limit != 0)
            {
                echo "<div class='cwwpcpt-posts-widget'>";
                echo "<h4>" . $cwwpcpt_title . "</h4>";
                CWWPCPT_list_most_favourited_categories($cwwpcpt_limit);
                echo "</div>";
            }
        }
    }

    function CWWPCPT_users_favourites_widget_control() {
        $cwwpcpt_options = get_option('cwwpcpt_options');
        if (isset($_POST["cwwpcpt-uf-widget-submit"])):
            $cwwpcpt_options['cwwpcpt_uf_widget_title'] = sanitize_text_field($_POST['cwwpcpt-uf-title']);
            $cwwpcpt_options['cwwpcpt_uf_widget_limit'] = intval($_POST['cwwpcpt-uf-limit']);
            update_option("cwwpcpt_options", $cwwpcpt_options);
        endif;
        $cwwpcpt_uf_title = $cwwpcpt_options['cwwpcpt_uf_widget_title'];
        $cwwpcpt_uf_limit = $cwwpcpt_options['cwwpcpt_uf_widget_limit'];
    ?>
        <p>
            <label for="cwwpcpt-uf-title">
                <?php _e('Title:'); ?> <input type="text" value="<?php echo $cwwpcpt_uf_title; ?>" class="widefat" id="cwwpcpt-uf-title" name="cwwpcpt-uf-title" />
            </label>
        </p>
        <p>
            <label for="cwwpcpt-uf-limit">
                <?php _e('Number of wishlists to show:'); ?> <input type="text" value="<?php echo $cwwpcpt_uf_limit; ?>" style="width: 28px; text-align:center;" id="cwwpcpt-uf-limit" name="cwwpcpt-uf-limit" />
            </label>
        </p>

        <input type="hidden" name="cwwpcpt-uf-widget-submit" value="1" />
    <?php
    }
    wp_register_sidebar_widget('cwwpcpt-users_favourites','User\'s Wishlists', 'CWWPCPT_users_favourites_widget_view');
    wp_register_widget_control('cwwpcpt-users_favourites','User\'s Wishlists', 'CWWPCPT_users_favourites_widget_control' );
}
add_action('widgets_init', 'CWWPCPT_widget_init');
