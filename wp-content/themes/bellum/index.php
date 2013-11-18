<?php 
get_header();
global $mc_option;  
//print_r($mc_option);
?>
<section id="main" class="container">
		
	<?php
		/* This code will include the slider
		/* Selected in the Home page layout manager
		/* You can find the files in templates/home*/
		if(!empty($mc_option["homepage_layout"])){
			$layout = $mc_option["homepage_layout"];
			foreach ($layout as $block) {
				$order = $block['order'];
				$type = $block['title'];
								
				if($type == 'LayerSlider')
					include( get_template_directory() . '/templates/home/layers.php' );
					
				if($type == 'Nivo Slider')
					include( get_template_directory() . '/templates/home/nivo-slider.php' );
					
				if($type == 'Video Slider')
					include( get_template_directory() . '/templates/home/video-slider.php' );
																				
			}		
		}
	?>		
		
	<section id="main-content">
		<div class="row-fluid">
		<?php
				if(!empty($mc_option["homepage_layout"])){
					$layout = $mc_option["homepage_layout"];
					foreach ($layout as $block) {
						$order = $block['order'];
						$type = $block['title'];
											
						if($type == 'Tagline')
							include( get_template_directory() . '/templates/home/tagline.php' );		
											
						if($type == 'Numbered Columns')
							include( get_template_directory() . '/templates/home/numbered-columns.php' );
							
						if($type == 'Normal Columns')
							include( get_template_directory() . '/templates/home/normal-columns.php' );
							
						if($type == 'Tabs')
							include( get_template_directory() . '/templates/home/tabs.php' );
											
						if($type == 'Recent Projects')
							include( get_template_directory() . '/templates/home/projects.php' );
							
						if($type == 'Portfolio')
							include( get_template_directory() . '/templates/home/portfolio.php' );
											
						if($type == 'Testimonials')
							include( get_template_directory() . '/templates/home/testimonials.php' );
											
						if($type == 'Recent posts')
							include( get_template_directory() . '/templates/home/blog.php' );
											
						if($type == 'Clear')
							include( get_template_directory() . '/templates/home/clear.php' );
						
						if($type == 'Separator')
							include( get_template_directory() . '/templates/home/separator.php' );	
							
						if($type == 'Newsletter')
							include( get_template_directory() . '/templates/newsletter.php' );	
											
						if($type == 'Text')
							include( get_template_directory() . '/templates/home/text.php' );
							
						if($type == 'Sidebar')
							include( get_template_directory() . '/templates/home/sidebar.php' );																						
					}
				}
		?>
		</div><!-- end row-fluid -->	
	</section><!-- end main-content -->	
		
</section><!-- end main -->
<?php get_footer(); ?>