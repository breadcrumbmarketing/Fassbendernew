<?php

/**
 * Class WGM_Manual_Order_Confirmation
 *
 * German Market Userinterface
 *
 * @author MarketPress
 */
class WGM_Manual_Order_Confirmation {

	/**
	 * @var WGM_Manual_Order_Confirmation
	 * @since v3.2
	 */
	private static $instance = null;
	
	/**
	* Singletone get_instance
	*
	* @static
	* @return WGM_Compatibilities
	*/
	public static function get_instance() {
		if ( self::$instance == NULL) {
			self::$instance = new WGM_Manual_Order_Confirmation();	
		}
		return self::$instance;
	}

	/**
	* Singletone constructor
	*
	* @access private
	*/
	private function __construct() {

		if ( get_option( 'woocommerce_de_manual_order_confirmation' ) == 'on' ) {

			// Order Status has to be 'on-hold'
			add_filter( 'woocommerce_create_order', array( $this, 'set_order_status' ), 100, 2 );

			// Do not show payment information to customer
			add_action( 'woocommerce_before_template_part', array( $this, 'disable_payment_info' ), 1, 4 );

			// Remove Redirecting for payment
			add_action( 'woocommerce_checkout_order_processed', array( $this, 'remove_redirect' ), 10, 3 );
			
			add_filter( 'woocommerce_order_needs_payment', array( $this, 'order_needs_payment_checkout_block' ), 10, 3 );

			add_filter( 'woocommerce_payment_complete_order_status', array( $this, 'set_payment_complete_order_status_checkout_block' ), 10, 3 );

			// Confirm Order E-Mail
			add_action( 'woocommerce_email_before_order_table', array( $this, 'woocommerce_email_before_order_table_confirm' ), 0, 3 );

			// Remove other payment gateways
			add_filter( 'woocommerce_available_payment_gateways', array( $this, 'woocommerce_available_payment_gateways' ) );

			// Send Admin Email
			add_action( 'woocommerce_checkout_order_created', array( $this, 'send_admin_email' ), 10, 1 );

			// Don't send Admin E-Mails again
			add_filter( 'woocommerce_email_enabled_new_order', array( $this, 'dont_send_admin_email_again' ), 10, 3 );

			// View Order
			add_action( 'woocommerce_view_order', array( $this, 'view_order_info' ), 1 );

			// My Account Actions
			add_filter( 'woocommerce_my_account_my_orders_actions', array( $this, 'my_account_actions' ), 10, 2 );

			// Thank You Page
			add_filter( 'woocommerce_thankyou_order_received_text', array( $this, 'thankyou_order_received_text' ), 20, 2 );

			add_action( 'woocommerce_review_order_before_payment', array( $this, 'no_payment_info_checkout' ) );

			if ( is_admin() ) {

				// Dont show PDF Download Buttons if order ist not confirmed
				add_filter( 'german_market_backend_show_pdf_download_button', array( $this, 'backend_show_pdf_download_button' ), 10, 3 );

				// Small notice if order is not confirmed yet
				add_action( 'admin_init', function() {
					add_action( WGM_Hpos::get_hook_manage_shop_order_custom_column(), array( $this, 'admin_confirmation_notice' ), 100, 2 );
				});
				

				// Admin Order Action (new icon to conirm order)
 				add_filter( 'woocommerce_admin_order_actions', array( $this, 'admin_icon_confirm' ), 100, 2 ); 

 				// Add the aciton for woocommerce_admin_order_actions
 				add_filter( 'wp_ajax_german_market_manual_order_confirmation', array( __CLASS__, 'admin_icon_confirm_action' ) );

 				// Order Confirmation button next to "save" button
 				add_action( 'woocommerce_order_actions_end', array( $this, 'woocommerce_order_actions_end_confirm_button' ) );

 				add_action( 'admin_init', function() {
					add_action( WGM_Hpos::get_hook_for_order_bulk_actions(), array( __CLASS__ , 'add_bulk_actions' ), 10 );
					add_action( WGM_Hpos::get_hook_for_order_handle_bulk_actions(), array( __CLASS__, 'bulk_action' ), 10, 3 );
				});

			}

			////////
			// Exception Handling if Manual Order Confirmation is activated
			////////

			// remove additional sepa fields from checkout
			add_filter( 'gm_sepa_fields_in_checkout', array( $this, 'sepa_fields_in_checkout' ) );

			// add notice in checkout
			add_filter( 'gm_sepa_description_in_checkout', array( $this, 'sepa_description_in_checkout' ) );

			// no sepa mandate checkbox in checkout
			add_filter( 'gm_sepa_checkout_field_checkbox', array( $this, 'sepa_checkout_field_checkbox' ) );

			// do not send sepa mandate yet
			add_filter( 'gm_sepa_send_sepa_email', array( $this, 'sepa_send_sepa_email' ) );

			////////
			// maniuplate whatever you want
			////////
			do_action( 'wgm_manual_order_confirmation_after_construct', $this );

		}

	}

