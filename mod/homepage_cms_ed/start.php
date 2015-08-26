<?php
/*
	changes to default plugin are as follows
		> New Register plugin page handler
		> Registered new menu item to navigate to new homepage_cms index page
*/


// set up our plugin
function homepage_cms_init() {
	
	/*********NOTE*********/
	//THIS PLUGIN ISN'T ORIGINAL homepage_cms, HAS BEEN EDITED TO SUPPORT 
	//MULTIPLE PAGES (Under development)
	
	// shared css that's safe to cache
	elgg_extend_view('css/elgg', 'homepage_cms/css');
	
	//view handler default by original homepage_cms
	elgg_register_plugin_hook_handler('view','page/layouts/one_column', 'homepage_cms_view_hook');
	
	//custom action handler
	elgg_register_plugin_hook_handler('action','load','homepaage_cms_action_hook');

	
	
		//register plugin page handler
		elgg_register_page_handler('homepage_cms','homepage_cms_page_handler');
		
		//register menu item for testing purposes
		//$item = new ElggMenuItem('homepage_cms','HPC', 'homepage_cms/all');
		//elgg_register_menu_item('site', $item);
		
		if(elgg_get_context()=="homepage_cms"){//check plugin without this condition
			elgg_extend_view('page/elements/head', 'homepage_cms/css_col_width');
		}
	
	
	
  // context not set yet, use url to see if we're on the front page
  //default condition: current_page_url()== elgg_get_site_url()
	
	//$cur_url = current_page_url();
	//system_message($cur_url);
  /*if(($cur_url==elgg_get_site_url())||elgg_get_context()=='homepage_cms'){
    
    // serve some non-cached css
    elgg_extend_view('page/elements/head', 'homepage_cms/css_col_width', 1000);
    
    //$footer_override = elgg_get_plugin_setting('footer_override', 'homepage_cms');
    
    elgg_register_plugin_hook_handler('view', 'page/layouts/one_column', 'homepage_cms_view_hook');
    
    if ($footer_override == 'yes') {
      elgg_register_plugin_hook_handler('view', 'page/elements/footer', 'homepage_cms_view_hook');
    }
  }*/
}

function homepage_cms_page_handler($page){
	
	if(!isset($page[0])){$page[0]='all';}
	
	$page_type = $page[0];
	$base_plugin_pages = elgg_get_plugins_path() . 'homepage_cms_ed/pages/homepage_cms';
	
	
	$hpc_params = array(
		"type"=>"object",
		"subtype"=>"hpcroles"
	);
	$allRoles = elgg_get_entities($hpc_params);
	
	if(!$allRoles){//default condition (!$allRoles)
		trigger_plugin_hook('action','load','homepaage_cms_action_hook',array("hpc_role_check"=>true));
	}
	else{
	
		//system_message('Total: '.count($allRoles));
		//var_dump($allRoles);
		
		//system_message((string)$allRoles[0]->guid);
		
		/*foreach($allRoles as $role){
			//var_dump($role);
			//system_message((string)$role->guid);
		}*/
	}
	
	switch($page_type){
	
		case 'all':
			include "$base_plugin_pages/index.php";
			break;
	}
	return true;
}//END OF homepage_cms_page_handler


function homepaage_cms_action_hook($hook, $type, $returnvalue, $params){
	
	$hpc_params = array(
		"type"=>"object",
		"subtype"=>"hpcroles"
	);
	$allRoles = elgg_get_entities($hpc_params);
	if(($params["hpc_role_check"]==true)){
		
		if(!$allRoles){
			$hpcRoleTitles = array(
				"all"=>array(
					"title"=>"all",
					"subtype"=>$hpc_params["subtype"],
					"desc"=>"Basic home page cms role to refer page this[all]",
				),
				"learner"=>array(
					"title"=>"learner",
					"subtype"=>$hpc_params["subtype"],
					"desc"=>"Basic home page cms role to refer page this[learner]",
				),
				"instructor"=>array(
					"title"=>"instructor",
					"subtype"=>$hpc_params["subtype"],
					"desc"=>"Basic home page cms role to refer page this[instructor]",
				),
				"developer"=>array(
					"title"=>"learner",
					"subtype"=>$hpc_params["subtype"],
					"desc"=>"Basic home page cms role to refer page this[developer]",
				)
			);
			foreach($hpcRoleTitles as $roleTitle){
				$tmpHpcRole = new ElggObject();
				$tmpHpcRole->title = $roleTitle["title"];
				$tmpHpcRole->subtype = $roleTitle["subtype"];
				$tmpHpcRole->description = $roleTitle["desc"];
				$tmpHpcRole->pagecontent = '';
				$allRoles[$roleTitle] = $tmpHpcRole->save();
			}
			
			//system_message('Created roles: '.count($allRoles));
		}else{
		
			//please uncomment out the following foreach loop to delete all the roles with subtype "hpcroles" in elgg database
			foreach($allRoles as $role){
				$role->delete();
				//system_message((string)$role->guid);
			}
			system_message('Available roles: '.count($allRoles));	
		}
	}
}//END OF homepage_cms_action_hook


function homepage_cms_view_hook($hook, $type, $returnvalue, $params){
  
  if ($type == 'page/layouts/one_column'){
	
	//update content of page in database here
	//var_dump($returnvalue);
    return '<div id="homepage-cms">' . $returnvalue. "</div>";
	
  }
  
  if(elgg_is_admin_logged_in()){
	var_dump($returnvalue);
  }
	$tmpGuid = elgg_get_page_owner_guid();
	$tmpEntit = get_entity($tmpGuid);
	$tmpEntit->pagecontent = $returnvalue;
	$tmpEntit->save();
  
  /*if ($type == 'page/elements/footer') {
    return elgg_get_plugin_setting('footer_content', 'homepage_cms');
  }*/

  return $returnvalue;
}

elgg_register_event_handler('init', 'system', 'homepage_cms_init');
