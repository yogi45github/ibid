<?php
// Add attributes in frontend product page
add_action( 'wp_ajax_add_product_attributes', 'add_product_attributes' );
add_action( 'wp_ajax_nopriv_add_product_attributes', 'add_product_attributes' );
function add_product_attributes() {
    check_ajax_referer( 'ns-apf-special-string', 'security' );
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $attribute_id = $_POST['attribute'];
    $attribute = wc_get_attribute( $attribute_id );
?>
<div class="apf-option-group apf-option-group-attributes">
    <h3>
        <span  class="apf-remove-row-delete" onClick="apfRemoveAttr(this);">Remove</span>
    </h3>
    <table cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="apf-attribute-name">
                    <label style="width: 200px;"><?php _e('Name', 'apf_plugin'); ?>:</label>
                    <?php
                    if($attribute == null)  {   // Attribute not selected
                        echo '<input type="text" class="apf-input cus_attribute_name" name="attribute_name" value="">';
                    }
                    else {
                        echo '<strong>'.$attribute->name.'</strong>';
                        echo '<input type="text" class="apf-input attr_name" name="attribute_name" value="'.$attribute->slug.'" style="display: none;">';
                    }
                    ?>             
                </td>
                <td rowspan="3">
                    <label style="width: 100%;"><?php _e('Value(s)', 'apf_plugin'); ?>:</label>
                    <?php
                    if($attribute == null)  {  // Attribute not selected
                    ?>
                        <textarea class="apf-input cus_attribute_value" name="cus_attribute_value" cols="5" rows="5" placeholder="<?php _e('Enter some text, or some attributes by \'|\' separating values.','apf_plugin'); ?>"></textarea>
                    <?php
                    }
                    else {
                        $terms = get_terms(
                            array(
                            'taxonomy' => $attribute->slug,
                            'hide_empty' => false,
                        ));
                    ?>
                        <select class="apf-input attribute_value" name="attribute_value" style="width: 100%;">
                            <option></option>
                    <?php
                            foreach ( $terms as $term ) {
                                echo "<option value=".$term->term_id.">" .$term->name. "</option>";
                            }
                    ?>
                        </select>
                    <?php
                    }
                    ?>   
                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                    if($attribute == null)  {  // Attribute not selected
                    ?>
                    <label style="width: auto;"><input type="checkbox" class="apf-input cus_attribute_visibility" checked="checked" name="attribute_visibility"> <?php _e('Visible on the product page', 'apf_plugin'); ?></label>
                    <?php
                    }
                    else {
                    ?>
                    <label style="width: auto;"><input type="checkbox" class="apf-input attribute_visibility" checked="checked" name="attribute_visibility"> <?php _e('Visible on the product page', 'apf_plugin'); ?></label>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="enable_variation show_if_variable" style="display: none;">
                        <label><input type="checkbox" class="apf-input" name="attribute_variation[]"> <?php _e('Used for variations', 'apf_plugin'); ?></label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
	die();
}
?>