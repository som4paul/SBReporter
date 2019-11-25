<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mccdashboard extends MY_Controller {
    
    function __construct(){
        $this->module = 'mccmodule';
        $this->model = 'Mccdashboardm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
    }
    public function index(){
    	$data = array();
        $query = "BEGIN pc2019.PKG_MCC.getMCCMDBFigures(:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        $forowarded = $fwdpending = $reprcv = $disposed = $registered = 0;
        foreach ($res as $key => $value) {
            if($value['STATUS'] == "Fwd. Pending"){
                $fwdpending = intval($value['CNT']);
            }
            if($value['STATUS'] == "Forwarded"){
                $forowarded = intval($value['CNT']);
            }
            if($value['STATUS'] == "Rpt. Received"){
                $reprcv = intval($value['CNT']);
            }
            if($value['STATUS'] == "Disposed"){
                $disposed = intval($value['CNT']);
            }
            if($value['STATUS'] == "Registered"){
                $registered = intval($value['CNT']);
            }
        }
        $data['report_received'] = ($reprcv + $disposed);
        $data['disposed'] = $disposed;
        $data['registered'] = $registered;
        $data['forwarded'] = ($registered - $fwdpending);
        $data['pending'] = ($registered - $disposed);
        $data['forwarded_pending'] = $fwdpending;
        $query = "BEGIN pc2019.PKG_MCC.getFiguresByNature(:rc_out); end;";
        $data['compnature'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getFiguresByMode(:rc_out); end;";
        $data['compnaturemode'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getFiguresBySource(:rc_out); end;";
        $data['complaintsource'] = $this->{$this->model}->getRefCursor($query);
        //pre($data,1);
        $data['title'] = 'Dashboard';
        $action = "MCC Dashboard Page Opened.";
        $this->{$this->model}->logEntry($action);
    	$data['subview'] = $this->load->view('mccdashboard', $data, true);
	    $this->load->view('layout_main', $data);
    }
    public function details($details = "",$type){
        $details = myDecode($details);
        $data = array();
        if($type == "nature"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsByNature('$details',:rc_out); end;";

        } else if($type == "mode"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsByMode('$details',:rc_out); end;";

        } else if($type == "source"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsBySource('$details',:rc_out); end;";

        }else if($type == "registered"){
        $query = "BEGIN pc2019.PKG_MCC.getAllComplaints(null,0,null,:rc_out); end;";

        }else if($type == "forwarded"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsForwarded(:rc_out); end;";

        }else if($type == "fwdpending"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsFwdPending(:rc_out); end;";

        }else if($type == "rptreceived"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsRptReceived(:rc_out); end;";
        
        }else if($type == "disposed"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsDisposed(:rc_out); end;";
        
        }else if($type == "totalpending"){
        $query = "BEGIN pc2019.PKG_MCC.getComplaintsPending(:rc_out); end;";
        
        }
        $data['details'] = $this->{$this->model}->getRefCursor($query);
        $data['type'] = $details;
        //pre($data,1);
        $data['title'] = 'MCC Details';
        $action = "MCC details Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('list', $data, true);
        $this->load->view('layout_main', $data);
    }
    public function displaylocation(){
        $data = array();
        $data['title'] = 'Live Location';
        $data['subview'] = $this->load->view('displaylocation', $data, true);
        $this->load->view('layout_main', $data);
    }
}

