<?php global $mc_option; ?>
<section id="main" class="container page-content">		
	<?php 
	//Include the page header
	get_template_part( '/templates/page', 'header' );	
	?>
	
		<div class="row-fluid">
			<section id="main-content" class="<?php echo $mc_option['content_size']; ?>" role="main">
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