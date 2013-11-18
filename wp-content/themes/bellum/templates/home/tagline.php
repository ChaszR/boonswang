<?php
$option = $block['block_options'];
$style = $option['tagline_style'];
$title = $option['tagline_title'];
$text = $option['tagline_text'];
$social_title = $option['tagline_lefttitle'];
$tagline_twitter = $option['tagline_twitter'];
$tagline_facebook = $option['tagline_facebook'];
$tagline_dribble = $option['tagline_dribble'];
$tagline_vimeo = $option['tagline_vimeo'];
$tagline_tumblr = $option['tagline_tumblr'];
$tagline_rss = $option['tagline_rss'];


$button_text = $option['tagline_button_text'];
$button_url = $option['tagline_button_url'];
$button_color = $option['tagline_button_color'];




if ($style == 'default') {
	$span = 'span8';
} elseif($style == 'withbutton') {
	$span = 'span8';
} else {
	$span = 'span12';
}
if ($style == 'full') {
	$centered = 'centered';
} else {
	$centered = '';
}
?>



<div class="row-fluid intro <?php echo $centered; ?>">
	<div class="<?php echo $span; ?>">
		<?php 
		if($title !== '') 
			echo '<h1>'.$title.'</h1>';
		if($text !== '') 
			echo '<p>'.nl2br(stripslashes($text)).'</p>';	
		?>
	</div><!-- end intro -->
	
	<?php if ($style == 'default'): ?>
	<div class="hsocial span4">
		<div class="pull-right">
			<p><?php echo $social_title; ?></p>
			<div class="clear"></div>
				<?php if($tagline_twitter !== ''): ?>
					<a class="social_icn twitter" href="http://twitter.com/<?php echo $tagline_twitter; ?>" target="_blank"><span>Twitter</span></a>
				<?php endif; ?>
				
				<?php if($tagline_facebook !== ''): ?>
					<a class="social_icn face" href="<?php echo $tagline_facebook; ?>" target="_blank"><span>Facebook</span></a>
				<?php endif; ?>
				
				<?php if($tagline_dribble !== ''): ?>
					<a class="social_icn dribble" href="<?php echo $tagline_dribble; ?>" target="_blank"><span>Dribble</span></a>
				<?php endif; ?>
				
				<?php if($tagline_vimeo !== ''): ?>
					<a class="social_icn vimeo" href="<?php echo $tagline_vimeo; ?>" target="_blank"><span>Vimeo</span></a>
				<?php endif; ?>
				
				<?php if($tagline_tumblr !== ''): ?>
					<a class="social_icn tumblr" href="<?php echo $tagline_tumblr; ?>" target="_blank"><span>Tumblr</span></a>
				<?php endif; ?>
				
				<?php if($tagline_rss == 'yes'): ?>
					<a class="social_icn rss" href="#"><span>RSS</span></a>
				<?php endif; ?>
		</div>
	</div><!-- end social -->
	<?php endif; ?>
	
	
	
	
	
	
	<?php if ($style == 'withbutton'): ?>
	<div class="hsocial span4">
		<div class="pull-right">
			
			<?php if($button_text !== ''): ?>
				<a class="nbtn <?php echo $button_color; ?> " href="<?php echo $button_url; ?>" title="<?php echo $button_text; ?>" target="_self"><span> <?php echo stripslashes($button_text); ?> </span></a>
			<?php endif; ?>
		</div>
	</div><!-- end social -->
	<?php endif; ?>
	
</div><!-- end row-fluid -->