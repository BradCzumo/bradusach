<?php
/* 
    Plugin Name:    WP Admin Buttons
    Plugin URI:     http://en.michaeluno.jp/wp-admin-buttons
    Description:    Displays WordPress admin style buttons in the front end.
    Author:         Michael Uno
    Author URI:     http://michaeluno.jp
    Version:        1.0.2
*/

/**
 * The base registry information.
 * 
 * @since       0.0.1
 */
class WPAdminButtons_Registry_Base {

    const Version        = '1.0.2'; // <--- DON'T FORGET TO CHANGE THIS AS WELL!!
    const Name           = 'WP Admin Buttons'; // the full name.
    const ShortName      = 'WP Admin Buttons'; // used for a menu title etc.
    const Description    = 'Displays WordPress admin style buttons in the front end.';
    const URI            = 'http://en.michaeluno.jp/';
    const Author         = 'miunosoft (Michael Uno)';
    const AuthorURI      = 'http://en.michaeluno.jp/';
    const Copyright      = 'Copyright (c) 2015, Michael Uno';
    const License        = 'GPL v2 or later';
    const Contributors   = '';
	
}
/**
 * Provides plugin information.
 * 
 * The plugin will refer to these information.
 * 
 * @since       0.0.1
 * @remark      
 */
final class WPAdminButtons_Registry extends WPAdminButtons_Registry_Base {
	        
    /**
     * The plugin option key used for the options table.
     */
    static public $aOptionKeys = array(
        'main'    => 'wp_admin_buttons',
    );

    /**
     * The transient prefix. 
     * 
     * @remark      This is also accessed from uninstall.php so do not remove.
     * @remark      Up to 8 characters as transient name allows 45 characters or less ( 40 for site transients ) so that md5 (32 characters) can be added
     */
    const TransientPrefix = 'WPAB_';
    
    /**
     * The hook slug used for the prefix of action and filter hook names.
     * 
     * @remark      The ending underscore is not necessary.
     */
    const HookSlug = 'wp_admin_buttons';
        
    
    /**
     * The text domain slug and its path.
     * 
     * These will be accessed from the bootstrap script.
     */
    const TextDomain                = 'wp-admin-buttons';
    const TextDomainPath            = '/language';    
    	    
    // These properties will be defined in the setUp() method.
    static public $sFilePath = '';
    static public $sDirPath  = '';
	
    /**
     * Requirements.
     */    
    static public $aRequirements = array(
        'php' => array(
            'version'   => '5.2.4',
            'error'     => 'The plugin requires the PHP version %1$s or higher.',
        ),
        'wordpress'         => array(
            'version'   => '3.3',
            'error'     => 'The plugin requires the WordPress version %1$s or higher.',
        ),
        'mysql'             => array(
            'version'   => '5.0',
            'error'     => 'The plugin requires the MySQL version %1$s or higher.',
        ),
        'functions'     => '', // disabled
        // array(
            // e.g. 'mblang' => 'The plugin requires the mbstring extension.',
        // ),
        'classes'       => '', // disabled
        // array(
            // e.g. 'DOMDocument' => 'The plugin requires the DOMXML extension.',
        // ),
        'constants'     => '', // disabled
        // array(
            // e.g. 'THEADDONFILE' => 'The plugin requires the ... addon to be installed.',
            // e.g. 'APSPATH' => 'The script cannot be loaded directly.',
        // ),
        'files'         => '', // disabled
        // array(
            // e.g. 'home/my_user_name/my_dir/scripts/my_scripts.php' => 'The required script could not be found.',
        // ),
    );    
    
    /**
     * Used admin pages.
     */
    static public $aAdminPages = array(
        // key => 'page slug'
    );
    
    /**
     * Used post types.
     */
    static public $aPostTypes = array(
        // 'page'      => 'page',
    );
    
    /**
     * Used post types by meta boxes.
     */
    static public $aMetaBoxPostTypes = array(
        // 'page'      => 'page',
        // 'post'      => 'post',
    );
    
    /**
     * Used taxonomies.
     */
    static public $aTaxonomies = array(
    );
    
    /**
     * Used shortcode slugs
     */
    static public $sShortcodes = array(
        'main'  => 'wp_admin_button',    
    );
       
    /**
     * Sets up static properties.
     */
    static public function setUp( $sPluginFilePath = null ) {
	                    
        self::$sFilePath = $sPluginFilePath ? $sPluginFilePath : __FILE__;
        self::$sDirPath  = dirname( self::$sFilePath );
	    
    }    
	
    /**
     * Returns the URL with the given relative path to the plugin path.
     * 
     * Example:  WPAdminButtons_Registry::getPluginURL( 'asset/css/meta_box.css' );
     * @since       0.0.1
     * @return      string      The calculated url.
     */
    public static function getPluginURL( $sRelativePath = '' ) {
        return plugins_url( $sRelativePath, self::$sFilePath );
    }
    
    /**
     * Returns the information of this class.
     * 
     * @since       0.0.1
     */
    static public function getInfo() {
        $_oReflection = new ReflectionClass( __CLASS__ );
        return $_oReflection->getConstants()
            + $_oReflection->getStaticProperties()
        ;
    }    
    
    /**
     * Stores admin notices.
     * @since       0.0.1
     */
    static public $_aAdminNotices = array();
    /**
     * Sets an admin notice.
     * @since       0.0.1
     */ 
    static public function setAdminNotice( $sMessage, $sClassAttribute = 'error' ) {
        if ( !is_admin() ) { return; }
        self::$_aAdminNotices[ ] = array(
            'message'           => $sMessage,
            'class_attribute'   => $sClassAttribute,
        );
        add_action( 'admin_notices', array( __CLASS__, '_replyToSetAdminNotice' ) );
    }
        /**
         * Displayes the set admin notices.
         * @since       0.0.1
         */
        static public function _replyToSetAdminNotice() {
            foreach ( self::$_aAdminNotices as $_aAdminNotice ) {                
                echo "<div class='".esc_attr( $_aAdminNotice[ 'class_attribute' ] )."'>"
                        ."<p>" 
                            . sprintf( 
                                '<strong>%1$s</strong>: '.$_aAdminNotice[ 'message' ],
                                self::Name.' '.self::Version
                            )
                        . "</p>"
                    . "</div>";
            }
        }    
    
}
// Registry set-up.
WPAdminButtons_Registry::setUp( __FILE__ );

// Run the bootstrap script.    
include( dirname( __FILE__ ).'/include/library/admin-page-framework/wp-admin-buttons-admin-page-framework.min.php' );
include( dirname( __FILE__ ).'/include/class/boot/WPAdminButtons_Bootstrap.php' );
new WPAdminButtons_Bootstrap(
    WPAdminButtons_Registry::$sFilePath,
    WPAdminButtons_Registry::HookSlug    // hook prefix    
);