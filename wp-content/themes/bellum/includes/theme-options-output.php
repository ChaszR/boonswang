<?php 
/**
 * MC Studios Framework Theme Options Output
 *
 * Here are defined all the output of the styling options of the theme
 *
 * This file includes the logo, custom typography, etc to the head of the page.
 * You can remove this file if you are planning to create a new skin editing 
 * the css files
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
/* Favicon
/*=================================================================*/
if (!function_exists( "mc_favicon")) {
	function mc_favicon() {
		global $data;
		$favicon= '';
		// Go through the options
		if ( $data["favicon"] !== '') { $favicon = $data["favicon"];}
		else{ $favicon = get_template_directory_uri() . '/admin/assets/images/favicon.ico'; }
		
			echo '<link href="'. $favicon .'" rel="shortcut icon" />'."\n\n";			
		}
	}

add_action( 'wp_head', 'mc_favicon' );




/*=================================================================*/
/* Styling Options
/*=================================================================*/
if (!function_exists( "mcstudios_custom_style_options")) {
	
	function mcstudios_custom_style_options(){
		global $data;
		
		$output = '<style type="text/css">'."\n";
		
			
				
				
				
				//Custom Logo
				if ( $data["logo"] !== '') {
					$logo = $data["logo"];				
					$logo_properties = $data["logo_properties"];
					$output .= '#logo{'."\n";
					$output .= 'text-indent: -9999px;'."\n";
					$output .= 'background: url('.$logo.') no-repeat;'."\n";
					$output .= 'width: '.$logo_properties["width"].''.$logo_properties["width_measure"].';'."\n";
					$output .= 'height: '.$logo_properties["height"].''.$logo_properties["height_measure"].';'."\n";
					$output .= 'margin: '.$logo_properties["top"].''.$logo_properties["top_measure"].' '.$logo_properties["right"].''.$logo_properties["right_measure"].' '.$logo_properties["bottom"].''.$logo_properties["bottom_measure"].' '.$logo_properties["left"].''.$logo_properties["left_measure"].';'."\n";
					$output .= 'float: '.$data['logo_align'].';'."\n";
					$output .= '}'."\n";
				}
				//Custom High Resolution Logo
				if ( $data["logo_hires"] !== '') {
					$logo_hires = $data["logo_hires"];				
					$logo_properties = $data["logo_properties"];			
					$output .= '@media'."\n";
					$output .= 'only screen and (-webkit-min-device-pixel-ratio: 2),'."\n";
					$output .= 'only screen and (min-device-pixel-ratio: 2), '."\n";
					$output .= 'only screen and (min-resolution: 192dpi) { '."\n";
						$output .= '#logo{'."\n";
							$output .= 'background: transparent url('.$logo_hires.') no-repeat;'."\n";
							$output .= 'background-size: '.$logo_properties["width"].''.$logo_properties["width_measure"].' '.$logo_properties["height"].''.$logo_properties["height_measure"].';'."\n";
						$output .= '}'."\n";
					$output .= '}'."\n";
				} else {
					$logo_hires = $data["logo"];				
					$logo_properties = $data["logo_properties"];			
					$output .= '@media'."\n";
					$output .= 'only screen and (-webkit-min-device-pixel-ratio: 2),'."\n";
					$output .= 'only screen and (min-device-pixel-ratio: 2), '."\n";
					$output .= 'only screen and (min-resolution: 192dpi) { '."\n";
						$output .= '#logo{'."\n";
							$output .= 'background: transparent url('.$logo_hires.') no-repeat;'."\n";
							$output .= 'background-size: '.$logo_properties["width"].''.$logo_properties["width_measure"].' '.$logo_properties["height"].''.$logo_properties["height_measure"].';'."\n";
						$output .= '}'."\n";
					$output .= '}'."\n";
				}
 				
				
				
				
				
				
				//Menu
				if ( $data["menu_properties"] !== '') {
					$menu_properties = $data["menu_properties"];
					$output .= '#main-menu{'."\n";
					$output .= 'margin: '.$menu_properties["top"].''.$menu_properties["top_measure"].' '.$menu_properties["right"].''.$menu_properties["right_measure"].' '.$menu_properties["bottom"].''.$menu_properties["bottom_measure"].' '.$menu_properties["left"].''.$menu_properties["left_measure"].' !important;'."\n";
					$output .= '}'."\n";
				}
				
				
								
				
				
				
				
				
				
				
				
				
				
				//Post icon format
				if ( $data["post_format_icon"] !== '') {
					$icon_format = $data["post_format_icon"];
					$output .= '.post-type span{'."\n";
					$output .= 'background-color: '.$icon_format.' !important;'."\n";
					$output .= '}'."\n";
				}
				
				
				
				
				//Links Colors Normal
				if (!empty($data['link_normal'])) {
					$normal = $data["link_normal"];
					if($normal !== ''){
							$output .= 'a,
							#sidebar li a:hover,
							#footer li a:hover,
							h1 a:hover, 
							h2 a:hover, 
							h3 a:hover, 
							h4 a:hover, 
							h5 a:hover,
							h6 a:hover,
							.hovered-link,
							.project:hover .post-title a,
							.blog-post:hover .post-title a,
							#footer a,
							#header .vcard p span,
							#footer .twitter-widget li a:first-child,
							#sidebar .twitter-widget li a:first-child,
							#filter-bar #filters li a.selected,
							#filter-bar #filters li a:hover,
							.link,
							a.social:hover,
							.team-member .text .position,
							.breadcrumb a,
							.nav-tabs li.active:hover a,
							.nav-tabs li.active a,
							.nav-tabs li:hover a,
							.social-container p span,
							h1.middle strong{'."\n";
							$output .= 'color: '.$normal.';'."\n";
							$output .= '}'."\n";		
					}
				}
				
				//Links Hover
				if (!empty($data['link_hover'])) {
					$hover = $data["link_hover"];
					if($hover !== ''){
							$output .= '#main a:hover, #main a.link:hover, #footer a:hover, #footer li a:hover #sidebar li a:hover{'."\n";
							$output .= 'color: '.$hover.' !important;'."\n";
							$output .= '}'."\n";
					}
				}
				
				
				//Menu Hover
				if (!empty($data['menu_link_active'])) {
					$menu_hover = $data["menu_link_active"];
					if($hover !== ''){
							$output .= '#header #menu .nav > li.current > a,
							#header #menu .nav > li.current_page_item > a{'."\n";
							$output .= 'color: '.$menu_hover.';'."\n";
							$output .= '}'."\n";
					}
				}
				
				
				
				
				
				//Typography Page heading
				if (!empty($data['page_header'])) {
				$heading = $data["page_header"];
					if($heading["face"] !== ''){
						
						if($heading["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $heading["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($heading["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($heading["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($heading["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
							$output .= '#page-header h1{'."\n";
							if($heading["height"] == 'px'){
								$output .= 'font-size: '.$heading["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$heading["sizeem"].'em;'."\n";
							}
							$output .= 'font-family: '.$fontface.'; '."\n";
							$output .= 'color: '.$heading["color"].' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
					}
				}
				
				
				
				//Typography Page subheading
				if (!empty($data['page_subheader'])) {
				$font = $data["page_subheader"];
					if($font["face"] !== ''){
						
						if($font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
							$output .= '#page-header p{'."\n";
							if($font["height"] == 'px'){
								$output .= 'font-size: '.$font["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$font["sizeem"].'em;'."\n";
							}
							$output .= 'font-family: '.$fontface.'; '."\n";
							$output .= 'color: '.$font["color"].' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
					}
				}
				
				
				
				
				
				
				
				
				
				//Typography P paragraph
				if (!empty($data['general_font'])) {
				$general = $data["general_font"];
					if($general["face"] !== ''){
						
						if($general["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $general["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($general["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($general["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($general["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
							$output .= '#main p, #main li, #sidebar p, #sidebar li a, #sidebar li, #footer p, #footer li{'."\n";
							if($general["height"] == 'px'){
								$output .= 'font-size: '.$general["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$general["sizeem"].'em;'."\n";
							}
							$output .= 'font-family: '.$fontface.'; '."\n";
							$output .= 'color: '.$general["color"].' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
					}
				}
				
				
				
				
				//Typography  Heading H1
				if (!empty($data['h1_font'])) {
					$h1_font = $data["h1_font"];
					if($h1_font["face"] !== ''){
					
						if($h1_font["face"] == 'helvetica'){
							$fontface = "'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $h1_font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($h1_font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($h1_font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($h1_font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
							$output .= '#main h1{'."\n";
							if($h1_font["height"] == 'px'){
								$output .= 'font-size: '.$h1_font["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$h1_font["sizeem"].'em;'."\n";
							}
							$output .= 'font-family: '.$fontface.'; '."\n";
							$output .= 'color: '.$h1_font["color"].';'."\n";
							$output .= $font_style;
							$output .= '}'."\n";	
					}
				}
				//Typography  Heading H2
				if (!empty($data['h2_font'])) {
					$h2_font = $data["h2_font"];
					if($h2_font["face"] !== ''){
					
						if($h2_font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $h2_font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}		
						
						if($h2_font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($h2_font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($h2_font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
						
							$output .= '#main h2{'."\n";
							if($h2_font["height"] == 'px'){
								$output .= 'font-size: '.$h2_font["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$h2_font["sizeem"].'em;'."\n";
							}
							$output .= 'font-family: '.$fontface.'; '."\n";
							$output .= 'color: '.$h2_font["color"].';'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
					}
				}
				
				//Typography  Heading H3
				if (!empty($data['h3_font'])) {
					$h3_font = $data["h3_font"];
					if($h3_font["face"] !== ''){
						if($h3_font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $h3_font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($h3_font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($h3_font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($h3_font["style"] == 'bold'){
							$font_style = 'font-style: normal !important;; font-weight: bold !important;';
						} else{
							$font_style = 'font-style: italic !important;; font-weight: bold !important;';	
						}
						
							$output .= '#main h3{'."\n";
							if($h3_font["height"] == 'px'){
								$output .= 'font-size: '.$h3_font["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$h3_font["sizeem"].'em'."\n";
							}
							$output .= 'font-family: '.$fontface.' !important;'."\n";
							$output .= 'color: '.$h3_font["color"].' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
					}
				}
				//Typography  Heading H4
				if (!empty($data['h4_font'])) {
					$h4_font = $data["h4_font"];
					if($h4_font["face"] !== ''){
						if($h4_font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $h4_font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($h4_font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($h4_font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($h4_font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
							$output .= '#main h4{'."\n";
							if($h4_font["height"] == 'px'){
								$output .= 'font-size: '.$h4_font["sizepx"].'px;'."\n";
							} else{
								$output .= 'font-size: '.$h4_font["sizeem"].'em'."\n";
							}
							$output .= 'font-family: '.$fontface.' !important;'."\n";
							$output .= 'color: '.$h4_font["color"].' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";
							$output .= '#main .newsletter h4{ color: #1b1b1b; font: italic normal 19px Georgia, "Times New Roman", Times, serif !important;}';
							
					}
				}
				
			
				
				
				//Widgets Title
				if (!empty($data['widgets_font'])) {
					$widget_font = $data["widgets_font"];
					if($widget_font["face"] !== ''){
						if($widget_font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $widget_font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($widget_font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($widget_font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($widget_font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
							$output .= '#sidebar .widget h4.title{'."\n";
							if($widget_font["height"] == 'px'){
								$output .= 'font-size: '.$widget_font["sizepx"].'px !important;'."\n";
							} else{
								$output .= 'font-size: '.$widget_font["sizeem"].'em !important;'."\n";
							}
							$output .= 'font-family: '.$fontface.' !important;'."\n";
							$output .= 'color: '.$widget_font["color"].' !important;'."\n";
							$output .= '}'."\n";
							
							$output .= '#footer h3{'."\n";
							if($widget_font["height"] == 'px'){
								$output .= 'font-size: '.$widget_font["sizepx"].'px !important;'."\n";
							} else{
								$output .= 'font-size: '.$widget_font["sizeem"].'em !important;'."\n";
							}
							$output .= 'font-family: '.$fontface.' !important;'."\n";
							$output .= $font_style;
							$output .= '}'."\n";			
					}
				}
				
				
				
				
				
				//Menu Links
				if (!empty($data['menu_links'])) {
					$font = $data["menu_links"];
					if($font["face"] !== ''){
						if($font["face"] == 'helvetica'){
							$fontface = "'Helvetica Neue', Helvetica, Arial, Geneva, sans-serif";
						} else{
							$fontface = str_replace(".ttf", "", $font["face"]) . ', Helvetica, Arial, Geneva, sans-serif';
						}
						
						if($font["style"] == 'italic'){
							$font_style = 'font-style: italic;';
						} elseif($font["style"] == 'normal'){
							$font_style = 'font-style: normal;';
						} elseif($font["style"] == 'bold'){
							$font_style = 'font-style: normal; font-weight: bold;';
						} else{
							$font_style = 'font-style: italic; font-weight: bold;';	
						}
						
						
							$output .= '#header #menu .nav > li > a{'."\n";
							if($font["height"] == 'px'){
								$output .= 'font-size: '.$font["sizepx"].'px !important;'."\n";
							} else{
								$output .= 'font-size: '.$font["sizeem"].'em !important;'."\n";
							}
							$output .= 'font-family: '.$fontface.' !important;'."\n";
							$output .= '/*color: '.$font["color"].';*/'."\n";
							$output .= '}'."\n";		
					}
				}
				
				
				
				
				//Menu borders
				if (!empty($data['menu_link_hover_bottom_border'])) {
					$output .= '#menu .nav > li:hover > a{'."\n";		
					$output .= 'border-bottom: 3px solid '.$data['menu_link_hover_bottom_border'].';';
					$output .= '}'."\n";
				}
				if (!empty($data['menu_link_active_top_border'])) {
					$output .= '#menu .nav > li.current > a,#menu .nav > li.current_page_item > a,#menu .nav > li.current:hover > a,#menu .nav > li.current_page_item:hover > a{'."\n";		
					$output .= 'border-top: 3px solid '.$data['menu_link_active_top_border'].';';
					$output .= '}'."\n";
				}
				
				
				
				
				
				
				//Custom CSS
				if ( $data["custom_css"] !== '') {
				$css = stripslashes($data["custom_css"]);
				$output .= ''.$css.'';
				}
		$output .= '</style>'."\n\n";
		echo $output;
	}
}
add_action( 'wp_head', 'mcstudios_custom_style_options' );
?>