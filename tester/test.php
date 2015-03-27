<?php
/*
 * Plugin Name: Image Enlarger
 * Plugin URI: https://phoenix.sheridanc.on.ca/~ccit2639/?page_id=146
 * Description: This is a photo enlarger
 * Author: bradusach
 * Version: 1.0
 * Author URI: http://phoenix.sheridanc.on.ca/~ccit2639
 */


function bds__add_admin_menu(  ) { 

	add_menu_page( 'Image Enlarger', 'Image Enlarger', 'manage_options', 'my__plugin', 'my__plugin_options_page', 'dashicons-hammer', 66 );

}


function bds__settings_init(  ) { 

	register_setting( 'plugin_page', 'bds__settings' );
	
	add_settings_section(
		'bds__plugin_page_section', 
		__( 'Description for the section', 'bradusach' ), 
		'bds__settings_section_callback', 
		'plugin_page'
	);

	add_settings_field( 
		'bds__text_field_0', 
		__( 'Image 1 URL', 'bradusach' ), 
		'bds__text_field_0_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);
	
	add_settings_field( 
		'bds__text_field_1', 
		__( 'Image 2 URL', 'bradusach' ), 
		'bds__text_field_1_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);

	add_settings_field( 
		'bds__text_field_2', 
		__( 'Image 3 URL', 'bradusach' ), 
		'bds__text_field_2_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);	

	add_settings_field( 
		'bds__text_field_3', 
		__( 'Image 4 URL', 'bradusach' ), 
		'bds__text_field_3_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);	

	add_settings_field( 
		'bds__text_field_4', 
		__( 'Image 5 URL', 'bradusach' ), 
		'bds__text_field_4_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);		


	add_settings_field( 
		'bds__radio_field_2', 
		__( 'Choose an option', 'bradusach' ), 
		'bds__radio_field_2_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);



	add_settings_field( 
		'bds__select_field_4', 
		__( 'Select a Color', 'bradusach' ), 
		'bds__select_field_4_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);


}

function bds__text_field_0_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_0]" value="<?php if (isset($options['bds__text_field_0'])) echo $options['bds__text_field_0']; ?>">
	<?php
}


function bds__text_field_1_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_1]" value="<?php if (isset($options['bds__text_field_1'])) echo $options['bds__text_field_1']; ?>">
	<?php
}
function bds__text_field_2_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_2]" value="<?php if (isset($options['bds__text_field_2'])) echo $options['bds__text_field_2']; ?>">
	<?php
}
function bds__text_field_3_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_3]" value="<?php if (isset($options['bds__text_field_3'])) echo $options['bds__text_field_3']; ?>">
	<?php
}
function bds__text_field_4_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_4]" value="<?php if (isset($options['bds__text_field_4'])) echo $options['bds__text_field_4']; ?>">
	<?php
}



function bds__radio_field_2_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="radio" name="bds__settings[bds__radio_field_2]" <?php if (isset($options['bds__radio_field_2'])) checked( $options['bds__radio_field_2'], 1 ); ?> value="1">
	<?php
}





function bds__select_field_4_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<select name="bds__settings[bds__select_field_4]">
		<option value="1" <?php if (isset($options['bds__select_field_4'])) selected( $options['bds__select_field_4'], 1 ); ?>>Black</option>
		<option value="2" <?php if (isset($options['bds__select_field_4'])) selected( $options['bds__select_field_4'], 2 ); ?>>Grey</option>
	</select>
<?php
}


function bds__settings_section_callback() { 
	echo __( 'Choose the Prefered image that will be the thumbnail and selected, <br> Edit custom colors as well </br>', 'bradusach' );
}


function my__plugin_options_page() { 
	?>
	<form action="options.php" method="post">
		
		<h2>Image Enlarger Plugin</h2>
		
		<?php
		settings_fields( 'plugin_page' );
		do_settings_sections( 'plugin_page' );
		submit_button();
		?>
		
	</form>
	<?php

}

add_action( 'admin_menu', 'bds__add_admin_menu' );
add_action( 'admin_init', 'bds__settings_init' );	



function my__plugin_callit(){
	$options = get_option( 'bds__settings' );
	// Black border around the text box around the image, echoing out the Http to make it
	echo '<div style="border: 1px solid black; width: 50%;">';
	// If then for when the radio button from the back end is checked off, the image and selected will enlarge  to the size of 700
	if (isset($_POST['testname'])) {
		$selected_radio = $_POST['testname'];
		echo '<img src="' . $selected_radio . '" width="700" />';
	}
	else {
		echo 'Please select an image to enlarge';
	}

	echo '<br />';
	echo '</div>';
	
	
	echo '<form method="post">';
	
	/*beginning of echoing out all the text fields that are defined in the back end. This will call them on the 
	front end to the image the user has chosen
	*/
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_0'] . '" class="image-choose" width="200" height="200" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_0'] . '">';
	echo '</div>';
	
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_1'] . '" class="image-choose" width="200" height="200" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_1'] . '">';
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_2'] . '" class="image-choose" width="200" height="200" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_2'] . '">';
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_3'] . '" class="image-choose" width="200" height="200" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_3'] . '">';
	echo '</div>';

	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_4'] . '" class="image-choose" width="200" height="200" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_4'] . '">';
	echo '</div>';
	
	
	echo '<br />';
	
	
	echo '<input type="submit" name="dlsubmit" value="Enlarge">';
	
	echo '</form>';
	
	
	echo '<p>Radio: ' . $options['bds__radio_field_2'] . '</p>';
	

}	

add_filter('the_content', 'my__plugin_callit');	


?>