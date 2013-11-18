<?php
global $wp, $wpdb, $wp_query, $post, $data, $mc_option;

//print_r($wp);

/*if (!is_404() || !is_category() || !is_archive() || !is_tag() || !is_search()):
	if (is_home() || is_front_page()) {
		$page_object = $wp_query->get_queried_object();
		//$page_name = $wp_query->posts->post_title;
		$page_name = $wp_query->posts[0]->post_name;
		
		//$page_name = $wp_query->get_queried_object_id();
		$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");	
	} elseif (!is_single()) {
			if ( $post->post_parent ) {
				// 'this page has parent';
				$page_object = $wp_query->get_queried_object();
				$page_name_temp = $wp->query_vars['pagename'];
				$page_name = explode ("/", $page_name_temp);
				$page_name = end(array_filter(explode("/", $page_name_temp)));
				$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
				
			} else {
				// 'Normal page';
				$page_object = $wp_query->get_queried_object();
				$page_name = $wp->query_vars['pagename'];
				$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
			}	
	} else {
			$page_id = '';
	}
endif;	*/


/*=================================================================*/
/* Get the id of the current page by it's name
/* otherwise some templates return a post id or an empty value
/* and we need only the page id
/*=================================================================*/

/*If home page get the selected home page name and then the ID*/
if (is_home() || is_front_page()) {
	$page_object = $wp_query->get_queried_object();
	//$page_name = $wp_query->posts->post_title;
	$page_name = $wp_query->posts[0]->post_name;
	
	//$page_name = $wp_query->get_queried_object_id();
	$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");	
	
} else {
	//Get the ID of the rest of the templates
	
	//The conditional tags below don't have a page name so it's not
	//posible to get the ID, define an empty $page_id;
	if(is_404() || is_category() || is_archive() || is_tag() || is_search()) {
		$page_id = '';
	} else {
		
		//Get the ID of normal pages
		$page_object = $wp_query->get_queried_object();
		if ($wp_query->query_vars['pagename']) {
			$page_name = $wp_query->query_vars['pagename'];	
			$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		} else {
			$page_id = '';
		}
	}		
}



	
	
/*=================================================================*/
/* Define Theme Options Panel
/*=================================================================*/
$mc_option = array();
if (!empty($data)) {
	foreach ($data as $key => $option) {
		if (isset($data[$key])) {
			$mc_option[$key] = $data[$key]; 
		} else {
			$mc_option[$key] = '';
		}//end if
	}//endforeach	
}		



/*
if(is_404() || is_category() || is_archive() || is_tag()):
	$page_id = '';
endif;*/


//print_r($mc_option);

//echo $page_id;


/*=================================================================*/
/* Page title
/*=================================================================*/
if(is_page()){
	$mc_option['page_title'] = get_post_meta( get_the_ID( ), 'mc_page_title', true );
	$mc_option['page_desc'] = get_post_meta( get_the_ID( ), 'mc_page_subtitle', true );
} elseif('mcportfolio' == get_post_type()){
	$mc_option['page_title'] = $mc_option['single_portfolio_title'];
	$mc_option['page_desc'] = $mc_option['single_portfolio_subtitle'];
} elseif(is_author()){
	$mc_option['page_title'] = $mc_option['author_title'];
	$mc_option['page_desc'] = $mc_option['author_subtitle'];	
} elseif(is_search()){
	$mc_option['page_title'] = $mc_option['search_title'];
	$mc_option['page_desc'] = $mc_option['search_subtitle'];	
} elseif(is_404()){
	$mc_option['page_title'] = $mc_option['error_404_title'];
	$mc_option['page_desc'] = $mc_option['error_404_subtitle'];
} elseif(is_tag()){
	$mc_option['page_title'] = $mc_option['tag_archive_title'];
	$mc_option['page_desc'] = $mc_option['tag_archive_subtitle'];
} elseif(is_category()){
	$mc_option['page_title'] = $mc_option['category_archive_title'];
	$mc_option['page_desc'] = $mc_option['category_archive_subtitle'];
} elseif(is_archive()){
	$mc_option['page_title'] = $mc_option['archive_title'];
	$mc_option['page_desc'] = $mc_option['archive_subtitle'];
	
} else{
	$mc_option['page_title'] = $mc_option['single_title'];
	$mc_option['page_desc'] = $mc_option['single_subtitle'];
}


