<?php

class ConverseM extends MY_Model {

    public function __construct() {
        $this->module = "Converse";
        parent::__construct();
    }


     function get_user_info() {
        $query = $this->db->query("SELECT * FROM DESIGNATION");
        return $query->result_array();
    }

    public function insert_conv($datafin){
    	$this->db->insert('CONVERSATION',$datafin) ; 
    		//echo $this->db->last_query() ; die; 
    	return true; 
    }
/*
     public function update_adv_report($posted_data){
        $this->db->where('RP_ID',$posted_data['RP_ID']);
        $this->db->update('REPORT',$posted_data) ; 
            //echo $this->db->last_query() ; die; 
        return true; 
    }*/
    

}