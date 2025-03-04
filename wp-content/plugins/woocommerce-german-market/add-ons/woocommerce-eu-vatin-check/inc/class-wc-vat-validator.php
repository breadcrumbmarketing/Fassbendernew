<?php
/**
 * Feature Name: The Validator
 * Version:      1.0
 * Author:       MarketPress
 * Author URI:   http://marketpress.com
 */

/**
 * This class calls the VAT validator at http://ec.europa.eu/taxation_customs/vies/vatRequest.html
 * and checks the given input against it. If the VAT Validator is not available there is
 * a RegEx Fallback.
 *
 * Example:
 *
 * 	if ( isset( $_POST[ 'country_code' ] ) && isset( $_POST[ 'uid' ] ) ) {
 * 		$validator = new WC_VAT_Validator( array ( $_POST[ 'country_code' ], $_POST[ 'uid' ] ) );
 * 		if ( $validator->is_valid() )
 * 			echo 'Valid VAT';
 * 		else
 * 			echo 'invalid VAT';
 * }
 *
 * $validator = new WC_VAT_Validator( array( 'DE', '123456789' ) );
 * $validator->is_valid();
 */
class WC_VAT_Validator {

	/**
	 * Location of the wsdl file
	 */
	private $wdsl = 'https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';

	/**
	 * Instance of our SOAP client
	 */
	private $client;

	/**
	 * Flag to check if we can make SOAP calls. Is set to true after successfully connecting the SOAP client
	 */
	private $hasClient = FALSE;

	/**
	 * Store the result of the last API call, in case there's more to do with it
	 */
	private $last_api_call;

	/**
	 * Store the result of the last validation
	 */
	private $last_result;

	/**
	 * If the input did not change, we just return the result of the last call using this flag
	 */
	private $is_dirty = TRUE;

	/**
	 * Array of 2 strings: Country Code and UID
	 */
	private $input;

	/**
	 * The country code
	 *
	 * @var	string
	 */
	private $country;

	/**
	 * Errors are handles with HTML-Like error codes
	 */
	private $error = array ();

	/**
	 * the error messages
	 */
	private $error_msgs = array();

	public function __construct( $input, $billing_country = '' ) {

		// set the error message

		$start_error_message = '<strong>' .  get_option( 'vat_options_label', __( 'EU VAT Identification Number (VATIN)', 'woocommerce-german-market' ) ) . ':</strong> ';

		$start_error_message = apply_filters( 'wcvat_start_error_message', $start_error_message );

		$this->error_msgs = apply_filters( 'wcvat_error_messages_array', array(
			'200' => $start_error_message . __( 'Successfully validated. (Whew!)', 'woocommerce-german-market' ),
			'400' => $start_error_message . __( 'API server rejects input. Have you entered a valid country code? A valid country code consists of 2 capitals, like DE for Germany. Check allowed country codes <a href="http://ec.europa.eu/taxation_customs/vies/help.html" target="_blank">here</a>.', 'woocommerce-german-market' ),
			'404' => $start_error_message . __( 'Could not establish connection to API server. Falling back to static validation. (<a href="http://ec.europa.eu/taxation_customs/vies/help.html" target="_blank">Why?</a>)', 'woocommerce-german-market' ),
			'500' => $start_error_message . __( 'Validation aborted: No input found. Input might have been rejected, or the number you have entered simply cannot be found.', 'woocommerce-german-market' ),
			'501' => $start_error_message . __( 'Invalid input: Value passed does not seem to be a string or an array. (Aka something’s wrong here technically.)', 'woocommerce-german-market' ),
			'502' => $start_error_message .  __( 'Invalid input: Array does not seem to consist of 2 strings. (Aka something’s wrong here technically.)', 'woocommerce-german-market' ),
			'550' => $start_error_message . str_replace( 'RegEx: ', '', __( 'RegEx: Country Code not recognized. Have you entered a valid country code? A valid country code consists of 2 capitals, like DE for Germany. Check allowed country codes <a href="http://ec.europa.eu/taxation_customs/vies/help.html" target="_blank">here</a>', 'woocommerce-german-market' ) ),
		) );

		// set the input
		$this->set_input( $input );
		$this->country = $billing_country;

		// Try to establish a connection to the API server
		try {

			if ( class_exists( 'SoapClient' ) ) {
				$this->client = new SoapClient( $this->wdsl );
				$this->hasClient = TRUE;
			} else {
				$this->hasClient = FALSE;
			}

		} catch ( Exception $e ) {
			$this->hasClient = FALSE;
		}

	}

