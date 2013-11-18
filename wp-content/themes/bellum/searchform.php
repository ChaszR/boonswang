<div class="search-form">
	<form id="search" name="search" method="get" action="<?php echo home_url(); ?>/">
		<input name="s" type="text" id="s" value="<?php _e('Enter your search here', 'mclang'); ?>" onblur="if (this.value == ''){this.value = '<?php _e('Enter your search here', 'mclang'); ?>'; }" onfocus="if (this.value == '<?php _e('Enter your search here', 'mclang'); ?>') {this.value = ''; }" />
		<input name="" type="submit" value="" class="search_button" />
	</form><!--END search-->
</div>