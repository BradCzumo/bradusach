<?php
/**
 * WP Admin Buttons
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Registers a short code.
 * 
 * @since   0.0.2
 */
class WPAdminButtons_Shortcode {
    
    /**
     * Registers the shortcode.
     */
    public function __construct( $sShortCodeSlug ) {
        add_shortcode( $sShortCodeSlug, array( $this, 'replyToGetOutput' ) );
    }
    
    /**
     * Returns the output by the given argument.
     */
    public function replyToGetOutput( $aArguments ) {
        return getWPAdminButton( $aArguments );
    }    

}