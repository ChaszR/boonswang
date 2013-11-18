<?php
/**
 * MC Studios Widgets
 *
 * This file includes the all widgets used by this theme.
 * With this file you can edit the output of the widget or add more 
 * configuration options to the selected widget.
 *
 * @author		Manuel Cervantes
 * @copyright	Copyright (c) Manuel Cervantes - MC Studios
 * @link		http://mcstudiosmx.com
 * @link		http://mcstudiosmx.com
 * @since		Version 1.1
 * @package 	MCFramework
 * @version 	Incarnation-Edition (Sub: Eunoia 1.2 Edit)
*/ 
global $data;




/**
 * MC Studios Flickr
 *
 * Widget that display the most recent images from your flickr accourn
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */

class mcstudios_flickr extends WP_Widget {
    /** constructor */
    function mcstudios_flickr() {
        parent::WP_Widget(false, $name = 'Flickr Widget');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$id = apply_filters('flickr_id', $instance['id']);
		$number = apply_filters('flickr_id', $instance['number']);
        ?>
              <?php echo $before_widget; ?>
				
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
       				 <div class="flickr">          
						<div class="block-content flickr">
							<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script> 
						</div>
					</div>	
              <?php echo $after_widget; ?>
        <?php
    }


    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['id'] = stripslashes($new_instance['id']);
	$instance['number'] = stripslashes($new_instance['number']);
        return $instance;
    }
    
    
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
        ?>
            <p>
            	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?></label>
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>


			<p>
				<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr id (<a href="http://www.idgettr.com">idGettr</a>):', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
			</p>
			
			
			<p>	
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos:', 'mclang'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
			</p>
			
        <?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_flickr");'));













/**
 * MC Studios Recent Posts
 *
 * Widget that display the most recent posts from your site
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */

class mcstudios_recentPosts extends WP_Widget {
    /** constructor */
    function mcstudios_recentPosts() {
        parent::WP_Widget(false, $name = 'Custom Recent Posts');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$postnumber = apply_filters('widget_content', $instance['postnumber']);
		$cats = apply_filters('widget_content', $instance['cats']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                  


							<ul class="posts-widget">
							<?php
							$c = 0;
							$pc = new WP_Query('cat='.$cats.'&posts_per_page=' . $postnumber .''); ?>
							<?php while ($pc->have_posts()) : $pc->the_post(); $c++; 
							$class = '';
							if( $c == 2) {
								$class = ' class="second"';
								$c = 0;
							}
							?>
							<li<?php echo $class; ?>>
								<div class="text">
									<a href="<?php the_permalink();?>">
										<span class="note radius"><span class="note-bg"></span></span><?php the_title(); ?></a>
									<div class="clear"></div>
								</div>
							</li>
							<?php endwhile; ?>
							</ul>

              <?php echo $after_widget; ?>
        <?php
    }


    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['postnumber'] = stripslashes($new_instance['postnumber']);
	$instance['cats'] = stripslashes($new_instance['cats']);
        return $instance;
    }
    
    
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$postnumber = esc_attr($instance['postnumber']);
		$cats = esc_attr($instance['cats']);
        ?>
        
            <p>
            	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?></label>
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>


			<p>
				<label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to display:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" name="<?php echo $this->get_field_name('postnumber'); ?>" type="text" value="<?php echo $postnumber; ?>" />
			</p>
			
			
			<p>	
				<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories ID:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('cats'); ?>" name="<?php echo $this->get_field_name('cats'); ?>" type="text" value="<?php echo $cats; ?>" />
			</p>
			
        <?php 
    }

}
//add_action('widgets_init', create_function('', 'return register_widget("mcstudios_recentPosts");'));











/**
 * MC Studios Popular Posts
 *
 * Widget that display the most popular posts based in the number of comments
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */

