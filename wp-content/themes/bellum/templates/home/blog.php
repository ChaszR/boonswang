<?php
$option = $block['block_options'];

$title = $option['blog_btitle'];

$link_text = $option['blog_link_text'];
$link_url = $option['blog_link_url'];



$posts = $option['blog_nposts'];
$width = $option['blog_size'];
$pdate = $option['blog_date'];
$pcomments = $option['blog_comments'];

 
if($posts == '')
 $posts = 3;

$excerpt = $option['blog_excerpt'];

if($excerpt == '')
	$excerpt = 20;

if(!empty($option['blog_categories'])){
	$cols_cats = $option['blog_categories'];
	$cats = implode(",", $cols_cats);
} else{
	$cols_cats = '';
	$cats = '';
}

if ($width == 'One third') {
	$width = 'span4';
} elseif ($width == 'Two Thirds') {
	$width = 'span8';	
} elseif ($width == 'One Half') {
	$width = 'span6';
} else {
	$width = 'span12';
}

if ($width == 'span12') {
	$postwidth = 'span4';
} else {
	$postwidth = '';
}


?>





<section class="from-blog <?php echo $width; ?> adjust">

	<div class="adjustsssss">
		
	<h3><?php echo $title; ?></h3>
	<?php if($link_text !== ''): ?>
	<a class="more" href="<?php echo $link_url; ?>"><?php echo $link_text; ?> +</a>
	<?php endif; ?>
	<div class="clear"></div>
		
		
		
	<div class="row-fluid">
	
	
		<?php
			 global $wp_query,$paged,$post;
			 $temp = $wp_query; 
			 $wp_query= null;
			 $wp_query = new WP_Query();
			 $wp_query = new WP_Query('posts_per_page='.$posts.'&cat='.$cats);
			 while ( $wp_query->have_posts() ) : $wp_query->the_post();
			 $external_url = get_post_meta( get_the_ID(), 'mc_external_url', true );
			 if($external_url !== ''){
				$postLink = $external_url;
			 } else{
				$postLink = get_permalink($post->ID);
			 }
			 $video_url = get_post_meta( get_the_ID(), 'mc_video_url', true );
			 $video_height = get_post_meta( get_the_ID(), 'mc_video_height', true );
			 
			 // Get the format of the current post
			 $format = get_post_format();
			 
			 if ( false === $format ){
			 	
			 	if (has_post_thumbnail()) {
			 		$icon = 'image';
			 	} else {
			 		$icon = '';
			 	}
			 
			 	
			 } elseif (has_post_format( 'gallery' )) {
			 	$icon = 'gallery';
			 } elseif (has_post_format( 'video' )) {
			 	$icon = 'video';
			 } elseif (has_post_format( 'audio' )) {
			 	$icon = 'audio';
			 } elseif (has_post_format( 'quote' )) {
			 	$icon = 'quote';
			 } elseif (has_post_format( 'link' )) {
			 	$icon = 'link';
			 } else {
			 	$icon = '';
			 }
			 
		?>
		
		
		
		
		<article <?php post_class($postwidth); ?>>
				<?php if(has_post_thumbnail()):?>
				<a href="<?php the_permalink();  ?>">
					<?php the_post_thumbnail( 'blog-thumb' ); ?>
				</a>
				<?php endif; ?>
				
				<h4><a href="<?php the_permalink();  ?>"><?php the_title(); ?></a></h4>
				<span class="date">
					<?php if($pdate == 'yes'){ echo get_the_date(); } ?>
				</span>
			
				
				
				<?php mc_excerpt($excerpt,'','all','plain','no'); ?>
			
		</article><!-- end post -->
		
		
		
		
		
		<?php 
			endwhile; 
			$wp_query = null; 
			$wp_query = $temp;
			wp_reset_query();
		?>
	</div><!-- end row-fluid -->
	
 </div><!-- end span -->	
</section><!-- end blog -->