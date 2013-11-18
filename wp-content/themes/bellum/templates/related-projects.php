<?php 
$orig_post = $post;
global $post;

$current_post_id = $post->ID;
$categories = get_the_terms( $post->ID, 'projects');

if (!empty($categories) && is_array($categories)) { 
	$thumb_width = 650;
	$thumb_height = 450;
?>

	<div class="double-line"></div>
									
	<section class="recent-works">
		<h3><?php _e('Related Works', 'mclang') ?></h3>
		<a class="more" href="#">Our Portfolio +</a>
		
		<div class="clear"></div>
		<div class="row-fluid">
		
	
			<?php 
				$cats = array();
				foreach ($categories as $category) {
					$cats[] = $category->slug;
				}	
				
				if(!empty($categories)){
					$args = array( 
						'post_type' => 'mcportfolio',
						'posts_per_page' => 4, 
						'orderby' => 'menu_order',
						'post__not_in' => array($current_post_id),
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => 'projects',
								'field' => 'slug',
								'terms' => $cats
							)
						)
					);
				} else{
					$args = array( 
						'post_type' => 'mcportfolio',
						'posts_per_page' => 4, 
						'post__not_in' => array($current_post_id),
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
				}		
				query_posts($args);
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				
					$terms = get_the_terms($post->ID, 'projects');
					if(!empty($terms)){
						$posted_cats = array(); 
						$posted_cats_slug = array(); 
						foreach ( $terms as $term ) { $posted_cats[] = $term->name; }
					} else{
						$posted_cats = '';
					}
					
					$link_type = get_post_meta( get_the_ID(), 'mc_linkto', true );
					$external_url = get_post_meta( get_the_ID(), 'mc_external_url', true );
					$force_single = get_post_meta( get_the_ID(), 'mc_force_single_link', true );
					
					
					if ($link_type == 'single') {
						$project_link = get_permalink($post->ID);
						$rel = '';
					} elseif ($link_type == 'lightbox') {
						$rel = 'rel="lightbox[gallery]"';
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

					$c1 = '';
					$c2 = '';
					$c3 = '';					
					if (is_array($posted_cats) && !empty($posted_cats)) {
						if (!empty($posted_cats[0])) {
							$c1 = $posted_cats[0];
						}
						if (!empty($posted_cats[1])) {
							$c2 = $posted_cats[1];
						}
						if (!empty($posted_cats[2])) {
							$c3 = $posted_cats[2];
						}
					}
				?>
				
				
					<div class="span3 project">
						<div class="post-thumbnail">
							<a href="<?php echo $project_link; ?>">
								<div class="plus">+</div>
								<span class="hover"></span>
								<img src="<?php echo mc_post_image('first','portfolio-thumb'); ?>" alt="<?php the_title(); ?>" width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>"/>
							</a>
						</div><!-- end post-thumbnail -->
						<h3 class="project-title post-title"><a href="<?php echo $project_link; ?>"><?php the_title(); ?></a></h3>
						
						<span class="georgia"><?php echo $c1; ?>, <?php echo $c2; ?>, <?php echo $c3; ?></span>
					</div><!-- end project -->
				
						
				<?php endwhile; endif; wp_reset_query();?>
		</div><!-- end row -->	
	</section><!-- end recent-works -->	
<?php
} ?>