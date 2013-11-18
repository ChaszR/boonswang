<?php
$option = $block['block_options'];
$columns = $option['columns_normal'];
//print_r($columns);
?>

<div class="row-fluid">
<?php 
if (!empty($columns)):
	$col_number = 1;
	foreach ($columns as $col): 
		$size = $col['col_size'];
		$title = $col['col_title'];
		$text = $col['col_text'];
	?>

	<div class="col <?php echo $size; ?>">
		<h3><?php echo $title; ?></h3>		
		<p><?php echo nl2br(stripslashes($text)); ?></p>
	</div><!-- end col -->
	
<?php 
	$col_number++;
	endforeach;
endif; ?>
</div><!-- end row-fluid -->