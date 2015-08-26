<?php


function authenticate($user, $password) {
    // Active Directory server
    $ldap_host = "10.1.35.19"; // 198.164.43.19

    // Active Directory DN
    $ldap_dn = "OU=Users,OU=ONGARDE,DC=ad,DC=ongarde,DC=net";

    // Active Directory user group
    $ldap_user_group = "Regular"; // Regular/AKE

    // Active Directory manager group
    $ldap_manager_group = "Admin";

    // Domain, for purposes of constructing $user
    $ldap_usr_dom = "@ad.ongarde.net";

    // connect to active directory
    $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP host.");

    // verify user and password
    if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
        // valid username
		
		// If the password field was blank, then it didn't validate both
		// If not empty, then both username/password was validated
		if( !empty( $user ) && !empty( $password ) ) {
			return true;
		} else {
			return false;
		}
    } else {
        // invalid name or password
        return false;
    }
}



session_start();
if( authenticate( $_POST['login'], $_POST['password'] ) ) {
	$authenticated = true;
} else {
	$authenticated = false;
}

if( $authenticated ) {
    // Successful login!
	// Site has no bilingual support, so send them both to the same place:
	header('Location: http://198.164.43.11/alsc/gallery/browse.asp');
	//if( $_POST['language'] == "en" ) {
		//header('Location: http://www.cdainno2.com/alsc/cw/start.html');
		//header('Location: http://alsc.zzo.ca/cw/start.html');
	//} else {
		//header('Location: http://alsc.zzo.ca/cw/start.html');
		//header('Location: http://www.cdainno2.com/alsc/cw/start.html');
	//}
} else {
    // Bad username/password
	if( $_POST['language'] == "en" ) {
	    // Send them back to the English login page.
		$_SESSION['message'] = "Loggin failed.";
		header('Location: http://198.164.43.11/alsc/index-login-en.php');
		//header('Location: http://alsc.zzo.ca/index-login-en.html');
		//header('Location: http://www.cdainno2.com/alsc/index-login-en.php');
	} else {
	    // Send them back to the French login page.
		$_SESSION['message'] = "Connexion &eacute;chou&eacutee.";
		header('Location: http://198.164.43.11/alsc/index-login-fr.php');
		//header('Location: http://alsc.zzo.ca/index-login-fr.html');
		//header('Location: http://www.cdainno2.com/alsc/index-login-fr.php');
	}
}


?>