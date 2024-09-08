<?php

function generate_quote_hash() {
	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, false );
	return $hasher;
}
