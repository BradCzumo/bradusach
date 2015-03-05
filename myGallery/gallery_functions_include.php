<?php

	function load_my_scripts(){

	// This is calling the mygallery folder that was linked to in the header.php
	// Secondly calling the lightbox

	wp_register_script( 'mygallery_lightbox', get_template_directory_uri() . '/myGallery/lightbox/js/lightbox-2.6.min.js', array( 'jquery' ) );
	wp_register_script( 'mygallery_custom', get_template_directory_uri() . '/myGallery/gallery.js', array( 'jquery' ) );


	//This is allowing for javascripts to load into the page. Enqueueing the pages to the link of mygallery_***
	wp_enqueue_script( 'mygallery_lightbox' );
	wp_enqueue_script( 'mygallery_custom' );

	}

	add_action( 'wp_enqueue_scripts', 'load_my_scripts' );


?>