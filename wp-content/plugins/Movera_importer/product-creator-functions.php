<?php
/**
 * Create or update WooCommerce products from the database.
 */

// Include shared functions
require_once(plugin_dir_path(__FILE__) . 'shared-functions.php');

if (!function_exists('create_woocommerce_products_from_db')) {
    function create_woocommerce_products_from_db() {
        global $wpdb;

        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            echo "<p>WooCommerce is not active. Please activate WooCommerce to use this feature.</p>";
            return;
        }

        // Fetch data from your custom table
        $results = $wpdb->get_results("SELECT * FROM wp_movera");

        if (empty($results)) {
            echo "<p>No products found in the database.</p>";
            return;
        }

        $counter = 0;
        foreach ($results as $row) {
            $counter++;
            error_log("Processing product #{$counter}: " . $row->name);

            // Check if product already exists by mainnumber (unique identifier)
            $existing_product_id = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_ordernumber' AND meta_value = %s",
                    $row->ordernumber
                )
            );

            // Decode HTML entities and preserve safe HTML tags in the description
            $cleaned_description = wp_kses_post(html_entity_decode($row->description_long));

            if ($existing_product_id) {
                // Update existing product
                $product_data = [
                    'ID'           => $existing_product_id,
                    'post_title'   => $row->name,
                    'post_content' => $cleaned_description,
                    'post_status'  => 'publish',
                ];

                // Update the product
                $product_id = wp_update_post($product_data);

                if (is_wp_error($product_id)) {
                    error_log("Error updating product '{$row->name}': " . $product_id->get_error_message());
                    continue;
                }

                // Update product metadata
                update_post_meta($product_id, '_regular_price', $row->VK);
                update_post_meta($product_id, '_price', $row->VK);
                update_post_meta($product_id, '_stock', $row->lagerbestand);
                update_post_meta($product_id, '_sku', $row->suppliernumber);
                update_post_meta($product_id, '_mainnumber', $row->mainnumber);
                update_post_meta($product_id, '_ordernumber', $row->ordernumber);
                update_post_meta($product_id, '_stock_info', "Noch " . $row->lagerbestand . " Artikel ONLINE vorrätig");

                // Add delivery time
                if (!empty($row->lieferzeit)) {
                    update_post_meta($product_id, '_lieferzeit', $row->lieferzeit);
                    error_log("Delivery time updated for product '{$row->name}' (ID: {$product_id}): {$row->lieferzeit}");
                }

                // Add tax information
                if (!empty($row->tax)) {
                    $tax_message = sprintf(
                        'Enthält %d%% MwSt. zzgl. <a href="/versand-lieferung/" style="color: blue; text-decoration: none;">Versand</a>',
                        $row->tax
                    );
                    update_post_meta($product_id, '_tax_info', $tax_message);
                }

                // Add property values
                if (!empty($row->propertyValueName)) {
                    update_post_meta($product_id, '_propertyValueName', $row->propertyValueName);
                    error_log("Property Value updated for product '{$row->name}' (ID: {$product_id}): {$row->propertyValueName}");
                }

                // Add additional fields for "Zusätzliche Informationen"
                if (!empty($row->VariantDescription)) {
                    update_post_meta($product_id, '_VariantDescription', $row->VariantDescription);
                }
                if (!empty($row->weight)) {
                    update_post_meta($product_id, '_weight', $row->weight);
                }
                if (!empty($row->configuratorOptions)) {
                    update_post_meta($product_id, '_configuratorOptions', $row->configuratorOptions);
                }
                if (!empty($row->propertyValueName_5)) {
                    update_post_meta($product_id, '_propertyValueName_5', $row->propertyValueName_5);
                }
                if (!empty($row->ghsSignalWord)) {
                    update_post_meta($product_id, '_ghsSignalWord', $row->ghsSignalWord);
                }
                if (!empty($row->EnergieLabel)) {
                    update_post_meta($product_id, '_EnergieLabel', $row->EnergieLabel);
                }
                if (!empty($row->energyLabelColour)) {
                    update_post_meta($product_id, '_energyLabelColour', $row->energyLabelColour);
                }
                if (!empty($row->accessory)) {
                    update_post_meta($product_id, '_accessory', $row->accessory);
                }

                // Download and attach images
                if (!empty($row->imageURL)) {
                    $result = download_and_attach_images($row->imageURL, $product_id);
                    if (is_wp_error($result)) {
                        error_log("Error processing images for product '{$row->name}' (ID: {$product_id}): " . $result->get_error_message());
                    } else {
                        error_log("Images processed for product '{$row->name}' (ID: {$product_id}).");
                    }
                }
            } else {
                // Create new product
                $product_data = [
                    'post_title'   => $row->name,
                    'post_content' => $cleaned_description,
                    'post_status'  => 'publish',
                    'post_type'    => 'product',
                ];

                // Insert the product
                $product_id = wp_insert_post($product_data);

                if (is_wp_error($product_id)) {
                    error_log("Error creating product '{$row->name}': " . $product_id->get_error_message());
                    continue;
                }

                // Set product metadata
                update_post_meta($product_id, '_regular_price', $row->VK);
                update_post_meta($product_id, '_price', $row->VK);
                update_post_meta($product_id, '_stock', $row->lagerbestand);
                update_post_meta($product_id, '_sku', $row->suppliernumber);
                update_post_meta($product_id, '_mainnumber', $row->mainnumber);
                update_post_meta($product_id, '_ordernumber', $row->ordernumber);
                update_post_meta($product_id, '_stock_info', "Noch " . $row->lagerbestand . " Artikel ONLINE vorrätig");

                // Add delivery time
                if (!empty($row->lieferzeit)) {
                    update_post_meta($product_id, '_lieferzeit', $row->lieferzeit);
                }

                // Add tax information
                if (!empty($row->tax)) {
                    $tax_message = sprintf(
                        'Enthält %d%% MwSt. zzgl. <a href="/versand-lieferung/" style="color: blue; text-decoration: none;">Versand</a>',
                        $row->tax
                    );
                    update_post_meta($product_id, '_tax_info', $tax_message);
                }

                // Add property values
                if (!empty($row->propertyValueName)) {
                    update_post_meta($product_id, '_propertyValueName', $row->propertyValueName);
                    error_log("Property Value updated for product '{$row->name}' (ID: {$product_id}): {$row->propertyValueName}");
                }

                // Add additional fields for "Zusätzliche Informationen"
                if (!empty($row->VariantDescription)) {
                    update_post_meta($product_id, '_VariantDescription', $row->VariantDescription);
                }
                if (!empty($row->weight)) {
                    update_post_meta($product_id, '_weight', $row->weight);
                }
                if (!empty($row->configuratorOptions)) {
                    update_post_meta($product_id, '_configuratorOptions', $row->configuratorOptions);
                }
                if (!empty($row->propertyValueName_5)) {
                    update_post_meta($product_id, '_propertyValueName_5', $row->propertyValueName_5);
                }
                if (!empty($row->ghsSignalWord)) {
                    update_post_meta($product_id, '_ghsSignalWord', $row->ghsSignalWord);
                }
                if (!empty($row->EnergieLabel)) {
                    update_post_meta($product_id, '_EnergieLabel', $row->EnergieLabel);
                }
                if (!empty($row->energyLabelColour)) {
                    update_post_meta($product_id, '_energyLabelColour', $row->energyLabelColour);
                }
                if (!empty($row->accessory)) {
                    update_post_meta($product_id, '_accessory', $row->accessory);
                }

                // Download and attach images
                if (!empty($row->imageURL)) {
                    $result = download_and_attach_images($row->imageURL, $product_id);
                    if (is_wp_error($result)) {
                        error_log("Error processing images for product '{$row->name}' (ID: {$product_id}): " . $result->get_error_message());
                    } else {
                        error_log("Images processed for product '{$row->name}' (ID: {$product_id}).");
                    }
                }
            }
        }
        error_log("Total products processed: {$counter}");
    }
}
?>