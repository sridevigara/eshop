<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends ES_Controller 
{

	public function __construct() 
	{
		parent::__construct();
	}
	
	public function index() 
	{
		$inputArray = $this->input->get();
		$this->load->model("Category_model");
		$data = array();
		$data['content'] = 'category_view';
		$data['pageName'] = 'Home';
		$sqlInput = array();
		$sqlInput['sefUrl'] = $this->uri->segments[1];
		$sqlInput['limit'] = DEFAULT_LIMIT;
		$categoryResult = $this->Category_model->getCategoryDetail($sqlInput);
		$data['categoryData'] = $categoryResult['data'];
		$sqlInput = array();
		if(!empty($data['categoryData'][0]['id']))
		{
			$sqlInput['catId'][] = $data['categoryData'][0]['id'];
			$sqlCatInput = array();
			$sqlCatInput['parentId'] = $data['categoryData'][0]['id'];
			$categoryParentResult = $this->Category_model->getAllCategories($sqlCatInput);
			$data['categoryParentData'] = commonHelperGetIdArray($categoryParentResult['data']);
			if(!empty($data['categoryParentData']))
			{
				$sqlInput['catId'] = array_merge($sqlInput['catId'], array_keys($data['categoryParentData']));
			}
		}
		if(!empty($sqlInput['catId']))
		{
			$this->load->model("Product_model");
			$productResult = $this->Product_model->getLatestProducts($sqlInput);
			$data['productData'] = $productResult['data'];
		}
		else
		{
			$data['productData'] = array();
		}
		$data['base_url'] = $this->config->item("base_url");
		$this->load->view('template/index_template', $data);		
	}
	
	public static function getCategoryList() 
	{
		$inputArray = $this->input->get();
		$this->load->model("Category_model");
		$data = array();
		$sqlInput = array();
		$sqlInput['limit'] = DEFAULT_LIMIT;
		$categoryResult = $this->Category_model->getAllCategories($sqlInput);
		$data['categoryData'] = $categoryResult['data'];
		$data['base_url'] = $this->config->item("base_url");
	}
	
	
	
}