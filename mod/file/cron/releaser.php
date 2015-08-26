<?php
	/**
	 * release time constrained files
	 * run through crontab
	 *
	*/	
	login($admin);
	$admin = get_user(33);
	elgg_set_ignore_access(true);
	date_default_timezone_set('America/Toronto');
	$db_prefix = elgg_get_config("dbprefix");


	$joins = array(
		"JOIN {$db_prefix}objects_entity ge ON e.guid = ge.guid", 
		"JOIN {$db_prefix}metadata md on e.guid = md.entity_guid",
		"JOIN {$db_prefix}metastrings msv ON md.name_id = msv.id"
	);
	$wheres = array(
		"msv.string = 'isTimeReleased'"
	);

	//get all time released files
	$content = elgg_get_entities_from_access_id(array(
		'type' => 'object',
		'subtype' => 'file',
		'access_id' => 0,
		'limit' => 5000,
		'joins' => $joins,
		'wheres' => $wheres
	));

	foreach($content as $file){
		$releaseFlag = false;
		if($file->releaseDate < date("Y-m-d")){
			$releaseFlag = true;
		}
		if($file->releaseDate == date("Y-m-d")){
			if($file->releaseTime <= date('H:i',time())){
				$releaseFlag = true;
			}
		}

		if($releaseFlag === true){
			$fileObj = new ElggFile($file->guid);
			$fileObj->access_id = $fileObj->releasedAccessId;

			if($fileObj->save()){
				elgg_delete_metadata(array(
					'guid' => $file->guid,
					'metadata_name' => 'isTimeReleased',
				));
				elgg_delete_metadata(array(
					'guid' => $file->guid,
					'metadata_name' => 'releaseDate',
				));
				elgg_delete_metadata(array(
					'guid' => $file->guid,
					'metadata_name' => 'releaseTime',
				));
				elgg_delete_metadata(array(
					'guid' => $file->guid,
					'metadata_name' => 'releasedAccessId',
				));
			}
			else{

			}
		}
	}

	$wheres = array(
		"msv.string = 'isClosable'"
	);

	//get all files ready to be closed / deleted
	$content = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'file',
		'limit' => 5000,
		'joins' => $joins,
		'wheres' => $wheres
	));

	foreach($content as $file){
		$deleteFlag = false;
		if($file->closeDate == date("Y-m-d")){
			if($file->closeTime <= date('H:i',time())){
				$deleteFlag = true;
			}
		}
		if($file->closeDate < date("Y-m-d")){
			$deleteFlag = true;
		}

		if($deleteFlag){
			$fileObj = new ElggFile($file->guid);
			if($file->delete()){

			}
			else{

			}
		}
	}
logout();
?>