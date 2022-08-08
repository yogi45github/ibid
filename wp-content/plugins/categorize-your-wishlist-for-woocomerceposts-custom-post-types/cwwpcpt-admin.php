<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$cwwpcpt_options = get_option('cwwpcpt_options');
$cwwpcpt_multi_posts_options = get_option('cwwpcpt_multi_posts_options');
if ( isset($_POST['submit'])) {
    $cwwpcpt_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($cwwpcpt_nonce, 'cwwpcpt_action' ) ) die( 'Failed security check' );
	if ( function_exists('current_user_can') && !current_user_can('manage_options') )
		die(__('Cheatin&#8217; uh?'));

    if (isset($_POST['cwwpcpt_show_remove_link']) && $_POST['cwwpcpt_show_remove_link'] == 'cwwpcpt_show_remove_link')
        $_POST['cwwpcpt_added'] = 'show remove link';

    if (isset($_POST['cwwpcpt_show_add_link']) && $_POST['cwwpcpt_show_add_link'] == 'cwwpcpt_show_add_link')
        $_POST['cwwpcpt_removed'] = 'show add link';
    $cwwpcpt_options['cwwpcpt_favourite_btn'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_border'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_border']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_text'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_text']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_padding_top'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_padding_top']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_padding_right'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_padding_right']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_padding_bottom'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_padding_bottom']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_padding_left'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_padding_left']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_margin_top'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_margin_top']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_margin_right'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_margin_right']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_margin_bottom'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_margin_bottom']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_margin_left'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_margin_left']);
    $cwwpcpt_options['cwwpcpt_alert_message'] = sanitize_text_field($_POST['cwwpcpt_alert_message']);
    $cwwpcpt_options['cwwpcpt_favourite_btn_text_color'] = sanitize_text_field($_POST['cwwpcpt_favourite_btn_text_color']);
	$cwwpcpt_options['cwwpcpt_remove_favourite'] = sanitize_text_field($_POST['cwwpcpt_remove_favourite']);
	$cwwpcpt_options['cwwpcpt_clear'] = sanitize_text_field($_POST['cwwpcpt_clear']);
	$cwwpcpt_options['cwwpcpt_favourites_empty'] = sanitize_text_field($_POST['cwwpcpt_favourites_empty']);
	$cwwpcpt_options['cwwpcpt_rem'] = sanitize_text_field($_POST['cwwpcpt_rem']);
	$cwwpcpt_options['cwwpcpt_autoshow'] = sanitize_text_field($_POST['cwwpcpt_autoshow']);
	$cwwpcpt_options['cwwpcpt_post_per_page'] = intval($_POST['cwwpcpt_post_per_page']);
    $cwwpcpt_options['cwwpcpt_template_view'] = sanitize_text_field($_POST['cwwpcpt_template_view']);
    $cwwpcpt_options['cwwpcpt_custom_before_image'] = sanitize_text_field($_POST['cwwpcpt_custom_before_image']);
    $cwwpcpt_options['cwwpcpt_buynow_btn_back_color'] = sanitize_text_field($_POST['cwwpcpt_buynow_btn_back_color']);
    $cwwpcpt_options['cwwpcpt_buynow_btn_text_back_color'] = sanitize_text_field($_POST['cwwpcpt_buynow_btn_text_back_color']);

    $cwwpcpt_multi_posts_options = '';
    if (isset($_POST['cwwpcpt_multi_posts_options']))
        foreach ($_POST['cwwpcpt_multi_posts_options'] as $cwwpcpt_key) 
        {
            $cwwpcpt_single_post_option[] = sanitize_text_field($cwwpcpt_key);
        }
        $cwwpcpt_multi_posts_options = $cwwpcpt_single_post_option;

    update_option('cwwpcpt_options', $cwwpcpt_options);
    update_option('cwwpcpt_multi_posts_options', $cwwpcpt_multi_posts_options);
}
$cwwpcpt_message = "";
if ( isset($_GET['cwwpcptaction'] ) ) {
	if ($_GET['cwwpcptaction'] == 'cwwpcpt-reset-statistics') {
		global $wpdb;
		$cwwpcpt_favourite_posts_table = $wpdb->prefix . "favourite_posts";
        $cwwpcpt_favourite_categories_table = $wpdb->prefix . "favourite_categories";
		$cwwpcpt_posts_query = "DELETE * FROM $cwwpcpt_favourite_posts_table";
        $cwwpcpt_categories_query = "DELETE * FROM $cwwpcpt_favourite_categories_table";

		$cwwpcpt_message = '<div class="updated below-h2" id="cwwpcpt_message"><p>';
		if ($wpdb->query($cwwpcpt_posts_query) && $wpdb->query($cwwpcpt_categories_query)) {
			$cwwpcpt_message .= "All statistic data about wp favourite posts plugin have been <strong>deleted</strong>.";
		} else {
			$cwwpcpt_message .= "Something gone <strong>wrong</strong>. Data couldn't delete. Maybe thre isn't any data to delete?";
		}	
		$cwwpcpt_message .= '</p></div>';
	}
}
?>
<?php if ( !empty($_POST ) ) : ?>
    <div id="cwwpcpt_message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
    <h2><?php _e('Favourite Posts by Categories', 'cwwpcpt-favourite-posts'); ?></h2>
    <div class="tabs">
        <ul class="tab-links">
                <li class="active"><a href="#tab1">General Settings</a></li>
                <li><a href="#tab2">Label Settings</a></li>
                <li><a href="#tab3">Custom Posts Settings</a></li>
                <li><a href="#tab4">Most Favourite Posts</a></li>
                <li><a href="#tab5">Template Settings</a></li>
                <li><a href="#tab6">Help</a></li>
        </ul>
        <div class="metabox-holder" id="poststuff">
            <div class="meta-box-sortables">
                <script>
                jQuery(document).ready(function($) {
                	$('.postbox').children('h3, .handlediv').click(function(){ $(this).siblings('.inside').toggle();});
                	$('#cwwpcpt-reset-statistics').click(function(){
                		return confirm('All statistic data will be deleted, are you sure ?');
                		});
                });
                </script>
                <?php echo $cwwpcpt_message; ?>
                <div class="tab-content">
                    <form action="" method="post">
                    <?php wp_nonce_field('cwwpcpt_action'); ?>
                        <div id="tab1" class="tab active">
                            <div class="postbox">
                                <div title="<?php _e("Click to open/close", "cwwpcpt-favourite-posts"); ?>" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr("Favourites Options", "cwwpcpt-favourite-posts"); ?></span></h3>
                                <div class="inside" style="display: block;">

                                    <table class="form-table">
                                        <tr>
                                            <th><?php echo esc_attr("Auto show favourite button", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <select name="cwwpcpt_autoshow">
                                                    <option value="after" <?php if ($cwwpcpt_options['cwwpcpt_autoshow'] == 'after') echo "selected='selected'" ?>>After post</option>
                                                    <option value="before" <?php if ($cwwpcpt_options['cwwpcpt_autoshow'] == 'before') echo "selected='selected'" ?>>Before post</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Color", "cwwpcpt-favourite-posts") ?></th>
                                            <td>                                                
                                                <input name="cwwpcpt_favourite_btn" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn']); ?>" class="cwwpcpt_favourite_btn" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Border", "cwwpcpt-favourite-posts") ?></th>
                                            <td>                                                
                                                <input name="cwwpcpt_favourite_btn_border" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_border']); ?>" class="cwwpcpt_favourite_btn_border" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Text", "cwwpcpt-favourite-posts") ?></th>
                                            <td>                                                
                                                <input name="cwwpcpt_favourite_btn_text" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_text']); ?>" class="cwwpcpt_favourite_btn_text" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Padding", "cwwpcpt-favourite-posts") ?></th>                                         
                                                <td class="btn-padding">                                                
  													<label>Padding Top :</label><input name="cwwpcpt_favourite_btn_padding_top" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_padding_top']); ?>" class="cwwpcpt_favourite_btn_padding_top" type="number">
	                                                <label>Padding Right :</label><input name="cwwpcpt_favourite_btn_padding_right" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_padding_right']); ?>" class="cwwpcpt_favourite_btn_padding_right" type="number">
	                                                <label>Padding Bottom :</label><input name="cwwpcpt_favourite_btn_padding_bottom" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_padding_bottom']); ?>" class="cwwpcpt_favourite_btn_padding_bottom" type="number">
	                                                <label>Padding Left :</label><input name="cwwpcpt_favourite_btn_padding_left" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_padding_left']); ?>" class="cwwpcpt_favourite_btn_padding_left" type="number">
                                            	</td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Text Color", "cwwpcpt-favourite-posts") ?></th>
                                            <td>                                                
                                                <input name="cwwpcpt_favourite_btn_text_color" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_text_color']); ?>" class="cwwpcpt_favourite_btn_text_color" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite Button Margin", "cwwpcpt-favourite-posts") ?></th>                                         
                                                <td class="btn-padding">                                                
  													<label>Margin Top :</label><input name="cwwpcpt_favourite_btn_margin_top" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_margin_top']); ?>" class="cwwpcpt_favourite_btn_margin_top" type="number">
	                                                <label>Margin Right :</label><input name="cwwpcpt_favourite_btn_margin_right" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_margin_right']); ?>" class="cwwpcpt_favourite_btn_margin_right" type="number">
	                                                <label>Margin Bottom :</label><input name="cwwpcpt_favourite_btn_margin_bottom" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_margin_bottom']); ?>" class="cwwpcpt_favourite_btn_margin_bottom" type="number">
	                                                <label>Margin Left :</label><input name="cwwpcpt_favourite_btn_margin_left" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourite_btn_margin_left']); ?>" class="cwwpcpt_favourite_btn_margin_left" type="number">
                                            	</td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Favourite post per page", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <input type="text" name="cwwpcpt_post_per_page" size="2" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_post_per_page']); ?>" /> * This only works with default favourite post list page (cwwpcpt-page-template.php) (Add this shortcode -> <b>[cwwpcpt-favourite-posts-list]</b> to display favourite posts list to page).
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Login Alert Message", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <input type="text" name="cwwpcpt_alert_message" size="2" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_alert_message']); ?>" class="cwwpcpt_alert_message" />
                                            </td>
                                        </tr>

                                        <tr><td></td>
                                            <td>
                                                <div class="submitbox">
                                                    <div id="delete-action">
                                                    <a href="?page=cwwpcpt-favourite-posts-categories&amp;cwwpcptaction=cwwpcpt-reset-statistics" id="cwwpcpt-reset-statistics" class="submitdelete deletion">Click Here Reset Statistic Data</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                <p><a href="widgets.php" title="Go to widgets">"Most Favourited Posts" widget settings</a>.</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td>
                                                <div class="push-submit"> 
                                                    <p class="submit">
                                                        <input id="licence_api" type="submit" name="submit" class="button button-primary" value="<?php echo esc_attr('Save Settings'); ?>" />
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab">
                            <div class="postbox">
                                <div title="" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr("Favourites Label Settings", "cwwpcpt-favourite-posts") ?></span></h3>
                                <div class="inside" style="display: block;">
                                    <table class="form-table">
                                        <tr>
                                            <th><?php echo esc_attr("Text for remove link", "cwwpcpt-favourite-posts") ?></th><td><input type="text" name="cwwpcpt_remove_favourite" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_remove_favourite']); ?>" /></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Text for clear link", "cwwpcpt-favourite-posts") ?></th><td><input type="text" name="cwwpcpt_clear" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_clear']); ?>" /></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Text for favourites are empty", "cwwpcpt-favourite-posts") ?></th><td><input type="text" name="cwwpcpt_favourites_empty" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_favourites_empty']); ?>" /></td>
                                        </tr>
                                        
                                        <tr>
                                            <th><?php echo esc_attr("Text for [remove] link", "cwwpcpt-favourite-posts") ?></th><td><input type="text" name="cwwpcpt_rem" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_rem']); ?>" /></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Remove Link Image URL", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <input type="text" name="cwwpcpt_custom_before_image" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_custom_before_image']); ?>" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Buy now Button Color", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <input name="cwwpcpt_buynow_btn_back_color" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_buynow_btn_back_color']); ?>" class="cwwpcpt_buynow_btn_back_color" />(This is only for woocommerce product added to wishlist).
                                            </td>
                                        </tr>

                                        <tr>
                                            <th><?php echo esc_attr("Buy now Button Text Color", "cwwpcpt-favourite-posts") ?></th>
                                            <td>
                                                <input name="cwwpcpt_buynow_btn_text_back_color" type="text" value="<?php echo esc_attr($cwwpcpt_options['cwwpcpt_buynow_btn_text_back_color']); ?>" class="cwwpcpt_buynow_btn_text_back_color" />(This is only for woocommerce product added to wishlist).
                                            </td>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td>
                                                <div class="push-submit"> 
                                                    <p class="submit">
                                                        <input id="licence_api" type="submit" name="submit" class="button button-primary" value="<?php echo esc_attr('Save Settings'); ?>" />
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab">
                            <div class="postbox">
                                <div title="<?php echo esc_attr("Click to open/close", "cwwpcpt-favourite-posts"); ?>" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr('Favourites Custom Posts Settings', 'cwwpcpt-favourite-posts'); ?></span></h3>
                                <div class="inside" style="display: block;">
                                    <table class="form-table">
                                        <tr valign="top">
                                        <?php 
                                            $get_post_args = array(
                                                               'public'   => true,
                                                               '_builtin' => false
                                                            );
                                            $all_post_types = get_post_types($get_post_args,'objects');
                                            if(get_option('cwwpcpt_multi_posts_options') == "")
                                            {
                                                $posts_in_db = array();
                                            }
                                            else
                                            {
                                                $posts_in_db = get_option('cwwpcpt_multi_posts_options');
                                            }
                                            if(!empty($all_post_types)){ ?>
                                                <th scope="row"><?php echo esc_attr('Select Posts to Display as Favourite', 'push-notifications'); ?></th>
                                            <?php }
                                            else{?>
                                                <th scope="row"><?php echo esc_attr('There is no posts to select for Favourite', 'push-notifications'); ?></th>
                                            <?php }?>
                                            <td>
                                            <?php
                                            foreach ($all_post_types as $all_post_key) {
                                              if(in_array($all_post_key->name, $posts_in_db))
                                              {
                                                $checked_val = "checked";
                                              }
                                              else
                                              {
                                                $checked_val = "";
                                              }?>
                                              <input type="checkbox" name="cwwpcpt_multi_posts_options[]" value="<?php echo $all_post_key->name; ?>" <?php echo $checked_val; ?>><label><?php echo esc_attr($all_post_key->labels->name); ?></label><br/>
                                            <?php }?>
                                            </td>
                                          </tr>			
                                        <tr>
                                            <td>
                                                <div class="push-submit"> 
                                                    <p class="submit">
                                                        <input id="licence_api" type="submit" name="submit" class="button button-primary" value="<?php echo esc_attr('Save Settings'); ?>" />
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab4" class="tab">
                            <div class="postbox">
                                <div title="<?php echo esc_attr("Click to open/close", "cwwpcpt-favourite-posts"); ?>" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr('Most Favourite Posts', 'cwwpcpt-favourite-posts'); ?></span></h3>
                                <div class="inside" style="display: block;">
                                <?php global $wpdb;
                                $table_name = $wpdb->prefix . "favourite_posts";
                                $cwwpcpt_favourite_posts = $wpdb->get_results("SELECT *, COUNT(*) AS count FROM $table_name GROUP BY post_id ORDER BY count DESC LIMIT 20;"); ?>
                                    <table class="form-table">
                                    <?php if(!empty($cwwpcpt_favourite_posts)){?>
                                        <tr valign="top">
                                        	<th>Post Id</th>
                                            <th>Posts Name</th>
                                            <th>Favourites Count</th>
                                        </tr>
                                    <?php }
                                    else{?>
                                        <tr valign="top">
                                            <th>No data for Favourite</th>
                                        </tr>
                                    <?php }?>
                                    <?php foreach ($cwwpcpt_favourite_posts as $cwwpcpt_favourite_post) { ?>
                                        <tr>
                                        	<td><?php echo $cwwpcpt_favourite_post->post_id; ?></td>
                                        	<td><?php echo get_the_title($cwwpcpt_favourite_post->post_id); ?></td>
                                        	<td><?php echo $cwwpcpt_favourite_post->count; ?></td>
                                        </tr>
                                    <?php }?>			
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab5" class="tab">
                            <div class="postbox">
                                <div title="<?php echo esc_attr("Click to open/close", "cwwpcpt-favourite-posts"); ?>" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr('Favourites Posts Page Template Settings', 'cwwpcpt-favourite-posts'); ?></span></h3>
                                <div class="inside" style="display: block;">
                                    <table class="form-table">
                                        <tr>
                                            <th>Select Template View for Favourite Posts List Page</th>
                                        </tr>
                                        <tr>
                                        <?php $cwwpcpt_template_checked = $cwwpcpt_options['cwwpcpt_template_view']; ?>
                                            <td>
                                                <div class="cwwpcpt-favourite-template">
                                                    <input type="radio" id="list_view" name="cwwpcpt_template_view" value="list_view" <?php if($cwwpcpt_template_checked == 'list_view'){ echo 'checked'; }?>>
                                                    <label for="coding">List View</label>
                                                    <input type="radio" id="grid_view" name="cwwpcpt_template_view" value="grid_view" <?php if($cwwpcpt_template_checked == 'grid_view'){ echo 'checked'; }?>>
                                                    <label for="coding">Grid View</label>
                                                    <input type="radio" id="post_view" name="cwwpcpt_template_view" value="post_view" <?php if($cwwpcpt_template_checked == 'post_view'){ echo 'checked'; }?>>
                                                    <label for="coding">Post View</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="push-submit"> 
                                                    <p class="submit">
                                                        <input id="licence_api" type="submit" name="submit" class="button button-primary" value="<?php echo esc_attr('Save Settings'); ?>" />
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>    
                        <div id="tab6" class="tab">
                            <div class="postbox">
                                <div title="<?php echo esc_attr("Click to open/close", "cwwpcpt-favourite-posts"); ?>" class="handlediv">
                                  <br>
                                </div>
                                <h3 class="hndle"><span><?php echo esc_attr('Favourites Help', 'cwwpcpt-favourite-posts'); ?></span></h3>
                                <div class="inside" style="display: block;">
                                     <p style="text-align:center;">If you like Favourite Posts by Categories please leave us a <a href="#" target="_blank">★★★★★</a> rating. A huge thanks in advance! Version 1.0</p>
                                     <p style="text-align:center;">Author <a href="https://excellentwebworld.com/" target="_blank">Excellent WebWorld</a></p>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