class mcstudios_popularPosts extends WP_Widget {
    /** constructor */
    function mcstudios_popularPosts() {
        parent::WP_Widget(false, $name = 'Popular Posts');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$postnumber = apply_filters('widget_content', $instance['postnumber']);
				$cats = apply_filters('widget_content', $instance['cats']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                  


							<ul class="posts-widget">
							<?php
							$c = 0;
							$pc = new WP_Query('posts_per_page=' . $postnumber .'&cat='.$cats.'&orderby=comment_count'); ?>
							<?php  while ($pc->have_posts()) : $pc->the_post(); $c++; 
							
							$class = '';
							if( $c == 2) {
								$class = ' class="second"';
								$c = 0;
							}
							
							?>
							<?php $postthumbnail = get_post_meta(get_the_ID(), 'dbt_blogthumb', true); ?>
							<li<?php echo $class; ?>>
							
								<div class="text">
									<span class="icon-plus-sign"></span>
									<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
									<div class="clear"></div>
								</div>
								
								
							</li>
							<?php endwhile; ?>
							</ul>

              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['postnumber'] = stripslashes($new_instance['postnumber']);
		$instance['cats'] = stripslashes($new_instance['cats']);
        return $instance;
    }
    
    
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$postnumber = esc_attr($instance['postnumber']);
		$cats = esc_attr($instance['cats']);
        ?>
        
        
            <p>
            	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?></label>
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>


			<p>
				<label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to display:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" name="<?php echo $this->get_field_name('postnumber'); ?>" type="text" value="<?php echo $postnumber; ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories ID:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('cats'); ?>" name="<?php echo $this->get_field_name('cats'); ?>" type="text" value="<?php echo $cats; ?>" />
			</p>
			
        <?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_popularPosts");'));













/**
 * MC Studios Social Widget
 *
 * Widget that display icons with your social networks
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */

class mcstudios_socialWidget extends WP_Widget {
    /** constructor */
    function mcstudios_socialWidget() {
        parent::WP_Widget(false, $name = 'Social Icons Widget');	
    }
    
    

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);

				$face_url = apply_filters('widget_content', $instance['face_url']);
				$face_text = apply_filters('widget_content', $instance['face_text']);
				
				$twitter_url = apply_filters('widget_content', $instance['twitter_url']);
				$twitter_text = apply_filters('widget_content', $instance['twitter_text']);
				
				$vimeo_url = apply_filters('widget_content', $instance['vimeo_url']);
				$vimeo_text = apply_filters('widget_content', $instance['vimeo_text']);
				
				$dribble_url = apply_filters('widget_content', $instance['dribble_url']);
				$dribble_text = apply_filters('widget_content', $instance['dribble_text']);
				
				
				
				$tumblr_url = apply_filters('widget_content', $instance['tumblr_url']);
				$tumblr_text = apply_filters('widget_content', $instance['tumblr_text']);
				
				
				$skype_url = apply_filters('widget_content', $instance['skype_url']);
				$show_rss = apply_filters('widget_content', $instance['show_rss']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>

							<div class="textwidget">
									
									
									<?php if ($twitter_url !== ''): ?>
										<a class="social_icn twitter" href="http://twitter.com/<?php echo $twitter_url; ?>" target="_blank"><span></span>Twitter</a>
									<?php endif ?>
									
									
									<?php if ($face_url !== ''): ?>
										<a class="social_icn face" href="<?php echo $face_url; ?>" target="_blank"><span></span>Facebook</a>
									<?php endif ?>
									
									<?php if ($show_rss == '1'): ?>
										<a class="social_icn rss" href="<?php if($data["feedburner"] !==''){ echo $data["feedburner"]; } else{ bloginfo('rss2_url'); }?>"><span></span>RSS</a>
									<?php endif ?>
									
									
									<?php if ($dribble_url !== ''): ?>
										<a class="social_icn dribble" href="<?php echo $dribble_url; ?>" target="_blank"><span></span>Dribble</a>
									<?php endif ?>
									
									<?php if ($vimeo_url !== ''): ?>
										<a class="social_icn vimeo" href="<?php echo $vimeo_url; ?>" target="_blank"><span></span>Vimeo</a>
									<?php endif ?>
									
									
									<?php if ($tumblr_url !== ''): ?>
										<a class="social_icn tumblr" href="<?php echo $tumblr_url; ?>" target="_blank"><span></span>Tumblr</a>
									<?php endif ?>
									
									
									<?php if ($skype_url !== ''): ?>
										<a class="social_icn skype" href="skype:<?php echo $skype_url; ?>?call"><span></span>Skype</a>
									<?php endif ?>
									
									
							</div>
							
							<div class="clear"></div>

              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	
	$instance['face_url'] = stripslashes($new_instance['face_url']);
	$instance['face_text'] = stripslashes($new_instance['face_text']);
	
	$instance['twitter_url'] = stripslashes($new_instance['twitter_url']);
	$instance['twitter_text'] = stripslashes($new_instance['twitter_text']);
	
	$instance['vimeo_url'] = stripslashes($new_instance['vimeo_url']);
	$instance['vimeo_text'] = stripslashes($new_instance['vimeo_text']);
	
	$instance['dribble_url'] = stripslashes($new_instance['dribble_url']);
	$instance['dribble_text'] = stripslashes($new_instance['dribble_text']);
	
	
	$instance['tumblr_url'] = stripslashes($new_instance['tumblr_url']);
	$instance['tumblr_text'] = stripslashes($new_instance['tumblr_text']);
	
	$instance['youtube_url'] = stripslashes($new_instance['youtube_url']);
	$instance['youtube_text'] = stripslashes($new_instance['youtube_text']);
	
	$instance['skype_url'] = stripslashes($new_instance['skype_url']);
	
	
	
	$instance['show_rss'] = stripslashes($new_instance['show_rss']);
	

        return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);

				$face_url = esc_attr($instance['face_url']);
				$face_text = esc_attr($instance['face_text']);
				
				$twitter_url = esc_attr($instance['twitter_url']);
				$twitter_text = esc_attr($instance['twitter_text']);
				
				$vimeo_url = esc_attr($instance['vimeo_url']);
				$vimeo_text = esc_attr($instance['vimeo_text']);
				
				$dribble_url = esc_attr($instance['dribble_url']);
				$dribble_text = esc_attr($instance['dribble_text']);
				
				$tumblr_url = esc_attr($instance['tumblr_url']);
				$tumblr_text = esc_attr($instance['tumblr_text']);
				
				$youtube_url = esc_attr($instance['youtube_url']);
				$youtube_text = esc_attr($instance['youtube_text']);
				
				$skype_url = esc_attr($instance['skype_url']);
				$show_rss = esc_attr($instance['show_rss']);

        ?>
            <p>
            	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?></label>
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php _e('Twitter Username:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" type="text" value="<?php echo $twitter_url; ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('face_url'); ?>"><?php _e('Facebook URL:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('face_url'); ?>" name="<?php echo $this->get_field_name('face_url'); ?>" type="text" value="<?php echo $face_url; ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('dribble_url'); ?>"><?php _e('Dribble URL:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('dribble_url'); ?>" name="<?php echo $this->get_field_name('dribble_url'); ?>" type="text" value="<?php echo $dribble_url; ?>" />
			</p>
			
						
			<p>
				<label for="<?php echo $this->get_field_id('vimeo_url'); ?>"><?php _e('Vimeo URL:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('vimeo_url'); ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" type="text" value="<?php echo $vimeo_url; ?>" />
			</p>
			
						
			<p>
				<label for="<?php echo $this->get_field_id('tumblr_url'); ?>"><?php _e('Tumblr URL:', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('tumblr_url'); ?>" name="<?php echo $this->get_field_name('tumblr_url'); ?>" type="text" value="<?php echo $tumblr_url; ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('show_rss'); ?>"><?php _e('Show RSS?: 1 = yes', 'mclang'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('show_rss'); ?>" name="<?php echo $this->get_field_name('show_rss'); ?>" type="text" value="<?php echo $show_rss; ?>" />
			</p>
			
			
        <?php 
    }

}
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_socialWidget");'));
















/**
 * MC Studios Social Widget
 *
 * Widget that display icons with your social networks
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */

class mcstudios_twitter_n1 extends WP_Widget {
		
		public function __construct() {
			parent::__construct(
				'mcstudios_twitter_n1', // Base ID
				'Twitter Feed', // Name
				array( 'description' => __( 'Display recent tweets', 'mclang' ), ) // Args
			);
		}

		
		//widget output
			public function widget($args, $instance) {
				extract($args);
				if(!empty($instance['title'])){ $title = apply_filters( 'widget_title', $instance['title'] ); }
				
				echo $before_widget;				
				if ( ! empty( $title ) ){ echo $before_title . $title . $after_title; }

				
					//check settings and die if not set
						if(empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])){
							echo '<strong>Please fill all widget settings!</strong>' . $after_widget;
							return;
						}
					
										
					//check if cache needs update
						$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
						$diff = time() - $tp_twitter_plugin_last_cache_time;
						$crt = $instance['cachetime'] * 3600;
						
					 //	yes, it needs update			
						if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){
							
							if(!require_once('twitteroauth.php')){ 
								echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
								return;
							}
														
							function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
							  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
							  return $connection;
							}
							  
							  							  
							$connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
							$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');
							
														
							if(!empty($tweets->errors)){
								if($tweets->errors[0]->message == 'Invalid or expired token'){
									echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
								}else{
									echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
								}
								return;
							}
							
							for($i = 0;$i <= count($tweets); $i++){
								if(!empty($tweets[$i])){
									$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
									$tweets_array[$i]['text'] = $tweets[$i]->text;			
									$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
								}	
							}							
							
							//save tweets to wp option 		
								update_option('tp_twitter_plugin_tweets',serialize($tweets_array));							
								update_option('tp_twitter_plugin_last_cache_time',time());
								
							echo '<!-- twitter cache has been updated! -->';
						}
						
						
						
						
					
					
					
										
					//convert links to clickable format
						function convert_links($status,$targetBlank=true,$linkMaxLen=250){
						 
							// the target
								$target=$targetBlank ? " target=\"_blank\" " : "";
							 
							// convert link to url
								$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
							 
							// convert @ to follow
								$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" class=\"twitter-link name-link\" title=\"Follow $2\" $target ><strong>$1</strong></a>",$status);
							 
