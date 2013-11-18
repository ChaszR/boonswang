<?php
$option = $block['block_options'];

$effect = $option['content_slider_effect'];
$speed = $option['content_slider_pause'];
$auto = $option['content_slider_auto'];
$slides = $option['content_slider_images'];
$bullets = $option['content_slider_bullets'];
if ($bullets == '') {
	$bullets = 'thumbnails';
}
if ($speed == '') {
	$speed = 8000;
}
if (!empty($slides)) {
?>
<section id="flex-slider" class="initial-height">
  		<div class="container" class="flex-container">
  			<!-- 
  			Custoimize the slider settings
  			you can change the effect to slide or fade
  			data-bullets = thumbnails / normal / none
  			 -->		
  			<div id="fslider" class="flexslider" data-speed="<?php echo $speed; ?>" data-effect="<?php echo $effect; ?>" data-auto="<?php echo $auto; ?>" data-loop="true" data-bullets="<?php echo $bullets; ?>">
  				<ul class="slides no-margin no-list">
  				
  				
  					<?php 
  						foreach ($slides as $slide):
  						  						
  							$image = $slide['url'];
  							$thumb = $slide['thumb'];
  							$title = $slide['title'];
  							$link = $slide['link'];
  							$video = $slide['video'];
  							$video_height = $slide['video_height'];
  							
  							if ($video_height == '') {
  								$video_height = 480;
  							}
  							
  							
  							if ($image !== ''):
  								
  								echo '<li class="slide-holder">';
  								echo '<div class="slide" data-thumbnail="'.$thumb.'">';
  								
  								//If a video is added in the slide
  								//Check the url to see if the video
  								//belongs to youtube or vimeo
  								if ($video !== '') {
  									$video_type = linkType($video);
  									
  									if ($video_type == 'youtube') {
  										$video_type = 'youtube';
  									}
  									if ($video_type == 'vimeo') {
  										$video_type = 'vimeo';
  									}
  									echo '<div class="'.$video_type.'-video" rel="'.$video.'" data-autoplay="true" data-width="1200" data-height="'.$video_height.'" data-color=""></div>';
  								} 
  								//If there are no videos just display
  								//the image and the link if necessary
  								else {
  									if ($link !== '')
  										echo '<a href="'.$link.'">';
  										echo '<img src="'.$image.'" alt="'.$title.'"/>';
  									if ($link !== '')
  										echo '</a>';
  								}
  								echo '</div>';	
  								echo '</li>';
  							endif;
  						endforeach;
  					 ?>
  				</ul>	
  			</div><!-- end slider -->				
  		</div><!-- end container -->
</section><!-- end #flex-slider -->	
<?php 
}
?>