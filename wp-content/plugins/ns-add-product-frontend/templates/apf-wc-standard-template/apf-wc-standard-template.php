<?php
/* Template Name: NS Add Product Frontend WC standard template*/

get_header();
if(is_user_logged_in()) {
    update_option( 'apf_plugin_template', 'apf-wc-standard-template' );
?>

    <div class="apf-plugin-context">
        <div class="apf-plugin-context-inner">
            <form method="post" id="apf-product-form">
                <div class="apf-main-col">
                    <?php
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-title.php'); // Title
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-description.php'); // Description
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-product-options.php'); // WC Product options
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-excerpt.php'); // Short description / excerpt
                    ?>
                </div>
                <div class="apf-side-col">
                    <?php
                        // require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-categories.php'); // Categories
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-tags.php'); // Tags
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-product-image.php'); // Product image
                        require_once( plugin_dir_path( __FILE__ ).'components/apf-wc-standard-template-product-gallery.php'); // Product gallery
                    ?>
                </div>
                <div style="width: 100%;float: left;">
                    <button id="apf-save-product" class="apf-button-default apf-button-primary" type="submit">Save</button>
                </div>
            </form>
            <!-- The Modal -->
            <div class="apf-modal">
                <!-- Modal content -->
                <div class="apf-modal-content">
                    <div class="apf-loading-section">
                        <div class="apf-loader"></div>
                    </div>
                    
                    <!-- Success -->
                    <div class="apf-modal-result apf-hide-section">
                        <div class="apf-modal-header">
                            <h2><?php _e( 'Success', 'apf_plugin' ); ?></h2>
                        </div>
                        <div class="apf-modal-main-section">
                            <p><?php _e( 'Your product has been added correctly!', 'apf_plugin' ); ?></p>
                            <p class="apf-p-name"><?php _e( 'Product permalink', 'apf_plugin' ); ?>: <span> </span></p>
                        </div>
                        <button  class="apf-button-default apf-button-primary"> <?php _e( 'OK', 'apf_plugin' ); ?> </button>
                    </div>

                    <!-- Error -->
                    <div class="apf-modal-result-error apf-hide-section">
                        <div class="apf-modal-header">
                            <h2><?php _e( 'Error!', 'apf_plugin' ); ?></h2>
                        </div>
                        <div class="apf-modal-main-section">
                            <p></p>
                        </div>
                        <button  class="apf-button-default apf-button-primary"> <?php _e( 'Close', 'apf_plugin' ); ?> </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php
}
else {
?>
    <div class="apf-plugin-context">
        <div class="apf-warning-message">
            <p><?php _e( 'You  must be logged in to view this content!', 'apf_plugin' ); ?></p>
        </div>
    </div>
<?php
   
}
get_footer();
?>