							// convert # to search
								$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
							 
							// return the status
								return $status;
						}
					
					
					//convert dates to readable format	
						function relative_time($a) {
							//get current timestampt
							$b = strtotime("now"); 
							//get timestamp when tweet created
							$c = strtotime($a);
							//get difference
							$d = $b - $c;
							//calculate different time values
							$minute = 60;
							$hour = $minute * 60;
							$day = $hour * 24;
							$week = $day * 7;
								
							if(is_numeric($d) && $d > 0) {
								//if less then 3 seconds
								if($d < 3) return "right now";
								//if less then minute
								if($d < $minute) return floor($d) . " seconds ago";
								//if less then 2 minutes
								if($d < $minute * 2) return "about 1 minute ago";
								//if less then hour
								if($d < $hour) return floor($d / $minute) . " minutes ago";
								//if less then 2 hours
								if($d < $hour * 2) return "about 1 hour ago";
								//if less then day
								if($d < $day) return floor($d / $hour) . " hours ago";
								//if more then day, but less then 2 days
								if($d > $day && $d < $day * 2) return "yesterday";
								//if less then year
								if($d < $day * 365) return floor($d / $day) . " days ago";
								//else return more than a year
								return "over a year ago";
							}
						}	
							
					
					$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
					if(!empty($tp_twitter_plugin_tweets)){
						print '
						<div class="twitter-widget">
							<ul>';
							$fctr = '1';
							foreach($tp_twitter_plugin_tweets as $tweet){								
								print '<li><p><a class="twitter-link name-link" href="http://twitter.com/'.$instance['username'].'/" target="_blank" title="Follow us on twitter"><strong>@'.$instance['username'].'</strong></a> '.convert_links($tweet['text']).'</p><a class="twitter-timestamp" target="_blank" href="http://twitter.com/'.$instance['username'].'/statuses/'.$tweet['status_id'].'"><abbr>'.relative_time($tweet['created_at']).'</abbr></a><span class="social">L​</span></li>';
								if($fctr == $instance['tweetstoshow']){ break; }
								$fctr++;
							}
						print '
							</ul>
						</div>';
					}
				
				echo $after_widget;
			}
			
		
		//save widget settings 
			public function update($new_instance, $old_instance) {				
				$instance = array();
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['consumerkey'] = strip_tags( $new_instance['consumerkey'] );
				$instance['consumersecret'] = strip_tags( $new_instance['consumersecret'] );
				$instance['accesstoken'] = strip_tags( $new_instance['accesstoken'] );
				$instance['accesstokensecret'] = strip_tags( $new_instance['accesstokensecret'] );
				$instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
				$instance['username'] = strip_tags( $new_instance['username'] );
				$instance['tweetstoshow'] = strip_tags( $new_instance['tweetstoshow'] );

				if($old_instance['username'] != $new_instance['username']){
					delete_option('tp_twitter_plugin_last_cache_time');
				}
				
				return $instance;
			}
			
			
		//widget settings form	
			public function form($instance) {
				$defaults = array( 'title' => '', 'consumerkey' => '', 'consumersecret' => '', 'accesstoken' => '', 'accesstokensecret' => '', 'cachetime' => '', 'username' => '', 'tweetstoshow' => '' );
				$instance = wp_parse_args( (array) $instance, $defaults );
						
				echo '
				<p><label>Title:</label>
					<input type="text" name="'.$this->get_field_name( 'title' ).'" id="'.$this->get_field_id( 'title' ).'" value="'.esc_attr($instance['title']).'" class="widefat" /></p>
				<p>How to use?: <a href="http://support.mcstudiosmx.com/forums/topic/new-twitter-api/" target="_blank">Tutorial</a></p>	
				<p><label>Consumer Key:</label>
					<input type="text" name="'.$this->get_field_name( 'consumerkey' ).'" id="'.$this->get_field_id( 'consumerkey' ).'" value="'.esc_attr($instance['consumerkey']).'" class="widefat" /></p>
				<p><label>Consumer Secret:</label>
					<input type="text" name="'.$this->get_field_name( 'consumersecret' ).'" id="'.$this->get_field_id( 'consumersecret' ).'" value="'.esc_attr($instance['consumersecret']).'" class="widefat" /></p>					
				<p><label>Access Token:</label>
					<input type="text" name="'.$this->get_field_name( 'accesstoken' ).'" id="'.$this->get_field_id( 'accesstoken' ).'" value="'.esc_attr($instance['accesstoken']).'" class="widefat" /></p>									
				<p><label>Access Token Secret:</label>		
					<input type="text" name="'.$this->get_field_name( 'accesstokensecret' ).'" id="'.$this->get_field_id( 'accesstokensecret' ).'" value="'.esc_attr($instance['accesstokensecret']).'" class="widefat" /></p>														
				<p><label>Cache Tweets in every:</label>
					<input type="text" name="'.$this->get_field_name( 'cachetime' ).'" id="'.$this->get_field_id( 'cachetime' ).'" value="'.esc_attr($instance['cachetime']).'" class="small-text" /> hours</p>																			
				<p><label>Twitter Username:</label>
					<input type="text" name="'.$this->get_field_name( 'username' ).'" id="'.$this->get_field_id( 'username' ).'" value="'.esc_attr($instance['username']).'" class="widefat" /></p>																			
				<p><label>Tweets to display:</label>
					<select type="text" name="'.$this->get_field_name( 'tweetstoshow' ).'" id="'.$this->get_field_id( 'tweetstoshow' ).'">';
					$i = 1;
					for(i; $i <= 10; $i++){
						echo '<option value="'.$i.'"'; if($instance['tweetstoshow'] == $i){ echo ' selected="selected"'; } echo '>'.$i.'</option>';						
					}
					echo '
					</select></p>';		
			}
	}
	
	
