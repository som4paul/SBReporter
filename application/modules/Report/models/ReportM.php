<?php

class ReportM extends MY_Model {

    public function __construct() {
        $this->module = "Report";
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

     public function update_adv_report($posted_data){
        $this->db->where('RP_ID',$posted_data['RP_ID']);
        $this->db->update('REPORT',$posted_data) ; 
            //echo $this->db->last_query() ; die; 
        return true; 
    }

    public function insert_event($event_name){

         $query = $this->db->query("SELECT max(EVID) as mevid FROM EVENTS");
        $evid=  $query->result_array()[0];
        /*print_r($evid) ; die;*/
        $event['EVENT_NAME'] = $event_name ; 
        $event['EVID']     = $evid['MEVID']+1   ; 
        $this->db->insert('EVENTS',$event) ; 
        /*$insert_id = $this->db->insert_id();

        return  $insert_id;*/
            //echo $this->db->last_query() ; die; 
         return  $event['EVID'];

    }
    

}