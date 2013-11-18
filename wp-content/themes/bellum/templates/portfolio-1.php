<section id="main" class="container page-content">		
	<?php 
	global $mc_option;
	$page_options = $mc_option['page_options'];
	
	
	//Include the page header	
	get_template_part( '/templates/page', 'header' );
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="<?php echo $mc_option['content_size']; ?>">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif;?>	
				<div class="row-fluid">
					
					
					
						
				
					<section id="portfolio-one">
						
							
							<?php 
								/*This part of the code just creates the loop to display
				 				 the portfolio projects based on the settings you entered in
				 				 the theme options panel, if you want to edit the html
				 				 you will have to go to includes/templates and edit the
				 				 html of portfolio-one.php, portfolio-two.php, etc.
				 				 i'm 99.9% sure that you don't have to ediy the code below
				 				*/						 
				 				global $wp_query,$paged,$post;
				 				if ( get_query_var('paged') ) {
				 					$paged = get_query_var('paged');
				 				} elseif ( get_query_var('page') ) {
				 					$paged = get_query_var('page');
				 				} else {
				 					$paged = 1;
				 				}
				 				if(!empty($page_options['portfolio_categories'])){
				 					$args = array( 
				 						'post_type' => 'mcportfolio',
				 						'posts_per_page' => $page_options['portfolio_nposts'], 
				 						'orderby' => 'menu_order',
				 						'order' => 'ASC',
				 						'tax_query' => array(
				 							array(
				 								'taxonomy' => 'projects',
				 								'field' => 'slug',
				 								'terms' => $page_options['portfolio_categories']
				 							)
				 						),
				 						'paged' => $paged
				 					);
				 				} else{
				 					$args = array( 
				 						'post_type' => 'mcportfolio',
				 						'posts_per_page' => $page_options['portfolio_nposts'], 
				 						'orderby' => 'menu_order',
				 						'order' => 'ASC',
				 						'paged' => $paged
				 					);
				 				}		
				 				query_posts($args);
				 				$count = 1;
				 				if ( have_posts() ) : while ( have_posts() ) : the_post();
				 				$position = '';
				 				
				 				$link_type = get_post_meta( get_the_ID(), 'mc_linkto', true );
				 				$external_url = get_post_meta( get_the_ID(), 'mc_external_url', true );
				 				$force_single = get_post_meta( get_the_ID(), 'mc_force_single_link', true );
				 				
				 				
				 				if ($link_type == 'single') {
				 					$project_link = get_permalink($post->ID);
				 					$rel = '';
				 				} elseif ($link_type == 'lightbox') {
				 					$rel = 'rel="lightbox[gallery'.$count.']"';
				 					$project_link = mc_lightbox();
				 				} elseif ($link_type == 'external') {
				 					$project_link = $external_url;
				 					$rel = '';
				 				} else {
				 					$project_link = get_permalink($post->ID);
				 					$rel = '';
				 				}
				 				//get the categories of each project to enable filtering
				 				$terms = get_the_terms($post->ID, 'projects');
				 				if(!empty($terms)){
				 					$posted_cats = array(); 
				 					$posted_cats_slug = array(); 
				 					foreach ( $terms as $term ) { $posted_cats[] = $term->name; }
				 					foreach ( $terms as $term ) { 
				 						$slug = $term->slug;
				 						$slug = str_replace('-', '', $slug);
				 						$posted_cats_slug[] = $slug; 
				 					}
				 				} else{
				 					$posted_cats = '';
				 				}		
	
				 				$thumb_width = 650;
				 				$thumb_height = 420;
				 			?>										 				
										 		
							
							
							
							<div <?php post_class('full-project-holder'); ?>>
							
									
									<div id="fslider<?php the_ID(); ?>" class="flexslider" data-speed="9999999" data-effect="slide" data-auto="false" data-loop="true" data-bullets="none">
										<ul class="slides no-margin no-list">
											<?php 
											$attachments = new Attachments( 'mcattachments' , $post->ID);						
											if( $attachments->exist() ) :
												$icount = 1;
												while( $attachments->get() ) : 
												$image = $attachments->src('full');
												$title = $attachments->field('title');
												$video = $attachments->field('video');
												$image_thumb = $attachments->src('slider-thumb');
												?>
												
												
												<li class="slide-holder">
													<div class="slide" data-thumbnail="<?php echo $image_thumb; ?>">
													<?php if($video !== ''){ 
														$link_type = linkType($video);
														if ($link_type == 'vimeo') {
															echo '<div class="vimeo-video" rel="'.$video.'" data-autoplay="true" data-width="1200" data-height="480" data-color=""></div>';
														} elseif ($link_type == 'youtube') {
															echo '<div class="youtube-video" rel="'.$video.'" data-autoplay="true" data-width="1200" data-height="480" data-color=""></div>';
														} else {
															echo '<a href="'.$video .'"><img src="'.$image .'" alt="'.$title.'"/></a>';
														}
														?>
													<?php } else { ?>
														<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/>
													<?php } ?>
												
													</div><!-- end slide -->
												</li>	
												<?php endwhile;
											endif;
											 ?>
										</ul>	
									
									</div><!-- end slider -->
									
									
									<a <?php echo $rel; ?> href="<?php echo $project_link; ?>">
									<?php if($page_options['portfolio_project_title'] == 'yes'): ?>		 				
										<h3 class="project-title post-title"><?php the_title(); ?> <span class="icon-plus"></span></h3>
									<?php endif; ?>
									<?php if($page_options['portfolio_project_categories'] == 'yes'): ?>		 				
										<span class="georgia project-categories"><?php if(!empty($posted_cats)) echo join( " ", $posted_cats ); ?></span>
									<?php endif; ?>	
									</a>
									
									
									<?php 
									if($page_options['portfolio_project_description'] == 'yes'):
										mc_excerpt($page_options['portfolio_project_description_words'],'','all','plain','no'); 	
									endif; ?>
									
									
									
									<?php 
									 if($link_type == 'lightbox'):
										echo mc_lightbox_gallery($rel);
									 endif;
									 ?>
									
									
							
							</div><!-- end full-project-holder -->			
							
							
						
										 			
										 			
						<?php 
						$count++;
						endwhile; endif;
						?>										 					
					</section><!-- end portfolio-one -->
				
					
					
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
				
				</div><!-- end row-fluid -->
			</section><!-- end main-content -->
							
							
			<?php 
			//Inlude the sidebar
			if($mc_option['page_size'] !== 'full') get_sidebar(); ?>
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->