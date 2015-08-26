<?php 
/* html text widget */

function widget_ongarde_support_init(){
	elgg_register_widget_type("support", elgg_echo("Support"), elgg_echo("Display Support"), "profile,dashboard,index,groups", true);
	elgg_extend_view("css/elgg", "widgets/support/css");

}

elgg_register_event_handler("widgets_init", "widget_manager", "widget_ongarde_support_init");