// register	widget
	function register_mcstudios_twitter_widget(){
		register_widget('mcstudios_twitter_n1');
	}
	add_action('init', 'register_mcstudios_twitter_widget', 1);
	
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_twitter_n1");'));	











/**
 * MC Studios accordion widget
 *
 * This widget displays a custom menu
 * as an accordion widget, you need to enable
 * the menu item description when
 * creating your custom menu
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */
class mcstudios_accordionWidget extends WP_Widget {
    /** constructor */
    function mcstudios_accordionWidget() {
	
		$name =			'Accordion Widget';
		$desc = 		'MC Studios accordion widget';
		$id_base = 		'mc_accordion_widget';
		$widget_base =  'mc_accordion_widget_item';
		$css_class = 	'';
		$alt_option = 	'widget_mc_accordion_navigation'; 

		$widget_ops = array(
			'classname' => $css_class,
			'description' => __( $desc, 'mclang' ),
		);
		parent::WP_Widget( 'nav_menu', __('Custom Menu', 'mclang'), $widget_ops );

		$this->WP_Widget($id_base, __($name, 'mcaccordion'), $widget_ops);
		$this->alt_option_name = $alt_option;


		$this->defaults = array(
			'title' => '',
			'classMenu' => '',
			'skin' => 'demo.css'
		);
    }
	
