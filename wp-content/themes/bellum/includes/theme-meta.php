<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'mc_';

global $meta_boxes;

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

$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'mcstudios_post_options',
	'title' => 'Post Options',
	'pages' => array( 'post'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		/*array(
			'name'		=> __('Thumbnail height', 'mclang'),
			'id'		=> $prefix . 'thumbnail_height',
			'desc'		=> __('Change the height of the thumbnail. default is 300', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'normal-field',
			'type'		=> 'text',
			'std'		=> ''
		),*/
		array(
			'name'		=> __('Video URL', 'mclang'),
			'id'		=> $prefix . 'video_url',
			'desc'		=> __('Video URL, you can enter a vimeo video, youtube or hosted mp4 file.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'video-field',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Video Height', 'mclang'),
			'id'		=> $prefix . 'video_height',
			'desc'		=> __('You can adjust the height of the video.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'video-field',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('MP3 File URL', 'mclang'),
			'id'		=> $prefix . 'audio_url',
			'desc'		=> __('Enter the full url of the audio file.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'audio-field',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> __('OGG File URL', 'mclang'),
			'id'		=> $prefix . 'audio_url_ogg',
			'desc'		=> __('Optional Enter the full url of the ogg audio file.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'audio-field',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		/*
		array(
			'name'		=> __('Quote text', 'mclang'),
			'id'		=> $prefix . 'quote_text',
			'desc'		=> __('Enter the text of the quote.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'quote-field',
			'type'		=> 'textarea',
			'std'		=> ''
		),
		
		array(
			'name'		=> __('Quote author', 'mclang'),
			'id'		=> $prefix . 'quote_author',
			'desc'		=> __('Enter the author of the quote.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'quote-field',
			'type'		=> 'text',
			'std'		=> ''
		),*/
		
		/*
		array(
			'name'		=> __('Source Title', 'mclang'),
			'id'		=> $prefix . 'source_title',
			'desc'		=> __('Enter the title of the source.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'link-field',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> __('Source URL', 'mclang'),
			'id'		=> $prefix . 'source_url',
			'desc'		=> __('Enter the url of the source.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'link-field',
			'type'		=> 'text',
			'std'		=> ''
		),*/
		
		
		
		array(
			'name'		=> __('External URL', 'mclang'),
			'id'		=> $prefix . 'external_url',
			'desc'		=> __('Link the post to an alternative URL.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'show-always',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		
		array(
			'name'		=> __('Single Style', 'mclang'),
			'id'		=> $prefix . 'single_post_style_over',
			'desc'		=> __('You can change the style f the single post page here.', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'show-always adjustwidthselect',
			'type'		=> 'select',
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'default' => 'Default',
				'full' => 'Full Width Post',
				'normal' => 'Normal Post with sidebar',
			),
			'std'		=> 'default'
		)
		
		
		
		
		
		
	)
);





$meta_boxes[] = array(
	'id' => 'mcstudios_portfolio_options',
	'title' => 'Project Options',
	'pages' => array( 'mcportfolio'),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => __('Link project to:', 'mclang'),
			'id' => $prefix . 'linkto',
			'type' => 'select',             // File type: select box
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'single' => 'Link to project single',
				'lightbox' => 'link to lightbox',
				'external' => 'External Link',
			),
			'class' => 'parent',
			'multiple' => false,             // Select multiple values, optional. Default is false.
			'std' => array( 'right' ),         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => __('Select the link type', 'mclang')
		),
		array(
			'name'		=> __('External Link', 'mclang'),
			'id'		=> $prefix . 'external_url',
			'desc'		=> __('Adjust the project link', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'external',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		
		
		array(
			'name' => __('Single project style:', 'mclang'),
			'id' => $prefix . 'project_single_style',
			'type' => 'select',             // File type: select box
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'default' => 'Default',
				'style1' => 'Top Slider Full Content',
				'style2' => 'Top Slider with sidebar',
				'style3' => 'Normal Post'
			),
			'class' => 'parent',
			'multiple' => false,             // Select multiple values, optional. Default is false.
			'std' => array( 'default' ),         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => __('Overwrite the single style', 'mclang')
		)
		
		
		
		/*array(
			'name' => __('Show button link:', 'mclang'),
			'id' => $prefix . 'project_showbutton',
			'type' => 'select',             // File type: select box
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'hidebutton' => 'Hide button',
				'showbutton' => 'Show button'
			),
			'class' => 'parent',
			'multiple' => false,             // Select multiple values, optional. Default is false.
			'std' => array( 'right' ),         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => __('Select the link type', 'mclang')
		),	
		
		array(
			'name'		=> __('Project Link text', 'mclang'),
			'id'		=> $prefix . 'project_link_text',
			'desc'		=> __('Add a button with a link', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'showbutton',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Project Link URL', 'mclang'),
			'id'		=> $prefix . 'project_link_url',
			'desc'		=> __('Add a link to your button', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'showbutton',
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name' => __('Project button color:', 'mclang'),
			'id' => $prefix . 'project_link_color',
			'type' => 'select',             // File type: select box
			'options' => $buttons_colors,
			'class' => 'showbutton',
			'multiple' => false,             // Select multiple values, optional. Default is false.
			'std' => '',         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => __('Select the color of the link', 'mclang')
		)*/
		
		
	)
);






$meta_boxes[] = array(
	'id' => 'mcstudios_page_options',
	'title' => 'Page Options',
	'pages' => array( 'page'),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
	/*
		array(
			'name'		=> __('Page Settings', 'mclang'),
			'id'		=> $prefix . 'page_settings',
			'desc'		=> __('Configure the home page', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'header',
			'type'		=> 'head',
			'std'		=> ''
		),
		*/
		array(
			'name'		=> __('Page Title', 'mclang'),
			'id'		=> $prefix . 'page_title',
			'desc'		=> __('The page title', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'fancy',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> __('Page Subtitle', 'mclang'),
			'id'		=> $prefix . 'page_subtitle',
			'desc'		=> __('The page subtitle', 'mclang'),
			'clone'		=> false,
			'class' 	=> 'fancy',
			'type'		=> 'textarea',
			'std'		=> ''
		),
		array(
			'name' => __('Sidebar Position:', 'mclang'),
			'id' => $prefix . 'sidebar',
			'type' => 'select',             // File type: select box
			'options' => array(             // Array of 'key' => 'value' pairs for select box
				'right' => 'Right',
				'left' => 'Left',
				'hide' => 'Hide',
			),
			'class' => 'fancy',
			'multiple' => false,             // Select multiple values, optional. Default is false.
			'std' => array( 'right' ),         // Default value, can be string (single value) or array (for both single and multiple values)
			'desc' => __('Select the sidebar position', 'mclang')
		)
	)
);













/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );