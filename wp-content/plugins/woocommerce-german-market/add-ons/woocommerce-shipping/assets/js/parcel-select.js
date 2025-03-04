( function( $ ) {

    /**
     * advanceSelect
     */
    function decodeEntities( encodedString ) {

        var textArea = document.createElement( 'textarea' );
        textArea.innerHTML = encodedString;

        return textArea.value;
    }

    $.fn.terminalSelect = function() {
        $( this ).on( 'change', function( event ) {

            var $option = $( this ).find(':selected');
            var code = $option.val();

            if ( '' === code ) {
                // Tick 'Ship to different address'.
                if ( $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
                    $( '#ship-to-different-address label' ).trigger( 'click' );
                    $( '#ship-to-different-address-checkbox' ).prop( 'checked', false );
                }

                // Fix for Atomion compatibillity.
                if ( $( '#ship-to-different-address span.atomion-checkbox-style' ).length ) {
                    if ( $( '#ship-to-different-address span.atomion-checkbox-style' ).hasClass( 'checked' ) ) {
                        $( '#ship-to-different-address span.atomion-checkbox-style' ).removeClass( 'checked' );
                    }
                }
            }

            var is_backend = $( '#order_data' ).length !== 0 ? true : false;

            if ( is_backend ) {
                var terminal_field = $( '#order_data select.shipping-terminal-select' ).attr( 'name' );
            } else {
                var terminal_field = $( '#order_review select.shipping-terminal-select' ).attr( 'name' );
            }

            var order_id = false;
            var cod = 0;
            var regex = /wc_shipping_([^_].+?)_.*/g;
            var found = regex.exec( terminal_field.replace( 'wgm_', '' ) );
            var provider = found[ 1 ];
            var action = 'choose_' + provider + '_terminal';

            if ( is_backend ) {
                const queryString = window.location.search;
                const urlParams   = new URLSearchParams( queryString );
                order_id          = urlParams.get( 'post' );
                if ( ! order_id ) {
                    // Fix for HPOS
                    order_id = urlParams.get( 'id' );
                }
            }

            /*
             * Doing Ajax call.
             */
            $.ajax( {
                url: wgm_woocommerce_shipping.wc_ajax_url.toString().replace( '%%endpoint%%', action ),
                dataType: 'json',
                method: 'POST',
                data: {
                    action:           action,
                    is_backend_modal: is_backend,
                    order_id:         order_id,
                    terminal_field:   terminal_field,
                    terminal:         code,
                    cod:              cod,
                    terminal_details: {
                        company: $option.data( 'terminalcompany' ),
                        street: $option.data( 'terminalstreet' ),
                        pcode: $option.data( 'terminalpostcode' ),
                        city: $option.data( 'terminalcity' ),
                    },
                    security:         wgm_woocommerce_shipping.ajax_nonce,
                },
            } )
            .success( function( data ) {
                if ( is_backend ) {
                    if ( undefined != typeof data.address ) {
                        let custom_field_container = '#postcustom';
                        // Fix for HPOS
                        if ( $( '#order_custom' ).length ) {
                            custom_field_container = '#order_custom';
                        }
                        $( '#order_data .order_data_column:nth-of-type( 3 ) .terminal-information' ).remove();
                        $( '#order_data .order_data_column:nth-of-type( 3 ) .address' ).html( data.address );
                        let input_field = $( custom_field_container + ' input[value="' + terminal_field + '"]' ).closest( 'td' ).next().find( 'textarea' );
                        let form        = $( 'form#order' ).length ? $( 'form#order' ) : $( '#order_data' ).parents( 'form' );
                        let old_terminal = $( input_field ).text();
                        if ( old_terminal != data.terminal_id ) {
                            $( input_field ).text( data.terminal_id );
                            // Remove hidden form fields if exists.
                            if ( $( 'input[name="wgm_shipping_old_terminal_id"]' ).length ) {
                                $( 'input[name="wgm_shipping_old_terminal_id"]' ).remove();
                            }
                            if ( $( 'input[name="wgm_shipping_new_terminal_id"]' ).length ) {
                                $( 'input[name="wgm_shipping_new_terminal_id"]' ).remove();
                            }
                            if ( $( 'input[name^="wgm_shipping_new_terminal"]' ).length ) {
                                $( 'input[name^="wgm_shipping_new_terminal"]' ).remove();
                            }
                            // Store selected terminal info into form fields.
                            $( form ).append( '<input type="hidden" name="wgm_shipping_old_terminal_id" value="' + old_terminal + '">' );
                            $( form ).append( '<input type="hidden" name="wgm_shipping_new_terminal_id" value="' + data.terminal_id + '">' );
                            $.each( data.terminal, function( key, value ) {
                                $( form ).append( '<input type="hidden" name="wgm_shipping_new_terminal[' + key + ']" value="' + value + '">' );
                            });
                        }
                    }
                } else {
                    let terminal = ( 'undefined' !== typeof $option.data( 'terminalcompany' ) ) ? $option.data( 'terminalcompany' ) : '';

                    // Ship to different address.
                    $( '.shipping_address #shipping_company' ).val( decodeEntities( terminal ) );
                    $( '.shipping_address #shipping_address_1' ).val( $option.data( 'terminalstreet' ) );
                    $( '.shipping_address #shipping_postcode' ).val( $option.data( 'terminalpostcode' ) );
                    $( '.shipping_address #shipping_city' ).val( $option.data( 'terminalcity' ) );

                    if ( '' !== terminal ) {

                        // Tick 'Ship to different address'.
                        if ( ! $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
                            $( '#ship-to-different-address label' ).trigger( 'click' );
                            $( '#ship-to-different-address-checkbox' ).prop( 'checked', true );
                        }

                        // Fix for Atomion compatibillity.
                        if ( $( '#ship-to-different-address span.atomion-checkbox-style' ).length ) {
                            if ( ! $( '#ship-to-different-address span.atomion-checkbox-style' ).hasClass( 'checked' ) ) {
                                $( '#ship-to-different-address span.atomion-checkbox-style' ).addClass( 'checked' );
                            }
                        }
                    }
                }
            } )
            .done( function() {
            } );

        } );
    };

    /**
     * WooSelect
     */
    $( '.wc-enhanced-select' ).each( function() {
        $( this ).selectWoo();
        if ( $( this ).hasClass( 'shipping-terminal-select' ) ) {
            $( this ).terminalSelect();
        }
    });

    /**
     * Terminal Select
     */
    $( '.shipping-terminal-select' ).each( function() {
        $( this ).terminalSelect();
    });

    if ( $( '#order_review' ).length ) {

        var target = $( '#order_review' )[ 0 ];

        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function( mutation) {
                var newNodes = mutation.addedNodes;
                if ( newNodes !== null ) {
                    if ( $( '.wc-enhanced-select' ).length ) {
                        $( '.wc-enhanced-select' ).each(function () {
                            $( this ).selectWoo();
                            if ( $( this ).hasClass( 'shipping-terminal-select' ) ) {
                                $( this ).terminalSelect();
                            }
                        });
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

        var target = $( '#order_review' )[ 0 ];

        var observer = new MutationObserver( function( mutations ) {
            mutations.forEach( function( mutation ) {
                var newNodes = mutation.addedNodes;
                if ( newNodes !== null ) {
                    if ( $( '.shipping-terminal-select' ).length ) {
                        $( '.shipping-terminal-select' ).terminalSelect();
                    }
                }
            } );
        } );

        var config = {
            attributes: true,
            childList: true,
            characterData: true
        };

        observer.observe( target, config );

    }

})(jQuery);
