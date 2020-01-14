<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
    private $tblcustomers = CUSTOMERS_TABLE;
	/**
     * This function insert new customer and update if already exist.
    */
    public function save($data){
        if(array_key_exists('email', $data)){
            $customer = $this->_get(array("email"=>$data['email']));
        }
        if(!$customer){
            $this->db->insert($this->tblcustomers,$data);
            return $this->db->insert_id();
        }else{
            $this->update($customer['id'],$data);
        }
        return $customer['id'];
    }
	/**
     * This function update customer details.
    */
    private function update($id,$data){
        $data['updated_at'] = date('Y-m-d h:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->tblcustomers,$data);
    }
    /**
     * This function return customer record according to params
    */
    private function _get($where){
        return $this->db->where($where)
            ->get($this->tblcustomers)
            ->row_array();
    }
}