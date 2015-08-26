<?php
	elgg_register_action("sign_up/submit", elgg_get_plugins_path() . "sign_up/actions/sign_up/emailSubmit.php", 'public');

	elgg_register_page_handler("sign_up", "sign_up_page_handler");

	function sign_up_page_handler($segments){
		if($segments[0] == 'signup'){
			include elgg_get_plugins_path() . 'sign_up/pages/sign_up/signup.php';
			return true;
		}

		return false;
	}
?>