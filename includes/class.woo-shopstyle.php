<?php
if(!class_exists('WooShopstyle')) {

    class WooShopstyle
    {

        public function __construct() {
            add_action('admin_enqueue_scripts', [$this, 'woo_shopstyle_assets']);
            add_action('admin_footer', [$this, 'woo_shopstyle_open_button']);
            add_action('admin_menu', [$this, 'woo_shopstyle_admin_page']);
            add_action('admin_footer', function() {
                register_setting( 'wooshop-settings', 'wooshop_clientID' );
                $this->generateApiUrl();
            });
        }

        protected $apiUrl = 'https://fakeAPI/api/v2/products?pid=uid4356-40099934-38';

        function generateApiUrl() {
            $dsApiKey = !empty(get_option('wooshop_clientID')) ? get_option('wooshop_clientID'):'empty';
            $js = "productsApiUrl = \"https://fakeAPI/api/v2/products?limit=48&pid=$dsApiKey\";";
            echo "<script type='text/javascript'> totlalProducts = 0; checkKey = \"$dsApiKey\";".$js."</script>";
        }

        /**
         * Registered CSS & JS.
         */
        function woo_shopstyle_assets() {
            wp_enqueue_script( 'wooshopstyle-js', SHSTYLEWP_PLUGIN_DIR . '/dist/app.js', array(), '1.0' );
            wp_enqueue_style( 'wooshopstyle-css', SHSTYLEWP_PLUGIN_DIR . '/dist/app.css', array(), '1.0' );
        }

        /**
         * Add Popup Container for products.
         */
        function woo_shopstyle_open_button() {
            echo '<div id="wooshop-button"></div>';
        }

        /**
         * Register a custom menu page.
         */
        function woo_shopstyle_admin_page() {
            add_menu_page(
                esc_html__('Woo Shopstyle', 'woo-shopstyle'),
                esc_html__('Woo Shopstyle', 'woo-shopstyle'),
                'manage_options',
                'woo-shopstyle',
                array(&$this, 'load_admin_page_content'),
                'dashicons-admin-page'
            );
        }

        /**
         * Get Client ID - option field.
         */
        function get_client_id() {
            $clientID = get_option('wooshop_clientID');

            return $clientID;
        }

        function load_admin_page_content()
        { ?>
            <div class="wooshop-admin-page">
                <h1>Woo Shopstyle Settings</h1>
                <div class="wooshop-admin-page-settings">
                    <form method="POST" action="options.php" class="wooshop-admin-page-settings__form">
                        <?php
                            settings_fields( 'wooshop-settings' );
                            do_settings_sections( 'wooshop-settings' );
                        ?>
                        <input id="clientID" name="wooshop_clientID" class="wooshop-admin-page-client-id" type="text" value="<?php echo esc_attr( get_option('wooshop_clientID') ); ?>" placeholder="Insert Shopstyle ID">
                        <?= submit_button('Save Option'); ?>
                    </form>
                </div>
                <?= $this->wooshop_container_products(); ?>
            </div>
        <?php }

        function wooshop_container_products() {
            $args = array(
                'taxonomy'     => 'product_cat',
                'orderby'      => 'name',
                'show_count'   => 0,
                'pad_counts'   => 0,
                'hierarchical' => 1,
                'title_li'     => '',
                'hide_empty'   => 0
            );
            $all_categories = get_categories( $args );
        ?>
            <div class="wooshop-admin-page__container-products">
                <h1>Import Products</h1>
                <div class="wooshop-admin-page__container-products--shopstyle-cats">
                    <h2>Shopstyle Categories</h2>
                </div>
                <div class="wooshop-admin-page__container-products--left-side">
                    <h2>Shopstyle Products</h2>
                    <div id="wooshopProducts" class="wooshop-admin-page__container-products--loaded">
                        Shopstyle Products
                    </div>
                    <div class="wooshop-admin-page__container-products--load-more-button">
                        <button type="button" id="loadMoreButton">Load more</button>
                    </div>
                </div>
                <div class="wooshop-admin-page__container-products--categories">
                    <h2>Woocommerce Categories</h2>
                    <?php if($all_categories): ?>
                        <ul>
                            <?php foreach ($all_categories as $cat): ?>
                                <li>
                                    <label for="<?=$cat->name;?>">
                                        <input type="checkbox" value="<?= $cat->term_id ?>" name="<?=$cat->name;?>">
                                        <?=$cat->name;?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        Categories doesn't exist!
                    <?php endif; ?>
                </div>
                <div class="wooshop-admin-page__container-products--right-side">
                    <h2>For Woocommerce</h2>
                    <div id="wooshopProductsWoo" class="wooshop-admin-page__container-products--import">
                        <ul></ul>
                    </div>
                </div>
                <div class="wooshop-admin-page__container-products--import-button">
                    <button>Start Import</button>
                </div>
            </div>
        <?php }
    }
    $plugin = new WooShopstyle();
}