<?php
$option = $block['block_options'];

$sidebar = $option['sidebar_name'];
$width = $option['sidebar_size'];

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

<section id="sidebar-<?php echo $sidebar; ?>" class="sidebar-block <?php echo $width; ?> adjust">
	<div class="row-fluid">
		<?php 
		if ($sidebar !== '' && $sidebar !== 'none') {
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) :
			endif;	
		} else {
			echo '<p>'.__('You need to specify a sidebar', 'mclang').'</p>';
		}
		?>
	</div><!-- end row-fluid -->
</section><!-- end sidebar-block -->