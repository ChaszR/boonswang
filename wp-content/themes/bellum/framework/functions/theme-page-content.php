<?php
/* =============================================================================
   Function to display the content of the page, 
   ========================================================================== */
function mcstudios_page_content($type, $size) {
	
	if($page_type == 'normal'){ ?>
			<?php include( get_template_directory() . '/page.php' ); ?>
	<?php }
	
	if($page_type == 'portfolio'){ ?>
			<?php include( get_template_directory() . '/portfolio.php' ); ?>
	<?php }
}
?>