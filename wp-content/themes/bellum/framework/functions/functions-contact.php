<?php
function isEmail( $email ) { // Email address verification, do not edit.
	return preg_match( "/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email );

}

function mcstudios_contact_form() {
	
	global $data;
	
	//Get the email address
	if(!empty($data["contact_layout"])){
		$layout = $data["contact_layout"];	
		foreach ($layout as $block) {
			$type = $block['title'];
			$option = $block['block_options'];
			
			if ($type == 'Submit') {
				$address = $option['send_emails_to'];
			}
		}
	}		
	
		
		
		
	// END OF Simple Configuration Options
	
	///////////////////////////////////////////////////////////////////////////
	
	
	
	///////////////////////////////////////////////////////////////////////////
	//
	// Do not edit the following lines
	//
	///////////////////////////////////////////////////////////////////////////
	
	$postValues = array();
	foreach ( $_POST as $name => $value ) {
		$postValues[$name] = trim( $value );
	}
	extract( $postValues );
	$error = '';
	
	
	///////////////////////////////////////////////////////////////////////////
	//
	// Begin verification process
	//
	// You may add or edit lines in here.
	//
	// To make a field not required, simply delete the entire if statement for that field.
	//
	///////////////////////////////////////////////////////////////////////////
	
	
	//Validate the fields
	if(!empty($data["contact_layout"])){
		$layout = $data["contact_layout"];	
				
		foreach ($layout as $block) {
				
			$order = $block['order'];
			$type = $block['title'];
								
			$option = $block['block_options'];
			$title = $option['title'];
					
			if (!empty($option['required'])) {
				$required = $option['required'];	
			} else {
				$required = '';
			}
			
			if (!empty($option['options'])) {
				$input_options = $option['options'];	
			} else {
				$input_options = '';
			}		
					
					
			$small = display($title);
								
			
			if(!empty($type)): //Only run if the type is defined
				
				if($type !== 'Submit'):
					
				$input_value = $_POST[$small];
				
				
				if($required == 'required'){
					if($input_value == '') {
						$error .= '<li>'.$title.' '.__('is required.', 'mclang').'</li>';
					}
				} elseif($required == 'email') {
					$email = $_POST[$small];
					if($email == '') {
						$error .= '<li>'.$title.'  '.__('is required.', 'mclang').'</li>';
					} elseif( !isEmail($email) ) {
						$error .= '<li>'.__('You have entered an invalid e-mail address.', 'mclang').'</li>';
					}
					
				} elseif ($required == 'phone') {
					$phone = $_POST[$small];
					if($required == 'yes'){
						if($phone == '') {
							$error .= '<li>'.$title.'  '.__('is required.', 'mclang').'</li>';
						} elseif(!is_numeric($phone)) {
							$error .= '<li>'.__('The phone number can only contain digits.', 'mclang').'</li>';
						}
					}
				} elseif($required == 'yes'){
					if($input_value == '') {
						$error .= '<li>'.$title.' '.__('is required.', 'mclang').'</li>';
					}
				} else {
					//do nothing
				}	
				
				endif;
			endif;	
		}
	}
		
		
		
	
	////////////////////////
	
	if ( !empty($error) ) {
		echo '<div class="error_message">Attention! Please correct the errors below and try again.';
		echo '<ul class="error_messages">' . $error . '</ul>';
		echo '</div>';
	
		// Important to have return false in here.
		return false;
	
	}
	
	
	
	// Advanced Configuration Option.
	// i.e. The standard subject will appear as, "You've been contacted by John Doe."
	
	$e_subject = __('You have a new email from your site', 'mclang');
	
	// Advanced Configuration Option.
	// You can change this if you feel that you need to.
	// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.
	

	
	$msg  = __('You have a new email from your website', 'mclang') . PHP_EOL . PHP_EOL;
	
	if(!empty($data["contact_layout"])){
		$layout = $data["contact_layout"];	
				
		foreach ($layout as $block) {
			$order = $block['order'];
			$type = $block['title'];
			$option = $block['block_options'];
			$title = $option['title'];
			if (!empty($option['required'])) {
				$required = $option['required'];	
			} else {
				$required = '';
			}
			if (!empty($option['options'])) {
				$input_options = $option['options'];	
			} else {
				$input_options = '';
			}				
			$small = display($title);
								
			if(!empty($type)): //Only run if the type is defined
				$input_value = $_POST[$small];
				if(is_array($input_value)){
					
					$arrayValues = implode(',', array_map('mysql_real_escape_string', $input_value));
					$msg .= ''.$title.': ' .$arrayValues. PHP_EOL . PHP_EOL;
					$msg .= "-------------------------------------------------------------------------------------------" . PHP_EOL;
				} else{
					$msg .= ''.$title.': ' .$input_value. PHP_EOL . PHP_EOL;
					$msg .= "-------------------------------------------------------------------------------------------" . PHP_EOL;
				}
					
			endif;		
		}
	}
	
	

	
	$msg = wordwrap( $msg, 70 );
	
	$headers  = "From: $email" . PHP_EOL;
	$headers .= "Reply-To: $email" . PHP_EOL;
	$headers .= "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
	$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
	
	if ( wp_mail( $address, $e_subject, $msg, $headers ) ) {
		echo "<fieldset>";
		echo "<div id='success_page'>";
		echo "<h1>".__('Email Sent Successfully.', 'mclang')."</h1>";
		echo "<p>".__('Thank you', 'mclang')." <strong>$name</strong>, ".__('your message has been submitted to us.', 'mclang')."</p>";
		echo "</div>";
		echo "</fieldset>";
	
		// Important to have return false in here.
		return false;
	} else {
		echo "<fieldset>";
		echo "<div id='success_page'>";
		echo "<h1>".__('Error.', 'mclang')."</h1>";
		echo "<p>".__('We are sorry', 'mclang')." <strong>$name</strong>, ".__('there was a problem sending your email, please try again.', 'mclang')."</p>";
		echo "</div>";
		echo "</fieldset>";
		
		// Important to have return false in here.
		return false;
	}
	
	
	
	/*if ( mail( $address, $e_subject, $msg, $headers ) ) {
		echo "<fieldset>";
		echo "<div id='success_page'>";
		echo "<h1>".__('Email Sent Successfully.', 'mclang')."</h1>";
		echo "<p>".__('Thank you', 'mclang')." <strong>$name</strong>, ".__('your message has been submitted to us.', 'mclang')."</p>";
		echo "</div>";
		echo "</fieldset>";
	
		// Important to have return false in here.
		return false;
	}*/
	
	
	///////////////////////////////////////////////////////////////////////////
	//
	// Do not edit below this line
	//
	///////////////////////////////////////////////////////////////////////////
	echo 'ERROR! Please confirm PHP mail() is enabled.';
	return false;
	
}
add_action('wp_ajax_nopriv_mcstudioscontact_form', 'mcstudios_contact_form');
add_action('wp_ajax_mcstudioscontact_form', 'mcstudios_contact_form');
?>