<?php
/**
 * MC Studios Framework
 *
 * A flexible Wordpress Framework, created by Manuel Cervantes - MC Studios
 *
 * This file includes the all the necessary files to create the theme options panel and wordpress functions.
 * The framework is included in the functions.php file, all the options for the panel, meta boxes, 
 * theme scripts or anything related with the current theme are defined inside the includes folder.
 *
 * @author		Manuel Cervantes
 * @copyright	Copyright (c) Manuel Cervantes - MC Studios
 * @link		http://mcstudiosmx.com
 * @link		http://mcstudiosmx.com
 * @since		Version 1.1
 * @package 	MCFramework
 * @version 	Incarnation-Edition (Sub: Eunoia 1.2 Edit)

*/ 




/*
 * ------------------------------------------------------
 *  Define paths to later use them in files, do not modify
 *  the lines below your site will explode
 * ------------------------------------------------------
 */ 
$themedata;
/*Check if current version of Worpress is 3.4 */
if (function_exists('wp_get_theme')){
    $themedata = wp_get_theme();
}
$themename = str_replace( ' ','',strtolower($themedata->Name));
$version = $themedata->Version;
$author = $themedata->Author;
$support = $themedata->ThemeURI;

define( 'MCFRAMEWORK_VERSION', '1.1.0' );
define( 'ADMIN_PATH', get_template_directory() . '/framework/admin/' );
define( 'ADMIN_DIR', get_template_directory_uri() . '/framework/admin/' );
define( 'FUNCTIONS_PATH', get_template_directory() . '/framework/functions/' );

define( 'META_PATH', get_template_directory() . '/framework/meta/' );
define( 'META_DIR', get_template_directory_uri() . '/framework/meta/' );

define( 'SHORTCODES_PATH', get_template_directory() . '/framework/shortcodes/' );
define( 'SHORTCODES_DIR', get_template_directory_uri() . '/framework/shortcodes/' );

define( 'RESIZE_DIR', get_stylesheet_directory_uri() . '/resize/');
define( 'LAYOUT_PATH', get_stylesheet_directory() . '/css/skins/' );
define( 'INCLUDES_PATH', get_stylesheet_directory() . '/includes/' );

define('OPTIONS_PATH', get_stylesheet_directory() . '/includes/');



define( 'THEMENAME', $themename );
define( 'THEMEVERSION', $version);
define( 'THEMESUPPORT', $support);
define( 'THEMEAUTHOR', $author );
define( 'OPTIONS', $themename.'_options' );
define( 'BACKUPS',$themename.'_backups' );





/*
 * ------------------------------------------------------
 *  Required admin filters, this filters
 *  are necessary for the theme options panel
 * ------------------------------------------------------
 */
 if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','of_option_setup');
 add_action('admin_head', 'optionsframework_admin_message');
 add_action('admin_init','optionsframework_admin_init');
 add_action('admin_menu', 'optionsframework_add_admin');
 add_action( 'init', 'optionsframework_mlu_init');
 
 
 
 
 /*
  * ------------------------------------------------------
  *  Include the MC Studios theme options panel
  *  all the files are inside the admin folder
  * ------------------------------------------------------
  */
 require_once( ADMIN_PATH . 'functions.interface.php' );
 require_once( ADMIN_PATH . 'functions.options.php' );
 require_once( ADMIN_PATH . 'functions.admin.php' );
 require_once( ADMIN_PATH . 'functions.mediauploader.php' );
 require_once( ADMIN_PATH . 'class.options_machine.php' );
 
 



/*
 * ------------------------------------------------------
 *  Include the theme functions, the functions
 *  defined in this files are used in different
 *  parts of the framework, do not delete
 * ------------------------------------------------------
 */
require_once (FUNCTIONS_PATH . 'functions-init.php');
require_once (FUNCTIONS_PATH . 'functions-contact.php');
require_once (FUNCTIONS_PATH . 'functions-breadcrumbs.php');
require_once (FUNCTIONS_PATH . 'functions-subscribe.php');
require_once (FUNCTIONS_PATH . 'theme-page-content.php');
require_once (FUNCTIONS_PATH . 'functions-sidebars.php');
require_once (FUNCTIONS_PATH . 'functions-typography.php');
require_once (FUNCTIONS_PATH . 'functions-btables.php');





/*
 * ------------------------------------------------------
 *  Include the MC Studios meta code
 *  all the files are inside the meta folder
 * ------------------------------------------------------
 */
if(file_exists(META_PATH .'meta-box.php')) 
 require_once( META_PATH . 'meta-box.php' );
if(file_exists(META_PATH .'libs/index.php')) 
require_once( META_PATH . 'libs/index.php' ); 
if(file_exists(INCLUDES_PATH .'theme-meta.php')) 
 require_once( INCLUDES_PATH . 'theme-meta.php' );
 
/*Include the default theme options data*/
if(file_exists(INCLUDES_PATH .'demo-options-data.php')) 
 require_once( INCLUDES_PATH . 'demo-options-data.php' );  


if (!is_admin()) {
	function mcstudios_load_golabl_settings() {
		if(file_exists(INCLUDES_PATH .'theme-settings.php')) 
		 require_once( INCLUDES_PATH . 'theme-settings.php' ); 	
	} 
	add_action( 'wp' ,'mcstudios_load_golabl_settings');	
} 
 
 
 


/*
 * ------------------------------------------------------
 *  Include the MC Studios shortcodes
 *  all the files are inside the shortcodes folder
 * ------------------------------------------------------
 */
if(file_exists(SHORTCODES_PATH .'shortcodes.manager.php')) 
 require_once( SHORTCODES_PATH . 'shortcodes.manager.php' );






/*
 * ------------------------------------------------------
 *  Include the specific files of this theme
 *  this includes custom post types, widgets,
 *  scripts and stylesheets, the files are only 
 *  included if they exist.
 * ------------------------------------------------------
 */
if(file_exists(INCLUDES_PATH .'theme-post-types.php'))
 require_once (INCLUDES_PATH .'theme-post-types.php');
if(file_exists(INCLUDES_PATH .'theme-scripts.php'))
 require_once (INCLUDES_PATH .'theme-scripts.php');
if(file_exists(INCLUDES_PATH .'theme-stylesheets.php'))
 require_once (INCLUDES_PATH .'theme-stylesheets.php');
if(file_exists(INCLUDES_PATH .'theme-widgets.php'))
 require_once (INCLUDES_PATH .'theme-widgets.php');
if(file_exists(INCLUDES_PATH .'theme-shortcodes.php'))
 require_once (INCLUDES_PATH .'theme-shortcodes.php'); 
  
if(file_exists(INCLUDES_PATH .'theme-options-output.php'))
 require_once (INCLUDES_PATH .'theme-options-output.php'); 
 
 
 

if(file_exists(FUNCTIONS_PATH .'functions-importer.php')) 
 require_once( FUNCTIONS_PATH . 'functions-importer.php' ); 
 



/*
 * ------------------------------------------------------
 *  Ajax Saving Options
 *  necessary for the saving options function
 * ------------------------------------------------------
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback'); 
?>