/*
Theme Name: Mirage
Theme Author URI: - http://themeforest.net/user/MCStudios
Description: Theme scripts 
Version: 1.0
Author: MC Studios
Author URI: http://mcstudiosmx.com

Only change the code below if you know
what you are doing.
*/


jQuery(window).load(function(){

	var page_layout = '';
	if (jQuery('body').hasClass('sidebar-none')) {
		page_layout = 'full';
	} else {
		page_layout = 'half';
	}
	
	if (!window.location.origin) 
		window.location.origin = window.location.protocol+"//"+window.location.host;
	var base_url = window.location.origin;
	
	
	
	/*=================================================================*/
	/* Nivo Slider
	/*=================================================================*/
	var nivoSlider = function() {
		jQuery('.nivoSlider').each(function() {
			var nivoid = jQuery(this).attr('id');
			var speed = jQuery(this).parent().attr('data-speed');
				speed = parseFloat(speed);
			var effect = jQuery(this).parent().attr('data-effect'); 
			var slider_auto = jQuery(this).parent().attr('data-auto'); 
			if(slider_auto == 'true'){
				slider_auto = false;
			} else{
				slider_auto = true;
			}
			
			var slide_holder = jQuery(this).parent().attr('id');
			
			jQuery('#'+nivoid).nivoSlider({
				effect: ''+effect+'', // Specify sets like: 'fold,fade,sliceDown'
				slices: 15, // For slice animations
				boxCols: 8, // For box animations
				boxRows: 4, // For box animations
				animSpeed: 500, // Slide transition speed
				pauseTime: speed, // How long each slide will show
				startSlide: 0, // Set starting Slide (0 index)
				directionNav: true, // Next & Prev navigation
				controlNav: true, // 1,2,3... navigation
				controlNavThumbs: false, // Use thumbnails for Control Nav
				pauseOnHover: false, // Stop animation while hovering
				manualAdvance: slider_auto, // Force manual transitions
				prevText: 'Prev', // Prev directionNav text
				nextText: 'Next', // Next directionNav text
				randomStart: false, // Start on a random slide
				beforeChange: function(){}, // Triggers before a slide transition
				afterChange: function(){}, // Triggers after a slide transition
				slideshowEnd: function(){}, // Triggers after all slides have been shown
				lastSlide: function(){}, // Triggers when last slide is shown
				afterLoad: function(){
					
					jQuery('#'+slide_holder).css('height', '');
				
				} // Triggers when slider has loaded
			});
		});
	};// end nivoSlider function
	//Execute the nivoSlider function
	//Only if necessary
	if (jQuery(".nivoSlider").exist())
		nivoSlider();
	
	
	
	
	


		
	/*=================================================================*/
	/* Videos Api
	/*=================================================================*/	
	if (jQuery(".youtube-video").exist() || jQuery(".vimeo-video").exist()) {
		var ytemp_id = '1';
		jQuery('.youtube-video').each(function(){
			var video_id = '';
			var video_url = jQuery(this).attr('rel');
			var video_width = jQuery(this).attr("data-width");
			var video_height = jQuery(this).attr("data-height");
				video_url = video_url.match("[\?&]v=([^&#]*)")[1];
				video_id = video_url + ytemp_id;				
				if (video_url) {	
					jQuery(this).html('<iframe id="'+video_id+'" width="'+video_width+'" height="'+video_height+'" src="http://www.youtube.com/embed/'+video_url+'?enablejsapi=1&amp;rel=0&amp;showinfo=0&amp;autohide=1&amp;fs=1&amp;theme=dark&amp;playerapiid='+video_id+'&amp;origin='+base_url+'" frameborder="0" allowfullscreen></iframe>');	
				}
		});	
			
		var vtemp_id = '1';
		jQuery('.vimeo-video').each(function(){
			var video_id = '';
			var video_url = jQuery(this).attr('rel');
			var video_width = jQuery(this).attr("data-width");
			var video_height = jQuery(this).attr("data-height");
			var video_color = jQuery(this).attr("data-color");	
				if (!video_color) {
					video_color = 'ff6666';	
				}
				video_url = /vimeo.*\/(\d+)/i.exec( video_url );
				video_url = video_url[1];
				video_id = video_url + vtemp_id;
				if (video_url) {	
					jQuery(this).html('<iframe id="'+video_id+'" src="http://player.vimeo.com/video/'+video_url+'?api=1&amp;player_id='+video_id+'&amp;portrait=0&amp;byline=0&amp;title=0&amp;badge=0&amp;color='+video_color+'" width="'+video_width+'" height="'+video_height+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');	
				}
		});
		/* Enable video api's
		/* to autplay or stop the videos on slide change */
		var players = {};
		jQuery( ".youtube-video" ).promise().done(function() {	
			YT_ready(function() {
				jQuery(".youtube-video iframe").each(function() {
				    var identifier = this.id;
				    var frameID = getFrameID(identifier);
				    var videoplay = jQuery(this).parent().attr('data-autoplay');
				        
				    if (videoplay == 'false') { autoPlay = 0; } else { autoPlay = 1; }
				        
				    if (frameID) { //If the frame exists
				        players[frameID] = new YT.Player(frameID, {
				           events: {
				                    //"onReady": createYTEvent(frameID, autoPlay)
				                }
				         });
				    }
				 });
			 });
		 });
			
		 jQuery( ".vimeo-video" ).promise().done(function() {
				var vimeoPlayers = jQuery('body').find('.vimeo-video iframe'), player; 		
				for (var i = 0, length = vimeoPlayers.length; i < length; i++) { 		    
						player = vimeoPlayers[i]; 		    
						$f(player).addEvent('ready', ready); 		
				} 		
				function addEvent(element, eventName, callback) { 	    	
					if (element.addEventListener) { 		    	
						element.addEventListener(eventName, callback, false) 		    
					} else { 	      		
						element.attachEvent(eventName, callback, false); 	      	
					} 	    
				} 	    
				function ready(player_id) { 	    	
					var froogaloop = $f(player_id); 	    	
					froogaloop.addEvent('play', function(data) { 		    	
						//player_pause;
					}); 		    
					froogaloop.addEvent('pause', function(data) { 			    
						//player_play;
					});
				} 
		 });
	}
	
	
	
	
	
	
	/*=================================================================*/
	/* FlexSlider
	/*=================================================================*/	
	var flexSlider = function() {	
		/* Start the slider
		/* take the parameters of div */
		jQuery('.flexslider').each(function() {
			if ( jQuery(this).hasClass('single-slide') ) {
				return false;
			}
				
			var slider_id = jQuery(this).attr('id');
			var speed = jQuery(this).attr('data-speed');
			var effect = jQuery(this).attr('data-effect');
			var slider_auto = jQuery(this).attr('data-auto');
			var loop = jQuery(this).attr('data-loop');
			
			var bullets = jQuery(this).attr('data-bullets');
					
			if(slider_auto == 'true'){
				slider_auto = true;
			} else{
				slider_auto = false;
			}
			
			
			var slider_parent = jQuery(this).parent();
			
			
			
			//Create the bullets pagination
			if(bullets == 'thumbnails'){
				jQuery(slider_parent).addClass('thumbnails-bullets');
				jQuery('.flex-control-nav').remove();
					   
				var bullets_html = '<div id="sliderbullets" class="demo">';
					bullets_html += '<ul class="ts_container">';
					bullets_html += '<li class="ts_thumbnails">';
					bullets_html += '<div class="ts_preview_wrapper">';
					bullets_html += '<ul class="ts_preview">';
					bullets_html += '</ul>';
					bullets_html += '</div>';
					bullets_html += '<span></span>';
					bullets_html += '</li>';
					bullets_html += '</ul>';
					bullets_html += '</div>';
				
				//Append the pagination	   
				jQuery(slider_parent).append(bullets_html);
				
				//Add the links and thumbnails		   
				jQuery(this).find('li.slide-holder').each(function(i) {   		
					var slide_n = i + 1;   		
					jQuery(this).find('.slide').attr('data-slide-number', slide_n);   
					var thumbnail = jQuery(this).find('.slide').attr('data-thumbnail');
					jQuery('#sliderbullets .ts_container .ts_thumbnails').before('<li><a href="#" class="flex-nav flex-bullet-'+slide_n+'" data-target="'+i+'">slide '+i+'</a></li>');
					jQuery('#sliderbullets ul.ts_preview').append('<li><img src="'+thumbnail+'" alt="" width="130"/></li>');
				});
					   
				//Adjust pagination size		   
				var bullets_count = jQuery(this).find('li.slide-holder').length;
					bullets_count = parseInt(bullets_count);	
					bullets_holder_size = bullets_count * 18;		
					jQuery('ul.ts_container').css('width', bullets_holder_size+'px');		   
					   
					   	
					   
				//Execute the thumbnails hover	   
				jQuery('#sliderbullets').thumbnailSlider({
					thumb_width	: 130,
					thumb_height: 87,
					easing		: 'easeOutExpo',//easeInBack
					speed		: 600
				});
				jQuery('#sliderbullets .ts_container li').first().addClass('selected');
			}//end if thumbnails

			else if (bullets == 'normal') {
				jQuery(slider_parent).addClass('thumbnails-normal');
			} else if (bullets == 'none') {
				jQuery(slider_parent).addClass('bullets-hide');
			}
			
			
			
					
					
			jQuery("#"+slider_id)     
			.flexslider({       
				animation: ""+effect+"",
				useCSS: false,
				animationLoop: loop,
				slideshow: slider_auto,                //Boolean: Animate slider automatically
				slideshowSpeed: speed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationSpeed: 600,
				smoothHeight: true,
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
				video: true,
				controlNav: true,
				directionNav: true,
				start: function(slider){
					jQuery('body').removeClass('loading');
					if (jQuery("#fslider").exist() && effect == 'fade') {
						var starting_height = jQuery('#fslider').height();
						jQuery('#fslider').css('height', starting_height + 'px');
						jQuery('#flex-slider').removeClass('initial-height');
					}
					jQuery('#fslider').animate({ opacity: 1, }, 2000);
				},      
				before: function(slider){
					if (jQuery("#"+slider_id+" .youtube-video").exist()) {
						jQuery("#"+slider_id+" .youtube-video").each(function() {
							var stopy_id = jQuery(this).find('iframe').attr('id');
							
							if (stopy_id) {
								var player = players[stopy_id];						
									player.pauseVideo();	
							}
						});
					}
					if (jQuery("#"+slider_id+" .vimeo-video").exist()) {
						jQuery("#"+slider_id+" .vimeo-video").each(function() {
							var stopv_id = jQuery(this).find('iframe').attr('id');
							
							if (stopv_id) {
								player=$f(document.getElementById(stopv_id));
								player.api('pause');	
							}
						});
					}
					
					//Update the selected bullet
					jQuery('#sliderbullets .ts_container li').removeClass('selected');
				},//end before
				after: function (slider) {
					if(slider.slides.eq(slider.currentSlide).find('.youtube-video').length > 0){
						var ssvid = slider.slides.eq(slider.currentSlide).find('.youtube-video').attr('data-autoplay');	
						if (ssvid == 'false') { ssvid = 0; } else { ssvid = 1; }
							if (ssvid == 1) {
								var ssvid_id = slider.slides.eq(slider.currentSlide).find('.youtube-video iframe').attr('id');
								var frameID = ssvid_id;
								var player = players[frameID];
									player.playVideo();
									jQuery('#'+slider_id).flexslider("pause");
								}	
						}
						if(slider.slides.eq(slider.currentSlide).find('.vimeo-video').length > 0){
							var ssvid_id = slider.slides.eq(slider.currentSlide).find('.vimeo-video iframe').attr('id');					    
							var ssvid = slider.slides.eq(slider.currentSlide).find('.vimeo-video').attr('data-autoplay');	
							if (ssvid == 'false') { ssvid = 0; } else { ssvid = 1; }  					
								if (ssvid == 1) {
									player=$f(document.getElementById(ssvid_id));
									player.api('play');
									jQuery('#'+slider_id).flexslider("pause");
								}
						}
						
					//Update the bullets navigation	
					if(bullets == 'thumbnails'){
						var current_slide = slider.slides.eq(slider.currentSlide).find('.slide').attr('data-slide-number');
							current_slide =  parseInt(current_slide);
							current_slide = current_slide;
						var total_slides = slider.count;	
						if (current_slide > total_slides) {
							current_slide = 1;
						}					
						
						//console.log(current_slide);
						jQuery('.flex-bullet-'+current_slide+'').parent().addClass('selected');
					}//end if bullets
					
						
				}//end after
						   
			});		
			
			
			
			//Autoplay videos in first slide if set
			if (jQuery('#' + slider_id +' .slides li').eq(1).find('.vimeo-video').exist()) {
				var autoplay_video = jQuery('#' + slider_id +' .slides li').eq(1).find('.vimeo-video').attr('data-autoplay');
					if (autoplay_video == 'false') { autoplay_video = 0; } else { autoplay_video = 1; }
					if (autoplay_video == 1) {
						var video_id = jQuery('#' + slider_id +' .slides li').eq(1).find('.vimeo-video iframe').attr('id');	
						
						setTimeout(function() {
							vplayer = $f(document.getElementById(video_id));
							vplayer.api('play');
							jQuery('#'+slider_id).flexslider("pause");
						}, 2800);							
					}
			}
			if (jQuery('#' + slider_id +' .slides li').eq(1).find('.youtube-video').exist()) {
				var autoplay_video = jQuery('#' + slider_id +' .slides li').eq(1).find('.youtube-video').attr('data-autoplay');
					if (autoplay_video == 'false') { autoplay_video = 0; } else { autoplay_video = 1; }
					if (autoplay_video == 1) {
						var frameID = jQuery('#' + slider_id +' .slides li').eq(1).find('.youtube-video iframe').attr('id');	
						
						setTimeout(function() {
							var player = players[frameID];
								player.playVideo();
								jQuery('#'+slider_id).flexslider("pause");
						}, 2800);							
					}
			}
			
			
			//Bullets click navigation
			jQuery('.flex-nav').live('click', function(e) {
				e.preventDefault();
				
				//hide the thumbnail
				jQuery('#sliderbullets .ts_thumbnails').css('display', 'none');
				
				//Go to the new slide
				var target = jQuery(this).attr('data-target');
					target = parseInt(target);	
					jQuery("#"+slider_id).flexslider(target);
			});//end bullets click
		 });
	};// end flexSlider function
	//Execute the flexSlider function
	//Only if necessary
	if (jQuery(".flexslider").exist())
		flexSlider();
		
		
		
		
	/*=================================================================*/
	/* Revolution Slider
	/*=================================================================*/	
	var revSlider = function() {
		if (jQuery.fn.cssOriginal!=undefined)
			jQuery.fn.css = tpj.fn.cssOriginal;
			var slider_speed = jQuery('.revslider').attr('data-speed');
			var slider_height = jQuery('.revslider').attr('data-height');
			
			jQuery('.bannercontainer').show();
			
			jQuery('.banner').revolution({
				delay: slider_speed,
				startheight: slider_height,
				startwidth:960,
				hideThumbs:0,
				navigationType:"bullet",					//bullet, thumb, none, both		(No Thumbs In FullWidth Version !)
				navigationArrows:"nexttobullets",		//nexttobullets, verticalcentered, none
				navigationStyle:"round",				//round,square,navbar
				touchenabled:"on",						// Enable Swipe Function : on/off
				onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off
				navOffsetHorizontal:0,
				navOffsetVertical:20,
				stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
				stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
				shadow:1,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
				fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
									//shuffle:"on"							// Turn Shuffle Mode on and Off ! Will be randomized only once at the start.
			});
	};// end revSlider function
	//Execute the revSlider function
	//Only if necessary
	if (jQuery(".revslider").exist())
		revSlider();
		
		
	
				
	
	/* #Hover Effect
	================================================== */
	var hoverEffect = function() {
	
		var hover_type = '';
		if (jQuery(".project .plus").exist()) {
			hover_effect = 'plus';
			jQuery(".project .plus").removeAttr("style");
		} else if (jQuery(".project .project_type").exist()){
			hover_effect = 'ptype';
		} else {
			hover_effect = '';
		}		
		
		//align the plus horizontally
		if (hover_effect == 'plus') {
			jQuery('.project').each(function() {
				var hovered = jQuery(this);
				var thumb_height = hovered.find('.post-thumbnail').height();
					//total container width
				var thumb_width = hovered.find('.post-thumbnail').width();
				var original_thumb_width = thumb_width;
				
					
				var plus_height = hovered.find('.plus').height();
					//Total text width
				var plus_width = hovered.find('.plus').width();
					
					thumb_height = thumb_height / 2;
					thumb_width = thumb_width / 2;
					
					
					plus_height = plus_height / 2;
					plus_width = plus_width / 2;
					
				var temp_plus_width = 	plus_width;
				var temp_container_width = thumb_width;
					
					thumb_height = thumb_height - plus_height;
					thumb_width = thumb_width - plus_width;
					
					
					//hovered.find('.plus').css('left', thumb_width+'px');
					if (temp_plus_width >= temp_container_width) {
						hovered.find('.plus').css('left', thumb_width+'px');
					} else {
						var small_container_text = original_thumb_width - 30;							
							/*var cssObj = {
							      'width' : small_container_text+'px',
							      'left' : '0px'
							}
							hovered.find('.plus').css(cssObj);*/
					}
			});
		}
		
		if (jQuery(hover_effect !== '')) {
			jQuery('.project .hover').css('opacity', '0.55');
			jQuery('.project').hover(function() {
					
					var hovered = jQuery(this);
					var thumb_height = hovered.find('.post-thumbnail').height();
					var thumb_width = hovered.find('.post-thumbnail').width();
					
					
					var plus_height = hovered.find('.plus').height();
					var plus_width = hovered.find('.plus').width();
					
						thumb_height = thumb_height / 2;
						thumb_width = thumb_width / 2;
						plus_height = plus_height / 2;
						plus_width = plus_width / 2;	
						
						thumb_height = thumb_height - plus_height;
						thumb_width = thumb_width - plus_width;
						
					hovered.find('.hover').stop(true, true).delay(100).fadeIn(500);
					
					if (hover_effect == 'plus') {
						hovered.find('.plus').stop(true).animate({
								opacity: 1,
								//left: thumb_width + 'px',
								top: thumb_height +'px' 
								}, 100, function() {
						});
					}//Plus Hover Start
					
			}, function() {
					if (hover_effect == 'plus') {
						var hovered = jQuery(this);
						hovered.find('.plus').stop(true).animate({
								opacity: 0,
								top: '-30px' 
								}, 100, function() {
						});
						
					}//Plus Hover end
					jQuery(this).find('.hover').stop(true, true).delay(100).fadeOut();
			});
		}
	};// end hoverEffect function
	//Execute the hoverEffect function
	//Only if necessary
	if (jQuery(".hover").exist())
		hoverEffect();
	
	
	
	
	/* #Filtrable Portfolio
		================================================== */
	var portfolio = function() {
	
	
		if (jQuery('#portfolio').hasClass('one-cols')) {
			return false;
		}
	
		
		jQuery('#postsNav').addClass('portfolio-pag');
		
		//preload images
		if (jQuery('html').hasClass('safari') || jQuery('html').hasClass('chrome') || jQuery('html').hasClass('firefox') || jQuery('html').hasClass('csstransitions')) {
			jQuery('li .post-thumbnail, .project-type').css('opacity', 0);
			jQuery("ul[data-liffect] li .post-thumbnail").each(function (i) {
				jQuery(this).attr("style", "-webkit-animation-delay:" + i * 300 + "ms;"
				   	+ "-moz-animation-delay:" + i * 300 + "ms;"
				   	+ "-o-animation-delay:" + i * 300 + "ms;"
					+ "animation-delay:" + i * 300 + "ms;");
				 if (i == jQuery("ul[data-liffect] li").size() -1) {
					jQuery("ul[data-liffect]").addClass("play");
				 }
			});
			jQuery("ul[data-liffect] li .project-type").each(function (i) {
				jQuery(this).attr("style", "-webkit-animation-delay:" + i * 300 + "ms;"
					+ "-moz-animation-delay:" + i * 300 + "ms;"
					+ "-o-animation-delay:" + i * 300 + "ms;"
					+ "animation-delay:" + i * 300 + "ms;");
				 if (i == jQuery("ul[data-liffect] li").size() -1) {
					jQuery("ul[data-liffect]").addClass("play")
				}
			});   
		} else {
			jQuery("#portfolio-projects").preloadify({ imagedelay:100, mode: "sequence", fadein: 600 });
			jQuery('.project-type').css('top', '0px');
		}   
		//end preload images
			
			
		var $container = jQuery('#portfolio');
			
			
				$container.isotope({
					filter: '*',
					resizable : true,
					transformsEnabled : true,
					itemSelector : '.project',
					layoutMode : 'fitRows'
				});
			
				
				
			// filter items when filter link is clicked
			jQuery('#filters a').click(function(){
				jQuery('#filters a').removeClass('selected');		
				    var selector = jQuery(this).attr('data-filter');
				    jQuery(this).addClass('selected');
				    $container.isotope({ filter: selector });
				    return false;
			});
				 
				 
				 
			//Update layout porfolio style 1	 
			var $optionSets = jQuery('#filter-bar .layout'),
				$optionLinks = $optionSets.find('a');
				$optionLinks.click(function(){
			var $this = jQuery(this);
				// don't proceed if already selected
				if ( $this.hasClass('active') ) {
					return false;
				}
				var $optionSet = $this.parents('.layout');
					$optionSet.find('.active').removeClass('active');
					$this.addClass('active');
				   
				// make option object dynamically, i.e. { filter: '.my-filter-class' }
				var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
				columns = $this.attr('data-columns');
				             
				// parse 'false' as false boolean
				value = value === 'false' ? false : value;
				options[ key ] = value;
				         
				if (value !== 'masonry') {
					if (columns) {
						if (columns == 'three') {
							jQuery('#portfolio').removeClass('masonry').removeClass('two-cols').addClass('three-cols');
							jQuery('#portfolio li').removeClass('span6').addClass('span4');
						}
						if (columns == 'two') {
							jQuery('#portfolio').removeClass('masonry').removeClass('three-cols').addClass('two-cols');
							jQuery('#portfolio li').removeClass('span4').addClass('span6');
				         }
				      }
				} else {
					jQuery('#portfolio').removeClass('three-cols').removeClass('two-cols').addClass('masonry');
					jQuery('#portfolio li').removeClass('span4').removeClass('span6');
				}
				         
				//Change the layout
				if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
					// changes in layout modes need extra logic
					changeLayoutMode( $this, options );
				} else {
					// otherwise, apply new options
					$container.isotope( options );
				}
				//Reset hover effect
				hoverEffect();
				return false;
			});
		};// end portfolio function
		//Execute the portfolio function
		//Only if necessary
		if (jQuery("#portfolio").exist() && !jQuery("#portfolio").hasClass('full-portfolio'))
			portfolio();
		
	
	
	
	
	
	
	
	
	
	
	
	
	/*=================================================================*/
	/* WooCommerce
	/*=================================================================*/	
	var WooCommerce = function() {	
		
		jQuery('#wooshop .products li.product').each(function(i) {
			
			var product_link = jQuery(this).find('a').first().attr('href');
			jQuery(this).find('img').before('<span class="product-hover"><a class="more-link" href="'+product_link+'">Information</a></span>');
			jQuery(this).find(".add_to_cart_button").appendTo(jQuery(this).find('.product-hover'));
			jQuery(this).find('.add_to_cart_button').removeClass('button');
		
		});
		
		
		
		
		
		
		//Set opacity on each .hover to 0%
		//code used in the portfolio page
		jQuery(".hover").css({'opacity':'0'});
		jQuery('#wooshop .products li.product').hover(
			function() {
				jQuery(this).find('.product-hover').stop().fadeTo(400, 1);
				
				
				jQuery(this).find('.more-link').animate({
				    opacity: 1,
				    left: '23px'
				  }, 300, function() {
				    // Animation complete.
				});
				
				jQuery(this).find('.add_to_cart_button').animate({
				    opacity: 1,
				    left: '23px'
				  }, 300, function() {
				    // Animation complete.
				});
				
				
				
				
				
			},
			function() {
				jQuery(this).find('.product-hover').stop().fadeTo(300, 0);
				jQuery(this).find('.more-link').animate({
				    opacity: 0,
				    left: '200px'
				  }, 300, function() {
				    // Animation complete.
				});
				
				jQuery(this).find('.add_to_cart_button').animate({
				    opacity: 0,
				    left: '-200px'
				  }, 300, function() {
				    // Animation complete.
				});
				
			}
		)
		
		
		
		
		
	};// end WooCommerce function
	//Execute the WooCommerce function
	//Only if necessary
	if (jQuery("#wooshop").exist())
		WooCommerce();
			
			
			
			
			
			
				
		
	//Execute fitVids on every page				
	jQuery('body').fitVids();
	
});













