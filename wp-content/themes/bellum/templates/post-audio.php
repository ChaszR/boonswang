<?php 
/*=================================================================*/
/* Define some variables
/*=================================================================*/
global $mc_option;
$page_options = $mc_option['page_options'];

if (has_post_thumbnail()){
	$icon_type = 'image';	
}  else {
	$icon_type = 'text';
}

$video_url = get_post_meta( get_the_ID(), 'mc_video_url', true );
$video_height = get_post_meta( get_the_ID(), 'mc_video_height', true );
if($video_height == ''){
	$video_height = '359';
}
$audio_mp3_url = get_post_meta( get_the_ID(), 'mc_audio_url', true );
$audio_ogg_url = get_post_meta( get_the_ID(), 'mc_audio_url_ogg', true );
$external_url = get_post_meta( get_the_ID(), 'mc_external_url', true );


if($external_url !== ''){
	$postLink = $external_url;
} else{
	$postLink = get_permalink($post->ID);
}
?>



<?php 
/*=================================================================*/
/* Output the post
/*=================================================================*/
 ?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row-fluid">
		<div class="span1 post-icon-type">
			<div class="post-type audio"><span></span></div>
		</div><!-- end span2 -->
		
		
		<div class="span11 post-inner-content">
			<h2 class="post-title"><a href="<?php echo $postLink;  ?>"><?php the_title(); ?></a></h2>
			<span class="meta">
				<?php if($page_options['blog_author'] == 'yes'): ?>
				<?php _e('Posted by', 'mclang'); ?>  <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a> 
				<?php endif; ?>
				
				<?php if($page_options['blog_showcategories'] == 'yes'): ?>
				<?php _e('Posted in ', 'mclang');  the_category(', '); ?>  
				<?php endif; ?>
			</span>
			<div class="post-content">
			
			
				<audio class="media-audio post-top-audio" preload="auto" controls>
				
					<?php if($audio_mp3_url !== ''): ?>
						<source src="<?php echo $audio_mp3_url; ?>" />
					<?php endif; ?>
					
					<?php if($audio_ogg_url !== ''): ?>
						<source src="<?php echo $audio_ogg_url; ?>" />
					<?php endif; ?>
				</audio>
			
				
				
				<?php 
					if (is_sticky() && is_home() && ! is_paged()) {
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mclang' ), 'after' => '</div>' ) );
					} else {
						
						if(!is_single()){ 
							mc_excerpt($page_options['blog_excerpt'],'','all','plain','no'); 	
							echo '<a class="more" href="'.$postLink.'">'.__('Read more', 'mclang').' <span class="icon-plus"></span></a>';
						} 
						else{ 
							the_content(); 
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mclang' ), 'after' => '</div>' ) );
						}
					}
				?>
				
				<?php if($page_options['blog_share'] == 'yes'): ?>
					<div class="share">					
					<div class="social ttip sshare-facebook" data-url="<?php echo $postLink;  ?>" title="<?php _e('Like on Facebook', 'mclang'); ?>">F&#x200b;</div>
					<div class="social ttip sshare-twitter" data-url="<?php echo $postLink;  ?>" title="<?php _e('Share on Twitter', 'mclang'); ?>">T&#x200b;</div>
					<div class="social ttip sshare-google" data-url="<?php echo $postLink;  ?>" title="<?php _e('Share on Google+', 'mclang'); ?>">G&#x200b;</div>
					</div><!-- end share -->
				<?php endif; ?>
			</div><!-- end post-content -->										
		</div><!-- end span10 -->
		
	</div><!-- end row-fluid -->
</article><!-- end post -->

<?php if(!is_single()): ?>
<div class="line"></div>
<?php endif; ?>