	/**
	 *
	 * @param mixed $input
	 *
	 * @return boolean
	 */
	public function is_valid() {

		// check the cache first
		$cached_vat_numbers = get_option( 'wcvat_cached_vat_numbers' );

		// remove emmpty spaces in user input before validating
		$this->input[ 0 ] = trim( str_replace( ' ', '', $this->input[ 0 ] ) );
		$this->input[ 1 ] = trim( str_replace( ' ', '', $this->input[ 1 ] ) );

		$check_against = $this->country;

		// exception handling for Greece VAT IDs
		if ( $this->country == 'GR' ) {
			$check_against = 'EL';
		}

		// check if hash is same as the country
		if ( ! empty( $this->country ) && $check_against != $this->input[ 0 ] ) {
			$this->error = array();
			$this->error[] = 550;
			return FALSE;
		}

		// set hashes to limit api calls
		$hash 				= md5( $this->input[ 0 ] . $this->input[ 1 ] );
		$today_hash 		= md5( $this->input[ 0 ] . $this->input[ 1 ] . date( 'Y-m-d' ) );
		$today_total_hash 	= md5( date( 'Y-m-d' ) );

		$today_api_calls 	= intval( get_transient( 'wcvat_cached_vat_number_today_hash' . $today_hash ) );
		if ( empty( $today_api_calls ) ) {
			$today_api_calls = 0;
		}

		$today_total_api_calls = intval( get_transient( 'wcvat_cached_vat_number_today_total_hash' . $today_total_hash ) );
		if ( empty( $today_total_api_calls ) ) {
			$today_total_api_calls = 0;
		}

		// filter today calls
		$today_api_calls 		= apply_filters( 'wcvat_cached_vat_number_today_api_calls', $today_api_calls, $this );
		$today_total_api_calls 	= apply_filters( 'wcvat_cached_vat_number_today_total_api_calls', $today_total_api_calls, $this );

		// set cache
		if ( $today_api_calls > 0 ) {
			if ( get_transient( 'wcvat_cached_vat_number_' . $hash ) == TRUE ) {
				return TRUE;
			}
		}

		$has_checked_api = false;

		if ( $this->is_dirty ) {
			$this->error = array (); // Clear any errors we might have had previously

			// Only do something if there's input to work with
			if ( ( $this->input != NULL ) && ( ! empty( $this->input[ 0 ] ) ) && ( ! empty( $this->input[ 1 ] ) ) ) {

				// If we have a SOAP client, call it, otherwise fall back to regex
				if ( $this->hasClient ) {

					if ( ( $today_api_calls < 4 ) && ( $today_total_api_calls < 25000 ) ) {

						$transient_result = get_transient( 'wcvat_validation_result_' . $hash );
						$has_transient_result = is_object( $transient_result ) && isset( $transient_result->valid );

						$this->last_result = $this->check_API();

						if ( ! $has_transient_result ) {
							set_transient( 'wcvat_cached_vat_number_today_hash' . $today_hash, ( $today_api_calls + 1 ), 24 * HOUR_IN_SECONDS );
							set_transient( 'wcvat_cached_vat_number_today_total_hash' . $today_total_hash, ( $today_total_api_calls + 1 ), 24 * HOUR_IN_SECONDS );
							$has_checked_api = true;
						}

					} else {

						$this->last_result = $this->check_regex( $this->input[ 0 ], $this->input[ 1 ] );
						$error_log = 'on' === get_option( 'german_market_vat_logging', 'off' );

						if ( $error_log ) {
							$logger = wc_get_logger();
							$context = array( 'source' => 'german-market-vat-validator' );

							if ( $today_api_calls >= 4) {
								$logger->info( '"A Vat ID has already been validated 4 times today as invalid" CHECK REGEX INSTEAD', $context );
							}

							if ( $today_total_api_calls >= 25000) {
								$logger->info( '"More than 25.000 API Calls today" CHECK REGEX INSTEAD', $context );
							}

						}

					}

				} else {

					$this->error[] = 404;
					$this->last_result = $this->check_regex( $this->input[ 0 ], $this->input[ 1 ] );

				}

			} else {
				$this->error[] = 500;
				$this->last_result = FALSE;
			}

			$this->is_dirty = FALSE;
		}

		// set the last result as cache object
		// if it is valid
		if ( $this->last_result == TRUE ) {

			if ( $has_checked_api ) {
				// set cache for 1 day
				set_transient( 'wcvat_cached_vat_number_' . $hash, $this->last_result, 24 * HOUR_IN_SECONDS );
			}

		} else {
			// remove from cache
			delete_transient( 'wcvat_cached_vat_number_' . $hash );
		}

		return $this->last_result;
	}

