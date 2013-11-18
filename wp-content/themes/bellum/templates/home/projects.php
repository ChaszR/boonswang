<?php
$option = $block['block_options'];
$title = $option['portfolio_title'];

if($title == '')
	$title = 'Recent Works';

$project_title = $option['portfolio_titles'];
$project_cats = $option['portfolio_slugs'];

$description = $option['portfolio_description'];

$effect = $option['portfolio_hovereffect'];

$link_text = $option['portfolio_link_text'];
$link_url = $option['portfolio_link_url'];


$columns = $option['portfolio_columns'];

if(!empty($option['portfolio_categories'])){
	$categories = $option['portfolio_categories'];
} else{
	$categories = array();
}

$posts_per_page == '';
if ($columns == 'span3') {
	$posts_per_page = 4;
} elseif ($columns == 'span4') {
	$posts_per_page = 3;
} else {
	$posts_per_page = 2;
}

$thumb_height = 650;
$thumb_width = 820;
?>



<section class="recent-works">	
	<h3><?php echo $title; ?></h3>
	
	<?php if($link_text !== ''): ?>
	<a class="more" href="<?php echo $link_url; ?>"><?php echo $link_text; ?> +</a>
	<?php endif; ?>
	<div class="clear"></div>

			<div class="row-fluid">
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
			 				if(!empty($categories)){
			 					$args = array( 
			 						'post_type' => 'mcportfolio',
			 						'posts_per_page' => $posts_per_page, 
			 						'orderby' => 'menu_order',
			 						'order' => 'ASC',
			 						'tax_query' => array(
			 							array(
			 								'taxonomy' => 'projects',
			 								'field' => 'slug',
			 								'terms' => $categories
			 							)
			 						),
			 						'paged' => $paged
			 					);
			 				} else{
			 					$args = array( 
			 						'post_type' => 'mcportfolio',
			 						'posts_per_page' => $posts_per_page, 
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
			 		
			 		
						<div class="project <?php echo $columns; ?>">
			 				<a <?php echo $rel; ?> href="<?php echo $project_link; ?>">
			 				<div class="post-thumbnail">
			 						<?php if($effect !== 'none'): ?>
			 						<div class="plus">+</div>
			 						<span class="hover color-hover"></span>
			 						<?php endif; ?>
			 						<img src="<?php echo mc_post_image('first','portfolio-thumb'); ?>" alt="" width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>"/>
			 				</div><!-- end post-thumbnail -->
			 				
			 				<?php if($project_title == 'yes'): ?>		 				
				 				<h3 class="project-title post-title"><?php the_title(); ?></h3>
				 			<?php endif; ?>
				 			<?php if($project_cats == 'yes'): ?>		 				
				 				<span class="georgia project-categories"><?php if(!empty($posted_cats)) echo join( " ", $posted_cats ); ?></span>
				 			<?php endif; ?>	
			 				</a>
			 				
			 				
			 				<?php 
			 				if($description == 'yes'):
								mc_excerpt(15,'','all','plain','no'); 	
			 				endif; ?>
			 				
			 				
			 				
			 				<?php 
			 				 if($link_type == 'lightbox'):
			 					echo mc_lightbox_gallery($rel);
			 				 endif;
			 				 ?>
			 			</div>
			 			
			 			
			 			<?php 
			 			$count++;
			 			endwhile; endif;
			 			wp_reset_query();
			 			?>				
			
									
			</div><!-- end row -->					  				
	
</section><!-- end recent-works -->