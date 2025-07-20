<?php
/**
 * Plugin Name: Top Selling Products
 * Description: top 12 best-selling products
 * Version: 1.0
 * Author: Matin Sabernezhad
 */

if (!defined('ABSPATH')) exit;

define('TSP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TSP_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once TSP_PLUGIN_PATH . 'includes/class-top-selling-products-admin.php';
require_once TSP_PLUGIN_PATH . 'includes/class-top-selling-products-frontend.php';

class Top_Selling_Products_Plugin {
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {
        if (is_admin()) {
            new TSP_Admin_Page();
        }
        new TSP_Frontend_Shortcode();
    }
}

new Top_Selling_Products_Plugin();
