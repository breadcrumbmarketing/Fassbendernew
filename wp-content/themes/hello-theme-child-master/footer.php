<?php
/**
 * The template for displaying the footer in Child Theme of Hello Elementor.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( hello_elementor_display_header_footer() ) {
		if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
			get_template_part( 'template-parts/dynamic-footer' ); // You can customize this part in your child theme
		} else {
			get_template_part( 'template-parts/footer' ); // Or customize this footer part
		}
	}
}

// Hier können Sie zusätzlichen Footer-Code hinzufügen oder ändern.
// Zum Beispiel:
echo '<div class="custom-footer-info">© ' . date("Y") . ' Ihr Unternehmen. Alle Rechte vorbehalten.</div>';

?>

<?php wp_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Translation map (English => German)
    const translations = {
        'Price': 'Preis',
        'Add to cart': 'In den Warenkorb legen',
        'View cart': 'Warenkorb ansehen',
        'Proceed to checkout': 'Zur Kasse gehen',
        'Coupon code': 'Gutscheincode',
        'APPLY COUPON': 'Gutschein anwenden',
        'UPDATE CART': 'Warenkorb aktualisieren',
        'Cart totals': 'Warenkorb Summe',
        'Subtotal': 'Zwischensumme',
        'Total': 'Gesamtsumme',
        'Shipping': 'Versand',
        'Description': 'Beschreibung',
        'Reviews': 'Bewertungen',
        'In Stock': 'Auf Lager',
        'Out of stock': 'Nicht vorrätig',
        'Remove this item': 'Dieses Produkt entfernen',
        'Your cart is currently empty.': 'Ihr Warenkorb ist derzeit leer.',
        'Return to shop': 'Zurück zum Shop',
        'Product': 'Produkt',
        'Quantity': 'Menge',
        'Remove': 'Entfernen',
        'Apply coupon': 'Gutschein anwenden',
        'Place order': 'Bestellung aufgeben',
        'Order details': 'Bestelldetails',
        'Continue shopping': 'Einkaufen fortsetzen',
        'Discount': 'Rabatt',
        'Free': 'Kostenlos',
        'Your order': 'Ihre Bestellung',
        'Checkout': 'Zur Kasse',
        'Related products': 'Ähnliche Produkte',
        'Share Now': 'Jetzt teilen',
        


        
        // Add more translations as needed
    };

    // Function to replace text in the entire document
    function replaceText(node) {
        if (node.nodeType === Node.TEXT_NODE) {
            let text = node.textContent;
            for (const [english, german] of Object.entries(translations)) {
                text = text.replace(new RegExp(english, 'g'), german);
            }
            node.textContent = text;
        } else if (node.nodeType === Node.ELEMENT_NODE && node.tagName !== 'SCRIPT' && node.tagName !== 'STYLE') {
            node.childNodes.forEach(replaceText);
        }
    }

    // Start replacing text from the body
    replaceText(document.body);
});
</script>
</body>
</html>