	function widget($args, $instance) {
		extract( $args );
		// Get menu
		$widget_options = wp_parse_args( $instance, $this->defaults );
		extract( $widget_options, EXTR_SKIP );
		
		$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );

		if (!$nav_menu)
			return;

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		
		//$classMenu = ($instance['classMenu'] != '') ? $instance['classMenu'] : 'menu'; 
	
		echo $args['before_widget'];
	
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
			
			
			
		$tabid = uniqid('accordion');	
		?>
		
		
		
		<div class="accordion" id="<?php echo $tabid; ?>">
			<?php 
			$menu_name = $nav_menu;
			$menu = wp_get_nav_menu_object($menu_name);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			//print_r($menu_items);
			 ?> 
			 <?php 
			 if(!empty($menu_items)): 
			 	$tcount = 1;
			 	foreach ($menu_items as $tab) { 
			 	$collapsed = '';
			 	if ($tcount == 1) {
			 		$collapsed = 'in';
			 	} 
			 	?>
			 			
			 		<div class="accordion-group">
			 		  <div class="accordion-heading">
			 		    <a class="accordion-toggle" data-toggle="collapse" data-parent="#<?php echo $tabid; ?>" href="#collapse<?php echo $tcount; ?>">
			 		      <span class="tab-icon"></span> <?php echo $tab->post_title; ?>
			 		    </a>
			 		  </div>
			 		  <div id="collapse<?php echo $tcount; ?>" class="accordion-body collapse <?php echo $collapsed; ?>">
			 		    <div class="accordion-inner">
			 		      <?php echo stripslashes($tab->post_content); ?>
			 		    </div>
			 		  </div>
			 		</div>		
			 			
			 					
			 <?php 
			 	$tcount++;
			 	}
			 endif; ?>
		</div>
		
		
		<?php
		
