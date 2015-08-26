<?php
	//get the form inputs
	$name = get_input("name");
	$email = get_input("email1");
	$email2 = get_input("email2");
	$password = get_input("password1");
	$password_verif = get_input("password_verif");

	$errors;

	if(empty($email) || empty($password)){
		register_error("Please provide an email and password");
	}

	else if($email != $email2){
		register_error("Emails do no match");
		$errors = true;
		forward(REFERER);
	}
	else if($password != $password_verif){
		register_error("Passwords do not match");
		$errors = true;
		forward(REFERER);
	}

	else if(!$errors){
		//get first name and last name
		$indexDelim = strpos($name, " ");
		$fname = substr($name,0,$indexDelim);
		$lname = substr($name, $indexDelim+1);
	
		//create username
		$username = strtolower($lname .".". substr($fname,0,2));
		system_message($username);

	}




	//email submission to ADL inbox
	/*
	$subject = 'Learning Portal Account Request';
	$message = 'An account for the Learning Portal has been requested for the following user:';
	$message .= "\r\nName: " . $name . "\r\nForces Email: " . $email1;
	if(!empty($email2)){
		$message .= "\r\nSecondary Email: " . $email2;
	}
	$headers = "From: alex@mcfarlanecreative.com" . "\r\n" .
		"Reply-To: alex@mcfarlanecreative.com" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();
	
	if(@mail($email1, $subject, $message, $headers)){
		system_message("Request has been sent.");
		forward(REFERER);
	}
	else{
		register_error("There has been a problem processing your request.");
		forward(REFERER);
	}
	*/
?>