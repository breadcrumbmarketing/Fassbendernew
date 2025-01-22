<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );




// additionally infos for product

// filter sort by in germna 
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby_german');
function custom_woocommerce_catalog_orderby_german($orderby) {
    $orderby = array(
        'popularity' => __( 'Nach Beliebtheit sortieren', 'woocommerce' ),
        'rating'     => __( 'Nach Durchschnittsbewertung sortieren', 'woocommerce' ),
        'date'       => __( 'Nach Neuheit sortieren', 'woocommerce' ),
        'price'      => __( 'Nach Preis: niedrig zu hoch', 'woocommerce' ),
        'price-desc' => __( 'Nach Preis: hoch zu niedrig', 'woocommerce' ),
    );
    return $orderby;
}

// Translate woocommerce 

add_filter('gettext', 'debug_text_domain', 20, 3);
function debug_text_domain($translated_text, $text, $domain) {
    if ($text === 'Coupon code' || $text === 'APPLY COUPON') {
        error_log("Text: $text, Domain: $domain");
    }
    return $translated_text;
}


add_filter('gettext', 'custom_german_translations', 20, 3);
function custom_german_translations($translated_text, $text, $domain) {
    // Apply translations for specific text domains
    if ($domain === 'woocommerce' || $domain === 'https://testshop.autoactiva-intern.de/') {
        switch ($text) {
            // WooCommerce strings
            case 'Description':
                $translated_text = __('Beschreibung', 'woocommerce');
                break;
            case 'Reviews':
                $translated_text = __('Bewertungen', 'woocommerce');
                break;
            case 'In stock':
                $translated_text = __('Auf Lager', $domain);
                break;
            case 'Add to Wishlist':
                $translated_text = __('Zur Wunschliste hinzufügen', $domain);
                break;
            case 'Related products':
                $translated_text = __('Ähnliche Produkte', $domain);
                break;
            case 'Add to cart':
                $translated_text = __('In den Warenkorb legen', $domain);
                break;
            case 'View cart':
                $translated_text = __('Warenkorb ansehen', $domain);
                break;
            case 'Proceed to checkout':
                $translated_text = __('Zur Kasse gehen', $domain);
                break;
            case 'Billing details':
                $translated_text = __('Rechnungsdetails', $domain);
                break;
            case 'Additional information':
                $translated_text = __('Zusätzliche Informationen', $domain);
                break;
            case 'Your order':
                $translated_text = __('Ihre Bestellung', $domain);
                break;
            case 'Apply coupon':
                $translated_text = __('Gutschein einlösen', $domain);
                break;
            case 'Update cart':
                $translated_text = __('Warenkorb aktualisieren', $domain);
                break;
            case 'Cart totals':
                $translated_text = __('Warenkorb Summe', $domain);
                break;
            case 'Subtotal':
                $translated_text = __('Zwischensumme', $domain);
                break;
            case 'Shipping':
                $translated_text = __('Versand', $domain);
                break;
            case 'Total':
                $translated_text = __('Gesamtsumme', $domain);
                break;
            case 'Product':
                $translated_text = __('Produkt', $domain);
                break;
            case 'Price':
                $translated_text = __('Preis', $domain);
                break;
                
                
            // Add more translations as needed
        }
    }
    return $translated_text;
}

// Traslate carts

add_filter('gettext', 'custom_german_cart_translations', 20, 3);
function custom_german_cart_translations($translated_text, $text, $domain) {
    // Apply translations for WooCommerce text domain
    if ($domain === 'woocommerce') {
        switch ($text) {
            // Cart page strings
            case 'Product':
                $translated_text = __('Produkt', 'woocommerce');
                break;
            case 'Price':
                $translated_text = __('Preis', 'woocommerce');
                break;
            case 'Quantity':
                $translated_text = __('Menge', 'woocommerce');
                break;
            case 'Subtotal':
                $translated_text = __('Zwischensumme', 'woocommerce');
                break;
            case 'Remove this item':
                $translated_text = __('Dieses Produkt entfernen', 'woocommerce');
                break;
            case 'Update cart':
                $translated_text = __('Warenkorb aktualisieren', 'woocommerce');
                break;
            case 'Cart totals':
                $translated_text = __('Warenkorb Summe', 'woocommerce');
                break;
            case 'Proceed to checkout':
                $translated_text = __('Zur Kasse gehen', 'woocommerce');
                break;
            case 'Coupon code':
                $translated_text = __('Gutscheincode', 'woocommerce');
                break;
            case 'Apply coupon':
                $translated_text = __('Gutschein anwenden', 'woocommerce');
                break;
            case 'Your cart is currently empty.':
                $translated_text = __('Ihr Warenkorb ist derzeit leer.', 'woocommerce');
                break;
            case 'Return to shop':
                $translated_text = __('Zurück zum Shop', 'woocommerce');
                break;
            // Add more cart translations as needed
        }
    }
    return $translated_text;
}


