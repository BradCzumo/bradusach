<?php
/**
 * WP Admin Buttons
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Creates a widget.
 * 
 * @since   0.0.1
 */
class WPAdminButtons_Widget extends WPAdminButtons_AdminPageFramework_Widget {
    
    /**
     * The user constructor.
     * 
     * Alternatively you may use start_{instantiated class name} method.
     */
    public function start() {}
    
    /**
     * Sets up arguments.
     * 
     * Alternatively you may use set_up_{instantiated class name} method.
     */
    public function setUp() {

        // Custom Field type.
        $_sClassName = get_class( $this );
        new WPAdminButtons_MultiTextCustomFieldType( $_sClassName );
        new WPAdminButtons_RevealerCustomFieldType( $_sClassName );
        
        $this->setArguments( 
            array(
                'description'   => __( 'Displays buttons with the style used in the WordPress administration area.', 'wp-admin-buttons' ),
            ) 
        );
    
    }    

    /**
     * Sets up the form.
     * 
     * Alternatively you may use load_{instantiated class name} method.
     */
    public function load( $oAdminWidget ) {
            
        $this->_addBasicFields();
        $this->_addAttributeFields();        
        $this->_addTypeFields();
        $this->_addColorSections();
        
    }
    
        /**
         * Adds fields for basic settings.
         */
        private function _addBasicFields() {

            $this->addSettingFields(
                array(
                    'field_id'      => 'title',
                    'type'          => 'text',
                    'title'         => __( 'Widget Title', 'wp-admin-buttons' ),
                ),        
                array(
                    'field_id'      => 'label',
                    'type'          => 'text',
                    'title'         => __( 'Button Label', 'wp-admin-buttons' ),
                    'default'       => __( 'Download', 'wp-admin-buttons' )
                ),
                array(
                    'field_id'      => 'description',
                    'type'          => 'textarea',
                    'title'         => __( 'Description', 'wp-admin-buttons' ),
                ),
                array(
                    'field_id'      => 'description_position',
                    'type'          => 'radio',
                    'title'         => __( 'Description Position', 'wp-admin-buttons' ),
                    'label'         => array(
                        'above' => __( 'Above', 'wp-admin-button' ),
                        'below' => __( 'Below', 'wp-admin-button' ),
                    ),
                    'default'       => 'below',
                ),
                array()                
            );
        
        }    
        /**
         * Adds fields for attributes
         */
        private function _addAttributeFields() {    

            $this->addSettingFields(
                array(
                    'field_id'      => 'attributes',
                    'type'          => 'multi_text',
                    'title'         => __( 'Attributes', 'wp-admin-buttons' ),
                    'description'   => __( 'Set HTML attribute name-value pairs applied to the button <code>a</code> tag.', 'wp-admin-buttons' ),
                    'label'         => array(
                        'attribute' => __( 'Attribute', 'wp-admin-buttons' ),
                        'value' => __( 'Value', 'wp-admin-buttons' ),
                    ),
                    'repeatable'    => true,
                    'default'       => array(
                        'attribute' => 'href',
                        'value'     => 'http://www.wordpress.org',                    
                    ),
                )                         
            );
        
        }
        private function _addTypeFields() {
            
            $this->addSettingFields(
                array(
                    'field_id'      => 'size',
                    'type'          => 'select',
                    'title'         => __( 'Size', 'wp-admin-buttons' ),
                    'label'         => array(
                        'large'        => __( 'Large', 'wp-admin-buttons' ),
                        'medium'       => __( 'Medium', 'wp-admin-buttons' ),
                        'small'        => __( 'Small', 'wp-admin-buttons' ),
                    ),
                    'default'       => 'medium',
                ),     
                array(
                    'field_id'      => 'type',
                    'type'          => 'radio',
                    'title'         => __( 'Type', 'wp-admin-buttons' ),
                    'label'         => array(
                        'button-primary'   => __( 'Primary', 'wp-admin-buttons' ),
                        'button-secondary' => __( 'Secondary', 'wp-admin-buttons' ),
                    ),
                    'default'       => 'button-primary',
                )  
            );        
            
        }        
        /**
         * Adds color fields
         */
        private function _addColorSections() {
            
            // Revealer 
            $this->addSettingFields(
                array(
                    'field_id'      => 'toggle_color',
                    'type'          => 'revealer',
                    'select_type'   => 'checkbox',
                    'title'         => __( 'Custom Color', 'wp-admin-buttons' )
                        . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                    'label'         => array( // the keys represent the selector to reveal, in this case, their tag id : #fieldrow-{section id}_{field id}
                        '.custom_colors' => __( 'Set Custom Color', 'wp-admin-buttons' ),
                    ),
                    'default'       => array( 
                        '.custom_colors' => false,
                    ),
                )
            );
            
            // Color Sections
            $this->_addCustomColorFields( 'custom_colors' );
            $this->_addCustomColorFields( 'custom_colors_on_mouse_hover', ' ' . __( 'on Mouse Over', 'wp-admin-buttons' ) );
            
        }
            private function _addCustomColorFields( $sSectionID, $sSubTitle='' ) {
            
                 $this->addSettingSections(            
                    array(
                       'section_id'     => $sSectionID,
                       'hidden'         => true,
                       'class'          => 'custom_colors', // appends to a class attribute
                    )
                );            
                $this->addSettingFields(
                    $sSectionID,
                    array(
                        'field_id'      => 'background_color',
                        'type'          => 'color',
                        'title'         => __( 'Background Color', 'wp-admin-buttons' ) . $sSubTitle
                            . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                        'default'       => '', // prevent the value 'transparent' to be set
                        'description'   => 'e.g. <code>transparent</code>', 
                    ),
                    array(
                        'field_id'      => 'border_color',
                        'type'          => 'color',
                        'title'         => __( 'Border Color', 'wp-admin-buttons' ) . $sSubTitle
                            . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',                
                        'default'   => '', // prevent the value 'transparent' to be set
                    ),                         
                    array(
                        'field_id'      => 'color',
                        'type'          => 'color',
                        'title'         => __( 'Label Color', 'wp-admin-buttons' ) . $sSubTitle
                            . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                        'default'   => '', // prevent the value 'transparent' to be set                    
                    )
                );
            }

    /**
     * Validates the submitted form data.
     * 
     * Alternatively you may use validation_{instantiated class name} method.
     * @return      array       The filtered submitted user input array.
     */
    public function validate( $aSubmit, $aStored, $oAdminWidget ) {
        return $aSubmit;
    }    
    
    /**
     * Print out the contents in the front-end.
     * 
     * Alternatively you may use the content_{instantiated class name} method.
     * @return      string      The content output.
     */
    public function content( $sContent, $aArguments, $aFormData ) {
        return $sContent
            . getWPAdminButton( 
                array( 
                    // the plugin output function needs the 'title' key, not title_attribute
                    'title' => isset( $aFormData['title_attribute'] ) ? $aFormData['title_attribute'] : '',
                )
                + $aFormData 
                + $aArguments 
            )
            ;
    }
        
}