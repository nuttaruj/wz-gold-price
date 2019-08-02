<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://walnutztudio.com
 * @since      1.0.0
 *
 * @package    Wz_gold_price
 * @subpackage Wz_gold_price/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wz_gold_price
 * @subpackage Wz_gold_price/includes
 * @author     WalnutZtudio <walnutztudio@gmail.com>
 */
class Wz_gold_price_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wz_gold_price',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
