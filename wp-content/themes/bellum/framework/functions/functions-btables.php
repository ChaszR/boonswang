<?php
/**
 * MC Studios Back-end Tables
 * This code creates custom back-end tables and reordering
 *
 * @author		Manuel Cervantes
 * @copyright	Copyright (c) Manuel Cervantes - MC Studios
 * @link		http://mcstudiosmx.com
 * @link		http://mcstudiosmx.com
 * @since		Version 1.1
 * @package 	MCFramework
 * @version 	Incarnation-Edition (Sub: Eunoia 1.2 Edit)

*/ 


/**
* Function mccutsom_back_end_tables_css
* This function modify the default post table in the backend
* basically the function uses add_action admin_head to add the code;
*/
if(!function_exists('mccutsom_back_end_tables_css'))
{
	function mccutsom_back_end_tables_css() {
	   	
	   	echo'
	   	<style>
	   		th#pthumb{
	   			width: 80px;
	   		}
	   		th#sthumb{
	   			width: 25px;
	   		}
	   		.mcpost-thumb{
	   			padding: 3px 3px 6px;
	   			background-color: #fffeff;
	   			border: 1px solid #e9e9e9;
	   			float: left;
	   			margin-top: 2px;
	   			margin-bottom: 7px;
	   		}
	   		.mcpost-thumb img{
	   			padding: 0;
	   			margin-bottom: -3px;
	   			width: 45px;
	   			height: 45px;
	   			float: left;
	   		}
	   		.mcportfolio td,
	   		.mcportfolio th.check-column{
	   			padding-top: 18px !important;
	   		}
	   	</style>';
	}
   add_action('admin_head', 'mccutsom_back_end_tables_css');
}




/**
* Function mccutsom_back_end_tables_css
* This function modify the default post table in the backend
* basically the function uses add_action admin_head to add the code;
*/
if(!function_exists('mc_custom_fields'))
{
	function mc_custom_fields() {
				if(get_post_type() == 'page' || get_post_type() == 'post' || get_post_type() == 'mcportfolio'){
					echo'
						<script>
						jQuery(document).ready(function(){
							//jQuery(function(){ jQuery(".fancy select.rwmb-select").uniform(); });
							
							if (jQuery("#post-formats-select").length > 0){
								jQuery(".rwmb-field").hide();
								var active_sett =	jQuery("#post-formats-select input.post-format:checked").val();
									if(active_sett == 0){
										active_sett = "normal";
									}
								jQuery(".rwmb-field."+active_sett+"-field").show();
								jQuery(".show-always").show();
								
								
								jQuery("#post-formats-select input").click(function(){
									var active_sett =	jQuery("#post-formats-select input.post-format:checked").val();
									if(active_sett == 0){
										active_sett = "normal";
									}
									jQuery(".rwmb-field").hide();
									jQuery(".rwmb-field."+active_sett+"-field").show();
									
									jQuery(".show-always").show();
								});								
							}	
							
							
							
							
							
							jQuery(".rwmb-select").each(function(){
								jQuery(this).wrap("<div class=\'select-wrapper\' />");
							});
							
							
							jQuery(".select-wrapper").each(function(){
								jQuery(this).find("select").before("<span class=\'select-header\'></span>");
							});
							
							
							
							jQuery(".select-wrapper select").each(function(){
								var optionText = jQuery("option:selected", this).text();								
								jQuery(this).closest(".select-wrapper").find("span.select-header").text(optionText);
							});
							
							jQuery(".select-wrapper select").live("change", function(){
								var optionText = jQuery("option:selected", this).text();
								jQuery(this).closest(".select-wrapper").find("span.select-header").text(optionText);
							});
							
							
							
							
							
							
							
							
							
							/*jQuery("#mcstudios_portfolio_options .inside .rwmb-field").hide();
							jQuery("#mcstudios_portfolio_options .inside .rwmb-field").first().before("<a id=\'portfolio-button\' class=\'button button-primary button-large\' href=\'#\'>Current Project Options</a>");
							jQuery("#mcstudios_portfolio_options .inside .rwmb-field").first().before("<a id=\'portfolio-button-close\' class=\'button button-primary button-large\' href=\'#\'>Close Project Options</a>");
							jQuery("#portfolio-button-close").hide();
							
							
							//Portfolio button click
							jQuery("#portfolio-button").live("click", function(e){
								e.preventDefault();
								jQuery(this).hide();
								
								
								jQuery("#mcstudios_portfolio_options select").each(function(){
									var selected_val = jQuery("option:selected", this).val();
									jQuery("."+selected_val).show().addClass("displayed");
								});
								
								
									jQuery("#mcstudios_portfolio_options .inside .rwmb-field").each(function(){
										if(jQuery(this).hasClass("parent") || jQuery(this).hasClass("displayed")){
											jQuery(this).fadeIn();
										} else{
											
										}
									});	
									
									jQuery("#portfolio-button-close").fadeIn();	
							});
							
							
							//Portfolio button close
							jQuery("#portfolio-button-close").live("click", function(e){
								e.preventDefault();
								
								jQuery(this).hide();
								
									jQuery("#mcstudios_portfolio_options .inside .rwmb-field").each(function(){
										jQuery(this).hide();
									});
									
								jQuery("#portfolio-button").fadeIn();	
							});
							
							*/
							
							
							
							
							//Hide all the blocks below the parent
							jQuery(".parent select option").each(function(){
								var selected_val = jQuery(this).val();
								
								jQuery("."+selected_val).hide();
							});
							
							//Show the selected block
							jQuery(".parent select").each(function(){
								var selected_val = jQuery("option:selected", this).val();
								jQuery("."+selected_val).show().addClass("displayed");
							});
							
							
							
							
							
							jQuery(".parent select").live("change", function(){
								var selected_val = jQuery("option:selected", this).val();
								if( jQuery("."+selected_val).length > 0 ){
									jQuery(this).closest(".parent").nextUntil(".parent").slideDown();
								} else {
									jQuery(this).closest(".parent").nextUntil(".parent").slideUp();
								} 
							});
							
						
							
							
							
							
							
							
							
							
						});
						</script>';
				}
	} 
	add_action('admin_head', 'mc_custom_fields');
}










