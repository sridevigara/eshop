<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "Home";
$route['(:any)-category.html'] = "Category/index/$1";
$route['(:any).html'] = "Product/index/$1";
$route['addcart'] = "Cart/addToCart";
$route['checkout'] = "Cart/checkoutCart";
$route['deletecart/(:any)'] = "Cart/deleteCart/$1";
$route['login'] = "User/login";
$route['logout'] = "User/logout";
$route['loginauthentication'] = "User/loginAuth";
$route['registration'] = "User/userRegister";
$route['filter-(:any)'] = "Home/index/$1";
$route['order'] = "Cart/transactionOrderInsert";

/* End of file routes.php */
/* Location: ./app/config/routes.php */