jQuery(document).ready(function(){
	/* #Browser class
	================================================== */
	jQuery("html").addClass(jQuery.browser.name);
	if(jQuery.browser.mobile){
	   jQuery('html').addClass('mobile');
	}else{
		jQuery('html').addClass('desktop');
	}
	
	
	jQuery('.bannercontainer').hide();
	
	/*=================================================================*/
	/* Theme Menu
	/*=================================================================*/
	var themeMenu = function() {
	
		jQuery('#menu.default-menu li').each(function() {
			if (jQuery(this).find('ul').length > 0) {
				jQuery(this).addClass('dropdown');
				jQuery(this).find('ul.children').addClass('dropdown-menu');
			}
		});
		jQuery('#menu.default-menu li.current_page_ancestor').addClass('current_page_item');
		
		jQuery('#menu li.current_page_ancestor, #menu li.current-menu-parent').addClass('current_page_item');
	
		jQuery('ul.nav li.dropdown ul').hide();
		
		jQuery('ul.nav li').hover(
			function(){
				jQuery('ul.nav li').not(jQuery('ul', this)).stop();
				jQuery('ul:first', this).stop('true', 'true').slideDown(300);
			},
			function(){
				//jQuery('ul', this).stop('true', 'true').slideUp();
				jQuery('ul', this).hide();
			}
		);
	};
	if (jQuery("html").hasClass('desktop'))
		themeMenu();
	
	
	
	
	
	/*=================================================================*/
	/* jQuery Tabs
	/*=================================================================*/
	var tabsFunction = function() {
		jQuery('ul.nav-tabs').each(function() {
			var tabs_id = jQuery(this).attr('id');
			
			jQuery('#'+tabs_id+' a').click(function (e) {
			  e.preventDefault();
			  jQuery(this).tab('show');
			  
			  var display_tab = jQuery(this).attr('href');
			  //Slider height
			  if (jQuery(display_tab).find('.nivoSlider').length > 0) {
			  	var slider = jQuery(display_tab).find('.nivoSlider').attr('id');
			  	var idx = 0; // '0' is the first slide
			  	// set nivo's currentSlide var to one before the idx value
			  	jQuery('#'+slider).data('nivo:vars').currentSlide = idx - 1;
			  	// trigger a nextNav click
			  	jQuery("#"+slider+" a.nivo-nextNav").trigger('click'); // trigger a click on the nextNav	
			  }
			  
			  
			});
			
		});
	
		
	};
	if (jQuery("ul.nav-tabs").exist())
		tabsFunction();
	
	
	/*=================================================================*/
	/* jQuery Accordion
	/*=================================================================*/
	var accordionFunction = function() {
		jQuery('.accordion-body').each(function() {
			if (jQuery(this).hasClass('in')) {
				jQuery(this).parent().addClass('open');
			} else {
				jQuery(this).parent().addClass('closed');
			}
		});
		jQuery('.accordion-toggle').live('click', function() {
			var parent = jQuery(this).attr('data-parent');
			jQuery(parent).find('.accordion-group').each(function() {
				jQuery(this).removeClass('open');
				jQuery(this).addClass('closed');
			});
			jQuery(this).parent().parent().removeClass('closed').addClass('open');
		});
	};
	if (jQuery(".accordion").exist())
		accordionFunction();
	
	
	/*=================================================================*/
	/* jQuery Tooltips
	/*=================================================================*/
	var toolTips = function() {
		jQuery('.ttip').tooltip();
	};
	if (jQuery(".ttip").exist())
		toolTips();
		
	
	/* #Responsive audioplayer
	================================================== */
	var audioPlayer = function() {
		jQuery( function() { jQuery( '.media-audio' ).audioPlayer(); } );
	};// end audioPlayer function
	//Execute the audioPlayer function
	//Only if necessary
	if (jQuery(".media-audio").exist())
		audioPlayer();
	
	
	/*=================================================================*/
	/* Numbered Columns
	/*=================================================================*/
	
	
	jQuery('.col').each(function() {
		jQuery(this).textfill({ maxFontPixels: 436 });
	});
	
	
	
	/* #Select Fields
	================================================== */
	jQuery('.select-field').each(function(){
		var optionText = jQuery('option:selected', this).text();
		var topTitlte = jQuery(this).closest('.select-holder').attr('id');
		jQuery('#'+topTitlte+' span.select-header').text(optionText);
	});
	
	jQuery('.select-field').live('change', function(){
		var optionText = jQuery('option:selected', this).text();
		var topTitlte = jQuery(this).closest('.select-holder').attr('id');
		jQuery('#'+topTitlte+' span.select-header').text(optionText);
	});
	
	
	
	/* #Contact Form
	================================================== */
	jQuery('#contactform').submit(function() {
		var action = jQuery(this).attr('action');
		var values = jQuery(this).serialize();
		var wpajax = jQuery(this).attr('data-ajax');
		
		jQuery('#submit').attr('disabled', 'disabled');
		jQuery('#form-loader').fadeIn();
	
		jQuery("#message").slideUp(750, function() {
			jQuery('#message').hide();
				jQuery.ajax({
				   type: "POST",
				   url: wpajax,
				   data: 'action=mcstudioscontact_form&'+values,
				   success: function(data) {
				   		data = data.replace('0', '');				   		
				   		
				   		jQuery('#message').html(data);
				   		jQuery('#message').slideDown('slow');
				   		jQuery('#contactform #form-loader').fadeOut('fast');
				   		
				   		jQuery('#submit').removeAttr('disabled');
				   		if (data.match('success') != null) jQuery('#contactform').slideUp('slow');
				    }
				});
			});
			return false;
	});
	
	
	
	
	
	/*=================================================================*/
	/* Share Widget
	/*=================================================================*/
	jQuery('.sshare-twitter').sharrre({
	  share: {
	    twitter: true
	  },
	  enableHover: false,
	  enableTracking: true,
	  enableCounter: false,
	  buttons: { twitter: {via: ''}},
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('twitter');
	  }
	});
	jQuery('.sshare-facebook').sharrre({
	  share: {
	    facebook: true
	  },
	  enableHover: false,
	  enableTracking: true,
	  enableCounter: false,
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('facebook');
	  }
	});
	jQuery('.sshare-google').sharrre({
	  share: {
	    googlePlus: true
	  },
	  enableHover: false,
	  enableTracking: true,
	  enableCounter: false,
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('googlePlus');
	  }
	});
	
	
	
	
	/*=================================================================*/
	/* Lightbox
	/*=================================================================*/
	jQuery("a[rel^='lightbox']").prettyPhoto();
	
	
	
	/*=================================================================*/
	/* Comments form
	/*=================================================================*/
	var postcomment_btn_color = jQuery('#commentform input[type=submit]').attr('id');
	var postcomment_btn_text = jQuery('#commentform input[type=submit]').val();
	
	jQuery('#commentform input[type=submit]').remove();
	
	jQuery('#commentform').append('<button  class="nbtn '+postcomment_btn_color+'" ><span>'+postcomment_btn_text+'</span></button>');
	
	
	/* #Google Maps
	================================================== */
	function setMapAddress( address, zoom, id)
	{
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { address : address }, function( results, status ) {
			if( status == google.maps.GeocoderStatus.OK ) {
				var latlng = results[0].geometry.location;
				var options = {
					zoom: zoom,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
			var map =	new google.maps.Map( document.getElementById( ''+id+'' ), options );							
				var image = 'http://cdn.picdi.sh/assets/www/layout/map.pin.png';
				    var marker = new google.maps.Marker({
				        position: results[0].geometry.location,
				        map: map,
						animation: google.maps.Animation.DROP,
				        icon: image
				    });	
				
						google.maps.event.addListener(marker, 'click', function() {
						      infowindow.open(map,marker);
						    });
				
					}
			 } 
		);
	};
	if (jQuery(".gmap").exist()) {
		jQuery('.gmap').each(function() {
			var map_id = jQuery(this).attr('id');
			var address = jQuery(this).attr('data-target');
			var zoom = jQuery(this).attr('data-zoom');
				zoom = parseInt(zoom); 
			
			setMapAddress( address, zoom, map_id);
			
		});
	}
	
	
	
	
	
	
	
	function toString(obj){
	  //return "{top: " + obj.top + " left: " + obj.left + "}";
		return obj.left;
	}
	
	function getRelativePosition(selector){
		var $parentElem = jQuery("#main-content");
		var $element = jQuery(selector);
		var elementPosition = $element.position();
		var parentPosition = $parentElem.position();
		return {top: elementPosition.top - parentPosition.top,
	                left: elementPosition.left -parentPosition.left};
	}
	        
	//Little fix for chrome that does not get a correct
	//position for the block
	if(jQuery('html').hasClass('chrome') || jQuery('html').hasClass('safari')){
		//jQuery('.adjust').wrapAll('<div class="relative_block" />');    
	}
	        
	        
	jQuery('.adjust').each(function(){
		var sectionP = jQuery(this).position();
		var relativePosition = getRelativePosition(this);
		var elem_cor = toString(relativePosition);
		
			//console.log(elem_cor);
		
			if(elem_cor <= '50'){
		        jQuery(this).addClass('nomarginleft');
		    }
		    
		    console.log(relativePosition);
	});
	
});







