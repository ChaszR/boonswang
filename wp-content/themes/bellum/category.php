<?php get_header();  ?>
<section id="main" class="container page-content">
	<?php 
	global $mc_option;
	$page_options = $mc_option['page_options'];
	
	
	//Include the page header	
	get_template_part( '/templates/page', 'header' );
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="<?php echo $mc_option['content_size']; ?>">
				<section id="blog" class="normal-style">
					<?php
						$count = 1;		
						if ( have_posts() ) : while ( have_posts() ) : the_post(); 	
					?>
					
					<?php 
						get_template_part( '/templates/post', get_post_format() );
					?>
					
					<?php $count++; endwhile; else: ?>
					<p><?php  echo __('Sorry, no posts matched your criteria.', 'mclang'); ?></p>
					<?php endif; ?>
										
				</section><!-- end blog -->
								
								
				<div class="clear"></div>
					<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
							<div id="postsNav" class="navigation nav-portfolio rights">
							
							 <div class="pagination_links">
									<div class="visible-desktop visible-tablet">
									<?php mc_pagination($wp_query->max_num_pages); ?>
									</div>		
							 </div><!-- end pagination_links -->		
							</div><!-- #nav-below -->
					<?php } ?>
				<div class="clear"></div>
			
			
			
							
				
			</section><!-- end main-content -->
							
							
			<?php 
			//Inlude the sidebar
			if($mc_option['page_size'] !== 'full') get_sidebar(); ?>
			<div class="clear"></div>
							
							
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->
<?php get_footer(); ?>