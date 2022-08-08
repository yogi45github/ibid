<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Custom_import
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_EAP_Field_custom_import' ) ) {
	class SP_EAP_Field_custom_import extends SP_EAP_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		public function render() {
			echo $this->field_before();
			$eap_link = admin_url( 'edit.php?post_type=sp_easy_accordion' );
				echo '<p><input type="file" id="import" accept=".json"></p>';
				echo '<p><button type="button" class="import">Import</button></p>';
				echo '<a id="eap_link_redirect" href="' . $eap_link . '"></a>';
			echo $this->field_after();
		}
	}
}
