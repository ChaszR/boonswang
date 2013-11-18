<?php 
$option = $block['block_options'];
if (isset($option['clear_top'])) {
	$margin_top = $option['clear_top'];	
} else {
	$margin_top = '';
}
if (isset($option['clear_bottom'])) {
	$margin_bottom = $option['clear_bottom'];	
} else {
	$margin_bottom = '';
}
?>

<div class="clear" style="margin-top: <?php echo $margin_top; ?>px; margin-bottom: <?php echo $margin_bottom; ?>px;"></div>