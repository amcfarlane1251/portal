<?phpfunction widget_featured_groups_init(){	elgg_extend_view("css/elgg", "widgets/featured_groups/css");	elgg_register_widget_type("featured_groups", elgg_echo("Featured Groups"), elgg_echo("Featured Groups"), "groups,index,dashboard,profile", true);}elgg_register_event_handler("widgets_init", "widget_manager", "widget_featured_groups_init");

