<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginm extends MY_Model {

	public function __construct() {
        $this->module = "login";
        parent::__construct();
    }

	// Login function
	public function checkLogin($id,$pass,$enc_pwd){
		if(md5($pass)==$enc_pwd){
			$this->db->select('*');
			$this->db->where('OF_ID',$id);
			$this->db->where('PLAINTXT',$pass);
			$this->db->where('PASSSWORD',$enc_pwd);
			$query = $this->db->get('LOGIN');
			if ($query){
				return $query->result_array();
			}
			else
				return false;
		}
		else {
		    return false ;
		}
	}

	public function getDetails($dept){
		if ($dept == 'PS') {
			$this->db->select('U.UNAME, U.PSCODE, A.USER_EMAIL, A.USER_PHONE_NO, P.PSNAME');
	        $this->db->where('ACCESSPOINT', $dept);
	        $this->db->where('U.PSCODE = A.USER_PSCODE');
	        $this->db->where('U.PSCODE = P.PSCODE');
	        $this->db->where('A.IS_OC',1);
	        $this->db->where('A.USER_STATUS',1);
	        $this->db->order_by('P.PSNAME', 'ASC');
	        $query = $this->db->get('USERSTAB U, APPUSERS A, PS P');
		}
        if ($query) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function chkBcrypt($usrnm){
		$this->db->select('USRPWD');
		$this->db->where('USRNAME', $usrnm);
		$query = $this->db->get('WEBUSERS');
		if ($query) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function updtPass($encpass, $pass){
		$this->db->set('PASSSWORD', $encpass);
		$this->db->set('PLAINTXT', $pass);
		$this->db->where('OF_ID', $this->session->userdata('OFID'));
		
		$query = $this->db->update('LOGIN');

		if ($query)
			return 1;
		else
			return 0;
	}

}