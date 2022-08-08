<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$already_existent_tags = get_terms( 'product_tag', array(
                            'hide_empty' => false,
                        ) );
?>

<!-- Product tags -->
<div class="apf-box-container apf-product-box-container">
    <div class="apf-header">
        <h2> <?php _e( 'Product tags', 'apf_plugin' ); ?></h2>
    </div>
    <div class="apf-content apf-content-tags" style="padding: 12px;">
        <input type="text" id="apf-input-values" list="apf-tags" class="apf-input" name="tags" placeholder="" style="width: auto;">
        <datalist id="apf-tags">
        <?php
            foreach ($already_existent_tags as $tag) {
                echo '<option value="'.$tag->name.'">';
            }
        ?>
        </datalist>
        <button id="apf-add-tag" class="apf-button-default" type="button">Add</button>
        <p><i><?php _e('Separate tags with commas', 'apf_plugin'); ?></i></p>
        
        <ul class="apf-tagchecklist" role="list">

        </ul>
        <input type="hidden" id="apf-input-values-hidden" name="apf_tags">
    </div>
</div>