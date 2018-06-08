<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//To encrypt the password 
function encryptPassword($passwordString) {
    return md5($passwordString);
}

//To get the login user id
function getUserId() 
{
	$ES = &get_instance();
        $sessionUserId = $ES->session->getData("userId");
        $userId = (!empty($sessionUserId)) ? $sessionUserId : 0;
	return $userId;
}

//To get the login user id
function getCartData() 
{
	$cartData = array();
	$ES = &get_instance();
	$cartData = $ES->session->getData(DEFAULT_CART_VARIABLE);
	return $cartData;
}


//Get All categories list
function getAllCategories()
{
	$ES = &get_instance();
	$ES->load->model("Category_model");
	$data = array();
	$sqlInput = array();
	$sqlInput['limit'] = DEFAULT_LIMIT;
	$categoryResult = $ES->Category_model->getAllCategories($sqlInput);
	$categorydata = $categoryResult['data'];
	$categorydataFinal = array();
	foreach($categoryResult['data'] as $catData)
	{
		$categorydataFinal[$catData['parentid']][] = $catData;
	}
	return $categorydataFinal;

}


//Get All categories list
function getColorFilter()
{
	$ES = &get_instance();
	$ES->load->model("Product_model");
	$data = array();
	$sqlInput = array();
	$colorResult = $ES->Product_model->getColorList();
	$colordata = (!empty($colorResult['data'])) ? $colorResult['data'] : array();
	return $colordata;

}


function commonHelperGetIdArray($input, $groupByKey = 'id') {
    $returnArray = array();
    if (count($input) > 0) {
        foreach ($input as $key => $val) {
            $keyname = $val[$groupByKey];
            foreach ($val as $id => $value) {
                if ($id == $groupByKey)
                    $keyname = $value;
                $returnArray[$keyname][$id] = $value;
            }
        }
    }
    return $returnArray;
}


function getPageUrl($pageName, $params = "", $getParams = "") 
{
	$pageUrls = array();
	$base_url = BASE_URL;
    $pageUrls['home'] = $base_url;
    $pageUrls['category'] = $base_url . $params;
	$pageUrls['productDetail'] = $base_url . $params;
    $pageUrls['login'] = $base_url . "login";
	$pageUrls['loginAuth'] = $base_url ."loginauthentication";
	$pageUrls['userRegister'] = $base_url ."registration";
    $pageUrls['addtoCart'] = $base_url . "addcart";
	$pageUrls['deleteCart'] = $base_url . "deletecart";
    $pageUrls['cart'] = $base_url . "cart";
	$pageUrls['transactionOrder'] = $base_url . "order";
	$pageUrls['checkoutCart'] = $base_url . "checkout";
	$pageUrls['logout'] = $base_url . "logout";
	$return = (isset($pageUrls[$pageName])) ? $pageUrls[$pageName] : $base_url;
	return $return;
}


function validEmail($str) 
{
	$result = (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
			
	if($result==TRUE){
	$ES = &get_instance();
	$blockedDomains=$ES->config->item('blockedEmailDomains');
	$domain = '@'.substr(strrchr($str, "@"), 1);
	
	foreach ($blockedDomains as $key => $value) 
	{
	   if($domain==$value)
	   {
		   return FALSE;
	   }
	}
	return TRUE;
	}else
	{
		return FALSE;
	}
                
}

function getErrorMessage($errorNo)
{
	switch ($errorNo) 
	{
		case 1:
			return ERROR_MESSAGE_UR1;
			break;
		case 2:
			return ERROR_MESSAGE_UR2;
			break;
		case 3:
			return ERROR_MESSAGE_UR3;
			break;
		case 4:
			return ERROR_MESSAGE_UL4;
			break;
		case 5:
			return ERROR_MESSAGE_UL5;
			break;
	   default:
			return "";
	}
}

function getNewOrderId($userId)
{
	return $userId.date("dmYHmi");
}
