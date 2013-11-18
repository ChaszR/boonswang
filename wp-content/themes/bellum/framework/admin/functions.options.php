<?php

/**
 * MC Studios Framework Options Builder
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


add_action('init','of_options');


$mcstudios_list_pages = get_pages();
$mcstudios_list_templates = array(
			"home" => "Home Page",
			
			"woocommerce" => "Woocomerce",
			
			"single" => "Single Post",
			"archives" => "Archives",
			"categories" => "Category Archive",
			"tags" => "Tags Archive",
			"search" => "Search Results",
			"404" => "404 Page"
);


if (!function_exists('of_options'))
{
	function of_options()
	{			
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");
		
		
		$mc_pages = array();
		$mc_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		
		$mc_pages_total = array();
		foreach ($mc_pages_obj as $mc_page) {
		    $mc_pages[] = array($mc_page->ID => $mc_page->post_name); 
		}
		$mc_pages_tmp = array_unshift($mc_pages, "Select a page:");
		
		
		
		

		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[$alt_stylesheet_file] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$resize_script = array(
					'image' => ''.__('The Image', 'mclang'), 
					'post' => ''.__('The Post', 'mclang')
		);
		//Image resizing
		$resize_script = array(
					'Timthumb' => ''.__('Timthumb', 'mclang'), 
					'PHP Thumb' => ''.__('PHP Thumb', 'mclang'), 
					'Disable resize script' => ''.__('Disable resize script', 'mclang')
		);
		$post_content = array("The Exerpt","Display Full Content");
		
		
		$yes_no = array(
					'yes' => ''.__('yes', 'mclang'), 
					'no' => ''.__('no', 'mclang')
		);
		$no_yes = array(
					'no' => ''.__('No', 'mclang'), 
					'yes' => ''.__('Yes', 'mclang')
		);
		$right_left = array(
					'right' => ''.__('Right', 'mclang'), 
					'left' => ''.__('Left', 'mclang')
		);
		$true_false = array(
					'true' => ''.__('True', 'mclang'), 
					'false' => ''.__('False', 'mclang')
		);
		$buttons_colors = array(
							'white' => __('White', 'mclang'),
							'grey' => __('Gray', 'mclang'),
							'pink' => __('Pink', 'mclang'), 
							'aqua' => __('Aqua', 'mclang'),
							'purple' => __('Purple', 'mclang'),
							'green' => __('Green', 'mclang'),
							'blue' => __('Blue', 'mclang'),
							'orange' => __('Orange', 'mclang'),
							'darkblue' => __('dark Blue', 'mclang'), 
							'black' => __('Black', 'mclang'),
		);

		

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/
	// Set the Options Array
	global $of_options;
	$of_options = array();
		if(file_exists(OPTIONS_PATH .'theme-options.php'))
		require_once (OPTIONS_PATH . 'theme-options.php');		
	}
}
?>