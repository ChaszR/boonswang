<?php


function parse_shortcode_content( $content ) { 
    /* Parse nested shortcodes and add formatting. */ 
    $content = trim( wpautop( do_shortcode( $content ) ) ); 
    /* Remove '</p>' from the start of the string. */ 
    if ( substr( $content, 0, 4 ) == '</p>' ) 
        $content = substr( $content, 4 ); 
    /* Remove '<p>' from the end of the string. */ 
    if ( substr( $content, -3, 3 ) == '<p>' ) 
        $content = substr( $content, 0, -3 ); 
    /* Remove any instances of '<p></p>'. */ 
    $content = str_replace( array( '<p></p>' ), '', $content );  
    return $content; 
} 



/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_buttons_shortcode')) {
	function mc_buttons_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"url" => '',
			"style" => '',
			"class" => '',
			"target" => ''
		), $atts));
	
		return '<a class="nbtn '.$style.' '.$class.'" href="'.$url.'"  target="'.$target.'"><span>' . do_shortcode( $content ) . '</span></a>';	
	}
	add_shortcode("button", "mc_buttons_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Social Icons
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_social_icons_shortcode')) {
	function mc_social_icons_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"icon" => '',
			"url" => ''
		), $atts));	
		$content = parse_shortcode_content( $content );
		return '<a class="social_icn-'.$icon.'" href="'.$url.'" target="_blank">Follow us</a>';	
	}
	add_shortcode("social", "mc_social_icons_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Headings
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_heading_shortcode')) {
	function mc_heading_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'title' => '',
				'subtitle' => ''
				), $atts ) );
				$content = parse_shortcode_content( $content );
		return '<br /><div class="title"><h3><em>'.$title.'</em></h3><div class="stripe"></div></div><div class="clear"></div><br />';
	}
	add_shortcode("heading", "mc_heading_shortcode");
}

if (!function_exists('mc_heading_line_shortcode')) {
	function mc_heading_line_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"title" => ''
		), $atts));	
		return '<div class="title"><h3>'.$title.'</h3><div class="double-line"></div></div>';	
	}
	add_shortcode("heading_line", "mc_heading_line_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Separators
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_separator_shortcode')) {
	function mc_separator_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'style' => '',
			'margintop' => '',
			'marginbottom' => ''
 		), $atts ) );
 		
 		if ($style == 'single') {
 			$style= 'line';
 		} else {
 			$style = 'double-line';
 		}
 		
	
		$output  = '<div class="clear"></div><div class="'.$style.'" style="margin-top: '.$margintop.'px; margin-bottom: '.$marginbottom.'px;"></div>';
		return $output;
	}
	add_shortcode('separator', 'mc_separator_shortcode');
}