	/**
	 * Sets a new input array, throwing errors along the way if anything's sketchy
	 * TRUE if nothing's sketchy, otherwise FALSE
	 *
	 * @param mixed $input
	 *
	 * @return boolean
	 */
	public function set_input( $input ) {

		// Check if we have valid input
		// If a string was passed, split it and work with the resulting array
		if ( ! is_array( $input ) ) {
			if ( is_string( $input ) ) {
				$input = $this->_parse_string( $input );
			} else {
				$this->error[] = 501;
				$this->input = null;
				$this->is_dirty = TRUE;

				return FALSE;
			}
		}

		// Check if there are 2 elements in the array
		if ( isset( $input[ 0 ] ) && isset( $input[ 1 ] ) ) {
			// Both elements should be strings
			if ( is_string( $input[ 0 ] ) && is_string( $input[ 1 ] ) ) {
				//Make sure everything's UPPERCASE and set the input array
				$this->input = array ( strtoupper( $input[ 0 ] ), strtoupper( $input[ 1 ] ) );
				$this->is_dirty = TRUE;
			} else {
				$this->error[] = 502;
				$this->input = null;
				$this->is_dirty = TRUE;
				return FALSE;
			}
		}

		$this->is_dirty = TRUE;

		return TRUE;
	}

	/**
	 * Check if there are elements in the errors array
	 *
	 * @return boolean
	 */
	public function has_errors() {

		return ( count( $this->error ) > 0) ? TRUE : FALSE;
	}

	/**
	 * Returns an array of all error messages occured during the last validation attempt
	 *
	 * @return string
	 */
	public function get_error_messages() {

		$messages = array ();
		foreach ( $this->error as $error_code )
			$messages[] = $this->error_msgs[ $error_code ];

		return $messages;
	}

	/**
	 * Returns an array of all error codes occured during the last validation attempt
	 *
	 * @return string
	 */
	public function get_error_codes() {

		return $this->error;
	}

	/**
	 * Returns the description of the current error code
	 *
	 * @return string
	 */
	public function get_last_error_message() {

		return $this->error_msgs[ end( $this->error ) ];
	}

	/**
	 * Returns the current error code
	 *
	 * @return type
	 */
	public function get_last_error_code() {

		return end( $this->error );
	}

	private function check_API() {

		$hash = md5( $this->input[ 0 ] . $this->input[ 1 ] );

		try {

			$parameters = array (
				'countryCode' => $this->input[ 0 ],
				'vatNumber' => $this->input[ 1 ],
			);

			$requester_member_state = get_option( 'german_market_vat_requester_member_state', '-' );
			$requester_vat_number 	= get_option( 'german_market_vat_requester_vat_number', '' );

			if ( '-' != $requester_member_state && ( ! empty( $requester_vat_number ) ) ) {
				$parameters[ 'requesterCountryCode' ] 	= $requester_member_state;
				$parameters[ 'requesterVatNumber' ]		= $requester_vat_number;
			}

			$transient_result = get_transient( 'wcvat_validation_result_' . $hash );
			$has_transient_result = is_object( $transient_result ) && isset( $transient_result->valid );

			if ( $has_transient_result ) {
				$result = $transient_result;
			} else {
				$result = $this->client->__soapCall( 'checkVatApprox', array( $parameters ) );
				set_transient( 'wcvat_validation_result_' . $hash, $result, HOUR_IN_SECONDS );
			}

			do_action( 'wcvat_wc_vat_validator_check_api_result', $result, $this );

		} catch ( Exception $e ) {

			set_transient( 'wcvat_validation_error_' . $hash, $e->getMessage(), HOUR_IN_SECONDS );
			delete_transient( 'wcvat_validation_result_' . $hash );

			$this->error[] = 400;
			$this->last_api_call = null;

			$error_log = 'on' === get_option( 'german_market_vat_logging', 'off' );
			if ( $error_log ) {
				$logger = wc_get_logger();
				$context = array( 'source' => 'german-market-vat-validator' );
				$logger->info( '"API Error:' . $e->getMessage() . '" CHECK REGEX INSTEAD', $context );
			}

			do_action( 'wcvat_wc_vat_validator_check_api_result_catch_error', $e, $this );

			return $this->check_regex( $this->input[ 0 ], $this->input[ 1 ] );
		}

		$this->last_api_call = $result;

		// set valid error message
		$this->error[] = 200;

		return $result->valid;
	}