/* #Placeholders
================================================== */
(function($) {
	if ("placeholder" in document.createElement("input")) return;

	$(document).ready(function(){
		$(':input[placeholder]').not(':password').each(function() {
			setupPlaceholder($(this));
		});

		$(':password[placeholder]').each(function() {
			setupPasswords($(this));
		});
	   
		$('form').submit(function(e) {
			clearPlaceholdersBeforeSubmit($(this));
		});
	});

	function setupPlaceholder(input) {

		var placeholderText = input.attr('placeholder');

		setPlaceholderOrFlagChanged(input, placeholderText);
		input.focus(function(e) {
			if (input.data('changed') === true) return;
			if (input.val() === placeholderText) input.val('');
		}).blur(function(e) {
			if (input.val() === '') input.val(placeholderText); 
		}).change(function(e) {
			input.data('changed', input.val() !== '');
		});
	}

	function setPlaceholderOrFlagChanged(input, text) {
		(input.val() === '') ? input.val(text) : input.data('changed', true);
	}

	function setupPasswords(input) {
		var passwordPlaceholder = createPasswordPlaceholder(input);
		input.after(passwordPlaceholder);

		(input.val() === '') ? input.hide() : passwordPlaceholder.hide();

		$(input).blur(function(e) {
			if (input.val() !== '') return;
			input.hide();
			passwordPlaceholder.show();
		});
			
		$(passwordPlaceholder).focus(function(e) {
			input.show().focus();
			passwordPlaceholder.hide();
		});
	}

	function createPasswordPlaceholder(input) {
		return $('<input>').attr({
			placeholder: input.attr('placeholder'),
			value: input.attr('placeholder'),
			id: input.attr('id'),
			readonly: true
		}).addClass(input.attr('class'));
	}

	function clearPlaceholdersBeforeSubmit(form) {
		form.find(':input[placeholder]').each(function() {
			if ($(this).data('changed') === true) return;
			if ($(this).val() === $(this).attr('placeholder')) $(this).val('');
		});
	}
})(jQuery);

