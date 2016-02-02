<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Project
 *
 * @author McFarlane.a
 */
class Project {
	
	private $options = array();
	
	private $required = array('title', 'org');
	
	private $collection = array();
	
	public $title;
	public $description;
	public $scope;
	public $course;
	public $org;
	public $owner_guid;
	public $container_guid;
	public $project_type;
	public $is_priority;
	public $priority;
	public $is_sme_avail;
	public $is_limitation;
	public $update_existing_prod;
	public $life_expectancy;
	public $access_id;
	
	public function __construct($params) 
	{
		foreach($params as $key => $param) {
			if($key!="user_id") {
				$this->$key = $param;
			}
		}
		if($params['user_id']) {
			$this->subtype = "project_registry";
			$this->owner_guid = $params['user_id'];
			$this->container_guid = $params['user_id'];
			$this->access_id = ACCESS_PUBLIC;
		}
	}
	
	public static function withID($id)
	{
		$instance = new self();
		$instance->loadByID($id);
		return $instance;
	}
	
	public static function all($params)
	{
		$instance = new self();
		$instance->loadAll($params);
		return $instance;
	}
	
	protected function loadByID($id)
	{
		$row = get_entity($id);
		$this->fill($row);
	}
	
	protected function loadAll($params)
	{
		$this->options = array(
			"type" => "object",
			"subtype" => "project_registry",
			"limit" => false,
			"full_view" => false,
			"metadata_name_value_pairs" => array()
		);
		
		foreach($params as $key => $param) {
			$this->options["metadata_name_value_pairs"][] = array(
				"name" => $key,
				"value" => $param
			);
		}
		
		$rows = elgg_get_entities_from_metadata($this->options);
		$this->fillWithRows($rows);
	}
	
	public function validate()
	{
		//check required fields
		foreach($this as $key => $val) {
			if(in_array($key, $this->required)) {
				if(empty($val)) {
					$this->errors[$key] = $key." must not be empty";
				}
			}
		}
		return true;
	}
	
	public function create()
	{	
		elgg_set_ignore_access();
		
		$project = new ElggObject();
		foreach($this as $key => $val) {
			if($key!='options' || $key!='required'){
				$project->$key = $val;
			}
		}
		
		if($project->save()) {
			return true;
		}
		else{
			return false;
		}
	}
	
	private function fill($row)
	{
		
	}
	
	private function fillWithRows($rows)
	{
		foreach($rows as $row) {
			$params['title'] = $row->title;
			$params['description'] = $row->description;
			$params['scope'] = $row->scope;
			$params['course'] = $row->course;
			$params['org'] = $row->org;
			$params['owner_guid'] = $row->owner_guid;
			$params['container_guid'] = $row->container_guid;
			$params['project_type'] = $row->project_type;
			$params['is_priority'] = $row->is_priority;
			$params['priority'] = $row->priority;
			$params['is_sme_avail'] = $row->is_sme_avail;
			$params['is_limitation'] = $row->is_limitation;
			$params['update_existing_prod'] = $row->update_existing_prod;
			$params['life_expectancy'] = $row->life_expectancy;
			$params['access_id'] = $row->access_id;
			
			$this->addToCollection(new Project($params));
		}
	}
	
	private function addToCollection($project)
	{
		$this->collection[] = $project;
	}
	
	public function getCollection()
	{
		return $this->collection;
	}
}
