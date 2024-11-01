<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://shopitpress.com/
 * @since      1.0.0
 *
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/includes
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Cart_Ajax_Refresh_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option( 'sip_version_value' );
	}

}
