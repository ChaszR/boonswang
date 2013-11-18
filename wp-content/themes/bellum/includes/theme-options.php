<?php
/**
 * MC Studios Framework Theme Options
 *
 * Here are defined all the options for the theme
 *
 * This file includes the all the options displayed in the theme options panel, you can add multiple.
 * types of inputs, define the id and echo it in the theme, do not modify this file unless you know what 
 * you are doing. 
 *
 * @author		Manuel Cervantes
 * @copyright	Copyright (c) Manuel Cervantes - MC Studios
 * @link		http://mcstudiosmx.com
 * @link		http://mcstudiosmx.com
 * @since		Version 1.1
 * @package 	MCFramework
 * @version 	Incarnation-Edition (Sub: Eunoia 1.2 Edit)

*/ 

/*=================================================================*/
/* General Settings Section
/* This section includes all the sub headings to separate the
/* Options in groups
/*=================================================================*/
global $data;
if(isset($data['unlimited_sidebars'])){
	$sidebars = $data['unlimited_sidebars'];
} else{
	$sidebars = '';
}

$customs_sidebars_list = array();
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
		
			$customs_sidebars_list[$sidebar_id] = $sidebar_name;			
		}
	}
}
if (empty($customs_sidebars_list)) {
	$customs_sidebars_list = array('none' => __('There are no custom sidebars yet', 'mclang')); 
}
//print_r($customs_sidebars_list);


