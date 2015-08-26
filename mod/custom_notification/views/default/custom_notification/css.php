<?php

/* ***********************************************************************
 * Custom Notification Plugin
 *
 * Extend system notification CSS in mod/wettoolkit/css/styles.scss
 *
 * ***********************************************************************/


// get plugin settings
$success_background = elgg_get_plugin_setting('success_background',  'custom_notification');
$error_background = elgg_get_plugin_setting('error_background',  'custom_notification');
$notice_background = elgg_get_plugin_setting('notice_background',  'custom_notification');
$success_text = elgg_get_plugin_setting('success_text',  'custom_notification');
$error_text = elgg_get_plugin_setting('error_text',  'custom_notification');
$notice_text = elgg_get_plugin_setting('notice_text',  'custom_notification');
$delay_opacity = elgg_get_plugin_setting('delay_opacity',  'custom_notification');

?>

/*******************************
	Custom Notification
********************************/
#wb-main-in ul.elgg-system-messages {
	display: block;
	margin: 0 auto;
	position: fixed;
	text-align: center;
	left: 0;
	right: 0;
}
#wb-main-in li.elgg-message {
	font-weight: bold;
	display: block;
	padding: 9px;
	cursor: pointer;
	opacity: <? echo $delay_opacity; ?>;
	
	-webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
	-moz-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	position: relative;
	margin: 10px auto;
	top: 80px;
	width: 70%;
	border-radius: 8px;
	
	text-align:center;
	z-index: 2000;
	font-size: 16px;
}
#wb-main-in .elgg-state-success {
	color: <? echo $success_text; ?>;
	background-color: <? echo $success_background; ?>;
}
#wb-main-in .elgg-state-error {
	color: <? echo $error_text; ?>;
	background-color: <? echo $error_background; ?>;
}
#wb-main-in .elgg-state-notice {
	color: <? echo $notice_text; ?>;
	background-color: <? echo $notice_background; ?>;
}
