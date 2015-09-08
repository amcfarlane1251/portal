<?php
/**
 * Send verification email to user
 *
*/
$guids = get_input('user_guids');
//$guid = $guid[0];
//get the unvalidated user
access_show_hidden_entities(TRUE);
foreach($guids as $guid){

	$user = get_entity($guid);
	if($user){
		$code = uservalidationbyadmin_generate_code($user->guid, $user->email);
		
		$validate = elgg_view('output/confirmlink', array(
			'confirm' => elgg_echo('uservalidationbyadmin:confirm_validate_user', array($user->username)),
			'href' => "uservalidationbyadmin/validate?user_guids[]=$user->guid&code=$code",
			'text' => elgg_echo('uservalidationbyadmin:admin:validate')
		));

		$validateLink = array_pop(explode('href=', $validate));
		$index = (strpos($validateLink, 'rel=') - 3);
		$validateLink = substr($validateLink, 1, $index);

		//build validation email
		$subject = "Validate your Learning Portal account";
		$body = "You are one step closer to accessing the learning portal. Validate your account by clicking the link below. \r\n";
		$body .= $validateLink;

		$options = array(
			"to" => $to,
			"subject" => $subject,
			"html_message" => $body,
			"plaintext_message" => $body
		);

		if(elgg_send_email('no-reply@lp-pa.forces.gc.ca', $user->email, $subject, $body)){
			system_message('Validation email sent');
		}
		else{
			register_error('Could not send validation email');
		}
	}
}