	/**
	* Show info when no payment methods are available
	*
	* @since 3.20
	* @wp-hook woocommerce_review_order_before_payment
	* @return Since
	**/
	public function no_payment_info_checkout() {

		if ( get_option( 'woocommerce_de_manual_order_confirmation_payment_methods_only_pay_order', 'on' ) === 'on' ) {

			$text = get_option( 'woocommerce_de_manual_order_confirmation_payment_methods_hint_text', __( 'There are no payment methods available on the checkout page. Your order will be checked manually. If the order is accepted, you will receive an email with a link to pay for the order. There you can choose a payment method.', 'woocommerce-german-market' ) );

			echo '<div class="german-market-manual-order-confirmation-hint-text">' . wpautop( esc_attr( $text ) ) . '</div>';

		}
	}

	/**
	* Dont show "Pay" and "Cancel on My-Account Page"
	*
	* @wp-hook woocommerce_my_account_my_orders_actions
	* @param Array $actions
	* @param WC_Order $order
	* @return Array
	**/
	function my_account_actions( $actions, $order ) {

		if ( is_object( $order ) && method_exists( $order, 'get_meta' ) ) {
			if ( 'yes' === $order->get_meta( '_gm_needs_conirmation' )  ) {

				if ( isset( $actions[ 'pay' ] ) ) {
					unset( $actions[ 'pay' ] );
				}

				if ( isset( $actions[ 'cancel' ] ) ) {
					unset( $actions[ 'cancel' ] );
				}

			}
		}

		return $actions;
	}

	/**
	* Dont show PDF Download Buttons if order ist not confirmed
	*
	* @wp-hook german_market_backend_show_pdf_download_button
	* @param Boolean $boolean
	* @param String $pdf_document
	* @param Integer $post_id
	* @return boolean
	**/
	function backend_show_pdf_download_button( $boolean, $pdf_document, $order_id ) {
		
		$order = wc_get_order( $order_id );
		if ( is_object( $order ) && method_exists( $order, 'get_meta' ) ) {
			$boolean = 'yes' !== $order->get_meta( '_gm_needs_conirmation' );
		}

		return $boolean;
	}

	/**
	* SEPA: do not send sepa mandate yet
	*
	* @wp-hook gm_sepa_send_sepa_email
	* @param Boolean $rtn
	* @return rtn
	**/
	function sepa_send_sepa_email( $rtn ) {

		if ( ! is_wc_endpoint_url( 'order-pay' ) ) {
			$rtn = false;
		}

		return $rtn;

	}

	/**
	* SEPA: no sepa mandate checkbox in checkout
	*
	* @wp-hook gm_sepa_checkout_field_checkbox
	* @param Boolean $rtn
	* @return rtn
	**/
	function sepa_checkout_field_checkbox( $rtn ) {

		if ( ! is_wc_endpoint_url( 'order-pay' ) ) {
			$rtn = true;
		}

		return $rtn;
	}

	/**
	* SEPA: Payment Method Descrition
	*
	* @wp-hook gm_sepa_description_in_checkout
	* @param String $description
	* @return String
	**/
	function sepa_description_in_checkout( $description ) {

		if ( is_add_payment_method_page() ) {
			return $description;
		}

		if ( ! is_wc_endpoint_url( 'order-pay' ) ) {
			
			if ( trim( $description ) != '' ) {
				$description .= '<br />';
			}

			$notice = apply_filters( 'gm_manual_order_confirmation_description_notice_sepa', __( 'Your order must be confirmed manually. You enter your SEPA data after the manual confirmation.', 'woocommerce-german-market' ) );
			$description .= $notice;

		}

		return $description;

	}

	/**
	* SEPA: No checkout fields in checkout
	*
	* @wp-hook gm_sepa_fields_in_checkout
	* @param Array $fields
	* @return Array
	**/
	function sepa_fields_in_checkout( $fields ) {

		if ( is_admin() ) {
			return $fields;
		}

		if ( is_add_payment_method_page() ) {
			return $fields;
		}
		
		if ( ! is_wc_endpoint_url( 'order-pay' ) ) {
			return array();
		}

		return $fields;
	}

