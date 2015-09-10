<?php 

/* ***********************************************************************
 * Custom Notification Plugin
 *
 * Extend system notification javascript in js/lib/elgglib.js
 *
 * ***********************************************************************/

// get plugin settings
$delay_time = elgg_get_plugin_setting('delay_time',  'custom_notification');
$delay_opacity = elgg_get_plugin_setting('delay_opacity',  'custom_notification');

// convert to miliseconds 
$delay_time = $delay_time*1000;
?>
   
elgg.provide('elgg.custom_notification');

elgg.custom_notification.init = function() {
	$('.elgg-system-messages li').stop(true).animate({opacity: 0.9}, 4000);
	$('.elgg-system-messages li.elgg-state-success').fadeOut('slow');

	$('.elgg-system-messages li').click(function(){
		$(this).stop().fadeOut('slow');
	});
}
elgg.register_hook_handler('init', 'system', elgg.custom_notification.init);