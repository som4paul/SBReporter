<?php

class FilecontrollerM extends MY_Model {

    public function __construct() {
        $this->module = "Filecontroller";
        parent::__construct();
    }


     function get_user_info() {
        $query = $this->db->query("SELECT * FROM DESIGNATION");
        return $query->result_array();
    }

    public function insert_adv_report($posted_data){
    	$this->db->insert('REPORT',$posted_data) ; 
    		//echo $this->db->last_query() ; die; 
    	return true; 
    }

    
    

}