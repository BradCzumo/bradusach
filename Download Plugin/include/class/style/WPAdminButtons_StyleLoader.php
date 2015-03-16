<?php
/**
 * WP Admin Buttons
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Load admin styles.
 * 
 * @since   0.0.1
 */
class WPAdminButtons_StyleLoader {
    
    /**
     * Sets up hooks.
     */
    public function __construct() {
        
        add_action( 'wp_enqueue_scripts', array( $this, 'replyToLoadStyle' ) );
        
    }
    
    /**
     * Loads admin styles that define buttons in the front end.
     */
    public function replyToLoadStyle() {
    
        // http://localhost/wp_test/wp-admin/load-styles.php?c=1&dir=ltr&load=buttons
        wp_enqueue_style( 
            'wp-admin-buttons', 
            add_query_arg(
                array(  
                    'c'     => 1,
                    'dir'   => 'ltr',
                    'load'  => 'buttons,dashboard'
                ),
                admin_url( 'load-styles.php' )
            )
        );
        
    }
        
}