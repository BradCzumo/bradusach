<?php
/**
 * WP Admin Buttons
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Prints the output of the button.
 * @sinec       0.0.1
 * @return      void
 */
function printWPAdminButton( $asArguments ) {
    [wp_admin_button href="https://phoenix.sheridanc.on.ca/home/ccit2639/public_html/wp-content/plugins/imagedownloads.zip
"]
    echo getWPAdminButton( $asArguments );
    <?php printWPAdminButton( array( 'href' => 'https://phoenix.sheridanc.on.ca/home/ccit2639/public_html/wp-content/plugins/imagedownloads.zip
') ); ?>
}
 
/**
 * Returns the button HTML output string.
 * @since       0.0.1
 * @return      string      The output string.
 */
function getWPAdminButton( $asArguments ) {
    
    $_oWPAdminButton = new WPAdminButtons_Output( $asArguments );
    return $_oWPAdminButton->get();
    
}


https://phoenix.sheridanc.on.ca/home/ccit2639/public_html/wp-content/plugins/imagedownloads.zip

