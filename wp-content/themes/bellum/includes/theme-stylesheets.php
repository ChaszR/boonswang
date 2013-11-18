<?php
/* =============================================================================
   General Scripts
   ========================================================================== */
/*
We are just going to load some scripts in the head
because some scripts depend on this,
the rest of the scripts will be loaded in the footer
*/

function mctheme_stylesheets(){
	global $data;
	
	
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css'); 
	wp_enqueue_style( 'shortcodes', get_stylesheet_directory_uri() . '/css/shortcodes.css'); 
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/fonts/font-awesome.css'); 
	wp_enqueue_style( 'theme-style', get_bloginfo( 'stylesheet_url' )); 
	 
	//Responsive Stylesheets
	if($data['responsive_design'] == 1):
		wp_enqueue_style( 'bootstrap-responsive', get_stylesheet_directory_uri() . '/css/bootstrap-responsive.css'); 
		wp_enqueue_style( 'media-queries', get_stylesheet_directory_uri() . '/css/media-queries.css'); 
	endif;
	
	
	if ($data['theme_skin'] !=='') {
		$skin = $data['theme_skin'];
	} else {
		$skin = 'light.css';
	}
	wp_enqueue_style( 'theme-skin', get_stylesheet_directory_uri() . '/css/skins/'.$skin);
	
}
//add_action('wp_enqueue_scripts', 'mctheme_stylesheets');
add_action('get_header', 'mctheme_stylesheets');
?>