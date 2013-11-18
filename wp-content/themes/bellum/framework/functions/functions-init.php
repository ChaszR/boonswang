<?php
global $data;


/*=================================================================*/
/* Default Configuration
/*=================================================================*/

//Custom menu support
if ( function_exists( 'add_theme_support' ) )
	add_theme_support ('nav-menus');
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'video', 'quote', 'audio') );
	add_action( 'init', 'register_my_menus' );
	function register_my_menus() {
    	register_nav_menus(
        	array(
            	'top-menu' => __( 'Top Menu' , 'mclang')
        	)
    	);
	}
	add_editor_style('custom-editor-style.css');
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');


	// Post thumbnail support
	if (! function_exists('mc_thumbnails') ) {
		function mc_thumbnails() {
			add_theme_support('post-thumbnails');
			set_post_thumbnail_size( 150, 150 );
			add_image_size( 'portfolio-thumb', 650, 420, true);
			add_image_size( 'blog-thumb', 114, 176, true);
			add_image_size( 'slider-thumb', 130, 87, true);
			//add_image_size( 'catalog-shop', 230, 190, true);
			
		}
		add_action('after_setup_theme', 'mc_thumbnails');
	}
	
	
	if ( function_exists( 'add_image_size' ) ) { 
		 //300 pixels wide (and unlimited height)
		//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
	}


// Register widgetized areas
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'description' => __( 'Drop Widgets Here', 'mclang'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4><div class="double-line"></div><div class="clear"></div>',
	));
	
	
	/**
	 * Check if WooCommerce is active
	 * and create a custom sidebar
	 **/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		register_sidebar(array(
			'name' => 'WooComerce',
			'id' => 'woocomercesidebar',
			'description' => __( 'Drop Widgets Here', 'mclang'),
			'before_widget' => '<div id="%1$s" class="widget widgetSidebar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="title">',
			'after_title' => '</h4><div class="double-line"></div><div class="clear"></div>',
		));
	}
	
	
	
}

$footer_widgets = '';
if(!empty($data["footer-widgets"])){
	$footer_temp = str_replace("footer", "", $data["footer-widgets"]);
	$footer_widgets =  $footer_temp;
} else{
	$footer_widgets =  4;
}
if($footer_widgets == '4'){
	$widget_size = 'span3';
} elseif($footer_widgets == '3'){
	$widget_size = 'span4';
} else{
	$widget_size = 'span6';
}

for ($i = 1; $i <= $footer_widgets; $i++) {	
	$fclass = '';
	if($i == 1)
	$fclass = 'first';
	
	register_sidebar(array(
		'name' => 'Footer Widget '.$i.'',
		'id' => 'footer-widget-'.$i.'',
		'description' => __( 'Drop Widgets Here', 'mclang'),
		'before_widget' => '<div id="%1$s" class="widget '.$fclass.' '.$widget_size.' %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="line"></div>',
	));
}







/*Execute shortcodes in widgets*/
add_filter('widget_text', 'do_shortcode');	
	
	
	
/**
* Function get_image_path
* This function retreives the original path of the image if the wordpress
* installation is multisites
* basically the function is called like this: get_image_path($imgurl);
*
* @param string $key accepts one variable in this case the image path
* @return string will return the image full path
*/
if(!function_exists('get_image_path'))
{
	function get_image_path($img_src) {
	    global $blog_id;
	    if (isset($blog_id) && $blog_id > 0) {
	        $imageParts = explode('/files/', $img_src);
	        if (isset($imageParts[1])) {
	            $img_src = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
	        }
	    }
	    return $img_src;
	}
}




/**
* Function mc_post_image
* This function retreives the images attached to the post
* the function accepts one variable "featured, all, first, digit"
* the digit can be any number and it will display that amount of images
*
* @param string $key accepts one variable, type of image or amount
* @param string $size thumbnail, medium, full and all other defined sizes
* @return string or array with the images and data
*/
if(!function_exists('mc_post_image'))
{
	function mc_post_image($position, $size = '') {
		global $post;
		$output = '';
		
		
		if ($size == '') {
			$size = 'full';
		}
		
		
		//If get featured image only
		if ($position == 'featured') {
			if(has_post_thumbnail()):
				$output = thumb_url();
			endif;
		}
		
		//Get all the images
		if($position == 'all'):
			$attachments = new Attachments( 'mcattachments' , $post->ID);
			$output = array();
			
			//Get all the images and create an array
			if( $attachments->exist() ) :
				$icount = 1;
				while( $attachments->get() ) :
					$image_url = $attachments->src($size);
					$image_title = $attachments->field('title');
					$image_video = $attachments->field('video');
					
					
					$output[] = array('src' => $image_url, 'title' => $image_title, 'video' => $image_video);
					
					
				endwhile;
			endif;
			
		endif;
		
		//Get the first image
		if($position == 'first'):
			$attachments = new Attachments( 'mcattachments' , $post->ID);
			if( $attachments->exist() ) :
				$icount = 1;
				while( $attachments->get() ) :
					$image_url = $attachments->src($size);	
					
					$output = $image_url;
				
				if ($icount >= 1) { break; }
				$icount++;
				endwhile;
			endif;
		endif;
		
	return $output;
	}
}




