<?php
/**
 * Cart Quotation for WooCommerce
 *
 * @package           PluginPackage
 * @author            Digi Maple
 * @copyright         2024 Digi Maple
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Cart Quotation for WooCommerce
 * Plugin URI: https://github.com/digimapleinc/cart-quotation-for-woocommerce/
 * Description: A unique WooCommerce plugin that enables you to send a link of items in the cart so the customer only needs to make a payment for the order.
 * Author: Digi Maple
 * Version: 0.0.1
 * Author URI: https://github.com/digimapleinc/cart-quotation-for-woocommerce/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dmcq
 * Domain Path: /languages
 * Requires PHP: 7.4
 * Requires at least: 5.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'WCQ_FILE', __FILE__ );          // Full path to the main plugin file
define( 'WCQ_DIR', __DIR__ );            // Directory path of the plugin
define( 'WCQ_URL', plugin_dir_url( __FILE__ ) ); // URL to the plugin directory
define( 'WCQ_PATH', plugin_basename( WCQ_FILE ) ); // Path to the plugin relative to the plugins directory
define( 'WCQ_SLUG', dirname( plugin_basename( WCQ_FILE ) ) ); // Plugin slug for use in URLs and other contexts

// Include the Composer autoload file to load dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Include core functions
require_once __DIR__ . '/include/core-functions.php';

// Use necessary classes
use WooQuoteRequest\Initialize;
use WooQuoteRequest\Settings\Utilities;

/**
 * Activation hook callback.
 * Called when the plugin is activated.
 *
 * @return void
 */
function handle_activation() {
	Utilities::handle_activation(); // Call the activation handler in the Utilities class
}

register_activation_hook( WCQ_FILE, 'handle_activation' ); // Register the activation hook

/**
 * Deactivation hook callback.
 * Called when the plugin is deactivated.
 *
 * @return void
 */
function handle_deactivation() {
	Utilities::handle_deactivation(); // Call the deactivation handler in the Utilities class
}

register_deactivation_hook( WCQ_FILE, 'handle_deactivation' ); // Register the deactivation hook

/**
 * Initializes the plugin by setting up necessary actions and filters.
 *
 * @return void
 */
function init_woocommerce_quote_request() {
	$main = new Initialize(); // Create an instance of the Initialize class
	$main->init();           // Call the init method to perform initialization
}

// Hook the initialization function to the 'plugins_loaded' action
add_action( 'plugins_loaded', 'init_woocommerce_quote_request' );
