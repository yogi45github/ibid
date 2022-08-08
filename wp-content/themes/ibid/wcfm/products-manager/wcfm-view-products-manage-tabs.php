<?php
/**
 * WCFM plugin view
 *
 * WCFM Products Manage Tabs view
 * This template can be overridden by copying it to yourtheme/wcfm/products-manager/
 *
 * @author 		WC Lovers
 * @package 	wcfm/views/products-manager
 * @version   1.0.0
 */
 
global $wp, $WCFM, $wc_product_attributes;

?>
				<?php 
				$wcfm_pm_block_class_stock = apply_filters( 'wcfm_pm_block_class_stock', 'simple variable grouped external non-job_package non-resume_package non-auction non-groupbuy non-accommodation-booking' );
				if( !apply_filters( 'wcfm_is_allow_inventory', true ) || !apply_filters( 'wcfm_is_allow_pm_inventory', true ) ) { 
					$wcfm_pm_block_class_stock = 'wcfm_block_hide';
				}
				?>


				
				<!-- collapsible 1 -->
				<div class="page_collapsible products_manage_inventory <?php echo esc_attr($wcfm_pm_block_class_stock) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_stock', '' ); ?>" id="wcfm_products_manage_form_inventory_head"><label class="wcfmfa fa-database"></label><?php _e('Inventory', 'ibid'); ?><span></span></div>
				<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_stock) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_stock', '' ); ?>">
					<div id="wcfm_products_manage_form_inventory_expander" class="wcfm-content">
						<?php
						$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_fields_stock', array(
	"sku" => array('label' => __('SKU', 'ibid') , 'type' => 'text', 'class' => 'wcfm-text', 'label_class' => 'wcfm_title', 'value' => $sku, 'hints' => __( 'SKU refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'ibid' )),
	"manage_stock" => array('label' => __('Manage Stock?', 'ibid') , 'type' => 'checkbox', 'class' => 'wcfm-checkbox wcfm_ele simple variable manage_stock_ele non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'value' => 'enable', 'label_class' => 'wcfm_title wcfm_ele checkbox_title simple variable non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'hints' => __('Enable stock management at product level', 'ibid'), 'dfvalue' => $manage_stock),
	"stock_qty" => array('label' => __('Stock Qty', 'ibid') , 'type' => 'number', 'class' => 'wcfm-text wcfm_ele simple variable non_manage_stock_ele non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking non-accommodation-booking', 'label_class' => 'wcfm_title wcfm_ele simple variable non_manage_stock_ele non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'value' => $stock_qty, 'hints' => __( 'Stock quantity. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'ibid' ), 'attributes' => array( 'min' => '1', 'step'=> '1' ) ),
	"backorders" => array('label' => __('Allow Backorders?', 'ibid') , 'type' => 'select', 'options' => array('no' => __('Do not Allow', 'ibid'), 'notify' => __('Allow, but notify customer', 'ibid'), 'yes' => __('Allow', 'ibid')), 'class' => 'wcfm-select wcfm_ele simple variable non_manage_stock_ele non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'label_class' => 'wcfm_title wcfm_ele simple variable non_manage_stock_ele non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'value' => $backorders, 'hints' => __( 'If managing stock, this controls whether or not backorders are allowed. If enabled, stock quantity can go below 0.', 'ibid' )),
	"stock_status" => array('label' => __('Stock status', 'ibid') , 'type' => 'select', 'options' => array('instock' => __('In stock', 'ibid'), 'outofstock' => __('Out of stock', 'ibid'), 'onbackorder' => __( 'On backorder', 'ibid' ) ), 'class' => 'wcfm-select wcfm_ele stock_status_ele simple variable grouped non-variable-subscription non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'label_class' => 'wcfm_ele wcfm_title stock_status_ele simple variable grouped non-variable-subscription non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'value' => $stock_status, 'hints' => __( 'Controls whether or not the product is listed as "in stock" or "out of stock" on the frontend.', 'ibid' )),
	"sold_individually" => array('label' => __('Sold Individually', 'ibid') , 'type' => 'checkbox', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele simple variable non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'hints' => __('Enable this to only allow one of this item to be bought in a single order', 'ibid'), 'label_class' => 'wcfm_title wcfm_ele simple variable checkbox_title non-job_package non-resume_package non-auction non-redq_rental non-appointment non-accommodation-booking', 'dfvalue' => $sold_individually)
				), $product_id, $product_type ) );
						?>
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
					
				<?php do_action( 'after_wcfm_products_manage_stock', $product_id, $product_type ); ?>
				
				<?php 
				$wcfm_pm_block_class_downlodable = apply_filters( 'wcfm_pm_block_class_downlodable', 'simple downlodable non-variable-subscription non-redq_rental non-appointment' );
				if( !apply_filters( 'wcfmu_is_allow_downloadable', true ) || !apply_filters( 'wcfmu_is_allow_pm_downloadable', true ) ) { 
					$wcfm_pm_block_class_downlodable = 'wcfm_block_hide';
				}
				?>
				<!-- collapsible 2 -->
				<div class="page_collapsible products_manage_downloadable <?php echo esc_attr($wcfm_pm_block_class_downlodable) . ' ' . $wcfm_wpml_edit_disable_element; ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_downlodable', '' ); ?>" id="wcfm_products_manage_form_downloadable_head"><label class="wcfmfa fa-cloud-download-alt"></label><?php _e('Downloadable', 'ibid'); ?><span></span></div>
				<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_downlodable) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_downlodable', '' ); ?>">
					<div id="wcfm_products_manage_form_downloadable_expander" class="wcfm-content">
						<?php
						$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_fields_downloadable', array(  
						"downloadable_files" => array('label' => __('Files', 'ibid') , 'type' => 'multiinput', 'class' => 'wcfm-text wcfm_ele simple downlodable', 'label_class' => 'wcfm_title', 'value' => $downloadable_files, 'options' => array(
				"name" => array('label' => __('Name', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele simple downlodable', 'label_class' => 'wcfm_ele wcfm_title simple downlodable', 'custom_attributes' => array( 'required' => 1 ) ),
				"file" => array('label' => __('File', 'ibid'), 'type' => 'upload', 'mime' => 'Uploads', 'button_class' => 'downloadable_product', 'class' => 'wcfm-text wcfm_ele simple downlodable downlodable_file', 'label_class' => 'wcfm_ele wcfm_title simple downlodable', 'custom_attributes' => array( 'required' => 1 ) ),
				"previous_hash" => array( 'type' => 'hidden', 'name' => 'id' )
				)
),
				"download_limit" => array('label' => __('Download Limit', 'ibid'), 'type' => 'number', 'value' => $download_limit, 'placeholder' => __('Unlimited', 'ibid'), 'class' => 'wcfm-text wcfm_ele simple external', 'label_class' => 'wcfm_ele wcfm_title simple downlodable', 'attributes' => array( 'min' => '0', 'step' => '1' )),
				"download_expiry" => array('label' => __('Download Expiry', 'ibid'), 'type' => 'number', 'value' => $download_expiry, 'placeholder' => __('Never', 'ibid'), 'class' => 'wcfm-text wcfm_ele simple external', 'label_class' => 'wcfm_ele wcfm_title simple downlodable', 'attributes' => array( 'min' => '0', 'step' => '1' ))
						), $product_id, $product_type ) );
						
						?>
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				
				<?php do_action( 'after_wcfm_products_downloadable', $product_id, $product_type ); ?>
				
				<!-- collapsible 3 - Grouped Product -->
				<div class="page_collapsible products_manage_grouped grouped" id="wcfm_products_manage_form_grouped_head"><label class="wcfmfa fa-object-group"></label><?php _e('Grouped Products', 'ibid'); ?><span></span></div>
				<div class="wcfm-container grouped">
					<div id="wcfm_products_manage_form_grouped_expander" class="wcfm-content">
						<?php
						$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'product_manage_fields_grouped', array(  
						"grouped_products" => array('label' => __('Grouped products', 'ibid') , 'type' => 'select', 'attributes' => array( 'multiple' => 'multiple', 'style' => 'width: 60%;' ), 'class' => 'wcfm-select wcfm_ele grouped', 'label_class' => 'wcfm_title wcfm_ele grouped', 'options' => $products_array, 'value' => $children, 'hints' => __( 'This lets you choose which products are part of this group.', 'ibid' ))
	)) );
						?>
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				
				<?php do_action( 'after_wcfm_products_manage_grouped', $product_id, $product_type ); ?>
				
				<?php 
				$wcfm_pm_block_class_shipping = apply_filters( 'wcfm_pm_block_class_shipping', 'simple variable nonvirtual booking non-accommodation-booking' );
				if( !apply_filters( 'wcfm_is_allow_shipping', true ) || !apply_filters( 'wcfm_is_allow_pm_shipping', true ) ) { 
				  $wcfm_pm_block_class_shipping = 'wcfm_block_hide';
				}
				?>
				<!-- collapsible 4 -->
				<div class="page_collapsible products_manage_shipping <?php echo esc_attr($wcfm_pm_block_class_shipping) . ' ' . $wcfm_wpml_edit_disable_element; ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_shipping', '' ); ?>" id="wcfm_products_manage_form_shipping_head"><label class="wcfmfa fa-truck"></label><?php _e('Shipping', 'ibid'); ?><span></span></div>
				<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_shipping) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_shipping', '' ); ?>">
					<div id="wcfm_products_manage_form_shipping_expander" class="wcfm-content">
						<?php do_action( 'wcfm_product_manage_fields_shipping_before', $product_id ); ?>
						<div class="wcfm_clearfix"></div>
						<?php
						$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_manage_fields_shipping', array(  "weight" => array( 'label' => __('Weight', 'ibid') . ' ('.get_option( 'woocommerce_weight_unit', 'kg' ).')' , 'type' => 'text', 'class' => 'wcfm-text wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $weight),
