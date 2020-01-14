<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Sales_model','sm');
	}
	/**
     * This function to load default pages for the code challenge with sales table with filters/
    */
	public function index()
	{
		$data['title'] = 'Sales rexx Systems Coding Challege';
		$data['sales'] = $this->sm->get_sales();
		$data['content']  = $this->load->view('pages/sales',$data,true);
		$this->load->view('index',$data);
	}
	/**
     * This function loads import page.
    */
	public function import(){
		$data['title'] = 'import-Sales rexx  Systems Coding Challege';
		$data['content']  = $this->load->view('pages/import',$data,true);
		$this->load->view('index',$data);
	}
	/**
     * This function get post data and get sales by this data and return result in json form.
    */
	public function apply_filters(){
		$request = $this->input->post();
		$data['sales'] = $this->sm->get_sales($request,1000);
		echo $this->load->view('templates/table',$data,true);
	}
	/**
     * This function get post data and get sales by this data and return result in json form.
    */
	public function import_sales(){
		$response = array(
			'error'=> true,
			'msg'=> 'Please select a valid json file.'
		);
		if($_FILES['file']['type'] == 'application/json' && $_FILES['file']['tmp_name']){
			$json_content = file_get_contents($_FILES['file']['tmp_name']);
			$json_arr = json_decode($json_content,true);
			if(count($json_arr)>0){
				$res = $this->sm->import_sales($json_arr);
				if($res===true){
					$response["error"] = false;
					$response["msg"] = 'Successfully imports all sales.';
				}else{
					$response["msg"] = $res;
				}
			}
		}
		echo json_encode($response);
	}
	/**
     * This function to return filterd products/customers
    */
	public function get_data(){
		$result = array();
		$keyword = $this->input->post('query');
		$entity = $this->input->post('name');
		if($entity == PRODUCT){
			$this->load->model('Product_model','pm');
			$result = $this->pm->search('id,name','name',$keyword);
		}else if($entity == CUSTOMER){
			$this->load->model('Customer_model','cm');
			$result = $this->cm->search('id,name','name',$keyword);
		}
		echo json_encode($result);
	}
}
