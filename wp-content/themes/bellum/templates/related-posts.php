<div id="related-posts">
<h3>Related Posts</h3>



<?php 
global $post;
$categories = get_the_category($post->ID);

if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) 
		$category_ids[] = $individual_category->term_id;
		
		
		
		query_posts( array(
			'posts_per_page' => 4,
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID)
		));
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		
			<div class="related-post">

				
				<a href="<?php the_permalink();  ?>">
				<?php 
					if ( has_post_thumbnail() ) { 
						the_post_thumbnail( 'related-thumb' ); 
					} else {
						echo '<img src="'.get_template_directory_uri() .'/img/assets/post.jpg" alt=""/>';
					}
				?>
				</a>
				
				<a class="related-title" href="<?php the_permalink();  ?>"><?php the_title(); ?></a>
			</div>
		
		
		
		<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
		<?php endif;
		
		
}
wp_reset_query(); 
?>
</div><!-- end related-posts -->