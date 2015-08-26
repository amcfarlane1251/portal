<?php

/* ***********************************************************************
 * Custom Notification Plugin
 *
 * ***********************************************************************/

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\custom_notification_init', 1001);
//elgg_register_event_handler('all', 'object', __NAMESPACE__ . '\\custom_notification_init', 999);
elgg_register_event_handler('create', 'object', __NAMESPACE__ . '\\custom_notification_init', 1001);
elgg_register_event_handler('delete', 'object', __NAMESPACE__ . '\\custom_notification_init', 1001);
elgg_register_event_handler('update', 'object', __NAMESPACE__ . '\\custom_notification_init', 1001);
//elgg_register_event_handler('all', 'group', __NAMESPACE__ . '\\custom_notification_init', 999);


function custom_notification_init($event, $type, $object) {

	/*Extend the CSS and JS only For Group Notification(Those views get cached. You cannot extend cached views with conditional statements.)
	eg. if(!empty($object) && elgg_instanceof($object, "object", "file")) { }*/

		// Extend system message CSS with our own styles
		elgg_extend_view('css/elgg', 'custom_notification/css');

		// Extend system message javascript with our own scripts
		elgg_extend_view('js/elgg', 'custom_notification/js');

}

