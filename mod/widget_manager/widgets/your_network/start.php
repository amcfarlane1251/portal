<?php

function widget_your_network_init(){
	elgg_register_widget_type("your_network", elgg_echo("Network"), elgg_echo("your_network"), "index");	
}

elgg_register_event_handler("widgets_init", "widget_manager", "widget_your_network_init");