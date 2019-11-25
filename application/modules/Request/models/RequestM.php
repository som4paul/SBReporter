<?php

class RequestM extends MY_Model {

    public function __construct() {
        $this->module = "Request";
        parent::__construct();
    }


     function get_user_info() {
        $query = $this->db->query("SELECT * FROM DESIGNATION");
        return $query->result_array();
    }

    public function insert_sup_request($posted_data){
    	$this->db->insert('REQUEST',$posted_data) ; 
        //echo $this->db->last_query() ; die; 
    	return true; 
    }

    public function update_sup_request($posted_data) {

        $this->db->where('REQID',$posted_data['REQID']) ;

        
        $this->db->update('REQUEST',$posted_data) ; 

        return true ;
    }

    
    

}