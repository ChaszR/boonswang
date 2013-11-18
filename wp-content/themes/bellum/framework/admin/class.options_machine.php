<?php 
/**
 * Options Machine Class MC Studios Framework
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
class Options_Machine {
	/**
	 * PHP5 contructor
	 *
	 * @since 1.0.0
	 */
	function __construct($options) {
		
		$return = $this->optionsframework_machine($options);
		
		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];
		
	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {
	
	    $data = get_option(OPTIONS);
		
		$defaults = array();   
	    $counter = 0;
		$menu = '';
		$output = '';
		
		foreach ($options as $value) {
		
			$counter++;
			$val = '';
			
			//create array of defaults		
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
				
					
					if(isset($value['id'])){
						$value['id'] = $value['id'];
					} elseif(isset($value['std'])){
						$value['id'] = $value['std'];
					} else{
						$value['id'] = '';
					}
			 
			 
			}
			
			//Start Heading
			 if ( $value['type'] != "heading" && $value['type'] != "subheading" && $value['type'] != "tabsmenu" && $value['type'] != "tabbed" && $value['type'] != "endtabs" )
			 {
			 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				//hide items in checkbox group
				$fold='';
				if (array_key_exists("fold",$value)) {
					if ($data[$value['fold']]) {
						$fold="f_".$value['fold']." ";
					} else {
						$fold="f_".$value['fold']." temphide ";
					}
				}
	
				$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";
				
				//only show header if 'name' value exists
				if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
	
			 }
			 //End Heading
			
			//switch statement to handle various options type                              
			switch ( $value['type'] ) {
				
				
				
				//Install demo content button
				case 'demo_install':
					$output .= '<div id="demo-data-holder">';
					$output .= '<a id="import-demo-data" class=""  href="#" data-siteurl="'.admin_url().'"   data-installurl="'.get_stylesheet_directory_uri().'">Import demo content</a>';
					$output .= '<div id="import-loader">loader</div>';
					$output .= '<p class="note">Please wait a few seconds and don\'t reload the page, You will be notified as soon as the importer has finished!</p>';
					$output .= '</div>';
				break;
				
				
				
				//text input
				case 'text':
					$t_value = '';
					
					if(isset($data[$value['id']]))
					$t_value = stripslashes($data[$value['id']]);
					
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}
					
					$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
				break;
				
				//select option
				case 'select':
					$mini ='';
					if(!isset($value['mod'])) $value['mod'] = '';
					if($value['mod'] == 'mini') { $mini = 'mini';}

					$output .= '<div class="select_wrapper ' . $mini . '">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					
					
					if ($value['options'] == 'pages') {
						$mc_pages = array();
						$mc_pages_obj = get_pages('sort_column=post_parent,menu_order');
						$mc_pages_total = array();
						foreach ($mc_pages_obj as $mc_page) {
						    $mc_pages[] = array($mc_page->ID => $mc_page->post_name); 
						}
						$output .= '<option value="" ' . $selected . ' />'.__('Select Page:', 'mclang').'</option>';
						foreach ($mc_pages as $page) {
							foreach ($page as $page_key => $page_name) {	
								$selected = '';
								if (isset($data[$value['id']])) {
									if ($data[$value['id']] == $page_key) {
										$selected = 'selected';
									}
								}
								$output .= '<option value="' . $page_key . '" ' . $selected . ' />'.$page_name.'</option>';
							}
						} 
						
					} else {
						foreach ($value['options'] as $select_ID => $option) {
							$selected = '';
							if (isset($data[$value['id']])) {
								if ($data[$value['id']] == $select_ID) {
									$selected = 'selected';
								}
							}
							$output .= '<option value="' . $select_ID . '" ' . $selected . ' />'.$option.'</option>';	 
						} 	
					}
					
			
					
					$output .= '</select></div>';
				break;
				
				
				
				//multiselect option
				case 'multiselect':
					$mini ='';
					if(!isset($data[$value['id']])) $data[$value['id']] = '';
				
					$output .= '<div class="select_wrapper_multiple  checkbox_wrapper_multiple' . $mini . '">';
					$output .= '';
						
						foreach ($value['options'] as $key => $option) {			
						$selected = '';
						
						if (sizeof($data[$value['id']]) > 0 && is_array($data[$value['id']]))
						{
							if(in_array($key, $data[$value['id']])){
								$selected = ' checked';
							}
						} else { $selected = ''; }
							//$output .= '<option id="' . $select_ID . '" value="'.$select_ID.'" ' . $selected . ' />'.$option.'</option>';
							
							$output .= '<label><input class="normal-checkbox" type="checkbox" name="'.$value['id'].'[]" value="'.$key.'" ' . $selected . '/>'.$option.'</label>';	 
						} 
					$output .= '</div>';
				break;
				
				
				
				
				//textarea option
				case 'textarea':	
					$cols = '8';
					$ta_value = '';
					
					if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
							$cols = $ta_options['cols'];
							} 
						}
						
						if(isset($data[$value['id']])) $ta_value = stripslashes($data[$value['id']]);			
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
				break;
				
				//radiobox option
				case "radio":
					
					 foreach($value['options'] as $option=>$name) {
						$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($data[$value['id']], $option, false) . ' /><label class="radio">'.$name.'</label><br/>';				
					}
				break;
				
				//checkbox option
				case 'checkbox':
					if (!isset($data[$value['id']])) {
						$data[$value['id']] = 0;
					}
					
					$fold = '';
					if (array_key_exists("folds",$value)) $fold="fld ";
		
					$output .= '<input type="hidden" class="'.$fold.'checkbox aq-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
					$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($data[$value['id']], 1, false) .' />';
				break;
				
				//multiple checkbox option
				case 'multicheck': 			
					if(isset($data[$value['id']])) $multi_stored = $data[$value['id']];
								
					foreach ($value['options'] as $key => $option) {
						if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
						$of_key_string = $value['id'] . '_' . $key;
						$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';								
					}			 
				break;
				
				//ajax image upload option
				case 'upload':
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::optionsframework_uploader_function($value['id'],$value['std'],$value['mod']);			
				break;
				
				// native media library uploader - @uses optionsframework_media_uploader_function()
				case 'media':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					if(!isset($value['mod'])) $value['mod'] = '';
					$output .= Options_Machine::optionsframework_media_uploader_function( $value['id'], $value['std'], $int, $value['mod'] ); // New AJAX Uploader using Media Library			
				break;
				
				//colorpicker option
				case 'color':
					if(isset($data[$value['id']])){
						$data[$value['id']] = $data[$value['id']];
					} else{
						$data[$value['id']] = $value['std'];
					}
					$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$data[$value['id']].'"></div></div>';
					$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $data[$value['id']] .'" />';
				break;
				
				
				//Typography option
				case 'typography':
					if(isset($data[$value['id']])) $typography_stored = $data[$value['id']];

					if(!empty($typography_stored)){
						$typography_stored = $typography_stored;
					} else{
						$_sizepx = $value['std']['sizepx'];
						if(empty($_sizepx)){ $_sizepx = '9';}
						$_sizeem = $value['std']['sizeem'];
						if(empty($_sizeem)){ $_sizepx = '0.6';}
						$height = $value['std']['height'];
						if(empty($height)){ $height = 'px';}
						$face = $value['std']['face'];
						if(empty($face)){ $face = ''; }
						$style = $value['std']['style'];
						if(empty($style)){ $style = 'normal';}
						$color = $value['std']['color'];
						if(empty($color)){ $color = '#000000';}
						$typography_stored = array('sizepx' => $value['std']['sizepx'], 'sizeem' => $_sizeem, 'height' => $height, 'face' => $face, 'style' => $style, 'color' => $color);
					}
					

			        /* Font Size */
		          	if(isset($typography_stored['sizepx'])) {
						if ( $typography_stored['height'] == 'px'){ 
							$show_px = ''; 
							$show_em = ' style="display:none" ';
						}
						else if ( $typography_stored['height'] == 'em'){ 
							$show_em = ''; 
							$show_px = 'style="display:none"'; 
						}
						else { 
							$show_px = ''; 
							$show_em = ' style="display:none" '; 
						}

		              	$output .= '<div id="select-px" class="select_wrapper typography-size" '. $show_px .'>';
			            $output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[sizepx]" id="'. $value['id'].'_sizepx" >';
              			for ($i = 9; $i < 91; $i++){ 
                  			$test = $i.'';
                  				$output .= '<option value="'. $i .'" ' . selected($typography_stored['sizepx'], $test, false) . '>'. $i .'</option>'; 
						}
              			$output .= '</select></div>';								

	
						if(isset($typography_stored['sizeem'])) {  
							$output .= '<div id="select-em" class="select_wrapper typography-size" '. $show_em .'>';
				            $output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[sizeem]" id="'. $value['id'].'_sizeem">';
							$em = 0.5;
				            for ($i = 0; $i < 39; $i++){ 
                  				$test = $i.'px';
								if ($i <= 24)			// up to 2.0em in 0.1 increments
									$em = $em + 0.1;
								elseif ($i >= 14 && $i <= 24)		// Above 2.0em to 3.0em in 0.2 increments
									$em = $em + 0.2;
								elseif ($i >= 24)		// Above 3.0em in 0.5 increments
									$em = $em + 0.5;
										
								if($typography_stored['sizeem'] == strval($em)){ $active = 'selected="selected"'; } else { $active = ''; }
									
			                 	 $output .= '<option value="'. $em .'" ' . $active . '>'. $em .'</option>'; 
							}
				            $output .= '</select></div>';
						}				
			          } // end isset($typography_stored['sizepx'])
			          
			          

			          /* Line Height */
          			  if(isset($typography_stored['height'])) {
		              	$output .= '<div class="select_wrapper typography-height typography-unit">';
        		      	$output .= '<select class="of-typography of-typography-height of-typography-unit select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							$em = ''; $px = '';
							if($typography_stored['height'] == 'em'){ $em = 'selected="selected"'; }
							if($typography_stored['height'] == 'px'){ $px = 'selected="selected"'; }
							$output .= '<option value="px" '. $px .'">px</option>';
							$output .= '<option value="em" '. $em .'>em</option>';
		              	$output .= '</select></div>';
        			  }





          			  /* Font Face */
	          		  if(isset($typography_stored['face'])) {
              			$output .= '<div class="select_wrapper typography-face">';
			            $output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
						$output .= '<option value="">Select Font:</option>';

              			$faces = array('arial'=>'Arial',
                              'verdana'=>'Verdana, Geneva',
                              'trebuchet'=>'Trebuchet',
                              'georgia' =>'Georgia',
                              'times'=>'Times New Roman',
                              'tahoma'=>'Tahoma, Geneva',
                              'palatino'=>'Palatino',
                              'helvetica'=>'Helvetica' );			

						$output .= '<optgroup label="Normal Fonts">';
              			foreach ($faces as $i=>$face) {
                  			$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
              			}			
						$output .= '</optgroup>';
							
							
						// Google webfonts
						global $google_fonts;
						if(!empty($google_fonts)){  //If there are no fonts hide the group
						sort ($google_fonts);
						$output .= '<optgroup class="googleFonts" label="Google Fonts">';
							foreach ($google_fonts as $key=>$gfont) {
								$font[$key] = '';
								if ($typography_stored['face'] == $gfont['name']){ $font[$key] = 'selected="selected"'; }
								$name = $gfont['name'];
								$output .= '<option value="'.$name.'" '. $font[$key] .'>'.$name.'</option>';
			                }		
						$output .= '</optgroup>';
						}


						// Cufon fonts
						global $cufon_fonts;
						if(!empty($cufon_fonts)){  //If there are no fonts hide the group
						 	sort ($cufon_fonts);
							$output .= '<optgroup class="cufonFonts" label="Cufon Fonts">';
							foreach ($cufon_fonts as $cfont) {
								$selected = '';
								if ($typography_stored['face'] == $cfont){ $selected = 'selected="selected"'; }
									$cufon_name = str_replace(".js","",$cfont);
									$cufon_name = str_replace("_"," ",$cufon_name);
			                    $output .= '<option value="'. $cfont .'" ' . $selected . '>'. $cufon_name .'</option>';
			                }
							$output .= '</optgroup>';
						}
							
							
						// Fontface fonts
						 global $fontface_fonts;
						if(!empty($fontface_fonts)){  //If there are no fonts hide the group
							sort ($fontface_fonts);
							$output .= '<optgroup class="fontfaceFonts" label="FontFace Fonts">';
							foreach ($fontface_fonts as $ffont) {
								$selected = '';
								if ($typography_stored['face'] == $ffont){ $selected = 'selected="selected"'; }
								$fontface_name = str_replace(".ttf","",$ffont);
								$fontface_name = str_replace("_"," ",$fontface_name);
			                    $output .= '<option value="'. $ffont .'" ' . $selected . '>'. $fontface_name .'</option>';
			                }
							$output .= '</optgroup>';
						}	
	              		$output .= '</select></div>';
          				}
          				

          				/* Font Weight */
				        if(isset($typography_stored['style'])) {
              				$output .= '<div class="select_wrapper typography-style">';
				            $output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
              				$styles = array(
              					'normal'=>'Normal',
                              	'italic'=>'Italic',
                              	'bold'=>'Bold',
                              	'bold italic'=>'Bold/Italic'
                            );

			              	foreach ($styles as $i=>$style){
			                  $output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
              				}
			              $output .= '</select></div>';
          				}
          				

			          	/* Font Color */
				        if(isset($typography_stored['color'])) {
							$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
              				$output .= '<input class="hidden of-color of-typography of-typography-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
              			}

						$output .= '<div class="button preview-btn"><span class="preview">preview</span></div>';
						$output .= ' <div class="clear"></div><div id="font_preview">';
						$output .= '<div id="font-loading" class="noshow">Loading</div>';
						$output .= '<h4 id="font-refresh">"Jackdaws love my big sphinx of quartz."</h4>';
						$output .= '</div>';
			     break;
				
				
				
				//images checkbox - use image as checkboxes
				case 'images':
				
					$i = 0;
					
					if(isset($data[$value['id']])) {$select_value = $data[$value['id']];} else{ $select_value = '';}
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $key, false)) {
							$checked = checked($select_value, $key, false);
							$selected = 'of-radio-img-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-img-label">'. $key .'</div>';
						$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
						$output .= '</span>';				
					}
					
				break;
				
				//info (for small intro box etc)
				case "info":
					$info_text = $value['std'];
					$output .= '<div class="of-info">'.$info_text.'</div>';
				break;
				
				//display a single image
				case "image":
					$src = $value['std'];
					$output .= '<img src="'.$src.'">';
				break;
				
				//tab heading
				case 'heading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}
					
					if (isset($value['class'])) {
						$custom_class = $value['class'];
					} else {
						$custom_class = '';
					}
					
					$icon = 'option-icon-'.$value['icon'];		
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					
					
					$menu .= '<li class="'. $header_class .' '. $icon .' heading-menu '.$custom_class.' '.$jquery_click_hook.'">';
					$menu .= '<a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a>';
					$menu .= '</li>';
					
					
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";	
				break;
				
				
				
				case 'subheading':
					if($counter >= 2){
					   $output .= '</div>'."\n";
					}	
					$header_class = str_replace(' ','',strtolower($value['name']));
					$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
					$jquery_click_hook = "of-option-" . $jquery_click_hook;
					$menu .= '<li class="'. $header_class .' subheading '.$jquery_click_hook.'">';
					$menu .= '<a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'"><span></span>'.  $value['name'] .'</a>';
					$menu .= '</li>';
					
					
					$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";	
				break;
				
				
				
				//drag & drop slide manager
				case 'slider':
					$_id = strip_tags( strtolower($value['id']) );
					$int = '';
					$int = optionsframework_mlu_get_silentpost( $_id );
					$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
					$slides = $data[$value['id']];
					$count = count($slides);
					if ($count < 2) {
						$oldorder = 1;
						$order = 1;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
					} else {
						$i = 0;
						foreach ($slides as $slide) {
							$oldorder = $slide['order'];
							$i++;
							$order = $i;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int);
						}
					}			
					$output .= '</ul>';
					$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';
					
				break;
				
				
				//background images option
				case 'tiles':
					
					$i = 0;
					$select_value = '';
					$select_value = $data[$value['id']];
					
					foreach ($value['options'] as $key => $option) 
					{ 
					$i++;
			
						$checked = '';
						$selected = '';
						if(NULL!=checked($select_value, $option, false)) {
							$checked = checked($select_value, $option, false);
							$selected = 'of-radio-tile-selected';  
						}
						$output .= '<span>';
						$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
						$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
						$output .= '</span>';				
					}
					
				break;
				
				
				
				
				//measure option
				case 'measure':   
					if(isset($data[$value['id']]))
						$measure_stored = $data[$value['id']];
						
						$measures = $value['std'];
						
						
						$styles = array('px'=>'px',
										'em'=>'em',
										'ex'=>'ex');
										
					    /* Width */
					    if(isset($measure_stored['width'])) {
							$output .= '<div class="measure-block"><p class="mc-label">Width</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[width]" id="'. $value['id'].'_width" type="text" value="'. $measure_stored['width'] .'" />';        				
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[width_measure]" id="'. $value['id'].'_width_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['width_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
					        
					     /* Height */
					     if(isset($measure_stored['height'])) {
					        $output .= '<div class="measure-block"><p class="mc-label">Height</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[height]" id="'. $value['id'].'_height" type="text" value="'. $measure_stored['height'] .'" />';
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[height_measure]" id="'. $value['id'].'_height_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['height_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
					            
					     /* Top Margin */
					     if(isset($measure_stored['top'])) {
					        $output .= '<div class="measure-block"><p class="mc-label">Top Margin</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[top]" id="'. $value['id'].'_top" type="text" value="'. $measure_stored['top'] .'" />';        				
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[top_measure]" id="'. $value['id'].'_top_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['top_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
					        
					     /* Left Margin */
					     if(isset($measure_stored['left'])) {
					        $output .= '<div class="measure-block"><p class="mc-label">Left Margin</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[left]" id="'. $value['id'].'_left" type="text" value="'. $measure_stored['left'] .'" />';
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[left_measure]" id="'. $value['id'].'_left_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['left_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
					
						 /* Bottom Margin */
					     if(isset($measure_stored['bottom'])) {
					        $output .= '<div class="measure-block"><p class="mc-label">Bottom Margin</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[bottom]" id="'. $value['id'].'_bottom" type="text" value="'. $measure_stored['bottom'] .'" />';
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[bottom_measure]" id="'. $value['id'].'_bottom_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['bottom_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
					
					
						 /* Right Margin */
					     if(isset($measure_stored['right'])) {
					        $output .= '<div class="measure-block"><p class="mc-label">Right Margin</p>';
					        $output .= '<input class="of-typography of-typography-size of-pixels-number" name="'.$value['id'].'[right]" id="'. $value['id'].'_right" type="text" value="'. $measure_stored['right'] .'" />';
							$output .= '<div class="select_wrapper pixels_select">';
					        $output .= '<select class="of-typography select" name="'.$value['id'].'[right_measure]" id="'. $value['id'].'_right_measure">';
							foreach ($styles as $i=>$style){
								$output .= '<option value="'. $i .'" ' . selected($measure_stored['right_measure'], $i, false) . '>'. $style .'</option>';		
							}
					        $output .= '</select></div></div>';
					     }
    			break;
    
    			//Sidebars option
    			case 'sidebars':
    			    $_id = strip_tags( strtolower($value['id']) );
    			    $int = '';
    			    $int = optionsframework_mlu_get_silentpost( $_id );
    			    $output .= '<div class="sidebars-manager"><ul id="'.$value['id'].'" rel="'.$int.'">';
    			    if(isset($data[$value['id']])) $slides = $data[$value['id']];
    			    
    			    
    			    if(isset($slides)) {
    			    	$count = count($slides);
    			    } else {
    			    	$count = 0;
    			    }
    			    if ($count < 2) {
    			        $oldorder = 1;
    			        $order = 1;
    			        $output .= Options_Machine::optionsframework_sidebars_function($value['id'],$value['std'],$oldorder,$order,$int);
    			    } else {
    			        $i = 0;
    			        
    			        if(isset($slides)){
    			            foreach ($slides as $slide) {
    			            $oldorder = $slide['order'];
    			            $i++;
    			            $order = $i;
    			            $output .= Options_Machine::optionsframework_sidebars_function($value['id'],$value['std'],$oldorder,$order,$int);
    			            }
    			        }
    			        
    			        
    			    }			
    			    $output .= '</ul>';
    			    $output .= '<a href="#" class="button sidebar_add_button">Add New Sidebar</a></div>';
    			    
    			break;
    
    
    			case 'page_layout':
    				$_id = strip_tags( strtolower($value['id']) );
    				$int = '';
    				$int = optionsframework_mlu_get_silentpost( $_id );
    				$output .= '<div class="slider layout_manager">';
    				$output .= '<div class="select_wrapper main-block-selector">';
    				$output .= '<select class="select of-input" name="'. $_id .'" id="'.$_id.'-selector">';
    				$output .= '<option value=""/>Select Block:</option>';
    				foreach ($value['options'] as $newb) {
    					foreach ($newb as $nkey => $block) {
    						$output .= '<option value="'.$nkey.'"/>'.$nkey.'</option>';
    					}				
    				}
    				$output .= '</select></div><a href="#" rel="'.$value['id'].'" class="button mcstdios-block-add">Add</a><img  src="'.ADMIN_DIR.'assets/images/loading-bottom.gif" class="ajax-load-block" alt="Working..." />';
    				
    				$output .= '<ul id="'.$value['id'].'-list" rel="'.$int.'" class="media-mcstudios-framework">';
    				
    				
    				if(isset($data[$value['id']])) {
    					$slides = $data[$value['id']];	
    				} else{
    					$slides = '';
    				}
    				

    				
    				
    				$count = count($slides);
    				if ($count < 2) {
    					$oldorder = 1;
    					$order = 1;
    					$output .= Options_Machine::optionsframework_page_layout_function($value['id'],$value['std'],$value['options'],$value['desc'], $oldorder,$order,$int);
    				} else {
    					$i = 0;
    					foreach ($slides as $slide) {
    						$oldorder = $slide['order'];
    						$i++;
    						$order = $i;
    						$output .= Options_Machine::optionsframework_page_layout_function($value['id'],$value['std'],$value['options'],$value['desc'],$oldorder,$order,$int);
    					}
    				}			
    				$output .= '</ul>';
    				$output .= '</div>';
    				
    			break;
    
    
        		case 'pages':
        				$_id = strip_tags( strtolower($value['id']) );
        		    $int = '';
        		    $int = optionsframework_mlu_get_silentpost( $_id );
        		    $output .= '<div class="pages-manager"><ul id="'.$value['id'].'" rel="'.$int.'">';
        		    
        		    if (isset($data[$value['id']])) {
        		    	$data[$value['id']] = $data[$value['id']];
        		    } else {
        		    	$data[$value['id']] = array();
        		    }
        		    
        		    //print_r($data[$value['id']]);
        		    
        		    $slides = $data[$value['id']];
        		    $count = count($slides);
        		    if ($count < 2) {
        						$addButton = 1;
        		        $oldorder = 1;
        		        $order = 1;
        						$show = 1;
        		        $output .= Options_Machine::optionsframework_pages_function($value['id'],$value['std'],$value['options'],$oldorder,$order,$int);
        		    } else {
        						$addButton = 0;
        		        $i = 0;
        		        foreach ($slides as $slide) {
        		            $oldorder = $slide['order'];
        		            $i++;
        								$show = '';
        		            $order = $i;
        		            $output .= Options_Machine::optionsframework_pages_function($value['id'],$value['std'],$value['options'],$oldorder,$order,$int);
        		        }
        		    }			
        		    $output .= '</ul>';
        		    $output .= '<a href="#" class="button pages_add_button">Add New Page</a></div>';
        		break;
    
    
				//backup and restore options data
				case 'backup':
				
					$instructions = $value['desc'];
					$backup = get_option(BACKUPS);
					
					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>'. __('Last Backup : ', 'mclang').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				
				break;
				
				//export or import data between different installs
				case 'transfer':
				
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
					
					
					global $mcstudios_default_options_data;
					if($mcstudios_default_options_data !== ''){
						$mcstudios_default_options_data = $mcstudios_default_options_data;
					} else{
						$mcstudios_default_options_data = '';
					}
					
					$output .= '<textarea id="default_theme_options_data" rows="8" style="display: none;">'. $mcstudios_default_options_data .'</textarea>'."\n";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				
				break;
			
			}
			
			//description of each option
				if ( $value['type'] != 'heading' && $value['type'] != 'subheading' && $value['type'] != "tabsmenu" && $value['type'] != "tabbed" && $value['type'] != "endtabs" ) { 
					if(!isset($value['desc'])){ $explain_value = ''; } else{ 
			            $explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n";
			         } 
			        $output .= '</div>'.$explain_value."\n";
			        $output .= '<div class="clear"> </div></div></div>'."\n";
        		}
		   
		}
		
	    $output .= '</div>';
	    return array($output,$menu,$defaults);
	}


	/**
	 * Ajax image uploader - supports various types of image types
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_uploader_function($id,$std,$mod){
	
	    $data =get_option(OPTIONS);
		
		$uploader = '';
	    $upload = $data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
	    $uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)){
			$uploader .= '<div class="screenshot">';
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';
			$uploader .= '</div>';
			}
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
	
	}

	/**
	 * Native media library uploader
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$int,$mod){
	
	    $data =get_option(OPTIONS);
		
		$uploader = '';
	    $upload = $data[$id];
		$hide = '';
		
		if ($mod == "min") {$hide ='hide';}
		
	    if ( $upload != "") { $val = $upload; } else {$val = $std;}
	    
		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
		
		$uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'" rel="' . $int . '">Upload</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
		$uploader .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="screenshot">';
		if(!empty($upload)){	
	    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
	    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
	    	$uploader .= '</a>';			
			}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n"; 
	
		return $uploader;
		
	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order,$int){
	
	    $data = get_option(OPTIONS);
		
		$slider = '';
		$slide = array();
	    $slide = $data[$id];
		
	    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
		
		//initialize all vars
		$slidevars = array('title','url','link','description');
		
		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}
		
		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}
		
		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	
		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
		
		$slider .= '<div class="slide_body">';
		
		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		
		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		
		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){
			
	    	$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
	    	$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
	    	$slider .= '</a>';
			
			}
		$slider .= '</div>';	
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
		
		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';
	
		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
	    $slider .= '<div class="clear"></div>' . "\n";
	
		$slider .= '</div>';
		$slider .= '</li>';
	
		return $slider;
		
	}
	
	
	
	
	
	
	
	/**
	 * Sidebar Generator
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */	
	
	public static function optionsframework_sidebars_function($id,$std,$oldorder,$order,$int){

    	$data = get_option(OPTIONS);
    
	    $sidebar = '';
    	$slide = array();
   		$slide = $data[$id];
    
    	if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
    
	    //initialize all vars
    	$slidevars = array('title','url','link','description');
    
	    foreach ($slidevars as $slidevar) {
    	    if (!isset($val[$slidevar])) {
        	    $val[$slidevar] = '';
        	}
    	}
    
	    //begin interface	
    	if (!empty($val['title'])) {
        	$sidebar .= '<li class="of-small-block"><div class="sidebar_header"><strong>'.stripslashes($val['title']).'</strong>';
	    } else {
    	    $sidebar .= '<li class="of-small-block"><div class="sidebar_header"><strong>Sidebar '.$order.'</strong>';
	    }
    
    	$sidebar .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	    $sidebar .= '<a class="slide_edit_button" href="#">Edit</a></div>';
    	$sidebar .= '<div class="slide_body sidebar_body">';
	    $sidebar .= '<div class="sidebar_title">';
    	$sidebar .= '<label>Sidebar Title</label><div class="clear"></div>';
    	$sidebar .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';
		$sidebar .= '</div><div class="clear"></div>';
		$sidebar .= '<div class="sidebar_page_select">';
		$sidebar .= '<label>Apply sidebar to:</label>';
		$sidebar .= ' <div class="clear"></div>';
		
		global $mcstudios_list_pages, $mcstudios_list_cpt, $wp_version, $mcstudios_list_templates;

		
		$sidebar .= '<div class="select_wrapper_multiple  checkbox_wrapper_multiple">';
			
			//List pages
			if (!empty($mcstudios_list_pages)) {
				$sidebar .= '<br /><label>Pages:</label><br />';
				foreach ($mcstudios_list_pages as $pagg) {					
					$selected = '';
					if (!empty($val['link'])) {
						if(in_array('pag_'.$pagg->ID, $val['link'])){
							$selected = ' checked';
						}
					}
					$sidebar .= '<label><input class="normal-checkbox" type="checkbox" name="'. $id .'['.$order.'][link][]" value="pag_'.$pagg->ID.'" ' . $selected . '/>'.$pagg->post_title.'</label>';
				}
			}
			
			
			$categories = get_categories('hide_empty=0');
			//List Categories
			if (!empty($categories)) {
				$sidebar .= '<br /><label>Categories:</label><br />';
				foreach ($categories as $category) {					
					$selected = '';
					if (!empty($val['link'])) {
						if(in_array('cat_'.$category->cat_ID, $val['link'])){
							$selected = ' checked';
						}	
					}
					$sidebar .= '<label><input class="normal-checkbox" type="checkbox" name="'. $id .'['.$order.'][link][]" value="cat_'.$category->cat_ID.'" ' . $selected . '/>'.$category->cat_name.'</label>';
				}
			}
			
			
			
			//List Templates
			if (!empty($mcstudios_list_templates)) {
				$sidebar .= '<br /><label>Templates:</label><br />';
				foreach ($mcstudios_list_templates as $key => $template) {					
					$selected = '';
					if (!empty($val['link'])) {
						if(in_array($key, $val['link'])){
							$selected = ' checked';
						}	
					}
					$sidebar .= '<label><input class="normal-checkbox" type="checkbox" name="'. $id .'['.$order.'][link][]" value="template_'.$key.'" ' . $selected . '/>'.$template.'</label>';
				}
			}
		
			//List Custom Post Types
			if($wp_version >= '3.0'){
				$sidebar .= '<br /><label>Post Types:</label><br />';
				$_args = array(
					'show_ui' => true,
					'public' => true,
					'publicly_queryable' => true,
					'_builtin' => false
				);
				$_post_types = get_post_types( $_args, 'object' );
				if ( count( $_post_types ) ) {
					foreach ( $_post_types as $k => $v ) {
						$selected = '';
						if (!empty($val['link'])) {
							if(in_array('cp_'.$v->name, $val['link'])){
								$selected = ' checked';
							}	
						}
						$sidebar .= '<label><input class="normal-checkbox" type="checkbox" name="'. $id .'['.$order.'][link][]" value="cp_' . $v->name . '" ' . $selected . '/>'.$v->labels->name.'</label>';	 
					}

				}
			}
		
		$sidebar .= '</div>';
		$sidebar .= '</div>';
		$sidebar .= ' <div class="clear"></div>';
		
		if ($order !== 1) {
			$sidebar .= '<a class="slide_delete_button" href="#">Delete</a>';	
		}
		
		
	    
    	$sidebar .= '<div class="clear"></div>' . "\n";
	    $sidebar .= '</div>';
    	$sidebar .= '</li>';

		return $sidebar;
	}





	
	
	
	
	
	/**
	 * Pages Generator
	 *
	 * @uses get_option()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */	
	public static function optionsframework_pages_function($id,$std,$options,$oldorder,$order,$int){

    	$data = get_option(OPTIONS);
    
	    $pages = '';
    	$slide = array();
    	
    	if (isset($data[$id])) {
    		$data[$id] = $data[$id];
    	} else {
    		$data[$id] = array();
    	}
    	
	    $slide = $data[$id];
	    
    
		$opt = $options;
		
    	if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
    
	    //initialize all vars
    	$slidevars = array('title','url','link','description');
    
    	foreach ($slidevars as $slidevar) {
        	if (!isset($val[$slidevar])) {
            	$val[$slidevar] = '';
        	}
    	}
    
	    $pages .= '<li id="'. $id.'_'.$order .'-small-block" class="of-small-block"><div class="pages_header"><strong>Page '.$order.'</strong>';
    	$pages .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	    $pages .= '<a class="slide_edit_button" href="#">Edit</a></div>';
    	$pages .= '<div class="slide_body pages_body">';
		$pages .= '<div class="generated-page-options">';
		
		if (!empty($options)) {
			
				foreach ($options as $key => $value) {
						$field_type = $value['type'];
						
						if($field_type == 'text'){
									$pages .= '<div class="clear"></div>';
									$pages .= '<div class="page-number-posts of-pages-block">';
									$pages .= '<h4>'.$value['title'].'</h4>';
									
									$invalue = '';
									if(isset($val[''.$value['id'].''])){
										$invalue = $val[''.$value['id'].''];
									}
																	
									$pages .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.']['.$value['id'].']" id="'. $id .'_'.$order .'_'.$value['id'].'" value="'. stripslashes($invalue) .'" />';

									$pages .= '<div class="of-small-block-description">';
									$pages .= ''.$value['desc'].'';
									$pages .= '</div><!-- end description -->';
									$pages .= '</div>';
						} //end type text
						
						
						if($field_type == 'select'){
									
									if($value['options'] == 'pages'){
									$typePage = 'page-name-selector';
									} else{
										$typePage = '';
									}
										
									$pages .= '<div class="clear"></div>';
									$pages .= '<div class="page-sidebar-position of-pages-block '.$typePage.'">';
									$pages .= '<h4>'.$value['title'].'</h4>';

									$pages .= '<div class="select_wrapper">';
									$pages .= '<select class="of-input select " name="'. $id .'['.$order.']['.$value['id'].']" id="'. $id .'_'.$order .'_'.$value['id'].'">';
									
									if (!empty($value['holder'])) {
										$pages .= '<option value=""/>'.$value['holder'].'</option>';
									}
									if($value['options'] == 'pages'){
									global $mcstudios_list_pages;		
									foreach ($mcstudios_list_pages as $pagg) {
										$selected = '';
										if(!empty($val[$value['id']])){
											if($val[''.$value['id'].''] == "$pagg->ID"){
												$selected = ' selected';
											}
										}
										$pages .= '<option value="'.$pagg->ID.'" '. $selected. ' />'.$pagg->post_title.'</option>';	 
									 }
									} 
										else{
										foreach ($value['options'] as $select_option => $sval) {
											$selected = '';
											if(!empty($val[$value['id']])){
												if($val[''.$value['id'].''] == "$select_option"){
													$selected = ' selected';
												}
											}
											$pages .= '<option  value="'.$select_option.'" '. $selected. '  '.$selected.' />'.$sval.'</option>';
										}
									}	
									$pages .= '</select>';
									$pages .= '</div>';

									$pages .= '<div class="of-small-block-description">';
									$pages .= ''.$value['desc'].'';
									$pages .= '</div><!-- end description -->';

									$pages .= '</div>';			
						} //end type select
						
						
						
						
						if($field_type == 'multiselect'){				
									$pages .= '<div class="clear"></div>';
									$pages .= '<div class="multiple_categories of-pages-block">';
									$pages .= '<h4>'.$value['title'].'</h4>';
									$pages .= '<div class="select_wrapper_multiple">';
									$pages .= '<select class="of-input select-multiple" name="'. $id .'['.$order.']['.$value['id'].'][]" id="'. $id .'_'.$order .'_'.$value['id'].'" multiple>';
															
									$value_stored = '';
									if(!empty($val[''.$value['id'].''])){
										$value_stored = $val[''.$value['id'].''];
									}
														
														
														
									if($value['options'] !== 'categories'){
										$terms = get_terms($value['options']);
										$count = count($terms);
										if ( $count > 0 ){
											foreach ( $terms as $term ) {
												$selected = '';
												if(!empty($val[''.$value['id'].''])){
													if(in_array($term->slug, $value_stored)){
														$selected = ' selected';
													}
												}
												$pages .= '<option  value="'.$term->slug.'" '. $selected. ' />'.$term->name.'</option>';
											}
										}
									} else{
										$categories = get_categories('hide_empty=0');
										foreach ($categories as $category) {
											$selected = '';
											if(!empty($val[''.$value['id'].''])){
												if(in_array($category->cat_ID, $value_stored)){
													$selected = ' selected';
												}
											}
											$pages .= '<option value="'.$category->cat_ID.'" '. $selected. ' />'.$category->cat_name.'</option>';
										}
									}
													
									$pages .= '</select>';
									$pages .= '</div>';
									$pages .= '<div class="of-small-block-description">';
									$pages .= ''.$value['desc'].'';
									$pages .= '</div><!-- end description -->';
									$pages .= '</div>';
						} //end type multiselect
				}
		} //end if
		
		$pages .= '</div><!-- end of generated-page-options -->';
		if($order !== 1){
			$pages .= '<a class="slide_delete_button" href="#">Delete</a>';	
		}
	    $pages .= '<div class="clear"></div>' . "\n";
    	$pages .= '</div>';
	    $pages .= '</li>';

		return $pages;
	}








/* =============================================================================
   Layout Interface
   ========================================================================== */
public static function optionsframework_page_layout_function($id,$std,$options,$desc,$oldorder,$order,$int){

  $data = get_option(OPTIONS);
	
	$slider = '';
	$slide = array();
    $slide = $data[$id];
	
    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
	
	//initialize all vars
	$slidevars = array('title','url','link', 'video', 'height', 'description');
	
	foreach ($slidevars as $slidevar) {
		if (!isset($val[$slidevar])) {
			$val[$slidevar] = '';
		}
	}
	

	
	if($order == 1){	
		$slider .= '<li id="'.$id.'-full-options" style="display: none;"><div class="slide_header"><strong>Block '.$order.'</strong>';

	} else{
		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li class="layout-block" id="layout-block'.$order.'"><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li class="layout-block" id="layout-block'.$order.'"><div class="slide_header"><strong>Block '.$order.'</strong>';
		}
	}

		$slider .= '<input type="hidden" class="slide of-input title" name="'. $id .'['.$order.'][title]" id="'. $id.'_'.$order .'_slide_title" value="'.stripslashes($val['title']).'" />';	
		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';

	
	$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
	$slider .= '<div class="slide_body layout_body">';
		
		
	$slider .= '<div class="generated-content-layout">';
	
	
	foreach ($options['content'] as $key => $value) {
		
		
	if($order == 1)	{									
									$slider .= '<div class="'.display($key).'-block mc-ignore">';
											foreach ($value as $field) {
													if(!isset($field['desc'])){
														$option_description = '';
													} else{
														$option_description = $field['desc'];
													}
													
													
													if(!isset($field['class'])){
														$inclass = '';
													} else{
														$inclass = $field['class'];
													}
													
													
													
													
													
													if($field['type'] == 'images'){
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
															$value = '';
															if(!empty($val['block_options'][''.$field_value.''])){
																$value = $val['block_options'][''.$field_value.''];
															}
														} else{
															$field_value = '';
															$value = '';
														}

														$slider .= '<label class="bigtitlemc">'.$field['title'].'</label>';
														$slider .= '<div id="'. $id .'_'.$order .'_'.$field['id'].'_holder" class="media_slider_manager">';
														
														$int = '';
														if(isset($field['id'])){
															$int = $field['id'];
														}														
														$slider .= '<a data-slidename="'.$field['id'].'" class="add-subslides" href="media-upload.php?type=image&TB_iframe=1&attachments_pro_thickbox=1&width=640&height=1500" title="">Add Slide</a>';
														
														$slider .= '<ul id="'. $id .'_'.$order .'_'.$field['id'].'_media_list" class="mcstudios_media_list media-slide-placeholder">';


														if(isset($val['block_options'][''.$field['id'].''])){
															$media_slides = $val['block_options'][''.$field['id'].''];
														} else{
															$media_slides = '';
														}


														$extra_fields = '';
														if(!empty($field['opts'])){
															$extra_fields = $field['opts'];
														}
														
														
														$slideID = $id .'['.$order.'][block_options]['.$field['id'].']';
														$parentOrder = $order;
														$slidername = $field['id'];
														//$slider .= $slideID;
														
														
														//id = homepage_layout

														$slide_options = $field['fields'];	
														$count = count($media_slides);
														
														$mcoldorder = 1;
														$mcorder = 1;
														
														
														$slider .= Options_Machine::optionsframework_media_slider_function($id ,$slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
														

														$slider .= '</ul>';

														$slider .= ' <div class="clear"></div>';
														

															
														$slider .= '<div class="mctemp-library" data-slidename="'.$field['id'].'" data-target="'. $id .'['.$order .'][block_options]['.$field['id'].']" rel="'. $id .'_'.$order .'_'.$field['id'].'_media_list">';
														$slider .= '<div class="page_navigation"></div>';
														$slider .= '</div> <!-- end of mctemp-library -->';

														$slider .= '</div> <!-- end of media_slider_manager -->';
													}
													
													//end image
													
													
													
													
													
													
													if($field['type'] == 'slide'){
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
															$value = '';
															if(!empty($val['block_options'][''.$field_value.''])){
																$value = $val['block_options'][''.$field_value.''];
															}
														} else{
															$field_value = '';
															$value = '';
														}

														$slider .= '<label class="bigtitlemc">'.$field['title'].'</label>';
														
														
														$int = '';
														if(isset($field['id'])){
															$int = $field['id'];
														}			
														
														
														
														$slide_options = $field['fields'];
														
														if(isset($val['block_options'][''.$field['id'].''])){
															$media_slides = $val['block_options'][''.$field['id'].''];
														} else{
															$media_slides = '';
														}
														$extra_fields = '';
														if(!empty($field['opts'])){
															$extra_fields = $field['opts'];
														}
														
														$count = count($media_slides);
														if ($count < 2) {
															$background = 'media-slide-placeholder';
														} else {
															$background = 'media-slide-placeholder';
														}
														
														
														
														
														$slider .= '<div class="content-slider">';
														
														$slider .= '<ul id="'. $id .'_'.$order .'_'.$field['id'].'-slides" >';
														
														//id = homepage_layout
														$parentOrder = $order;
														$slidername = $field['id'];
														
														
														$slideID = $id .'['.$order.'][block_options]['.$field['id'].']';
														
														
														

														$count = count($media_slides);
														if ($count < 2) {
															$mcoldorder = 1;
															$mcorder = 1;
															//$slider .= $slideID;
															
															
															
															
															
															$slider .= Options_Machine::optionsframework_columns_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
														} else {
															$i = 0;
															foreach ($media_slides as $slide) {
																$mcoldorder = $slide['order'];
																$i++;
																$mcorder = $i;
																
																$slider .= Options_Machine::optionsframework_columns_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
															}
														}			
														$slider .= '</ul>';
														$slider .= '<a href="#" class="button content_slide_add_button">Add New Block</a></div>';
														
													}													
													
													
													if($field['type'] == 'text'){
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
															$value = '';
															if(!empty($val['block_options'][''.$field_value.''])){
																$value = $val['block_options'][''.$field_value.''];
															}
														} else{
															$field_value = '';
															$value = '';
														}


														$slider .= '<div class="opt-block '.$inclass.'">';
														$slider .= '<div class="opt-block-input">';
														$slider .= '<label>'.$field['title'].'</label>';
														$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'" value="'. stripslashes($value) .'" />';
														$slider .= '</div>';
														$slider .= '<p>'.$option_description.'</p>';
														$slider .= '</div>';
													}




													if($field['type'] == 'textarea'){										
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
															if(!empty($val['block_options'][''.$field_value.''])){
																$value = $val['block_options'][''.$field_value.''];
															} else{
																$value = '';
															}
														} else{
															$field_value = '';
															$value = '';
														}



														$slider .= '<div class="opt-block '.$inclass.'">';
														$slider .= '<div class="opt-block-input">';
														$slider .= '<label>'.$field['title'].'</label>';
														$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'">';
														$slider .= stripslashes($value);
														$slider .= '</textarea>';

														$slider .= '</div>';
														$slider .= '<p>'.$option_description.'</p>';
														$slider .= '</div>';
													}
													
													
													if($field['type'] == 'select'){
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
														} else{
															$field_value = '';
														}
														$slider .= '<div class="opt-block '.$inclass.'">';
														$slider .= '<div class="opt-block-input">';

														$slider .= '<label>'.$field['title'].'</label>';
														$slider .= '<div class="select_wrapper">';
														$slider .= '<select class="of-input select" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'">';
																$current = $field['id'];
																foreach ($field['opts'] as $soption => $vival) {
																	$selected = '';
																	if(!empty($val['block_options'][''.$field['id'].''])){
																		if($soption == $val['block_options'][''.$field['id'].'']){
																			$selected = ' selected';
																		}
																	}

																	$slider .= '<option value="'.$soption.'"  '.$selected.'/>'.$vival.'</option>';
																}
														$slider .= '</select>';
														$slider .= '</div><!-- end of select_wrapper -->';
														$slider .= '</div>';
														$slider .= '<p>'.$option_description.'</p>';
														$slider .= '</div>';
													}
													
													
													if($field['type'] == 'multiselect'){
														$slider .= '<div class="opt-block '.$inclass.'">';


														$slider .= '<div class="multiple_categories opt-block-input">';
														$slider .= '<label>'.$field['title'].'</label>';
														$slider .= '<div class="select_wrapper_multiple '.display($key).'">';
													  $slider .= '<select class="of-input select-multiple" name="'. $id .'['.$order.'][block_options]['.$field['id'].'][]" id="'. $id .'_'.$order .'_'.$field['id'].'" multiple>';
														$categories = get_categories('hide_empty=0');
														$value_stored = '';

														if(!empty($val['block_options'][$field['id']])){
														$value_stored = $val['block_options'][$field['id']];
													  }

														if(!empty($field['options'])){
																if($field['options'] == 'categories'){
																			foreach ($categories as $category) {
																					$selected = '';
																					$mcfield = $field['id'];
																					if(!empty($val['block_options'][$mcfield])){
																						if(in_array($category->cat_ID, $value_stored)){
																							$selected = ' selected';
																						}
																					}
																					$slider .= '<option value="'.$category->cat_ID.'" '. $selected. ' />'.$category->cat_name.'</option>';
																		   }
																} else{

																				global $wpdb;
																				global $post;
																				$terms = get_terms($field['options']);
																				$start = count($terms);
																				if ( $start > 0 ){
																				     foreach ( $terms as $term ) {
																								$slider .= '<option value="'.$term->slug.'" '.$selected.'/>'.$term->name.'</option>';
																				     }
																				 }
																}
														}
													  $slider .= '</select>';
														$slider .= '</div>';
														$slider .= '</div>';
														$slider .= '<p>'.$option_description.'</p>';
														$slider .= '</div>';
													}
												
											}//end foreach
									
									$slider .= '</div>';
							
		
	} else {
						
						if($key == $val['title']){
									$slider .= '<div class="'.display($key).'-block">';
											foreach ($value as $field) {
														if(!isset($field['desc'])){
															$option_description = '';
														} else{
															$option_description = $field['desc'];
														}
														
														
														if(!isset($field['class'])){
															$inclass = '';
														} else{
															$inclass = $field['class'];
														}
														
														if($field['type'] == 'text'){
															$field_value = display($field['id']);
															if(!empty($val['block_options'][''.$field['id'].''])){
																$field_value = $field['id'];
																$value = '';
																if(!empty($val['block_options'][''.$field['id'].''])){
																	$value = $val['block_options'][''.$field['id'].''];
																}
															} else{
																$field_value = '';
																$value = '';
															}
															
															
															
															$slider .= '<div class="opt-block '.$inclass.'">';
															$slider .= '<div class="opt-block-input">';
															$slider .= '<label>'.$field['title'].'</label>';
															
															//print_r($val['block_options']);
															
															//echo $val['block_options'][''.$field['id'].''];
															
															
															
															$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'" value="'. stripslashes($value) .'" />';
															$slider .= '</div>';
															$slider .= '<p>'.$option_description.'</p>';
															$slider .= '</div>';
														}


														if($field['type'] == 'textarea'){										
															$field_value = display($field['id']);
															if(!empty($val['block_options'][''.$field['id'].''])){
																$field_value = $field['id'];
																$value = '';
																if(!empty($val['block_options'][''.$field['id'].''])){
																	$value = $val['block_options'][''.$field['id'].''];
																}
															} else{
																$field_value = '';
																$value = '';
															}
															
															

															$slider .= '<div class="opt-block '.$inclass.'">';
															$slider .= '<div class="opt-block-input">';
															$slider .= '<label>'.$field['title'].'</label>';
															$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'">';
															$slider .= stripslashes($value);
															$slider .= '</textarea>';
															
															$slider .= '</div>';
															$slider .= '<p>'.$option_description.'</p>';
															$slider .= '</div>';
														}



														if($field['type'] == 'select'){
															$field_value = display($field['id']);
															if(!empty($field_value['id'])){
																$field_value = $field['id'];
															} else{
																$field_value = '';
															}
															
															$slider .= '<div class="opt-block '.$inclass.'">';
															$slider .= '<div class="opt-block-input">';

															$slider .= '<label>'.$field['title'].'</label>';
															$slider .= '<div class="select_wrapper">';
															$slider .= '<select class="of-input select" name="'. $id .'['.$order.'][block_options]['.$field['id'].']" id="'. $id .'_'.$order .'_'.$field['id'].'">';
																	$current = $field['id'];
																	foreach ($field['opts'] as $soption => $vival) {
																		$selected = '';
																		if(!empty($val['block_options'][''.$field['id'].''])){
																			if($soption == $val['block_options'][''.$field['id'].'']){
																				$selected = ' selected';
																			}
																		}

																		$slider .= '<option value="'.$soption.'"  '.$selected.'/>'.$vival.'</option>';
																	}
															$slider .= '</select>';
															$slider .= '</div><!-- end of select_wrapper -->';
															$slider .= '</div>';
															$slider .= '<p>'.$option_description.'</p>';
															$slider .= '</div>';
														}
														
														
														
														
														
														
														
														if($field['type'] == 'images'){
															$field_value = display($field['id']);
															if(!empty($field_value['id'])){
																$field_value = $field['id'];
																$value = '';
																if(!empty($val['block_options'][''.$field_value.''])){
																	$value = $val['block_options'][''.$field_value.''];
																}
															} else{
																$field_value = '';
																$value = '';
															}
	
															$slider .= '<label class="bigtitlemc">'.$field['title'].'</label>';
															
															
															$int = '';
															if(isset($field['id'])){
																$int = $field['id'];
															}			
															
															
															
															$slide_options = $field['fields'];
															
															if(isset($val['block_options'][''.$field['id'].''])){
																$media_slides = $val['block_options'][''.$field['id'].''];
															} else{
																$media_slides = '';
															}
															$extra_fields = '';
															if(!empty($field['opts'])){
																$extra_fields = $field['opts'];
															}
															
															
															//print_r($media_slides);
															
															
															$count = count($media_slides);
															if ($count < 2) {
																$background = 'media-slide-placeholder';
															} else {
																$background = 'media-slide-placeholder';
															}
															
															$slider .= '<div id="'. $id .'_'.$order .'_'.$field['id'].'_holder" class="media_slider_manager">';
																										
															$slider .= '<a data-slidename="'.$field['id'].'"  class="add-subslides" href="media-upload.php?type=image&TB_iframe=1&attachments_pro_thickbox=1&width=640&height=1500" title="">Add Slide</a>';
															
															$slider .= '<ul id="'. $id .'_'.$order .'_'.$field['id'].'_media_list" class="mcstudios_media_list '.$background.'">';
	
	
			
															//id = homepage_layout
															$parentOrder = $order;
															$slidername = $field['id'];
															
															
															$slideID = $id .'['.$order.'][block_options]['.$field['id'].']';
	
															$count = count($media_slides);
															if ($count < 2) {
																$mcoldorder = 1;
																$mcorder = 1;
																//$slider .= $slideID;
																
																$slider .= Options_Machine::optionsframework_media_slider_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
															} else {
																$i = 0;
																foreach ($media_slides as $slide) {
																	$mcoldorder = $slide['order'];
																	$i++;
																	$mcorder = $i;
																	
																	$slider .= Options_Machine::optionsframework_media_slider_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
																}
															}
	
															$slider .= '</ul>';
	
															$slider .= ' <div class="clear"></div>';
	
															
		
															$slider .= '</div> <!-- end of media_slider_manager -->';
															$slider .= '<div id="'. $id .'_'.$order .'_'.$field['id'].'_media_library" class="mctemp-library" data-slidename="'.$field['id'].'" data-target="'. $id .'['.$order .'][block_options]['.$field['id'].']" rel="'. $id .'_'.$order .'_'.$field['id'].'_media_list"><div class="page_navigation"></div>';
															$slider .= '</div> <!-- end of mctemp-library -->';
														}
														
														//end image														
														
														

														
													if($field['type'] == 'slide'){
														$field_value = display($field['id']);
														if(!empty($field_value['id'])){
															$field_value = $field['id'];
															$value = '';
															if(!empty($val['block_options'][''.$field_value.''])){
																$value = $val['block_options'][''.$field_value.''];
															}
														} else{
															$field_value = '';
															$value = '';
														}

														$slider .= '<label class="bigtitlemc">'.$field['title'].'</label>';
														
														
														$int = '';
														if(isset($field['id'])){
															$int = $field['id'];
														}			
														
														
														
														$slide_options = $field['fields'];
														
														if(isset($val['block_options'][''.$field['id'].''])){
															$media_slides = $val['block_options'][''.$field['id'].''];
														} else{
															$media_slides = '';
														}
														$extra_fields = '';
														if(!empty($field['opts'])){
															$extra_fields = $field['opts'];
														}
														
														$count = count($media_slides);
														if ($count < 2) {
															$background = 'media-slide-placeholder';
														} else {
															$background = 'media-slide-placeholder';
														}
														
														
														
														
														$slider .= '<div class="content-slider"><ul id="'. $id .'_'.$order .'_'.$field['id'].'-slides" >';
														
														//id = homepage_layout
														$parentOrder = $order;
														$slidername = $field['id'];
														
														
														$slideID = $id .'['.$order.'][block_options]['.$field['id'].']';
														
														

														$count = count($media_slides);
														if ($count < 2) {
															$mcoldorder = 1;
															$mcorder = 1;
															//$slider .= $slideID;
															
															$slider .= Options_Machine::optionsframework_columns_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
														} else {
															$i = 0;
															foreach ($media_slides as $slide) {
															
															
															
																$mcoldorder = $slide['order'];
																$i++;
																$mcorder = $i;
																
																$slider .= Options_Machine::optionsframework_columns_function($id, $slideID,$slidername,$parentOrder,$mcoldorder,$mcorder,$int,$slide_options);
															}
														}			
														$slider .= '</ul>';
														$slider .= '<a href="#" class="button content_slide_add_button">Add New Block</a></div>';
														
													}	



														if($field['type'] == 'multiselect'){
															$slider .= '<div class="opt-block '.$inclass.'">';


															$slider .= '<div class="multiple_categories opt-block-input">';
															$slider .= '<label>'.$field['title'].'</label>';
															$slider .= '<div class="select_wrapper_multiple '.display($key).'">';
														  $slider .= '<select class="of-input select-multiple" name="'. $id .'['.$order.'][block_options]['.$field['id'].'][]" id="'. $id .'_'.$order .'_'.$field['id'].'" multiple>';
															$categories = get_categories('hide_empty=0');
															$value_stored = '';

															if(!empty($val['block_options'][$field['id']])){
															$value_stored = $val['block_options'][$field['id']];
														  }

															if(!empty($field['options'])){
																	if($field['options'] == 'categories'){
																				foreach ($categories as $category) {
																						$selected = '';
																						$mcfield = $field['id'];
																						if(!empty($val['block_options'][$mcfield])){
																							if(in_array($category->cat_ID, $value_stored)){
																								$selected = ' selected';
																							}
																						}
																						$slider .= '<option  value="'.$category->cat_ID.'" '. $selected. ' />'.$category->cat_name.'</option>';
																			   }
																	} else{

																					global $wpdb;
																					global $post;
																					$terms = get_terms($field['options']);
																					$start = count($terms);
																					if ( $start > 0 ){
																					     foreach ( $terms as $term ) {
																									$selected = '';
																									$mcfield = $field['id'];
																									if(!empty($val['block_options'][$mcfield])){
																										if(in_array($term->slug, $value_stored)){
																											$selected = ' selected';
																										}
																									}
																									$slider .= '<option value="'.$term->slug.'" '.$selected.'/>'.$term->name.'</option>';
																					     }
																					 }
																	}
															}
														  $slider .= '</select>';
															$slider .= '</div>';
															$slider .= '</div>';
															$slider .= '<p>'.$option_description.'</p>';
															$slider .= '</div>';
														}
														
												
											}//end foreach
							
									$slider .= '</div>';
						}//end key = val[title]
						
						
	}
	
	
	}//end foreach
	
	
	$slider .= '<div><!-- end of generated-content-layout -->';
	

	$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
    $slider .= '<div class="clear"></div>' . "\n";

	$slider .= '</div>';
	$slider .= '</li>';
return $slider;
}











public static function optionsframework_media_slider_function($id,$inputname,$slidername,$parentOrder,$oldorder,$order,$int,$slide_options){

    $data = get_option(OPTIONS);
	
	$slider = '';
	$slide = array();
	
	
	if (!empty($data[$id])) {
		 $slide = $data[$id][$parentOrder]['block_options'][$slidername];
	}
	
	
   
    //$slide = $data[$id][''.$parentOrder.'']['block_options'][$slidername];

    //print_r($slide_options);
    //print_r($slide);
    
    //$slider .= $id[2]['block_options']['sudo_images'][1]['title'];
    
	
    if (isset($slide[$oldorder])) { 
    	$val = $slide[$oldorder]; 
    } else {
    	$val = '';
    	//$val = $std;
    }
    
    
    if (!empty($data[$id])) {
    	$val = $slide = $data[$id][$parentOrder]['block_options'][$slidername][$order];
    } else {
    	$val = '';
    }
	
	//initialize all vars
	$media_options_array = array('title', 'url', 'thumb');
	if (!empty($slide_options)) {
		foreach ($slide_options as $slidevar) {
			$media_options_array[] = $slidevar['id'];
		}		
	}
	foreach ($media_options_array as $media_option) {
		if (!isset($val[$media_option])) {
			$val[$media_option] = '';
		}
	}
	
	
	
	
	
	
	
	//print_r($slide_options);
	
	
	
	$input_id = $id.'_'.$parentOrder.'_'.$slidername.'_'.$order;
	
	
	//begin slider interface	
	
	
	if ($order == 1) {
		$first_slide = 'first_media_slide';
		$image_holder = 'http://development.local/wp/mirage/wp-content/themes/mirage/images/portfolio/p31.jpg';
	} else {
		$first_slide = '';
		$image_holder = stripslashes($val['thumb']);
	}
	
	
	
	$slider .= '<li class="subslide '.$first_slide.'">';
	$slider .= '<div class="block panel">';
	
		//Front image
		$slider .= '<div class="front-image">';
		$slider .= '<img src="'. $image_holder .'" alt="Thumbnail"  width="147"/>';
			$slider .= '<div class="rwmb-image-bar">';
				$slider .= '<a title="Edit" class="rwmb-edit-file" href="#" rel="'.$input_id.'-'.$order.'">Edit</a> |';
				$slider .= '<a class="attachments-pro-item-delete">Delete</a>';
			$slider .= '</div>';
		$slider .= '</div>';
	
		$slider .= '';
					 	
	//back-info				 	
	$slider .= '<div class="back-info">';
	$slider .= '<a class="done-editing" href="#">Done</a>';
	$slider .= '<input type="hidden" class="slide of-input suborder" name="'. $inputname .'['.$order.'][order]" id="'. $input_id .'_slide_order" value="'.$order.'" />';
	$slider .= ' <label>Title</label>';
	$slider .= '<input class="slide of-input of-slider-title" name="'. $inputname .'['.$order.'][title]" id="'. $input_id .'_slide_title" value="'. stripslashes($val['title']) .'" placeholder=""/>';
	$slider .= '<input class="slide of-input of-slider-url hidden" name="'. $inputname .'['.$order.'][url]" id="'. $input_id .'_slide_url" value="'. stripslashes($val['url']) .'" placeholder="Image URL"/>';
	$slider .= '<input class="slide of-input of-slider-thumb hidden" name="'. $inputname .'['.$order.'][thumb]" id="'. $input_id .'_slide_thumb" value="'. stripslashes($val['thumb']) .'" placeholder="Image Thumb"/>';
	
	$slider .= '<div class="subslide-generated-inputs">';
	
	
	//print_r($slide_options);
	
	
	foreach ($slide_options as $key => $value) {
		//$slider .=  $inputname;
		$inputType = $value['type'];
		$inputType_ID = $value['id'];
		$inputType_title = $value['title'];
		
		
		if ($inputType == 'upload') {
			$slider .= '<input class="slide of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" placeholder="'.$inputType_title.'" />';
			
			$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
			
			if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
			$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
			$slider .='</div>' . "\n";
			$slider .= '<div class="screenshot">';
			if(!empty($val['url'])){
				
				$slider .= '<a class="of-uploaded-image" href="'. $val[$inputType_ID] . '">';
				$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val[$inputType_ID].'" alt="" />';
				$slider .= '</a>';
				
				}
			$slider .= '</div>';
		}//end upload
		
		elseif ($inputType == 'text') {
			$slider .= '<label>'.$inputType_title.'</label>';
			$slider .= '<input class="slide of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" />';
		}// end text
		
		
		
		elseif ($inputType == 'select') {
			$slider .= ' <label>'.$inputType_title.'</label> ';
			$slider .= '<div class="select_wrapper">';
				$slider .= '<select class="select of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'">';
				$select_options = $value['options'];	 
				if (!empty($select_options)) {
					foreach ($select_options as $key => $value) {
						$selected = '';
						if ($key ==  $val[$inputType_ID]) {
							$selected = 'selected';
						}
						$slider .= '<option value="' . $key . '" '.$selected.'/>'.$value.'</option>';		
					}
				}
				$slider .= '</select>';//end select wrapper
			$slider .= '</div>';//end select wrapper
			
			
			
			/*$slider .= '<input class="slide of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" placeholder="'.$inputType_title.'"/>';*/		
		}// end text
		
		
		
		elseif ($inputType == 'textarea') {
			$slider .= ' <label>'.$inputType_title.'</label> ';
			$slider .= '<textarea class="slide of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" placeholder="" rows="8">'.stripslashes($val[$inputType_ID]).'</textarea>';
		} //end textarea
		
		else {
			
		}
		
	}
	$slider .= '</div>';//end subslide-generated-inputs
	$slider .= '</div>';
					 	
	$slider .= '</div>';
	$slider .= '</li>';
	
	
	
	
	
	return $slider;
	
}












public static function optionsframework_columns_function($id,$inputname,$slidername,$parentOrder,$oldorder,$order,$int,$slide_options){

    $data = get_option(OPTIONS);
	
	$slider = '';
	$slide = array();
	
	
	
	if (!empty($data[$id])) {
		$slide = $data[$id][$parentOrder]['block_options'][$slidername];
	} else {
		$slide = '';
	}
	
	
	/*if (is_array($id)) {
		$slide = $data[$id][$parentOrder]['block_options'][$slidername];	
	} else {
		
		$id = array();
		
		//causa error por que se esta pasando una array en vez de string o al revez
		$slide = $data[$id][$parentOrder]['block_options'][$slidername];
	}*/
	
    
    //print_r($slide_options);
    //print_r($slide);
    
    //$slider .= $id[2]['block_options']['sudo_images'][1]['title'];
    
	
    if (isset($slide[$order])) { 
    	$val = $slide[$order]; 
    } else {
    	//$val = $std;
    	$val = '';
    }
	
	//initialize all vars
	$slidevars = array('title','url','link','description');
	
	foreach ($slidevars as $slidevar) {
		if (!isset($val[$slidevar])) {
			$val[$slidevar] = '';
		}
	}
	
	
	
	
	
	$block_options = array();
	
	if (!empty($slide_options)) {
		foreach ($slide_options as $slidevar) {
			$block_options[] = $slidevar['id'];
		}		
	}
	foreach ($block_options as $option) {
		if (!isset($val[$option])) {
			$val[$option] = '';
		}
	}
	
	


	
	
	
	$input_id = $id.'_'.$parentOrder.'_'.$slidername.'_'.$order;
	
	
	//begin slider interface	
	
	
	

	
	if (!empty($val['title'])) {
		$slider .= '<li class="subslide"><div class="subslide_header"><strong>'.stripslashes($val['title']).'</strong>';
	} else {
		$slider .= '<li class="subslide"><div class="subslide_header"><strong>Block '.$order.'</strong>';
	}
	$slider .= '<input type="hidden" class="slide of-input suborder" name="'. $inputname .'['.$order.'][order]" id="'. $input_id .'_slide_order" value="'.$order.'" data-order="'.$order.'"/>';
	$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
	$slider .= '<div class="slide_body">';
	
	foreach ($slide_options as $value) {
		//$slider .=  $inputname;
		$inputType = $value['type'];
		$inputType_ID = $value['id'];
		$inputType_title = $value['title'];
		
		if (isset($value['class'])) {
			$class = $value['class'];
		} else {
			$class = '';
		}
		
		
		
		if ($inputType == 'upload') {
			$slider .= '<label>'.$inputType_title.'</label>';
			$slider .= '<input class="of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" />';
			
			$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
			
			if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
			$slider .= '<span class="button mlu_remove_button '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
			$slider .='</div>' . "\n";
			$slider .= '<div class="screenshot">';
			if(!empty($val['url'])){
				
				$slider .= '<a class="of-uploaded-image" href="'. $val[$inputType_ID] . '">';
				$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val[$inputType_ID].'" alt="" />';
				$slider .= '</a>';
				
				}
			$slider .= '</div>';
		}//end upload
		
		
		elseif ($inputType == 'select') {
			$slider .= '<label>'.$inputType_title.'</label>';
			$slider .= '<div class="select_wrapper">';
				$slider .= '<select class="select of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'">';
				$select_options = $value['options'];
				if (!empty($select_options)) {
					foreach ($select_options as $key => $value) {
						$selected = '';
						if ($key ==  $val[$inputType_ID]) {
							$selected = 'selected';
						}
					
						$slider .= '<option value="' . $key . '" '.$selected.'/>'.$value.'</option>';		
					}
				}
				$slider .= '</select>';//end select wrapper
			$slider .= '</div>';//end select wrapper
			
			
			
			/*$slider .= '<input class="slide of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" placeholder="'.$inputType_title.'"/>';*/		
		}// end text
		
		elseif ($inputType == 'text') {
			$slider .= '<label>'.$inputType_title.'</label>';
			$slider .= '<input class="'.$class.' of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" value="'. $val[$inputType_ID] .'" />';		
		}// end text
		
		elseif ($inputType == 'textarea') {
			$slider .= '<label>'.$inputType_title.'</label>';
			$slider .= '<textarea class="'.$class.' of-input" name="'. $inputname .'['.$order.']['.$inputType_ID.']" id="'. $input_id .'_slide_'.$inputType_ID.'" cols="8" rows="8">'.stripslashes($val[$inputType_ID]).'</textarea>';
		} //end textarea
		
		else {
			
		}
		
	}
	
	
	
	
	
		
	
	
	

	$slider .= '<a class="subslide_delete_button" href="#">Delete</a>';
    $slider .= '<div class="clear"></div>' . "\n";

	$slider .= '</div>';
	$slider .= '</li>';

	return $slider;
	
}


}//end Options Machine class
?>