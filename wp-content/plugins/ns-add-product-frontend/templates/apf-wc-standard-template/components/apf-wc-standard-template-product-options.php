<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- WC Product options -->
<div class="apf-box-container apf-product-box-container">
    <!-- Header -->
    <div class="apf-header">
        <h2> <?php _e( 'Product Data', 'apf_plugin' ); ?> — </h2>
        <span>
            <select id="apf-product-type" name="apf-product-type">
                <option value="simple" selected="selected"><?php _e( 'Simple product', 'apf_plugin' ); ?></option>
                <!-- <option value="grouped"><?php _e( 'Grouped product', 'apf_plugin' ); ?></option>
                <option value="external"><?php _e( 'External/Affiliate product', 'apf_plugin' ); ?></option>
                <option value="variable"><?php _e( 'Variable product', 'apf_plugin' ); ?></option> -->
            </select>
            <label for="apf-virtual" class="apf-checkbox-label apf-premium-feature apf-tooltip">
                <span class="apf-tooltiptext"><?php _e( 'Only avaiable in Premium version.', 'apf_plugin' ); ?></span>
                <?php _e( 'Virtual', 'apf_plugin' ); ?>:
                <input type="checkbox" name="apf-virtual" id="apf-virtual" disabled>
            </label>
            <label for="apf-downloadable" class="apf-checkbox-label apf-premium-feature apf-tooltip">
                <span class="apf-tooltiptext"><?php _e( 'Only avaiable in Premium version.', 'apf_plugin' ); ?></span>
                <?php _e( 'Downloadable', 'apf_plugin' ); ?>:
                <input type="checkbox" name="apf-downloadable" id="apf-downloadable" disabled>
            </label>
        </span>
    </div>

    <!-- Content -->
    <div class="apf-content">
        <!-- Tabs -->
        <ul class="apf-wc-tabs">
            <li class="apf-tab-option apf-general-options active">
                <a href="#apf-general-product-data"><span><?php _e( 'General', 'apf_plugin' ); ?></span></a>
            </li>
            <li class="apf-tab-option apf-inventory-options">
                <a href="#apf-inventory-product-data"><span><?php _e( 'Inventory', 'apf_plugin' ); ?></span></a>
            </li>
            <li class="apf-tab-option apf-shipping-options">
                <a href="#apf-shipping-product-data"><span><?php _e( 'Shipping', 'apf_plugin' ); ?></span></a>
            </li>
            <li class="apf-tab-option apf-linked-prod-options">
                <a href="#apf-linked-products-data"><span><?php _e( 'Linked Products', 'apf_plugin' ); ?></span></a>
            </li>
            <li class="apf-tab-option apf-attributes-options">
                <a href="#apf-attributes-product-data"><span><?php _e( 'Attributes', 'apf_plugin' ); ?></span></a>
            </li>
            <li class="apf-tab-option apf-advanced-options">
                <a href="#apf-advanced-product-data"><span><?php _e( 'Advanced', 'apf_plugin' ); ?></span></a>
            </li>
        </ul>

        <!-- General options -->
        <div id="apf-general-product-data" class="apf-option-panel">
            <div class="apf-option-group">
                <p>
                    <label for="apf-regular-price"><?php _e( 'Regular price', 'apf_plugin' ); echo ' ('.get_woocommerce_currency_symbol().') ';?></label> 
                    <input type="text" class="apf-input apf-input-inner" name="regular_price" id="apf-regular-price" placeholder="">
                </p>
                <p>
                    <label for="apf-sale-price"><?php _e( 'Sale price', 'apf_plugin' ); echo ' ('.get_woocommerce_currency_symbol().') ';?></label> 
                    <input type="text" class="apf-input apf-input-inner" name="sale_price" id="apf-sale-price" placeholder="">
                </p>
            </div>
            <div class="apf-option-group">
                <?php
                    $tax_classes = WC_Tax::get_tax_classes();
                    $tax_classes_slugs = WC_Tax::get_tax_class_slugs();
                    $tax_status_tooltip = __('Define whether or not the entire product is taxable, or just the cost of shipping it.', 'apf_plugin');
                    $tax_classes_tooltip = __('Choose a tax class for this product. Tax classes are used to apply different tax rates specific to certain types of product.', 'apf_plugin');
                ?>
                <p>
                    <label for="apf-tax-status"><?php _e( 'Tax status', 'apf_plugin' );?></label>
                    <select id="apf-tax-status" name="tax_status">
                        <option value="taxable" selected="selected"><?php _e( 'Taxable', 'apf_plugin' ); ?></option>
                        <option value="shipping"><?php _e( 'Shipping', 'apf_plugin' ); ?></option>
                        <option value="none"><?php _e( 'None', 'apf_plugin' ); ?></option>		
                    </select>
                    <?php
                        apf_print_tooltip($tax_status_tooltip);
                    ?>
                </p>
                <p>
                    <label for="apf-tax-class"><?php _e( 'Tax class', 'apf_plugin' );?></label>
                    <select id="apf-tax-class" name="tax_class">
                        <?php
                            echo '<option value="" selected="selected">-</option>';
                            for ($i = 0; $i < count($tax_classes); $i ++) {
                                echo '<option value="'. $tax_classes_slugs[$i].'">'.$tax_classes[$i].'</option>';
                            }
                        ?>	
                    </select>
                    <?php
                        apf_print_tooltip($tax_classes_tooltip);
                    ?>
                </p>
            </div>
        </div>
        <!-- Inventory options -->
        <div id="apf-inventory-product-data" class="apf-option-panel apf-hide-section">
            <div class="apf-option-group">
                <?php
                    $sku_tooltip = __('SKU refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.', 'apf_plugin');
                    $stock_status_tooltip = __('Controls whether or not the product is listed as "in stock" or "out of stock" on the frontend.', 'apf_plugin');
                ?>
                <p>
                    <label for="apf-sku"><?php _e( 'SKU', 'apf_plugin' );?></label> 
                    <input type="text" class="apf-input apf-input-inner" name="sku" id="apf-sku" placeholder="">
                    <?php
                        apf_print_tooltip($sku_tooltip);
                    ?>
                </p>
                <p>
                    <label for="apf-manage-stock"><?php _e( 'Manage stock?', 'apf_plugin' );?></label> 
                    <input type="checkbox" class="apf-input" name="manage_stock" id="apf-manage-stock">
                </p>
                <div class="apf-manage-stock-section apf-hide-section">
                    <?php
                        $stock = __('Stock quantity. If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.', 'apf_plugin');
                        $backorders = __('If managing stock, this controls whether or not back-orders are allowed. If enabled, stock quantity can go below 0.', 'apf_plugin');
                        $low_stock_amount = __('When product stock reaches this amount you will be notified by email.', 'apf_plugin');
                    ?>
                    <p>
                        <label for="apf-manage-stock"><?php _e( 'Stock quantity', 'apf_plugin' );?></label> 
                        <input type="number" class="apf-input apf-input-inner" name="apf_stock" id="apf-stock">
                        <?php
                            apf_print_tooltip($stock);
                        ?>
                    </p>
                    <p>
                        <label for="apf-manage-stock"><?php _e( 'Allow back-orders?', 'apf_plugin' );?></label> 
                        <select class="apf-input apf-input-inner" name="apf_backorders" id="apf-backorders">
                            <option value="no">Do not allow</option>
                            <option value="notify">Allow, but notify customer</option>
                            <option value="yes">Allow</option>
                        </select>
                        <?php
                            apf_print_tooltip($backorders);
                        ?>
                    </p>
                    <p>
                        <label for="apf-manage-stock"><?php _e( 'Low stock threshold', 'apf_plugin' );?></label> 
                        <input type="number" class="apf-input apf-input-inner" name="apf_low_stock_amount" id="apf-low-stock-amount">
                        <?php
                            apf_print_tooltip($low_stock_amount);
                        ?>
                    </p>        
                </div>
                <p class="apf-stock-status-option">
                    <?php
                        $stock_status_options = wc_get_product_stock_status_options();
                    ?>
                    <label for="apf-stock-status"><?php _e( 'Stock status', 'apf_plugin' );?></label>
                    <select id="apf-stock-status" name="stock_status">
                        <?php
                            foreach ($stock_status_options as $key => $value) {
                                echo '<option value="'. $key.'">'.$value.'</option>';
                            }
                        ?>
                    </select>
                    <?php
                        apf_print_tooltip($stock_status_tooltip);
                    ?>
                </p>
            </div>
            <div class="apf-option-group">
                <p>
                    <label for="apf-sold-individually"><?php _e( 'Sold individually', 'apf_plugin' );?></label> 
                    <input type="checkbox" class="apf-input" name="sold_individually" id="apf-sold-individually">
                    <span><i><?php _e( 'Enable this to only allow one of this item to be bought in a single order', 'apf_plugin' );?></i></span>
                </p>
            </div>
        </div>
        <!-- Shipping options -->
        <div id="apf-shipping-product-data" class="apf-option-panel apf-hide-section">
            <div class="apf-option-group">
                <?php 
                    $weight_unit = get_option('woocommerce_weight_unit');
                    $dimension_unit = get_option('woocommerce_dimension_unit');
                    $weight_tootltip = __('Weight in decimal form.', 'apf_plugin');
                    $dimension_tootltip = __('LxWxH in decimal form.', 'apf_plugin');
                ?>
                <p>
                    <label for="apf-weight"><?php _e( 'Weight', 'apf_plugin' ); echo ' ('.$weight_unit.')';?></label> 
                    <input type="text" class="apf-input apf-input-inner" name="weight" id="apf-weight" placeholder="0">
                    <?php
                        apf_print_tooltip($weight_tootltip);
                    ?>
                </p>
                <p class="apf-dimensions-field">
                    <label for="apf-product-length"><?php _e( 'Dimensions', 'apf_plugin' ); echo ' ('.$dimension_unit.')';?></label>
                    <span>
                        <input type="text" class="apf-input apf-input-inner" name="length" id="apf-product-length" placeholder="Length" style="">
                        <input type="text" class="apf-input apf-input-inner" name="width" placeholder="Width">
                        <input type="text" class="apf-input apf-input-inner" name="height" placeholder="Height">
                    </span>
                    <?php
                        apf_print_tooltip($dimension_tootltip);
                    ?>
                </p>
            </div>
            <div class="apf-option-group">
                <p>
                    <?php
                        $shipping_classes = get_terms( array('taxonomy' => 'product_shipping_class', 'hide_empty' => false ) );
                        $shipping_classes_tootltip = __('Shipping classes are used by certain shipping methods to group similar products.', 'apf_plugin');
                    ?>
                    <label for="apf-shipping-class"><?php _e( 'Product shipping class', 'apf_plugin' );?></label>
                    <select id="apf-shipping-class" name="shipping_class">
                        <?php
                            echo '<option value="" selected="selected">-</option>';
                            foreach ($shipping_classes as $shipping_class) {
                                echo '<option value="'. $shipping_class->term_id.'">'.$shipping_class->name.'</option>';
                            }
                        ?>
                    </select>
                    <?php
                        apf_print_tooltip($shipping_classes_tootltip);
                    ?>
                </p>
            </div>
        </div>
        <!-- Linked Products -->
        <div id="apf-linked-products-data" class="apf-option-panel apf-hide-section">
            <div class="apf-option-group">
                <p class="apf-selectize-container">
                    <?php
                        $linked_products =  wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );
                        $upsell_tootltip = __('Upsells are products which you recommend instead of the currently viewed product, for example, products that are more profitable or better quality or more expensive.', 'apf_plugin');
                        $crossell_tootltip = __('Cross-sells are products which you promote in the cart, based on the current product.', 'apf_plugin');
                    ?>
                    <label for="apf-upsell"><?php _e( 'Up-sell', 'apf_plugin' );?></label>
                    <select id="apf-upsell" class="apf-selectize-multiple" name="upsell_ids" multiple>
                        <?php
                            echo '<option value="" selected="selected">-</option>';
                            foreach ($linked_products as $product) {
                                echo '<option value="'.$product->get_id().'">'.$product->get_title().'</option>';
                            }
                        ?>
                    </select>
                    <?php
                        apf_print_tooltip($upsell_tootltip);
                    ?>  
                </p>
                <p class="apf-selectize-container">
                    <label for="apf-crossell"><?php _e( 'Cross-sell', 'apf_plugin' );?></label>
                    <select id="apf-crossell" class="apf-selectize-multiple" name="crossell_ids" multiple>
                        <?php
                            echo '<option value="" selected="selected">-</option>';
                            foreach ($linked_products as $product) {
                                echo '<option value="'.$product->get_id().'">'.$product->get_title().'</option>';
                            }
                        ?>
                    </select>
                    <?php
                        apf_print_tooltip($crossell_tootltip);
                    ?>   
                </p>          
            </div>
        </div>
        <!-- Attributes -->
        <div id="apf-attributes-product-data" class="apf-option-panel apf-hide-section">
            <div class="apf-loader apf-attribute-loader"></div>
            <?php
                require_once( plugin_dir_path( __FILE__ ).'apf-wc-standard-template-product-attributes.php');
            ?>
        </div>
        <!-- Advanced -->
        <div id="apf-advanced-product-data" class="apf-option-panel apf-hide-section">
            <div class="apf-option-group">
                <?php
                    $purchase_note_tootltip = __('Enter an optional note to send the customer after purchase.', 'apf_plugin');
                    $menu_order_tootltip = __('Custom ordering position.', 'apf_plugin');
                ?>
                <p>
                    <label for="apf-purchase-note"><?php _e( 'Purchase note', 'apf_plugin' );?></label> 
                    <textarea class="apf-input apf-input-inner" name="purchase_note" id="apf-purchase-note" placeholder="" rows="2" cols="20"></textarea>
                    <?php
                        apf_print_tooltip($purchase_note_tootltip);
                    ?>        
                </p>      
            </div>
            <div class="apf-option-group">
                <p>
                    <label for="apf-menu-order"><?php _e( 'Menu order', 'apf_plugin' );?></label> 
                    <input type="number" class="apf-input apf-input-inner" name="menu_order" id="apf-menu-order" value="0" step="1" placeholder="">
                    <?php
                        apf_print_tooltip($menu_order_tootltip);
                    ?>   
                </p>      
            </div>
            <div class="apf-option-group">
                <p>
                    <label for="apf-reviews-allowed"><?php _e( 'Reviews allowed', 'apf_plugin' );?></label> 
                    <input type="checkbox" class="apf-input" name="reviews_allowed" id="apf-reviews-allowed" checked="checked">     
                </p>      
            </div>
        </div>
    </div>
</div>