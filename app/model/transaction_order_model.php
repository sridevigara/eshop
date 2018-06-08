<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_order_model extends ES_Model {

	private $id = "id";
	private $orderNumber = "order_number";
	private $userid = "userid";
	private $transactionDate = "transaction_date";
	private $totalGrossAmount = "total_gross_amount";
	private $taxAmount = "tax_amount";
	private $discountAmount = "discount_amount";
	private $totalNetAmount = "total_net_amount";
	private $paymentGateway = "payment_gateway";
	private $paymentStatus = "payment_status";
	private $transactionStatus = "transaction_status";
	private $currencyid = "currencyid";
	private $ipaddress = "ipaddress";
	private $userAgent = "user_agent";
	private $createdBy = "created_by";
	private $modifiedBy = "modified_by";
	private $deleted = "deleted";
	private $tableName = "transaction_order";

    function __construct() {
        parent::__construct();
    }
	
	public function addTransactionOrder($sqlInput = array())
	{
		$insertData = array();
		
		$insertData[$this->orderNumber] = $sqlInput['orderNumber'];
		$insertData[$this->userid] = $sqlInput['userId'];
		$insertData[$this->transactionDate] = date("Y-m-d H:m:i");
		$insertData[$this->totalGrossAmount] = $sqlInput['totalGrossAmount'];
		$insertData[$this->discountAmount] = 0;
		$insertData[$this->totalNetAmount] = $sqlInput['totalNetAmount'];
		$insertData[$this->paymentGateway] = $sqlInput['paymentGateway'];
		$insertData[$this->paymentStatus] = "success";
		$insertData[$this->transactionStatus] = "success";
		$insertData[$this->currencyid] = 1;
		$insertData[$this->ipaddress] = $sqlInput['clientIP'];
		$insertData[$this->userAgent] =$sqlInput['userAgent'];
		$insertData[$this->createdBy] = $sqlInput['userId'];
		$insertData[$this->modifiedBy] = $sqlInput['userId'];
		$result = $this->db->insert($this->tableName,$insertData);
		return $this->db->insert_id();

		
	}

}
