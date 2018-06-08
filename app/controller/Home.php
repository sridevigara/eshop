<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends ES_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		
    }
	
	public function index($filter="") 
	{
		$inputArray = $this->input->get();
		$this->load->model("Product_model");
		$data = array();
		$data['content'] = 'home_view';
		$data['pageName'] = 'Home';
		//$limit = DEFAULT_LIMIT;
		$sqlInput = array();
		$sqlInput['filterColor'] = (!empty($filter)) ? $filter : "";
		$productResult = $this->Product_model->getLatestProducts($sqlInput);
		$data['productData'] = $productResult['data'];
		$data['colorSelected'] = $filter;
		$data['base_url'] = $this->config->item("base_url");
		$this->load->view('template/index_template', $data);		
	}
	
	
}
