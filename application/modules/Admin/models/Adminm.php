<?php

class Adminm extends MY_Model {

    public function __construct() {
        $this->module = "Admin";
        parent::__construct();
    }

    public function runprocedure(){
    	$query = $this->db->query("CALL PC2019.RUN_ALL()");
        if($query)
            return 1;
        else
            return 0;
    }
}