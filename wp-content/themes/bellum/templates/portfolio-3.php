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
				the_content();
			endwhile; endif;
			?>
			
				<?php 
				/*=================================================================*/
				/* Include the filter bar if required
				/*=================================================================*/
				
				if($page_options['portfolio_filter'] == 'yes'):
				 ?>
			 	
			 	<section id="filter-bar" class="visible-desktop visible-tablet">
			 			<ul id="filters" class="no-margin no-list">
			 					<li><?php _e('Filter by:','mclang'); ?></li>
			 					<li><a href="#" data-filter="*" class="selected"><?php _e('All','mclang'); ?></a></li>	
			 					<?php
			 					$cats = get_categories('taxonomy=projects&show_count=0&title_li=');
			 					foreach ((array)$cats as $cat) {
			 						$slug = get_category ($cat);
			 						$catdesc = $cat->category_description;
			 						$slug = $slug->slug;
			 						if(!empty($page_options['portfolio_categories'])){
			 							if(in_array($slug, $page_options['portfolio_categories'])){
			 								$slug = str_replace('-', '', $slug);
			 								echo '<li><a href="#" data-filter=".'. $slug .'">'. $cat->cat_name .'</a></li>';
			 							}
			 						} else{
			 								$slug = str_replace('-', '', $slug);
			 								echo '<li><a href="#" data-filter=".'. $slug .'">'. $cat->cat_name .'</a></li>';
			 						}
			 					}//end foreach
			 					?>
			 			</ul>		
			 	</section><!-- end filter-bar -->
			 	<?php endif; ?>
			 	
			 	
			 	
			 	
			 	<section id="portfolio" class="span12 three-cols">
			 		<ul id="portfolio-projects" class="no-margin no-list" data-liffect="zoomOut">
			 		
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
			 		
			 		
			 			<li class="project span4 <?php if(!empty($posted_cats_slug)) echo join( " ", $posted_cats_slug ); ?>">
			 				<a <?php echo $rel; ?> href="<?php echo $project_link; ?>" title="<?php echo mc_lightbox_title(); ?>">
			 				<div class="post-thumbnail">
			 						<?php if($page_options['portfolio_effect'] !== 'none'): ?>
			 						<div class="plus">+</div>
			 						<span class="hover color-hover"></span>
			 						<?php endif; ?>
			 						<img src="<?php echo mc_post_image('first','portfolio-thumb'); ?>" alt="" width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>"/>
			 				</div><!-- end post-thumbnail -->
			 				
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
			 			</li>
			 			
			 			
			 			<?php 
			 			$count++;
			 			endwhile; endif;
			 			?>
			 		</ul> <!-- end portfolio-projects -->
			 	</section><!-- end portfolio -->
			 	
			 	
			 	
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
		</div><!-- end row-fluid -->
</section><!-- end main -->