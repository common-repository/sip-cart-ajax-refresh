<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://shopitpress.com/
 * @since      1.0.0
 *
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Cart_Ajax_Refresh_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sip-cart-ajax-refresh',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
