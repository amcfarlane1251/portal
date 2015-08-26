<?php
/**
 * Submit a survey
 *
*/

$form_vars = elgg_get_config('surveys');

$input = array();
$hear = array();
$reason = array();
$final8 = array();
foreach($form_vars as $name => $type){
	
	if($name == 'hear[]'){
		if($_POST['hear']){
			foreach($_POST['hear'] as $selection){
				$hear[] = $selection;
			}
		}
	}
	else if($name == 'reason[]'){
		if($_POST['reason']){
			foreach($_POST['reason'] as $selection){
				$reason[] = $selection;
			}
		}
	}
	else if($name =='final8[]'){
		if($_POST['final8']){
			foreach($_POST['final8'] as $selection){
				$final8[] = $selection;
			}
		}
	}
	else{
		$input[$name] = get_input($name);
	} 
}

$container_guid = elgg_get_logged_in_user_guid();
$owner_guid = elgg_get_logged_in_user_guid();

$survey = new ElggObject();
$survey->subtype = "survey";

if (sizeof($input) > 0) {
	foreach ($input as $name => $value) {
		$survey->$name = $value;
		//echo "$survey->$name = $value";
	}
}

$survey->container_guid = $container_guid;
$survey->access_id = 2;
$survey->other1 = get_input('other1');
$survey->other2 = get_input('other2');

if($survey->save()){
	if($hear){
		foreach($hear as $selection){
			$entry = new ElggObject();
			$entry->access_id = 2;
			$entry->title = $selection;
			if($entry->save()){
				$entry->addRelationship($survey->guid, 'hearSelection');
			}
		}	
	}
	if($reason){
		foreach($reason as $selection){
			$entry = new ElggObject();
			$entry->access_id = 2;
			$entry->title = $selection;
			if($entry->save()){
				$entry->addRelationship($survey->guid, 'reasonSelection');
			}
		}	
	}
	if($final8){
		foreach($final8 as $selection){
			$entry = new ElggObject();
			$entry->access_id = 2;
			$entry->title = $selection;
			if($entry->save()){
				$entry->addRelationship($survey->guid, 'final8Selection');
			}
		}
	}
	
	system_message("Survey Submitted");
	forward($survey->getURL());
}
else{
	register_error("Error submitting survey");
	forward(REFERER);
}

