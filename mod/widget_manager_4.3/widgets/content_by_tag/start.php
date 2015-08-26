<?php 
/* init file for widget */

function widget_content_by_tag_init(){
	if(elgg_is_active_plugin("blog") || elgg_is_active_plugin("file") || elgg_is_active_plugin("pages")){
		elgg_register_widget_type("content_by_tag", elgg_echo("widgets:content_by_tag:name"), elgg_echo("widgets:content_by_tag:description"), "profile,dashboard,index,groups", true);
	}
	elgg_extend_view("css/elgg", "widgets/content_by_tag/css");
}

//elgg_register_event_handler("widgets_init", "widget_manager", "widget_content_by_tag_init");

$roleArray=array("instructor","learner","developer","trainingmgr");
if(isset($_GET['role'])){
	if(in_array($_GET['role'],$roleArray)){
		$_SESSION['role']=$_GET['role'];
	} else {
		unset($_SESSION['role']);
	}
} else {
	
}

if(isset($_SESSION['role'])){
			switch($_SESSION['role']){
				case "learner":
					elgg_register_event_handler("widgets_init", "widget_manager", "widget_content_by_tag_init");
					break;
				case "instructor":
					elgg_register_event_handler("widgets_init", "widget_manager", "widget_content_by_tag_init");
					break;
				case "developer":
					elgg_register_event_handler("widgets_init", "widget_manager", "widget_content_by_tag_init");
					break;
				case "trainingmgr":
					elgg_register_event_handler("widgets_init","widget_manager","widget_content_by_tag_init");
					break;
				default:
					elgg_unregister_event_handler("widgets_init", "widget_manager", "widget_content_by_tag_init");
					break;
			}			
			$role=$_SESSION['role'];
		}