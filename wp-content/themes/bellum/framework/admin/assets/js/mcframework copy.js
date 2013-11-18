/**
 * MCStudios Options Framwork
 *
 * Do not redistribute without permission
 * Code created by Manuel - MC Studios 
 * http://mcstudiosmx.com
 */
jQuery.noConflict();

jQuery(document).ready(function($){

	/*=================================================================*/
	/* MC Studios demo data importer
	/*=================================================================*/
	
	$('#import-demo-data').on('click',function(e){
		e.preventDefault();
		
		var site_url = $(this).attr('data-siteurl');
		var install_url = $(this).attr('data-installurl');
		
		
		var answer = confirm("Importing the demo data will overwrite your current Theme Options settings, Proceed anyways?")
		if (answer){
			
			
			
			$('#import-loader').fadeIn();
			$('#demo-data-holder p.note').slideDown();
			$('#import-demo-data').addClass('disabled');
			
			
			//console.log(site_url+"/wp-admin/admin.php?import=mcstudiosinstalldemocontent");
			
			//return false;
			
			
			/*=================================================================*/
			/* Import the demo data xml file content
			/*=================================================================*/
			var request = $.ajax({
			    	url: site_url+"/admin.php?import=mcstudiosinstalldemocontent",
					type: "post",
					data: ""
			  	});			    
			    // callback handler that will be called on success
			    request.done(function (response, textStatus, jqXHR){
			    
			    	
			    		/* #Import the demo options data
				    	================================================== */
				    	var mcstudios_default_theme_options = $('#default_theme_options_data').val();
				    	
				    	//Add the default theme options data to the database


					   $('#export_data').val(mcstudios_default_theme_options);
					    	
					    setTimeout(function() {
				    		$('#import-loader').fadeOut();
			    			$('#demo-data-holder p.note').html('The demo content was imported correctly, the page will be refreshed to display the new settings.');
			    				
			    				
			    			var clickedObject = $('#of_import_button');
			    			var clickedID = $('#of_import_button').attr('id');			
			    			var nonce = $('#security').val();
			    					
			    			var import_data = $('#default_theme_options_data').val();
			    				
			    			var data = {
			    				action: 'of_ajax_post_action',
			    				type: 'import_options',
			    				security: nonce,
			    				data: import_data
			    			};
			    								
			    			$.post(ajaxurl, data, function(response) {
			    				var fail_popup = $('#of-popup-fail');
			    				var success_popup = $('#of-popup-save');
			    						
			    				//check nonce
			    				if(response==-1){ //failed
			    					fail_popup.fadeIn();
			    					window.setTimeout(function(){
			    						fail_popup.fadeOut();                        
			    					}, 2000);
			    				}		
			    				else {
			    					success_popup.fadeIn();
			    					window.setTimeout(function(){
			    						location.reload();                        
			    					}, 1000);
			    				}						
			    			});
			    		}, 2000); 	
	
			    			
				});
			    
			    // callback handler that will be called on failure
			   	request.fail(function (jqXHR, textStatus, errorThrown){
			   		alert('There was an error, please reload the page and try again');
				});
	
			
		}
		else{

		}
	});





	jQuery('.of-small-block .page-name-selector select').each(function(){
		var optionText = jQuery('option:selected', this).text();		
		var topTitlte = jQuery(this).closest('.of-small-block').attr('id');
		jQuery('#'+topTitlte+' .pages_header strong').text(optionText);
	});
	
	jQuery('.page-name-selector select').live('change', function(){
		var optionText = jQuery('option:selected', this).text();
		var topTitlte = jQuery(this).closest('.of-small-block').attr('id');
		jQuery('#'+topTitlte+' .pages_header strong').text(optionText);
	});	
	
	
	

	//delays until AjaxUpload is finished loading
	//fixes bug in Safari and Mac Chrome
	if (typeof AjaxUpload != 'function') { 
			return ++counter < 6 && window.setTimeout(init, counter * 500);
	}
	
	//hides warning if js is enabled			
	$('#js-warning').hide();
	

	
	
	
	/* =============================================================================
	/* Framework Main Menu
	/* This code builds the menu, submenus
	/* and fire panels on click
	/*  ========================================================================== */
	$('.group').hide();
	
	
	/* #Build Submenu
	================================================== */
	$('#of-nav li.heading-menu').each(function(i) {
		var submenus = $(this).nextUntil(".heading-menu");
		if (submenus.length > 0) {
			var submenus = $(this).nextUntil(".heading-menu").addClass('optsubmenu').addClass('option-submenu'+i);
			$(this).append('<ul class="submenu"></ul>');
			
			var submenu_options = [];
			$('li.optsubmenu').each(function() {
				if ($(this).hasClass('option-submenu'+i)) {
					submenu_options.push($(this).html());
				}
			});
			var submenu_html = '';
			jQuery.each(submenu_options, function(i, val) {
				
				//Create the submenu class
				var submenu_name_class = val + "";
					submenu_name_class = $(submenu_name_class).attr('href');
					submenu_name_class = submenu_name_class.replace('#', '');

			    submenu_html += '<li class="suboption '+submenu_name_class+'">'+val+'</li>';
			});
			$(this).find('.submenu').append(submenu_html);	
			$(this).nextUntil(".heading-menu").remove();
			
			
			/*Append the generated templates to the menu*/
			var templates_menus = [];
			$('#mctemplate_builder-list .of-input').each(function() {
				templates_menus.push($(this).val());
			});
			var templates_submenu_html = '';
			jQuery.each(templates_menus, function(i, val) {
				
				var template_href = val.toLowerCase().replace(/[\*\^\'\!]/g, '').split(' ').join('');
			    templates_submenu_html += '<li class="suboption of-option-'+template_href+'"><a href="#of-option-'+template_href+'"><span></span>'+val+'</a></li>';
			});
			$('#of-nav .templates-menu').find('.submenu').append(templates_submenu_html);
		}
	});
	
				
	/* #First run activate panel
	================================================== */			
	$('#of-nav li.heading-menu').promise().done(function( arg1 ) {
	  // Display last current tab	
	  if ($.cookie("of_current_opt") === null) {
	  	//Activate the first options block
	  	$('.group').eq(1).fadeIn('slow');	
	  	/*if($('.group:first').is(':empty')) {
	  	    $('.group').eq(1).fadeIn('fast');        
	  	} else {
	  		$('.group:first').fadeIn('fast');
	  	}*/
	  	$('#of-nav li:first').addClass('current').addClass('expanded');
	  	$('#of-nav li.current').find(".submenu").slideDown(800);
	  	$('#of-nav li.current .suboption').first().addClass('current');
	  } else {
	  	
	  	var last_active_tab = $.cookie("of_current_opt");
	  	$(last_active_tab).fadeIn();
	  			
	  	var last_active_menu = last_active_tab.replace('#','.');
	  	
	  	if ($(last_active_menu).hasClass('heading-menu')) {
	  		
	  	} else {
	  		$(last_active_menu).addClass('current');
	  		$('#of-nav .suboption.current').parent().slideDown(800);
	  		$('#of-nav .suboption.current').parent().parent().addClass('current').addClass('expanded');
	  	}	
	  }
	});
	
	
	
	/* #Main menu click function show panel create cookie
	================================================== */
	$('#of-nav li a').live('click', function(evt){	
		//If already active return false
		if ($(this).parent().hasClass('current')) { return false; }
			
		//Get the href attribute
		var clicked_group = $(this).attr('href');
			
		//Functionality if heading menu
		if ($(this).parent().hasClass('heading-menu')) {
			if (!$(this).parent().find('ul.submenu').length > 0) {
				$('.group').hide();
				$(clicked_group).fadeIn('fast');
			} 
			if ($(this).parent().find('ul.submenu li.current').length > 0) {
				return false;	
			}
		}
			
		//Submenu
		if ($(this).parent().hasClass('suboption')) {
			$('.group').hide();
			$(clicked_group).fadeIn('fast');
		}
			
		$('#of-nav li').removeClass('current');	
		$(this).parent().addClass('current');
			
			
		if($('#of-nav li.current').hasClass('heading-menu')){
			$('#of-nav ul.submenu').slideUp(200);	
			$('#of-nav li.current').find('ul.submenu').slideDown(200);
		}
		
		
		if($(this).parent().hasClass('suboption')){
			//Create a cookie to save the active group
			$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });
		}
		
		return false;
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
			


	
	
	
	
	
	
			
			
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Jquery Styled Inputs
	/* This code enables styled inpts
	/* like selects, checkbox, radios, etc.
	/*  ========================================================================== */
	
	
	/* #Masked Inputs
	================================================== */
	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();
	
	
	
	
	/* #Select Inputs
	================================================== */
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').live('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init();
	})
	})(jQuery);
	
	
	
	/* #Checkbox Inputs
	================================================== */
	$(".checkbox").iButton();
	
	
	
	/* #Multiselect with checkboxes
	================================================== */
	jQuery.fn.multiselect = function() {
	    $(this).each(function() {
	        var checkboxes = $(this).find("input:checkbox");
	        checkboxes.each(function() {
	            var checkbox = $(this);
	            // Highlight pre-selected checkboxes
	            if (checkbox.attr("checked"))
	                checkbox.parent().addClass("multiselect-on");
	 
	            // Highlight checkboxes that the user selects
	            checkbox.click(function() {
	                if (checkbox.attr("checked"))
	                    checkbox.parent().addClass("multiselect-on");
	                else
	                    checkbox.parent().removeClass("multiselect-on");
	            });
	        });
	    });
	};
	$(".checkbox_wrapper_multiple").multiselect();
	
	
	
	/* #Radio Inputs
	================================================== */
	//$(":radio").not(':of-radio-img-radio').iButton();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Toggle Content - class slide_body
	/* This code enables enable toggle
	/* for slides, template builder, etc.
	/*  ========================================================================== */
	
	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide(); 
	
	
	
	$('.mctemp-library').each(function(i) {
		$(this).attr('id', 'media-library-manager-'+i);
	});

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").live( 'click', function(){
		
		
		$('.mctemp-library').remove();
		
		/* #This commented code
		/*is used to display the media library
		/* it's disabled for now but the code still works
		================================================== 
		if ($(this).parent().next().find('.mcstudios_media_list').length > 0) { //If media manager
		
		
			//Hide the first slide if there are more than 1
			$('.mcstudios_media_list').each(function(){
				var id = jQuery(this).attr('id');		
				if(jQuery('#'+id+' li').size() >= 2){
					jQuery('#'+id+' li.first-media-slide').hide();
				}
			});
		
			
			$(this).parent().next().find('.mctemp-library').empty();
			var media_library = $('#media-library-files').html();
			
			//Create media library and start pagination
			$(this).parent().next().find('.mctemp-library').append('<div class="page_navigation"></div><div class="clear"></div>'+media_library);
			//enable list
			var full_media_librar_list = $(this).parent().next().find('.mctemp-library').attr('id');
			$('#'+full_media_librar_list ).pajinate({
								items_per_page : 12,
								nav_label_first : '<<',
								nav_label_last : '>>',
								nav_label_prev : '<',
								nav_label_next : '>'
							});
			full_media_library();
		}*/
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false;
	});	
	
	
	
	
	/* =============================================================================
	/* Fold fields
	/* This code creates folded fields
	/* ex. if option selected show this.
	/*  ========================================================================== */
	function foldFields() {
		jQuery('.fold').hide();
		jQuery('.fold.first').show();
		
		jQuery('.fold.first').each(function () {
			var $this = jQuery(this);
			var selected_fold_visible = jQuery('option:selected', this).val();
			
			if (selected_fold_visible.length == 0 ) {
				selected_fold_visible = jQuery(this).find('option').first().val();
			}
			
			//Update the visible inputs on start
			// Animation complete.
			/*$this.nextUntil(".fold.last").each(function() {
				if (jQuery(this).hasClass(selected_fold_visible)) {
					jQuery(this).show();
				}
			});*/
			
			$this.nextAll('.fold').each(function() {
			    if (jQuery(this).hasClass('fold')) {
			      if (jQuery(this).hasClass(selected_fold_visible)) {
			        jQuery(this).show();
			      } else {
			      	jQuery(this).hide();
			      }
			    }    
			});
			
			
			//Update the visible inputs on change
			jQuery(this).find('select').change(function() {
				var fold_visible = jQuery('option:selected', this).val();	
				$this.nextAll('.fold').each(function() {
				    if (jQuery(this).hasClass('fold')) {
				      if (jQuery(this).hasClass(fold_visible)) {
				      
				      	if (jQuery(this).is(':visible')) {
				      		
				      	} else {
				      		jQuery(this).slideDown();
				      	} 
				        //jQuery(this).show();
				      } else {
				      	//jQuery(this).hide();
				      	jQuery(this).slideUp();
				      }
				    }    
				});
			});
		});
	};
	
	foldFields();
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Slide Header Name
	/* This code updates the header name
	/* while the user is typing.
	/*  ========================================================================== */
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}
	$('.of-slider-title').live('keyup', function(){
		update_slider_title(this);
	});
	
	
	
	
	
	//Contact Form blocks title
	$('.inputtitle input').each(function() {
		var input_title = $(this).val();
		if (input_title !== '') {
			$(this).parent().parent().parent().parent().parent().parent().find('strong').text(input_title);
		}
	});
	function update_contact_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parents('.layout-block').find('strong').text(element.value);
		}, 100);
		return true;
	}
	$('.inputtitle input').live('keyup', function(){
		update_contact_title(this);
	});
		
		
	//Sidebars title
	function update_sidebars_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parents('.of-small-block').find('strong').text(element.value);
		}, 100);
		return true;
	}
	$('.sidebar_title .of-slider-title').live('keyup', function(){
		update_sidebars_title(this);
	});
	
	
	
	
	
	
	//Columns title
	$('.subslide .col_title').each(function() {
		var input_title = $(this).val();
		if (input_title !== '') {
			$(this).closest('.subslide').find('strong').text(input_title);
		}
	});
	function update_columns_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).closest('.subslide').find('strong').text(element.value);
		}, 100);
		return true;
	}
	$('.subslide .col_title').live('keyup', function(){
		update_columns_title(this);
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* #Remove Slides
	================================================== */
	$('.slide_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	
	
	/* #Remove Subslides
	================================================== */
	$('.subslide_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li.subslide');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* #Template Builder
	================================================== */
	$(".mc_create_template").live('click', function(e){
		e.preventDefault();
		
		//alert('test');
		
		var template_name_input = $(this).attr('rel');
		
		var template_manager = template_name_input;
		
		
		console.log(template_name_input);
		
		//If name is empty
		if( $('#'+template_name_input).val().length == 0 ) {
			$('#'+template_name_input).addClass('mc-error');
			return false;
		}
		
		//If name is correct
		$('#'+template_name_input).removeClass('mc-error');
		
		//Save the original template name
		var template_name = $('#'+template_name_input).val();
		var min_template_name = template_name.toLowerCase().replace(/[\*\^\'\!]/g, '').split(' ').join('-');
		
		
		//Get the template field id
		var tfield_id = $('#'+template_name_input).attr('id');
		
		//Check if there are other templates created
		if( $('#'+tfield_id+'-list').is(':empty')){
			//Get the template field name
			var tfield_name = $('#'+template_name_input).attr('name');
				tfield_name = increment_last(tfield_name);
		
		} else {
			//Get the template field name
			var tfield_name = $('#'+tfield_id+'-list .of-input').last().attr('name');
				tfield_name = increment_last(tfield_name);
		}
		
		//tfield_name = tfield_name.replace('[0]', '[1]');
		var new_template = '<input class="of-input" name="'+tfield_name+'" type="text" value="'+template_name+'" />';
		
		//Append the input with the template name and order to save in the database
		$('#'+template_name_input+'-list').append(new_template);
		
		//Empty the value of generator
		$('#'+template_name_input).val('');
		
		
		
		/* Append the new template
		* to the parent submenu
		*/
		var template_menu = '<li class="suboption"><a title="'+template_name+'" href="#of-option-'+min_template_name+'"><span></span>'+template_name+'</a></li>';
		$('#of-nav .templates-menu .submenu').append(template_menu);
		
		
		
		/* Append the Template
		* Options to main content
		*/
		
		var available_blocks = $('#'+template_manager+'-blocks-available').html();
		
		var options_html = '<div class="group" id="of-option-'+min_template_name+'" style="display: none;"><h2>'+template_name+'</h2>';
			 options_html += '<div id="section-'+min_template_name+'_layout" class="section section-page_layout">';
				 options_html += '<h3 class="heading">'+template_name+' Template</h3>';
				 options_html += '<div class="option">';
					 options_html += '<div class="controls">';
					  options_html += '<div class="slider layout_manager">';
					 	options_html += available_blocks;
					 	
					 	
					 	options_html += '<ul id="'+min_template_name+'_layout-list"></ul>';	
					 	
					  options_html += '</div>';//end slider	
					 options_html += '</div>';
					
					 options_html += '<div class="explain">Create the form the way you want</div>';
					 options_html += '<div class="clear"></div>';
				 options_html += '</div>';
			 options_html += '</div>';
		 options_html += '</div>';	
		

		
		$('#main #content').append(options_html);
		
	});
	
	
	
	//Thew new blocks are created in the templates tab
	//with this code we will move it to the main content
	$('#mctemplate_builder-blocks .group').each(function() {
		$(this).appendTo('#content');
	})
	
	
	
	//
	$(".mc_add_block").live('click', function(e){
		
		e.preventDefault();
		
		$('.ajax-load-block').fadeIn();
		
		var slidesContainer = $(this).attr('rel');
		var sliderId = slidesContainer;
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var builder_id = $(this).attr('data-builderid');
		var template_number = $(this).attr('data-templatenumber');
		var template_name = $(this).attr('data-templatename');
		
		
		var optSelected = $('#'+sliderId+'-selector option:selected').val();
		var slectedMinus = optSelected.toLowerCase().replace(/ /g, '');
		
		var numArr = $('#'+sliderId +'_layout-list li').find('.order').map(function() {
			//var str = this.id;
			var str = this.value;
			//str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		
		var maxNum = Math.max.apply(Math, numArr);
		var newNum = maxNum + 1;
		
		
		
		if( optSelected.length === 0 ) { //If no option selected show a warning
			alert('Warning: Please select a block to add');
			$('.ajax-load-block').fadeOut();
		} else{ //An option is selected, let's proceed
			
			$('#'+sliderId+'_layout-list .slide_body').slideUp("fast");
			
			
			block_html = '<li style="display: none;" class="layout-block" id="layout-block' + newNum + '">';
			block_html += '<div class="slide_header">';
			block_html += '<strong>' + optSelected + '</strong>';

			

			block_html += '<input type="hidden" class="slide of-input title" name="'+builder_id+'['+template_number+'][options]['+newNum+'][title]" id="'+ builder_id+'_'+template_number+'_options_'+newNum+'_title"  value="'+optSelected+'" />';
			block_html += '<input type="text" class="slide of-input order hidden" name="'+builder_id+'['+template_number+'][options]['+newNum+'][order]" id="'+ builder_id+'_'+template_number+'_options_'+newNum+'_order" value="' + newNum + '"/>';
			
			
			block_html += '<a class="slide_edit_button" href="#">Edit</a>';
			block_html += '</div>';
			block_html += '<div class="slide_body layout_body"><div class="clear"></div></div><!--end slide_body -->';
			block_html += '</li>';
			
			//Append the new block in the correct place
			$('#'+sliderId+'_layout-list').append(block_html);
			
			
			//Find and append the correct options of the block
			$('#'+sliderId+'_layout-list li:first')
				.find('.'+slectedMinus+'-block')
				.clone()
				.removeClass('mc-ignore')
				.appendTo('#'+sliderId+'_layout-list #layout-block'+newNum+' .layout_body');
			
			//Append the delete button
			$('#'+sliderId+'_layout-list #layout-block'+newNum+' .layout_body').append('<a class="mc_remove_block" href="#">Delete</a>');
			
			
			
			//$('#'+sliderId+'_layout-list #layout-block'+newNum+' .media_slider_manager').attr('id', media_holderId);
			//$('#'+sliderId+'_layout-list #layout-block'+newNum+' .mcstudios_media_list').attr('id', media_olList);
			//$('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id', media_embed);
			
			
			//Update the name and id's of cloned inputs
			$('#'+sliderId+'_layout-list #layout-block'+newNum+' .layout_body').find('.of-input').each(function(){
			
					var oldID = $(this).attr('id');
					var newID = getLastNumberAndReplace(oldID, newNum);
					var oldName = $(this).attr('name');
					var newName = getLastNumberAndReplace(oldName, newNum);
										
						console.log(newID);
						console.log(newName);
						$(this).attr('name', newName);
						$(this).attr('id', newID);
			});
			
			
			
			
			setTimeout(function() {			
						$('#'+sliderId+'_layout-list li#layout-block'+newNum).slideDown("fast");
						$('.ajax-load-block').fadeOut();
			}, 400);
			
			
			
		}
	
	});
	
	
	//
	$('.mc_remove_block').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	
	
	
	EditDeleteSubslides();
	function EditDeleteSubslides(){
		//attachments_pro_update_attachment_indicies(attachments_list);
		$('.attachments-pro-item-delete').click(function()
			{
			var parentId = $(this).parent().parent().parent().parent();
			parentId.remove();
			return false
		}
		
		
		);
		$('.rwmb-edit-file').click(function()
			{
			//var parentId = $(this).parent().parent().parent();
			
			var parentId = $(this).closest('.panel');
			var done_btn = parentId.find('.done-editing');
			
			
			$(this).closest('.panel').addClass('flip');
			
			
			var number_fields = $(this).closest('.panel').find('.of-input').length;
			
			if (number_fields > 2) {
			
				number_fields = parseInt(number_fields);
				
				var bheight = number_fields * 35;
				
				$(this).closest('.panel').find('.back-info').css('height', bheight+'px');
				
			}
			
			
			
			/*parentId.find('.back-info').prepend(done_btn);			
			parentId.find('.back-info').show();
			parentId.find('.done-editing').show();*/
			//jQuery('#panel_item_'+parentId).parent().parent().css('height', slides_height+'px');
			
			/*
			jQuery('#panel_item_'+parentId).parent().parent().animate({
			    height: slides_height+'px'
			  }, 500, function() {
			    // Animation complete.
			});*/
			jQuery('.mctemp-library').animate({
				 opacity: 0.4
			  }, 800, function() {
			    // Animation complete.
			});
			return false
		}
		);
		jQuery('.done-editing').click(function(e){
			var parentId=jQuery(this).attr('rel');
			
			$(this).closest('.panel').removeClass('flip');
			//$(this).parent().fadeOut;
			//$(this).parent().hide();
			
			/*jQuery('#panel_item_'+parentId).parent().parent().attr("style", "");
			jQuery('#panel_item_'+parentId).parent().removeClass('editsubslide');
			jQuery('.mctemp-library').animate({
				 opacity: 1
			  }, 800, function() {
			    // Animation complete.
			});*/
			e.preventDefault()
		}
		)
	};
	
	
	
			
		




	
	
/* =============================================================================
	New pages generator e.x Blog or Portfolio
   ========================================================================== */
	$(".pages_add_button").live('click', function(){		
	
		//alert('hoas');
	
	    var slidesContainer = $(this).prev();
	    var sliderId = slidesContainer.attr('id');
	    var sliderInt = $('#'+sliderId).attr('rel');
	    var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
	        var str = this.id; 
	        str = str.replace(/\D/g,'');
	        str = parseFloat(str);
	        return str;			
	    }).get();

	    var maxNum = Math.max.apply(Math, numArr);
	    var newNum = maxNum + 1;
			var prevLi = slidesContainer.find('li').eq(-1).attr('id');
			$('#'+prevLi+' .slide_body').slideUp("fast");
			
		newPage = '<li id="pageblock'+newNum+'" class="of-small-block">';
		newPage += '<div class="pages_header">';
		newPage += '<strong>Page ' + newNum + '</strong>';
		newPage += '<input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">';
		newPage += '<a class="slide_edit_button" href="#">Edit</a>';
		newPage += '</div>';
		newPage += '<div class="slide_body pages_body" style="display:block;">';
		newPage += '<div id="pageg-options'+newNum+'"></div>';
		newPage += '<a class="slide_delete_button" href="#">Delete</a>';
		newPage += '<div class="clear"></div>';
		newPage += '</div><!-- pages_body -->';
		newPage += '</li>';
		
		//Append the new page in the correct place
	   	slidesContainer.append(newPage);
			
		//Append the generated fields
		slidesContainer.find('li').eq(-2).find('.generated-page-options').clone().appendTo('#'+sliderId+' #pageblock'+newNum+' #pageg-options'+newNum);
			
		var oldNum = newNum - 1;
			
		//Update the name and id's of cloned inputs		
		$('#'+sliderId+' li#pageblock'+newNum+' .generated-page-options input, #'+sliderId+' li#pageblock'+newNum+' .generated-page-options select').each(function(i){
			$(this).find('option:selected').removeAttr('selected');
			$(this).val("");

			var newName = jQuery(this).attr('name');
				newName = newName.replace( oldNum, newNum);
			var newID = jQuery(this).attr('id');
				newID = newID.replace( oldNum, newNum);					
				jQuery(this).attr('name', newName);
				jQuery(this).attr('id', newID);
		});	
		

		
		$('#'+sliderId+' li#pageblock'+newNum+' .generated-page-options .select_wrapper').each(function(){
			$(this).find('span').remove();
			$('option:first',this).attr('selected', 'selected');
		});
		
		
		
		$('#'+sliderId+' li#pageblock'+newNum+' .generated-page-options .select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
	
		
		
		
		
		
		
		
	    return false; //prevent jumps, as always..
	});
	
	
	/* #
================================================== */
	
	
	/**	Sorter (Layout Manager) */
	/*jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {
				
					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
				});
			}
		});	
	});
	
	*/
	


	
	
	
	
	
	
	
		
	/* =============================================================================
	/* New slider manager
	/* This code enables the new slider manager, drag and drop
	/* the function full_media _library is disabled for now but it works
	/*  ========================================================================== */
	
	
	$('.mcstudios_media_list').each(function () {
		var slides = $(this).children().length;
		if (slides > 1) {
			$(this).removeClass('media-slide-placeholder');
		}
	});
	
	/*function full_media_library() {
		jQuery('.mctemp-library .media-thumb a').live('click',function(e){
			e.preventDefault();
			
			var subslide_target = $(this).parent().parent().parent().attr('data-target');
				//subslide_target = increment_last(subslide_target);
				
			var subslide_id = $(this).parent().parent().parent().parent().find('.mcstudios_media_list').attr('id');

			
			var sliderId = subslide_id;
			var slidesContainer = $('#'+subslide_id);
			
			var slide_name = $(this).parent().parent().parent().attr('data-slidename');
			
			
			var slider_id = jQuery(this).parent().parent().parent().attr('id'); 
				slider_id = slider_id.replace('library', 'list');
				
			var asset_id = jQuery(this).attr('id');
				asset_id = asset_id.replace('mediafile-', '');
			var asset_thumb = jQuery(this).find('img').attr('src');	
			var asset_ref = jQuery(this).attr('href');
			
			
			var numArr = $('#'+sliderId +' li').find('.suborder').map(function() { 
				var str = this.id; 
				str = str.replace(/\D/g,'');
				str = str.substring(1, str.length)
				str = parseFloat(str);
				return str;			
			}).get();
			
			var maxNum = Math.max.apply(Math, numArr);
			if (maxNum < 1 ) { maxNum = 0};
			var newNum = maxNum + 1;
				
				
				attachment_markup='<li id="subslidepanel-'+asset_id+'" class="subslide" style="display: none">';
				attachment_markup+='<div id="panel_item_'+asset_id+'" class="block panels">';
				//Front image
				attachment_markup+='<div class="front-image">';
				attachment_markup+='<img src="'+asset_thumb+'" alt="Thumbnail" />';
				attachment_markup+='<div class="rwmb-image-bar">';
				attachment_markup+='<a title="Edit" class="rwmb-edit-file" href="#" rel="'+asset_id+'">Edit</a> |';
				attachment_markup+='<a rel="'+asset_id+'" class="attachments-pro-item-delete">Delete</a>';
				attachment_markup+='</div>';
				attachment_markup+='</div>';
				
				attachment_markup+='<a rel="'+asset_id+'" class="done-editing" href="#">Done</a>';
								 	
				//back-info				 	
				attachment_markup+='<div class="back-info">';
				attachment_markup+='<input type="text" class="hidden slide of-input suborder" name="' + subslide_target + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">';
				attachment_markup+='<input type="text" class="slide of-input" name="' + subslide_target + '[' + newNum + '][title]" id="' + sliderId + '_slide_title-' + newNum + '" value="" placeholder="title">';
				attachment_markup+='<input type="text" class="slide of-input hidden" name="' + subslide_target + '[' + newNum + '][url]" id="' + sliderId + '_slide_url-' + newNum + '" value="'+asset_ref+'" placeholder="Image URL">';
				attachment_markup+='<input type="text" class="slide of-input hidden" name="' + subslide_target + '[' + newNum + '][thumb]" id="' + sliderId + '_slide_thumb-' + newNum + '" value="'+asset_thumb+'" placeholder="Image Thumb">';
				attachment_markup+='<div id="subslideoptions'+asset_id+'-append-fields"></div>';
				attachment_markup+='</div>';
								 	
				attachment_markup+='</div>';
				attachment_markup+='</li>';
				
				
				var subslide_inputs = $('#'+subslide_id+' li').first().find('.subslide-generated-inputs').html();
				var oldNum = $('#'+subslide_id+' li').first().find('.suborder').val();
				
				
				
				if (jQuery('#'+ subslide_id).hasClass('media-slide-placeholder')) {
					jQuery('#'+ subslide_id).removeClass('media-slide-placeholder');
					
					setTimeout(function(){ 
					     jQuery('#'+ subslide_id).addClass('notempty');   
					}, 400); 
					
				}
				
				//attachments_list.append(attachment_markup);
				slidesContainer.append(attachment_markup);	
				$('#subslideoptions'+asset_id+ '-append-fields').append(subslide_inputs);
				
				
				$('#subslidepanel-'+asset_id).slideDown();
				
				
				//Update the name and id's of cloned inputs
				$('#subslideoptions'+asset_id+'-append-fields').find('.of-input').each(function(){
					var newName = jQuery(this).attr('name');
						newName = newName.replace( '['+slide_name+'][1]', '['+slide_name+']['+newNum+']');
					var newID = jQuery(this).attr('id');
						newID = newID.replace( slide_name+'_1', slide_name+'_'+newNum);
							
						jQuery(this).attr('name', newName);
						jQuery(this).attr('id', newID);
						
						if (jQuery(this).hasClass('.suborder')) {
							//Update order value
							jQuery(this).find('.suborder').val(newNum).addClass('nedinout'+newNum);	
						} else {
							//remove all values
							jQuery(this).val('');	
						}
			});

			
			//re enable sortable
			subslidesSortable();
			//re enable slides actions
			EditDeleteSubslides();
		});		
	};*/
			
			
			
	/* #Add slide using the Add slide link
	================================================== */
	jQuery('a.add-subslides').live('click',function(event)
		{
		aproparent=jQuery(this);
		apro_thickbox_handler(event,aproparent);
				
		
		var inputName = $(this).parent().find('ul li:first .suborder').attr('name');
			inputName = inputName.replace('[1][order]', '');
			
		var inputID = $(this).parent().find('ul li:first .suborder').attr('id');
			inputID = inputID.replace('1_slide_order', '');	
			
		var slidesContainer = $(this).parent().find('ul.mcstudios_media_list');

		
		
		return false;
		
		function attachments_pro_add_attachment(asset_id,asset_title,asset_thumb,asset_ref,newNum)
			{
			attachments_index=0;
			attachments_list=jQuery('ul.mcstudios_media_list');
			attachments_position=attachments_list.attr('id').replace('apro-attachments-','');
			attachments_fields=new Array();
			
			/*attachment_markup='<li id="'+temp_id+'" class="subslide">';
			attachment_markup+='<div id="panel_item_'+asset_id+'" class="block panels">';
			attachment_markup+='<div class="front-image">';
			attachment_markup+='<img src="'+asset_thumb+'" alt="Thumbnail" />';
			attachment_markup+='<div class="rwmb-image-bar">';
			attachment_markup+='<a title="Edit" class="rwmb-edit-file" href="#" rel="'+asset_id+'">Edit</a> |';
			attachment_markup+='<a class="attachments-pro-item-delete">Delete</a>';
			attachment_markup+='</div>';
			attachment_markup+='</div>';
			attachment_markup+='<div class="back-info">';
			attachment_markup+='<a class="done-editing" href="#">Done</a>';
			attachment_markup+='</div>';
			//attachment_markup+='<input type="hidden" class="hidden" style="display:none;" name="_apro[attachments]['+attachments_position+']['+attachments_index+'][id]" value="'+asset_id+'" />';
			attachment_markup+='</div>';
			attachment_markup+='</li>';
			*/
			
			asset_ref = asset_ref.find('td.field').find('.urlfile').attr('data-link-url');
			
			
			attachment_markup='<li id="subslidepanel-'+asset_id+'" class="subslide">';
			attachment_markup+='<div id="panel_item_'+asset_id+'" class="block panel">';
			//Front image
			attachment_markup+='<div class="front-image">';
			attachment_markup+='<img src="'+asset_thumb+'" alt="Thumbnail" />';
			attachment_markup+='<div class="rwmb-image-bar">';
			attachment_markup+='<a title="Edit" class="rwmb-edit-file" href="#" rel="'+asset_id+'">Edit</a> |';
			attachment_markup+='<a rel="'+asset_id+'" class="attachments-pro-item-delete">Delete</a>';
			attachment_markup+='</div>';
			attachment_markup+='</div>';
			
			
							 	
			//back-info				 	
			attachment_markup+='<div class="back-info">';
			attachment_markup+='<a rel="'+asset_id+'" class="done-editing" href="#">Done</a>';
			attachment_markup+='<input type="text" class="slide of-input suborder hidden" name="' + inputName + '[' + newNum + '][order]" id="'+inputID+''+newNum+'_slide_order" value="' + newNum + '">';
			attachment_markup+='<input type="text" class="slide of-input" name="' + inputName + '[' + newNum + '][title]" id="'+inputID+''+newNum+'_slide_title"  value="" placeholder="title">';
			attachment_markup+='<input type="text" class="slide of-input hidden" name="' + inputName + '[' + newNum + '][url]"  id="'+inputID+''+newNum+'_slide_url" value="'+asset_ref+'" placeholder="Image URL">';
			attachment_markup+='<input type="text" class="slide of-input hidden" name="' + inputName + '[' + newNum + '][thumb]"  id="'+inputID+''+newNum+'_slide_thumb" value="'+asset_thumb+'" placeholder="Image Thumb">';
			attachment_markup+='<div id="subslideoptions'+asset_id+'-append-fields"></div>';
			attachment_markup+='</div>';
			attachment_markup+='</div>';
			attachment_markup+='</li>';
			
			
						
			
			
			
			console.log(asset_thumb);
			
			var subslide_inputs = slidesContainer.find('li:first').find('.subslide-generated-inputs').html();
			var oldNum = slidesContainer.find('li:first').find('.suborder').val();
			
			
			
			if (slidesContainer.hasClass('media-slide-placeholder')) {
				slidesContainer.removeClass('media-slide-placeholder');
			}
			
			//attachments_list.append(attachment_markup);
			slidesContainer.append(attachment_markup);	
			$('#subslideoptions'+asset_id+ '-append-fields').append(subslide_inputs);
			
			
			
			//console.log(newNum);
			//console.log(asset_ref);
			
			
			
			
			//Update the name and id's of cloned inputs
			$('#subslideoptions'+asset_id+'-append-fields').find('.of-input').each(function(){
					var newName = jQuery(this).attr('name');
						newName = getLastNumberAndReplace(newName, newNum);
						
						
		
							
						jQuery(this).attr('name', newName);
						jQuery(this).attr('id', '');						
						
						
						if (jQuery(this).hasClass('.suborder')) {
							//Update order value
							jQuery(this).find('.suborder').val(newNum);
						} else {
							//remove all values
							jQuery(this).val('');	
						}
			});

			
			//re enable sortable
			subslidesSortable();
			//re enable slides actions
			EditDeleteSubslides();
		}
		
		
		
		
		function apro_update_button_label()
			{
			if(apro_hijacked_thickbox)
				{
				if(jQuery('#TB_iframeContent').contents().find('td.savesend').length)
					{
					jQuery('#TB_iframeContent').contents().find('td.savesend').each(function()
						{
						if(jQuery(this).find('input.attachmentspro').length==0)
							{
							jQuery(this).find('input').hide();
							jQuery(this).prepend('<input type="submit" name="attachmentspro" style="float:right;position:relative;margin-top: -45px;" class="attachmentspro button" value="Attach" />')
						}
					}
					)
				}
				jQuery('#TB_iframeContent').contents().find('td.savesend input.attachmentspro').unbind('click').click(function(e)
					{
					apro_parent=jQuery(this).parent().parent().parent();
					jQuery(this).after('<span class="attachments-pro-attached" style="position: absolute;bottom: 40px;right:140px;">Attached</span>');
					apro_id=apro_parent.find('td.imgedit-response').attr('id').replace('imgedit-response-','');
					apro_name=apro_parent.parent().prev().find('span.title').text();
					apro_thumb=apro_parent.parent().parent().find('img.pinkynail').attr('src');
					apro_ref=apro_parent.clone();
					
					
						
						var numArr = slidesContainer.find('li.subslide .suborder').map(function() { 
							var str = this.id; 
							str = str.replace(/\D/g,'');
							str = str.substring(1, str.length)
							str = parseFloat(str);
							return str;			
						}).get();
						
						var maxNum = Math.max.apply(Math, numArr);
						if (maxNum < 1 ) { maxNum = 0};
						var newNum = maxNum + 1;
						
						
		
						attachments_pro_add_attachment(apro_id,apro_name,apro_thumb,apro_ref,newNum)
				
					apro_parent.find('span.attachments-pro-attached').delay(500).fadeOut('fast');
					
					
					//apro_init_wysiwyg();
					//apro_sendto_slider();
					
					
					return false
				}
				);
				if(jQuery('#TB_iframeContent').contents().find('div#media-items').length)
					{
					if(jQuery('#TB_iframeContent').contents().find('.attachmentspro-attach-all').length==0)
						{
						if(jQuery('#TB_iframeContent').contents().find('.progress:visible').length==0)
							{
							if(jQuery('#TB_iframeContent').contents().find('div#media-items').children().length>0)
								{
								jQuery('#TB_iframeContent').contents().find('div#media-items').before('<p class="attachmentspro-attach-all" style="padding:3px 0 6px;"><a class="button" href="#">Attach All</a></p>')
							}
							else
								{
								jQuery('#TB_iframeContent').contents().find('p.attachmentspro-attach-all').remove()
							}
						}
					}
				}
				jQuery('#TB_iframeContent').contents().find('p.attachmentspro-attach-all a').unbind('click').click(function(e)
					{
					jQuery('#TB_iframeContent').contents().find('div#media-items input.attachmentspro').each(function()
						{
						apro_parent=jQuery(this).parent().parent().parent();
						apro_id=apro_parent.find('td.imgedit-response').attr('id').replace('imgedit-response-','');
						apro_name=apro_parent.parent().prev().find('span.title').text();
						apro_thumb=apro_parent.parent().parent().find('img.pinkynail').attr('src');
						apro_ref=apro_parent.clone();
						
							var numArr = slidesContainer.find('li.subslide .suborder').map(function() { 
								var str = this.id; 
								str = str.replace(/\D/g,'');
								str = str.substring(1, str.length)
								str = parseFloat(str);
								return str;			
							}).get();
							
							var maxNum = Math.max.apply(Math, numArr);
							if (maxNum < 1 ) { maxNum = 0};
							var newNum = maxNum + 1;
							attachments_pro_add_attachment(apro_id,apro_name,apro_thumb,apro_ref,newNum)
						
					}
					);
					jQuery(this).after('<span class="attachments-pro-attached">Attached</span>');
					jQuery(this).parent().find('span.attachments-pro-attached').delay(500).fadeOut('fast');
					return false
				}
				);
				if(jQuery('#TB_iframeContent').contents().find('.media-item .savesend input[type=submit], #insertonlybutton').length)
					{
					jQuery('#TB_iframeContent').contents().find('.media-item .savesend input[type=submit], #insertonlybutton').val('Insert Image')
				}
				if(jQuery('#TB_iframeContent').contents().find('#tab-type_url').length)
					{
					jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide()
				}
				if(jQuery('#TB_iframeContent').contents().find('tr.post_title').length)
					{
					jQuery('#TB_iframeContent').contents().find('tr.image-size input[value="full"]').prop('checked',true);
					jQuery('#TB_iframeContent').contents().find('tr.post_title,tr.image_alt,tr.post_excerpt,tr.image-size,tr.post_content,tr.url,tr.align,tr.submit>td>a.del-link').hide()
				}
				if(apro_mime_limits.length)
					{
					if(jQuery('#TB_iframeContent').contents().find('div#media-items>.media-item').length)
						{
						if(jQuery('#TB_iframeContent').contents().find('div#media-items>.media-item:visible').length)
							{
							jQuery('#TB_iframeContent').contents().find('p.attachments-pro-empty-notice').remove();
							jQuery('#TB_iframeContent').contents().find('div#media-items>.media-item').each(function()
								{
								apro_mime_ref=jQuery(this).find('thead>tr>td:eq(1)>p:eq(1)').clone();
								apro_mime_ref.find('strong').remove();
								apro_mime_final=jQuery.trim(apro_mime_ref.text());
								if((apro_mime_final.length>0)&&(jQuery.inArray(apro_mime_final,apro_mime_limits)===-1))
									{
									if(jQuery(this).is(':visible'))
										{
										jQuery(this).hide()
									}
								}
							}
							)
						}
						else
							{
							jQuery('#TB_iframeContent').contents().find('.attachmentspro-attach-all').remove();
							if(jQuery('#TB_iframeContent').contents().find('p.attachments-pro-empty-notice').length==0)
								{
								jQuery('#TB_iframeContent').contents().find('div#media-items').append('<p class="attachments-pro-empty-notice">'+APRO_LANG.note_no_media+'</p>')
							}
						}
					}
				}
			}
			if(jQuery('#TB_iframeContent').contents().length==0&&apro_hijacked_thickbox)
				{
				clearInterval(apro_button_label_updater);
				apro_hijacked_thickbox=false
			}
		}
		
		function apro_thickbox_handler(event,aproparent)
			{
			jQuery('ul.attachments-pro-context').removeClass('attachments-pro-context');
			aproparent.parent().parent().find('ul').addClass('attachments-pro-context');
		
		
				var href=aproparent.attr('href'),width=jQuery(window).width(),H=jQuery(window).height(),W=(720<width)?720:width;
				if(!href)return;
				href=href.replace(/&width=[0-9]+/g,'');
				href=href.replace(/&height=[0-9]+/g,'');
				aproparent.attr('href',href+'&width='+(W-80)+'&height='+(H-85));
				apro_hijacked_thickbox=true;
				apro_button_label_updater=setInterval(apro_update_button_label,500);
				apro_mime_limits=new Array();
				apro_context=jQuery('ul').attr('id').replace('apro-attachments-','');
				
				tb_show('Attach a file',event.target.href,false)
			
		}
		return false;
	});
	
	
	
	
	/*$(".add-subslide").live('click', function(){
		var subslide_id = $(this).attr('rel');
		var slide_name = $(this).attr('data-slidename');
		var subslide_target = $(this).attr('data-target');
		var slidesContainer = $('#'+subslide_id);
		var sliderId = subslide_id;
		var sliderInt = $('#'+sliderId).attr('rel');
		var numArr = $('#'+sliderId +' li').find('.suborder').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = str.substring(1, str.length)
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var temp_id = subslide_id + 'subslide' + newNum;
		var newSlide = '<li id="'+temp_id+'" class="subslide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input suborder" name="' + subslide_target + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "></div></li>';

		var subslide_inputs = $('#'+subslide_id+' li').first().find('.slide_body').html();
		var oldNum = $('#'+subslide_id+' li').first().find('.suborder').val();
		
		
		slidesContainer.append(newSlide);		
		$('#'+temp_id+ ' .slide_body').append(subslide_inputs);
		
		//Update the name and id's of cloned inputs
		$('#'+temp_id+ ' .slide_body .of-input').each(function(){
				var newName = jQuery(this).attr('name');
						newName = newName.replace( '['+slide_name+']['+oldNum+']', '['+slide_name+']['+newNum+']');
				var newID = jQuery(this).attr('id');
						newID = newID.replace( slide_name+'_'+oldNum, slide_name+'_'+newNum);
						
						jQuery(this).attr('name', newName);
						jQuery(this).attr('id', newID);						
				$(this).val('');		
		});
		$('#'+temp_id+ ' .screenshot').empty();
		$('.subslide').fadeIn('fast', function() {
			//$(this).removeClass('temphide');
		});		
		return false; //prevent jumps, as always..
	});*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Single Layout Manager
	/* This code helps the user to create the structure of a defined page
	/* the way he wants, ex. Home page, Contact Form
	/*  ========================================================================== */
	
	$(".mcstdios-block-add").live('click', function(){
			
		$('.ajax-load-block').fadeIn();
			
		var slidesContainer = $(this).attr('rel');
		var sliderId = slidesContainer;
		var sliderInt = $('#'+sliderId).attr('rel');
			
		var optSelected = $('#'+sliderId+'-selector option:selected').val();
		var slectedMinus = optSelected.toLowerCase().replace(/ /g, '');
	
		var numArr = $('#'+sliderId +'-list li').find('.order').map(function() {
			var str = this.id; 
				str = str.replace(/\D/g,'');
				str = parseFloat(str);
				return str;			
		}).get();
	
	
		var maxNum = Math.max.apply(Math, numArr);
		var newNum = maxNum + 1;
		
		
			
		if( optSelected.length === 0 ) { //If no option selected show a warning
				
			alert('Warning: Please select a block to add');
				
			$('.ajax-load-block').fadeOut();
		
		
				
		} else{ //An option is selected, let's proceed
				
			$('#'+sliderId+'-list .slide_body').slideUp("fast");
				
			pageBlock = '<li style="display: none;" class="layout-block" id="layout-block' + newNum + '">';
			pageBlock += '<div class="slide_header">';
			pageBlock += '<strong>' + optSelected + '</strong>';
			pageBlock += '<input type="hidden" class="slide of-input title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_slide_title-' + newNum + '" value="' + optSelected + '">';
			pageBlock += '<input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">';
			pageBlock += '<a class="slide_edit_button" href="#">Edit</a>';
			pageBlock += '</div>';
			pageBlock += '<div class="slide_body layout_body"><div class="clear"></div></div><!--end slide_body -->';
			pageBlock += '</li>';
				
				
			//Append the new block in the correct place
			$('#'+sliderId+'-list').append(pageBlock);
				
			//Find and append the correct options of the block
			$('#'+sliderId+'-list li#'+sliderId+'-full-options').find('.'+slectedMinus+'-block').clone().removeClass('mc-ignore').appendTo('#'+sliderId+'-list #layout-block'+newNum+' .layout_body');
				
			//Append the delete button
			$('#'+sliderId+'-list #layout-block'+newNum+' .layout_body').append('<a class="slide_delete_button" href="#">Delete</a>');
			
			
			
			if ($('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').length > 0) {
				
				var media_id = randString(5);
				
				$('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id',media_id);
					
			}
				
				
				
			//$('#'+sliderId+'-list #layout-block'+newNum+' .media_slider_manager').attr('id', media_holderId);
			//$('#'+sliderId+'-list #layout-block'+newNum+' .mcstudios_media_list').attr('id', media_olList);
			//$('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id', media_embed);
				
				
				
				
				
			//Update the name and id's of cloned inputs
			$('#'+sliderId+'-list #layout-block'+newNum+' .layout_body').find('.of-input').each(function(){
					var newName = jQuery(this).attr('name');
						newName = newName.replace( '1', newNum);
					var newID = jQuery(this).attr('id');
						newID = newID.replace( '1', newNum);
						
						jQuery(this).attr('name', newName);
						jQuery(this).attr('id', newID);
			});
			
			
			//Update lists ids
			if ($('#'+sliderId+'-list #layout-block'+newNum).find('.content-slider').length > 0) {
				var cloned_content_list = $('#'+sliderId+'-list #layout-block'+newNum+' .content-slider').find('ul').attr('id');
					cloned_content_list = getLastNumberAndReplace(cloned_content_list, newNum);
					$('#'+sliderId+'-list #layout-block'+newNum+' .content-slider').find('ul').attr('id', cloned_content_list);
			}
			
			
				
				
				
				
				
			//Lets check if a slider option is active on the new block
			if($('#'+sliderId+'-list #layout-block'+newNum+' .mcstudios_media_list').length){
					
				//var uploadLink = $('#'+sliderId+'-list #layout-block'+newNum).find('.mcimage-upload').attr('id');
					//uploadLink = uploadLink.replace('1', newNum);
					//$('#'+sliderId+'-list #layout-block'+newNum).find('.mcimage-upload').attr('id', uploadLink);
						
						
					//If we have the slider, let's show the library to add images
					//var container = $('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id');
					
					
					//For adding a gallery below the slides
					//mcstudios_load_gallery();
					
					//var contentTobeLoaded = $("#mcstudios-media-library").html();
					//$('#'+sliderId+'-list #layout-block'+newNum+' #'+container).addClass('loadedData').html(contentTobeLoaded);
					
					var media_holderId = $('#'+sliderId+'-list #layout-block'+newNum+' .media_slider_manager').attr('id');
							media_holderId = media_holderId.replace( '1', newNum);
							
					var media_olList = $('#'+sliderId+'-list #layout-block'+newNum+' .mcstudios_media_list').attr('id');
							media_olList = media_olList.replace( '1', newNum);
							
					//var media_embed = $('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id');
					
					$('#'+sliderId+'-list #layout-block'+newNum+' .media_slider_manager').attr('id', media_holderId);
					$('#'+sliderId+'-list #layout-block'+newNum+' .mcstudios_media_list').attr('id', media_olList);
					//$('#'+sliderId+'-list #layout-block'+newNum+' .mctemp-library').attr('id', media_embed);
						
						
					var theContainer = $(this).attr("rel");
					
					//Update the name and id's of cloned inputs
					$('#'+sliderId+'-list #layout-block'+newNum+' .media_slider_manager').find('.of-input').each(function(){
						var newName = jQuery(this).attr('name');
							newName = newName.replace( theContainer+'[1]', theContainer+'['+newNum+']');
						var newID = jQuery(this).attr('id');
							newID = newID.replace( theContainer+'_1', theContainer+'_'+newNum);
											
							jQuery(this).attr('name', newName);
							jQuery(this).attr('id', newID);
					});		
			}
				
			setTimeout(function() {			
					$('#'+sliderId+'-list li#layout-block'+newNum).slideDown("fast");
					$('.ajax-load-block').fadeOut();
					
					of_image_upload(); // re-initialise upload image..
					contentSortable(); //re-initialize sortable
					foldFields(); // re-initialize folded fields 
					
			}, 400);		
		}
		
		normalSlidesSortable();
	  return false; //prevent jumps, as always..
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Content Add 
	/* This code helps the user to add block of content
	/* and change order, used in columns generator
	/*  ========================================================================== */
	
	/*$(".content_slide_add_button").live('click', function(){
	
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		
		var inputOrderName = $('#'+sliderId +' li:first').find('.suborder').attr('name');
			inputOrderName = increment_last(inputOrderName);
			
			
			
			
					
		var numArr = $('#'+sliderId +' li').find('.suborder').map(function() { 
			var str = this.value; 
				//str = str.replace(/\D/g,'');
				str = parseFloat(str);
				return str;			
		}).get();
			
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
			
		var newSlide = '<li class="subslide"><div class="subslide_header"><strong>Block ' + newNum + '</strong><input type="text" class="slide of-input suborder hidden" name="' + inputOrderName + '" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '" data-order="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><div id="contentslide-settings-' + newNum + '"></div><div class="clear"></div></div></li>';
			
			
		var content_slide_settings = $('#'+sliderId +' li').first().find('.slide_body').html();
			
		slidesContainer.append(newSlide);
			
		$('#contentslide-settings-' + newNum).append(content_slide_settings);
			
			
		//Update the name and id's of cloned inputs
		$('#contentslide-settings-' + newNum +' .of-input').each(function(){
			var newName = jQuery(this).attr('name');
				//newName = newName.replace( '['+sliderInt+'][1]', '['+sliderInt+']['+newNum+']');
			var newID = jQuery(this).attr('id');
				//newID = newID.replace( sliderInt+'_1', sliderInt+'_'+newNum);
							
				jQuery(this).attr('name', newName);
				jQuery(this).attr('id', newID);
												
				$(this).val('');		
		});
			
			
					
		of_image_upload(); // re-initialise upload image..
		contentSortable(); //re-initialize sortable
		foldFields(); // re-initialize folded fields 
			
	  return false;
	});*/
	
	
	$(".content_slide_add_button").live('click', function(){
	
	
		$(this).parent().find('.slide_body').slideUp('fast');
	
		var slidesContainer = $(this).prev();
		
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
					
		var numArr = $('#'+sliderId +' li').find('.suborder').map(function() { 
			var str = this.value; 
				//str = str.replace(/\D/g,'');
				str = parseFloat(str);
				return str;			
		}).get();
			
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		
		//Get the name of the first order input to update the rest of the inputs 
		var inputOrderName = slidesContainer.find('li:first').find('.suborder').attr('name');
			inputOrderName = getLastNumberAndReplace(inputOrderName, newNum);
			
			
		var originalInputName = slidesContainer.find('li:first').find('.suborder').attr('name');
			originalInputName = originalInputName.replace('[order]', '');	
			
			
		var newInputName = getLastNumberAndReplace(originalInputName, newNum);;
		
		
		//getLastNumberAndReplace(str, newNum)
		
			
		var newSlide = '<li class="subslide"><div class="subslide_header"><strong>Block ' + newNum + '</strong><input type="text" class="slide of-input suborder hidden" name="' + inputOrderName + '" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '" data-order="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><div id="contentslide-settings-' + newNum + '"></div><div class="clear"></div></div></li>';
			
			
		var content_slide_settings = slidesContainer.find('li:first').find('.slide_body').html();
			
		//Append the new content	
		slidesContainer.append(newSlide);
		$('#contentslide-settings-' + newNum).append(content_slide_settings);
		
		
		
			
			
		//Update the name and id's of cloned inputs
		$('#contentslide-settings-' + newNum +' .of-input').each(function(){
			var newName = jQuery(this).attr('name');
				newName = newName.replace(originalInputName, newInputName);
				jQuery(this).attr('name', newName);
				jQuery(this).attr('id', '');									
				$(this).val('');		
		});
					
		of_image_upload(); // re-initialise upload image..
		contentSortable(); //re-initialize sortable
		foldFields(); // re-initialize folded fields 
			
	  return false;
	});
		
		
		
		
	
	
	
	
	/* =============================================================================
	/* Slider Generator - soon to be replaced
	/* This code helps the user to add simple slides
	/* to a defined slider
	/*  ========================================================================== */
	$(".slide_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		
		slidesContainer.append(newSlide);
		$('.temphide').fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
				
		of_image_upload(); // re-initialise upload image..
		
		//contentSortable(); //re-initialize sortable
		
		//foldFields(); // re-initialize folded fields 
		
		return false;
	});
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Sidebars Generator
	/* This code helps the user to create 
	/* all the sidebars he wants
	/*  ========================================================================== */
	$(".sidebar_add_button").live('click', function(){		
	
	    var slidesContainer = $(this).prev();
	    var sliderId = slidesContainer.attr('id');
	    var sliderInt = $('#'+sliderId).attr('rel');
	    var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
	        var str = this.id; 
	        str = str.replace(/\D/g,'');
	        str = parseFloat(str);
	        return str;			
	    }).get();
	
	    var maxNum = Math.max.apply(Math, numArr);
	    var newNum = maxNum + 1;
		
		sidebar = '<li class="of-small-block"><div class="sidebar_header">';
		sidebar += '<strong>Sidebar ' + newNum + '</strong>';
		sidebar += '<input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">';
		sidebar += '<a class="slide_edit_button" href="#">Edit</a></div>';
		sidebar += '<div class="slide_body sidebar_body" style="display:block;">';
		sidebar += '<div class="sidebar_title"><label>Sidebar Title</label>';
		sidebar += '<input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""></div>';
		sidebar += '<div class="clear"></div>';
		sidebar += '<div class="sidebar_page_select"><label>Apply sidebar to:</label><div class="clear"></div>';
		sidebar += '<div id="temp-select' + newNum + '"></div></div>';
		sidebar += '<div class="clear"></div>';
		sidebar += '<a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
			
	   	slidesContainer.append(sidebar);
		
		var prevId = $('#'+sliderId+' li.of-small-block').eq(-2).find('.select').attr('id');
		
		 slidesContainer.find('li.of-small-block').eq(-2).find('.select_wrapper_multiple').clone().appendTo('#'+sliderId+' #temp-select'+newNum);
		 
		 $('#'+sliderId+' #temp-select'+newNum).find('label').removeClass('multiselect-on');
		 $('#'+sliderId+' #temp-select'+newNum).find('input.normal-checkbox').each(function () {
		 	$(this).attr('checked', false);
		 	var old_name = $(this).attr('name');
		 	var new_name = increment_last(old_name);
		 	$(this).attr('name', new_name);
		 	
		 });

	    return false; //prevent jumps, as always..
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Sort Blocks & Slides
	/* This function enables the sortable function
	/* of each slide or block
	/*  ========================================================================== */
	
	
	/* #Simple Slides
	================================================== */
	/*$('.slider').find('ul').each( function() {
			var id = jQuery(this).attr('id');
			$('#'+ id).sortable({
				placeholder: "placeholder",
				items: "> li",
				handle : ".slide_header",
				opacity: 0.6
			});	
	});*/
	$('.slider').find('ul').each( function() {
			var id = jQuery(this).attr('id');
			$('#'+ id).sortable({
				placeholder: "placeholder",
				items: "> li",
				handle : ".slide_header",
				opacity: 0.6,
				stop: function() {
						
						
						//Update orders	
						$('#'+id+' li.layout-block').each(function(){
							var index = $(this).index();
								index = index + 1;
								
								
								$(this).attr('id', 'layout-block'+index);
										
							var oldNum = $(this).find('.slide_header .order').val();
							var newNum = index;
										
							$(this).find('.slide_header .order').val(newNum);
							$(this).find('.slide_header .order').attr('data-order', newNum);
							
							
							
							$(this).find('.of-input').each(function(){
								var newName = jQuery(this).attr('name');
									newName = getFirstNumberAndReplace(newName, newNum);
								var newID = jQuery(this).attr('id');
									newID = getFirstNumberAndReplace(newID, newNum);
									
									$(this).attr('name', newName);
									$(this).attr('id', newID);
							});	
							
							if ($(this).find('.content-slider').length > 0) {
								var content_cols = $(this).find('.content-slider ul').attr('id');
									content_cols = getLastNumberAndReplace(content_cols, newNum);
									$(this).find('.content-slider ul').attr('id', content_cols);
									$(this).find('.content-slider .of-input').each(function() {
										var name = $(this).attr('name');
										var newName = getFirstNumberAndReplace(name, newNum);
										
										var id = $(this).attr('id');
										var newId = getFirstNumberAndReplace(id, newNum);
										$(this).attr('name', newName);
										$(this).attr('id', newId);
									});
							}
							
							
							if ($(this).find('.media_slider_manager').length > 0) {
								var media_container = $(this).find('.media_slider_manager').attr('id');
									media_container = getFirstNumberAndReplace(media_container, newNum);
							
									$(this).find('.media_slider_manager').attr('id', media_container);
							
								var media_list = $(this).find('.mcstudios_media_list').attr('id');
									media_list = getFirstNumberAndReplace(media_list, newNum);
									$(this).find('.mcstudios_media_list').attr('id', media_list);	
							}
						});
				}
			});	
	});

		
		
		
		
	
	/* #Columns sortable
	================================================== */	
	function contentSortable() {
			
		$('.content-slider').each(function() {
			var list_id = $(this).find('ul').attr('id');
			var list_holder_id = $('#'+list_id).attr('id');		
			var slide_name = $(this).find('ul').attr('rel');
			
			//$('#'+list_id+'').addClass( "sortable" );
			
			//Enable Sortable
			$(this).find('ul').newsortable({
				items: 'li',
				handle: '.subslide_header'
			}).bind('sortupdate', function(e, ui) {
					
				//Update orders	
				$('#'+list_id+' li.subslide').each(function(){
					var index = $(this).index();
						index = index + 1;
								
					var oldNum = $(this).find('.suborder').attr('data-order');
					var newNum = index;
								
					$(this).find('.suborder').val(newNum);
					$(this).find('.suborder').attr('data-order', newNum);
											
					$(this).find('.of-input').each(function(){
						var newName = jQuery(this).attr('name');
							newName = getLastNumberAndReplace(newName, newNum);
						var newID = jQuery(this).attr('id');
							newID = getLastNumberAndReplace(newID, newNum);
							
							$(this).attr('name', newName);
							$(this).attr('id', newID);
					});	
				});
			});
					
		});
	};
	//Fire contentSortable
	contentSortable();	
	
	
	
	
	function normalSlidesSortable() {		
		/*$('.media-mcstudios-framework').each(function() {
			var list_id = $(this).attr('id');
			//Enable Sortable
			$(this).newsortable({
				items: 'li.layout-block',
				handle: '.slide_header'
			}).bind('sortupdate', function(e, ui) {
					
				//Update orders	
				$('#'+list_id+' li.layout-block').each(function(){
					var index = $(this).index();
						index = index + 1;
						
						
						$(this).attr('id', 'layout-block'+index);
								
					var oldNum = $(this).find('.slide_header .order').val();
					var newNum = index;
								
					$(this).find('.slide_header .order').val(newNum);
					$(this).find('.slide_header .order').attr('data-order', newNum);
					
					
					
					$(this).find('.of-input').each(function(){
						var newName = jQuery(this).attr('name');
							newName = getFirstNumberAndReplace(newName, newNum);
						var newID = jQuery(this).attr('id');
							newID = getFirstNumberAndReplace(newID, newNum);
							
							$(this).attr('name', newName);
							$(this).attr('id', newID);
					});	
					
					
					
					
					if ($(this).find('.content-slider').length > 0) {
						var content_cols = $(this).find('.content-slider ul').attr('id');
							content_cols = getLastNumberAndReplace(content_cols, newNum);
							$(this).find('.content-slider ul').attr('id', content_cols);
							$(this).find('.content-slider .of-input').each(function() {
								var name = $(this).attr('name');
								var newName = getFirstNumberAndReplace(name, newNum);
								
								var id = $(this).attr('id');
								var newId = getFirstNumberAndReplace(id, newNum);
								$(this).attr('name', newName);
								$(this).attr('id', newId);
							});
					}
					
					
					if ($(this).find('.media_slider_manager').length > 0) {
						var media_container = $(this).find('.media_slider_manager').attr('id');
							media_container = getFirstNumberAndReplace(media_container, newNum);
					
							$(this).find('.media_slider_manager').attr('id', media_container);
					
						var media_list = $(this).find('.mcstudios_media_list').attr('id');
							media_list = getFirstNumberAndReplace(media_list, newNum);
							$(this).find('.mcstudios_media_list').attr('id', media_list);
							
							
					}
											
					
				});
			});
					
		});*/
	};
	//Fire contentSortable
	normalSlidesSortable();		
			
			
			
			
			
		
		
		
		subslidesSortable();
		function subslidesSortable() {
		
		jQuery('.mcstudios_media_list').each(function() {
				var list_id = jQuery(this).attr('id');
				var list_holder_id = jQuery('#'+list_id).parent().attr('id');			
				var slide_name = jQuery('#'+list_holder_id).find('.add-subslides').attr('data-slidename');
	
				jQuery('#'+list_id).newsortable({items: '.subslide:not(.first_media_slide)'}).bind('sortupdate', function(e, ui) {
				
				
				
					
				
				
					jQuery('#'+list_id+' li.subslide').each(function(){
						var index = jQuery(this).index();
							index = index + 1;
							
							var oldNum = jQuery(this).find('.suborder').val();
							
							
							
							var newNum = index;
							
							console.log(newNum);
							
							jQuery(this).find('.suborder').val(newNum);
							
							
							
							jQuery(this).find('.of-input').each(function(){
									var newName = jQuery(this).attr('name');
											newName = newName.replace( '['+slide_name+']['+oldNum+']', '['+slide_name+']['+newNum+']');
									var newID = jQuery(this).attr('id');
											newID = newID.replace( slide_name+'_'+oldNum, slide_name+'_'+newNum);
											
											jQuery(this).attr('name', newName);
											jQuery(this).attr('id', newID);
							});
							
					
					});
					
					
				});
				
			});
		};
		
		
		
		
		
		
		
		

	
	
	
	/* =============================================================================
	/* Ajax Upload function
	/* This function enables image uploads
	/* used by sliders and input media
	/*  ========================================================================== */
	function of_image_upload() {
		$('.image_upload_button').each(function(){
				
		var clickedObject = $(this);
		var clickedID = $(this).attr('id');			
		var nonce = $('#security').val();
		new AjaxUpload(clickedID, {
			action: ajaxurl,
			name: clickedID, // File upload name
			data: { // Additional data to send
				action: 'of_ajax_post_action',
				type: 'upload',
				security: nonce,
				data: clickedID },
			autoSubmit: true, // Submit file after selection
			responseType: false,
			onChange: function(file, extension){},
			onSubmit: function(file, extension){
				clickedObject.text('Uploading'); // change button text, when user selects file	
				this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
				interval = window.setInterval(function(){
					var text = clickedObject.text();
					if (text.length < 13){	clickedObject.text(text + '.'); }
					else { clickedObject.text('Uploading'); } 
					}, 200);
			},
			onComplete: function(file, response) {
				window.clearInterval(interval);
				clickedObject.text('Upload Image');	
				this.enable(); // enable upload button
					
		
				// If nonce fails
				if(response==-1){
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
					fail_popup.fadeOut();                        
					}, 2000);
				}				
						
				// If there was an error
				else if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					$(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
					
					}
				else{
					var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';
	
					$(".upload-error").remove();
					$("#image_" + clickedID).remove();	
					clickedObject.parent().after(buildReturn);
					$('img#image_'+clickedID).fadeIn();
					clickedObject.next('span').fadeIn();
					clickedObject.parent().prev('input').val(response);
				}
			}
		});	
	  });	
	}	
	of_image_upload();
	
	
	/* #Image reset
	================================================== */
	$('.image_reset_button').live('click', function(){
		var clickedObject = $(this);
		var clickedID = $(this).attr('id');
		var theID = $(this).attr('title');	
				
		var nonce = $('#security').val();
	
		var data = {
			action: 'of_ajax_post_action',
			type: 'image_reset',
			security: nonce,
			data: theID
		};
					
		$.post(ajaxurl, data, function(response) {
						
			//check nonce
			if(response==-1){ //failed
							
				var fail_popup = $('#of-popup-fail');
				fail_popup.fadeIn();
				window.setTimeout(function(){
					fail_popup.fadeOut();                        
				}, 2000);
			}			
			else {			
				var image_to_remove = $('#image_' + theID);
				var button_to_hide = $('#reset_' + theID);
				image_to_remove.fadeOut(500,function(){ $(this).remove(); });
				button_to_hide.fadeOut();
				clickedObject.parent().prev('input').val('');
			}		
		});		
	}); 
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Message Popup
	/* This code updates the popup position
	/* on user scroll, a little clumsy still
	/*  ========================================================================== */
	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}
		
	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
			
	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});
	
	
	
	
	
	
	
	
	
	
	
	
	/* =============================================================================
	/* Ajax Save, Back-up, Restore Actions
	/* This code controls the actions
	/* when each of this buttons are clicked
	/*  ========================================================================== */
	
	
	/* #Ajax bakup options
	================================================== */	
	$('#of_backup_button').live('click', function(){
		
		var answer = confirm("Click OK to backup your current saved options.")
			
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');			
			var nonce = $('#security').val();
			
			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};
							
			$.post(ajaxurl, data, function(response) {				
				//check nonce
				if(response==-1){ //failed
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}				
				else {
								
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
								
			});	
		}
	return false;				
	}); 

	
	
	
	/* #Ajax Restore from backup Settings
	================================================== */	
	$('#of_restore_button').live('click', function(){
		
		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")
			
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
			var nonce = $('#security').val();
			
			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};
							
			$.post(ajaxurl, data, function(response) {	
				//check nonce
				if(response==-1){ //failed
									
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
								
				else {
								
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}			
			});
		}
	return false;					
	});
	
	
	
	
	/* #Ajax Transfer (Import/Export) Option
	================================================== */
	$('#of_import_button').live('click', function(){
		
		var answer = confirm("Click OK to import options.")
			
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');			
			var nonce = $('#security').val();
				
			var import_data = $('#export_data').val();
			
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};
							
			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');
					
				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}		
				else 
				{
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}						
			});	
		}
	 return false;					
	});
		
		
		
		
	/* #Ajax Save options
	================================================== */	
	$('#of_save').live('click',function() {
				
		var nonce = $('#security').val();
		$('.ajax-loading-img').fadeIn();
			
		//get serialized data from all our option fields			
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();
							
		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
						
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
							
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}
							
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});		
	 return false; 					
	});   
		
		
	/* #Ajax Reset All Options to Default
	================================================== */
	$('#of_reset').click(function() {
			
		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");
			
		if (answer){	
			var nonce = $('#security').val();
			$('.ajax-reset-loading-img').fadeIn();
								
			var data = {
				type: 'reset',
				action: 'of_ajax_post_action',
				security: nonce
			};
							
			$.post(ajaxurl, data, function(response) {
				var success = $('#of-popup-reset');
				var fail = $('#of-popup-fail');
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();  
								
				if (response==1)
				{
					success.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				} 
				else 
				{ 
					fail.fadeIn();
					window.setTimeout(function(){
						fail.fadeOut();				
					}, 2000);
				}
			});		
		}
     return false;		
	});
		
		
		
		
		
	
	
}); //end doc ready














 
 
 
 
 
 
 
 function getLastNumberAndReplace(str, newNum) {
     return str.replace(/[0-9]+(?!.*[0-9])/, function(match) {
         //return parseInt(match, 10)+1;
          return match.replace(match, newNum);
     });
 }
 
 
 function getFirstNumberAndReplace(str, newNum) {
     return str.replace(/[0-9]+/, function(match) {
         //return parseInt(match, 10)+1;
          return match.replace(match, newNum);
     });
 }
 
 function increment_last(v) {
     return v.replace(/[0-9]+(?!.*[0-9])/, function(match) {
         return parseInt(match, 10)+1;
     });
 }
 
 
 function randString(n)
 {
     if(!n)
     {
         n = 5;
     }
 
     var text = '';
     var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 
     for(var i=0; i < n; i++)
     {
         text += possible.charAt(Math.floor(Math.random() * possible.length));
     }
 
     return text;
 }