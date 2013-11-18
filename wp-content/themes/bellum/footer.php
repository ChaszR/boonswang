<?php 
global $mc_option;
$footer_widgets = '';

if(!empty($mc_option["footer-widgets"])){
	$footer_temp = str_replace("footer", "", $mc_option["footer-widgets"]);
	$footer_widgets =  $footer_temp;
} else{
	$footer_widgets =  4;
}

if($footer_widgets == 2){
	$widget_size = 'span6';
} elseif ($footer_widgets == 3) {
	$widget_size = 'span4';
} else {
	$widget_size = 'span3';
}
if(!empty($mc_option["show_copyright"])){
	$show_copyright = $mc_option["show_copyright"];
} else {
	$show_copyright = '';
}
if(!empty($mc_option["footer_logo"])){
	$footer_logo = $mc_option["footer_logo"];
} else {
	$footer_logo = '';
}
if(!empty($mc_option["footer_twitter"])){$twitter = $mc_option["footer_twitter"];} else {$twitter = '';}
if(!empty($mc_option["footer_facebook"])){$face = $mc_option["footer_facebook"];} else {$face = '';}
if(!empty($mc_option["footer_rss"])){$rss = $mc_option["footer_rss"];} else {$rss = '';}
if(!empty($mc_option["footer_dribble"])){$dribble = $mc_option["footer_dribble"];} else {$dribble = '';}
if(!empty($mc_option["footer_vimeo"])){$vimeo = $mc_option["footer_vimeo"];} else {$vimeo = '';}
if(!empty($mc_option["footer_tumblr"])){$tumblr = $mc_option["footer_tumblr"];} else {$tumblr = '';}

$copyright = $mc_option["copyright"];
?>
 <footer id="footer">
			<div id="footer-stripe"></div>
			
			
			<div id="footer-container" class="container">
				<div class="row-fluid">
				
					<?php
						for ($i = 1; $i <= $footer_widgets; $i++) {
						 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer-widget-$i") ) : ?>
						<div class="widget <?php echo $widget_size; ?>">
							<h3>Footer Widget</h3>
							<div class="line"></div>
						<div class="text-widget">
						<p>Duis quis ipsum vehicula eros ultrices lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec nec sollicitudin felis. Donec vel nulla vel leo varius tempor.</p>
							
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc leo ligula, iaculis vel malesuada ut, imperdiet a velit.</p>
						</div>
							</div><!-- end of widget -->
					<?php 
					  endif;
					}
					?>
				</div><!-- end row-fluid -->
			</div><!-- end footer-container -->
			
			
			
			<?php if($show_copyright == 1): ?>
			
			<div id="copyright">
				<div class="line"></div>
				<div class="container">
					<div class="row-fluid">
						<div class="span6">
							<a id="footer-logo" href="<?php echo home_url(); ?>">
								<?php 
								if($footer_logo !== ''){
									$flogo = $footer_logo;
								} else {
									$flogo = get_template_directory_uri() .'/img/template/flogo.png';
								} ?>						
								<img src="<?php echo $flogo; ?>" alt="<?php bloginfo("name"); ?>"/>
							</a>
							<p><?php echo stripslashes($copyright); ?></p>
						</div><!-- end span6 -->
						
						<div class="span6">
							<div class="pull-right">
								<?php if($twitter == 1): ?>
									<a class="social_icn twitter" href="http://twitter.com/<?php echo $mc_option['header_twitter']; ?>" target="_blank"><span>Twitter</span></a>
								<?php endif; ?>
								<?php if($face == 1): ?>
									<a class="social_icn face" href="<?php echo $mc_option['header_face']; ?>" target="_blank"><span>Facebook</span></a>
								<?php endif; ?>
								<?php if($rss == 1): ?>
									<a class="social_icn rss" href="<?php if($mc_option["feedburner"] !==''){ echo $mc_option["feedburner"]; } else{ bloginfo('rss2_url'); }?>" target="_blank"><span>RSS</span></a>
								<?php endif; ?>
								<?php if($dribble == 1): ?>
									<a class="social_icn dribble" href="<?php echo $mc_option['header_dribble']; ?>" target="_blank"><span>Dribble</span></a>
								<?php endif; ?>
								<?php if($vimeo == 1): ?>
									<a class="social_icn vimeo" href="<?php echo $mc_option['header_vimeo']; ?>" target="_blank"><span>Vimeo</span></a>
								<?php endif; ?>
								<?php if($tumblr == 1): ?>
									<a class="social_icn tumblr" href="<?php echo $mc_option['header_tumblr']; ?>" target="_blank"><span>Tumblr</span></a>
								<?php endif; ?>
							</div>
						</div>
						
					</div><!-- end row-fluid -->
				</div><!-- end container -->
			</div><!-- end copyright -->
			
			<?php endif; ?>
			
		</footer>
		
		
		
		
	
	</div><!-- end wrapper -->
	
	  
	  
  

    <!-- Le javascript
     ================================================== -->
     <!-- Placed at the end of the document so the pages load faster -->
    
     <?php if ($mc_option["google_analytics"] !== '' || $mc_option['jquery_scripts'] !== ''): ?>
     	<script type="text/javascript">
     		<?php echo stripslashes($mc_option['google_analytics']); ?>
     		
     		<?php echo stripslashes($mc_option['jquery_scripts']); ?>
     	</script>
     <?php endif; ?>
      <?php wp_footer(); ?>
 </body>
</html>