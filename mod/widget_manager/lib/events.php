<?php

	/*
	 * Sets the widget manager tool option. This is needed because in some situation the tooloption is not available.
	 */
	function widget_manager_create_group_event_handler($event, $object_type, $object) {
		if($object instanceof ElggGroup){
			if(elgg_get_plugin_setting("group_option_default_enabled", "widget_manager") == "yes"){
				$object->widget_manager_enable = "yes";
			}
		}
	}
	
	function widget_manager_update_widget($event, $object_type, $object) {
		if(($object instanceof ElggWidget) && in_array($event, array("create", "update", "delete"))){
			if(stristr($_SERVER["HTTP_REFERER"], "/admin/appearance/default_widgets")){
				// on create set a parent guid
				if($event == "create"){
					$object->fixed_parent_guid = $object->guid;
				}
				
				// update time stamp
				$context = $object->context;
				if(empty($context)){
					// only situation is on create probably, as context is metadata and saved after creation of the object, this is the fallback
					$context = get_input("context", false);
				}
				
				if($context){
					elgg_set_plugin_setting($context . "_fixed_ts", time(), "widget_manager");
				}
			}
		}
	}
	
	/**
	 * Adds a relation between a widget and a multidashboard object
	 * 
	 * @param unknown_type $event
	 * @param unknown_type $type
	 * @param unknown_type $object
	 */
	function widget_manager_create_object_handler($event, $type, $object){
		
		if(elgg_instanceof($object, "object", "widget", "ElggWidget")){
			if($dashboard_guid = get_input("multi_dashboard_guid")){
				if(($dashboard = get_entity($dashboard_guid)) && elgg_instanceof($dashboard, "object", MultiDashboard::SUBTYPE, "MultiDashboard")){
					add_entity_relationship($object->getGUID(), MultiDashboard::WIDGET_RELATIONSHIP, $dashboard->getGUID());
				}
			}
		}
	}

	function get_create_forms($page){
		$parent_guid = 0;

		switch($page[0]){
			case "blog":
				echo "<h2>Add a Blog</h2>";
				elgg_load_library('elgg:blog');
				$body_vars = blog_prepare_form_vars();
				echo elgg_view_form('blog/save', array(), array_merge($body_vars, $vars));
				exit;
			case "event":
				echo "<h2>Add an Event</h2>";
				elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
				echo elgg_view("event_manager/forms/event/edit");
				exit;
			case "group":
				echo "<h2>".elgg_echo('groups:add')."</h2>";
				elgg_load_library('elgg:groups');
				elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
				elgg_push_breadcrumb($title);
				if (elgg_get_plugin_setting('limited_groups', 'groups') != 'yes' || elgg_is_admin_logged_in()) {
					$content = elgg_view('groups/edit');
				} 
				else {
					$content = elgg_echo('groups:cantcreate');
				}
				echo $content;
				exit;
			case "project":
				echo "<h2>".elgg_echo('projects:add')."</h2>";
				$vars = projects_prepare_form_vars(null, $parent_guid); 
				$content = elgg_view_form('projects/edit', array('enctype' => 'multipart/form-data'), $vars);
				echo $content;
				exit;
			case "page":
				elgg_load_library('elgg:pages');
				echo "<h2>".elgg_echo('pages:add')."</h2>";
				$vars = pages_prepare_form_vars(null, $parent_guid);
				$content = elgg_view_form('pages/edit', array(), $vars);
				echo $content;
				exit;
			case "answer":
				echo "<h2>".elgg_echo('answers:add')."</h2>";
				elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
				echo elgg_view("answers/forms/question", array('container_guid' => elgg_get_page_owner_guid()));
				exit;
			case "task":
				elgg_load_library('elgg:tasks');
				echo "<h2>".elgg_echo('tasks:add')."</h2>";
				$vars = tasks_prepare_form_vars(null, $parent_guid); 
				$content = elgg_view_form('tasks/edit', array(), $vars);
				echo $content;
				exit;
		}
	}

	function get_share_forms($page){

		$parent_guid = 0;

		switch($page[0]){
			case "status":
				echo "<h2>Start a Discussion</h2>";
				$content = elgg_view_form('thewire/add', array('name' => 'elgg-wire'));
				echo $content;
				exit;
			case "bookmark":
				echo "<h2>".elgg_echo('widget_manager:widgets:getting_started:submitabookmark')."</h2>";
				elgg_load_library('elgg:bookmarks');
				echo elgg_view_form('bookmarks/save', array(), $vars);
				exit;
			case "file":
				echo "<h2>".elgg_echo('file:add')."</h2>";
				elgg_load_library('elgg:file');
				$form_vars = array('enctype' => 'multipart/form-data');
				$body_vars = file_prepare_form_vars();
				$content = elgg_view_form('file/upload', $form_vars, $body_vars);
				echo $content;
				exit;
			case "video":
				echo "<h2>".elgg_echo('videos:add')."</h2>";
				elgg_load_library('elgg:videos');
				$vars = videos_prepare_form_vars();
				$content = elgg_view_form('videos/save', $form_vars, $vars);
				echo $content;
				exit;
		}
	}

	function get_answers_form(){

	}
