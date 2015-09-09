<?php
$language = array(
	'activate:heading' => 'Activate your account',
	'activate:subHeading' => 'Please enter the @forces.gc.ca email associated with your Learning Portal account. You will receive an email with a reactivation link.',
	'activate:email' => 'Forces Email:',

	'email:activate:body' => "Good Day %s,

Please activate your account by clicking on the link below:

%s

If you cannot click on the link, copy and paste it into your browser manually.

%s
%s",
	'email:activate:sent' => 'The activation email has been sent to the address specified',
	'email:activate:error' => 'There was an error sending your activation email',
	'email:activate:userNotFound' => 'The email provided is not registered in the system',
	'email:activate:userActivated' => 'This user is already active',
	'email:activate:invalidEmail' => 'The email provided does not correlate with the user account',
	
	'activate:success' => 'Account has been activated',
	'activate:error' => 'Unable to activate account',


);

add_translation("en", $language);