	/**
	* Send Admin Email New Order
	*
	* @access public
	* @wp-hook woocommerce_checkout_order_created
	* @param WC_Order $order
	* @return void
	*/
	public function send_admin_email( $order ) {
		
		if ( WGM_Helper::method_exists( $order, 'get_id' ) ) {
			$order_id = $order->get_id();

			do_action( 'wgm_manual_order_confirmation_send_admin_emails', $order_id );

			$mailer = WC()->mailer();
			$mails = $mailer->get_emails();
			
			if ( ! empty( $mails ) ) {
			    foreach ( $mails as $mail ) {
			        if ( 'new_order' === $mail->id ) {
			           $mail->trigger( $order_id );
			           $order->update_meta_data( '_german_market_manual_order_confirmation_send_to_admin', 'yes' );
			           $order->save_meta_data();
			           return;
			        }
			     }
			}
		}
	}

	/**
	* Prevent that the admin email is send
	*
	* @access public
	* @wp-hook woocommerce_checkout_update_order_meta
	* @param Integer $order_id
	* @return Integer
	*/
	function dont_send_admin_email_again( $boolean, $order, $mail_object ) {

		if ( WGM_Helper::method_exists( $order, 'get_meta' ) ) {

			if ( 'yes' === $order->get_meta( '_german_market_manual_order_confirmation_send_to_admin' ) ) {
				$boolean = false;
				$order->delete_meta_data( '_german_market_manual_order_confirmation_send_to_admin' );
				$order->save_meta_data();
			}
			
		}

		return $boolean;
	}

	/**
	* Order Status has to be 'on-hold'
	*
	* @access public
	* @wp-hook woocommerce_create_order
	* @param Integer $order_id
	* @return Integer
	*/
	public function set_order_status( $order_id, $instance ) {
		add_filter( 'woocommerce_default_order_status', array( $this, 'return_order_status' ) );
		return $order_id;
	}

	/**
	* Order Status has to be 'on-hold'
	*
	* @access public
	* @wp-hook woocommerce_default_order_status
	* @param String $status
	* @return String
	*/
	public function return_order_status( $status ) {
		return 'pending';
	}

	/**
	* Do not show payment information to customer
	*
	* @access public
	* @wp-hook woocommerce_before_template_part
	* @param String $template_name
	* @param String $template_path
	* @param String $located
	* @param Array $args
	* @return void
	*/
	public function disable_payment_info( $template_name, $template_path, $located, $args ) {
		
		if ( $template_name == 'checkout/thankyou.php' ) {
			
			if ( isset( $args[ 'order' ] ) ) {
				
				$order = $args[ 'order' ];
				if ( ! self::confirmation_needed( $order ) ) {
					return;
				}

			}

			$gateways = WC()->payment_gateways()->payment_gateways();

			foreach ( $gateways as $key => $method ) {
				remove_all_actions( 'woocommerce_thankyou_' . $key );
			}

		}
	}

	/**
	* Remove Redirecting for payment and set post_meta '_gm_needs_conirmation' to 'yes'
	*
	* wp-hook woocommerce_checkout_order_processed 
	* @param Integer $order_id
	* @param Array $posted_data
	* @param WC_Order $order
	* @return void
	*/
	public function remove_redirect( $order_id, $posted_data, $order ) {

		$order->update_meta_data( '_gm_needs_conirmation', 'yes' );
		$order->save_meta_data();
		
		if ( ! apply_filters( 'gm_manual_order_confirmation_reduce_stock_level_after_manual_confirmation', true ) ) {
			wc_reduce_stock_levels( $order_id );
		}
		
		add_filter( 'woocommerce_cart_needs_payment', '__return_false' );
		add_filter( 'woocommerce_order_needs_payment', '__return_false' );
		add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', array( $this, 'no_payment' ), 100 );
	}

	/**
	 * Set needs payment to false for checkout block
	 * 
	 * @wp-hook woocommerce_order_needs_payment
	 * @param bool $needs_payment
	 * @param WC_Order $order
	 * @param Array valid_order_statuses
	 * @return bool
	 */
	public function order_needs_payment_checkout_block( $needs_payment, $order, $valid_order_statuses ) {

		if ( 'checkout-draft' === $order->get_status() ) {
			$needs_payment = false;

			$order->update_meta_data( '_gm_needs_conirmation', 'yes' );
			$order->save_meta_data();

			if ( ! apply_filters( 'gm_manual_order_confirmation_reduce_stock_level_after_manual_confirmation', true ) ) {
				wc_reduce_stock_levels( $order_id );
			}
		}

		return $needs_payment;
	}

