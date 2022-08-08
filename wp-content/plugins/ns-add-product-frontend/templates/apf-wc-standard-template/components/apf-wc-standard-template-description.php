<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="apf-box-container">
    <?php
        $content   = '';
        $editor_id = 'apf_description_editor';
        
        wp_editor( $content, $editor_id, array('media_buttons' => false) );
    ?>
</div>