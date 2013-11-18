<?php global $mc_option;
$page_options = $mc_option['page_options'];
?>

<section id="main" class="container page-content">		
	<?php 
	//Include the page header
	get_template_part( '/templates/page', 'header' );	
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="span12">
					
					
					<section id="services" class="blog">
						<div class="row-fluid htabs">
							
						<ul class="nav nav-tabs span3 horizontal-tabs" id="myTab">	
						<?php
							//Pint the services menu
							global $wp_query,$paged,$post;
							if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;
							}
							if(!empty($page_options['service_categories'])){
								$args = array( 
									'post_type' => 'mcservices',
									'posts_per_page' => $page_options['service_nposts'],
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'tax_query' => array(
										array(
											'taxonomy' => 'service',
											'field' => 'slug',
											'terms' => $page_options['service_categories']
										)
									),
									'paged' => $paged
								);
							} else{
								$args = array( 
									'post_type' => 'mcservices',
									'posts_per_page' => $page_options['service_nposts'], 
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'paged' => $paged
								);
							}
							query_posts($args);
							$count = 1;
							if ( have_posts() ) : while ( have_posts() ) : the_post();
							if ($count == $page_options['service_active_tab']) {
								$active = 'active';
							} else {
								$active = '';
							}
						?>
						
							<li class="<?php echo $active; ?>"><a href="#service<?php echo $count; ?>"><?php the_title(); ?></a></li>
							<?php $count++; endwhile; else: endif; ?>
						</ul>
						
						
						
						
						
						
						
						
						
						<div class="tab-content span9">
							<?php
								//Print the services
								if ( get_query_var('paged') ) {
									$paged = get_query_var('paged');
								} elseif ( get_query_var('page') ) {
									$paged = get_query_var('page');
								} else {
									$paged = 1;
								}
								
								if(!empty($page_options['service_categories'])){
									$args = array( 
										'post_type' => 'mcservices',
										'posts_per_page' => $page_options['service_nposts'],
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'service',
												'field' => 'slug',
												'terms' => $page_options['service_categories']
											)
										),
										'paged' => $paged
									);
								} else{
									$args = array( 
										'post_type' => 'mcservices',
										'posts_per_page' => $page_options['service_nposts'],  
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'paged' => $paged
									);
								}
								query_posts($args);
								$count = 1;
								if ( have_posts() ) : while ( have_posts() ) : the_post(); 		
								
								
								$service_intro = get_post_meta( get_the_ID(), 'mc_service_intro', true );
								
								
								if ($count == $page_options['service_active_tab']) {
									$active = 'active';
								} else {
									$active = '';
								}
							?>
						
						
						
							<!-- Service -->
							<div class="tab-pane service-block <?php echo $active; ?>" id="service<?php echo $count; ?>">
							 <div class="row-fluid">
							 		
							 		<h2 class="service-title"><?php the_title(); ?></h2>
							 		
							 		<?php if($page_options['service_top_link_text'] !== ''): ?>						 		
								 		<a class="nbtn <?php echo $page_options['service_top_link_color']; ?> top-service-btn" href="<?php echo $page_options['service_top_link_url']; ?>"><span><?php echo $page_options['service_top_link_text']; ?></span></a>
							 		<?php endif; ?>
							 		
							 		<div class="clear"></div>
							 		<div class="line"></div>							 		
							 		
							 		
									<?php the_content(); ?>		
							 </div><!-- end row-fluid -->	
							</div><!-- end Service -->
						
						 <?php $count++; endwhile; else: endif; ?>
						 
						</div><!-- end tab-content -->
						
						
						</div><!-- end row-fluid -->
					</section>

					
					
			</section><!-- end main-content -->
			
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->