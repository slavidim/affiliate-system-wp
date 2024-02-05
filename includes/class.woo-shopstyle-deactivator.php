<?php

class Woo_Shopstyle_Deactivator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        // flush the rewrite rules to make sure the custom post type URLs will work
        flush_rewrite_rules();
    }
}

