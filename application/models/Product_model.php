<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    private $tblproducts = PRODUCTS_TABLE;
    
	/**
     * This function insert new product and update if already exist.
    */
    public function save($data){
        if(array_key_exists('id', $data)){
            $product = $this->_get(array("id"=>$data['id']));
        }
        if(!$product){
            $this->db->insert($this->tblproducts,$data);
            return $this->db->insert_id();
        }else{
            unset($data['id']);
            $this->update($product['id'],$data);
        }
        return $product['id'];
    }
	/**
     * This function update product details.
    */
    private function update($id,$data){
        $data['updated_at'] = date('Y-m-d h:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->tblproducts,$data);
    }
    /**
     * This function return product record according to params
    */
    private function _get($where){
        return $this->db->where($where)
            ->get($this->tblproducts)
            ->row_array();
    }
    /**
     * This function search product by keywords and return data
    */
    public function search($select="*",$column,$keyword,$limit=20){
        return $this->db->select($select)
            ->from($this->tblproducts)
            ->like($column,$keyword)
            ->limit($limit)
            ->get()
            ->result_array();
    }
}