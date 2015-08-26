<?php
/*
 * Custom Notification Languages
 */

$english = array(
	// titles
	'custom_notification:delaytime' => 'System notification display time [seconds, default 6].',
	'custom_notification:delayopacity' => 'Opacity [number, 0 to 1, default 0.9].',
	'custom_notification:success_background' => 'Color of success notification background [hex, default #E6EFC2].',
	'custom_notification:error_background' => 'Color of error notification background [hex, default #FBE3E4].',
	'custom_notification:notice_background' => 'Color of notice notification background [hex, default #BDE5F8].',
	'custom_notification:success_text' => 'Color of success notification text [hex, default #264409].',
	'custom_notification:error_text' => 'Color of error notification text [hex, default #8A1F11].',
	'custom_notification:notice_text' => 'Color of notice notification text [hex, default #000000].',
	'custom_notification:general_title' => 'General Notification Settings',
	'custom_notification:success_title' => 'Success Notification Settings',
	'custom_notification:error_title' => 'Error Notification Settings',
	'custom_notification:notice_title' => 'Notice Notification Settings',
);

add_translation("en", $english);