"length" => array( 'label' => __('Dimensions', 'ibid') . ' ('.get_option( 'woocommerce_dimension_unit', 'cm' ).')', 'placeholder' => __('Length', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $length),
"width" => array( 'placeholder' => __('Width', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $width),
"height" => array( 'placeholder' => __('Height', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $height),
"shipping_class" => array('label' => __('Shipping class', 'ibid') , 'type' => 'select', 'options' => $shipping_option_array, 'class' => 'wcfm-select wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $shipping_class)
		), $product_id ) );
						?>
						<div class="wcfm_clearfix"></div>
						<?php do_action( 'wcfm_product_manage_fields_shipping_after', $product_id ); ?>
					</div>
				</div>


				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				
				<?php do_action( 'after_wcfm_products_manage_shipping', $product_id, $product_type ); ?>
				
				<?php if ( wc_tax_enabled() ) { ?>
					<?php 
					$wcfm_pm_block_class_tax = apply_filters( 'wcfm_pm_block_class_tax', 'simple variable booking non-groupbuy' );
					if( !apply_filters( 'wcfm_is_allow_tax', true ) || !apply_filters( 'wcfm_is_allow_pm_tax', true ) ) { 
						$wcfm_pm_block_class_tax = 'wcfm_block_hide';
					}
					?>
					<!-- collapsible 5 -->
					<div class="page_collapsible products_manage_tax <?php echo esc_attr($wcfm_pm_block_class_tax) . ' ' . $wcfm_wpml_edit_disable_element; ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_tax', '' ); ?>" id="wcfm_products_manage_form_tax_head"><label class="wcfmfa fa-money fa-money-bill-alt"></label><?php _e('Tax', 'ibid'); ?><span></span></div>
					<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_tax) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_tax', '' ); ?>">
						<div id="wcfm_products_manage_form_tax_expander" class="wcfm-content">
<?php
$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_simple_fields_tax', array(  
	"tax_status" => array('label' => __('Tax Status', 'ibid') , 'type' => 'select', 'options' => array( 'taxable' => __( 'Taxable', 'ibid' ), 'shipping' => __( 'Shipping only', 'ibid' ), 'none' => _x( 'None', 'Tax status', 'ibid' ) ), 'class' => 'wcfm-select wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $tax_status, 'hints' => __( 'Define whether or not the entire product is taxable, or just the cost of shipping it.', 'ibid' )),
	"tax_class" => array('label' => __('Tax Class', 'ibid') , 'type' => 'select', 'options' => $tax_classes_options, 'class' => 'wcfm-select wcfm_ele simple variable booking', 'label_class' => 'wcfm_title', 'value' => $tax_class, 'hints' => __( 'Choose a tax class for this product. Tax classes are used to apply different tax rates specific to certain types of product.', 'ibid' ))
			)) );
