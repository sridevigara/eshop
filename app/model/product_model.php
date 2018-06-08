<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends ES_Model {

	private $id = "id";
	private $productNumber = "product_number";
	private $name = "name";
	private $catId = "catid";
	private $price = "price";
	private $currencyId = "currencyid";
	private $color = "color";
	private $thumb = "thumb";
	private $description = "description";
	private $metaKeywords = "meta_keywords";
	private $metaDescription = "meta_description";
	private $sefUrl = "sef_url";
	private $status = "status";
	private $deleted = "deleted";
	private $tableName = "product";
	private $ordering = "ordering";

    function __construct() {
        parent::__construct();
    }
    
    public function getLatestProducts($sqlInput = array())
	{
		$response = array();
		$result = array();
		$query = "SELECT ".$this->id.",".$this->productNumber.",".$this->name.",".$this->color.",".$this->description.",".$this->thumb.",".$this->price.",".$this->sefUrl.",".$this->catId." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 "  ;
		$bindData = array();
		if(!empty($sqlInput['catId'])) 
		{
			$bindData[$this->catId] = $sqlInput['catId'];
			$query.= " and ".$this->catId." in (?)";
			
			
		}
		if(!empty($sqlInput['filterColor'])) 
		{
			$bindData[$this->color] = $sqlInput['filterColor'];
			$query.= " and ".$this->color." in (?)";
			
			
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
	
	
	public function getProductByUrl($sqlInput = array())
	{
		$response = array();
		$query = "SELECT ".$this->id.",".$this->productNumber.",".$this->name.",".$this->color.",".$this->description.",".$this->thumb.",".$this->price.",".$this->sefUrl.",".$this->catId." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 " ;
		$bindData = array();
		if(!empty($sqlInput['sefUrl'])) 
		{
			$bindData[$this->sefUrl] = $sqlInput['sefUrl'];
			$query.= " and ".$this->sefUrl."= ?";
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
		
		
	public function getProductDetail($sqlInput = array())
	{
		$response = array();
		$query = "SELECT ".$this->id.",".$this->productNumber.",".$this->name.",".$this->color.",".$this->description.",".$this->thumb.",".$this->price.",".$this->sefUrl.",".$this->catId." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 " ;
		$bindData = array();
		if(!empty($sqlInput['id'])) 
		{
			$bindData[$this->id] = $sqlInput['id'];
			$query.= " and ".$this->id." in  (?) ";
			
			
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
	
	public function getColorList()
	{
		$response = array();
		$query = "SELECT distinct(".$this->color.") FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 " ;
		$bindData = array();
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
