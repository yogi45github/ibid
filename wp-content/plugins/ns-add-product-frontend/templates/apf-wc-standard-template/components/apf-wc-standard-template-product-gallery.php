<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( current_user_can( 'upload_files' ) ) {
    wp_enqueue_media();
}
?>

<!-- Product gallery -->
<div class="apf-box-container apf-product-box-container">
    <div class="apf-header">
        <h2> <?php _e( 'Product gallery', 'apf_plugin' ); ?></h2>
    </div>
    <div class="apf-content apf-content-gallery" style="padding: 12px;">
        <input id="apf-gallery-ids" value="" name="apf_product_gallery_ids" type="hidden"/>

        <div id="product_images_container">
			<ul class="apf-gallery-imgs">
            </ul>
        </div>
        <?php
        if ( current_user_can( 'upload_files' ) ) {
            echo '<a href="#" class="apf-upload-gallery-button">'. __( 'Add product gallery images', 'apf_plugin' ).'</a>';
        }
        ?>							
    </div>
</div>