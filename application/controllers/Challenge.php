<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
	}
	/**
     * This function to load default pages for the code challenge with sales table with filters/
    */
	public function index()
	{
		$data['title'] = 'Sales rexx Systems Coding Challege';
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

}
