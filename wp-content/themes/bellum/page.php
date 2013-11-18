<?php 
get_header();
global $mc_option;
$page_type = $mc_option['page_type'];

//print_r($mc_option);
	
	/*=================================================================*/
	/* This code will include the correct file depending
	/* on the current page content, this way you just have to modify
	/* the template code inside the templates folder
	/*=================================================================*/
	
	//Portfolio Page
	if ($page_type == 'portfolio') {
		$columns = $mc_option['page_options']['portfolio_columns'];
		
		if($columns == 'three-cols')	
			get_template_part( '/templates/portfolio', '3' );
			
		if($columns == 'two-cols')
			get_template_part( '/templates/portfolio', '2' );
			
		if($columns == 'four-cols')
			get_template_part( '/templates/portfolio', '4' );
			
		if($columns == 'one-cols')
			get_template_part( '/templates/portfolio', '1' );
	} 
	//Blog Page
	elseif ($page_type == 'blog') {
		$blog_layout = $mc_option['page_options']['blog_layout'];
	
		if ($blog_layout == 'style1') {
			get_template_part( '/templates/blog', 'full' );
			
		} else {
			get_template_part( '/templates/blog');
			
		}
	} 
	
	//Contact Page
	elseif ($page_type == 'contact') {
		get_template_part( '/templates/contact');
		
	}
	
	//Services Page
	elseif ($page_type == 'services') {
		get_template_part( '/templates/services');
		
	} else {
		get_template_part( '/templates/page');
		
	}
get_footer(); 
?>