?>
						</div>
					</div>
					<!-- end collapsible -->
					<div class="wcfm_clearfix"></div>
				<?php } ?>
				
				<?php do_action( 'after_wcfm_products_manage_tax', $product_id, $product_type ); ?>
				
				<?php 
				$wcfm_pm_block_class_attributes = apply_filters( 'wcfm_pm_block_class_attributes', 'simple variable external grouped booking' );
				if( !apply_filters( 'wcfm_is_allow_attribute', true ) || !apply_filters( 'wcfm_is_allow_pm_attribute', true ) ) {
					$wcfm_pm_block_class_attributes = 'wcfm_block_hide';
				}	
				?>
				<!-- collapsible 6 -->
				<div class="page_collapsible products_manage_attribute <?php echo esc_attr($wcfm_pm_block_class_attributes); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_attributes', '' ); ?>" id="wcfm_products_manage_form_attribute_head"><label class="wcfmfa fa-server"></label><?php _e('Attributes', 'ibid'); ?><span></span></div>
				<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_attributes); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_attributes', '' ); ?>">
					<div id="wcfm_products_manage_form_attribute_expander" class="wcfm-content">
						<?php
						  do_action( 'wcfm_products_manage_attributes', $product_id );
						  
$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'product_simple_fields_attributes', array(  
					"attributes" => array( 'label' => __( 'Attributes', 'ibid' ), 'type' => 'multiinput', 'class' => 'wcfm-text wcfm_ele simple variable external grouped booking', 'has_dummy' => true, 'label_class' => 'wcfm_title', 'value' => $attributes, 'options' => array(
"term_name" => array('type' => 'hidden'),
"is_active" => array('label' => __('Active?', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele attribute_ele simple variable external grouped booking', 'label_class' => 'wcfm_title attribute_ele checkbox_title'),
"name" => array('label' => __('Name', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele attribute_ele simple variable external grouped booking', 'label_class' => 'wcfm_title attribute_ele'),
"value" => array('label' => __('Value(s):', 'ibid'), 'type' => 'textarea', 'class' => 'wcfm-textarea wcfm_ele simple variable external grouped booking', 'placeholder' => sprintf( __('Enter some text, some attributes by "%s" separating values.', 'ibid'), WC_DELIMITER ), 'label_class' => 'wcfm_title'),
"is_visible" => array('label' => __('Visible on the product page', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele simple variable external grouped booking', 'label_class' => 'wcfm_title checkbox_title'),
"is_variation" => array('label' => __('Use as Variation', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele variable variable-subscription', 'label_class' => 'wcfm_title checkbox_title wcfm_ele variable variable-subscription'),
"tax_name" => array('type' => 'hidden'),
"is_taxonomy" => array('type' => 'hidden')
					))
)) );
						?>
						<div class="wcfm_clearfix"></div><br />
						<p>
<?php if( apply_filters( 'wcfm_is_allow_add_attribute', true ) ) { ?>
	<select name="wcfm_attribute_taxonomy" class="wcfm-select wcfm_attribute_taxonomy">
		<option value="add_attribute"><?php _e( 'Add attribute', 'ibid' ); ?></option>
	</select>
	<button type="button" class="button wcfm_add_attribute"><?php _e( 'Add', 'ibid' ); ?></button>
<?php } ?>
						</p>
						<div class="wcfm_clearfix"></div><br />
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				
				<?php do_action( 'after_wcfm_products_manage_attribute', $product_id, $product_type ); ?>
				
				<?php if( apply_filters( 'wcfm_is_allow_variable', true ) && apply_filters( 'wcfm_is_allow_pm_variable', true ) ) { ?>
				<!-- collapsible 7 -->
				<div class="page_collapsible products_manage_variations variable variations variable-subscription" id="wcfm_products_manage_form_variations_head"><label class="wcfmfa fa-tasks"></label><?php _e('Variations', 'ibid'); ?><span></span></div>
				<div class="wcfm-container variable variable-subscription">
				  <div id="wcfm_products_manage_form_variations_empty_expander" class="wcfm-content">
				    <?php printf( __( 'Before you can add a variation you need to add some variation attributes on the Attributes tab. %sLearn more%s', 'ibid' ), '<br /><h2><a class="wcfm_dashboard_item_title" target="_blank" href="' . apply_filters( 'wcfm_variations_help_link', 'https://docs.woocommerce.com/document/variable-product/' ) . '">', '</a></h2>' ); ?>
				  </div>
					<div id="wcfm_products_manage_form_variations_expander" class="wcfm-content">
					  <p>
<div class="default_attributes_holder">
  <p class="wcfm_title selectbox_title"><strong><?php _e( 'Default Form Values:', 'ibid' ); ?></strong></p>
	<input type="hidden" name="default_attributes_hidden" data-name="default_attributes_hidden" value="<?php echo esc_attr( $default_attributes ); ?>" />
</div>
						</p>
						<p>
						  <p class="variations_options wcfm_title"><strong><?php _e('Variations Bulk Options', 'ibid'); ?></strong></p>
						  <label class="screen-reader-text" for="variations_options"><?php _e('Variations Bulk Options', 'ibid'); ?></label>
						  <select id="variations_options" name="variations_options" class="wcfm-select wcfm_ele variable-subscription variable">
						    <option value="" selected="selected"><?php _e( 'Choose option', 'ibid' ); ?></option>
						    <optgroup label="<?php _e( 'Status', 'ibid' ); ?>">
	  <option value="on_enabled"><?php _e( 'Enable all Variations', 'ibid' ); ?></option>
	  <option value="off_enabled"><?php _e( 'Disable all Variations', 'ibid' ); ?></option>
	  <?php if( WCFM_Dependencies::wcfmu_plugin_active_check() && apply_filters( 'wcfmu_is_allow_downloadable', true ) && apply_filters( 'wcfmu_is_allow_pm_downloadable', true ) ) { ?>
			<option value="on_downloadable"><?php _e( 'Set variations "Downloadable"', 'ibid' ); ?></option>
			<option value="off_downloadable"><?php _e( 'Set variations "Non-Downloadable"', 'ibid' ); ?></option>
	  <?php } ?>
	  <?php if( apply_filters( 'wcfmu_is_allow_virtual', true ) && apply_filters( 'wcfmu_is_allow_pm_virtual', true ) ) { ?>
			<option value="on_virtual"><?php _e( 'Set variations "Virtual"', 'ibid' ); ?></option>
			<option value="off_virtual"><?php _e( 'Set variations "Non-Virtual"', 'ibid' ); ?></option>
		<?php } ?>
	</optgroup>
						    <optgroup label="<?php _e( 'Pricing', 'ibid' ); ?>">
		<option value="set_regular_price"><?php _e( 'Regular prices', 'ibid' ); ?></option>
		<option value="regular_price_increase"><?php _e( 'Regular price increase', 'ibid' ); ?></option>
		<option value="regular_price_decrease"><?php _e( 'Regular price decrease', 'ibid' ); ?></option>
		<option value="set_sale_price"><?php _e( 'Sale prices', 'ibid' ); ?></option>
		<option value="sale_price_increase"><?php _e( 'Sale price increase', 'ibid' ); ?></option>
		<option value="sale_price_decrease"><?php _e( 'Sale price decrease', 'ibid' ); ?></option>
	</optgroup>
	<?php if( apply_filters( 'wcfm_is_allow_inventory', true ) && apply_filters( 'wcfm_is_allow_pm_inventory', true ) ) { ?>
		<optgroup label="<?php _e( 'Inventory', 'ibid' ); ?>">
			<option value="on_manage_stock"><?php _e( 'ON "Manage stock"', 'ibid' ); ?></option>
			<option value="off_manage_stock"><?php _e( 'OFF "Manage stock"', 'ibid' ); ?></option>
			<option value="variable_stock"><?php _e( 'Stock', 'ibid' ); ?></option>
			<option value="variable_increase_stock"><?php _e( 'Increase Stock', 'ibid' ); ?></option>
			<option value="variable_stock_status_instock"><?php _e( 'Set Status - In stock', 'ibid' ); ?></option>
			<option value="variable_stock_status_outofstock"><?php _e( 'Set Status - Out of stock', 'ibid' ); ?></option>
			<option value="variable_stock_status_onbackorder"><?php _e( 'Set Status - On backorder', 'ibid' ); ?></option>
		</optgroup>
	<?php } ?>
	<?php if( apply_filters( 'wcfm_is_allow_shipping', true ) && apply_filters( 'wcfm_is_allow_pm_shipping', true ) ) { ?>
		<optgroup label="<?php _e( 'Shipping', 'ibid' ); ?>">
			<option value="set_length"><?php _e( 'Length', 'ibid' ); ?></option>
			<option value="set_width"><?php _e( 'Width', 'ibid' ); ?></option>
			<option value="set_height"><?php _e( 'Height', 'ibid' ); ?></option>
			<option value="set_weight"><?php _e( 'Weight', 'ibid' ); ?></option>
		</optgroup>
	<?php } ?>
	<?php if( WCFM_Dependencies::wcfmu_plugin_active_check() && apply_filters( 'wcfmu_is_allow_downloadable', true ) && apply_filters( 'wcfmu_is_allow_pm_downloadable', true ) ) { ?>
		<optgroup label="<?php _e( 'Downloadable products', 'ibid' ); ?>">
			<option value="variable_download_limit"><?php _e( 'Download limit', 'ibid' ); ?></option>
			<option value="variable_download_expiry"><?php _e( 'Download expiry', 'ibid' ); ?></option>
		</optgroup>
	<?php } ?>
						  </select>
						</p>
						<?php
						 $WCFM->wcfm_fields->wcfm_generate_form_field( array(  
					"variations" => array('type' => 'multiinput', 'class' => 'wcfm_ele variable variable-subscription', 'label_class' => 'wcfm_title', 'value' => $variations, 'options' => 
apply_filters( 'wcfm_product_manage_fields_variations', array(
"id" => array('type' => 'hidden', 'class' => 'variation_id'),
"enable" => array('label' => __('Enable', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'dfvalue' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele variable variable-subscription', 'label_class' => 'wcfm_title checkbox_title'),
"is_virtual" => array('label' => __('Virtual', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele variable variable-subscription variation_is_virtual_ele', 'label_class' => 'wcfm_title checkbox_title'),
"manage_stock" => array('label' => __('Manage Stock', 'ibid'), 'type' => 'checkbox', 'value' => 'enable', 'value' => 'enable', 'class' => 'wcfm-checkbox wcfm_ele variable variable-subscription variation_manage_stock_ele', 'label_class' => 'wcfm_title checkbox_title'),
"wcfm_element_breaker_variation_1" => array( 'type' => 'html', 'value' => '<div class="wcfm-cearfix"></div>'),
"image" => array('label' => __('Image', 'ibid'), 'type' => 'upload', 'class' => 'wcfm-text wcfm_ele variable variable-subscription', 'label_class' => 'wcfm_title wcfm_half_ele_upload_title'),
"wcfm_element_breaker_variation_2" => array( 'type' => 'html', 'value' => '<div class="wcfm-cearfix"></div>'),
"regular_price" => array('label' => __('Regular Price', 'ibid') . '(' . get_woocommerce_currency_symbol() . ')', 'type' => 'number', 'class' => 'wcfm-text wcfm_ele wcfm_non_negative_input wcfm_half_ele variable', 'label_class' => 'wcfm_title wcfm_ele wcfm_half_ele_title variable', 'attributes' => array( 'min' => '0.1', 'step'=> '0.1' ) ),
"sale_price" => array('label' => __('Sale Price', 'ibid') . '(' . get_woocommerce_currency_symbol() . ')', 'type' => 'number', 'class' => 'wcfm-text wcfm_ele wcfm_non_negative_input wcfm_half_ele variable variable-subscription', 'label_class' => 'wcfm_title wcfm_ele wcfm_half_ele_title variable variable-subscription', 'attributes' => array( 'min' => '0.1', 'step'=> '0.1' ) ),
"sale_price_dates_from" => array('label' => __('From', 'ibid'), 'type' => 'text', 'placeholder' => __( 'From', 'ibid' ) . ' ... YYYY-MM-DD', 'class' => 'wcfm-text wcfm_ele wcfm_half_ele var_sales_schedule_ele var_sale_date_from variable variable-subscription', 'label_class' => 'wcfm_ele wcfm_half_ele_title var_sales_schedule_ele variable variable-subscription'),
"sale_price_dates_to" => array('label' => __('Upto', 'ibid'), 'type' => 'text', 'placeholder' => __( 'To', 'ibid' ) . ' ... YYYY-MM-DD', 'class' => 'wcfm-text wcfm_ele wcfm_half_ele var_sales_schedule_ele var_sale_date_upto variable variable-subscription', 'label_class' => 'wcfm_ele wcfm_half_ele_title var_sales_schedule_ele wcfm_title variable variable-subscription'),
"stock_qty" => array('label' => __('Stock Qty', 'ibid') , 'type' => 'number', 'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable variable-subscription variation_non_manage_stock_ele', 'label_class' => 'wcfm_title wcfm_half_ele_title variation_non_manage_stock_ele', 'attributes' => array( 'min' => '1', 'step'=> '1' ) ),
"backorders" => array('label' => __('Backorders?', 'ibid') , 'type' => 'select', 'options' => array('no' => __('Do not Allow', 'ibid'), 'notify' => __('Allow, but notify customer', 'ibid'), 'yes' => __('Allow', 'ibid')), 'class' => 'wcfm-select wcfm_ele wcfm_half_ele variable variable-subscription variation_non_manage_stock_ele', 'label_class' => 'wcfm_title wcfm_half_ele_title variation_non_manage_stock_ele'),
"sku" => array('label' => __('SKU', 'ibid'), 'type' => 'text', 'class' => 'wcfm-text wcfm_ele wcfm_half_ele variable variable-subscription', 'label_class' => 'wcfm_title wcfm_half_ele_title'),
"stock_status" => array('label' => __('Stock status', 'ibid') , 'type' => 'select', 'options' => array('instock' => __('In stock', 'ibid'), 'outofstock' => __('Out of stock', 'ibid'), 'onbackorder' => __( 'On backorder', 'ibid' )), 'class' => 'wcfm-select wcfm_ele wcfm_half_ele variable variable-subscription variation_stock_status_ele', 'label_class' => 'wcfm_title wcfm_half_ele_title variation_stock_status_ele'), 
"attributes" => array('type' => 'hidden')
					), $variations, $variation_shipping_option_array, $variation_tax_classes_options, $products_array, $product_id, $product_type ) )
) );
						?>
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				<?php } ?>
				
				<?php do_action( 'after_wcfm_products_manage_variable', $product_id, $product_type ); ?>
				
				<?php 
				$wcfm_pm_block_class_linked = apply_filters( 'wcfm_pm_block_class_linked', 'simple variable external grouped' );
				if( !apply_filters( 'wcfm_is_allow_linked', true ) ) { 
				  $wcfm_pm_block_class_linked = 'wcfm_block_hide'; 
				}
				?>
				<!-- collapsible 8 - Linked Product -->
				<div class="page_collapsible products_manage_linked <?php echo esc_attr($wcfm_pm_block_class_linked) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_linked', '' ); ?>" id="wcfm_products_manage_form_linked_head"><label class="wcfmfa fa-link"></label><?php _e('Linked', 'ibid'); ?><span></span></div>
				<div class="wcfm-container <?php echo esc_attr($wcfm_pm_block_class_linked) . ' ' . esc_attr($wcfm_wpml_edit_disable_element); ?> <?php echo apply_filters( 'wcfm_pm_block_custom_class_linked', '' ); ?>">
					<div id="wcfm_products_manage_form_linked_expander" class="wcfm-content">
						<?php
						$WCFM->wcfm_fields->wcfm_generate_form_field( apply_filters( 'wcfm_product_manage_fields_linked', array(  
						"upsell_ids" => array('label' => __('Up-sells', 'ibid') , 'type' => 'select', 'attributes' => array( 'multiple' => 'multiple', 'style' => 'width: 60%;' ), 'class' => 'wcfm-select wcfm_ele simple variable external grouped booking', 'label_class' => 'wcfm_title', 'options' => $products_array, 'value' => $upsell_ids, 'hints' => __( 'Up-sells are products which you recommend instead of the currently viewed product, for example, products that are more profitable or better quality or more expensive.', 'ibid' )),
						"crosssell_ids" => array('label' => __('Cross-sells', 'ibid') , 'type' => 'select', 'attributes' => array( 'multiple' => 'multiple', 'style' => 'width: 60%;' ), 'class' => 'wcfm-select wcfm_ele simple variable external grouped booking', 'label_class' => 'wcfm_title', 'options' => $products_array, 'value' => $crosssell_ids, 'hints' => __( 'Cross-sells are products which you promote in the cart, based on the current product.', 'ibid' ))
	), $product_id, $products_array ) );
						?>
					</div>
				</div>
				<!-- end collapsible -->
				<div class="wcfm_clearfix"></div>
				
				<?php do_action( 'after_wcfm_products_manage_linked', $product_id, $product_type ); ?>