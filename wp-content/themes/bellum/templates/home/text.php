<?php
$option = $block['block_options'];
$title = $option['text_title'];

if($title == '')
	$title = 'Block title';


$title_bg = $option['text_title_stripe'];
$width = $option['text_width'];

$content = $option['text_content'];


if ($width == 'One third') {
	$width = 'span4';
} elseif ($width == 'Two Thirds') {
	$width = 'span8';	
} elseif ($width == 'One Half') {
	$width = 'span6';
} else {
	$width = 'span12';
}

?>
	
	
<section class="text-section text-section-block <?php echo $width; ?> adjust">

	<?php if($title !== ''): ?>
		<div class="title">
			<h3 class="block-text-title"><?php echo $title; ?></h3>
			<?php if($title_bg == 'yes'): ?>
				<div class="double-line"></div>
			<?php endif; ?>
		</div><!-- end title -->
	<?php endif; ?>

			
	<div class="clear"></div>
	<p><?php echo nl2br(stripslashes($content)); ?><p/>
</section><!-- end text-section -->