<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends ES_Model {

	private $id = "id";
	private $name = "name";
	private $description = "description";
	private $parentId = "parentid";
	private $metaKeyword = "meta_keyword";
	private $metaDescription = "meta_description";
	private $sefUrl = "sef_url";
	private $ordering = "ordering";
	private $createdBy = "created_by";
	private $modifiedBy = "modified_by";
	private $status = "status";
	private $deleted = "deleted";
	private $tableName = "category";

    function __construct() {
        parent::__construct();
    }
	
	public function getAllCategories($sqlInput = array())
	{
		$response = array();
		$result = array();
		$query = "SELECT ".$this->id.",".$this->parentId.",".$this->name.",".$this->metaKeyword.",".$this->description.",".$this->metaDescription.",".$this->ordering.",".$this->sefUrl." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 "  ;
		$bindData = array();
		if(!empty($sqlInput['parentId'])) 
		{
			$bindData[$this->parentId] = $sqlInput['parentId'];
			$query.= " and ".$this->parentId." = ? ";
			
			
		}
	  	$query .= " order by ".$this->ordering." ASC";
        $result = $this->db->query($query,$bindData);
		if(!empty($result) && count($result) > 0)
		{
			$response['status'] = true;
			$response['data'] = $result;
			return $response;
		}
		else
		{
			$response['status'] = false;
			$response['data'] = array();
			return $response;
		}
	} 
	
	public function getCategoryDetail($sqlInput = array())
	{
		$response = array();
		$result = array();
		$query = "SELECT ".$this->id.",".$this->parentId.",".$this->name.",".$this->metaKeyword.",".$this->description.",".$this->metaDescription.",".$this->ordering.",".$this->sefUrl." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 " ;
		$bindData = array();
		if(!empty($sqlInput['sefUrl'])) 
		{
			$bindData[$this->sefUrl] = $sqlInput['sefUrl'];
			$query.= " and ".$this->sefUrl."= ?";
		}
		else if(!empty($sqlInput['id'])) 
		{
			$bindData[$this->id] = $sqlInput['id'];
			$query.= " and ".$this->id."= ?";
		}
		else
		{
			$bindData[$this->id] = 1;
			$query.= " and ".$this->id."= ?";
		}
		$result = $this->db->query($query,$bindData);
		if(!empty($result) && count($result) > 0)
		{
			$response['status'] = true;
			$response['data'] = $result;
			return $response;
		}
		else
		{
			$response['status'] = false;
			$response['data'] = array();
			return $response;
		}  
	}

}
