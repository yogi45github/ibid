<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://modeltheme.com
 * @since      1.0.0
 *
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mt_Freelancer_Mode
 * @subpackage Mt_Freelancer_Mode/includes
 * @author     ModelTheme <support@modeltheme.com>
 */
class Mt_Freelancer_Mode_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mt-freelancer-mode',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