/**
* Function mc_lightbox_gallery
* This function retreives the images attached to the post
* the function accepts one variable "featured, all, first, digit"
* the digit can be any number and it will display that amount of images
*
* @param string $key accepts one variable, type of image or amount
* @return string or array with the images and data
*/
if(!function_exists('mc_lightbox_gallery'))
{
	function mc_lightbox_gallery($gallery = '') {
		global $post;
		$output = '';
		
		if ($gallery == '') { $gallery = 'rel="lightbox"'; }
		

		if (has_post_thumbnail()) {
			$output .= '<a '.$gallery.' href="'.thumb_url().'">Gallery</a>';
		} 
		else {
			$attachments = new Attachments( 'mcattachments' , $post->ID);
			//Get all the images and create an array
			if( $attachments->exist() ) :
				$icount = 1;
				while( $attachments->get() ) :
					$image_url = $attachments->src('full');
					$image_title = $attachments->field('title');
					$image_video = $attachments->field('video');
					if ($image_video !== '') {
						$source = $image_video;
					} else {
						$source = $image_url;
					}
					if ($icount !== 1) {
						$output .= '<a class="hidden" '.$gallery.' href="'.$source.'" title="'.$image_title.'">Gallery</a>';	
					}
					
				$icount++;	
				endwhile;
			endif;	
		}
		
	return $output;
	}
}





/**
* Function mc_post_image
* This function retreives the images attached to the post
* the function accepts one variable "featured, all, first, digit"
* the digit can be any number and it will display that amount of images
*
* @param string $key accepts one variable, type of image or amount
* @param string $size thumbnail, medium, full and all other defined sizes
* @return string or array with the images and data
*/
if(!function_exists('mc_lightbox_title'))
{
	function mc_lightbox_title() {
		global $post;
		$output = '';
		

		$attachments = new Attachments( 'mcattachments' , $post->ID);
		if( $attachments->exist() ) :
			$icount = 1;
			while( $attachments->get() ) :
				$title = $attachments->field( 'title' );
				
				if ($title == '') {
					$title = get_the_title();
				}
				
				
				$output = $title;
				if ($icount >= 1) { break; }
				$icount++;
			endwhile;
		endif;		
	return $output;
	}
}




/**
* Function mc_lightbox
* This function retreives the images attached to the post
* the function accepts one variable "featured, all, first, digit"
* the digit can be any number and it will display that amount of images
*
* @param string $key accepts one variable, type of image or amount
* @return string or array with the images and data
*/
if(!function_exists('mc_lightbox'))
{
	function mc_lightbox() {
		global $post;
		$output = '';
				
		if (has_post_thumbnail()) {
			$output .= thumb_url();
		} 
		else {
			$attachments = new Attachments( 'mcattachments' , $post->ID);
			//Get all the images and create an array
			if( $attachments->exist() ) :
				$icount = 1;
				while( $attachments->get() ) :
					$image_url = $attachments->src('full');
					$image_title = $attachments->field('title');
					$image_video = $attachments->field('video');
							
					if ($image_video !== '') {
						$source = $image_video;
					} else {
						$source = $image_url;
					}
					$output .= $source;
						
					if ($icount >= 1) { break; }
				$icount++;	
				endwhile;
			endif;
		}
	return $output;
	}
}







/**
* Function display
* This function removes all the spaces, remove special
* characters and lower case a string
* basically the function is called like this: display('My String Here');
*
* @param string $key accepts one variable in this case the image path
* @return string will return the image full path
*/
if (! function_exists('display') ) {
	function display($content) {
		$content = preg_replace("/ +/", " ", trim($content)); 
		$content = str_replace(" ", "", $content);
		$content = strtolower($content);
		$content = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $content);
		return $content;		
	}
}

