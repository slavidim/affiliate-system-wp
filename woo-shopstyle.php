<?php
/*
Plugin Name:  Shopstyle Affiliate System for Wordpress.
Plugin URI:   https://dmitridev.com
Description:  Shopstyle affiliate system products for Wordpress and Woocommerce. Gutenberg block with products.
Version:      1.0
Author:       Dmitri Slavinschi
Author URI:   https://dmitridev.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  shopstyle-wordpress-woo
Domain Path:  /EN
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SHSTYLEWP_VERSION', '5.3' );
define( 'SHSTYLEWP__MINIMUM_WP_VERSION', '5.8' );
define( 'SHSTYLEWP_PLUGIN', __FILE__ );

define( 'SHSTYLEWP_PLUGIN_DIR',
    untrailingslashit( plugins_url( '', SHSTYLEWP_PLUGIN ) )
);

if (!function_exists('get_plugin_data')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$plugin_data = get_plugin_data(
    plugin_dir_path(__FILE__) . 'woo-shopstyle.php'
);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class.woo-shopstyle-activator.php
 */
function activate_woo_shopstyle()
{
    require_once plugin_dir_path(__FILE__) .
        'includes/class.woo-shopstyle-activator.php';
    Woo_Shopstyle_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class.woo-shopstyle-deactivator.php
 */
function deactivate_woo_shopstyle()
{
    require_once plugin_dir_path(__FILE__) .
        'includes/class.woo-shopstyle-deactivator.php';
    Woo_Shopstyle_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_woo_shopstyle');
register_deactivation_hook(__FILE__, 'deactivate_woo_shopstyle');

require plugin_dir_path(__FILE__) . 'includes/class.woo-shopstyle.php';