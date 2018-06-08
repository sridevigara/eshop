<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends ES_Controller {

	public function __construct() {
		parent::__construct();
		
    }
	
	public function login() 
	{
		$inputArray = $this->input->get();
		$rmessage = (!empty($_REQUEST['rmessage'])) ? intval($_REQUEST['rmessage']) : 0 ;
		$lmessage = (!empty($_REQUEST['lmessage'])) ? intval($_REQUEST['lmessage']) : 0 ;
	 	$redirectPage = (!empty($_REQUEST['p'])) ? $_REQUEST['p'] : "" ;
		$data = array();
		if($rmessage > 0)
		{
			$data['rmessage'] = getErrorMessage($rmessage);
		}
		if($lmessage > 0)
		{
			$data['lmessage'] = getErrorMessage($lmessage);
		}
		$data['content'] = 'login_view';
		$data['pageName'] = 'Login';
		$data['redirectPage'] = $redirectPage;
		$data['base_url'] = $this->config->item("base_url");
		$this->load->view('template/index_template', $data);		
	}
	
	public function loginAuth()
	{
		$errorCode = 0;
		$inputArray = $this->input->post();
		$redirectPage = (!empty($inputArray['redirect_page'])) ? ($inputArray['redirect_page']) : "cart" ;
		$emailValid = validEmail($inputArray['email']);
		$userPassword = (!empty($inputArray['password'])) ? $inputArray['password'] : "";  
		if($emailValid == 1 && strlen($userPassword) > 5)
		{
			$insertInputData = array();
			$insertInputData['userEmail'] = $inputArray['email'];
			$this->load->model("User_model");
			$userIdData = $this->User_model->validateUser($insertInputData);
			if($userIdData['status'])
			{
				$dbPassword = $userIdData["data"][0]['password'];
				$dbUserId = $userIdData["data"][0]['id'];
				$dbUserName = $userIdData["data"][0]['name'];
				$userInputPassword = encryptPassword($userPassword);
				if($dbPassword === $userInputPassword)
				{
					$this->session->setData("userId",$dbUserId);
					$this->session->setData("userName",$dbUserName);
					$this->session->setData("userEmail",$inputArray['email']);
					header('location: '.getPageUrl($redirectPage));
				}
				else
				{
					$errorCode = 5;
				}
			}
			else
			{
				$errorCode = 4;
			}

		}
		if($errorCode  > 0)
			header('location: '.getPageUrl("login")."?lmessage=".$errorCode."&p=".$redirectPage);

	}
	
	public function userRegister()
	{
		$errorCode = 0;
		$inputArray = $this->input->post();
		$userName = $inputArray["name"];
		$emailValid = validEmail($inputArray['email']); 
		$redirectPage = (!empty($inputArray['redirect_page'])) ? ($inputArray['redirect_page']) : "cart" ;
		if($emailValid == 1)
		{
			$userEmail = (!empty($inputArray['email'])) ? $inputArray['email'] : "";
			$userPassword = (!empty($inputArray['password'])) ? $inputArray['password'] : ""; 
			$userCPassword = (!empty($inputArray['passwordagain'])) ? $inputArray['passwordagain'] : ""; 
			$userName = (!empty($inputArray['name'])) ? $inputArray['name'] : ""; 
			if(strlen($userPassword) < 6 || $userPassword!==$userCPassword)
			{
				$errorCode = 2;
			}
			else
			{
				$insertInputData = array();
				$insertInputData['userEmail'] = $userEmail;
				$insertInputData['userName'] = $userName;
				$insertInputData['userPassword'] = $userPassword;
				$insertInputData['userAgent'] = $this->input->user_agent();
				$insertInputData['clientIP'] = $this->input->ip_address();
				$this->load->model("User_model");
				$userId = $this->User_model->addUser($insertInputData);
				if($userId > 0)
				{
					$this->session->setData("userId",$userId);
					$this->session->setData("userName",$userName);
					$this->session->setData("userEmail",$userEmail);
					header('location: '.getPageUrl($redirectPage));
				}
				else
				{
					$errorCode = 3;
				}
				
			}
		}
		else
		{
			$errorCode = 1;
		}
		if($errorCode  > 0)
			header('location: '.getPageUrl("login")."?rmessage=".$errorCode."&p=".$redirectPage);
	}
	
	public function logout() 
	{
		$this->session->destroy();
		header('location: '.getPageUrl("home"));
		
	}
	
}