/*=================================================================*/
/* Function search array
/*=================================================================*/
if (! function_exists('array_search2d') ) {
	function array_search2d($needle, $haystack, $field) {
			if (isset($haystack) && is_array($haystack)) {
					foreach ($haystack as $index => $innerArray) {
			        if (isset($innerArray[$field]) && $innerArray[$field] === $needle) {
			            return $index;
			        }
			    }
			}
	    return false;
	}
}

/*=================================================================*/
/* Function get terms list
/*=================================================================*/
if ( function_exists('cc_get_the_term_list') ) {
	function cc_get_the_term_list( $id = 0, $taxonomy, $before = '', $sep = '', $after = '', $doLinks = 1 ) {
		$terms = get_the_terms( $id, $taxonomy );
		if ( is_wp_error( $terms ) )
			return $terms;
		if ( empty( $terms ) )
			return false;
		foreach ( $terms as $term ) {
			$link = get_term_link( $term, $taxonomy );
			if ( is_wp_error( $link ) )
				return $link;
			if ($doLinks == 1)	{
				$term_links[] = '<a href="' . $link . '" rel="tag">' . $term->name . '</a>';		
			} else {
				$term_links[] = $term->name;		
			}
		}
		$term_links = apply_filters( "term_links-$taxonomy", $term_links );
		return $before . join( $sep, $term_links ) . $after;
	}
}

/*=================================================================*/
/* Function array remove empty values
/*=================================================================*/
if ( function_exists('remove_array_empty_values') ) {
	function remove_array_empty_values($array, $remove_null_number = true)
	{
		$new_array = array();
		$null_exceptions = array();
		foreach ($array as $key => $value)
		{
			$value = trim($value);
	        if($remove_null_number)
			{
		        $null_exceptions[] = '0';
			}
	        if(!in_array($value, $null_exceptions) && $value != "")
			{
	            $new_array[] = $value;
	        }
	    }
	    return $new_array;
	}
}





//Return URL of the featured image
function thumb_url(){
global $post;	
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 2100,2100 ));
return $src[0];
}



function linkType($url) {
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return 'image';
    }
}



/**
* Function mc_gallery
* This function displays all the images attached to the post
* characters and lower case a string
* basically the function is called like this: mc_gallery();
*
* @param string
* @return array with the images
*/
if (! function_exists('mc_gallery') ) 
{
	function mc_gallery() {	
		$size = 'full';
		if ( $images = get_children(array(
			'post_parent' => get_the_ID(),
			'post_type' => 'attachment',
			'order' => 'ASC',
			'orderby' => 'menu_order ID',
			'post_mime_type' => 'image',)))
		{	
			$results = array();
			
			foreach( $images as $image ) {
				$attachmenturl=wp_get_attachment_url($image->ID);
				$attachmentimage=wp_get_attachment_image($image->ID, $size );
				$img_title = $image->post_title;
				$img_desc = $image->post_content;			
				$results[] = array($attachmenturl, $img_title, $img_desc);
			}
			
			return $results;
		}
		
	}
}



