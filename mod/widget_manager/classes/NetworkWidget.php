<?php
/*
* Network Class
*******************************
*/
class NetworkWidget extends ElggObject{
	
	function initializeAttributes(){
		parent::initializeAttributes();

		$this->userGuid = $this->getUserGuid();
		$this->user = $this->getUser();
		$this->userName = $this->getUserName();
	}

	function __construct(){
		$this->initializeAttributes();
	}

	public function getUserGuid(){
		return elgg_get_logged_in_user_guid();
	}

	protected function getUser(){
		if($this->userGuid){
			return get_entity($this->userGuid);
		}
	}

	public function getUserName(){
		return $this->user->username;
	}

	public function numOfEntities($subtype, $container_guid){
		$options = array(
			'type' => 'object',
			'subtype' => $subtype,
			'container_guid' => $container_guid,
			'full_view' => FALSE,
			'count' => TRUE
		);

		return elgg_get_entities($options);
	}

	public function numOfEntitiesFromRelationship($type, $relationship, $relationship_guid, $inverse = false){
		$options = array(
			'type' => $type,
			'relationship' => $relationship,
			'relationship_guid' => $relationship_guid,
			'full_view' => FALSE,
			'count' => TRUE,
			'inverse_relationship' => $inverse
		);
		return elgg_get_entities_from_relationship($options);
	}

	public function numOfEntitiesFromMetadata($subtype, $owner_guid, $isCount, $value_pairs){
		
		$options = array(
			'type' => 'object',
			'subtype' => $subtype,
			'order_by' => 'e.last_action desc',
			'owner_guid' => $owner_guid,
			'full_view' => FALSE,
			'count' => $isCount,
			'metadata_name_value_pairs' => $value_pairs
		);

		return elgg_get_entities_from_metadata($options);
	}
}