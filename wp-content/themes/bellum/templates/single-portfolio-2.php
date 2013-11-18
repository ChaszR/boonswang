<?php 
global $mc_option;
$page_options = $mc_option['page_options'];
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>

<section id="main" class="container">

	<section id="flex-slider" class="initial-height">		  		
		<div class="container" class="flex-container">
			<!-- 
			Custoimize the slider settings
			you can change the effect to slide or fade
			data-bullets = thumbnails / normal / none
			 -->		
			<div id="fslider" class="flexslider" data-speed="<?php echo $page_options['slider_speed']; ?>" data-effect="slide" data-auto="<?php echo $page_options['slider_auto']; ?>" data-loop="true" data-bullets="thumbnails">
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
				
		</div><!-- end container -->				  			
	</section><!-- end #flex-slider -->		
		

					  
				
	<div id="single-portfolio" class="row-fluid project-content">
		<section id="main-content" class="span8">
						
			<h2 class="project-title"><?php the_title(); ?></h2>	
						
			<?php the_content(); ?>
			<br />			
						
			
			<?php 
			//Include Related Posts
			if($page_options['portfolio_related'] == 'yes')
				get_template_part( '/templates/related', 'projects' );
			
			
			
			//Enable Comments
			if($page_options['enable_comments'] == 'yes')
				comments_template();
			
			?>							
		</section><!-- end main-content -->
					
		
		<?php get_sidebar(); ?>			
										
	</div><!-- end row-fluid -->
</section><!-- end main -->
<?php endwhile; endif; ?>