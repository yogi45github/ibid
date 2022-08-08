<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php 
    $attributes_taxonomy = wc_get_attribute_taxonomies();
?>
<div class="apf-option-group">
    <p>
        <select id="apf-attributes-select" name="attribute_taxonomy">
            <?php
                echo '<option value="" selected="selected">'.__( 'Custom product attribute', 'apf_plugin' ).'</option>';
                foreach ($attributes_taxonomy as $attribute) {
                    echo '<option value="'.$attribute->attribute_id.'">'.$attribute->attribute_name.'</option>';
                }
            ?>
        </select>
        <button id="apf-add-attribute" class="apf-button-default" type="button"><?php _e('Add', 'apf_plugin'); ?></button>
    </p>
</div>

<div class="apf-product_attributes">
</div>