	/**
	* get api response
	*
	* @return String
	*/
	public function get_api_response() {

		$response = '';

		$hash = md5( $this->input[ 0 ] . $this->input[ 1 ] );

		$api_result = get_transient( 'wcvat_validation_result_' . $hash );
		$api_error 	= get_transient( 'wcvat_validation_error_' . $hash );

		if ( $api_result && ! empty( $api_result ) ) {
			$response = $api_result;
		}  else if ( $api_error && ! empty( $api_error ) ) {
			$response = $api_error;
		}

		return $response;
	}

	/**
	* nice names for keys of API response
	*
	* @param String $key
	* @return String
	*/
	private function map_eu_key_to_german_market_key( $key ) {

		$keys = array(
			'countryCode'		=> __( 'Member State', 'woocommerce-german-market' ),
			'vatNumber'			=> __( 'VAT Number', 'woocommerce-german-market' ),
			'requestDate'		=> __( 'Date when request received', 'woocommerce-german-market' ),
			'traderName'		=> __( 'Name', 'woocommerce-german-market' ),
			'traderCompanyType'	=> __( 'Company Type', 'woocommerce-german-market' ),
			'traderAddress'		=> __( 'Address', 'woocommerce-german-market' ),
			'requestIdentifier'	=> __( 'Consultation Number', 'woocommerce-german-market' ),
			'valid'				=> __( 'Valid', 'woocommerce-german-market' ),
		);

		return isset( $keys[ $key ] ) ? $keys[ $key ] : $key;
	}

	/**
	* get api response formatted to save as order note
	*
	* @return String
	*/
	public function get_api_response_formatted() {

		$formatted_output 	= '';
		$api_response 		= $this->get_api_response();

		if ( is_object( $api_response ) ) {

			// validated
			$formatted_output = sprintf(
					__( 'The VAT number %s was validated as valid by using %s. The answer of this service was:', 'woocommerce-german-market' ),
					$this->input[ 0 ] . $this->input[ 1 ],
					'https://ec.europa.eu/taxation_customs/vies/',
					$api_response
				);

			foreach ( $api_response as $key => $value ) {
				if ( ( ! empty( $value ) ) && ( '---' !== $value )  ) {
					if ( 'valid' === $key && true === $value ) {
						$value = __( 'Yes, valid VAT number', 'woocommerce-german-market' );
					}
					$formatted_output .= "\n" . $this->map_eu_key_to_german_market_key( $key ) . ': ' . $value;
				}
			}

		} else {

			// not validiated
			$api_response = str_replace( 'javax.xml.rpc.soap.SOAPFaultException: ', '', $api_response );
			if ( ! empty( $api_response ) ) {

				$formatted_output = sprintf(
					__( 'The VAT number %s could not be validated using %s. The cause was: %s', 'woocommerce-german-market' ),
					$this->input[ 0 ] . $this->input[ 1 ],
					'https://ec.europa.eu/taxation_customs/vies/',
					$api_response
				) . "\n";
			}

			if ( $this->check_regex( $this->input[ 0 ], $this->input[ 1 ] ) ) {
				$formatted_output .= sprintf(
					__( 'The syntax of the VAT number %s was validated as valid using regular expressions.', 'woocommerce-german-market' ),
					$this->input[ 0 ] . $this->input[ 1 ]
				);
			}
		}

		return $formatted_output;
	}

