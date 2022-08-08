<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once( plugin_dir_path( __FILE__ ) .'inc.php');

?>


<div class="verynsbigboxcontainer">
	<form method="post" action="options.php" enctype="multipart/form-data">
		<?php require_once( plugin_dir_path( __FILE__ ).'ns_settings_custom.php');?>	
		<?php
		if(class_exists( 'WooCommerce' )){
		?>			
			<!-- <p><input type="submit" class="button-primary ns-apf-submit-button" id="submit" name="submit" value="<?php _e('Save Changes', 'apf_plugin') ?>" /></p>			 -->
		<?php
		}
		?>
	</form>
</div>






