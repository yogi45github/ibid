<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_EAP_Field_icon' ) ) {
	class SP_EAP_Field_icon extends SP_EAP_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'button_title' => esc_html__( 'Add Icon', 'easy-accordion-pro' ),
					'remove_title' => esc_html__( 'Remove Icon', 'easy-accordion-pro' ),
				)
			);

			echo $this->field_before();

			$nonce  = wp_create_nonce( 'eapro_icon_nonce' );
			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="eapro-icon-select">';
			echo '<span class="eapro-icon-preview' . esc_attr( $hidden ) . '"><i class="' . esc_attr( $this->value ) . '"></i></span>';
			echo '<a href="#" class="button button-primary eapro-icon-add" data-nonce="' . esc_attr( $nonce ) . '">' . wp_kses_post( $args['button_title'] ) . '</a>';
		//	echo '<a href="#" class="button eapro-warning-primary eapro-icon-remove' . esc_attr( $hidden ) . '">' . wp_kses_post( $args['remove_title'] ) . '</a>';
			// echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" class="eapro-icon-value"' . $this->field_attributes() . ' />';
			echo '</div>';

			echo $this->field_after();

		}

	}
}