// Add action to display custom product meta in WooCommerce single product summary
add_action('woocommerce_single_product_summary', 'display_custom_product_meta', 25);

function display_custom_product_meta() {
    global $product;

    // Get the product ID
    $product_id = $product->get_id();

    // Display tax information
    $tax_info = get_post_meta($product_id, '_tax_info', true);
    if (!empty($tax_info)) {
        echo '<p class="tax-info">' . wp_kses_post($tax_info) . '</p>';
    }

    // Display delivery time
    $lieferzeit = get_post_meta($product_id, '_lieferzeit', true);
    if (!empty($lieferzeit)) {
        echo '<p class="lieferzeit"><strong>Lieferzeit:</strong> ' . esc_html($lieferzeit) . '</p>';
    }

    // Display stock information with spacing above
    $stock_info = get_post_meta($product_id, '_stock_info', true);
    if (!empty($stock_info)) {
        echo '<p class="stock-info"><span class="stock-circle"></span>' . wp_kses_post($stock_info) . '</p>';
    }

    // Display property values
    $property_value_name = get_post_meta($product_id, '_property_value_name', true);
    if (!empty($property_value_name)) {
        // Split the value into individual properties
        $properties = explode('|', $property_value_name);

        echo '<div class="product-properties">';
        foreach ($properties as $property) {
            // Split title and items by the first colon
            $parts = explode(':', $property, 2);
            $title = trim($parts[0]);
            $items = isset($parts[1]) ? array_map('trim', explode(',', $parts[1])) : [];

            // If there's only one item, display it as static text
            if (count($items) === 1) {
                echo '<p class="product-property"><strong>' . esc_html($title) . ':</strong> ' . esc_html($items[0]) . '</p>';
            } elseif (count($items) > 1) {
                // Display a dropdown for multiple items
                echo '<div class="product-property">';
                echo '<label for="property-' . sanitize_title($title) . '"><strong>' . esc_html($title) . ':</strong></label>';
                echo '<select id="property-' . sanitize_title($title) . '" name="property-' . sanitize_title($title) . '">';
                foreach ($items as $item) {
                    echo '<option value="' . esc_attr($item) . '">' . esc_html($item) . '</option>';
                }
                echo '</select>';
                echo '</div>';
            }
        }
        echo '</div>';
    }
}

// Add the "Zusätzliche Informationen" tab to the product page
add_filter('woocommerce_product_tabs', 'add_additional_information_tab');

function add_additional_information_tab($tabs) {
    // Add the new tab
    $tabs['additional_information_tab'] = [
        'title'    => __('Zusätzliche Informationen', 'woocommerce'), // Tab title
        'priority' => 20, // Position of the tab (20 is between Beschreibung and Bewertungen)
        'callback' => 'display_additional_information_tab_content', // Callback function to display content
    ];
    return $tabs;
}

// Callback function to display content in the "Zusätzliche Informationen" tab
function display_additional_information_tab_content() {
    global $product;

    // Get the product ID
    $product_id = $product->get_id();

    // Get the weight from product meta
    $weight = get_post_meta($product_id, '_weight', true);

    // Debug: Log the retrieved weight
    error_log("Retrieved weight for product ID {$product_id}: " . ($weight ? $weight : 'Empty'));

    // Display the weight if it exists
    if (!empty($weight)) {
        echo '<div class="product-additional-info">';
        echo '<table class="shop_table shop_table_responsive additional-info-table">';
        echo '<tr>';
        echo '<th>' . esc_html__('Gewicht', 'woocommerce') . '</th>';
        echo '<td>' . esc_html($weight) . ' kg</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p>' . esc_html__('Keine zusätzlichen Informationen verfügbar.', 'woocommerce') . '</p>';
    }

}

// Remove the Reviews tab
add_filter('woocommerce_product_tabs', 'remove_reviews_tab', 98);

function remove_reviews_tab($tabs) {
    unset($tabs['reviews']); // Remove the reviews tab
    return $tabs;
}

// Remove WooCommerce's default "Additional Information" tab
add_filter('woocommerce_product_tabs', 'remove_default_additional_information_tab', 98);

function remove_default_additional_information_tab($tabs) {
    unset($tabs['additional_information']); // Remove the default additional information tab
    return $tabs;
}