<aside id="sidebar" class="span4">
	
	<?php
	 	/* When we call the dynamic_sidebar() function, it'll spit out
		 * the widgets for that widget area. If it instead returns false,
		 * then the sidebar simply doesn't exist, so i hard-code in
		 * some default sidebar stuff just in case.
		 */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('woocomercesidebar') ) : ?>
	
											
		
		<?php endif; ?>
</aside>