/*-----------------------------------------------------------------------------------*/
/*	Clear
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_clear_shortcode')) {
	function mc_clear_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'margin_top' => '',
			'margin_bottom' => ''
			), $atts ) );
		$return = '<div class="clear" style="margin: '.$margin_top.'px 0 '.$margin_bottom.'px 0; width:100%; height: 10px;"></div>';	
		return $return;
	}
	add_shortcode("clear", "mc_clear_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Videos
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_video_shortcode')) {
	function mc_video_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"url" => ''
		), $atts));	
			
			$content = parse_shortcode_content( $content );
			
			$width = '';
			$height = '';
			$cover = '';
		
		
			$return = '<div class="su-media">';
			$return .= ( $url ) ? mc_get_media( $url, $width, $height, $cover ) : __( 'Please specify media url', 'mclang' );
			$return .= '</div>';
		return $return;		
	}
	add_shortcode("video", "mc_video_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Lightbox
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_lightbox_shortcode')) {
	function mc_lightbox_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"start" => '',
			"end" => '',
			"width" => '',
			"height" => '',
			"title" => ''
		), $atts));
			$output = '<a class="lightbox" href="'.$end.'" title="'.$title.'">';
			$url = parse_url($start);
			if ($url["scheme"]=="http" && $url["scheme"] !=="") {
				$output .= '<img src="'.$start.'" alt=""/>';
			} else{
			 	$output .= $start;
			}
			$output .= '</a>';
		return $output;
	}
	add_shortcode("lightbox", "mc_lightbox_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Quotes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_quote_shortcode')) {
	function mc_quote_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"author" => '',
			"style" => '',
			"color" => ''
		), $atts));	
	
		if ($style == 'styled') {
			$style = 'quote';
		} else {
			$style = 'quote-simple';
		}
	
		$output = '<div class="'.$style.'">';
		$output .= '<p>' . do_shortcode( $content ) . '</p>';
		$output .= '<p class="author">'.$author.'</p>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode("quote", "mc_quote_shortcode");
}


/*-----------------------------------------------------------------------------------*/
/*	Testimonials
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_testimonial_shortcode')) {
	function mc_testimonial_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"name" => '',
			"position" => ''
		), $atts));			
		
		$output = '<div class="testimonial row-fluid">';
		$output .= '<div class="span2 quotes">&#8220;</div>';
		$output .= '<div class="span9">';
		$output .= '<p class="georgia"><em>' . do_shortcode( $content ) . '</em></p>';
		$output .= '<h5 class="pull-right">'.$name.'</h5>';
		$output .= '<span class="georgia pull-right">'.$position.'</span>';
		$output .= '</div>';
		$output .= '</div><!-- end testimonial -->';
				  						
		return $output;
	}
	add_shortcode("testimonial", "mc_testimonial_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_lists_shortcode')) {
	function mc_lists_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"style" => '',
			"double" => ''
		), $atts));	
	
		if ($style == 'error') {
			$style = 'close';
		}
		
		if ($double == 'true') {
			$double = 'double-list';
		}
		
	
		$output = '<div class="'.$style.'-list '.$double.'">';		
		$output .= '' . do_shortcode( $content ) . '';
		$output .= '</div>';
		return $output;
	}
	add_shortcode("list", "mc_lists_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Tooltips
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_tooltips_shortcode')) {
	function mc_tooltips_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"position" => '',
			"tooltip" => '',
			"text" => ''
		), $atts));	
	
		$output = '<a class="jtip" href="#" rel="tooltip" data-placement="'.$position.'" data-original-title="'.$tooltip.'">'.$text.'</a>';		
		return $output;
	}
	add_shortcode("tip", "mc_tooltips_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Popovers
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_popover_shortcode')) {
	function mc_popover_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"btn" => '',
			"color" => '',
			"content" => '',
			"title" => '',
			"text" => ''
		), $atts));	
	
		if ($btn == 'yes') {
			$btn = 'btn';	
			$color = $color;
		} else {
			$btn = '';
			$color = '';
		}
	
		$output = '<a href="#" class="'.$btn.' '.$color.' ppover" rel="popover" data-content="'.$content.'" data-original-title="'.$title.'">'.$text.'</a>';		
		return $output;
	}
	add_shortcode("popover", "mc_popover_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_alert_shortcode')) {
	function mc_alert_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"close" => '',
			"type" => ''
		), $atts));	
	
		if ($type == "error") {
			$type = "alert-error";
		} elseif($type == 'success') {
			$type = "alert-success";
		} elseif ($type == 'info') {
			$type = "alert-info";
		}
		if ($close == 'true') {
			$close = '<button type="button" class="close" data-dismiss="alert">×</button>';
		} else {
			$close = '';
		}
		$output = '<div class="alert alert-block '.$type.' fade in">'.$close.' '.do_shortcode( $content ).'</div>';		
		return $output;
	}
	add_shortcode("alert", "mc_alert_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Info Boxes
/*-----------------------------------------------------------------------------------*/
/*if (!function_exists('mc_info_box_shortcode')) {
	function mc_info_box_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"type" => '',
			"close" => ''
		), $atts));
		
		$output = '<div class="alert alert-block">';
			if ($close == 'true') {
				$output .= '<button type="button" class="close" data-dismiss="alert">×</button>';
			}
		
			$output .= do_shortcode( $content );
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode("box", "mc_info_box_shortcode");
}*/