/*=================================================================*/
/* Sidebar Position
/*=================================================================*/
if(is_page()){
	$mc_option['sidebar'] = get_post_meta( get_the_ID( ), 'mc_sidebar', true );
	
} elseif('mcportfolio' == get_post_type()){
	
	$mc_option['sidebar'] = $mc_option['single_project_sidebar'];
	
} else{
	
	$mc_option['sidebar'] = $mc_option['single_sidebar'];
}	
if($mc_option['sidebar'] == 'hide'){ 
	
	$mc_option['page_size'] = 'full';
	
} else{ 
	$mc_option['page_size'] = 'normal';
}
//If the page has a sidebar add a class of eight units to the content
	//otherwise is a full page
if($mc_option['page_size'] == 'normal'){ 
	$content_size = 'span8'; 
	$mc_option['content_size'] = 'span8';
} 
else{ 
	$content_size = 'span12'; 
	$mc_option['content_size'] = 'span12';
}





/*=================================================================*/
/* Single Blog
/* The rest of the mentioned templates 
/* share the same options as the single blog
/*=================================================================*/
if (is_single() || is_category() || is_404() || is_tag() || is_archive() || is_search()) {
	$mc_option['page_options']['blog_layout'] = get_post_meta( get_the_ID( ), 'mc_single_post_style_over', true );
	
	if ($mc_option['page_options']['blog_layout'] == '' || $mc_option['page_options']['blog_layout'] == 'default') {
		$mc_option['page_options']['blog_layout'] = $mc_option['single_post_style'];
	}
	
	$mc_option['page_options']['blog_author'] = $mc_option['single_post_author'];
	$mc_option['page_options']['blog_showcategories'] = $mc_option['single_show_categories'];
	$mc_option['page_options']['blog_share'] = $mc_option['single_post_share'];
	$mc_option['page_options']['enable_comments'] = $mc_option['single_enablecomments'];
	$mc_option['sidebar'] = $mc_option['single_sidebar'];	
	
	$mc_option['page_options']['blog_excerpt'] = 75;
}



/*=================================================================*/
/* Single Portfolio
/*=================================================================*/
if ('mcportfolio' == get_post_type()) {
	
	$mc_option['page_options']['slider_auto'] = $mc_option['project_slide_auto'];
	
	if (!empty($mc_option['single_slider_duration'])) {
		$mc_option['page_options']['slider_speed'] = $mc_option['single_slider_duration'];	
	} else {
		$mc_option['page_options']['slider_speed'] = 11000;
	}
	
	
	$mc_option['page_options']['enable_comments'] = $mc_option['single_portfolio_comments'];
	$mc_option['sidebar'] = $mc_option['single_project_sidebar'];	
	
	$mc_option['page_options']['single_portfolio'] = $mc_option['single_portfolio_style'];
	
	$single_portfolio_style_temp = get_post_meta( get_the_ID( ), 'mc_project_single_style', true );
	
	if ($single_portfolio_style_temp !== '' && $single_portfolio_style_temp !== 'default') {
		$mc_option['page_options']['single_portfolio'] = $single_portfolio_style_temp;
	}
	
	$mc_option['page_options']['portfolio_related'] = $mc_option['single_portfolio_related_projects'];
}






/*=================================================================*/
/* Page Type
/*=================================================================*/
$searchTerm = "$page_id";

$blogs = $mc_option['blog_page'];
$portfolios = $mc_option['portfolio_page'];
$services = $mc_option['services_page'];