	/**
	 * Set prder status to pending when checkout block is used
	 * 
	 * @wp-hook woocommerce_payment_complete_order_status
	 * @param string $status
	 * @param integer $order_id
	 * @param WC_Order order
	 * @return string
	 */
	public function set_payment_complete_order_status_checkout_block ( $status, $order_id, $order ) {

		if ( 'yes' === $order->get_meta( '_gm_needs_conirmation' ) ) {
			$status = 'pending';
		}
		
		return $status;
	}

	/**
	* No Payment
	*
	* @access public
	* wp-hook woocommerce_valid_order_statuses_for_payment_complete
	* @param Array $stati
	* @return Array
	*/
	public function no_payment( $stati ) {
		return array();
	}

	/**
	* Don'ty show any other information in order confirmation email
	*
	* @access public
	* wp-hook woocommerce_email_before_order_table
	* @param WC_Order $order
	* @param Boolean $sent_to_admin
	* @param Boolean $plain_text
	* @return void
	*/
	public function woocommerce_email_before_order_table_confirm( $order, $sent_to_admin, $plain_text ) {

		if ( self::confirmation_needed( $order ) ) {
			
			if ( 'cancelled' !== $order->get_status() ) {

				$text = apply_filters( 'gm_manual_order_confirmation_notice_in_email', __( 'Your order will be manually checked. You will get another email after your order has been confirmed.', 'woocommerce-german-market' ) );

				if ( $plain_text ) {
					echo $text . "\n\n";
				} else {
					echo '<p>' . $text . '</p>';
				}

				remove_all_actions( 'woocommerce_email_before_order_table' );
			}
		}
	}

	/**
	* Add a small confirmation notice to admin order table if order is not confirmed
	*
	* @access public
	* @wp-hook manage_shop_order_posts_custom_column
	* @param String Column
	* @return void
	*/
	public function admin_confirmation_notice( $column, $post_id_or_order_object ) {
		
		if ( ! ( is_object( $post_id_or_order_object ) && method_exists( $post_id_or_order_object, 'get_meta' ) ) ) {
			$the_order = wc_get_order( $post_id_or_order_object );
		} else {
			$the_order = $post_id_or_order_object;
		}

		switch ( $column ) {
			
			case 'order_status' :

				if ( self::confirmation_needed( $the_order ) ) {
					echo '<br /><small class="gm-manual-confirmation-notice">' . __( 'Not confirmed', 'woocommerce-german-market' ) . '</small>';
				}
			
			break;
		}

	}

	/**
	* Remove all payment gateways but that one that customer has chosen during checkout
	*
	* @access public
	* @wp-hook woocommerce_available_payment_gateways
	* @param Array gateways
	* @return Array
	*/
	public function woocommerce_available_payment_gateways( $gateways ) {

		if ( is_wc_endpoint_url( 'order-pay' ) ) {
			
			if ( get_option( 'woocommerce_de_manual_order_confirmation_payment_methods_only_pay_order', 'on' ) === 'off' ) {

				// get order
				global $wp;
		    	$order_id = $wp->query_vars[ 'order-pay' ];
		    	$order = wc_get_order( $order_id );

		    	if ( 'confirmed' === $order->get_meta( '_gm_needs_conirmation' ) ) {
		    		
		    		$payment_method = $order->get_payment_method();

		    		foreach ( $gateways as $key => $gateway ) {
		    			
		    			if ( $key != $payment_method ) {
		    				unset( $gateways[ $key ] );
		    			}
		    		}

		    	}

		    }

	    } else {

	    	if ( get_option( 'woocommerce_de_manual_order_confirmation_payment_methods_only_pay_order', 'on' ) === 'on' ) {
		    	add_filter( 'woocommerce_cart_needs_payment', '__return_false' );
		    	$gateways = array();
		    }

	    }

		return $gateways;
	}

