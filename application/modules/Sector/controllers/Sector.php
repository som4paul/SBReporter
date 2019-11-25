<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sector extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Sector';
    	$this->model = 'Sectorm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
	}

	public function index() {
		$data = array();
        $data['title'] = 'Sectors';
        $action = "Sectors Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseSectorCoverage(:rc_out); end;";
        $data['acData'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('acWiseCoverage', $data, true);
        $this->load->view('layout_main', $data);
	}

    public function summary() {
        $data = array();
        $data['title'] = 'Summary';
        $action = "Summary Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getSectorSummary(:rc_out); end;";
        $data['summData'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('summary', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function pcAcWise() {
        $data = array();
        $data['title'] = 'Summary';
        $action = "Summary Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getPCACWiseSectors(:rc_out); end;";
        $data['pcAcData'] = $this->{$this->model}->getRefCursor($query);
        // pre($data['pcAcData'],1);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('pcAcWiseSector', $data, true);
        $this->load->view('layout_main', $data);
    }    
}