/* #Div Exist
================================================== */
(function($) {
    if (!$.exist) {
        $.extend({
            exist: function(elm) {
                if (typeof elm == null) return false;
                if (typeof elm != "object") elm = $(elm);
                return elm.length ? true : false;
            }
        });
        $.fn.extend({
            exist: function() {
                return $.exist($(this));
            }
        });
    }
})(jQuery);

/* #Equal Heights
================================================== */
(function(jQuery) {
	jQuery.fn.equalHeights = function() {
		var maxheight = 0;
		jQuery(this).each(function(){
			maxheight = (jQuery(this).height() > maxheight) ? jQuery(this).height() : maxheight;
		});
		jQuery(this).css('height', maxheight);
	}
})(jQuery);







(function($) {
	$.fn.thumbnailSlider = function(options) {
		var opts = $.extend({}, $.fn.thumbnailSlider.defaults, options);
		return this.each(function() {
			var $this 				= $(this),
				o 					= $.meta ? $.extend({}, opts, $pxs_container.data()) : opts;
			
			var $ts_container		= $this.children('.ts_container'),
				$ts_thumbnails		= $ts_container.children('.ts_thumbnails'),
				$nav_elems			= $ts_container.children('li').not($ts_thumbnails),
				total_elems			= $nav_elems.length,
				$ts_preview_wrapper	= $ts_thumbnails.children('.ts_preview_wrapper'),
				$arrow				= $ts_thumbnails.children('span'),
				$ts_preview			= $ts_preview_wrapper.children('.ts_preview');
			
			/*
			calculate sizes for $ts_thumbnails:
			width 	-> width thumbnail + border (2*5)
			height 	-> height thumbnail + border + triangle height(6)
			top		-> -(height plus margin of 5)
			left	-> leftDot - 0.5*width + 0.5*widthNavDot 
				this will be set when hovering the nav,
				and the default value will correspond to the first nav dot	
			*/
			var w_ts_thumbnails	= o.thumb_width + 2*5,
				h_ts_thumbnails	= o.thumb_height + 2*5 + 6,
				t_ts_thumbnails	= -(h_ts_thumbnails + 5),
				$first_nav		= $nav_elems.eq(0),
				l_ts_thumbnails	= $first_nav.position().left - 0.5*w_ts_thumbnails + 0.5*$first_nav.width();
			
			$ts_thumbnails.css({
				width	: w_ts_thumbnails + 'px',
				height	: h_ts_thumbnails + 'px',
				top		: t_ts_thumbnails + 'px',
				left	: l_ts_thumbnails + 'px'
			});
			
			/*
			calculate the top and left for the arrow of the tooltip
			top		-> thumb height + border(2*5)
			left	-> (thumb width + border)/2 -width/2
			*/
			var t_arrow	= o.thumb_height + 2*5,
				l_arrow	= (o.thumb_width + 2*5) / 2 - $arrow.width() / 2;
			$arrow.css({
				left	: l_arrow + 'px',
				top		: t_arrow + 'px'
			});
			
			/*
			calculate the $ts_preview width -> thumb width times number of thumbs
			*/
			$ts_preview.css('width' , total_elems*o.thumb_width + 'px');
			
			/*
			set the $ts_preview_wrapper width and height -> thumb width / thumb height
			*/
			$ts_preview_wrapper.css({
				width	: o.thumb_width + 'px',
				height	: o.thumb_height + 'px'
			});
			
			//hover the nav elems
			$nav_elems.bind('mouseenter',function(){
				var $nav_elem	= $(this),
					idx			= $nav_elem.index();
					
				/*
				calculate the new left
				for $ts_thumbnails
				*/
				var new_left	= $nav_elem.position().left - 0.5*w_ts_thumbnails + 0.5*$nav_elem.width();
				
				$ts_thumbnails.stop(true)
							  .show()	
							  .animate({
								left	: new_left + 'px'
							  },o.speed,o.easing);				  
				
				/*
				animate the left of the $ts_preview to show the right thumb 
				*/
				$ts_preview.stop(true)
						   .animate({
								left	: -idx*o.thumb_width + 'px'
						   },o.speed,o.easing);
				
				//zoom in the thumb image if zoom is true
				if(o.zoom && o.zoomratio > 1){
					var new_width	= o.zoomratio * o.thumb_width,
						new_height	= o.zoomratio * o.thumb_height;
					
					//increase the $ts_preview width in order to fit the zoomed image
					var ts_preview_w	= $ts_preview.width();
					$ts_preview.css('width' , (ts_preview_w - o.thumb_width + new_width)  + 'px');
					
					$ts_preview.children().eq(idx).find('img').stop().animate({
						width		: new_width + 'px',
						height		: new_height + 'px'
					},o.zoomspeed);
				}		
				
			}).bind('mouseleave',function(){
				//if zoom set the width and height to defaults
				if(o.zoom && o.zoomratio > 1){
					var $nav_elem	= $(this),
						idx			= $nav_elem.index();
					$ts_preview.children().eq(idx).find('img').stop().css({
						width	: o.thumb_width + 'px',
						height	: o.thumb_height + 'px'	
					});	
				}
				
				$ts_thumbnails.stop(true)
							  .hide();
							  
			}).bind('click',function(){
				var $nav_elem	= $(this),
					idx			= $nav_elem.index();
				
				o.onClick(idx);
			});
			
		});
	};
	$.fn.thumbnailSlider.defaults = {
		speed		: 100,//speed of each slide animation
		easing		: 'jswing',//easing effect for the slide animation
		thumb_width	: 75,//your photos width
		thumb_height: 75,//your photos height
		zoom		: false,//zoom animation for the thumbs
		zoomratio	: 1.3,//multiplicator for zoom (must be > 1)
		zoomspeed	: 15000,//speed of zoom animation
		onClick		: function(){return false;}//click callback
	};
})(jQuery);