/**
* Function mc_get_media
* This function append videos to the post/page
* characters and lower case a string
* basically the function is called like this: mc_get_media($media_url, $width, $height, $cover, $preview);
*
* @param string $key accepts several variables
* @return string will return the video media
*/
if (! function_exists('mc_get_media') ) 
{
	function mc_get_media( $media_url, $width, $height, $cover, $preview = false ) {
		
		$width = '640';
		$height = '360';
	
		// Youtube video
		$video_url = parse_url( $media_url );
			
		if ( $video_url['host'] == 'youtube.com' || $video_url['host'] == 'www.youtube.com' || $video_url['host'] == 'www.youtube.be' || $video_url['host'] == 'youtube.be') {
			
			parse_str( $video_url['query'], $youtube );
			$id = uniqid( '', false );
							
			if (!empty($youtube['v'])) {
				$youtube['v'] = $youtube['v'];
			} elseif(!empty($youtube['amp;v'])) {
				$youtube['v'] = $youtube['amp;v'];
			} else {
				$youtube['v'] = '';
			}	
			/*$return = '<div class="ytube-video"><iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $youtube['v'] . '" frameborder="0" allowfullscreen="true"></iframe></div>';*/
			
			$return = '<div class="youtube-video" rel="'.$media_url.'" data-autoplay="false" data-width="'.$width.'" data-height="'.$height.'"></div>';
			
		}
	
		// Vimeo video
		$video_url = parse_url( $media_url );
	
		if ( $video_url['host'] == 'vimeo.com' || $video_url['host'] == 'www.vimeo.com' ) {
			$return = '<div class="vimeo-video" rel="'.$media_url.'" data-autoplay="false" data-width="'.$width.'" data-height="'.$height.'"></div>';
		}
	
		// Images (bmp/jpg/jpeg/png/gif)
		$images = array( '.bmp', '.BMP', '.jpg', '.JPG', '.png', '.PNG', 'jpeg', 'JPEG', '.gif', '.GIF' );
		$image_ext = mb_substr( $media_url, -4 );
	
		if ( in_array( $image_ext, $images ) ) {
			$return = '<img src="' . su_plugin_url() . '/lib/timthumb.php?src=' . $media_url . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=1&amp;q=100" alt="" width="' . $width . '" height="' . $height . '" />';
		}
	
		// Video file (mp4/flv)
		$videos = array( '.mp4', '.MP4', '.flv', '.FLV' );
		$video_ext = mb_substr( $media_url, -4 );
	
		if ( in_array( $video_ext, $videos ) ) {
			$player_id = uniqid( '_', false );
	
			$return = '<video class="jwplayer-videofile" id="player' . $player_id . '" controls  height="' . $height . '" preload="none" poster="' . $cover . '" src="' . $media_url . '" width="100%"></video>';
		}
	
		// Audio file (mp3)
		if ( mb_substr( $media_url, -4 ) == '.mp3' ) {
			$player_id = uniqid( '_', false );
	
			$return = '<div id="player' . $player_id . '"> </div>
						<script type="text/javascript">
							jwplayer("player' . $player_id . '").setup({
								flashplayer: "' . su_plugin_url() . '/lib/player.swf",
								file: "' . $media_url . '",
								height: ' . $height . ',
								width: ' . $width . ',
								controlbar: "bottom",
								image: "' . su_plugin_url() . '/images/media-audio.jpg",
								icons: "none",
								screencolor: "F0F0F0"
							});
						</script>';
		}
	
		return $return;
	}
}







/**
* Function mc_excerpt
* This function display the post excerpt
* characters and lower case a string
* basically the function is called like this: mcexcerpt($words, $link, $tags, $contauner, $smileys);
*
* @param string $key accepts five variables
* @return string will return the current post excerpt
*/
if (! function_exists('mc_excerpt') ) 
{
	function mc_excerpt($words = 40, $link_text = 'Continue reading this entry &#187;', $allowed_tags = '', $container = 'p', $smileys = 'no' )
	{
	global $post;
	 
	if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';
	 
	$text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, $allowed_tags));
	 
	$text = explode(' ', $text);
	$tot = count($text);
	 $output = '';
	
	if ($words > $tot) {
			$words = $tot;
	} else{
		  $words = $words;
	}
	
	if (!empty($text)) {	
		for ($i=0; $i < $words ; $i++) { 
				$output .= $text[$i] . ' ';
		}
	}	
		
	 
	if ( $smileys == "yes" ) $output = convert_smilies($output);
	 
	?><p><?php echo force_balance_tags($output) ?><?php if ( $i < $tot ) : ?> <?php else : ?></p><?php endif; ?>
	<?php if ( $i < $tot ) : 
	if ( $container == 'p' || $container == 'div' ) : ?></p><?php endif; 
	if ( $container != 'plain' ) : ?><<?php echo $container; ?> class="more"><?php if ( $container == 'div' ) : ?><p><?php endif; endif; ?>
	 
	<a href="<?php the_permalink(); ?>" title="<?php echo $link_text; ?>"><?php echo $link_text; ?></a><?php
	 
	if ( $container == 'div' ) : ?></p><?php endif; if ( $container != 'plain' ) : ?></<?php echo $container; ?>><?php endif;
	 
	if ( $container == 'plain' || $container == 'span' ) : ?></p><?php endif; 
	endif;
	 
	}
}






