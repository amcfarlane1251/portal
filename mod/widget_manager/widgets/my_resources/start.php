<?php

function widget_my_resources_init(){
	elgg_register_widget_type("my_resources", elgg_echo("My Resources"), elgg_echo("my_resources"), "index");	
}

elgg_register_event_handler("widgets_init", "widget_manager", "widget_my_resources_init");