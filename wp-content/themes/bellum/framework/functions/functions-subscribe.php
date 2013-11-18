<?php
function quick_subscribe_register($source){
	global $data;
	
	$email_error = __('invalid Email Address', 'mclang');
	$email_duplicated = __('Duplicated Email Address', 'mclang');
	$email_success = __('Thanks for subscribing. Now add a friend:', 'mclang');
	
	$user_email = apply_filters( 'user_registration_email', $source );
	$user_login = sanitize_user( str_replace('@','', $source) );

	// Check the e-mail address
	if ($user_email == '') {
			if($email_error !== ''){
				$errors = $email_error;
			} else{
				$errors = __('invalid Email Address', 'mclang');
			}
		
		
		
	} elseif ( !is_email( $user_email ) ) {
			if($email_error !== ''){
				$errors = $email_error;
			} else{
				$errors = __('invalid Email Address', 'mclang');
			}
	} elseif ( email_exists( $user_email ) ){
				if($email_duplicated !== ''){
					$errors = $email_duplicated;
				} else{
					$errors = __('This email is already subscribed', 'mclang');
				}
	}
		

	//do_action('register_post');

   if(isset($errors)){
      $errors = apply_filters( 'registration_errors', $errors );
      $message = $errors;
   }

	if ( empty( $errors ) ) {
		$user_pass = substr( md5( uniqid( microtime() ) ), 0, 7);

		$user_id = wp_create_user( $user_login, $user_pass, $user_email );
		
		$user = new WP_User($user_id);
		$user->set_role('subscriber');
		
		
		if($email_success !== ''){
			$message = $email_success;
		} else{
			$message = __('Thanks for subscribing. Now add a friend:', 'mclang');
		}
		
		
		
		
		if ( !$user_id )
			$errors['registerfail'] = sprintf(__('Error, please try again'));
		
	}
	return $message;
}

//this function handles the ajax request
function handle_qs_ajax_request(){
   $userEmail = $_REQUEST['userEmail'];
   $source = $_REQUEST['source'];
   $containerDiv = $_REQUEST['containerDiv'];

   $message = quick_subscribe_register($userEmail);
   $output = quick_subscribe_get_form($message, $source, $containerDiv, $userEmail);
   echo $output;
   die();
}



function quick_subscribe_get_form($message, $source, $containerDiv, $userEmail = ''){
	
	
	$caixa = 'Email...'; 
   //if the implementation is in a widget, get widget-specific options
   if(strpos($source, 'widget')){
      $op_button = get_option("quicksubscribe_widget_button"); 
      $op_hide = get_option("quicksubscribe_widget_button_hide");
      $op_label = get_option("quicksubscribe_widget_button_label");
      $input_prefix = 'widget';
   }
   //otherwise, get general options
   else{
      $op_button = 'true';
      $op_hide = '';
      $op_label = 'subscribe';
      $input_prefix = 'tt';
   }
   //initialize output
   $output = '';
   

	$output .= "<form name='".$input_prefix."_quick_subscribe_form' id='".$input_prefix."_quick_subscribe_form'>";
	$output .= "<input type='text' name='". $source ."' value='' id='". $source ."' ";
   	$output .= ">";
	$output .= "<button type='button' id='".$input_prefix."_qsSubmit' class='".$input_prefix."_qsSubmit add submitemail nbtn black' onClick='submitQuickSubscribe(\"$source\", \"$containerDiv\");'><span>".__('Subscribe', 'mclang')."</span></button>";
	$output .= "</form>";
	//add message
	if($message){
		 $output .= '<div class="clear"></div>';
	   $output .= "<p class='subscribe-message'>". $message ."</p><div id='".$input_prefix."_quick_subscribe_messages'></div>";
	}
	return $output;
}


function quick_subscribe_form(){
	
  echo '<div style="display:inline" id="qsInlineContainer" class="qsInlineContainer">';
	echo quick_subscribe_get_form(0, "QS_user_email_theme", 'qsInlineContainer');
	echo '</div>';
}


function ajax_method_call() {
  wp_enqueue_script( 'my-ajax-request', get_stylesheet_directory_uri() . '/js/subscribe.js');
  wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_ajax_nopriv_quicksubscribe_submit', 'handle_qs_ajax_request');
add_action('wp_ajax_quicksubscribe_submit', 'handle_qs_ajax_request');

add_action('init', 'ajax_method_call');
?>