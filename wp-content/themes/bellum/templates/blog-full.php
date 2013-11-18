<section id="main" class="container page-content">
	<?php 
	global $mc_option;
	$page_options = $mc_option['page_options'];
	
	
	//Include the page header	
	get_template_part( '/templates/page', 'header' );
	
	
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="span12">
			<?php 
			/*If text is added to the page dysplay it here*/
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				//the_content();
			endwhile; endif;
			?>
			
				
				<section id="blog">
					<?php
						if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;
							}
						$count = 1;		
						query_posts( array(
							'cat' => $page_options['blog_categories'],
							'posts_per_page' => $page_options['blog_nposts'],
							'order' => ''.$page_options['blog_order'].'',
							'orderby' => ''.$page_options['blog_orderby'].'',
							'paged' => $paged
						));
						if ( have_posts() ) : while ( have_posts() ) : the_post(); 
						
						// Get the format of the current post
						$format = get_post_format();
						$pclass = $format;
						if($count == 1){
							$pclass = 'first ' .$format;
						}
						if(is_single()){
							$pclass = 'first';
						}	
					
						get_template_part( '/templates/post', get_post_format() );
					?>
					
					<?php $count++; endwhile; else: ?>
					<p>Sorry, no posts matched your criteria.</p>
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
							
		
			<div class="clear"></div>
							
							
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->