		echo $args['after_widget'];
	}

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		
		return $instance;
	}

    /** @see WP_Widget::form */
    function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		
		$widget_options = wp_parse_args( $instance, $this->defaults );
		extract( $widget_options, EXTR_SKIP );

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			//echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			echo 'There are no menus yet, create a new from Appearance -> Menus';
			return;
		}
		?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mclang') ?></label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"  size="20" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:', 'mclang'); ?></label>
		<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
		</select>
	</p>
	
	
	
	<?php 
	}
	
	
}
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_accordionWidget");'));







/**
 * MC Studios Contact widget
 *
 * This widget displays your contact information
 * in the sidebar as a widget
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */
class mcstudios_contactWidget extends WP_Widget {
    /** constructor */
    function mcstudios_contactWidget() {
        parent::WP_Widget(false, $name = 'Contact Widget');	
    }
    
    

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);

				$address = apply_filters('widget_content', $instance['address']);
				$phone = apply_filters('widget_content', $instance['phone']);
				$email = apply_filters('widget_content', $instance['email']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                        
                        
                        <ul class="contact">
                        	<?php if ($address !== ''): ?>
                        		<li><span class="icon-suitcase"></span><?php echo $address; ?></li>
                        	<?php endif ?>
                        	
                        	<?php if ($phone !== ''): ?>
                        		<li><span class="icon-phone-sign"></span><?php echo $phone; ?></li>
                        	<?php endif ?>
                        	
                        	<?php if ($email !== ''): ?>
								<li><span class="icon-envelope-alt"></span><?php echo $email; ?></li>
                        	<?php endif ?>
                        </ul>	
                        	
						<div class="clear"></div>

              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['address'] = strip_tags($new_instance['address']);
	$instance['phone'] = stripslashes($new_instance['phone']);
	$instance['email'] = stripslashes($new_instance['email']);
	
    return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {				
    
    	if (isset($instance['title'])) {
    		$title = esc_attr($instance['title']);	
    	} else {
    		$title = 'Contact Us';
    	}
    	
    	if (isset($instance['address'])) {
    		$address = esc_attr($instance['address']);	
    	} else {
    		$address = '';
    	}
    	
    	if (isset($instance['phone'])) {
    		$phone = esc_attr($instance['phone']);	
    	} else {
    		$phone = '';
    	}
    	if (isset($instance['email'])) {
    		$email = esc_attr($instance['email']);	
    	} else {
    		$email = '';
    	}		
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

			
			
			
			<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></label></p>
			
			
			<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></label></p>
			
			
			<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
			
		<?php 
    }

} // class 
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_contactWidget");'));










