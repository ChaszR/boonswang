<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'mclang'));
	if ( post_password_required() ) { ?>
	<div class="line dotted"></div>
	<section id="comments">
		<div class="notice">
			<p class="bottom"><?php _e('This post is password protected. Enter the password to view comments.', 'mclang'); ?></p>
		</div>
	</section>
	<?php
		return;
	}
	global $data;
?>
<?php // You can start editing here. ?>
<?php if ( have_comments() ) : ?>
	
	<div class="clear"></div>
	
	<section id="comments">
			<div id="comments-bubble"><span></span></div>

				<h2 class="comments-header">
					<?php comments_number(__('No Comments', 'mclang'), __('One Comment', 'mclang'), '%  '.__('comments', 'mclang').'' );?>
				</h2>
				<a class="add" href="#respond"><span><?php _e('Add Comment.', 'mclang'); ?></span></a>
				
				<div class="line"></div>
				
				
				<ol class="commentlist">
					<?php wp_list_comments( 'avatar_size=62&callback=custom_comment&type=comment&max_depth=4' ); ?>
				</ol>
	</section>
	
	

	<?php custom_trackbacks_pingbacks(); ?>
		
		
		
		
	
	
	<div id="comments-pagination" class="pull-right">
		 <?php paginate_comments_links(); ?> 
	</div>
	
	
	
<?php else : // this is displayed if there are no comments so far ?>
	
	
	
	<?php if(comments_open()){ //If there re no comments?>
			
			<section id="comments">
				<div id="comments-bubble"><span></span></div>
				<h2 class="comments-header"><?php _e('There are no comments yet.', 'mclang'); ?></h2>
				<a class="add" href="#respond"><span><?php _e('Add Comment.', 'mclang'); ?></span></a>
				<div class="line"></div>
			</section>
	<?php } else{ //if comments are closed ?>
			<div class="line dotted"></div>
			<section id="comments">
				<div id="comments-bubble"><span></span></div>
				<h2 class="comments-header"><?php _e('Comments are closed.', 'mclang'); ?></h2>
				<div class="line"></div>
			</section>
	<?php }?>
<?php endif; ?>




<?php if ( comments_open() ) : ?>
	
	
	<?php if (!have_comments()): ?>
		<div class="line"></div>	
	<?php endif ?>

<div class="line"></div>
<section id="respond">
<div id="comments-add-bubble"><span></span></div>
	<?php
	
	//More information about comment_form http://ottopress.com/2010/wordpress-3-0-theme-tip-the-comment-form/
	
	if(isset($data['comments_button_color'])){
		$submit_id = $data['comments_button_color'];
	} else{
		$submit_id = 'orange';
	}
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	
	$fields =  array(
	'author' => '<p class="comment-form-author">
	            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Name*', 'mclang' ) . '"/>
	            </p>',
	'email'  => '<p class="comment-form-email">
				<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email* ', 'mclang' ) . '"/>
				</p>',
	'url'    => '<p class="comment-form-url"><label for="url">
				<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Website', 'mclang' ) . '"/>
				</p>',
);

	

	
	$defaults = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be logged in to post a comment.', 'mclang' )) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'You are currentlty logged in.', 'mclang' )) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'mclang' ). '</p>',
	'comment_notes_after'  => '',
	'comment_field' => '<p class="comment-form-comment"><textarea style="overflow-y: hidden;" id="comment" placeholder="'. __( 'Comment.', 'mclang' ). '" name="comment" aria-required="true"></textarea></p>',
	'id_form'              => 'commentform',
	'id_submit'            => $submit_id,
	'title_reply'          => '<h2>'.__( 'Leave a Comment', 'mclang' ).'</h2>',
	'title_reply_to'       => __( 'Leave a Reply', 'mclang' ),
	'cancel_reply_link'    => __( 'Cancel reply', 'mclang' ),
	'label_submit'         => __( 'Post Comment', 'mclang' ),
	);
	
	 comment_form($defaults); ?>
</section>
<?php endif; // if you delete this the sky will fall on your head ?>