<?php
	$guid = get_input('group_guid');
	$groupName = get_input('name');
	//get group
	$oldGroup = get_entity($guid);
	//get user
	$user = get_user($oldGroup->owner_guid);
	//create new group
	$newGroup = clone $oldGroup;
	$newGroup->name = $groupName;
	$newGroup->save();
	$newGroup->join($user);
	//get admins from old group and add them to the new one
	$oldAdmins = elgg_get_entities_from_relationship(array(
		"relationship" => "group_admin",
   		"relationship_guid" => $oldGroup->getGUID(),
		"inverse_relationship" => true,
	));
	foreach($oldAdmins as $admin){
		$newGroup->join($admin);
		add_entity_relationship($admin->getGUID(), "group_admin", $newGroup->getGUID());
	}
	add_to_river('river/group/create', 'create', $user->guid, $newGroup->guid, $newGroup->access_id);
	$newGroup->save();
	
	//get all categories associated with the group and associate them with the copied group
	$groupCats = elgg_get_entities(array(
				'type' => 'object',
				'subtype' => 'hjcategory',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'container_guid' => $guid
	));
	foreach($groupCats as $groupCat){
		$newGroupCat = clone $groupCat;
		$newGroupCat->container_guid = $newGroup->guid;
		$newGroupCat->save();
	}
	//clone files belonging to the old group add add them to their new categories
	$groupFiles = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'file',
		'order_by' => 'e.last_action desc',
		'limit' => 300,
		'full_view' => false,
		'container_guid' => $guid
	));
	foreach($groupFiles as $groupFile){
		$newGroupFile = clone $groupFile;
		$newGroupFile->container_guid = $newGroup->guid;
		$newGroupFile->access_id = $newGroup->group_acl;
		$newGroupFile->save();
		//if file is tagged in a category, need to update to reflect copied groups category
		if($newGroupFile->universal_categories){
			$categories = elgg_get_entities(array(
				'type' => 'object',
				'subtype' => 'hjcategory',
				'order_by' => 'e.last_action desc',
				'limit' => 20,
				'full_view' => false,
				'container_guid' => $newGroup->guid
			));
			$copyCategories = elgg_get_entities_from_relationship(array(
				'relationship' => HYPECATEGORIES_RELATIONSHIP,
				'relationship_guid' => $groupFile->guid,
				'inverse_relationship' => false,
			));
			foreach($categories as $category){
				foreach($copyCategories as $c){
					if($category->title == $c->title){
						add_entity_relationship($newGroupFile->guid, HYPECATEGORIES_RELATIONSHIP, $category->guid);
					}
				}
			}
		}
		//$newGroupFile->save();
	}
	//get all folders associated with the group and associate them with the new copied group
	$groupFolders = elgg_get_entities(array(
				'type' => 'object',
				'subtype' => 'folder',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'container_guid' => $guid
	));
	foreach($groupFolders as $groupFolder){
		$newGroupFolder = clone $groupFolder;
		$newGroupFolder->container_guid = $newGroup->guid;
		$newGroupFile->access_id = $newGroup->group_acl;
		$newGroupFolder->save();
		$files = elgg_get_entities(array(
			'type' => 'object',
			'subtype' => 'file',
			'order_by' => 'e.last_action desc',
			'limit' => 300,
			'full_view' => false,
			'container_guid' => $newGroup->guid
		));
		$oldFolderFiles = elgg_get_entities_from_relationship(array(
				'relationship' => 'folder_of',
				'relationship_guid' => $groupFolder->guid,
				'inverse_relationship' => false,
		));
		foreach($oldFolderFiles as $f){
			foreach($files as $file){
				if($file->title == $f->title){
					add_entity_relationship($newGroupFolder->guid, 'folder_of', $file->guid);
				}
			}
		}
	}

	//get parent-group from old group (if it was a subgroup)
	$oldParentGroup = elgg_get_entities_from_relationship(array(
		"relationship" => "au_subgroup_of",
   		"relationship_guid" => $oldGroup->getGUID(),
   		"inverse_relationship" => true
	));
	
	foreach($oldParentGroup as $oldPGroup){
		$newSubgroup = clone $oldPGroup;
		$newSubgroup->container_guid = $newGroup->guid;
		$newSubgroup->access_id = $newGroup->group_acl;
		$newSubgroup->parent_guid = $newGroup->guid;
		$newSubgroup->save();
		add_entity_relationship($oldPGroup->getGUID(), "au_subgroup_of",$newGroup->getGUID());
	}

	forward($newGroup->getURL());