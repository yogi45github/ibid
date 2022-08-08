<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( current_user_can( 'upload_files' ) ) {
    wp_enqueue_media();
}
?>

<!-- Product image -->
<div class="apf-box-container apf-product-box-container">
    <div class="apf-header">
        <h2> <?php _e( 'Product image', 'apf_plugin' ); ?></h2>
    </div>
    <div class="apf-content apf-content-image" style="padding: 12px;">
        <input value="" name="apf_product_image" type="hidden"/>
        <img src="" class="apf-product-image apf-hide-section" width="213" height="200">
        <p class="apf-image-product-descr apf-hide-section"><i><?php _e( 'Click the image to edit or update', 'apf_plugin' ); ?></i></p>
    <?php
        if ( current_user_can( 'upload_files' ) ) {
            echo '<a href="#" class="apf-upload-image-button">'. __( 'Set product image', 'apf_plugin' ).'</a>';
            echo '<a href="#" class="apf-remove-image-button apf-hide-section">'. __( 'Remove product image', 'apf_plugin' ).'</a>';
        }
    ?>
    </div>
</div>