/*-----------------------------------------------------------------------------------*/
/*	Dropcaps
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_dropcap_shortcode')) {
	function mc_dropcap_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"letter" => '',
			"color" => ''
		), $atts));
		$output = '<span class="dropcap left" style="color: '.$color.';">'.$letter.'</span>';
		$output .= '' . do_shortcode( $content ) . '<p></p>';
		return $output;
	}
	add_shortcode("dropcap", "mc_dropcap_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_team_member_shortcode')) {
	function mc_team_member_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'photo' => '',
			'name' => '',
			'position' => '',
			'face' => '',
			'twitter' => '',
			'dribble' => '',
			'skype' => '',
			'vimeo' => ''
		), $atts ) );
		
		
		
		$return = '<div class="member">';
		$return .= '<div class="photo">';
		$return .= '<img src="'.$photo.'" alt="">';
		$return .= '<div class="social">';
		if ($face !== '') {
			$return .= '<a class="msocial face" href="'.$face.'">F​acebbok</a>';
		}
		if ($twitter !== '') {
			$return .= '<a class="msocial twitter" href="'.$twitter.'">T​witter</a>';
		}
		
		if ($dribble !== '') {
			$return .= '<a class="msocial dribble" href="'.$dribble.'">D​ribble</a>';
		}
		if ($skype !== '') {
			$return .= '<a class="msocial skype" href="skype:'.$skype.'?call">Skype</a>';
		}
		if ($vimeo !== '') {
			$return .= '<a class="msocial vimeo" href="'.$vimeo.'">V​imeo</a>';
		}
		$return .= '</div><!-- end social -->';
		$return .= '</div>';
		$return .= '<div class="content">';
		$return .= '<h4>'.$name.'</h4>';
		$return .= '<span class="position georgia">'.$position.'</span>';
		$return .= '<p>'.do_shortcode( $content ).'</p>';
		$return .= '</div><!-- end content -->';
		$return .= '</div>';
								
								
				
		return $return;
	}
	add_shortcode("member", "mc_team_member_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Columns Container
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_column_shortcode_container')) {
	function mc_column_shortcode_container($atts, $content = null) {
		extract(shortcode_atts(array(
			"id" => ''
		), $atts));	
		
		
		$content = parse_shortcode_content( $content );
		return '<div class="row-fluid">' . do_shortcode( $content ) . '</div><br />';
	}
	add_shortcode("row", "mc_column_shortcode_container");
}


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_column_shortcode')) {
	function mc_column_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'size' => ''
		), $atts ) );
		
		$content = parse_shortcode_content( $content );
		
		$column_size = '';
			
		if($size == 'one_third'){ $column_size = 'span4'; }
		if($size == 'two_third'){ $column_size = 'span8'; }
		if($size == 'one_half'){ $column_size = 'span6'; }
		if($size == 'one_fourth'){ $column_size = 'span3'; }
		if($size == 'three_fourth'){ $column_size = 'span9'; }
		if($size == 'one_sixth'){ $column_size = 'span2'; }
		if($size == 'five_sixth'){ $column_size = 'span10'; }
		if($size == 'one_ninth'){ $column_size = 'span8'; }
			
			
		$output = '';	
		$output .= '<div class="'.$column_size.'"><p>' . do_shortcode( $content ) . '</p></div>';
		return $output;			
	}
	add_shortcode("column", "mc_column_shortcode");
}




/*-----------------------------------------------------------------------------------*/
/*	Price Table
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_price_shortcode')) {
	function mc_price_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'size' => '',
			'title' => ''
		), $atts ) );
		
		$content = parse_shortcode_content( $content );
		
		$column_size = '';
			
		if($size == 'one_third'){ $column_size = 'span4'; }
		if($size == 'two_third'){ $column_size = 'span8'; }
		if($size == 'one_half'){ $column_size = 'span6'; }
		if($size == 'one_fourth'){ $column_size = 'span3'; }
		if($size == 'three_fourth'){ $column_size = 'span9'; }
		if($size == 'one_sixth'){ $column_size = 'span2'; }
		if($size == 'five_sixth'){ $column_size = 'span10'; }
		if($size == 'one_ninth'){ $column_size = 'span8'; }
			
			
		$output = '';	
		$output .= '<div class="'.$column_size.' price-column"><h2 class="price-title">'.$title.'</h2><div class="price-content">' . do_shortcode( $content ) . '</div></div>';
		return $output;			
	}
	add_shortcode("price_column", "mc_price_shortcode");
}





/*-----------------------------------------------------------------------------------*/
/*	Column Title
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_column_title_shortcode')) {
	function mc_column_title_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'icon' => ''
		), $atts ) );
			
		$output .= '';
		if ($icon !== '') {$output .= '<img class="row-icn pull-left" src="'.$icon.'" alt="">';	}
		$output .= '<h3 class="link pull-left">'.$title.'</h3><div class="clear"></div>';
		return $output;			
	}
	add_shortcode("column_title", "mc_column_title_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Nivo Slider
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_slider_shortcode')) {
	function mc_slider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'effect' => '',
			'auto' => '',
			'delay' => ''
			), $atts ) );
	
		if ($auto == 'yes') {
			$auto = 'true';
		} else {
			$auto = 'false';
		}
	

		// Define unique slider ID
		$slider_id = uniqid( 'slider_' );
		global $post;
			$return = '';
			$return .= '<div id="' . $slider_id . '">';
			$return .= '<div class="slider-wrapper theme-default" data-effect="'.$effect.'" data-speed="'.$delay.'" data-auto="'.$auto.'">
				  <div id="' . $slider_id . '-slidemcstudios" class="nivoSlider">'.do_shortcode( $content ).'</div>';
			$return .= '</div>';
			$return .= '</div>';		
		return $return;
	}
	add_shortcode("slider", "mc_slider_shortcode");
}

if (!function_exists('mc_slide_img_shortcode')) {
	function mc_slide_img_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'url' => '',
			'link' => ''
			), $atts ) );

		$return = '';
		if ($link !== '') {
			$return .= '<a href="'.$link.'">';
		}
		if ($url !== '') {
			$return .= '<img src="'.$url.'" alt="" />';	
		}
		if ($link !== '') {
			$return .= '</a>';
		}
		return $return;
	}
	add_shortcode("img", "mc_slide_img_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Google Maps
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_google_maps_shortcode')) {
	function mc_google_maps_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'address' => '',
			'height' => '',
			'zoom' => ''
		), $atts ) );
		
		$return = '';

		$map_id = uniqid( 'mc-gmap' );
		$return .= '<div class="map-holder"><div id="'.$map_id.'" class="gmap" data-target="'.$address.'" data-zoom="'.$zoom.'" style="width: 100%; height: '.$height.'px;"></div></div>';
		return $return;
	}
	add_shortcode("gmap", "mc_google_maps_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Contact Form
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_contact_form_shortcode')) {
	function mc_contact_form_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'name' => ''
	), $atts ) );			
	global $data;
	
	$content = parse_shortcode_content( $content );
			
	$return = '<div class="clear"></div><br /> <div id="contact">';
	$return .= '<div id="message"></div>';
	$return .= '<form method="post" name="contactform" id="contactform" data-ajax="'.admin_url( 'admin-ajax.php').'">';
	$return .= '<fieldset>';
	
	if(!empty($data["contact_layout"])){
		$layout = $data["contact_layout"];
			
		foreach ($layout as $block) {
				
			$order = $block['order'];
			$type = $block['title'];
			$option = $block['block_options'];
			$title = $option['title'];
							
			if (!empty($option['required'])) {
				$required = $option['required'];	
			} else {
				$required = '';
			}
							
			if (!empty($option['options'])) {
				$input_options = $option['options'];	
			} else {
				$input_options = '';
			}
			
			$required_text = '';
			if ($required == 'required' || $required == 'email' || $required == 'phone' || $required == 'yes') {
				$required_text = '<span>'.__('(required)', 'mclang').'</span>';
			}
			
							
			$small = display($title);
							
			if(isset($option['submit_color']))  $color_input = $option['submit_color'];
							
			if(!empty($input_options)){
				$soptions = str_replace("\r\n", ",", $input_options);
				$soptions = rtrim($soptions);
				$select_options = array();								
				$select_options = explode(",", $soptions);	
			}

							
									
			if($type == 'Text'){	
				$return .= '<p><label for="name">'.$title.' '.$required_text.'</label><input name="'.$small.'" type="text" id="'.$small.'-input" size="30" value=""/></p>';
			}

			if($type == 'Select'){								
				$return .= '<p><label for="name">'.$title.' '.$required_text.'</label>';
				
				$return .= '<div id="'.$small.'-holder" class="select-holder">';
				$return .= '<span class="select-header"></span>';
				
				$return .= '<select name="'.$small.'" id="'.$small.'-input" class="select-field">';
					foreach($select_options as $key => $val){
						$return .= '<option value="'.$val.'">'.$val.'</option>';
					}
				$return .= '</select>';
				$return .= '</div>';
				$return .= '</p>';
			}
									
			if($type == 'Checkbox'){
				$return .= '<p class="checkbox-fields">';
					$return .= '<label>'.$title.' '.$required_text.'</label><br />';
					foreach($select_options as $key => $val){			
						$return .= '<input type="checkbox" name="'.$small.'[]" id="'.$small.'-checkbox" value="'.$val.'"><i>'.$val.'</i>';											
					}
				$return .= '</p>';
			}				

			if($type == 'Radio'){
					$return .= '<p class="radio-fields">';
					$return .= '<label>'.$title.' '.$required_text.'</label><br />';
					foreach($select_options as $key => $val){
						$return .= '<input type="radio" name="'.$small.'" id="'.$small.'-radio" value="'.$val.'"><i>'.$val.'</i>';											
					}
				$return .= '</p>';
			}						
							
			if($type == 'Textarea'){
				$return .= '<p><label for="name">'.$title.' '.$required_text.'</label><textarea name="'.$small.'" cols="60" rows="10" id="'.$small.'-textarea" class="mcinput '.$required.'"  ></textarea></p>';
			}
									
			if($type == 'Submit'){
				$return .= '<p><button class="nbtn '.$color_input.'"><span>'.$title.'</span></button><div id="form-loader"></div></p>';
			}									
		  }
		}	
		$return .= '</fieldset>';
		$return .= '</form>';
		$return .= '</div>';
					
		return $return;
	}
	add_shortcode("contact_form", "mc_contact_form_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Accordions
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_accordion_shortcode')) {
	function mc_accordion_shortcode($atts, $content = null) {	
	
		$id = uniqid('accordion');
		
		$content = parse_shortcode_content( $content );
		$output = '<div id="'.$id.'" class="accordion">' . do_shortcode( $content ) . '</div>';
		return $output;
	}
	add_shortcode("accordion", "mc_accordion_shortcode");
}

if (!function_exists('mc_accordion_tab_shortcode')) {
	function mc_accordion_tab_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"active" => '',
			"title" => ''
		), $atts));
	
	
		if ($active == 'yes') {
			$active = 'in';
		} else {
			$active = '';
		}
		
		$output = '<div class="accordion-group">';
		$output .= '<div class="accordion-heading">';
	    $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#'.display($title).'">';
		$output .= $title;
	    $output .= '</a>';
		$output .= '</div>';
	  	$output .= '<div id="'.display($title).'" class="accordion-body collapse '.$active.'">';
	    $output .= '<div class="accordion-inner">';
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	 	$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode("atab", "mc_accordion_tab_shortcode");
}

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_tabs_shortcode')) {
	function mc_tabs_shortcode( $atts, $content = null){
		$GLOBALS['tab_count'] = 0;

		$id = uniqid('tabs');

		$output = '';
		$output .= '<div class="tabbed-content">';
		
		$content = parse_shortcode_content( $content );

		do_shortcode( $content );

		if( is_array( $GLOBALS['tabs'] ) ){
		$count = 1;
		foreach( $GLOBALS['tabs'] as $tab ){
			if ($count == 1) {
				$tabclass = 'tab-pane active';
				$tliclass = 'active';
			} else {
				$tabclass = 'tab-pane';
				$tliclass = '';
			}
			$tabs[] = '<li class="'.$tliclass.'"><a href="#'.display($tab['title']).'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="'.display($tab['title']).'" class="'.$tabclass.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$count++;
		}
	
		$output .= "\n".'<!-- the tabs --><ul class="nav nav-tabs" id="'.$id.'">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content">'.implode( "\n", $panes ).'</div>'."\n";
		}
		$output .= '</div><!-- end of tabs -->';	
		return $output;
	}
	add_shortcode( 'tabs', 'mc_tabs_shortcode' );
}

if (!function_exists('mc_tab_shortcode')) {
	function mc_tab_shortcode( $atts, $content ){
		 extract(shortcode_atts(array(
			'title' => 'Tab %d'
		), $atts));

		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
		$GLOBALS['tab_count']++;
	}
	add_shortcode( 'tab', 'mc_tab_shortcode' );
}


/*-----------------------------------------------------------------------------------*/
/*	Full Slider description
/*-----------------------------------------------------------------------------------*/
if (!function_exists('mc_fullslider_shortcode')) {
	function mc_fullslider_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"top" => '',
			"xpos" => '',
			"effect" => '',
			"enterfrom" => '',
			"speed" => ''
		), $atts));	
	
		if ($style == 'triangle') {
			$style = 'arrow';
		} elseif ($style == 'arrow') {
			$style = 'green-arrow';
		}
		
		$content = parse_shortcode_content( $content );
		
		
		$output = '<div class="in-slide-content"';
		$output .= 'data-top="'.$top.'" ';
		$output .= 'data-xposition="'.$xpos.'" ';
		$output .= 'data-effect="'.$effect.'" ';
		$output .= 'data-in="'.$enterfrom.'" ';
		$output .= 'data-speed="'.$speed.'">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode("fullslider", "mc_fullslider_shortcode");
}


