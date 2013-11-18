<section id="main" class="container page-content">		
	<?php 
	global $mc_option;
	$page_options = $mc_option['page_options'];	
	//Include the page header	
	get_template_part( '/templates/page', 'header' );
	?>
	
	
			
		<div class="row-fluid">
			<section id="main-content" class="span12">
				
				
				<section id="blog" class="single-post full-post">
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
						// Get the format of the current post
						$format = get_post_format();
						$pclass = $format;
						$video_url = get_post_meta( get_the_ID(), 'mc_video_url', true );
						$video_height = get_post_meta( get_the_ID(), 'mc_video_height', true );
						if($video_height == ''){
							$video_height = '359';
						}
						$audio_mp3_url = get_post_meta( get_the_ID(), 'mc_audio_url', true );
						$audio_ogg_url = get_post_meta( get_the_ID(), 'mc_audio_url_ogg', true );
						$external_url = get_post_meta( get_the_ID(), 'mc_external_url', true );
						$quote_text = get_post_meta( get_the_ID(), 'mc_quote_text', true );
						$quote_author = get_post_meta( get_the_ID(), 'mc_quote_author', true );
						$source_title = get_post_meta( get_the_ID(), 'mc_source_title', true );
						$source_url = get_post_meta( get_the_ID(), 'mc_source_url', true );
						if($external_url !== ''){
							$postLink = $external_url;
						} else{
							$postLink = get_permalink($post->ID);
						}
						
						
								get_template_part( '/templates/post', get_post_format() );
							
							
							
						endwhile; endif;
					
						?>
					
					
					
						<div class="clear"></div>
						<div class="double-line"></div>	
						
						
						
						<?php 
						//Include the comments
						if($page_options['enable_comments'] == 'yes')
						comments_template(); ?>
					
					
					
					
				</section><!-- end blog -->
				
			</section><!-- end main-content -->
			<div class="clear"></div>
		</div><!-- end row-fluid -->
</section><!-- end main -->