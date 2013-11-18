<?php if (has_post_thumbnail()){
	$icon_type = 'image';	
}  else {
	$icon_type = 'text';
}?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row-fluid">
		<div class="span1 post-icon-type">
			<div class="post-type <?php echo $icon_type; ?>"><span></span></div>
		</div><!-- end span2 -->
		
		
		<div class="span11 post-inner-content">
			<h2 class="post-title"><a href="<?php echo $postLink;  ?>"><?php the_title(); ?></a></h2>
			<span class="meta">
				<?php if($post_author == 'yes'): ?>
				<?php _e('Posted by', 'mclang'); ?>  <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a> 
				<?php endif; ?>
				
				<?php if($post_categories == 'yes'): ?>
				<?php _e('Posted in ', 'mclang');  the_category(', '); ?>  
				<?php endif; ?>
			</span>
			<div class="post-content">
			
			
				<?php if(has_post_thumbnail()): ?>
					<a href="<?php echo $postLink;  ?>">
						<img class="img-thumbnail" src="<?php echo thumb_url(); ?>" alt="" />
					</a>
				<?php endif; ?>
			
				
				
				<?php 
					if (is_sticky() && is_home() && ! is_paged()) {
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mclang' ), 'after' => '</div>' ) );
					} else {
						
						if(!is_single()){ 
							mc_excerpt($blog_excerpt,'','all','plain','no'); 	
							echo '<a class="more" href="'.$postLink.'">'.__('Read more', 'mclang').' <span class="icon-plus"></span></a>';
						} 
						else{ 
							the_content(); 
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mclang' ), 'after' => '</div>' ) );
						}
					}
				?>
				
				
				<?php if (is_single()) {
					echo '<div id="post-tags"><p class="icon-tags"></p>';
					the_tags('',', ');
					echo '</div>';
				} ?>
				
				
				<?php if($post_share == 'yes'): ?>
					<div class="share">					
					<div class="social ttip sshare-facebook" data-url="<?php echo $postLink;  ?>" title="<?php _e('Like on Facebook', 'mclang'); ?>">F&#x200b;</div>
					<div class="social ttip sshare-twitter" data-url="<?php echo $postLink;  ?>" title="<?php _e('Share on Twitter', 'mclang'); ?>">T&#x200b;</div>
					<div class="social ttip sshare-google" data-url="<?php echo $postLink;  ?>" title="<?php _e('Share on Google+', 'mclang'); ?>">G&#x200b;</div>
					</div><!-- end share -->
				<?php endif; ?>
			</div><!-- end post-content -->										
		</div><!-- end span10 -->
		
	</div><!-- end row-fluid -->
</article><!-- end post -->


<?php 
if (is_single()) {	
	echo previous_post_link('<strong class="pull-left">%link</strong>');
	echo next_post_link('<strong class="pull-right">%link</strong>');
}
 ?>



<?php if(!is_single()): ?>
<div class="line"></div>
<?php endif; ?>