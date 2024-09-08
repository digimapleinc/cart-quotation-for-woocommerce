<?php

namespace WooQuoteRequest\QuoteRequest;

/**
 * Class Main
 *
 * Handles the core functionality for managing quotations in WooCommerce. This includes
 * initializing shortcodes, processing quotations, managing cart actions, and handling
 * AJAX requests related to quotations.
 *
 * @package WooQuoteRequest\QuoteRequest
 */
class Session {


	/**
	 * Generates a unique customer ID for the quotation session.
	 *
	 * @return string The generated customer ID.
	 */
	public static function wcq_generate_customer_id() {

		// @phpstan-ignore-next-line
		$hasher  = generate_quote_hash( 8, false );
		$user_id = get_current_user_id() ?? 'q';
		return $user_id . '_' . substr( md5( $hasher->get_random_bytes( 32 ) ), 2 );
	}

	/**
	 * Saves the quotation data as a custom session in the database.
	 *
	 * @param array  $cart_data An array of cart data items.
	 * @param string $_customer_id The customer ID associated with the quotation.
	 * @return string|false The quotation token if successful, false otherwise.
	 */
	public static function wcq_save_session_as_quotation( $cart_data, $_customer_id ) {
		global $wpdb;

		$_table = $GLOBALS['wpdb']->prefix . 'woocommerce_sessions';

		$_session_expiration = time() + intval( apply_filters( 'wc_session_expiration', 60 * 60 * 360 ) ); // 15 days

		$data = $wpdb->query(
			$wpdb->prepare(
				"INSERT INTO $_table (`session_key`, `session_value`, `session_expiry`) VALUES (%s, %s, %d)
                ON DUPLICATE KEY UPDATE `session_value` = VALUES(`session_value`), `session_expiry` = VALUES(`session_expiry`)",
				$_customer_id,
				maybe_serialize( $cart_data ),
				$_session_expiration
			)
		);

		if ( $data ) {
			return $_customer_id;
		} else {
			return false;
		}
	}

	/**
	 * Retrieves a session from the database based on the customer ID.
	 *
	 * @param string $customer_id The customer ID associated with the session.
	 *
	 * @return mixed The session data if found, false otherwise.
	 */
	public static function wcq_get_session( $customer_id ) {
		global $wpdb;
		$value = false;

		if ( $customer_id ) {
			$_table = $GLOBALS['wpdb']->prefix . 'woocommerce_sessions';
			$value = $wpdb->get_var($wpdb->prepare("SELECT session_value FROM $_table WHERE session_key = %s", $customer_id)); // @codingStandardsIgnoreLine.
		}

		return maybe_unserialize( $value );
	}

	/**
	 * Deletes a session from the database.
	 *
	 * @param string $customer_id The customer ID associated with the session to delete.
	 *
	 * @return void
	 */
	public static function wcq_delete_session( $customer_id ) {
		global $wpdb;

		$_table = $GLOBALS['wpdb']->prefix . 'woocommerce_sessions';

		$wpdb->delete(
			$_table,
			[
				'session_key' => $customer_id,
			]
		);
	}
}