if (!function_exists('mc_fullslider_video_shortcode')) {
	function mc_fullslider_video_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			"top" => '',
			"speed" => '',
			"video" => '',
			"height" => '',
			"width" => '',
			"autoplay" => '',
			"color" => ''
		), $atts));	
	
		
		
		$content = parse_shortcode_content( $content );		
		
		$output = '<div class="video-holder" data-top="'.$top.'" data-speed="'.$speed.'">';
		$video_type = videoType($video);
		
		
		//$output .= $video_type;
		
		if ($video_type == 'vimeo') {
			$output .= '<div class="vimeo-video" rel="'.$video.'" data-autoplay="'.$autoplay.'" data-width="'.$width.'" data-height="'.$height.'" data-color="'.$color.'"></div>';
		} elseif($video_type == 'youtube') {
			$output .= '<div class="youtube-video" rel="'.$video.'" data-autoplay="'.$autoplay.'" data-width="'.$width.'" data-height="'.$height.'" data-color="'.$color.'"></div>';
		} else {
			
		}
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode("fullslider_video", "mc_fullslider_video_shortcode");
}



/*
if (!function_exists('shortcode_cleaner')) {
	function shortcode_cleaner() {
	    remove_shortcode( 'audio' ); // Not exactly required
	    add_shortcode( 'audio', 'mcaudio_shortcode' );
	}
	add_action( 'init', 'shortcode_cleaner' );	
}


if (!function_exists('mcaudio_shortcode')) {
	function mcaudio_shortcode(){
		
		echo 'hola';
		
	}	
}*/


?>