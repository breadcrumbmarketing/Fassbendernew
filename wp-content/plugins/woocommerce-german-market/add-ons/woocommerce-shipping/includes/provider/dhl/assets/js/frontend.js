(function ($, window, document) {
	'use strict'

	function parcelChange() {

		let $wc_shipping_dhl_parcels_terminal = $( '#wc_shipping_dhl_parcels_terminal' );
		let cod = 0

		cod = $wc_shipping_dhl_parcels_terminal.find( ':selected' ).data( 'cod' );

		$( document ).on( 'change', '#wc_shipping_dhl_parcels_terminal', function() {

			let $this = $( this );
			cod = $this.find( ':selected' ).data( 'cod' );

			set_session( cod );
		})
	}

	function shipping_method_change() {

		$( 'form.checkout' ).on(
			'change',
			'input[name^="shipping_method"]',
			function() {
				var val = $( this ).val();
				if ( $( 'form.checkout #age-rating-exists' ).length ) {
					let is_dpd = 'wgm_dpd' === val.substring( 0, 7 ) ? true : false;
					let is_dhl = 'dhl_' === val.substring( 0, 4 ) ? true : false;
					if ( is_dpd || is_dhl ) {
						if ( is_dhl ) {
							if ( ( 'dhl_home' === val.substring( 0, 8 ) ) && $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
								$( '#ship-to-different-address label' ).trigger( 'click' );
								$( '#ship-to-different-address-checkbox' ).prop( 'checked', false );
							}
							if ( $( 'form.checkout #billing_dob' ).length ) {
								$( 'form.checkout #billing_dob' ).closest( 'p' ).show();
							} else {
								// personal id field is not present, forcing reload checkout page.
								$( document.body ).on( 'updated_checkout', function() {
									location.reload();
								});
							}
						} else
						if ( is_dpd ) {
							$( 'form.checkout #billing_dob' ).closest( 'p' ).hide();
						}
					} else {
						$( 'form.checkout #billing_personal_id' ).closest( 'p' ).hide();
						$( 'form.checkout #billing_dob' ).closest( 'p' ).hide();
					}
				} else {
					let is_dhl = 'dhl_' === val.substring( 0, 4 ) ? true : false;
					if ( is_dhl ) {
						if ( ( 'dhl_home' === val.substring( 0, 8 ) ) && $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
							$( '#ship-to-different-address label' ).trigger( 'click' );
							$( '#ship-to-different-address-checkbox' ).prop( 'checked', false );

							// Fix for Atomion compatibillity.
							if ( $( '#ship-to-different-address span.atomion-checkbox-style' ).length ) {
								if ( ! $( '#ship-to-different-address span.atomion-checkbox-style' ).removeClass( 'checked' ) ) {
									$( '#ship-to-different-address span.atomion-checkbox-style' ).removeClass( 'checked' );
								}
							}
						} else
						if ( ( 'dhl_home' !== val.substring( 0, 8 ) ) && ! $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
							// Check if shipping address is already set.
							if ( '' != $( '#shipping_address_1' ).val() ) {
								$( '#ship-to-different-address label' ).trigger( 'click' );
								$( '#ship-to-different-address-checkbox' ).prop( 'checked', true );

								// Fix for Atomion compatibillity.
								if ( $( '#ship-to-different-address span.atomion-checkbox-style' ).length ) {
									if ( ! $( '#ship-to-different-address span.atomion-checkbox-style' ).addClass( 'checked' ) ) {
										$( '#ship-to-different-address span.atomion-checkbox-style' ).addClass( 'checked' );
									}
								}
							}
						}
					}
				}
				set_session(1 );
			}
		)
	}

	function payment_method_observer() {

		if ($('#order_review #payment').length) {

			var target = $('#order_review')[0];

			let is_selected = $('#payment_method_cash_on_delivery').is(':checked') ? true : false;

			var observer = new MutationObserver(function (mutations) {
				mutations.forEach(function (mutation) {
					if ($('#payment_method_cash_on_delivery').length) {
						is_selected = $('#payment_method_cash_on_delivery').is(':checked') ? true : false;
					}
					var newNodes = mutation.addedNodes;
					if (newNodes !== null) {
						if ($('#payment_method_cash_on_delivery').length == 0 && is_selected === true) {
							var infoBox = $('<ul/>', {
								id: 'paymenth_method_change_info_box',
								class: 'woocommerce-error',
							});
							infoBox.html('<li>' + dpd.info_box_string + '</li>')
							if ($('#paymenth_method_change_info_box').length == 0) {
								$('#order_review > #payment').after(infoBox)
							}
						} else {
							if ($('#paymenth_method_change_info_box').length) {
								$('#paymenth_method_change_info_box').remove()
							}
						}
					}
				})
			})

			var config = {
				attributes: true,
				childList: true,
				characterData: true,
			}

			observer.observe(target, config);
		}

	}

	function payment_method_change() {

		$(document.body).on('change', '[name=\'payment_method\']', function () {
			$(document.body).trigger('update_checkout');
		})

	}

	function set_session(cod) {
		let data = {
			'action': 'set_checkout_session',
			'cod': cod,
		}

		let obj = null

		if (typeof wc_checkout_params !== 'undefined') {
			obj = wc_checkout_params
		} else if (typeof wc_cart_params !== 'undefined') {
			obj = wc_cart_params
		}

		if (obj !== null) {
			$.post(obj.ajax_url, data, function () {
				setTimeout(function () {
					$(document.body).trigger('update_checkout')
				}, 300)
			})
		}
	}

	function timeShiftChange() {
		$(document.body).on('change', '[name=\'wc_shipping_dhl_home_delivery_shifts\']', function () {
			$(document.body).trigger('update_checkout');
		})
	}

	$(function () {
		parcelChange()
		shipping_method_change()
		payment_method_change()
		payment_method_observer()
		timeShiftChange()

		if ( $( '#order_review' ).length ) {

			let obj = null

			if (typeof wc_checkout_params !== 'undefined') {
				obj = wc_checkout_params
			} else if (typeof wc_cart_params !== 'undefined') {
				obj = wc_cart_params
			}

			var locked = false;
			var target = $( '#order_review' )[ 0 ];

			var observer = new MutationObserver(function (mutations) {
				mutations.forEach(function (mutation) {
					var newNodes = mutation.addedNodes;
					if ( newNodes !== null ) {
						if ( $( 'select.advanced-select' ).length ) {
							$( 'select.advanced-select' ).each(function () {
								$( this ).advancedSelect();
							});
						}
						if ( $( '#wgm_dhl_service_preferred_day' ).length ) {
							$( '#wgm_dhl_service_preferred_day' ).on(
								'change',
								function( event ) {
									if ( ! locked ) {
										locked = true;
										if ( $( this ).val() != '' ) {
											// Adding fee.
											var data = {
												'action': 'apply_preferred_delivery_date_fee',
												'fee': 'add',
												'day': $( this ).val(),
											}
										} else {
											// Removing fee.
											var data = {
												'action': 'apply_preferred_delivery_date_fee',
												'fee': 'remove',
												'day': '',
											}
										}
										$.post(
											obj.ajax_url,
											data,
											function( data ) {
												locked = false;
												if ( data.success === false ) {
													$( '#wgm_dhl_service_preferred_day' ).val( '' );
												}
												$( document.body ).trigger( 'update_checkout' );
											}
										);
									}
								}
							)
						} else {
							var data = {
								'action': 'apply_preferred_delivery_date_fee',
								'fee': 'remove',
								'day': '',
							}
							$.post(
								obj.ajax_url,
								data,
								function( data ) {
									$( document.body ).trigger( 'update_checkout' );
								}
							);
						}
					}
				});
			});

			var config = {
				attributes: true,
				childList: true,
				characterData: true
			};

			observer.observe( target, config );
		}
	})

})(window.jQuery, window, document)
