<?php
/*=================================================================*/
/* Define the custom post types used by this theme
/*=================================================================*/

//Portfolio
if (! function_exists('mc_projects') ) {
	
	function mc_projects() {
		register_post_type( 'mcportfolio', array(
			'labels' => array(
				'name' => __('Portfolio', 'mclang'),
				'singular_name' => __('Portfolio', 'mclang'),
				'add_new' => __( 'Add New Project', 'mclang' ),
				'add_new_item' => __( 'Add New Project', 'mclang' ),
				'not_found' => __( 'There are no projects yet', 'mclang' ),
				),
			'public' => true,
			'show_ui' => true,
			'menu_position' => 5,
			'publicly_queryable' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'hierarchical' => false,
			'capability_type' => 'post',
			'supports' => array('title', 'editor', 'comments'),
			'rewrite' => array(
				'slug' => 'view-project',
				'with_front' => false
				),
			'has_archive' => true
		) );
	}
	add_action( 'init', 'mc_projects' );
}


//Services
if (! function_exists('mc_services') ) {
	
	function mc_services() {
		register_post_type( 'mcservices', array(
			'labels' => array(
				'name' => __('Services', 'mclang'),
				'singular_name' => __('Services', 'mclang'),
				'add_new' => __( 'Add New Services', 'mclang' ),
				'add_new_item' => __( 'Add New Service', 'mclang' ),
				'not_found' => __( 'There are no services yet', 'mclang' ),
				),
			'public' => true,
			'show_ui' => true,
			'menu_position' => 5,
			'publicly_queryable' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'hierarchical' => false,
			'capability_type' => 'post',
			'supports' => array('title', 'editor'),
			'rewrite' => array(
				'slug' => 'view-service',
				'with_front' => false
				),
			'has_archive' => true
		) );
	}
	add_action( 'init', 'mc_services' );
}



//Taxonomies
if (! function_exists('create_my_taxonomies') ) {
	function create_my_taxonomies() {
		register_taxonomy( 
			'projects', array("mcportfolio"), 
			array( 'hierarchical' => true,  
			'label' => __('Category', 'mclang'), 
			"singular_label" => __('Category', 'mclang'), 
			'query_var' => true, 
			"rewrite" => true)
		);
		
		register_taxonomy( 
			'service', array("mcservices"), 
			array( 'hierarchical' => true,  
			'label' => __('Category', 'mclang'), 
			"singular_label" => __('Category', 'mclang'), 
			'query_var' => true, 
			"rewrite" => true)
		);
		
		/*register_taxonomy( 
			'specifics', array("mcportfolio"), 
			array( 'hierarchical' => false, 
			'label' => __('Project Tags', 'mclang'), 
			'query_var' => true, 
			'rewrite' => true ) 
		);*/
		
	}
	add_action( 'init', 'create_my_taxonomies', 0 );
}





// Adjust the custom post type table
add_filter('manage_edit-mcportfolio_columns', 'add_new_mcportfolio_columns');
add_action('manage_posts_custom_column', 'manage_mcportfolio_columns', 10, 2);

function add_new_mcportfolio_columns($gallery_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';		
	$new_columns['pthumb'] = _x('Thumbnail', 'column name', 'mclang');
	$new_columns['title'] = _x('Title', 'column name', 'mclang');
	$new_columns['prod_cat'] = _x('Categories', 'column name', 'mclang');
	//$new_columns['mcdescription'] = _x('Cliente', 'column name', 'mclang');
	$new_columns['author'] = __('Author', 'column name', 'mclang');
	$new_columns['date'] = _x('Date', 'column name', 'mclang');
	return $new_columns;
}
	
	
// Add to admin_init function
function manage_mcportfolio_columns($column_name, $id) {		
	global $post;

	switch( $column_name ) {
		case "pthumb":
			global $wpdb, $post;
			if(has_post_thumbnail()){
				echo '<div class="mcpost-thumb">
							<img src="'.thumb_url().'"  width="85" height="60"/>
							</div>';
			} else{
				$attachments = new Attachments( 'mcattachments' , $post->ID);
				if( $attachments->exist() ) :
				 $count = 1;
				 while ($attachments->get()) {
				  $image_url = $attachments->src();	
				  echo '<div class="mcpost-thumb"><img src="'.$image_url.'"  width="85" height="70"/></div>';
				  if ($count >= 1) { break; }
				  $count++;
				 }
			   endif;				 	
			}				
		break;
		case "mcdescription":
			the_excerpt();
		break;
		case "prod_cat":
			echo get_the_term_list( $post->ID, 'projects', '', ', ', '' );
		break;
		case "prod_client":
			$custom = get_post_custom();
			echo $custom["rw_client"][0];
		break;
		case "prod_tags":
			$terms_of_post = get_the_term_list( $post->ID, 'specifics', '', ', ', '' );
			echo $terms_of_post;
		break;
	} // end switch
}	





// Adjust the custom post type table
add_filter('manage_edit-mcservices_columns', 'add_new_mcservices_columns');
add_action('manage_posts_custom_column', 'manage_mcservices_columns', 10, 2);

function add_new_mcservices_columns($gallery_columns) {
		$new_columns['cb'] = '<input type="checkbox" />';		
		$new_columns['sthumb'] = _x('', 'column name', 'mclang');
		$new_columns['title'] = _x('Title', 'column name', 'mclang');
		$new_columns['prod_cat'] = _x('Categories', 'column name', 'mclang');
		//$new_columns['mcdescription'] = _x('Cliente', 'column name', 'mclang');
		$new_columns['author'] = __('Author', 'column name', 'mclang');
		$new_columns['date'] = _x('Date', 'column name', 'mclang');
		return $new_columns;
	}
	
	
	// Add to admin_init function
			function manage_mcservices_columns($column_name, $id) {		
				global $post;

				switch( $column_name ) {
					case "sthumb":
							global $wpdb, $post;
							if(has_post_thumbnail()){
								echo '<img src="'.thumb_url().'"  width="20" height="20"/>';
							}
					break;
					case "mcdescription":
						the_excerpt();
					break;
					case "prod_cat":
						echo get_the_term_list( $post->ID, 'service', '', ', ', '' );
					break;
				} // end switch
}
 ?>