/* JavaScript Document */

jQuery(document).ready(function(){

	//alert('script is working!');
	
	//shows how to search for items using jquery
	jQuery('.gallery a').each(function(){
	
	//html inside class text will become the variable
	
	//This allows the caption to show up in the lower left hand corner of the image using lightbox
	
		var captionText = jQuery(this).closest('.gallery-item').find('.wp-caption-text').html();
	
			jQuery(this).attr({'data-lightbox':'slideshow', 'title':captionText});
		
	});

});

