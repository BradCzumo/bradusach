<?php
if ( class_exists( 'WPAdminButtons_AdminPageFramework_FieldType' ) && ! class_exists( 'WPAdminButtons_MultiTextCustomFieldType' ) ) :
class WPAdminButtons_MultiTextCustomFieldType extends WPAdminButtons_AdminPageFramework_FieldType {
		
	/**
	 * Defines the field type slugs used for this field type.
	 */
	public $aFieldTypeSlugs = array( 'multi_text', );
	
	/**
	 * Defines the default key-values of this field type. 
	 * 
	 * @remark			$_aDefaultKeys holds shared default key-values defined in the base class.
	 */
	protected $aDefaultKeys = array(
		'label_min_width'	=> 80,
		'attributes'	=>	array(
			'size'	=>	10,
			'maxlength'	=>	400,
		),
		'label'			=>	array(
			// 'url'	=>	'URL',
			// 'title'	=>	'Title',
			// Add more as you need
		),
	);

	/**
	 * Returns the field type specific CSS rules.
	 */ 
	protected function getStyles() {
		return ".admin-page-framework-input-label-container.multi_text { padding-right: 0.5em;' }";
	}
	
	/**
	 * Returns the output of the field type.
	 */
	protected function getField( $aField ) { 

		return "<div class='repeatable-field-buttons'></div>"	// the repeatable field buttons will be replaced with this element.
			. $this->_getInputs( $aField )
			;
		
	}	
		private function _getInputs( $aField ) {		
			$_aOutput = array();
			foreach( ( array ) $aField['label'] as $_sSlug => $_sLabel ) {
				
				$_aAttributes = isset( $aField['attributes'][ $_sSlug ] ) && is_array( $aField['attributes'][ $_sSlug ] )
					? $aField['attributes'][ $_sSlug ] + $aField['attributes']
					: $aField['attributes'];
				$_aAttributes = array(
                    'type'  => 'text',
					'name'	=>	"{$_aAttributes['name']}[{$_sSlug}]",
					'id'	=>	"{$aField['input_id']}_{$_sSlug}",
					'value'	=>	isset( $aField['attributes']['value'][ $_sSlug ] ) ? $aField['attributes']['value'][ $_sSlug ] : '',
				) + $_aAttributes;
				$_aOutput[] = 
					"<div class='admin-page-framework-input-label-container multi_text'>"
                        . $this->getFieldElementByKey( $aField['before_label'], $_sSlug )
						. "<label for='{$aField['input_id']}_{$_sSlug}'>"
                            . $this->getFieldElementByKey( $aField['before_input'], $_sSlug )
							. "<span class='admin-page-framework-input-label-string' style='min-width:" .  $aField['label_min_width'] . "px;'>" 
								. $_sLabel
							. "</span>" . PHP_EOL					
							. "<input " . $this->generateAttributes( $_aAttributes ) . " />"
                            . $this->getFieldElementByKey( $aField['after_input'], $_sSlug )
						. "</label>"
                        . $this->getFieldElementByKey( $aField['after_label'], $_sSlug )
					. "</div>";				
			}
			return implode( PHP_EOL, $_aOutput );
		}

	
}
endif;