<?php
/**
 * sevdesk
 *
 * Uninstalling Options
 */

// Prevent direct access.
if ( ! ( defined( 'WGM_UNINSTALL_ADD_ONS' ) || defined( 'WP_UNINSTALL_PLUGIN' ) ) ) {
	exit;
}

$all_wordpress_options = wp_load_alloptions();

foreach ( $all_wordpress_options as $option_key => $option_value ) {
	
	if ( substr( $option_key, 0, 23 ) == 'woocommerce_de_sevdesk_' ) {
		delete_option( $option_key );
	}

}
