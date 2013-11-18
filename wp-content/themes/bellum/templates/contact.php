<?php global $mc_option; ?>
<section id="main" class="container page-content">		
	<?php 
	//Include the page header
	include( get_template_directory() . '/templates/page-header.php' );
	?>
	
		
		<?php if($mc_option['contact_page_map_top'] !== ''): ?>
		<div class="row-fluid" id="contactpage-map">
			<div class="map-holder span12">
				<!--
				Edit the data-target attribute with the full
				address that you want to display
				 -->
				<div id="contactmappagetop" class="gmap" data-target="<?php echo $mc_option['contact_page_map_top']; ?>" data-zoom="18" style="width: 100%; height: 290px;"></div>
			</div>
		</div><!-- end row-fluid -->
		<?php endif; ?>
		
		
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="<?php echo $mc_option['content_size']; ?>">
			<?php 
			/*=================================================================*/
			/* This part will display the page content
			/* depending on the current page
			/*=================================================================*/
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif;
			
			if ( comments_open() ) :
				echo '<div class="clear"></div>';
				comments_template();
			endif;?>		
			</section><!-- end main-content -->
							
							
			<?php 
			//Inlude the sidebar
			if($mc_option['page_size'] !== 'full') get_sidebar(); ?>
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->