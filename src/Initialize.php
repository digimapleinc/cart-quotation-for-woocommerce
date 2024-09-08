<?php

namespace WooQuoteRequest;

use WooQuoteRequest\QuoteRequest\FrontEnd;
use WooQuoteRequest\Settings\Administration;
use WooQuoteRequest\Settings\Assets;

/**
 * Class Initialize
 *
 * Initializes the plugin components and their settings.
 *
 * This class is responsible for setting up and initializing various components of the plugin.
 * It calls the initialization methods for assets, administration settings, and the main quote request functionality.
 *
 * @package WooQuoteRequest
 */
class Initialize {



	/**
	 * Initializes the plugin components.
	 *
	 * This method is called to set up the essential components of the plugin.
	 * It performs the following actions:
	 * - Initializes assets management (e.g., styles, scripts).
	 * - Initializes the administration settings (e.g., settings pages, options).
	 * - Initializes the core quote request functionality.
	 *
	 * @return void
	 */
	public static function init() {
		// Initialize plugin assets such as scripts and styles
		Assets::initialize();

		// Initialize administration settings including settings pages and options
		Administration::initialize();

		// Initialize the FrontEnd quote request functionality
		FrontEnd::initialize();
	}
}