	/**
	 * Validates a UID based on country code
	 *  It returns boolean ( match | no match )
	 *
	 * For real validation, use MIAS ->
	 *  http://ec.europa.eu/taxation_customs/taxation/vat/traders/vat_number/index_de.htm
	 *  http://ec.europa.eu/taxation_customs/vies/vieshome.do?selectedLanguage=de
	 *
	 * @param string $country_code
	 * @param string $uid
	 *
	 * @return boolean
	 */
	private function check_regex( $country_code, $uid ) {

		if ( $country_code == 'EL' ) {
			$country_code = 'GR';
		}

		$regex = '';
		switch ( $country_code ) {
			case 'AT':
				$regex = '/^ATU[0-9]{8}$/';
				break;
			case 'BE':
				$regex = '/^BE(?:[0-9]{9}|[0-9]{10})$/';
				break;
			case 'BG':
				$regex = '/^BG(?:[0-9]{9}|[0-9]{10})$/';
				break;
			case 'CY':
				$regex = '/^CY[0-9]{8}[a-zA-Z]$/';
				break;
			case 'CZ':
				$regex = '/^CZ(?:[0-9]{8}|[0-9]{9}|[0-9]{10})$/';
				break;
			case 'DE':
				$regex = '/^DE[0-9]{9}$/';
				break;
			case 'DK':
				$regex = '/^DK(?:[0-9]{2}\s?){4}$/';
				break;
			case 'EE':
				$regex = '/^EE[0-9]{9}$/';
				break;
			case 'GR':
				$regex = '/^EL[0-9]{9}$/';
				break;
			case 'ES':
				$regex = '/^ES[a-zA-Z0-9][0-9]{7}[a-zA-Z0-9]$/';
				break;
			case 'FI':
				$regex = '/^FI[0-9]{8}$/';
				break;
			case 'FR':
				$regex = '/^FR[a-zA-Z0-9]{2}\s?[0-9]{9}$/';
				break;
			case 'GB':
				$regex = '/^GB(?:[0-9]{3}\s?[0-9]{4}\s?[0-9]{2}\s?(?:[0-9]{3})?|[a-zA-Z0-9]{5})$/';
				break;
			case 'HR':
				$regex = '/^HR[0-9]{11}$/';
				break;
			case 'HU':
				$regex = '/^HU[0-9]{8}$/';
				break;
			case 'IE':
				$regex = '/^IE[0-9][a-zA-Z0-9][0-9]{5}[a-z-A-Z]$/';
				break;
			case 'IT':
				$regex = '/^IT[0-9]{11}$/';
				break;
			case 'LT':
				$regex = '/^LT(?:[0-9]{9}|[0-9]{12})$/';
				break;
			case 'LU':
				$regex = '/^LU[0-9]{8}$/';
				break;
			case 'LV':
				$regex = '/^LV[0-9]{11}$/';
				break;
			case 'MT':
				$regex = '/^MT[0-9]{8}$/';
				break;
			case 'NL':
				$regex = '/^NL[0-9]{9}[bB][0-9]{2}$/';
				break;
			case 'PL':
				$regex = '/^PL[0-9]{10}$/';
				break;
			case 'PT':
				$regex = '/^PT[0-9]{9}$/';
				break;
			case 'RO':
				$regex = '/^RO[0-9]{2,10}$/';
				break;
			case 'SE':
				$regex = '/^SE[0-9]{12}$/';
				break;
			case 'SI':
				$regex = '/^SI[0-9]{8}$/';
				break;
			case 'SK':
				$regex = '/^SK[0-9]{10}$/';
				break;
		}

		if ( $country_code == 'GR' ) {
			$country_code = 'EL';
		}

		$result = FALSE;

		if ( $regex !== '' ) {
			$result = preg_match( $regex, $country_code . $uid ) === 1 ? TRUE : FALSE;
			if ( ! $result ) {
				$this->error[] = 550;
			}
		} else {
			$this->error[] = 550;
			$result = FALSE;
		}

		return $result;
	}

	/**
	 * Split a string after 2 characters and return an array of the results
	 *
	 * @param string $string
	 * @return array
	 */
	private function _parse_string( $string ) {

		return array( strtoupper( substr( $string, 0, 2 ) ), strtoupper( substr( $string, 2 ) ) );
	}
}
