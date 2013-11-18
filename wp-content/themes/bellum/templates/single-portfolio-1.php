<?php 
global $mc_option;
$page_options = $mc_option['page_options'];
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>

<section id="main" class="container">
	<section id="single-portfolio" class="full-portfolio">
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
				  
				  
		<section id="main-content">
			<div class="row-fluid">
			
				<div id="single-project-content" class="span12">
					<br />
					
					<?php the_content(); ?>
				
				</div><!-- end span12 -->
			
			
				
			</div><!-- end row-fluid -->
						
						
						
						
			<?php 
			//Include Related Posts
			if($page_options['portfolio_related'] == 'yes')
				get_template_part( '/templates/related', 'projects' );
			
			
			//Enable Comments
			if($page_options['enable_comments'] == 'yes')
				comments_template();
			
			?>
			
			
						
		</section><!-- end main-content -->						
	</section><!-- end single-portfolio -->
</section><!-- end main -->
<?php endwhile; endif; ?>