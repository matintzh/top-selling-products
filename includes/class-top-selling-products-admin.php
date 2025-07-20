<?php

class TSP_Admin_Page {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            'Top Selling Products',
            'Top Selling Products',
            'manage_woocommerce',
            'top-selling-products',
            [$this, 'render_admin_page']
        );
    }

    public function render_admin_page() {
        
        $products = $this->get_top_selling_products();
        
        if (empty($products)) {
    echo '<p><strong>No top selling products found for the last 7 days.</strong></p>';
}
        ?>
        <div class="wrap">
            <h1>Top 12 Selling Products (Last 7 Days)</h1>
            <style>
                .tsp-grid { display: flex; flex-wrap: wrap; gap: 20px; }
                .tsp-product { border: 1px solid #ccc; padding: 10px; width: 200px; }
                .tsp-product img { max-width: 100%; height: auto; }
                .tsp-title { font-weight: bold; }
                .tsp-price { color: green; }
            </style>
            <div class="tsp-grid">
                <?php foreach ($products as $product): ?>
                    <div class="tsp-product">
                            <?= $product->get_image('medium'); ?>
                            <div class="tsp-title"><?= esc_html($product->get_name()); ?></div>
                        <div class="tsp-price"><?= wc_price($product->get_price()); ?></div>
                        <div>Sold: <?= esc_html($product->total_sold); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

   private function get_top_selling_products() {
    $date_7_days_ago = date('Y-m-d', strtotime('-7 days'));
	$today = date('Y-m-d');
	   
	   $args = [
        'status' => ['wc-completed', 'wc-processing', 'wc-on-hold'],
        'date_created' => "{$date_7_days_ago}...{$today}",
        'limit' => -1,
        'return' => 'objects',
    ];

    $orders = wc_get_orders($args);
    $product_sales = [];

    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            $product = $item->get_product();
            if (!$product) continue;

            $product_id = $product->get_id();
            $qty = $item->get_quantity();

            if (!isset($product_sales[$product_id])) {
                $product_sales[$product_id] = ['qty' => 0, 'product' => $product];
            }

            $product_sales[$product_id]['qty'] += $qty;
        }
    }

    uasort($product_sales, function ($a, $b) {
        return $b['qty'] <=> $a['qty'];
    });

    $top_products = array_slice($product_sales, 0, 12);

    $products = [];
    foreach ($top_products as $entry) {
        $entry['product']->total_sold = $entry['qty'];
        $products[] = $entry['product'];
    }

    return $products;
}




}

