<?php
$option = $block['block_options'];
$columns = $option['tabs'];
//print_r($columns);
?>


<?php if(!empty($columns)): ?>
<div id="services" class="tabs">
<div class="row-fluid htabs">

	<ul class="nav nav-tabs span3 horizontal-tabs" id="myTab">	
	<?php 
	$number = 1;
	foreach ($columns as $col): 
	if ($number == 1) {
		$active = 'active';
	} else {
		$active = '';
	}
	?>
		<li class="<?php echo $active; ?>"><a href="#service<?php echo $number; ?>"><?php echo $col['tab_title']; ?></a></li>
	<?php 
	$number++;
	endforeach;
	?>
	</ul>
	
	
	
	<div class="tab-content span9">
		<?php 
		$number = 1;
		foreach ($columns as $col): 
			if ($number == 1) { $active = 'active';} 
			else { $active = ''; }
		?>	
		
					
					<!-- tab -->
					<div class="tab-pane service-block <?php echo $active; ?>" id="service<?php echo $number; ?>">
					 <div class="row-fluid">
					 	
					 	<h3><?php echo $col['tab_title']; ?></h3>
					 	<p><?php echo nl2br(stripslashes($col['tab_text'])); ?></p>
					 </div><!-- end row-fluid -->	
					</div><!-- end Service -->
					
					
		
		<?php
		$number++;
		 endforeach; ?>	
	</div><!-- end tab-content -->
	
	
</div><!-- end htabs -->
</div><!-- end services -->
<?php endif; ?>