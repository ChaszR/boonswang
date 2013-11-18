<section id="main" class="container page-content">		
	<?php 
	//Include the page header
	include( get_template_directory() . '/templates/page-header.php' );
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="span8">
			<?php 
			/*=================================================================*/
			/* This part will display the page content
			/* depending on the current page
			/*=================================================================*/
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			$button = get_post_meta( get_the_ID(), 'mc_project_showbutton', true );
			$button_text = get_post_meta( get_the_ID(), 'mc_project_link_text', true );
			$button_url = get_post_meta( get_the_ID(), 'mc_project_link_url', true );
			$button_color = get_post_meta( get_the_ID(), 'mc_project_link_color', true );
			?>
			
				<section id="blog">
					<article class="post first">
						<h2 class="post-title"><?php the_title(); ?></h2>

						<div class="post-content">
							<section id="flex-slider" class="initial-height">		  		
								<div class="containers" class="flex-container">
									<!-- 
									Custoimize the slider settings
									you can change the effect to slide or fade
									data-bullets = thumbnails / normal / none
									 -->		
									<div id="fslider" class="flexslider" data-speed="<?php echo $slider_speed; ?>" data-effect="slide" data-auto="<?php echo $slider_auto; ?>" data-loop="true" data-bullets="normal">
										<ul class="slides no-margin no-list">
											<?php 
											$project_images = mc_post_image('all');
											foreach ($project_images as $slide) {
												$image = $slide['src'];
												$title = $slide['title'];
												$video = $slide['video']; ?>
												
												
												<!-- Slide -->
												<li class="slide-holder">
													<div class="slide" data-thumbnail="<?php echo mcresize_image($image, '130', '87'); ?>">
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
											<?php }
											 ?>
										</ul>	
									
									</div><!-- end slider -->
										
								</div><!-- end container -->				  			
							</section><!-- end #flex-slider -->					
							<br />
							<?php the_content(); ?>																			
						</div><!-- end post-content -->
						
						
						
						
						<?php 
						//Include Related Posts
						if($related_projects == 'yes')
							include( get_template_directory() . '/templates/related-projects.php' ); 
						
						
						
						//Enable Comments
						if($enable_comments_portfolio == 'yes')
							comments_template();
						
						?>
						
						
						
					</article><!-- end post -->
				</section><!-- end blog -->

			<?php endwhile; endif;
			
			if ( get_post_custom_values('comments') ): 
				comments_template();
			endif;?>
			</section><!-- end main-content -->
							
							
			<?php 
			//Inlude the sidebar
			get_sidebar(); ?>
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->