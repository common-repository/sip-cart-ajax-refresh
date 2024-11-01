<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shopitpress.com/
 * @since             1.0.0
 * @package           Sip_Cart_Ajax_Refresh
 *
 * @wordpress-plugin
 * Plugin Name:       SIP Cart Ajax Refresh
 * Plugin URI:        https://shopitpress.com/plugins/sip-cart-ajax-refresh/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            ShopitPress
 * Author URI:        https://shopitpress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sip-cart-ajax-refresh
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'SIP_CAWC_NAME', 'SIP Cart Ajax Refresh' );
define( 'SIP_CAWC_VERSION', '1.0.1' );
define( 'SIP_CAWC_PLUGIN_SLUG', 'sip-cart-ajax-refresh' );
define( 'SIP_CAWC_BASENAME', plugin_basename( __FILE__ ) );
define( 'SIP_CAWC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'SIP_CAWC_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SIP_CAWC_INCLUDES', SIP_CA_DIR . trailingslashit( 'includes' ) );
define( 'SIP_CAWC_PUBLIC', SIP_CA_DIR . trailingslashit( 'public' ) );
define( 'SIP_CAWC_PLUGIN_PURCHASE_URL', 'https://shopitpress.com/plugins/sip-cart-ajax-refresh/' );
define( 'SIP_CAWC_STORE_URL', 'https://shopitpress.com/' );

GLOBAL $woocommerce;
if ( ! defined('WOOCOMMERCE_CART') ) {
  define( 'WOOCOMMERCE_CART', true );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sip-cart-ajax-refresh-activator.php
 */
function activate_sip_cart_ajax_refresh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sip-cart-ajax-refresh-activator.php';
	Sip_Cart_Ajax_Refresh_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sip-cart-ajax-refresh-deactivator.php
 */
function deactivate_sip_cart_ajax_refresh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sip-cart-ajax-refresh-deactivator.php';
	Sip_Cart_Ajax_Refresh_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sip_cart_ajax_refresh' );
register_deactivation_hook( __FILE__, 'deactivate_sip_cart_ajax_refresh' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sip-cart-ajax-refresh.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sip_cart_ajax_refresh() {

	$plugin = new Sip_Cart_Ajax_Refresh();
	$plugin->run();

}
run_sip_cart_ajax_refresh();