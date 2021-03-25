<?php
/**
 * Plugin Name: WP Ultimo Plesk Gateway
 * Version: 1.0.0
 * Plugin URI: https://superlatif.io
 * Description: Plesk gateway for WP Ultimo domain mapping.
 * Author: Superlatif
 * Author URI: https://superlatif.io
 * Requires at least: 5.0
 * Tested up to: 5.7
 *
 * Text Domain: wp-ultimo-plesk-gateway
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Superlatif
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load plugin class files.
require_once 'includes/class-wp-ultimo-plesk-gateway.php';
require_once 'includes/class-wp-ultimo-plesk-gateway-settings.php';

// Load plugin libraries.
require_once 'includes/lib/class-wp-ultimo-plesk-gateway-admin-api.php';
require_once 'includes/lib/class-wp-ultimo-plesk-gateway-admin-action.php';

/**
 * Returns the main instance of WP_Ultimo_Plesk_Gateway to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WP_Ultimo_Plesk_Gateway
 */
function wp_ultimo_plesk_gateway() {
	$instance = WP_Ultimo_Plesk_Gateway::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = WP_Ultimo_Plesk_Gateway_Settings::instance( $instance );
	}

	return $instance;
}

wp_ultimo_plesk_gateway();

new WP_Ultimo_Plesk_Gateway_Admin_Action();