/*if the page is a blog*/			
if (false !== ($pos = array_search2d($searchTerm, $blogs, "blog_page"))) {


	$mc_option['page_type'] = 'blog';
	

	
	foreach ($blogs[$pos] as $key => $value) {
		if (isset($value)) {
			$cvalue = $value;
		} else {
			$cvalue = '';
		}
		$mc_option['page_options'][$key] = $cvalue;
	}
	
	if (empty($mc_option['page_options']['blog_categories'])) {
		$mc_option['page_options']['blog_categories'] = '';
	} else {
		$mc_option['page_options']['blog_categories'] = implode(",", $mc_option['page_options']['blog_categories']);
	}
	
	if (empty($mc_option['page_options']['blog_excerpt'])) {
		$mc_option['page_options']['blog_excerpt'] = 75;
	}
	
	
}
/*if the page is a portfolio*/
elseif (false !== ($pos = array_search2d($searchTerm, $portfolios, "portfolio_page"))) {
	
	$mc_option['page_type'] = 'portfolio';
	
	foreach ($portfolios[$pos] as $key => $value) {
		if (isset($value)) {
			$cvalue = $value;
		} else {
			$cvalue = '';
		}
		$mc_option['page_options'][$key] = $cvalue;
	}
	
	
	if($mc_option['page_options']['portfolio_columns'] == '2 Columns')
		$mc_option['page_options']['portfolio_columns'] = 'two-cols';
	if($mc_option['page_options']['portfolio_columns'] == '3 Columns')
		$mc_option['page_options']['portfolio_columns'] = 'three-cols';
	if($mc_option['page_options']['portfolio_columns'] == '4 Columns')
		$mc_option['page_options']['portfolio_columns'] = 'four-cols';
	if($mc_option['page_options']['portfolio_columns'] == '5 Columns')
		$mc_option['page_options']['portfolio_columns'] = 'five-cols';
	if($mc_option['page_options']['portfolio_columns'] == '1 Column')
		$mc_option['page_options']['portfolio_columns'] = 'one-cols';
	
	
	if (empty($mc_option['page_options']['portfolio_categories'])) {
		$mc_option['page_options']['portfolio_categories'] = '';
	}	
	if (empty($mc_option['page_options']['portfolio_nposts'])) {
		$mc_option['page_options']['portfolio_nposts'] = '';
	}	
	
	if (empty($mc_option['page_options']['portfolio_project_description_words'])) {
		$mc_option['page_options']['portfolio_project_description_words'] = 20;
	}
		
}
elseif (false !== ($pos = array_search2d($searchTerm, $services, "service_page"))) {

	$mc_option['page_type'] = 'services';
	
	foreach ($services[$pos] as $key => $value) {
		if (isset($value)) {
			$cvalue = $value;
		} else {
			$cvalue = '';
		}
		$mc_option['page_options'][$key] = $cvalue;	
	}
	
	if (empty($mc_option['page_options']['service_categories'])) {
		$mc_option['page_options']['service_categories'] = '';
	}
	if (empty($mc_option['page_options']['service_active_tab'])) {
		$mc_option['page_options']['service_active_tab'] = '1';
	}
	

	
}
/*normal page*/
else {
	$mc_option['page_type'] = 'normal';
}


if ($mc_option['contact_page'] == $page_id) {
	$mc_option['page_type'] = 'contact';
}











