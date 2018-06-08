<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class ES_Session {

    public function __construct() {
        session_start();
    }

    public function setData($key,$value="",$multyArrayKey = '') 
	{

		if(strlen($key) > 0)
		{
			if(strlen($multyArrayKey) > 0)
			{
				$_SESSION[$multyArrayKey][$key] = $value;
			}
			else
				$_SESSION[$key] = $value;
			return true;		
		}
			return FALSE;
	
	}

	public function getData($key,$multyArrayKey="") 
	{
		if(strlen($key) > 0 ) 
		{
				if(strlen($multyArrayKey) > 0 && isset($_SESSION[$multyArrayKey][$key]))
				{
					return $_SESSION[$multyArrayKey][$key];
				}
				else if(isset($_SESSION[$key]))
					return $_SESSION[$key];
				
		}
			return false;
	}
	
	public function unSetData($key,$multyArrayKey="")
	{

		if(strlen($key) > 0 ) 
		{
			if(strlen($multyArrayKey) > 0 && isset($_SESSION[$multyArrayKey][$key]))
			{
				unset($_SESSION[$multyArrayKey][$key]);
			}
			else if(isset($_SESSION[$key]))
			{
				unset($_SESSION[$key]);
			}
				return true;
		}
			return false;
	}
	
	public function getUserId() 
	{
        if(isset($_SESSION['userId']) && $_SESSION['userId']>0)  // if userid session is set then return userid
			return $_SESSION['userId'];
		else
			return FALSE;
	}
	
	public function destroy() 
	{
		foreach ($_SESSION as $key=>$value)
		{
			if (isset($_SESSION[$key]))
				unset($_SESSION[$key]);
		}
		return true;
	
	}
	
	public function userLoginAuth($redirectPage) 
	{
		if(isset($_SESSION['userId']) && $_SESSION['userId']>0)  // if userid session is set then return userid
			return $_SESSION['userId'];
		else
		{
			header('location: '.getPageUrl("login")."?p=".$redirectPage);	
		}
	}
	

}
