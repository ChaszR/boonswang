<?php 
global $mc_option;
get_header();
?>
		
<section id="page-header">
				
		<?php if($mc_option['breadcrumb'] == 1): ?>
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
				
	<?php if ($mc_option['page_title']): ?>
		<h1><?php echo $mc_option['page_title']; ?></h1>
	<?php endif; ?>
	
	<?php if ($mc_option['page_desc']): ?>
		<p><?php echo stripslashes($mc_option['page_desc']); ?></p>
	<?php endif; ?>
	
	<div class="clear"></div>
	<div class="double-line"></div>
</section><!-- end page-header -->