/**
 * MC Studios newsletter widget
 *
 * This widget displays a newsletter form subscribe
 * in the sidebar as a widget
 *  
 * @package MCFramework
 * @todo creates a new widget for the widgets section, based on config files for easier widget creation
 */
class mcstudios_subscribeWidget extends WP_Widget {
    /** constructor */
    function mcstudios_subscribeWidget() {
        parent::WP_Widget(false, $name = 'Subscribe Widget');	
    }
    
    

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);

				$address = apply_filters('widget_content', $instance['address']);
				$phone = apply_filters('widget_content', $instance['phone']);
				$email = apply_filters('widget_content', $instance['email']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title .  $after_title; ?>
                        
                        
                        
                        
                        <div class="widget-subscribe">
                        	<div class="widget-title">
                        		<?php echo $title; ?>
                        	</div><!-- end widget-title -->
                        	
                        	
                        	<div class="widget-body">
                        		<p class="title"><?php echo $address;  ?><p>
                        		
                        		<?php quick_subscribe_form(); ?>
                        	
                        	</div><!-- end widget-body -->
                        </div><!-- end widget-subscribe -->
                        
                        
                        	
                        	
						<div class="clear"></div>

              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['address'] = strip_tags($new_instance['address']);
	$instance['email'] = strip_tags($new_instance['email']);
	
    return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$address = esc_attr($instance['address']);
		$phone = esc_attr($instance['phone']);
		$email = esc_attr($instance['email']);
				
        ?>
            
            
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'mclang'); ?> </label>
            
            <textarea class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>">
            	<?php echo $title; ?>
            </textarea></p>

			
			
			
			<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Input title:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Button Text:', 'mclang'); ?> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
			
		<?php 
    }

} // class 
add_action('widgets_init', create_function('', 'return register_widget("mcstudios_subscribeWidget");'));
?>