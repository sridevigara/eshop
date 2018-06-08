<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_order_item_model extends ES_Model {

	private $id = "id";
	private $orderId = "orderid";
	private $productId = "product_id";
	private $quantity = "quantity";
	private $grossAmount = "gross_amount";
	private $discountAmount = "discount_amount";
	private $netAmount = "net_amount";
	private $modifiedBy = "modified_by";
	private $deleted = "deleted";
	private $tableName = "transaction_order_item";

    function __construct() {
        parent::__construct();
    }
	
	public function addTransactionItemOrder($sqlInput = array())
	{
		$insertData = array();
		
		$insertData[$this->orderId] = $sqlInput['orderId'];
		$insertData[$this->quantity] = $sqlInput['productQuantity'];
		$insertData[$this->productId] = $sqlInput['productId'];
		$insertData[$this->grossAmount] = $sqlInput['totalGrossAmount'];
		$insertData[$this->discountAmount] = 0;
		$insertData[$this->netAmount] = $sqlInput['totalNetAmount'];
		$result = $this->db->insert($this->tableName,$insertData);
		return $this->db->insert_id();

		
	}

}
