<?php 
get_header();
global $mc_option;
$single_portfolio_style = $mc_option['page_options']['single_portfolio'];
	
	if ($single_portfolio_style == 'style1') {
	
		include( get_template_directory() . '/templates/single-portfolio-1.php' );
		
	} elseif ($single_portfolio_style == 'style2') {
		
		include( get_template_directory() . '/templates/single-portfolio-2.php' );
		
	} else {
		
		include( get_template_directory() . '/templates/single-portfolio-3.php' );
	}


get_footer(); ?>