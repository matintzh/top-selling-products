<?php

class TSP_Frontend_Shortcode {
    public function __construct() {
        add_shortcode('top_selling_products', [$this, 'render_shortcode']);
    }

    public function render_shortcode($atts) {
        $products = $this->get_top_selling_products();

        ob_start();
        ?>
        <style>
            .tsp-frontend-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
            }
            .tsp-frontend-product {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: center;
            }
            .tsp-frontend-product img {
                max-width: 100%;
                height: auto;
            }
        </style>
        <div class="tsp-frontend-grid">
            <?php foreach ($products as $product): ?>
                <div class="tsp-frontend-product">
                        <?= $product->get_image('medium'); ?>
                        <h4><?= esc_html($product->get_name()); ?></h4>
                    <div><?= wc_price($product->get_price()); ?></div>
                    <small>Sold: <?= esc_html($product->total_sold); ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
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
