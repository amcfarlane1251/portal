<?php
/**
* create access collections for existing groups
*
*/
$access = elgg_get_ignore_access();
elgg_set_ignore_access(true);
//get all groups
$groups = elgg_get_entities(array(
				'type' => 'group',
				'order_by' => 'e.guid desc',
				'limit' => 1000,
				'full_view' => false,
));

foreach($groups as $group){
	//create access collection
	$ac_admin_name = elgg_echo('groups:group') . ":admin: " . $group->name;
	$group_admin_id = create_access_collection($ac_admin_name, $group->guid);

	//give group an admin_acl
	$group->group_admin_acl = $group_admin_id;
	if($group->save()){
		//add group owner to access collection
		add_user_to_access_collection($group->owner_guid, $group->group_admin_acl);
		//add group admins to access collection
		//get group admins
		$admins = elgg_get_entities_from_relationship(array(
			'relationship' => 'group_admin',
			'relationship_guid' => $group->guid,
			'inverse_relationship' => true,
			'limit' => 30
		));
		foreach($admins as $admin){
			add_user_to_access_collection($admin->guid, $group->group_admin_acl);
		}
	}
}

elgg_set_ignore_access($access);
?>