/**
* Function mccutsom_back_end_tables_js
* This function modify the default post table in the backend
* basically the function uses add_action admin_head to add the code;
*/
if(!function_exists('mccutsom_back_end_tables_js'))
{
	function mccutsom_back_end_tables_js() {
	   	
	   	echo '
	   	<script>
	   	jQuery(document).ready(function() {
	   	 	if (jQuery(".wp-list-table tbody .column-pthumb").length > 0 || jQuery(".wp-list-table tbody .column-sthumb").length > 0) {
	   	 		jQuery(".wp-list-table").attr("id", "portfolio-table");
	   	 		
	   	 		var fixHelper = function(e, ui) {
	   	 			ui.children().each(function() {
	   	 				jQuery(this).width(jQuery(this).width());
	   	 			});
	   	 			return ui;
	   	 		};
	   	 		
	   	 		jQuery("#portfolio-table tbody").sortable({
	   	 				helper: fixHelper,
	   	 				update: function(event, ui) { 
	   	 				
	   	 				
	   						var new_order = jQuery("#portfolio-table tbody").sortable("toArray").toString();
	   						var regex = new RegExp("post-","g")
	   							new_order = new_order.replace(regex, "");
	   	 						
	   	 					opts = {
	   	 						url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
	   	 						type: "POST",
	   	 						async: true,
	   	 						cache: false,
	   	 						dataType: "json",
	   	 						data:{
	   	 							action: "mcsavepost_order", // Tell WordPress how to handle this ajax request
	   	 							order: new_order // Passes IDs of list items in	1,3,2 format
	   	 						},
	   	 						success: function(response) {
	   	 							return; 
	   	 						},
	   	 						error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
	   	 							alert("There was an error saving the updates");
	   	 							jQuery("#loading-animation").hide(); // Hide the loading animation
	   	 							return; 
	   	 						}
	   	 					};
	   	 					jQuery.ajax(opts);
	   	 				}
	   	 		}).disableSelection();
	   	 	}
	   	 	
	   	 	
	   	 	
	   	 	
	   	 	
	   	 	
	   	 	
	   	});
	   	</script>';
	}
   add_action('admin_head', 'mccutsom_back_end_tables_js');
}








/**
* Function mc_save_post_order
* This function saves the order of the posts
* basically the function uses wp_ajax_function_name
*/
if(!function_exists('mc_save_post_order'))
{
	function mc_save_post_order() {
	   	global $wpdb; // WordPress database class
	   	
	   	$order = explode(',', $_POST['order']);
	   	$counter = 0;
	   	
	   	foreach ($order as $video_id) {
	   		$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $video_id) );
	   		$counter++;
	   	}
	   	die(1);
	}
	add_action('wp_ajax_mcsavepost_order', 'mc_save_post_order');
}







/**
* Function mc_postorderby
* This function displays the new post order
* basically the function uses add_filter
*/
if(!function_exists('mc_postorderby'))
{
	function mc_postorderby($orderby){
		global $wpdb;
	
		if (is_admin())
		$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
	
		return($orderby);
	}
	add_filter( 'posts_orderby', 'mc_postorderby');
}
?>