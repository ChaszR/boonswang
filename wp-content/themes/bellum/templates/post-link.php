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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row-fluid">
		<div class="span1 post-icon-type link-format-post">
			<div class="post-type link"><span></span></div>
		</div><!-- end span2 -->
		
		
		<div class="span11 post-inner-content">
			
			<div class="post-content">
			
			
				<div class="link-format">
					<?php the_content(); ?>
				</div><!-- end quote -->
			
				
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