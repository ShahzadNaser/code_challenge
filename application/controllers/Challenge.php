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
		echo json_encode($response);
	}
	/**
     * This function to return filterd products/customers
    */
	public function get_data(){
		$result = array(array("id"=>1,"name"=>"aaaaaa"),array("id"=>2,"name"=>"bbbbbbbbbb"),array("id"=>3,"name"=>"cccccccccccc"));
		echo json_encode($result);
	}
}
