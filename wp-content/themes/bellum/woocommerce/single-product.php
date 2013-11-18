<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @package WooCommerce
 * @since WooCommerce 1.0
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
		
		
		
		<section id="page-header" class="single-product-header">
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
			<div class="double-line"></div>
		</section><!-- end page-header -->
		
		
		
		
		
		
		
		
		<?php 
		/*=================================================================*/
		/* Print the product content
		/*=================================================================*/
		 ?>
		
		<div class="row-fluid">
			<section id="main-content" class="span8 woo-single-product">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>			
			</section><!-- end span8 -->
			
			
			
			<?php 
			//Inlude the sidebar
				 get_sidebar ('woocomercesidebar');			
			?>
		</div><!-- end row-fluid -->
		
		
		
		
		
		
		

	<?php
		/** 
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */	 
		do_action('woocommerce_after_main_content'); 
	?>
	
	<?php 
		/** 
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */		
		do_action('woocommerce_sidebar'); 
	?>
	
<?php get_footer('shop'); ?>