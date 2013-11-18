<?php
$option = $block['block_options'];
$effect = $option['nivo_slider_effect'];
$speed = $option['nivo_slider_pause'];
$auto = $option['nivo_slider_auto'];
$slides = $option['nivo_slider_images'];
$height = $option['nivo_slider_height'];
//print_r($slides);
if ($speed == '') {
	$speed = 7000;
}
if (!empty($slides)) {
?>
<div id="homepage-nivoslider" class="slider-wrapper theme-default" data-effect="<?php echo $effect; ?>" data-speed="<?php echo $speed; ?>" data-auto="<?php echo $auto; ?>" style="height: <?php echo $height; ?>px ;">
	<div id="slider" class="nivoSlider">
	
		<?php 
		foreach($slides as $slide): 
			$image = $slide['url'];
			$title = $slide['title'];
			$link = $slide['link'];	
			
			if($image !== ''):
			
			if($link !== '') echo '<a href="'.$link.'">';
		?>
			<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
		<?php 
			if($link !== '') echo '</a>';
			endif;
			endforeach; ?>
		
	</div><!-- end #slider -->
</div><!-- end nivo-slider -->	
<?php 
}
?>