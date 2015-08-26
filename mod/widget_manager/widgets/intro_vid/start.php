<?php
	function widget_intro_vid_init()	{
	
	elgg_extend_view("css/elgg", "widgets/intro_vid/css");
	elgg_register_widget_type("intro_vid", elgg_echo("Intoduction Vids"), elgg_echo("Introduction Vids"), "groups,index,dashboard,profile", true);

	}	
	
	elgg_register_event_handler("widgets_init", "widget_manager", "widget_intro_vid_init");
