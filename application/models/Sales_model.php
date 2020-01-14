<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Sales_model extends CI_Model {
    private $tblsales = SALES_TABLE;
    private $tblcustomers = CUSTOMERS_TABLE;
    private $tblproducts = PRODUCTS_TABLE;
    
    /**
     * This function return sales records according to params
    */
    public function get_sales($filter=[],$limit=20){
        $where = [];
        if(array_key_exists("customer_id",$filter) && $filter["customer_id"]>0)
            $where["cust.id"] = $filter["customer_id"];
        if(array_key_exists("product_id",$filter) && $filter["product_id"]>0)
            $where["prod.id"] = $filter["product_id"];
        
        $this->db->select("cust.name as customer_name, prod.price, prod.name as product_name, cust.email as customer_email, sl.created_at")
        ->from("$this->tblsales sl")
        ->join("$this->tblcustomers cust","cust.id = sl.customer_id","inner")
        ->join("$this->tblproducts prod","prod.id = sl.product_id","inner");

        if(!empty($where))
            $this->db->where($where);

        if(array_key_exists("product_price",$filter)  && !empty($filter["product_price"]))
            $this->db->like("prod.price", $filter["product_price"]);
        
        $this->db->limit($limit);
        $this->db->order_by('sl.id','DESC');

        return $this->db->get()->result_array();
    }

    /**
     * This function add/save sales data and  and update or add new customer/products if needed.
    */
    public function import_sales($sales){

    }
}