/**
* Function mc_pagination
* This function display the pagination
* characters and lower case a string
* basically the function is called like this: mcpagination($pages);
*
* @param string $key accepts two variables $pages and $range
* @return string will return the pagination
*/
if (! function_exists('mc_pagination') ) 
{
	function mc_pagination($pages = '', $range = 2)
	{  
	     $showitems = ($range * 2)+1;  
	     global $paged;
	     if(empty($paged)) $paged = 1;
	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   
	     if(1 != $pages)
	     {
	         echo "<div class='numbers-pag'>";
	         //if($paged > 1 && $paged > $range+1 && $showitems < $pages) 
						//echo "<a class='numbered' href='".get_pagenum_link(1)."'><span>&laquo;</span></a>";
	
	         if($paged > 1){
	         	$prev_url = get_pagenum_link($paged - 1);	
			 } else {
			 	$prev_url = "#";
			 }
			 	 echo "<a class='numbered  prev' href='".$prev_url."'><span>Previous</span></a>";
			 
	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	                 echo ($paged == $i)? "<a class='numbered current-page' href='".get_pagenum_link($i)."'><span class='current'>".$i."</span></a>":"<a class='numbered inactive' href='".get_pagenum_link($i)."'><span>".$i."</span></a>";
	             }
	         }
	         
					if ($paged < $pages){
						$next_url = get_pagenum_link($paged + 1);
					} else {
						$next_url = "#";
					}
					
					 echo "<a class='numbered next' href='".$next_url."'><span>Next</span></a>";  
	         //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				//	 echo "<a class='numbered' href='".get_pagenum_link($pages)."'><span>&raquo;</span></a>";
	         echo "</div>";
	     }
	}	
}



/**
* Function custom_comment
* This function display the comments
* with a custom structure
* basically the function is called like this: custom_comment($comment, $args, $depth);
*
* @param string $key accepts three variables
* @return string will return the user comment
*/
if ( ! function_exists( 'custom_comment' ) ) {
	function custom_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	   
	   
	   	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
	   		<div class="comment-container">
	   				<div class="row-fluid">
	   				
	   					<div class="comment-entry">
	   						
	   						<?php if( get_comment_type() == 'comment' ) { ?>
	   							<div class="avatar span2">
	   								<a href="#"><?php the_commenter_avatar( $args ); ?></a>
	   							</div>
	   						<?php } ?>
	   					
	   						<div class="comment-body span10">
	   							<h4><?php the_commenter_link(); ?></h4>
	   							<p class="georgia"><?php echo get_comment_date( get_option( 'date_format' ) ); ?> - <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
	   							<div class="clear"></div>
	   							
	   							<?php comment_text() ?>
	   							<div class="clear"></div>
	   							<?php if ( $comment->comment_approved == '0' ) { ?>
	   							    <p class='unapproved'><?php _e( 'Your comment is awaiting moderation.', 'woothemes' ); ?></p>
	   							<?php } ?>
	   						</div><!-- end comment-body -->
	   					</div><!-- end comment-entry -->
	   				</div> 	
	   		</div><!-- /.comment-container -->

			
	<?php 
	}
}


function searchForId($id, $array, $field) {
   foreach ($array as $key => $val) {
       if ($val->$field === $id) {
           return $key;
       }
   }
   return null;
}


if ( ! function_exists( 'custom_trackbacks_pingbacks' ) ) {
	function custom_trackbacks_pingbacks() { 
		
		global $wp_query, $post;
		$postid = $wp_query->post->ID;
		
		$args = array(
			'order' => 'DESC',
			'post_id' => $postid,
			'count' => false
		);
		
		$comments =  get_comments($args);
		//print_r($comments);
		
		//Run only if there are comments
		if (!empty($comments)) {
			
			//Check if pingbacks or trackbacks exists
			$pingback = '';
			$trackback = '';
			$pingback = searchForId('pingback', $comments, 'comment_type');
			$trackback = searchForId('trackback', $comments, 'comment_type');
			
			//only run if if pingbacks or trackbacks exists
			if (isset($pingback) || isset($trackback)) {
				echo '<section id="list_pings">';
				echo '<h2>'.__('Trackbacks/Pingbacks','mclang').'</h2>';
				echo '<ol>';
				
					foreach ($comments as $comment):
						$author_name = $comment->comment_author;
						$author_url = $comment->comment_author_url;
						$date = $comment->comment_date;
						$content = $comment->comment_content;
						$approved = $comment->comment_approved;
						$comment_type = $comment->comment_type;
						
						if ($approved == 1 || $approved == '1'):
							if ($comment_type == 'pingback' || $comment_type == 'trackback') {
								echo '<li>';
								echo '<a href="'.$author_url.'">'.$author_name.'</a>';
								echo '<p class="date">'.$date.'</p>';
								
								echo '<p class="content">'.$content.'</p>';
								
								echo '</li>';
							}
						endif;
					endforeach;
				echo '</ol>';
				echo '</section>';
			}	
		}
	}
}






