<?php 
$option = $block['block_options'];

if (isset($option['separator_style'])) {
	$style = $option['separator_style'];	
} else {
	$style = '';
}


if ($style == 'double') {
	$style = 'double-line';
} else {
	$style == 'line';
}

if (isset($option['separator_top'])) {$margin_top = $option['separator_top'];	} 
else { $margin_top = '';}
if (isset($option['separator_bottom'])) {$margin_bottom = $option['separator_bottom'];	} 
else { $margin_bottom = '';}


if ($margin_top == '') {
	$margin_top = '10';
}
if ($margin_top <= 10) {
	$margin_top = '10';
}

if ($margin_bottom == '') {
	$margin_bottom = '10';
}
if ($margin_bottom <= 10) {
	$margin_bottom = '10';
}

?>
<div class="clear"></div>
<div class="<?php echo $style; ?>" style="margin-top: <?php echo $margin_top; ?>px; margin-bottom: <?php echo $margin_bottom; ?>px;"></div>