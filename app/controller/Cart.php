<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends ES_Controller {

	public function __construct() {
		parent::__construct();
		
    }
	
	public function index() 
	{
		$inputArray = $this->input->get();
		$cartData = $this->session->getData(DEFAULT_CART_VARIABLE);
		
		$productIds = (!empty($cartData)) ? array_keys($cartData) : array();
		$this->load->model("Product_model");
		$data = array();
		$data['content'] = 'cart_view';
		$data['pageName'] = 'Cart';
		$sqlInput = array();
		$data['cartProductData'] = array();
		if(!empty($productIds))
		{
			$sqlInput['id'] = $productIds;
			$productResult = $this->Product_model->getProductDetail($sqlInput);
			$data['cartProductData'] = $productResult['data'];
		}
		
		$data['cartData'] = $cartData;
		$this->load->view('template/index_template', $data);		
	}
	
	public function addToCart()
	{
		$inputArray = $this->input->post();
		if(empty($inputArray['productId']))
			$productId = intval($_REQUEST['productId']);
		else
			$productId = intval($inputArray['productId']);
		if(empty($inputArray['productQuantity']))
		 	$productQuantity = (!empty($_REQUEST['productQuantity'])) ? intval($_REQUEST['productQuantity']) : 1; 
		else
			$productQuantity = (!empty($inputArray['productQuantity'])) ? intval($inputArray['productQuantity']) : 1; intval($inputArray['productQuantity']);
		if($productId > 0 && $productQuantity>0)
		{
			$productSessionData = array();
			$productIdSession = $this->session->getData($productId,DEFAULT_CART_VARIABLE);
			if($productIdSession['productId'] > 0 && $productIdSession['productQuantity'] > 0)
			{
				$productSessionData["productId"] = ($productId + $productIdSession['productId']);
				$productSessionData["productQuantity"] = ($productQuantity + $productIdSession['productQuantity']);
				$this->session->setData($productId,$productSessionData,DEFAULT_CART_VARIABLE);
			}
			else
			{
				$productSessionData["productId"] = $productId;
				$productSessionData["productQuantity"] = $productQuantity;
				$this->session->setData($productId,$productSessionData,DEFAULT_CART_VARIABLE);
			}
			
		}
		header('location: '.getPageUrl("cart"));
	}

	public function deleteCart($id) 
	{
		$productId = intval($id);
		$productSessionId = $this->session->getData($productId,DEFAULT_CART_VARIABLE);
		if(isset($productSessionId))
		{
			$cartData = $this->session->unSetData($productId,DEFAULT_CART_VARIABLE);
		}
		header('location: '.getPageUrl("cart"));		
	}
	
	public function checkoutCart() 
	{
		$this->session->userLoginAuth("checkoutCart");
		$data = array();
		$cartData = $this->session->getData(DEFAULT_CART_VARIABLE);
		
		$productIds = (!empty($cartData)) ? array_keys($cartData) : array();
		$this->load->model("Product_model");
		$sqlInput = array();
		$data['cartProductData'] = array();
		if(!empty($productIds))
		{
			$sqlInput['id'] = $productIds;
			$productResult = $this->Product_model->getProductDetail($sqlInput);
			$data['cartProductData'] = $productResult['data'];
			
			$insertInputData['id'] =  $this->session->getUserId();
			$this->load->model("User_model");
			$userIdData = $this->User_model->getUserDetail($insertInputData);
			$data['userData'] = (!empty($userIdData['data'])) ? $userIdData['data'][0] : array();
		}
		$cartTotal = 0;
		$cartCount = count($data['cartProductData']);
		if($cartCount == 0)
		{
			
		}
		else 
		{
			foreach ($data['cartProductData'] as $cartKey => $cartValue) 
			{
				$cartProductQuantity = "";
				$cartProductQuantity = $cartData[$cartValue['id']]['productQuantity'];		
				$cartTotal = $cartTotal + ($cartValue['price']*$cartProductQuantity);
			}
		}
		
		$data['orderData']['cartTotalAmount'] = $cartTotal; 
		$data['content'] = 'checkout_view';
		$data['pageName'] = 'Checkout Cart';	
		$this->load->view('template/index_template', $data);	
	}
	
	public function transactionOrderInsert() 
	{
		$inputArray = $this->input->post();
		$this->session->userLoginAuth("checkoutCart");
		$cartData = $this->session->getData(DEFAULT_CART_VARIABLE);
		$productIds = (!empty($cartData)) ? array_keys($cartData) : array();
		
		$sqlInput = array();
		$data['cartProductData'] = array();
		if(!empty($productIds))
		{
			$this->load->model("Product_model");
			$this->load->model("Transaction_order_model");
			$this->load->model("Transaction_order_item_model");
			
			
			$sqlInput['id'] = $productIds;
			$productResult = $this->Product_model->getProductDetail($sqlInput);
			$data['cartProductData'] = $productResult['data'];
			$cartTotal = 0;

			//Begin Transaction
			$this->db->trans_begin();
			foreach ($data['cartProductData'] as $cartKey => $cartValue) 
			{
				$cartProductQuantity = "";
				$cartProductQuantity = $cartData[$cartValue['id']]['productQuantity'];		
				$cartTotal = $cartTotal + ($cartValue['price']*$cartProductQuantity);
				
				
			}
			
			$insertInputData = array();
			$orderNumber = getNewOrderId($this->session->getUserId());
			$insertInputData['userId'] = $this->session->getUserId();
			$insertInputData['orderNumber'] = $orderNumber;
			$insertInputData['totalGrossAmount'] = $cartTotal;
			$insertInputData['totalNetAmount'] = $cartTotal;
			$insertInputData['paymentGateway'] = $inputArray['payment'];
			$insertInputData['userAgent'] = $this->input->user_agent();
			$insertInputData['clientIP'] = $this->input->ip_address();
			$orderId = $this->Transaction_order_model->addTransactionOrder($insertInputData);
			
			if($orderId > 0)
			{
				foreach ($data['cartProductData'] as $cartKey => $cartValue) 
				{
					$cartProductQuantity = "";
					$cartProductQuantity = $cartData[$cartValue['id']]['productQuantity'];		
					$sqlITxnItemnput = array();
					$sqlITxnItemnput['orderId'] = $orderId;
					$sqlITxnItemnput['productQuantity'] = $cartProductQuantity;
					$sqlITxnItemnput['productId'] = $cartValue['id'];
					$sqlITxnItemnput['totalGrossAmount'] = ($cartValue['price']*$cartProductQuantity);
					$sqlITxnItemnput['totalNetAmount'] = ($cartValue['price']*$cartProductQuantity);
					$this->Transaction_order_item_model->addTransactionItemOrder($sqlITxnItemnput);
					
				}
				$this->db->trans_commit();
				$transactionStatus = $this->db->trans_status();
				if ($transactionStatus === FALSE) 
				{
					$this->db->trans_rollback();
					header('location: '.getPageUrl("cart"));
				}
				$this->session->unSetData(DEFAULT_CART_VARIABLE);
				$data['content'] = 'order_confirmation_view';
				$data['pageName'] = 'Checkout Cart';	
				$data['orderNumber'] = $orderNumber;
				$this->load->view('template/index_template', $data);
			}
			else
			{
				$this->db->trans_rollback();
				header('location: '.getPageUrl("cart"));
			}
			
			
			
		}
		else
		{
			header('location: '.getPageUrl("cart"));
		}
		
		
	}

}
