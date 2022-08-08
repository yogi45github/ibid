<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- Short description / excerpt -->
<div class="apf-box-container apf-product-box-container">
    <div class="apf-header">
        <h2> <?php _e( 'Short product description', 'apf_plugin' ); ?></h2>
    </div>
    <div class="apf-content" style="padding: 12px;">
        <?php
            $content   = '';
            $editor_id = 'apf_excerpt_editor';
            
            wp_editor( $content, $editor_id, array('textarea_rows' => 7, 'media_buttons' => false) );
        ?>
    </div>
</div>