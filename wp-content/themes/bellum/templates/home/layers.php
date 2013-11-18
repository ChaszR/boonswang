<?php
$option = $block['block_options'];
$layersID = $option['layersliderid'];
//print_r($slides);
if ($layersID !== '') {
?>
<div id="homepage-layers">
	
	<?php echo do_shortcode('[layerslider id="'.$layersID.'"]'); ?>
	
</div><!-- end nivo-slider -->	
<?php 
}
?>