<?php
/*
 * Plugin Name: Image Enlarger
 * Plugin URI: https://phoenix.sheridanc.on.ca/~ccit2639/?page_id=146
 * Description: This is a photo enlarger
 * Author: bradusach
 * Version: 1.0
 * Author URI: http://phoenix.sheridanc.on.ca/~ccit2639
 */


function plugin_on_pages_shortcode(){
	include(test.php);
}


/**
 * Enqueue scripts and styles
 */
function enlarger_scripts() {
    wp_enqueue_style( 'core', 'https://phoenix.sheridanc.on.ca/~ccit2639/wp-content/plugins/enlarger/style.css', false ); 
}


// adds our admin panel to the backend, we can also set our dashicon ! :) external is an
//icon that resembles an image being enlarged or moved, which is why we used it. 
function bds__add_admin_menu(  ) { 

	add_menu_page( 'Image Enlarger', 'Image Enlarger', 'manage_options', 'my__plugin', 'my__plugin_options_page', 'dashicons-external', 66 );

}

//Declare our image urls that we will be using in our enlargment gallery. on the backend
//this is where you would place each url, and set the colour of the enlarge button
//radio button functionality also starts here. 
function bds__settings_init(  ) { 
//registers our settings page in back end
	register_setting( 'plugin_page', 'bds__settings' );
	
	add_settings_section(
		'bds__plugin_page_section', 
		__( 'Description for the section', 'bradusach' ), 
		'bds__settings_section_callback', 
		'plugin_page'
	);
//image url render box 1
	add_settings_field( 
		'bds__text_field_0', 
		__( 'Image 1 URL', 'bradusach' ), 
		'bds__text_field_0_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);
	//image url render box 2
	add_settings_field( 
		'bds__text_field_1', 
		__( 'Image 2 URL', 'bradusach' ), 
		'bds__text_field_1_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);
//image url render box 3
	add_settings_field( 
		'bds__text_field_2', 
		__( 'Image 3 URL', 'bradusach' ), 
		'bds__text_field_2_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);	
//image url render box 4
	add_settings_field( 
		'bds__text_field_3', 
		__( 'Image 4 URL', 'bradusach' ), 
		'bds__text_field_3_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);	
//image url render box 5
	add_settings_field( 
		'bds__text_field_4', 
		__( 'Image 5 URL', 'bradusach' ), 
		'bds__text_field_4_render', 
		'plugin_page', 
		'bds__plugin_page_section' 
	);		



}
//if image 1 url exists push it out to be echoed
function bds__text_field_0_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_0]" value="<?php if (isset($options['bds__text_field_0'])) echo $options['bds__text_field_0']; ?>">
	<?php
}

//if image 2 url exists push it out to be echoed
function bds__text_field_1_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_1]" value="<?php if (isset($options['bds__text_field_1'])) echo $options['bds__text_field_1']; ?>">
	<?php
}
//if image 3 url exists push it out to be echoed
function bds__text_field_2_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_2]" value="<?php if (isset($options['bds__text_field_2'])) echo $options['bds__text_field_2']; ?>">
	<?php
}
//if image 4 url exists push it out to be echoed
function bds__text_field_3_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_3]" value="<?php if (isset($options['bds__text_field_3'])) echo $options['bds__text_field_3']; ?>">
	<?php
}
//if image 5 url exists push it out to be echoed
function bds__text_field_4_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="text" name="bds__settings[bds__text_field_4]" value="<?php if (isset($options['bds__text_field_4'])) echo $options['bds__text_field_4']; ?>">
	<?php
}


//if radio button is selected push to be enlarged
function bds__radio_field_2_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<input type="radio" name="bds__settings[bds__radio_field_2]" <?php if (isset($options['bds__radio_field_2'])) checked( $options['bds__radio_field_2'], 1 ); ?> value="1">
	<?php
}




//colour selection button, if selected push to be called and executed
function bds__select_field_4_render() { 
	$options = get_option( 'bds__settings' );
	?>
	<select name="bds__settings[bds__select_field_4]">
		<option value="1" <?php if (isset($options['bds__select_field_4'])) selected( $options['bds__select_field_4'], 1 ); ?>>Black</option>
		<option value="2" <?php if (isset($options['bds__select_field_4'])) selected( $options['bds__select_field_4'], 2 ); ?>>Grey</option>
	</select>
<?php
}

//backend user interface, only visible to admin to insturct on use of plugin
function bds__settings_section_callback() { 
	echo __( 'Choose the Prefered image that will be the thumbnail and selected, <br> Edit custom colors as well </br>', 'bradusach' );
}

//temporary options select option
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
// settings and admin menu
add_action( 'admin_menu', 'bds__add_admin_menu' );
add_action( 'admin_init', 'bds__settings_init' );	



function my__plugin_callit(){
	$options = get_option( 'bds__settings' );
	// If then for when the radio button from the back end is checked off, the image and selected will enlarge  to the size of 700
	if (isset($_POST['testname'])) {
		$selected_radio = $_POST['testname'];
		echo '<img src="' . $selected_radio . '" width="995" />';
	}
	//front end echos, instructions to website visitors on how to interact with plugin
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
	echo '<img src="' . $options['bds__text_field_0'] . '" class="image-choose0" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_0'] . '">';
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_1'] . '" class="image-choose1" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_1'] . '">';
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_2'] . '" class="image-choose2"/>';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_2'] . '">';
	echo '</div>';
	
	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_3'] . '" class="image-choose3" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_3'] . '">';
	echo '</div>';

	echo '<div style="float: left;">';
	echo '<img src="' . $options['bds__text_field_4'] . '" class="image-choose4" />';
	echo '<br />';
	echo '<input type="radio" name="testname" value="' . $options['bds__text_field_4'] . '">';
	echo '</div>';
	
	
	echo '<br />';
	//select button name, change to enlarge for further usability and better user understanding
	
	echo '<input type="submit" name="dlsubmit" value="Enlarge">';
	
	echo '</form>';
	//display radio functionality

	

}	

add_filter('the_content', 'my__plugin_callit');	
add_action( 'wp_enqueue_scripts', 'enlarger_scripts' );
add_shortcode( 'plugin_on_pages', 'plugin_on_page' );


?>