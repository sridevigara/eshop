<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Common core functions
require(BASEPATH.'core/Common.php');

// Session handler
require(BASEPATH.'core/Session.php');
$Session =& load_class('Session', 'core');

//  Load the framework constants
if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
	require(APPPATH.'config/'.ENVIRONMENT.'/Constants.php');
}
else
{
	require(APPPATH.'config/Constants.php');
}

// Loading Core Configuration
$CFG =& load_class('Config', 'core');
// Do we have any manually set config items in the index.php file?
if (isset($assign_to_config))
{
	$CFG->_assign_to_config($assign_to_config);
}
define("BASE_URL",$CFG->item("base_url"));

	
//Instantiate the URI class
$URI =& load_class('URI', 'core');


//Instantiate the routing class and set the routing
$RTR =& load_class('Router', 'core');
$RTR->_set_routing();
// Set any routing overrides that may exist in the main index file
if (isset($routing))
{
	$RTR->_set_overrides($routing);
}


//Instantiate the Output class
$OUT =& load_class('Output', 'core');


//Load the Input class and sanitize globals
$IN	=& load_class('Input', 'core');


// Initalizing Database connection
require_once(BASEPATH.'core/Database.php');
$params = array(
						'hostname'	=> $CFG->config['db_hostname'],
						'username'	=> $CFG->config['db_username'],
						'password'	=> $CFG->config['db_password'],
						'database'	=> $CFG->config['db_database'],
						'port'		=> $CFG->config['db_port']
					);
$DB = new ES_Database($params);
if ($DB->autoinit == TRUE)
{
	$DB->initialize();
}
// Load the global controller
require BASEPATH.'core/Controller.php';	
function &get_instance()
{
	return ES_Controller::get_instance();
}

$RTR->fetch_class();

// Load the local application controller
// Note: The Router class automatically validates the controller path using the router->_validate_request().
// If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
if ( ! file_exists(APPPATH.'controller/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
{
	show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
}
include(APPPATH.'controller/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');
$class  = $RTR->fetch_class();
$method = $RTR->fetch_method();
if ( ! class_exists($class) OR strncmp($method, '_', 1) == 0 OR in_array(strtolower($method), array_map('strtolower', get_class_methods('ES_Controller'))))
{
	if ( ! empty($RTR->routes['404_override']))
	{
		$x = explode('/', $RTR->routes['404_override']);
		$class = $x[0];
		$method = (isset($x[1]) ? $x[1] : 'index');
		if ( ! class_exists($class))
		{
			if ( ! file_exists(APPPATH.'controller/'.$class.'.php'))
			{
				show_404("{$class}/{$method}");
			}
			include_once(APPPATH.'controller/'.$class.'.php');
		}
	}
	else
	{
		show_404("{$class}/{$method}");
	}
}
$ES = new $class();
$ES->db = $DB;
$ES->session = &$Session;


// Loading Common helper for using global functions	
if (defined('ENVIRONMENT') AND file_exists(APPPATH.'helper/'.ENVIRONMENT.'/Common_helper.php'))
{
	require(APPPATH.'helper/'.ENVIRONMENT.'/Common_helper.php');
}
else
{
	require(APPPATH.'helper/Common_helper.php');
}



// Is there a "remap" function? If so, we call it instead
if (method_exists($ES, '_remap'))
{
	$ES->_remap($method, array_slice($URI->rsegments, 2));
}
else
{
	// is_callable() returns TRUE on some versions of PHP 5 for private and protected
	// methods, so we'll use this workaround for consistent behavior
	if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($ES))))
	{
		// Check and see if we are using a 404 override and use it.
		if ( ! empty($RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}
				include_once(APPPATH.'controllers/'.$class.'.php');
				unset($ES);
				$ES = new $class();
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}
	// Call the requested method.
	// Any URI segments present (besides the class/function) will be passed to the method for convenience
	call_user_func_array(array(&$ES, $method), array_slice($URI->rsegments, 2));
}

//Displaying the final output to browser
$OUT->_display();

//Close the DB connection if one exists
if (isset($ES->db->conn_id))
{
	$ES->db->close();
}
