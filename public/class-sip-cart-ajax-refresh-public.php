<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://shopitpress.com/
 * @since      1.0.0
 *
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sip_Cart_Ajax_Refresh
 * @subpackage Sip_Cart_Ajax_Refresh/public
 * @author     ShopitPress <hello@shopitpress.com>
 */
class Sip_Cart_Ajax_Refresh_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'woocommerce_cart_updated', array( $this, 'sip_ac_update') );
		add_filter( 'woocommerce_cart_item_class', array( $this, 'sip_ca_filter_woocommerce_cart_item_class'), 10, 3 );
		add_filter( 'woocommerce_cart_item_subtotal', array( $this, 'sip_ca_filter_woocommerce_cart_item_subtotal'), 10, 3 );
		add_filter( 'woocommerce_checkout_cart_item_quantity', array( $this, 'sip_ca_filter_woocommerce_checkout_cart_item_quantity'), 10, 3 );
		add_action( 'woocommerce_before_cart_table', array( $this, 'sip_ac_cart_table') );

	}

	/**
	 * Define the woocommerce_cart_updated callback.
	 *
	 * @since    1.0.0
	 */ 
	function sip_ac_update() {
	

		if ( !empty($_POST['is_wac_ajax'])) {
			$resp = array();
			$resp['update_label'] = __( 'Update Cart', 'woocommerce' );
			$resp['checkout_label'] = __( 'Proceed to Checkout', 'woocommerce' );
			$resp['price'] = 0;

			// render the cart totals (cart-totals.php)
			ob_start();
			do_action( 'woocommerce_after_cart_table' );
			do_action( 'woocommerce_cart_collaterals' );
			do_action( 'woocommerce_after_cart' );
			$resp['html'] = ob_get_clean();
			$resp['price'] = 0;
			$resp['sip_ca_url'] = SIP_CAWC_URL . "public/partials/";
			$resp['path'] = ABSPATH;

			// calculate the item price
			if ( !empty($_POST['cart_item_key']) ) {
				$items = WC()->cart->get_cart();
				$cart_item_key = $_POST['cart_item_key'];
				$resp['cart_item_key'] = $cart_item_key;

				if ( array_key_exists($cart_item_key, $items)) {
					$cart_item = $items[$cart_item_key];
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$price = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
					$resp['price'] = $price;
				}
			}

			echo json_encode($resp);
			exit;
		}
	}


	/**
	 * Define the woocommerce_checkout_cart_item_quantity callback.
	 *
	 * @since    1.0.0
	 */ 
	function sip_ca_filter_woocommerce_checkout_cart_item_quantity( $strong_class_product_quantity_sprintf_times_s_cart_item_quantity__strong, $cart_item, $cart_item_key ) { 

		$str = strip_tags($strong_class_product_quantity_sprintf_times_s_cart_item_quantity__strong);
		$str = preg_replace('/\D/', '', $str);
		return '<span class="product-quantity">Quantity: <span class="'.$cart_item_key.'-quantity">'.$str.'</span></span>';
	}


	/**
	 * Working to change the value of sub total.
	 * Define the woocommerce_cart_item_subtotal callback.
	 *
	 * @since    1.0.0
	 */
	function sip_ca_filter_woocommerce_cart_item_subtotal( $wc, $cart_item, $cart_item_key ) {    

		return '<span class="woocommerce-Price-amount amount '.$cart_item_key.'-price"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span><span class="">'.number_format((float)$cart_item['data']->get_price()*$cart_item['quantity'], 2, '.', '').'</span></span>';
	}

	/**
	 * Define the woocommerce_cart_item_class callback.
	 *
	 * @since    1.0.0
	 */ 
	function sip_ca_filter_woocommerce_cart_item_class( $cart_item, $cart_items, $cart_item_key ) { 

		return $cart_item . " " . $cart_item_key.'-item' ; 
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sip-cart-ajax-refresh-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sip-cart-ajax-refresh-public.js', array( 'jquery' ), $this->version, true );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function sip_ac_cart_table() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sip-cart-ajax-refresh-public.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name );
	}
}