/*$mcoption = array();





$page_object = $wp_query->get_queried_object();
$page_id     = $wp_query->get_queried_object_id();


/* #Logo Menu
================================================== 
$logo_align = 'pull-left';
$menu_align = 'pull-right';
if(!empty($data['logo_align']) && $data['logo_align'] == 'right'){ 
	$menu_align = 'pull-left';
	$logo_align = 'pull-right';
}
$logo = 'logo';
if(!empty($data["logo"])){ $logo = 'custom-logo';}
$exclude = '';
if (!empty($data["exclude_pages"])) {
	$exclude = $data["exclude_pages"];
	$exclude = implode(",", $exclude);
}

//Top Contact
$email = $mcoption['header_email'];
$phone = $mcoption['header_phone'];

//Enable responsive
$responsive = $mcoption['responsive_design'];


//Skin
$skin = $mcoption['theme_skin'];
if ($skin == '') {
	$skin = 'light.css';
}


//Breadcrumbs 
$breadcrumb = $mcoption['breadcrumb'];	


//Contact Page
$contact_page = $mcoption['contact_page'];	
$contact_page_map = $mcoption['contact_page_map_top'];	



//Single Portfolio
$single_portfolio_style = $mcoption['single_portfolio_style'];

$single_portfolio_style_temp = get_post_meta( get_the_ID( ), 'mc_project_single_style', true );

if ($single_portfolio_style_temp !== '' && $single_portfolio_style_temp !== 'default') {
	$single_portfolio_style = $single_portfolio_style_temp;
}




/*tite and description
if(is_page()){
	$page_title = get_post_meta( get_the_ID( ), 'mc_page_title', true );
	$page_desc = get_post_meta( get_the_ID( ), 'mc_page_subtitle', true );
	$page_comments = get_post_meta( get_the_ID( ), 'mc_page_comments', true );
	if ($page_comments == '') {
		$page_comments = 'disable';
	}
	
} elseif('mcportfolio' == get_post_type()){
	$page_title = $mcoption['single_portfolio_title'];
	$page_desc = $mcoption['single_portfolio_subtitle'];
} elseif(is_author()){
	$page_title = $mcoption['author_title'];
	$page_desc = $mcoption['author_subtitle'];	
} elseif(is_search()){
	$page_title = $mcoption['search_title'];
	$page_desc = $mcoption['search_subtitle'];	
} elseif(is_404()){
	$page_title = $mcoption['404_title'];
	$page_desc = $mcoption['404_subtitle'];
} elseif(is_tag()){
	$page_title = $mcoption['tag_archive_title'];
	$page_desc = $mcoption['tag_archive_subtitle'];
} elseif(is_category()){
	$page_title = $mcoption['category_archive_title'];
	$page_desc = $mcoption['category_archive_subtitle'];
} elseif(is_archive()){
	$page_title = $mcoption['archive_title'];
	$page_desc = $mcoption['archive_subtitle'];
	
} else{
	$page_title = $mcoption['single_title'];
	$page_desc = $mcoption['single_subtitle'];
}



/*Sidebar position
if(is_page()){
	$sidebar = get_post_meta( get_the_ID( ), 'mc_sidebar', true );
} elseif('mcportfolio' == get_post_type()){
	$sidebar = $mcoption['single_project_sidebar'];
} else{
	$sidebar = $mcoption['single_sidebar'];	
}	
if($sidebar == 'hide'){ $page_size = 'full'; } 
else{ $page_size = 'normal'; }
//If the page has a sidebar add a class of eight units to the content
	//otherwise is a full page
if($page_size == 'normal'){ 
	$content_size = 'span8'; 
} 
else{ $content_size = 'span12'; }	

	
/*Single post page		
if (isset($data['single_enablecomments'])) {
	$enable_comments = $data['single_enablecomments'];
} else {
	$enable_comments = 'yes';
}


$single_post_style_meta = get_post_meta( get_the_ID( ), 'mc_single_post_style_over', true );
$single_post_style = $mcoption['single_post_style'];

if ($single_post_style_meta !== '') {
	if ($single_post_style_meta !== 'default') {
		$single_post_style = $single_post_style_meta;
	}
}



$post_author_temp = $mcoption['single_post_author'];
$post_categories_temp = $mcoption['single_show_categories'];
$post_share_temp = $mcoption['single_post_share'];
	
//Single portfolio
if('mcportfolio' == get_post_type()){
	$enable_comments_portfolio = $mcoption['single_portfolio_comments'];
	$slider_auto = $mcoption['project_slide_auto'];
	$slider_speed = $mcoption['single_slider_duration'];
	$related_projects = $mcoption['single_portfolio_related_projects'];
	
	
	if ($slider_speed == '') {
		$slider_speed = 10000;
	}
}
	



/*Extra pages
if(is_search() || is_404() || is_tag() || is_category() || is_archive()){
	//$blog_excerpt = 60;
	//$posted_days = $mcoption['single_posteddate'];
	//$blog_comments = $mcoption['single_showcomments'];
}



		
			 	
if (is_single()) {
	 $post_author = $post_author_temp;
	 $post_categories = $post_categories_temp;
	 $post_share = $post_share_temp;
	 
	
	if ($single_post_style == 'full') {
		$page_size = 'full';
	}	 
	 
	 
}*/
?>