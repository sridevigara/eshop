<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends ES_Model {

	private $id = "id";
	private $password = "password";
	private $email = "email";
	private $name = "name";
	private $signupDate = "signupdate";
	private $address = "address";
	private $countryId = "countryid";
	private $mobile = "mobile";
	private $zipcode = "zipcode";
	private $ipaddress = "ipaddress";
	private $userAgent = "user_agent";
	private $usertype = "usertype";
	private $status = "status";
	private $deleted = "deleted";
	private $tableName = "user";

    function __construct() {
        parent::__construct();
    }
	
	public function addUser($sqlInput = array())
	{
		$response = array();
		$result = array();
		$insertData = array();
		$insertData[$this->email] = $sqlInput['userEmail'];
		$insertData[$this->name] = $sqlInput['userName'];
		$insertData[$this->password] = encryptPassword($sqlInput['userPassword']);
		$insertData[$this->signupDate] = date("Y-m-d H:m:i");
		$insertData[$this->status] = 1;
		$insertData[$this->ipaddress] = $sqlInput['clientIP'];
		$insertData[$this->userAgent] =$sqlInput['userAgent'];
		if(!empty($sqlInput['userEmail']) && !empty($sqlInput['userPassword']))
		{
			$result = $this->db->insert($this->tableName,$insertData);
			return $this->db->insert_id();

		}
		return 0;
	}
	
	public function getUserDetail($sqlInput = array())
	{
		$response = array();
		$result = array();
		$userId = 0;
		$bindData = array();
		if(!empty($sqlInput['id'])) 
		{
			$userId = $sqlInput['id'];
			$bindData[$this->id] = $sqlInput['id'];
		}
		$query = "SELECT ".$this->id.",".$this->email.",".$this->name.",".$this->signupDate.",".$this->address.",".$this->countryId.",".$this->mobile.",".$this->zipcode." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 and ".$this->id." = ? " ;
		
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
	
	public function validateUser($sqlInput = array())
	{
		$response = array();
		$result = array();
		$bindData = array();
		if(!empty($sqlInput['userEmail'])) 
		{
			$bindData[$this->email] = $sqlInput['userEmail'];
		}
		$query = "SELECT count(".$this->id."),".$this->password.",".$this->name.",".$this->id." FROM ".$this->tableName." where ".$this->status." =1 and ".$this->deleted." =0 and ".$this->email." = ? " ;
		
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