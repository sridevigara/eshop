<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends ES_Controller {

	public function __construct() {
		parent::__construct();
		
    }
	
	public function index() 
	{
		$inputArray = $this->input->get();
		$this->load->model("Product_model");
		$data = array();
		$data['content'] = 'product_view';
		$data['pageName'] = 'Product-Detail';
		$sqlInput = array();
		$sqlInput['sefUrl'] = $this->uri->segments[1];
		$productResult = $this->Product_model->getProductByUrl($sqlInput);
		$data['productData'] = $productResult['data'][0];
		if(!empty($productResult))
		{
			$this->load->model("Category_model");
			$sqlInput = array();
			$sqlInput['id'] = $data['productData']['catid'];
			$categoryResult = $this->Category_model->getCategoryDetail($sqlInput);
			$data['categoryData'] = $categoryResult['data'][0];
					
		}
		$data['baseUrl'] = $this->config->item("base_url");
		
		$this->load->view('template/index_template', $data);		
	}

}
