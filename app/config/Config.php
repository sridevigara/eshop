<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['base_url'] = '';

$config['index_page'] = '';

$config['uri_protocol'] = 'REQUEST_URI';

$config['protocol'] = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$config['emailEnable']=TRUE;

$config['subclass_prefix'] = '';

$config['blockedEmailDomains']=array('@mailinator.com');

$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use

$config['default_controller'] = 'Home';
	
/* Database Credentials*/
$config['db_hostname'] = 'sridevishop.cbao7xdibu95.us-east-2.rds.amazonaws.com';
$config['db_username'] = 'appUser';
$config['db_password'] = 'appUser';
$config['db_database'] = 'esshop';
$config['db_port']     = '3306';

