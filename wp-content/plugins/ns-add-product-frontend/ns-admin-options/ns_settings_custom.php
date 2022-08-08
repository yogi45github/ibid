<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php 
settings_fields('ns_apf_options_group'); 

/* *** review request in footer *** */
add_filter('admin_footer_text', function() {
    return __('If you like <strong>NS Add Product Frontend</strong> please leave us a <a href="https://wordpress.org/support/plugin/ns-add-product-frontend/reviews/?rate=5#new-pos" target="_blank" class="wc-rating-link" data-rated="Thanks :)">★★★★★</a> rating. A huge thanks in advance!', 'apf_plugin');
}, 9999);	

?>
<div class="apf-backend-container">
	<div class="apf-upper-section-logo">
		<img src="<?php echo plugin_dir_url( __FILE__ ).'img/icon-128x128.png'; ?>">
		<div class="apf-main-title-inner">
			<h2 class="ns-apf-main-title"><?php _e('NS Add Product Frontend', 'apf_plugin'); ?></h2>
			<h2 class="ns-apf-title-description"><?php _e('All the power of Woocommerce on your frontend pages.', 'apf_plugin'); ?></h2>
		</div>
	</div>
</div>

<div class="apf-backend-container">
<?php
if(class_exists( 'WooCommerce' )){
?>
	<div class="apf-backend-title">
		<h2 class="ns-apf-main-title"><?php _e('All ready to go!', 'apf_plugin'); ?></h2>
		<h2 class="ns-apf-title-description"><?php _e('With <b>NS Add product frontend</b> you dont need to waste your time setting up stuff. Just check <b>add-product-frontend</b> page and start to use the plugin!', 'apf_plugin'); ?></h2>
	</div>
</div>

<div class="apf-backend-container">
	<div class="apf-backend-title">
		<h2 class="ns-apf-main-title"><?php _e('A bit of customization', 'apf_plugin'); ?></h2>
		<h2 class="ns-apf-title-description"><?php _e('If you prefer a more customized experience, you can check the below simple options.', 'apf_plugin'); ?></h2>
	</div>
	<div class="apf-backend-body">
		<label style="margin-top: 0px;"><?php _e('NS Add product frontend main page.', 'apf_plugin'); ?></label>
		<select id="apf_plugin_page_id" name="apf_plugin_page_id">
			<option value="">-</option>
			<?php
			$pages = get_pages();
			$val = get_option('apf_plugin_page_id', '');
			foreach ( $pages as $page ) {
				if( $page->post_content == '' ) {
					$selected = '';
					if($page->ID == $val) {
						$selected = 'selected';
					}
					echo '<option value="' .$page->ID.'" '.$selected.' >'.$page->post_title.'</option>';
				}
			}
			?>
		</select>
		<?php apf_print_tooltip(__('You can choose a custom-created empty page to load NS Add product frontend.', 'apf_plugin')); ?>

		<label><?php _e('Product status', 'apf_plugin'); ?></label>
		<select id="apf_plugin_default_product_status" name="apf_plugin_default_product_status">
			<?php
			$val = get_option('apf_plugin_default_product_status', 'publish');
			?>
			<option value="publish" <?php if( $val == 'publish') { echo 'selected'; } ?>>Published</option>
			<option value="draft" <?php if( $val == 'draft') { echo 'selected'; } ?>>Draft</option>	
		</select>
		<?php apf_print_tooltip(__('Set the default status of your newly added product', 'apf_plugin')); ?>
		<?php submit_button(); ?>
	</div>
</div>

<div class="apf-backend-container">
	<div class="apf-backend-title">
		<h2 class="ns-apf-main-title"><?php _e('Need more? Go Premium!', 'apf_plugin'); ?></h2>
		<h2 class="ns-apf-title-description"><?php _e('<b>NS Add product frontend</b> has an entirely renewed premium version full of contents and constantly updated. Check it ', 'apf_plugin'); ?> 
			<a href="https://www.nsthemes.com/product/frontend-add-product/?ref-ns=2&campaign=APF-linkpremium"><?php _e('here', 'apf_plugin'); ?></a>.
		</h2>
	</div>
	<div class="apf-backend-body">
		<h2><?php _e('Some Premium features you may be interested in: ', 'apf_plugin'); ?></h2>
		<ul>
			<li> <?php _e('Restricted access to only Shop Manager role', 'apf_plugin'); ?></li>
			<li> <?php _e('Allows you to choose <b>Simple (virtual / downloadable)</b> and <b>Variable</b> products', 'apf_plugin'); ?></li>
			<li> <?php _e('You dont need all the product attributes? Just select the ones you want for your frontend page!', 'apf_plugin'); ?></li>
			<li> <?php _e('Allows you to delete selected products', 'apf_plugin'); ?> </li>
			<li> <?php _e('Allows you to edit Product from dedicated page', 'apf_plugin'); ?></li>
			<li> <?php _e('Allows you to view Vendor product list (when click on Vendor name, you will see an “archive page” with all his products)', 'apf_plugin'); ?> </li>
		</ul>
	</div>
</div>

<?php
}
else{
?>
	<div class="ns-apf-option-container" style='width: calc(100% - 50px);'>
		<h3>Woocommerce is not installed!</h3>
		<p>NS Add Product Frontend plugin needs <b class="ns-rac-wc-warning">Woocommerce 3.0</b> or later versions to work!</p>
	</div>
<?php
}
?>
