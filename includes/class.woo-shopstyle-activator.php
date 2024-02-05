<?php

class Woo_Shopstyle_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if (!class_exists('WooShopstyle')) {
            require plugin_dir_path(__FILE__) . 'class.woo-shopstyle.php';
        }
        if (!class_exists('ShopstyleGutenberg')) {
            require plugin_dir_path(__FILE__) . 'gutenberg/class.shopstyle-gutenberg.php';
        }
        flush_rewrite_rules();
    }
}