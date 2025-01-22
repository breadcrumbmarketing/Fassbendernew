<?php
/*
Plugin Name: CSV Importer to wp_movera
Description: Imports CSV files into wp_movera table and creates WooCommerce products.
Version: 1.0
Author: Hamy Vosugh
*/

ini_set('memory_limit', '512M'); // Increase memory limit to 512MB

// Hook for adding admin menus
add_action('admin_menu', 'csv_importer_menu');

function csv_importer_menu() {
    // Main menu
    add_menu_page(
        'CSV Importer',           // Page title
        'CSV Importer',           // Menu title
        'manage_options',         // Capability
        'csv_importer',           // Menu slug
        'csv_importer_page',      // Callback function
        'dashicons-upload',       // Icon
        26                        // Position
    );

    // Submenu for CSV import
    add_submenu_page(
        'csv_importer',           // Parent slug
        'Import CSV',             // Page title
        'Import CSV',             // Menu title
        'manage_options',         // Capability
        'csv_importer',           // Menu slug
        'csv_importer_page'       // Callback function
    );

    // Submenu for product automation
    add_submenu_page(
        'csv_importer',           // Parent slug
        'Create Products',        // Page title
        'Create Products',        // Menu title
        'manage_options',         // Capability
        'create_products',        // Menu slug
        'csv_importer_create_products_page' // Callback function
    );
}

// Function to display the CSV Import page
function csv_importer_page() {
    ?>
    <h2>Import CSV to wp_movera</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="file" id="file" accept=".csv">
        <input type="submit" name="import" value="Import">
    </form>
    <?php
    if (isset($_POST['import'])) {
        require_once(plugin_dir_path(__FILE__) . 'csv-importer-functions.php');
        handle_csv_import();
    }
}

// Function to display the Create Products page
function csv_importer_create_products_page() {
    ?>
    <h2>Create Products from wp_movera</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="create_products">
        <input type="submit" name="create_products" value="Create Products">
    </form>
    <?php
    if (isset($_POST['create_products'])) {
        require_once(plugin_dir_path(__FILE__) . 'product-creator-functions.php');
        create_woocommerce_products_from_db();
    }
}


?>