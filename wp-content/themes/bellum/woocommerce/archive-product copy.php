<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @package WooCommerce
 * @since WooCommerce 1.0
 * @todo replace loop-shop with a content template and include query/loop here instead.
 */

get_header('shop'); 
include( get_template_directory() . '/includes/theme-settings.php' );
?>
	  
	<?php 
		/** 
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */	 
		do_action('woocommerce_before_main_content');
	?>
	
	
	
	
	
	
	<?php 
	$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
	$woocomerce_page_id = $shop_page->ID;
	
	if (!empty($shop_page)) {
		$sidebar = get_post_meta( $woocomerce_page_id, 'mc_sidebar', true );
		if ($sidebar == 'hide') {
			$page_size = 'full';
		} else {
			$page_size == 'normal';
		}
		
		
		if ($page_size == 'full') {
			$content_size = 'span12';
		} else {
			$content_size = 'span8'; 
		}
		
		
		
	} else {
		
	}
	
	
	
	
	/*=================================================================*/
	/* Display the page header
	/*=================================================================*/
	if (!empty($shop_page) || is_object( $shop_page )): 
		$woocomerce_page_id = $shop_page->ID;
		$page_title = get_post_meta( $woocomerce_page_id, 'mc_page_title', true );
		$page_desc = get_post_meta( $woocomerce_page_id, 'mc_page_subtitle', true );
		if ($page_title == '') {
			$page_title = $shop_page->post_title;
		}
	
	?>
	
		<section id="page-header">
				<?php if($breadcrumb == 1): ?>
				<div class="breadcrumbs">
					<?php
					if (function_exists('show_full_breadcrumb')) show_full_breadcrumb(
					    array(
					        'labels' => array(
					            'local'  => __('', 'mclang'), // set FALSE to hide
					            'home'   => __('Home', 'mclang'),
					            'page'   => __('Page', 'mclang'),
					            'tag'    => __('Tag', 'mclang'),
					            'search' => __('Search', 'mclang'),
					            'author' => __('Author', 'mclang'),
					            '404'    => __('Error 4040, not found', 'mclang')
					        ),
					        'separator' => array(
					            'element' => 'span',
					            'class'   => 'separator icon-double-angle-right',
					            'content' => ''
					        ), // set FALSE to hide
					        'home' => array(
					            'showLink' => true
					        )
					    )
					);
					?>
				</div>	
				<?php endif; ?>
			<div class="clear"></div>
						
			<?php if ($page_title): ?>
				<h1><?php echo $page_title; ?></h1>
			<?php endif; ?>
			
			<?php if ($page_desc): ?>
				<p><?php echo stripslashes($page_desc); ?></p>
			<?php endif; ?>
			
			<div class="clear"></div>
			<div class="double-line"></div>
		</section><!-- end page-header -->
	<?php endif; ?>
	
	
	
	
	
	
	
	
	
	
	<div id="wooshop" class="row-fluid">
		<section id="main-content" class="<?php echo $content_size; ?>">
		
			
			
			<?php 
			/*=================================================================*/
			/* Display the woocomerce code
			/*=================================================================*/
			 ?>
				
				
				<?php if ( is_tax() && get_query_var( 'paged' ) == 0 ) : ?>
							<?php echo '<div class="term-description">' . wpautop( wptexturize( term_description() ) ) . '</div>'; ?>
						<?php elseif ( ! is_search() && get_query_var( 'paged' ) == 0 && ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
							<?php echo '<div class="page-description">' . apply_filters( 'the_content', $shop_page->post_content ) . '</div>'; ?>
						<?php endif; ?>
								
						<?php if ( have_posts() ) : ?>
						
							<?php do_action('woocommerce_before_shop_loop'); ?>
						
							<ul class="products">
							
								<?php woocommerce_product_subcategories(); ?>
						
								<?php while ( have_posts() ) : the_post(); ?>
						
									<?php woocommerce_get_template_part( 'content', 'product' ); ?>
						
								<?php endwhile; // end of the loop. ?>
								
							</ul>
				
							<?php do_action('woocommerce_after_shop_loop'); ?>
						
						<?php else : ?>
						
							<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
									
								<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
									
							<?php endif; ?>
						
						<?php endif; ?>
						
						<div class="clear"></div>
				
						<?php 
							/** 
							 * woocommerce_pagination hook
							 *
							 * @hooked woocommerce_pagination - 10
							 * @hooked woocommerce_catalog_ordering - 20
							 */		
							do_action( 'woocommerce_pagination' ); 
						?>
						
						
						
			
		</section><!-- end main-content -->
						
						
		<?php 
		//Inlude the sidebar
		if($page_size !== 'full'){
			 get_sidebar ('woocomercesidebar');			
		} ?>
		<div class="clear"></div>
	</div><!-- end row-fluid -->
	
	
	
	
	
	
	
	
	
	
	
			
		
				
		

	<?php
		/** 
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */	 
		do_action('woocommerce_after_main_content'); 
	?>

	

<?php get_footer('shop'); ?>