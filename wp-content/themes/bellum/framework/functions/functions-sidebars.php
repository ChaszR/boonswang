<?php
/**
 * MC Studios Sidebars Generator
 *
 *
 * This file register all the sidebars generated with the theme options panel
 * Also it will apply the sidebar to the correct page, post, category, etc.
 *
 * @author		Manuel Cervantes
 * @copyright	Copyright (c) Manuel Cervantes - MC Studios
 * @link		http://mcstudiosmx.com
 * @link		http://mcstudiosmx.com
 * @since		Version 1.1
 * @package 	MCFramework
 * @version 	Incarnation-Edition (Sub: Eunoia 1.2 Edit)

*/ 



if (!function_exists( "mc_sidebar_generator")) {
	function mc_sidebar_generator(){
		global $data;
		
		if(isset($data['unlimited_sidebars'])){
		
			$sidebars = $data['unlimited_sidebars']; //get the slides array
			
		} else{
		
			$sidebars = '';
		}
		
	    if(isset($sidebars) && is_array($sidebars)){
	    
			foreach($sidebars as $sidebar){
				
				if(!empty($sidebar['title'])){
				
				$sidebar_name = stripslashes($sidebar['title']);
								
				$sidebar_id = stripslashes($sidebar['title']);
				
				$sidebar_id = strtolower($sidebar_id);
				
				$sidebar_id = str_replace (" ", "", $sidebar_id);
				
				$sidebar_id = str_replace ("page_", "", $sidebar_id);
				
				$sidebar_id = str_replace ("cpt_", "", $sidebar_id);
				
				$sidebar_id = str_replace ("template_", "", $sidebar_id);	
				
					register_sidebar(array(
						'name'=> $sidebar_name .'',
						'id' => $sidebar_id,
						'before_widget' => '<div class="widget">',
						'after_widget' => '</div>',
						'before_title' => '<h4 class="title">',
						'after_title' => '</h4><div class="double-line"></div><div class="clear"></div>',
					));
				}
			}
		}
	}

	add_action('init', 'mc_sidebar_generator');
}









if (!function_exists( "mcstudios_sidebar")) {

	//Apply the sidebar to page
	function mcstudios_sidebar(){
	
		global $data, $post;
		
		if(isset($data['unlimited_sidebars'])){
		
			$sidebars = $data['unlimited_sidebars']; //get the sidebars array
			
		} else{
		
			$sidebars = '';
			
		}
		
		/**
		 *  Get the current page, category, cpt or template ID, 
		 *  This code will return an array with the current ids
		 *  @return array $current_id
		 */
		$current_id = array();
		
		
		if (is_page()) {
		
			$current_id[] = 'pag_' .$post->ID;
			
		} elseif (is_single()) {
		
			$categories = wp_get_post_categories($post->ID);	
			
			foreach($categories as $cat){
			
				$current_id[] = 'cat_'.$cat;
				
			}
			
		} elseif (is_home()) {
		
			$current_id[] = 'template_home';
			
		} elseif (is_archive()) {
		
			$current_id[] = 'template_archives';
			
		} elseif (is_tag()) {
			
			$current_id[] = 'template_tags';
			
		} elseif (is_category()) {
			
			$current_id[] = 'template_categories';
			
		} elseif (is_search()) {
		
			$current_id[] = 'template_search';
			
		} elseif (is_404()) {
			
			$current_id[] = 'template_404';
			
		}  else {
			
		}
		
		
		
		$apply_sidebar_name = '';
		//Only run if custom sidebars exist
		if (!empty($sidebars)) {
			
			/**
			 *  Find the current id's in the sidebars array
			 *  This code will return an array containing the values that match
			 *  @return array $found
			 */
			$found = array();
			foreach ($current_id as $id) {
				$found[] = search_pages($id, $sidebars);	
			}
			
			//If custom sidebar was found
			if (!empty($found) && $found[0] !== '') {
				
				/**
				 *  Get sidebars name
				 *  This code will return an array containing the name
				 *  of the sidebars for the current page
				 *  @return array $apply_sidebar_name
				 */
				$apply_sidebar_name = array();
				foreach($found as $f){
					$sidebar_number = $f[0];
					
					if ($sidebar_number) {
						$sidebar_name = $sidebars[$sidebar_number]['title'];
						$custom_sidebar = stripslashes($sidebar_name);
						$custom_sidebar = strtolower($custom_sidebar);
						$custom_sidebar = str_replace (" ", "", $custom_sidebar);
						$apply_sidebar_name[] = $custom_sidebar;	
					}	
				}
			}
		}
		else {
			//If there are no custom sidebars return the default sidebar
			$apply_sidebar = '';
			$apply_sidebar_name = '';
		}
		
		
		//Finally Apply the custom sidebars to the correct page, post, category
		//Custom post type
		/**
		 *  Apply Sidebar
		 *  This code will apply the sidebars defined to the current page
		 *  @return function dynamic_sidebar();
		 */
		if (is_array($apply_sidebar_name) && !empty($apply_sidebar_name)) {
			foreach ($apply_sidebar_name as $apply_sidebar) {
				dynamic_sidebar($apply_sidebar);
			}
		} else {
			dynamic_sidebar();
		}			
	}
}






if (!function_exists( "search_pages")) {

	function search_pages( $needle, $haystack, $strict=false, $path=array() ) 
	{ 
	    if( !is_array($haystack) ) { 
	    
	        return false; 
	        
	    } 
	
	    foreach( $haystack as $key => $val ) { 
	    
	        if( is_array($val) && $subPath = search_pages($needle, $val, $strict, $path) ) { 
	        
	            $path = array_merge($path, array($key), $subPath); 
	            
	            return $path; 
	            
	        } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) { 
	        
	            $path[$key] = $val; 
	            
	            return $path; 
	        } 
	        
	    } 
	    
	    return false;   
	} 
}




/* #Add classes to body to adjust sidebar position
================================================== */


/**
* Function mcstudios_sidebar_position
* This function gets the sidebar position and append a class
* to the body tag so we can adjust the position with css
* basically the function uses add filter body_class;
*
* @param string $key accepts one wich is the position
* @return array will return the body classes
*/

if (! function_exists('mcstudios_sidebar_position') ) {
	function mcstudios_sidebar_position($classes = '') {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		
		global $wp_query, $data;
		//$postid = $wp_query->post->ID;
		
		if(is_page()){
			$sidebar = get_post_meta( get_the_ID( ), 'mc_sidebar', true );
			if ($sidebar == '') {
				$sidebar = 'right';
			}
		} elseif('mcportfolio' == get_post_type()){
			$sidebar = $data['single_project_sidebar'];
		} elseif(is_single() || is_archive() || is_404() || is_author() || is_search()){
			$sidebar = $data['single_sidebar'];
		} else{
			$sidebar = '';
		}
		
		
		/**
		 * Check if WooCommerce is active
		 **/
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			if (is_woocommerce()) {
				$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
				$woocomerce_page_id = $shop_page->ID;
				$sidebar = get_post_meta( $woocomerce_page_id, 'mc_sidebar', true );
			}
		}
		
		
		if($sidebar == 'left'){
			$classes[] = 'sidebar-left';
		} elseif($sidebar == 'right'){
			$classes[] = 'sidebar-right';
		} else{
			$classes[] = 'sidebar-none';
		}	
		
		
		
		
		return $classes;
	}
	
	add_filter('body_class','mcstudios_sidebar_position');
}
?>