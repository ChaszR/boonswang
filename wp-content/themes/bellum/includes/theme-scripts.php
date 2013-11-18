<?php
/* =============================================================================
   General Scripts
   ========================================================================== */
define('SCRIPTS_DIR', get_template_directory_uri() . '/js/');

/*
We are just going to load some scripts in the head
because some scripts depend on this,
the rest of the scripts will be loaded in the footer
*/
function mcglobal_scripts() {
		wp_enqueue_script('html5-js', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
		wp_enqueue_script('jquery');
}    
add_action('wp_enqueue_scripts', 'mcglobal_scripts');


function mcfooter_script(){
	global $data;
	wp_enqueue_script('jquery-multi-scripts', SCRIPTS_DIR .'merged-scripts.js', array('jquery'));
	wp_enqueue_script('jquery-bootstrap', SCRIPTS_DIR .'bootstrap.min.js', array('jquery'));
	wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=true', array('jquery'));
	wp_enqueue_script('mcstudios_scripts', SCRIPTS_DIR .'scripts.js', array('jquery'));
}
add_action('wp_footer', 'mcfooter_script');
?>