	/**
	* Admin Order Action (new icon to conirm order)
	*
	* @access public
	* @wp-hook woocommerce_admin_order_actions
	* @param Array $actions
	* @param WC_Order $order
	* @return Array
	*/	
	public function admin_icon_confirm( $actions, $order ) {

		if ( self::confirmation_needed( $order ) ) {
			
			// unset all other actions
			$actions = array();

			$actions[ 'manual-order-confirmation' ] = array(
				'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=german_market_manual_order_confirmation&order_id=' . $order->get_id() ), 'german-market-manual-order-confirmation' ),
				'name'      => __( 'Manual order confirmation', 'woocommerce-german-market' ),
				'action'    => 'manual-order-confirmation'
			);

		}

		return $actions;

	}

	/**
	* Order Confirmation button next to "save" button
	*
	* @access public
	* @wp-hook woocommerce_order_actions_end
	* @param Integer $order_id
	* @return void
	*/	
	public function woocommerce_order_actions_end_confirm_button( $order_id ) {

		if ( self::confirmation_needed( $order_id ) ) { ?>
			
			<li style="width: 100%">
				<a class="button button-primary" style="float: right;" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=german_market_manual_order_confirmation&order_id=' . $order_id ), 'german-market-manual-order-confirmation' ); ?>" ><?php echo __( 'Manual Order Confirmation', 'woocommerce-german-market' ); ?></a>
			</li>
			
		<?php }

	}

	/**
	* add bulk action
	*
	* @access public
	* @static 
	* @hook WGM_Hpos::get_hook_for_order_bulk_actions()
	* @param Array $actions
	* @return Array
	*/
	public static function add_bulk_actions( $actions ) {
		$actions[ 'gm_manual_order_confirmation' ] = __( 'Manual Order Confirmation', 'woocommerce-german-market' );
		return $actions;
	}

	/**
	* do bulk action
	*
	* @access public
	* @static 
	* @hook WGM_Hpos::get_hook_for_order_handle_bulk_actions()
	* @param String $redirect_to
	* @param String $action
	* @param Array $order_ids
	* @return String
	*/
	public static function bulk_action( $redirect_to, $action, $order_ids ) {

		if ( empty( $order_ids ) ) {
			return $redirect_to;
		}

		// return if it's not the zip download action
		if ( 'gm_manual_order_confirmation' === $action ) {
			
			foreach ( $order_ids as $order_id ) {
				self::confirm( $order_id );
			}

			do_action( 'gm_manual_order_confirmation_after_bulk_action' );
		}

		return $redirect_to;
	}

	/**
	* Ajax Action to confirm order
	*
	* @access public
	* @static
	* @hook wp_ajax_german_market_manual_order_confirmation
	* @return void
	*/
	public static function admin_icon_confirm_action() {

		if ( ! check_ajax_referer( 'german-market-manual-order-confirmation', 'security', false ) ) {
			wp_die( __( 'You have taken too long. Please go back and retry.', 'woocommerce-german-market' ), '', array( 'response' => 403 ) );
		}

		$order_id = isset( $_REQUEST[ 'order_id' ] ) ? $_REQUEST[ 'order_id' ] : null;

		if ( $order_id ) {
			self::confirm( $order_id );
		}

		wp_safe_redirect( wp_get_referer() );

		exit();

	}

	/**
	* Returns true if post meta '_gm_needs_conirmation' is set to 'yes'
	*
	* @access public
	* @static
	* @param WC_Order || Integer $order
	* @return Boolean
	*/
	public static function confirmation_needed( $post_id_or_order_object ) {
		
		if ( ! ( is_object( $post_id_or_order_object ) && method_exists( $post_id_or_order_object, 'get_meta' ) ) ) {
			$the_order = wc_get_order( $post_id_or_order_object );
		} else {
			$the_order = $post_id_or_order_object;
		}

		return 'yes' === $the_order->get_meta( '_gm_needs_conirmation' );
	}

	/**
	* Ajax Action to confirm order
	*
	* @access public
	* @static
	* @hook wp_ajax_german_market_manual_order_confirmation
	* @return void
	*/
	public static function confirm( $order_id ) {

		if ( self::confirmation_needed( $order_id ) ) {

			$order = wc_get_order( $order_id );

			do_action( 'woocommerce_before_resend_order_emails', $order, 'german-market-manual-order-confirmation' );

			do_action( 'wgm_manual_order_confirmation_confirm_before_creating_email', $order_id );

			do_action( 'wgm_manual_order_confirmation_confirm', $order_id );
			
			// Delete Post Meta
			$order->update_meta_data( '_gm_needs_conirmation', 'confirmed' );
			$order->save_meta_data();

			// Reduce stock levels
			if ( apply_filters( 'gm_manual_order_confirmation_reduce_stock_level_after_manual_confirmation', true ) ) {
				wc_reduce_stock_levels( $order_id );
			}

			if ( ! apply_filters( 'wgm_manual_order_confirmation_confirm_send_mail', true, $order ) ) {
				return;
			}
			
			$old_status							= $order->get_status();

			$pending_without_pay_link_gateways 	= apply_filters( 'gm_manual_order_confirmation_pending_with_no_pay_link', array( 'bacs', 'cheque' ) );
			$processing_gateways 				= apply_filters( 'gm_manual_order_confirmation_processing_gateways', array( 'german_market_purchase_on_account', 'cash_on_delivery' ) );

			$is_pending_without_pay_link		= in_array( $order->get_payment_method(), $pending_without_pay_link_gateways );
			$is_processing_gateway				= in_array( $order->get_payment_method(), $processing_gateways );

			// Update Order Status
			if ( $is_pending_without_pay_link ) { 
				$status_after_confirmation = apply_filters( 'gm_order_status_after_confirmation', 'pending', $order );
			} else if ( $is_processing_gateway ) {
				$status_after_confirmation = apply_filters( 'gm_order_status_after_confirmation', 'processing', $order );
			} else {
				$status_after_confirmation = apply_filters( 'gm_order_status_after_confirmation', 'pending', $order );
			}
			
			// No Payment Needed
			$valid_order_statuses = array( 'pending', 'failed', 'on-hold' );
       		$needs_payment = $order->has_status( $valid_order_statuses ) && $order->get_total() > 0;
       		
			if ( ! $needs_payment ) {
				$status_after_confirmation = apply_filters( 'gm_order_status_after_confirmation_no_payment_needed', 'processing' );
			}
			
			$mailer = WC()->mailer();
			$mails = $mailer->get_emails();

			$stati = array(
				'woocommerce_order_status_' . $status_after_confirmation . '_to_processing',
				'woocommerce_order_status_' . $status_after_confirmation . '_to_completed',
				'woocommerce_order_status_' . $status_after_confirmation . '_to_cancelled',
				'woocommerce_order_status_' . $status_after_confirmation . '_to_on-hold',
				'woocommerce_order_status_on-hold_' . $status_after_confirmation,
			);

			if ( $processing_gateways ) {
				$stati[] = 'woocommerce_order_status_' . $old_status .'_to_processing';
			}
		
			// Remove now all actions so we have not 2 emails send!	
			foreach ( $stati as $status ){
				remove_all_actions( $status . '_notification' );
			}

			do_action( 'wgm_manual_order_confirmation_after_remove_all_actions', $order_id );

			$order->update_status( $status_after_confirmation );
			
			// Send Email to Customer
			// Filter processing order string translation
			if ( $is_processing_gateway ) { 
				
				add_filter( 'gettext', array( __CLASS__, 'new_text_in_order_on_hold_mail_processing' ), 10, 3 );
				add_action( 'woocommerce_email_before_order_table', array( __CLASS__, 'add_payment_instructions_processing' ), 10, 3 );

			} else if ( $is_pending_without_pay_link ) {

				add_filter( 'gettext', array( __CLASS__, 'new_text_in_order_on_hold_mail' ), 10, 3 );
				add_action( 'woocommerce_email_before_order_table', array( __CLASS__, 'add_payment_instructions' ), 10, 3 );

			} else {
				
				if ( $order->needs_payment() ) {
					
					add_action( 'woocommerce_email_before_order_table', array( __CLASS__, 'woocommerce_email_before_order_table_process' ), 10, 3 );
					add_filter( 'gettext', array( __CLASS__, 'new_text_in_order_on_hold_mail' ), 10, 3 );
					
				} else {
					add_filter( 'gettext', array( __CLASS__, 'new_text_in_order_on_hold_mail_processing' ), 10, 3 );
				}

			}

			do_action( 'wgm_manual_order_confirmation_confirm_before_send_email' );

			add_filter( 'woocommerce_email_enabled_customer_on_hold_order', array( __CLASS__, 'enable_customer_on_hold_order_mail' ) );

			$wc_mails = WC_Emails::instance();
			$mail = new WC_Email_Customer_On_Hold_Order();
			$mail->trigger( $order_id );

			remove_filter( 'woocommerce_email_enabled_customer_on_hold_order', array( __CLASS__, 'enable_customer_on_hold_order_mail' ) );

			do_action( 'wgm_manual_order_confirmation_confirm_after_send_email', $order_id );

			do_action( 'woocommerce_after_resend_order_email', $order, 'german-market-manual-order-confirmation' );

		}

	}

	/**
	* Enable "Customer On Hold Order" email if deactived, so that the email after manual confirmation is sent
	* Otherwise the customer won't get an email after manuel confirmation if "Customer On Hold Order" email is
	* deactivated in WooCommerce
	*
	* @access public
	* @static
	* @wp-hook woocommerce_email_enabled_customer_on_hold_order
	* @param String $enabled
	* @return String
	*/
	public static function enable_customer_on_hold_order_mail( $enabled ) {
		$enabled = 'yes';
		return $enabled;
	}

	/**
	* Change text in order on hold mail for orders with status processing (cash on delivery and purchase on account)
	*
	* @access public
	* @static
	* @wp-hook gettext
	* @param String $translated
	* @param String $original
	* @param String $domain
	* @return String
	*/
	public static function new_text_in_order_on_hold_mail_processing( $translated, $original, $domain ) {

		$search_on_hold 		= 'Your order is on-hold until we confirm payment has been received. Your order details are shown below for your reference:';
		$search_on_hold_2 		= 'Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:';

		if ( $domain == 'woocommerce' && ( ( $original == $search_on_hold ) || ( $original == $search_on_hold_2 ) ) ) {

			$translated = __( 'Your order has been confirmed and is now being processed.', 'woocommerce-german-market' );
			$translated = apply_filters( 'gm_manual_order_confirmation_new_text_in_order_on_hold_mail_processing', $translated );

		}

		return $translated;
	}

	/**
	* Change text in order on hold mail
	*
	* @access public
	* @static
	* @wp-hook gettext
	* @param String $translated
	* @param String $original
	* @param String $domain
	* @return String
	*/
	public static function new_text_in_order_on_hold_mail( $translated, $original, $domain ) {

		$search_on_hold 		= 'Your order is on-hold until we confirm payment has been received. Your order details are shown below for your reference:';
		$search_on_hold_2 		= 'Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:';

		if ( $domain == 'woocommerce' && ( ( $original == $search_on_hold ) || ( $original == $search_on_hold_2 ) ) ) {

			$translated = __( 'Your order has been confirmed.', 'woocommerce-german-market' ) . ' '  . __( 'Your order is on-hold until we confirm payment has been received.', 'woocommerce-german-market');
			$translated = apply_filters( 'gm_manual_order_confirmation_new_text_in_order_on_hold_mail', $translated );

		}

		return $translated;
	}

	/**
	* Add payment instructions
	*
	* @access public
	* @static
	* @since 3.5.8
	* wp-hook woocommerce_email_before_order_table
	* @param WC_Order $order
	* @param Boolean $sent_to_admin
	* @param Boolean $plain_text
	* @return void
	*/
	public static function add_payment_instructions_processing( $order, $sent_to_admin, $plain_text ) {

		// Get the gateway object
		$gateways           = WC_Payment_Gateways::instance();
		$available_gateways = $gateways->get_available_payment_gateways();
		$gateway            = isset( $available_gateways[ $order->get_payment_method() ] ) ? $available_gateways[ $order->get_payment_method() ] : false;
		
		if ( $gateway ) {

			ob_start();

			if ( WGM_Helper::method_exists( $gateway, 'email_instructions' ) ) {
				$gateway->email_instructions( $order, $sent_to_admin, $plain_text );
			}

			$output = ob_get_clean();

			if ( class_exists( 'WGM_Plugin_Compatibility_WPML' ) ) {
				$output = WGM_Plugin_Compatibility_WPML::wpml_repair_payment_methods( $output, $order, array() );
			}

			echo apply_filters( 'gm_manual_order_confirmation_notice_payment_instructions', $output, $gateway, $order );			
		}
		
	}

	/**
	* Add payment instructions
	*
	* @access public
	* @static
	* @since 3.5.8
	* wp-hook woocommerce_email_before_order_table
	* @param WC_Order $order
	* @param Boolean $sent_to_admin
	* @param Boolean $plain_text
	* @return void
	*/
	public static function add_payment_instructions( $order, $sent_to_admin, $plain_text ) {

		global $sitepress;

		// Get the gateway object
		$gateways           = WC_Payment_Gateways::instance();
		$available_gateways = $gateways->get_available_payment_gateways();
		$gateway            = isset( $available_gateways[ $order->get_payment_method() ] ) ? $available_gateways[ $order->get_payment_method() ] : false;
		
		if ( $gateway ) {

			ob_start();

			if ( WGM_Helper::method_exists( $gateway, 'email_instructions' ) ) {
				$gateway->email_instructions( $order, $sent_to_admin, $plain_text );
			}

			if ( $order->get_payment_method() == 'bacs' ) {

				$gateway->thankyou_page( $order->get_id() );
			} else {
				if ( method_exists( $gateway, 'thankyou_page' ) ) {
					$gateway->thankyou_page();
				}	
			}

			$output = ob_get_clean();

			if ( class_exists( 'WGM_Plugin_Compatibility_WPML' ) ) {
				$output = WGM_Plugin_Compatibility_WPML::wpml_repair_payment_methods( $output, $order, array() );
			}

			echo apply_filters( 'gm_manual_order_confirmation_notice_payment_instructions', $output, $gateway, $order );
			
		}

		echo apply_filters( 'gm_manual_order_confirmation_in_the_meantime_text', __( 'In the meantime, here’s a reminder of what you ordered:', 'woocommerce-german-market' ) );

	}

	/**
	* Show Payment link in new processing mail
	*
	* @access public
	* wp-hook woocommerce_email_before_order_table
	* @param WC_Order $order
	* @param Boolean $sent_to_admin
	* @param Boolean $plain_text
	* @return void
	*/
	public static function woocommerce_email_before_order_table_process( $order, $sent_to_admin, $plain_text ) {

		if ( $order->get_status() == 'pending' ) {

			// init payment gateways to get payment url
			if ( WC()->payment_gateways() ) {
				$payment_gateways = WC()->payment_gateways->payment_gateways();
			} else {
				$payment_gateways = array();
			}

			$payment_method = $order->get_payment_method();

			$maybye_pay_url = '';

			// paypal link
			if ( $payment_method == 'paypal' ) {

				if ( isset( $payment_gateways[ $payment_method ] ) ) {

					if ( is_file( dirname( WC_PLUGIN_FILE ) . '/includes/gateways/paypal/includes/class-wc-gateway-paypal-request.php' ) ) {

						include_once( dirname( WC_PLUGIN_FILE ) . '/includes/gateways/paypal/includes/class-wc-gateway-paypal-request.php' );
						$paypal_request = new WC_Gateway_Paypal_Request( $payment_gateways[ $payment_method ] );
						$maybye_pay_url = $paypal_request->get_request_url( $order, $payment_gateways[ $payment_method ]->testmode );

					}
					
				}
			
			} else {

				// other payment methods, maybe they've got an transaction url
				if ( isset( $payment_gateways[ $payment_method ] ) ) {
					$maybye_pay_url = $payment_gateways[ $payment_method ]->get_transaction_url( $order );
				}
				
			}

			if ( ! empty( $maybye_pay_url ) ) {
				$pay_link = $maybye_pay_url;
			} else {
				$pay_link = $order->get_checkout_payment_url();
			}

			$pay_now_text = apply_filters( 'gm_manual_order_confirmation_pay_now_text', __( 'Pay now', 'woocommerce-german-market' ) );
			
			if ( $plain_text ) {
			
				$text = $pay_now_text . ': ' . $pay_link . "\n\n" . apply_filters( 'gm_manual_order_confirmation_in_the_meantime_text', __( 'In the meantime, here’s a reminder of what you ordered:', 'woocommerce-german-market' ) ) . "\n\n"; 

			} else {

				$text = '<p><a href="' . $pay_link . '">' . $pay_now_text . '</a></p><p>' .  apply_filters( 'gm_manual_order_confirmation_in_the_meantime_text', __( 'In the meantime, here’s a reminder of what you ordered:', 'woocommerce-german-market' ) ) . '</p>';

			}

			echo apply_filters( 'gm_manual_order_confirmation_text', $text, $order, $sent_to_admin, $plain_text );

		}

	}

	/**
	* Show info on my_account
	*
	* @access public
	* wp-hook woocommerce_view_order
	* @param Integer $order_id
	* @return void
	*/
	public static function view_order_info( $order_id ) {
		
		$order = wc_get_order( $order_id );
		if ( is_object( $order ) && method_exists( $order, 'get_meta' ) ) {
			if ( 'yes' === $order->get_meta( '_gm_needs_conirmation' ) ) {
			
				?><p><?php
					echo apply_filters( 'gm_manual_order_confirmation_notice_in_email', esc_attr( __( 'Your order will be manually checked. You will get another email after your order has been confirmed.', 'woocommerce-german-market' ) ) );
				?></p><?php

			}
		}
			
	}

	/**
	* Show info on Thank You Page
	*
	* @access public
	* wp-hook woocommerce_thankyou_order_received_text
	* @param String $text
	* @param WC_Order $order
	* @return void
	*/
	public static function thankyou_order_received_text( $text, $order ) {
		
		if ( ! WGM_Helper::method_exists( $order, 'get_id' ) ) {
			return $text;
		}
		
		if ( 'yes' === $order->get_meta( '_gm_needs_conirmation' ) ) {
		
			$text = apply_filters( 'gm_manual_order_confirmation_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce-german-market' ) . ' ' . __( 'Your order will be manually checked. You will get another email after your order has been confirmed.', 'woocommerce-german-market' ) );

		}

		return $text;	
	}
}