global $of_options;
$of_options[] = array( 
					"name" => __('General Settings', 'mclang'),
					"type" => "heading",
					"icon" => "gear"
				);
				
		//Settings Block
		$of_options[] = array( 
							"name" => __('Settings', 'mclang'),
							"type" => "subheading"
						);		
						
						
						
						$of_options[] = array( "name" => __('Favicon', 'mclang'),
											"desc" => __('Upload your custom favicon or define the URL directly in png format.', 'mclang'),
											"id" => "favicon",
											"std" => "",
											"type" => "media");
						
						
						/*$of_options[] = array( "name" => __('Select Resize Script', 'mclang'),
											"desc" => __('Enable or disable the automatic image resizing script.', 'mclang'),
											"id" => "resize_script",
											"std" => "Timthumb",
											"type" => "select",
											"options" => $resize_script);
						*/
						
						
						$of_options[] = array( "name" => __('Feedburner RSS Feed URL', 'mclang'),
											"desc" => __('Enter your full feedburner rss url if you have one.', 'mclang'),
											"id" => "feedburner",
											"std" => "",
											"type" => "text");
						
						$of_options[] = array( "name" => __('Enable Responsive Design', 'mclang'),
											"desc" => __('Enable or disable responsive design. only if required.', 'mclang'),
											"id" => "responsive_design",
											"std" => 1,
											"type" => "checkbox");
											
											
																
						$of_options[] = array( "name" => __('Display Breadcrumb?', 'mclang'),
											"desc" => __('Shor or hide the page breadcrumb at the top of every page.', 'mclang'),
											"id" => "breadcrumb",
											"std" => 1,
											"type" => "checkbox");
						
						
						/*$of_options[] = array( "name" => __('Header Search Field?', 'mclang'),
											"desc" => __('Shor or hide the search field in the header.', 'mclang'),
											"id" => "top_search",
											"std" => 0,
											"type" => "checkbox");*/
											
											
											
						
						
						$of_options[] = array( "name" => __('Header contact email', 'mclang'),
											"desc" => __('Enter the email displayed the header.', 'mclang'),
											"id" => "header_email",
											"std" => "",
											"type" => "text");
						
						$of_options[] = array( "name" => __('Header Phone', 'mclang'),
											"desc" => __('Enter the phone number displayed in the header.', 'mclang'),
											"id" => "header_phone",
											"std" => "",
											"type" => "text");					
																
											
						$of_options[] = array( "name" => __('Twitter Username', 'mclang'),
											"desc" => __('Enter your twitter username to display the icon in the header.', 'mclang'),
											"id" => "header_twitter",
											"std" => "",
											"type" => "text");
											
						$of_options[] = array( "name" => __('Facebook URL', 'mclang'),
											"desc" => __('Enter your facebook url to display the icon in the header.', 'mclang'),
											"id" => "header_face",
											"std" => "",
											"type" => "text");	
											
						$of_options[] = array( "name" => __('Dribble URL', 'mclang'),
											"desc" => __('Enter your dribble url to display the icon in the header.', 'mclang'),
											"id" => "header_dribble",
											"std" => "",
											"type" => "text");		
											
						$of_options[] = array( "name" => __('Vimeo URL', 'mclang'),
											"desc" => __('Enter your vimeo url to display the icon in the header.', 'mclang'),
											"id" => "header_vimeo",
											"std" => "",
											"type" => "text");	
											
						$of_options[] = array( "name" => __('Tumblr URL', 'mclang'),
											"desc" => __('Enter your tumblr url to display the icon in the header.', 'mclang'),
											"id" => "header_tumblr",
											"std" => "",
											"type" => "text");																
											
						/*$of_options[] = array( "name" => __('Display RSS Icon in Header', 'mclang'),
											"desc" => __('Shor or hide the rss icon from the header.', 'mclang'),
											"id" => "header_rss",
											"std" => 0,
											"type" => "checkbox");*/
											
											/*
						$of_options[] = array( "name" => __('Comments on Regular Pages?', 'mclang'),
											"desc" => __('You can enable or disable the comments for all pages globally, off = disable comments, on = enable.', 'mclang'),
											"id" => "pages_comments",
											"std" => 0,
											"type" => "checkbox");*/
				
				
		//Logo Options Block		
		$of_options[] = array( 
							"name" => __('Logo options', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Logo', 'mclang'),
												"desc" => __('Upload your custom logo or define the URL directly', 'mclang'),
												"id" => "logo",
												"std" => "",
												"type" => "media");
												
						
						$of_options[] = array( "name" => __('Logo High Resolution', 'mclang'),
												"desc" => __('Upload your high resolution logo, twice the size of your normal logo', 'mclang'),
												"id" => "logo_hires",
												"std" => "",
												"type" => "media");
																		
						
						
						$of_options[] = array( "name" => __('Customize Logo', 'mclang'),
												"desc" => __('Customize your logo size and position, for the margins you can use negative values if necessary.', 'mclang'),
												"id" => "logo_properties",
												"std" => array(
													'width' => '190',
													'height' => '78',
													'top' => '29',
													'left' => '0', 
													'bottom' => '0', 
													'right' => '0',
													'width_measure' => 'px', 
													'height_measure' => 'px', 
													'top_measure' => 'px',
													'bottom_measure' => 'px',
													'right_measure' => 'px', 
													'left_measure' => 'px'
												),
												"type" => "measure");	
						
						
						
						$of_options[] = array( "name" => __('Align Logo', 'mclang'),
											"desc" => __('Float the logo to the left or right.', 'mclang'),
											"id" => "logo_align",
											"std" => "left",
											"type" => "select",
											"options" => array("left", "right"));
											
											
		//Menu options				
		$of_options[] = array( 
							"name" => __('Menu options', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Home Link text', 'mclang'),
											"desc" => __('Change the text of the home page link.', 'mclang'),
											"id" => "home_link",
											"std" => "Home",
											"type" => "text");
						
						
						
						$of_options[] = array( "name" => __('Exclude pages from menu', 'mclang'),
											"desc" => __('Select the pages that you want to exclude from the main menu.', 'mclang'),
											"id" => "exclude_pages",
											"std" => "",
											"type" => "multiselect",
											"options" => $of_pages);
						
						
						
						$of_options[] = array( "name" => __('Menu Position', 'mclang'),
											"desc" => __('Customize the position of the menu.', 'mclang'),
											"id" => "menu_properties",
											"std" => array(
													'top' => '45',
													'left' => '0', 
													'bottom' => '0', 
													'right' => '0',
													'top_measure' => 'px',
													'bottom_measure' => 'px',
													'right_measure' => 'px', 
													'left_measure' => 'px'
											),
											"type" => "measure");							
		
		
		//Sidebars Options
		$of_options[] = array( 
							"name" => __('Sidebars', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Create Sidebars', 'mclang'),
											"desc" => __('Here you can create all the sidebars you need, you can customize your new sidebar in the widgets page.', 'mclang'),
											"id" => "unlimited_sidebars",
											"std" => "",
											"type" => "sidebars");
				
				
				
				
				
				
				
		
						

/*=================================================================*/
/* Styling Options Section
/* This section includes all the sub headings to separate the
/* Options in groups
/*=================================================================*/
$of_options[] = array( "name" => __('Styling Options', 'mclang'),
					"type" => "heading",
					"icon" => "style"
				);
					
		
		//Typography Options				
		$of_options[] = array( 
							"name" => __('Typography', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Pages Heading', 'mclang'),
										"id" => "page_header",
										"std" => array('sizepx' => '32', 'sizeem' => '', 'height' => 'px',  'face' => 'Source Sans Pro','style' => 'normal','color' => ''),
										"type" => "typography");
										
						$of_options[] = array( "name" => __('Pages Subheading', 'mclang'),
										"id" => "page_subheader",
										"std" => array('sizepx' => '18', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");				
																					
													
						$of_options[] = array( "name" => __('General Typography', 'mclang'),
										"id" => "general_font",
										"std" => array('sizepx' => '12', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");
										
										
						$of_options[] = array( "name" => __('Heading H1', 'mclang'),
										"id" => "h1_font",
										"std" => array('sizepx' => '26', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");
										
										
						$of_options[] = array( "name" => __('Heading H2', 'mclang'),
										"id" => "h2_font",
										"std" => array('sizepx' => '19', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");
										
						
						$of_options[] = array( "name" => __('Heading H3', 'mclang'),
										"id" => "h3_font",
										"std" => array('sizepx' => '14', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");				
										
										
						$of_options[] = array( "name" => __('Heading H4', 'mclang'),
										"id" => "h4_font",
										"std" => array('sizepx' => '13', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'normal','color' => ''),
										"type" => "typography");				
						
						$of_options[] = array( "name" => __('Menu Links', 'mclang'),
										"id" => "menu_links",
										"std" => array('sizepx' => '13', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'bold','color' => ''),
										"type" => "typography");
										
						$of_options[] = array( "name" => __('Sidebar Widgets Title', 'mclang'),
										"id" => "widgets_font",
										"std" => array('sizepx' => '14', 'sizeem' => '', 'height' => 'px',  'face' => '','style' => 'bold','color' => ''),
										"type" => "typography");
										
		
		
	
										
		//Colors Options Block				
		$of_options[] = array( 
							"name" => __('Theme Skin', 'mclang'),
							"type" => "subheading"
						);
						
						
						$of_options[] = array( "name" => __('Theme Skin', 'mclang'),
											"desc" => __('Change the theme scheme color.', 'mclang'),
											"id" => "theme_skin",
											"std" => "",
											"options" => $alt_stylesheets,
											"type" => "select");
											
											
											
											
						/*$of_options[] = array( "name" => __('Background Color', 'mclang'),
											"desc" => __('change the background color.', 'mclang'),
											"id" => "background_color",
											"std" => "#ebebeb",
											"type" => "color");
																
			
											
						//Social icons
						$of_options[] = array( "name" => __('Social Rounded Icons Background', 'mclang'),
											"desc" => __('change the background color Normal State.', 'mclang'),
											"id" => "social_icons_normal",
											"std" => "",
											"type" => "color");
											
						$of_options[] = array( "name" => "",
											"desc" => __('Social Icons Hover state.', 'mclang'),
											"id" => "social_icons_hover",
											"std" => "#e25d33",
											"type" => "color");		*/			
																
																
																
						//Post format icons
						$of_options[] = array( "name" => __('Blog Post Format Icon background', 'mclang'),
											"desc" => __('change the background color of the post format icon.', 'mclang'),
											"id" => "post_format_icon",
											"std" => "#e15d32",
											"type" => "color");					
																
						$of_options[] = array( "name" => __('Links Color', 'mclang'),
											"desc" => __('Change the color of the normal state links.', 'mclang'),
											"id" => "link_normal",
											"std" => "#e25d33",
											"type" => "color"); 
						
						$of_options[] = array( "name" => __('', 'mclang'),
											"desc" => __('Change the color of the hover state.', 'mclang'),
											"id" => "link_hover",
											"std" => "#e25d33",
											"type" => "color");
											
											
						$of_options[] = array( "name" => __('Menu Links top active border', 'mclang'),
											"desc" => __('Main Menu Active top border.', 'mclang'),
											"id" => "menu_link_active_top_border",
											"std" => "#f26c4f",
											"type" => "color");
											
						$of_options[] = array( "name" => __('Menu Links bottom hover border', 'mclang'),
											"desc" => __('Main Menu hover bottom border.', 'mclang'),
											"id" => "menu_link_hover_bottom_border",
											"std" => "#acd373",
											"type" => "color");					
											
											
											
																			
		//Custom CSS Block
		$of_options[] = array( 
							"name" => __('Custom CSS', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Custom CSS', 'mclang'),
											"desc" => __('Quickly add some CSS to your theme by adding it to this block.', 'mclang'),
											"id" => "custom_css",
											"std" => "",
											"type" => "textarea");			
		












/*=================================================================*/
/* Page Templates Options Section
/* This section includes all the sub headings to separate the
/* Options in groups
/*=================================================================*/
$of_options[] = array( "name" => __('Page templates', 'mclang'),
					"icon" => "templates",
					"class" => "templates-menu",
					"type" => "heading");
		
		
		/*$of_options[] = array( 
							"name" => __('Templates', 'mclang'),
							"type" => "subheading"
						);
						require_once (OPTIONS_PATH . 'templates.php');*/
						
		//Home Options Block			
		$of_options[] = array( 
							"name" => __('Home page', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Home Page Layout', 'mclang'),
									"desc" => __('Here you can create your own home page.', 'mclang'),
									"id" => "homepage_layout",
									"std" => "",
									"options" => array(
										"content" => array(
												"LayerSlider" => array(
														array(
															"type" => "text",
															"id" => "layersliderid",
															"desc" => __('Enter the id of the slider', 'mclang'),
															"title" => __('Slider ID:', 'mclang')
														)																
												),
															
												"Nivo Slider" => array(
														array(
															"type" => "images",
															"id" => "nivo_slider_images",
															"title" => __('Auto Slide:', 'mclang'),
															"desc" => __('Set the auto slide option', 'mclang'),
															"fields" => 
																	array(
																		array(
																			'type' => 'text',
																			'id' => 'link',
																			'title' => 'Link:'
																		)
																	)
														),
														
														array(
															"type" => "text",
															"id" => "nivo_slider_height",
															"desc" => __('Height of the slider e.g 453', 'mclang'),
															"title" => __('Slider Height:', 'mclang')
														),
														array(
															"type" => "select",
															"id" => "nivo_slider_auto",
															"title" => __('Auto Slide:', 'mclang'),
															"desc" => __('Set the auto slide option', 'mclang'),
															"opts" => array("true" => "true", "false" =>"false")
														),
														
														array(
															"type" => "text",
															"id" => "nivo_slider_pause",
															"desc" => __('Pause between each slide', 'mclang'),
															"title" => __('Pause Time:', 'mclang')
														),
														array(
															"type" => "select",
															"id" => "nivo_slider_effect",
															"title" => __('Slider effect', 'mclang'),
															"opts" => array(
																'random' => 'random',
																'sliceDown' => 'sliceDown',
																'sliceDownLeft' => 'sliceDownLeft',
																'sliceUp' => 'sliceUp',
																'sliceUpLeft' => 'sliceUpLeft',
																'sliceUpDown' => 'sliceUpDown',
																'sliceUpDownLeft' => 'sliceUpDownLeft',
																'fold' => 'fold',
																'fade' => 'fade',
																'slideInRight' => 'slideInRight',
																'slideInLeft' => 'slideInLeft',
																'boxRandom' => 'boxRandom',
																'boxRain' => 'boxRain',
																'boxRainReverse' => 'boxRainReverse',
																'boxRainGrow' => 'boxRainGrow',
																'boxRainGrowReverse' => 'boxRainGrowReverse'
															)
														)/*,
														array(
															"type" => "multiselect",
															"id" => "nivo_slider_categories",
															"title" => __('Categories', 'mclang'),
															"options" => "categories"
														),*/
												
													),			
															
															
															
													"Video Slider" => array(
														array(
															"type" => "images",
															"id" => "content_slider_images",
															"title" => __('Slider Images:', 'mclang'),
															"desc" => __('Add your slides images', 'mclang'),
															"fields" => 
																	array(
																		array(
																			'type' => 'text',
																			'id' => 'link',
																			'title' => 'Link:'
																		),
																		array(
																			'type' => 'text',
																			'id' => 'video',
																			'title' => 'Video URL:'
																		),
																		array(
																			'type' => 'text',
																			'id' => 'video_height',
																			'title' => 'Video Height:'
																		)
																	),
														),
														array(
															"type" => "select",
															"id" => "content_slider_bullets",
															"desc" => __('How do you want to display the slider bullets pagination', 'mclang'),
															"title" => __('Bullets style:', 'mclang'),
															"opts" => array('thumbnails' => 'Hover with Thumbnails', 'normal' => 'Normal with no thumbnails', 'none' => 'Hide the bullets')
														),
														array(
															"type" => "select",
															"id" => "content_slider_auto",
															"title" => __('Auto Slide:', 'mclang'),
															"desc" => __('Set the auto slide option', 'mclang'),
															"opts" => array("true" => "true", "false" =>"false")
														),
														
														array(
															"type" => "text",
															"id" => "content_slider_pause",
															"desc" => __('Pause between each slide 6000 = 6 secs', 'mclang'),
															"title" => __('Pause Time:', 'mclang')
														),
														array(
															"type" => "select",
															"id" => "content_slider_effect",
															"desc" => __('Change the slider transition effect.', 'mclang'),
															"title" => __('Slider effect', 'mclang'),
															"opts" => array(
																'slide' => 'slide',
																'fade' => 'fade'
															)
														)/*,
														array(
															"type" => "multiselect",
															"id" => "content_slider_categories",
															"title" => __('Categories', 'mclang'),
															"options" => "categories"
														),*/
													),											
															
															
													"Tagline" => array(
															array(
																"type" => "select",
																"id" => "tagline_style",
																"title" => __('Tagline Style', 'mclang'),
																"desc" => __('Select the tagline style', 'mclang'),
																"class" => "fold first",
																"opts" => array("default" =>"Text left - social right", "withbutton" =>"Text left - button right", "full" =>"Full centered", "onlytext" =>"Only title and text")
															),
															array(
																"type" => "text",
																"id" => "tagline_title",
																"desc" => __('Tagline title', 'mclang'),
																"class" => "fold default full onlytext withbutton",
																"title" => __('Title:', 'mclang')
															),
															array(
																"type" => "textarea",
																"id" => "tagline_text",
																"desc" => __('Tagline Text ', 'mclang'),
																"class" => "fold default full onlytext withbutton",
																"title" => __('Text', 'mclang')
															),
															
															array(
																"type" => "text",
																"id" => "tagline_button_text",
																"desc" => __('Enter here the text displayed in the button', 'mclang'),
																"class" => "fold withbutton",
																"title" => __('Button text:', 'mclang')
															),
															
															array(
																"type" => "text",
																"id" => "tagline_button_url",
																"desc" => __('Enter here the full URL of the button', 'mclang'),
																"class" => "fold withbutton",
																"title" => __('Button Full URL:', 'mclang')
															),
															
															array(
																"type" => "select",
																"id" => "tagline_button_color",
																"desc" => __('Select the color of the button', 'mclang'),
																"opts" => $buttons_colors,
																"class" => "fold withbutton",
																"title" => __('Button Color:', 'mclang')
															),
															
															
															array(
																"type" => "text",
																"id" => "tagline_lefttitle",
																"desc" => __('Social title, e.g We are social.', 'mclang'),
																"class" => "fold default",
																"title" => __('Social Title:', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "tagline_twitter",
																"desc" => __('Enter your Twitter username', 'mclang'),
																"class" => "fold default",
																"title" => __('Twitter Username:', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "tagline_facebook",
																"desc" => __('Enter your Facebook url', 'mclang'),
																"class" => "fold default",
																"title" => __('Facebook URL:', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "tagline_dribble",
																"desc" => __('Enter your Dribble url', 'mclang'),
																"class" => "fold default",
																"title" => __('Dribble URL:', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "tagline_vimeo",
																"desc" => __('Enter your Vimeo url', 'mclang'),
																"class" => "fold default",
																"title" => __('Vimeo URL:', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "tagline_tumblr",
																"desc" => __('Enter your Tumblr url', 'mclang'),
																"class" => "fold default",
																"title" => __('Tumblr URL:', 'mclang')
															),
															array(
																"type" => "select",
																"id" => "tagline_rss",
																"desc" => __('Show or hide the rss icon', 'mclang'),
																"class" => "fold default",
																"title" => __('Show RSS:', 'mclang'),
																"opts" => array("yes" =>"yes","no" =>"no")
															)
														),		
												
															
																				
														/*"Columns" => array(
															array(
																"type" => "select",
																"id" => "columns_number",
																"title" => __('Number of columns', 'mclang'),
																"desc" => __('Select the number of columns', 'mclang'),
																"opts" => array("2" =>"2","3" =>"3", "4" =>"4")
															),
															array(
																"type" => "select",
																"id" => "columns_thumbnail",
																"title" => __('Display Thumbnail?', 'mclang'),
																"desc" => __('Display a thumbnail or icon in the column?', 'mclang'),
																"opts" => array("none" => "none","Featured Image" =>"Featured Image")
															),
															array(
																"type" => "text",
																"id" => "columns_thumbnail_height",
																"desc" => __('Adjust the thumbnail height', 'mclang'),
																"title" => __('Thumbnail height', 'mclang')
															),
															array(
																"type" => "select",
																"id" => "columns_link",
																"title" => __('Post Link', 'mclang'),
																"desc" => __('Add a link to the column post', 'mclang'),
																"opts" => array("Link to Post" => "Link to Post","Use custom link" =>"Use custom link", "none" =>"none")
															),
															array(
																"type" => "text",
																"id" => "columns_excerpt",
																"desc" => __('Size of the text excerpt (default: 40)', 'mclang'),
																"title" => __('Number of words in excerpt ,-1 = Full content', 'mclang')
															),
															array(
																"type" => "multiselect",
																"id" => "columns_categories",
																"desc" => __('Select the categories that you want to display', 'mclang'),
																"title" => __('Categories', 'mclang'),
																"options" => "categories"
															)
														),	*/
														
														
														
														"Normal Columns" => array(
															array(
																"type" => "slide",
																"id" => "columns_normal",
																"title" => __('Add your columns', 'mclang'),
																"desc" => __('Select the number of columns', 'mclang'),
																"fields" => array(
																	array(
																		'type' => 'select',
																		'id' => 'col_size',
																		'options' => array('span4' => 'one third', 'span6' => 'one half', 'span3' => 'one fourth'),
																		'title' => 'Column Size:'
																	),
																	
																	array(
																		"type" => "text",
																		"class" => "col_title",
																		"id" => "col_title",
																		"desc" => __('Column title', 'mclang'),
																		"title" => __('Column title', 'mclang')
																	),
																	
																	array(
																		"type" => "textarea",
																		"id" => "col_text",
																		"desc" => __('Column text', 'mclang'),
																		"title" => __('Column text', 'mclang')
																	)
																)
															)
														),
														
														
														"Numbered Columns" => array(
															array(
																"type" => "slide",
																"id" => "columns_number",
																"title" => __('Add your columns', 'mclang'),
																"desc" => __('Select the number of columns', 'mclang'),
																"fields" => array(
																	array(
																		'type' => 'select',
																		'id' => 'col_size',
																		'options' => array('span4' => 'one third', 'span6' => 'one half', 'span3' => 'one fourth'),
																		'title' => 'Column Size:'
																	),
																	
																	array(
																		"type" => "text",
																		"class" => "col_title",
																		"id" => "col_title",
																		"desc" => __('Column title', 'mclang'),
																		"title" => __('Column title', 'mclang')
																	),
																	
																	array(
																		"type" => "textarea",
																		"id" => "col_text",
																		"desc" => __('Column text', 'mclang'),
																		"title" => __('Column text', 'mclang')
																	)
																)
															)
														),	
															
														
														
														
														"Tabs" => array(
															array(
																"type" => "slide",
																"id" => "tabs",
																"title" => __('Add your tabs', 'mclang'),
																"desc" => __('Add your custom tabs', 'mclang'),
																"fields" => array(
																	array(
																		"type" => "text",
																		"class" => "col_title",
																		"id" => "tab_title",
																		"desc" => __('Column title', 'mclang'),
																		"title" => __('Column title', 'mclang')
																	),
																	
																	array(
																		"type" => "textarea",
																		"id" => "tab_text",
																		"desc" => __('Column text', 'mclang'),
																		"title" => __('Column text', 'mclang')
																	)
																)
															)
														),
														
														
														
															
																				
														"Recent Projects" => array(
															array(
																"type" => "text",
																"id" => "portfolio_title",
																"title" => __('Block Title', 'mclang'),
																"desc" => "default: Recent Works"
															),
															array(
																"type" => "text",
																"id" => "portfolio_link_text",
																"title" => __('Portfolio top link text', 'mclang'),
																"desc" => "add a link to the top"
															),
															array(
																"type" => "text",
																"id" => "portfolio_link_url",
																"title" => __('Portfolio top link url', 'mclang'),
																"desc" => "add a link to the top"
															),
															array(
																"type" => "select",
																"id" => "portfolio_hovereffect",
																"title" => __('Project Hover Effect', 'mclang'),
																"desc" => __('Enable or disable the hover effect', 'mclang'),
																"opts" => array('normal' => 'Fade to Black', 'none' => 'Disable hover')
															),
															array(
																"type" => "select",
																"id" => "portfolio_titles",
																"title" => __('Project Title', 'mclang'),
																"desc" => __('Display project title?', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "select",
																"id" => "portfolio_slugs",
																"title" => __('Project Categories', 'mclang'),
																"desc" => __('Display project categories?', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "select",
																"id" => "portfolio_description",
																"title" => __('Project Description', 'mclang'),
																"desc" => __('Display project description?', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "select",
																"id" => "portfolio_columns",
																"title" => __('Number of projects', 'mclang'),
																"desc" => __('Change the number of projects to display?', 'mclang'),
																"opts" => array('span3' => __('Four projects', 'mclang'), 'span4' => __('Three projects', 'mclang') , 'span6' => __('Two projects', 'mclang'))
															),
															array(
																"id" => "portfolio_categories",
																"type" => "multiselect",
																"title" => __('Categories', 'mclang'),
																"class" => "portfolio-posts",
																"desc" => __('Select the categories to display', 'mclang'),
																"options" => "projects"
															)
														),	
															
														
																					
														"Recent posts" => array(
															array(
																"type" => "text",
																"id" => "blog_btitle",
																"title" => __('Title big:', 'mclang'),
																"desc" => __('Block title', 'mclang'),
															),
															array(
																"type" => "text",
																"id" => "blog_link_text",
																"title" => __('Portfolio top link text', 'mclang'),
																"desc" => "add a link to the blog"
															),
															array(
																"type" => "text",
																"id" => "blog_link_url",
																"title" => __('Portfolio top link url', 'mclang'),
																"desc" => "add a link to the blog"
															),
															array(
																"type" => "select",
																"id" => "blog_size",
																"title" => __('Block Width', 'mclang'),
																"desc" => __('Adjust the blog section width', 'mclang'),
																"opts" => array("One third" => "One third", "Two Thirds" => "Two Thirds", "One Half" =>  "One Half", "Full Width" => "Full Width")
															),
															array(
																"type" => "text",
																"id" => "blog_nposts",
																"title" => __('Number of posts', 'mclang'),
																"desc" => __('Number of posts to display', 'mclang'),
															),
															array(
																"type" => "select",
																"id" => "blog_date",
																"title" => __('Display post date?', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "select",
																"id" => "blog_comments",
																"title" => __('Display post comments?', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "text",
																"id" => "blog_excerpt",
																"title" => __('Number of words in excerpt:', 'mclang')
															),
															array(
																"type" => "multiselect",
																"id" => "blog_categories",
																"title" => __('Categories', 'mclang'),
																"options" => "categories"
															)
														),	
															
															
														/*"Portfolio" => array(
															array(
																"type" => "select",
																"id" => "full_portfolio_filter",
																"title" => __('Show filter bar?', 'mclang'),
																"desc" => __('Show or hide the filter bar?', 'mclang'),
																"opts" => $yes_no
															),
															
															array(
																"type" => "select",
																"id" => "full_portfolio_columns",
																"title" => __('Number of projects', 'mclang'),
																"desc" => __('Change the number of projects to display?', 'mclang'),
																"opts" => array('span3' => __('Four projects', 'mclang'), 'span4' => __('Three projects', 'mclang'))
															),
															
															
															array(
																"type" => "select",
																"id" => "full_portfolio_effect",
																"title" => __('Portfolio hover effect', 'mclang'),
																"desc" => __('Select the portfolio hover effect', 'mclang'),
																"opts" => array('black' => __('Fade to black', 'mclang'), 'color' => __('Fade to color', 'mclang'))
															),
															
															
															array(
																"type" => "text",
																"id" => "full_portfolio_posts",
																"title" => __('Number of projects', 'mclang'),
																"desc" => __('How many projects do you want tod display eg. 9', 'mclang')
															),
															
															
															array(
																"type" => "select",
																"id" => "full_portfolio_pagination",
																"title" => __('Show pagination', 'mclang'),
																"desc" => __('Show or hide the  pagination?', 'mclang'),
																"opts" => $yes_no
															),
															
															array(
																"type" => "select",
																"id" => "full_portfolio_slugs",
																"title" => __('Project Categories', 'mclang'),
																"desc" => __('Display project categories?', 'mclang'),
																"opts" => $yes_no
															),
															
															array(
																"id" => "full_portfolio_categories",
																"type" => "multiselect",
																"title" => __('Categories', 'mclang'),
																"class" => "portfolio-posts",
																"desc" => __('Select the categories to display', 'mclang'),
																"options" => "projects"
															)
														),	*/
															
															
																								
														"Text" => array(
															array(
																"type" => "select",
																"id" => "text_width",
																"title" => __('Block Width', 'mclang'),
																"desc" => __('Adjust the text section width', 'mclang'),
																"opts" => array("One third" => "One third", "Two Thirds" => "Two Thirds", "One Half" =>  "One Half", "Full Width" => "Full Width")
															),
															array(
																"type" => "text",
																"id" => "text_title",
																"title" => __('Block Title', 'mclang'),
																"desc" => "Add your title here"
															),
															array(
																"type" => "select",
																"id" => "text_title_stripe",
																"title" => __('Add double line to the title?', 'mclang'),
																"desc" => __('This will add a double line bg to the title', 'mclang'),
																"opts" => $yes_no
															),
															array(
																"type" => "textarea",
																"id" => "text_content",
																"title" => __('Block Text', 'mclang'),
																"desc" => "Add your text here you can add HTML"
															)
														),	
															
														
															
															
														"Separator" => array(
															array(
																"type" => "select",
																"id" => "separator_style",
																"title" => __('Separator Style', 'mclang'),
																"desc" => __('Select the style of the separator', 'mclang'),
																"opts" => array('double' => 'Double Line', 'line' => 'Single Line')
															),
															array(
																"type" => "text",
																"id" => "separator_top",
																"title" => __('Add margin top', 'mclang'),
																"desc" => __('Add some space at the top in px e.g 30', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "separator_bottom",
																"title" => __('Add margin bottom', 'mclang'),
																"desc" => "Add some space at the bottom in px e.g 30"
															)
														),	
															
															
														"Clear" => array(
															array(
																"type" => "text",
																"id" => "clear_top",
																"title" => __('Add margin top', 'mclang'),
																"desc" => __('Add some space at the top in px e.g 30', 'mclang')
															),
															array(
																"type" => "text",
																"id" => "clear_bottom",
																"title" => __('Add margin bottom', 'mclang'),
																"desc" => "Add some space at the bottom in px e.g 30"
															)
														),	
														
														
														
														"Sidebar" => array(
															array(
																"type" => "select",
																"id" => "sidebar_size",
																"title" => __('Sidebar Width:', 'mclang'),
																"desc" => __('Select the width of the sidebar', 'mclang'),
																"opts" => array("One third" => "One third", "Two Thirds" => "Two Thirds", "One Half" =>  "One Half", "Full Width" => "Full Width")
															),
															array(
																"type" => "select",
																"id" => "sidebar_name",
																"title" => __('Select the sidebar', 'mclang'),
																"desc" => __('Select the sidebar that you want to display', 'mclang'),
																"opts" => $customs_sidebars_list
															)
														),
														
														
														
																		
													),
											),
											"type" => "page_layout");
											
											
													
						
		
		$of_options[] = array( 
							"name" => __('Portfolio page', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Portfolio Page', 'mclang'),
									"desc" => __('Select your portfolio page.', 'mclang'),
									"id" => "portfolio_page",
									"std" => "",
									"options" => array(
										array(
											'type' => 'select',
											'id' => 'portfolio_page',
											'holder' => 'Select Page:',
											'title' => __('Apply Portfolio to this page:', 'mclang'),
											'options' => 'pages',
											'desc' => __('Select the page wher you want to display your portfolio.', 'mclang')
										),
										
										array(
											'type' => 'select',
											'id' => 'portfolio_columns',
											'title' => __('Select the style of the portfolio', 'mclang'),
											'options' => array('2 Columns' =>'2 Columns', '3 Columns' => '3 Columns', '4 Columns' => '4 Columns', '1 Column' => '1 Column'),
											'desc' => __('Select the number of columns.', 'mclang')
										),
										
										array(
											'type' => 'select',
											'id' => 'portfolio_filter',
											'title' => __('Show filtering bar?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the filtering bar at the top.', 'mclang')
										),
										
										array(
											'type' => 'select',
											'id' => 'portfolio_effect',
											'title' => __('Slect the hover effect', 'mclang'),
											'options' => array('black' => __('Hover to black', 'mclang'), 'none' => __('Disable hover effect', 'mclang')),
											'desc' => __('Select the hover effect for the project thumbnail.', 'mclang')
										),
										/*
										array(
											'type' => 'text',
											'id' => 'portfolio_thumbnail_height',
											'title' => __('Thumbnail height', 'mclang'),
											'desc' => __('You can adjust the height of the thumbnai, for example "400".', 'mclang')
										),*/
										
										
										array(
											'type' => 'select',
											'id' => 'portfolio_project_title',
											'title' => __('Show project title?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the project title.', 'mclang')
										),
										
										
										array(
											'type' => 'select',
											'id' => 'portfolio_project_categories',
											'title' => __('Show project categories?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the project categories.', 'mclang')
										),
										
										array(
											'type' => 'select',
											'id' => 'portfolio_project_description',
											'title' => __('Show project excerpt?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the project excerpt.', 'mclang')
										),
										
										array(
											'type' => 'text',
											'id' => 'portfolio_project_description_words',
											'title' => __('Number of words in excerpt', 'mclang'),
											'desc' => __('Change the number of words in the excerpt e.g 50.', 'mclang')
										),
										
										/*array(
											'type' => 'select',
											'id' => 'portfolio_link',
											'title' => __('Link to single portfolio page?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Add or remove the link to single portfolio page.', 'mclang')
										),*/
										array(
											'type' => 'text',
											'id' => 'portfolio_nposts',
											'title' => __('Posts per page?', 'mclang'),
											'desc' => __('Select the number of posts per page.', 'mclang')
										),
										
										
										array(
											'type' => 'multiselect',
											'id' => 'portfolio_categories',
											'title' => __('Which categories do you want to display?', 'mclang'),
											'options' => 'projects',
											'desc' => __('Select the categories that you want to display.', 'mclang')
										)		
								),
						"class" => "template_select",
						"type" => "pages");															
															
											
											
						
		$of_options[] = array( 
							"name" => __('Single portfolio', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Single Title', 'mclang'),
											"desc" => __('this title will be displayed in the single project page.', 'mclang'),
											"id" => "single_portfolio_title",
											"std" => "Portfolio",
											"type" => "text");
											
						$of_options[] = array( "name" => __('Single Subtitle', 'mclang'),
											"desc" => __('Text displayed in the top of the page.', 'mclang'),
											"id" => "single_portfolio_subtitle",
											"std" => "Show your work in a professional and modern way, change the hover effect, enable or disable the lightbox and much more, what are you waiting, buy it right now!",
											"type" => "textarea");
						
						
						$of_options[] = array( "name" => __('Single Portfolio Style', 'mclang'),
											"desc" => __('change the single portfolio style.', 'mclang'),
											"id" => "single_portfolio_style",
											"options" => array('style1' => __('Top Slider Full Content', 'mclang'), 'style2' => __('Top Slider with sidebar', 'mclang'), 'style3' => __('Normal Post', 'mclang')),
											"std" => "right",
											"type" => "select");
						
						
						
						$of_options[] = array( "name" => __('Sidebar Position?', 'mclang'),
											"desc" => __('change the sidebar position.', 'mclang'),
											"id" => "single_project_sidebar",
											"options" => $right_left,
											"std" => "right",
											"type" => "select");
											
						
						
						$of_options[] = array( "name" => __('Show related projects?', 'mclang'),
											"desc" => __('Show or hide related projects.', 'mclang'),
											"id" => "single_portfolio_related_projects",
											"options" => $yes_no,
											"std" => "yes",
											"type" => "select");
											
											
						$of_options[] = array( "name" => __('Enable Comments', 'mclang'),
											"desc" => __('Enable Comments in the single portfolio page.', 'mclang'),
											"id" => "single_portfolio_comments",
											"options" => $no_yes,
											"std" => "no",
											"type" => "select");
																
						
						$of_options[] = array( "name" => __('Project Auto Slide', 'mclang'),
											"desc" => __('Auto Start the project slider. (Only for the single project page)', 'mclang'),
											"id" => "project_slide_auto",
											"options" => $true_false,
											"std" => "true",
											"type" => "select");
											
						
						$of_options[] = array( "name" => __('Slide Duration', 'mclang'),
											"desc" => __('Time between each slide (6000 = 6 seconds)', 'mclang'),
											"id" => "single_slider_duration",
											"std" => "15000",
											"type" => "text");
						
						
		$of_options[] = array( 
							"name" => __('Services page', 'mclang'),
							"type" => "subheading"
						);
						
						$of_options[] = array( "name" => __('Services Page', 'mclang'),
									"desc" => __('Select your blog page.', 'mclang'),
									"id" => "services_page",
									"std" => "",
									"options" => array(
											array(
												'type' => 'select',
												'id' => 'service_page',
												'holder' => __('Select Page:', 'mclang'),
												'title' => __('Apply services to this page:', 'mclang'),
												'options' => 'pages',
												'desc' => __('Select the page wher you want to display your services.', 'mclang')
											),				
											array(
												'type' => 'multiselect',
												'id' => 'service_categories',
												'title' => __('Which categories do you want to display?', 'mclang'),
												'options' => 'service',
												'desc' => __('Select the categories that you want to display in the home page.', 'mclang')
											),
											array(
												'type' => 'text',
												'id' => 'service_top_link_text',
												'title' => __('Services top link text', 'mclang'),
												'desc' => __('Add a top link in the header eg. Get in touch.', 'mclang')
											),
											array(
												'type' => 'text',
												'id' => 'service_top_link_url',
												'title' => __('Services top link url', 'mclang'),
												'desc' => __('Add a the url of the link.', 'mclang')
											),
											array(
												'type' => 'select',
												'id' => 'service_top_link_color',
												'holder' => __('Button Color:', 'mclang'),
												'title' => __('Select the color of the button:', 'mclang'),
												'options' => $buttons_colors,
												'desc' => __('Select the color of the button.', 'mclang')
											),
											
											
																					
											array(
												'type' => 'text',
												'id' => 'service_active_tab',
												'title' => __('Services Active Tab', 'mclang'),
												'desc' => __('Enter the number of tha active tab, default 1 (first tab).', 'mclang')
											),
											array(
												'type' => 'text',
												'id' => 'service_nposts',
												'title' => __('Posts per page?', 'mclang'),
												'desc' => __('Select the number of posts per page.', 'mclang')
											)								
										),
										"class" => "template_select",
										"type" => "pages");								
						
										
		$of_options[] = array( 
							"name" => __('Blog page', 'mclang'),
							"type" => "subheading"
						);
							$of_options[] = array( "name" => __('Blog Page', 'mclang'),
									"desc" => __('Select your blog page.', 'mclang'),
									"id" => "blog_page",
									"std" => "",
									"options" => array(
										array(
											'type' => 'select',
											'id' => 'blog_page',
											'holder' => __('Select Page:', 'mclang'),
											'title' => __('Apply blog to this page:', 'mclang'),
											'options' => 'pages',
											'desc' => __('Select the page wher you want to display your blog page.', 'mclang')
										),
																			
										array(
											'type' => 'select',
											'id' => 'blog_layout',
											'title' => __('Blog Layout', 'mclang'),
											'options' => array('style1' => ''.__('Full Width', 'mclang').'', 'style2' => ''.__('With Sidebar', 'mclang').''),
											'desc' => __('Show or hide the posted by author text.', 'mclang')
										),
										
										array(
											'type' => 'multiselect',
											'id' => 'blog_categories',
											'title' => __('Which categories do you want to display?', 'mclang'),
											'options' => 'categories',
											'desc' => __('Select the categories that you want to display in the home page.', 'mclang')
										),				
													
													
										array(
											'type' => 'text',
											'id' => 'blog_excerpt',
											'title' => __('Number of words in excerpt', 'mclang'),
											'desc' => __('Change the number of words in the exerpt ie(75).', 'mclang')
										),
										
										
										
										array(
											'type' => 'select',
											'id' => 'blog_author',
											'title' => __('Show author?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the post author.', 'mclang')
										),			
													
										array(
											'type' => 'select',
											'id' => 'blog_showcategories',
											'title' => __('Show post categories?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the post categories.', 'mclang')
										),	
										array(
											'type' => 'select',
											'id' => 'blog_share',
											'title' => __('Show post share?', 'mclang'),
											'options' => $yes_no,
											'desc' => __('Show or hide the share links.', 'mclang')
										),			
										
										array(
											'type' => 'text',
											'id' => 'blog_nposts',
											'title' => __('Posts per page?', 'mclang'),
											'desc' => __('Select the number of posts per page.', 'mclang')
										),			

										array(
											'type' => 'select',
											'id' => 'blog_orderby',
											'title' => __('Order the posts by?', 'mclang'),
											'options' => array('Date' => ''.__('Date', 'mclang').'', 'Title' => ''.__('Title', 'mclang').'', 'ID' => ''.__('ID', 'mclang').'', 'Random' => ''.__('Random', 'mclang').''),
											'desc' => __('How do you want to order the posts? the default order is by date.', 'mclang')
										),			

										array(
											'type' => 'select',
											'id' => 'blog_order',
											'title' => __('Select the post order', 'mclang'),
											'options' => array('DESC' => ''.__('DESC', 'mclang').'', 'ASC' => ''.__('ASC', 'mclang').''),
											'desc' => __('Select the posts order.', 'mclang')
										)																																		
									),
									"class" => "template_select",
									"type" => "pages");						
						
						
		$of_options[] = array( 
							"name" => __('Single post', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Single Title', 'mclang'),
												"desc" => __('this title will be displayed in the single post page.', 'mclang'),
												"id" => "single_title",
												"std" => "Blog",
												"type" => "text");
												
												
						$of_options[] = array( "name" => __('Single Subtitle', 'mclang'),
												"desc" => __('Text displayed in the top of the page.', 'mclang'),
												"id" => "single_subtitle",
												"std" => "Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum, lorem in elementum varius, nisi ipsum lectus elementum varius.",
												"type" => "textarea");
												
												
						$of_options[] = array( "name" => __('Single post style', 'mclang'),
												"desc" => __('Select the single post style.', 'mclang'),
												"id" => "single_post_style",
												"options" => array('full' => __('Full Style', 'mclang'), 'normal' => __('Normal Style', 'mclang')),
												"std" => "",
												"type" => "select");						
															
												
						$of_options[] = array( "name" => __('Sidebar position', 'mclang'),
												"desc" => __('Change the sidebar position.', 'mclang'),
												"id" => "single_sidebar",
												"options" => $right_left,
												"std" => "",
												"type" => "select");									
						
						
						$of_options[] = array( "name" => __('Show post author?', 'mclang'),
												"desc" => __('Show or hide the post author.', 'mclang'),
												"id" => "single_post_author",
												"options" => $yes_no,
												"std" => "",
												"type" => "select");
												
						
						$of_options[] = array( "name" => __('Show post categories?', 'mclang'),
												"desc" => __('Show or hide the post categories.', 'mclang'),
												"id" => "single_show_categories",
												"options" => $yes_no,
												"std" => "",
												"type" => "select");
												
						
						$of_options[] = array( "name" => __('Show post share?', 'mclang'),
												"desc" => __('Show or hide the post share.', 'mclang'),
												"id" => "single_post_share",
												"options" => $yes_no,
												"std" => "",
												"type" => "select");																					
												
						
						$of_options[] = array( "name" => __('Enable Comments?', 'mclang'),
												"desc" => __('Enable or disable the comments.', 'mclang'),
												"id" => "single_enablecomments",
												"options" => $yes_no,
												"std" => "",
												"type" => "select");						
																					
																		
						
			
			
			             $of_options[] = array( "name" => __('Comments Button Color', 'mclang'),
												"desc" => __('Change the color of the post comment button.', 'mclang'),
												"id" => "comments_button_color",
												"options" => $buttons_colors,
												"std" => "",
												"type" => "select");																		
						
		
		
		
		//Contact form				
		$of_options[] = array( 
							"name" => __('Contact Form', 'mclang'),
							"type" => "subheading"
						);			
						
						$of_options[] = array( "name" => __('Select Contact Page', 'mclang'),
											"desc" => __('Select your contact page.', 'mclang'),
											"id" => "contact_page",
											"std" => "",
											"type" => "select",
											"options" => 'pages');
											
						$of_options[] = array( "name" => __('Contact Page Map Address', 'mclang'),
											"desc" => __('Add a map to the contact page.', 'mclang'),
											"id" => "contact_page_map_top",
											"std" => "",
											"type" => "textarea");					
						
						$of_options[] = array( "name" => __('Contact Form', 'mclang'),
								"desc" => __('Create the form the way you want', 'mclang'),
								"id" => "contact_layout",
								"std" => "",
								"options" => array(
									"content" => array(
											"Text" => array(
												array(
													"type" => "text",
													"id" => "title",
													"class" => "inputtitle",
													"desc" => __('Input title:', 'mclang'),
													"title" => "Title:"
												),
												array(
													"type" => "select",
													"id" => "required",
													"title" => "Validation",
													"desc" => __('the input is required?', 'mclang'),
													"opts" => array('required' => __('Required', 'mclang'), 'email' => __('Required Email', 'mclang'), 'phone' => __('Required Phone', 'mclang'), 'novalidation' => __('Not required', 'mclang'))
												)
											),
											"Textarea" => array(
												array(
													"type" => "text",
													"id" => "title",
													"class" => "inputtitle",
													"desc" => __('Input title:', 'mclang'),
													"title" => "Title:"
												),
												array(
													"type" => "select",
													"id" => "required",
													"title" => "Required?",
													"desc" => __('the input is required?', 'mclang'),
													"opts" => $yes_no
												)	
											),		
											"Select" => array(
													array(
														"type" => "text",
														"id" => "title",
														"class" => "inputtitle",
														"title" => "Input Title:",
														"desc" => "Enter the select title"
													),
													array(
														"type" => "select",
														"id" => "required",
														"title" => "Required?",
														"desc" => __('the input is required?', 'mclang'),
														"opts" => $yes_no
													),
													array(
														"type" => "textarea",
														"id" => "options",
														"title" => "Select Options",
														"desc" => "Enter the select options"
													)
												),
											  "Checkbox" => array(
													array(
														"type" => "text",
														"id" => "title",
														"class" => "inputtitle",
														"title" => "Input Title",
														"desc" => "Checkbox input title"
													),
													array(
														"type" => "select",
														"id" => "required",
														"title" => "Required?",
														"desc" => __('the input is required?', 'mclang'),
														"opts" => $yes_no
													),
													array(
														"type" => "textarea",
														"id" => "options",
														"title" => "Options",
														"desc" => "Enter the options separated by comma"
													)
												),
												
												
												"Radio" => array(
													array(
														"type" => "text",
														"id" => "title",
														"class" => "inputtitle",
														"title" => "Input Title",
														"desc" => "Checkbox input title"
													),
													array(
														"type" => "select",
														"id" => "required",
														"title" => "Required?",
														"desc" => __('the input is required?', 'mclang'),
														"opts" => $yes_no
													),
													array(
														"type" => "textarea",
														"id" => "options",
														"title" => "Options",
														"desc" => "Enter the options separated by comma"
													)
												),
												
												
												
												"Submit" => array(
													array(
														"type" => "text",
														"id" => "title",
														"class" => "inputtitle",
														"title" => "Submit Title",
														"desc" => "Submit title"
													),
													array(
														"type" => "text",
														"id" => "send_emails_to",
														"title" => __('Send Emails To:', 'mclang'),
														"desc" => __('Enter the email address that you want to use', 'mclang')
													),
													array(
														"type" => "select",
														"id" => "submit_color",
														"title" => "Submit Color",
														"desc" => __('the input is required?', 'mclang'),
														"opts" => $buttons_colors
													)
												),
												
												
												
												
												
										),
								),
								
								"type" => "page_layout");						
						
						
						
						
		$of_options[] = array( 
							"name" => __('Extras', 'mclang'),
							"type" => "subheading"
						);
						
						
						$of_options[] = array( "name" => "error_404 page title",
											"desc" => "Enter the title displayed in 404 error pages.",
											"id" => "error_404_title",
											"std" => "Error 404",
											"type" => "text");
						
						$of_options[] = array( "name" => "404 page subtitle",
											"desc" => "Enter the subtitle displayed in 404 error pages.",
											"id" => "error_404_subtitle",
											"std" => "We are sure this is your fault! Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum. Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non",
											"type" => "textarea");
											
						
						$of_options[] = array( "name" => "404 page text",
											"desc" => "Enter the text displayed in 404 error pages. you can use html.",
											"id" => "404_text",
											"std" => "We are sorry, the page you are looking for can't be found. please use the search box at the top of the page to find what you are looking for, if you are still having problems please contact us.",
											"type" => "textarea");					
																
						
						$of_options[] = array( "name" => "Category archive page title",
											"desc" => "title displayed in category archive pages",
											"id" => "category_archive_title",
											"std" => "Category Archive",
											"type" => "text");
											
						
						$of_options[] = array( "name" => "Category archive page subtitle",
											"desc" => "subtitle displayed in category archive pages",
											"id" => "category_archive_subtitle",
											"std" => "Welcome to the categories archive! Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum. Vestibulum eget erat velit, non euismod.",
											"type" => "textarea");
						
						
						$of_options[] = array( "name" => "Tag archive page title",
											"desc" => "title displayed in tag archive pages",
											"id" => "tag_archive_title",
											"std" => "Tags Archive",
											"type" => "text");
						
						
						$of_options[] = array( "name" => "Tag archive page subtitle",
											"desc" => "subtitle displayed in tag archive pages",
											"id" => "tag_archive_subtitle",
											"std" => "Welcome to the tags archive! Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum. Vestibulum eget erat velit, non euismod.",
											"type" => "textarea");										
											
											
						
						$of_options[] = array( "name" => "Archive page title",
											"desc" => "title displayed in archive pages",
											"id" => "archive_title",
											"std" => "Archives",
											"type" => "text");
						
						
						$of_options[] = array( "name" => "Archive page subtitle",
											"desc" => "subtitle displayed in archive pages",
											"id" => "archive_subtitle",
											"std" => "We are sure this is your fault! Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum. Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non",
											"type" => "textarea");					
						
						
						$of_options[] = array( "name" => "Author page title",
											"desc" => "title displayed in author pages",
											"id" => "author_title",
											"std" => "About the author",
											"type" => "text");
						
						
						$of_options[] = array( "name" => "Author page subtitle",
											"desc" => "subtitle displayed in author pages",
											"id" => "author_subtitle",
											"std" => "author information",
											"type" => "text");
						
						
						$of_options[] = array( "name" => "Search page title",
											"desc" => "title displayed in search pages",
											"id" => "search_title",
											"std" => "Search",
											"type" => "text");
						
						
						$of_options[] = array( "name" => "Search page subtitle",
											"desc" => "subtitle displayed in search pages",
											"id" => "search_subtitle",
											"std" => "Vestibulum eget erat velit, non euismod lectus. Fusce metus lectus, fringilla non gravida sed lacinia eget orci. Nullam fermentum, lorem in elementum varius, nisi ipsum elementum varius",
											"type" => "textarea");
						
						
				
						//require_once (OPTIONS_PATH . 'extras.php');																


















/*=================================================================*/
/* Footer Options Section
/* This section includes all the sub headings to separate the
/* Options in groups
/*=================================================================*/
$of_options[] = array( "name" => __('Footer Options', 'mclang'),
					"icon" => "footer",
					"type" => "heading");
		
		
		//Footer columns block
		$of_options[] = array( 
							"name" => __('Widgets', 'mclang'),
							"type" => "subheading"
						);
						$url =  ADMIN_DIR . 'assets/images/';
						$of_options[] = array( "name" => __('Footer columns', 'mclang'),
											"desc" => __('Select how many columns do you want to display in the footer..', 'mclang'),
											"id" => "footer-widgets",
											"std" => "footer4",
											"type" => "images",
											"options" => array(
												'footer2' => $url . 'footer-2.png',
												'footer3' => $url . 'footer-3.png',
												'footer4' => $url . 'footer-4.png')
						);
						
						
						$of_options[] = array( "name" => __('Display Copyright?', 'mclang'),
											"desc" => __('Shor or hide the copyright.', 'mclang'),
											"id" => "show_copyright",
											"std" => 1,
											"type" => "checkbox");
						
						
						$of_options[] = array( "name" => __('footer logo', 'mclang'),
											"desc" => __('Upload your footer logo.', 'mclang'),
											"id" => "footer_logo",
											"std" => "",
											"type" => "media");
											
												
						$of_options[] = array( "name" => __('Copyright Text', 'mclang'),
												"desc" => __('Copyright of your site, you can add links, to this area.', 'mclang'),
												"id" => "copyright",
												"std" => "© Bellum Studios - All Rights Reserved <br />Designed and Developed by <a href='#'>MC Studios</a>.",
												"type" => "textarea");
						
						
						
						$of_options[] = array( "name" => __('Display twitter icon?', 'mclang'),
											"desc" => __('Shor or hide the social icon.', 'mclang'),
											"id" => "footer_twitter",
											"std" => 1,
											"type" => "checkbox");
						
						$of_options[] = array( "name" => __('Display facebook icon?', 'mclang'),
											"desc" => __('Shor or hide the social icon.', 'mclang'),
											"id" => "footer_facebook",
											"std" => 1,
											"type" => "checkbox");	
											
						$of_options[] = array( "name" => __('Display rss icon?', 'mclang'),
											"desc" => __('Shor or hide the rss icon.', 'mclang'),
											"id" => "footer_rss",
											"std" => 1,
											"type" => "checkbox");									
						
						$of_options[] = array( "name" => __('Display dribble icon?', 'mclang'),
											"desc" => __('Shor or hide the social icon.', 'mclang'),
											"id" => "footer_dribble",
											"std" => 1,
											"type" => "checkbox");
											
						$of_options[] = array( "name" => __('Display vimeo icon?', 'mclang'),
											"desc" => __('Shor or hide the social icon.', 'mclang'),
											"id" => "footer_vimeo",
											"std" => 1,
											"type" => "checkbox");
						
						$of_options[] = array( "name" => __('Display tumblr icon?', 'mclang'),
											"desc" => __('Shor or hide the social icon.', 'mclang'),
											"id" => "footer_tumblr",
											"std" => 1,
											"type" => "checkbox");										
		
		
		
		//Google Analytics Block
		$of_options[] = array( 
							"name" => __('Google Analitycs', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Tracking Code', 'mclang'),
												"desc" => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer of your theme.', 'mclang'),
												"id" => "google_analytics",
												"std" => "",
												"type" => "textarea");
												
												
												
												
		//Footer Scripts Block				
		$of_options[] = array( 
							"name" => __('Extra Scripts', 'mclang'),
							"type" => "subheading"
						);
						$of_options[] = array( "name" => __('Additional Scripts', 'mclang'),
												"desc" => __('Additional jQuery Scripts.', 'mclang'),
												"id" => "jquery_scripts",
												"std" => "",
												"type" => "textarea");
					
		













/*=================================================================*/
/* Back Up Options Section
/* This section includes all the sub headings to separate the
/* Options in groups
/*=================================================================*/
$of_options[] = array( "name" => __('Backup Options', 'mclang'),
					"icon" => "backup",
					"type" => "heading");
					
					
					$of_options[] = array( "name" => __('Demo Content', 'mclang'),
										"desc" => __('Install the demo content, this will leave your site like the theme preview.', 'mclang'),
										"id" => "install_demo_content",
										"std" => "",
										"type" => "demo_install");
										
										
					
					
$of_options[] = array( "name" => __('Backup and Restore Options', 'mclang'),
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'mclang'),
					);
					
$of_options[] = array( "name" => __('Transfer Theme Options Data', 'mclang'),
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options', 'mclang'),
					);	


?>