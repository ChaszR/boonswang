<?php 
get_header();
global $mc_option;

	/*=================================================================*/
	/* The code below will check the single post template
	/* and it will include the correct file
	/*=================================================================*/

	$blog_layout = $mc_option['page_options']['blog_layout'];

	if ($blog_layout == 'full') {
		get_template_part( '/templates/single-post', 'full' );
	} else {		
		get_template_part( '/templates/single', 'post' );
	}

get_footer(); ?>