// PINGBACK / TRACKBACK OUTPUT
if (!function_exists( 'list_pings' ) ) {
	function list_pings( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment; ?>
		
		<li id="comment-<?php comment_ID(); ?>">
			<span class="author"><?php comment_author_link(); ?></span> - 
			<span class="date"><?php echo get_comment_date(get_option( 'date_format' ) ); ?></span>
			<span class="pingcontent"><?php comment_text(); ?></span>
	
	<?php 
	} 
}
		
if (!function_exists( "the_commenter_link")) {
	function the_commenter_link() {
	    $commenter = get_comment_author_link();
	    if ( preg_match( '/]* class=[^>]+>/', $commenter ) ) {$commenter = preg_replace( '(]* class=[\'"]?)', '\\1url ' , $commenter );
	    } else { $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter ); }
	    echo $commenter ;
	}
}

if ( ! function_exists( 'the_commenter_avatar' ) ) {
	function the_commenter_avatar($args) {
	    $email = get_comment_author_email();
			
			$default = get_template_directory_uri() . '/images/assets/avatar.gif';
	
	    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email",  $args['avatar_size'], 'http://f.cl.ly/items/0A192h1y3k0p3W2q3R0j/avatar.png' ) );
	    echo $avatar;
	}
}






function mcresize_image($img_url, $width, $height, $align = 't'){
	global $data;
	
	$resize_script = '';
	$image_url = '';
	$image_width = '';
	$image_height = '';
	$image_align = '';
	$image_crop = '';
	$image_quality = '';
	
	
	//Define the resize script method
	
	if(!empty($data['resize_script']) && $data['resize_script'] == 'Timthumb'){
		
		$resize_script =  RESIZE_DIR . 'timthumb/timthumb.php';
		
	} elseif(!empty($data['resize_script']) && $data['resize_script'] == 'PHP Thumb'){
		
		$resize_script =  RESIZE_DIR . 'phpThumb/phpThumb.php';
		
	} elseif(!empty($data['resize_script']) && $data['resize_script'] == 'Disable resize script'){
		$resize_script = '';
		
	} else{
		
		$resize_script =  RESIZE_DIR . 'timthumb/timthumb.php';
	}
	
	$image_url = '?src='. get_image_path($img_url);
	
	if(!empty($data['resize_script']) && $data['resize_script'] == 'Timthumb'){
		$image_url = '?src='. get_image_path($img_url);
	} elseif(!empty($data['resize_script']) && $data['resize_script'] == 'PHP Thumb'){
		$image_url = '?src='. $img_url;
	} else{
		$image_url = $img_url;
	}
	
	$image_width = '&amp;w='.$width;
	$image_height = '&amp;h='.$height;
	if(!empty($data['resize_script']) && $data['resize_script'] == 'Timthumb'){
		$image_align = '&amp;a='.$align;
	}
	$image_crop = '&amp;zc=1';
	$image_quality = '&amp;q=90';
	
	
	if(!empty($data['resize_script']) && $data['resize_script'] == 'Disable resize script'){
		$output = ''.$image_url.'';
	} else{
		$output = ''.$resize_script.''.$image_url.''.$image_width.''.$image_height.''.$image_align.''.$image_quality.''.$image_crop.'';
	}
	
	return $output;
	
}
















/* #MC Studios menu
================================================== */
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth ) {

		//In a child UL, add the 'dropdown-menu' class
		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		//Add class and attribute to LI element that contains a submenu UL.
		if ($args->has_children){
			$classes[] 		= 'dropdown';
			$li_attributes .= 'data-dropdown="dropdown"';
		}
		$classes[] = 'menu-item-' . $item->ID;
		//If we are on the current page, add the active class to that menu item.
		$classes[] = ($item->current) ? 'active' : '';

		//Make sure you still add all of the WordPress classes.
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		//Add attributes to link element.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle"  data-target="#"' : ''; 

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? ' <!--<b class="caret"></b>--> ' : ''; 
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	//Overwrite display_element function to add has_children attribute. Not needed in >= Wordpress 3.4
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) ) 
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
				unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);

	}

}
?>