; (function($) {
    /**
    * Resizes an inner element's font so that the inner element completely fills the outer element.
    * @author Russ Painter WebDesign@GeekyMonkey.com
    * @author Blake Robertson 
    * @version 0.2 -- Modified it so a min font parameter can be specified.
    *    
    * @param {Object} Options which are maxFontPixels (default=40), innerTag (default='span')
    * @return All outer elements processed
    * @example <div class='mybigdiv filltext'><span>My Text To Resize</span></div>
    */
    $.fn.textfill = function(options) {
        var defaults = {
            maxFontPixels: 540,
            minFontPixels: 30,
            innerTag: 'span.number'
        };
        var Opts = jQuery.extend(defaults, options);
        return this.each(function() {
            var fontSize = Opts.maxFontPixels;
            var ourText = $(Opts.innerTag + ':visible:first', this);
            var maxHeight = $(this).height();
            var maxWidth = $(this).width();
            var textHeight;
            var textWidth;
            do {
                ourText.css('font-size', fontSize  + 170);
                textHeight = ourText.height();
                textWidth = ourText.width();
                fontSize = fontSize - 1;
            } while ((textHeight > maxHeight || textWidth > maxWidth) && fontSize > Opts.minFontPixels);
        });
    };
})(jQuery);



(function(a){jQuery.browser.mobile=/android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(ad|hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|tablet|treo|up\.(browser|link)|vodafone|wap|webos|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);