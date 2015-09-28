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

	'changeEmail:heading' => 'Update Your Email',
	'changeEmail:subHeading' => 'Please enter your <strong>@forces.gc.ca</strong> email to continue',
	'changeEmail:success' => 'You have successfully updated your email',
	'changeEmail:error' => 'Unable to update email for the account',
	'changeEmail:error:exists' => 'Email is already in use by another account',
	'changeEmail:error:domain' => 'Please enter your @forces.gc.ca email',

	'resetPassword:heading' => 'Reset Password',
	'resetPassword:subHeading' => 'Please enter your new password below',
	'resetPassword:submit' => 'Reset Password',
	'resetPassword:hint' => 'Enter the same password as above',
	'resetPassword:error:passwordMismatch' => 'Both passwords must match',
	'resetPassword:error:requirements' => 'Your password does not meet the requirements',
	'resetPassword:error:general' => 'Unable to update your password',
	'resetPassword:success' => 'Your password has been updated. Please login with your new password.',

	'usermgmt:update' => 'Update'

);

add_translation("en", $language);