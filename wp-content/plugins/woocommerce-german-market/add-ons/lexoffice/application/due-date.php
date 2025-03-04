<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

/**
* init actions and hooks needed for the due date
*
* wp-hook init
* @return void
*/
function lexoffice_woocommerce_due_date_init(){
	
	// return if WooCommerce is not active
	if ( ! function_exists( 'WC' ) ) {
		return;
	}

	if ( ! ( isset( $_REQUEST[ 'page' ] ) && $_REQUEST[ 'page' ] == 'wc-settings' && isset( $_REQUEST[ 'tab' ] ) && $_REQUEST[ 'tab' ] == 'checkout' && isset( $_REQUEST[ 'section' ] ) ) ) {
		return;
	}

	// add filter for eacht payment gateway
	foreach ( WC()->payment_gateways()->get_payment_gateway_ids() as $gateway_id ) {
		add_filter( 'woocommerce_settings_api_form_fields_' . $gateway_id, 'lexoffice_woocommerce_due_date_settings_field' );
	}

}

/**
* add "Due Date for Lexoffice" to gateway settings
*
* wp-hook woocommerce_settings_api_form_fields_ . {gateway_id}
* @param Array $settings
* @return Array
*/
function lexoffice_woocommerce_due_date_settings_field( $settings ) {

	// get defaults
	$current_filter = current_filter();
	$current_payment_gateway = str_replace( 'woocommerce_settings_api_form_fields_', '', $current_filter );

	if ( $current_payment_gateway == 'bacs' ) {
		$default = 10;
	} else if ( $current_payment_gateway == 'cheque' ) {
		$default = 14;
	} else if ( $current_payment_gateway == 'paypal' ) {
		$default = 0;
	} else if ( $current_payment_gateway == 'cash_on_delivery' ) {
		$default = 7;
	} else if ( $current_payment_gateway == 'german_market_purchase_on_account' ) {
		$default = 30;
	} else {
		$default = 0;
	}	

	$default = apply_filters( 'lexoffice_woocomerce_due_date_default', $default, $current_payment_gateway );

	$settings[ 'lexoffice_due_date_title' ] = array(
		'title' 		=> __( 'Due Date', 'woocommerce-german-market' ),
		'type' 			=> 'title',
		'default'		=> '',
	);

	$settings[ 'lexoffice_due_date' ] = array(

			'title'				=> __( 'Due Date for Lexware Office', 'woocommerce-german-market' ),
			'type'				=> 'number',
			'custom_attributes' => array(
									'min'  => 0
									),
			'default' 			=> $default,
			'description'		=> __( 'Enter a number of days that, beginning from the date of your order, determine the due date. If you leave this field free or enter 0, the due date will be the date of your order.', 'woocommerce-german-market' ),
			'desc_tip'			=> false

	);

	if ( 'on' === get_option( 'wgm_add_on_lexoffice', 'off' ) && 'invoice' === get_option( 'woocommerce_de_lexoffice_voucher_or_invoice', 'voucher' ) ) {

		$placeholders = apply_filters( 'wp_wc_invoice_pdf_custom_payment_info_placeholders', array(
				__( 'Order Date', 'woocommerce-german-market' ) => '{{order-date}}',
				__( 'Order Total', 'woocommerce-german-market' ) => '{{order-total}}',
				__( 'Due Date', 'woocommerce-german-market' ) => '{{due-date}}',
				__( 'Days', 'woocommerce-german-market' ) => '{{days}}',
			) );

			$placeholders_string = '';
			foreach ( $placeholders as $label => $code ) {
				if ( ! empty( $placeholders_string ) ) {
					$placeholders_string .= ', ';
				}
				$placeholders_string .= $label . ' - ' . '<code>' . $code . '</code>';
			}

		$settings[ 'lexoffice_due_date_invoice_notice' ] = array(

			'title'				=> __( 'Payment condition text for Lexware Office invoice', 'woocommerce-german-market' ),
			'type'				=> 'textarea',
			'default' 			=> '',
			'description'		=> __( 'You can use the following placeholders:', 'woocommerce-german-market' ) . ' ' . $placeholders_string,
			'desc_tip'			=> false

		);
	}

	return $settings;
}
