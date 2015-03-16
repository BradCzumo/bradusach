<?php
/**
 * Loads the pluigin
 *    
 * @package      WP Admin Buttons
 * @copyright    Copyright (c) 2015, <Michael Uno>
 * @author       Michael Uno
 * @authorurl    http://michaeluno.jp
 * @since        0.0.1
 * 
 */


/**
 * Loads the plugin.
 * 
 * @action      do      wp_admin_buttons_action_after_loading_plugin
 * @since       0.0.1
 */
final class WPAdminButtons_Bootstrap extends WPAdminButtons_AdminPageFramework_PluginBootstrap {
    
    /**
     * Register classes to be auto-loaded.
     * 
     * @since       0.0.1
     */
    public function getClasses() {
        
        // Include the include lists. The including file reassigns the list(array) to the $_aClassFiles variable.
        $_aClassFiles   = array();
        $_bLoaded       = include( dirname( $this->sFilePath ) . '/include/class-list.php' );
        if ( ! $_bLoaded ) {
            return $_aClassFiles;
        }
        return $_aClassFiles;
                
    }

    /**
     * The plugin activation callback method.
     */    
    public function replyToPluginActivation() {

        $this->_checkRequirements();
        
    }
        /**
         * 
         * @since            0.0.1
         */
        private function _checkRequirements() {

            $_oRequirementCheck = new WPAdminButtons_AdminPageFramework_Requirement(
                WPAdminButtons_Registry::$aRequirements,
                WPAdminButtons_Registry::Name
            );
            
            if ( $_oRequirementCheck->check() ) {            
                $_oRequirementCheck->deactivatePlugin( 
                    $this->sFilePath, 
                    __( 'Deactivating the plugin', 'wp-admin-buttons' ),  // additional message
                    true    // is in the activation hook. This will exit the script.
                );
            }        
             
        }    
    
        
    /**
     * Load localization files.
     * 
     * @remark      A callback for the 'init' hook.
     */
    public function setLocalization() {
        
        // This plugin does not have messages to be displayed in the front end.
        if ( ! $this->bIsAdmin ) { return; }
        
        load_plugin_textdomain( 
            WPAdminButtons_Registry::TextDomain, 
            false, 
            dirname( plugin_basename( $this->sFilePath ) ) . '/' . WPAdminButtons_Registry::TextDomainPath
        );
        
    }        
    
    /**
     * Loads the plugin specific components. 
     * 
     * @remark        All the necessary classes should have been already loaded.
     */
    public function setUp() {
            
        $this->_include();
            
        new WPAdminButtons_Shortcode( WPAdminButtons_Registry::$sShortcodes['main'] );
        
        new WPAdminButtons_StyleLoader;
        
        new WPAdminButtons_Widget( __( 'WP Admin Buttons', 'wp-admin-buttons' ) );
        
    }
        /**
         * Includes additional files.
         */
        private function _include() {
            
            // Functions
            include( dirname( $this->sFilePath ) . '/include/function/functions.php' );
            
        }
    
}