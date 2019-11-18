<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ps extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Ps';
    	$this->model = 'Psm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
	}

	public function index() {
		$this->loadlist();
	}

    public function loadlist($type=""){
        $data = array();
        $html = "";
        if ($type == "ac" || $type == ""){

            $data['title'] = 'PS wise AC Coverage';
            $query = "BEGIN pc2019.PKG_ELECTION.getPSwiseACCoverage(:rc_out); end;";
            $data['psac_data'] = $this->{$this->model}->getRefCursor($query);
            // pre($data['psac_data'],1);
            foreach ($data['psac_data'] as $key => $value) {
                $html .= "<tr align='left'>";
                    $html .= "<td class='tw5'>".$value['PSNAME']."</td>";
                    $html .= "<td class='tw5'>".$value['AC']."</td>";
                    $html .= "<td class='tw5'>".$value['PC']."</td>";
                    $html .= "<td class='tw5'>".$value['NO_OF_PREMISES']."</td>";
                    $html .= "<td class='tw5'>".$value['NO_OF_BOOTHS']."</td>";
                $html .= "</tr>";
            }
            // pre($html,1);
            $data['html'] = $html;
            $data['subview'] = $this->load->view('accovlist', $data, true);
            $action = "PS wise ACs Page Opened.";
        }else{
            $action = "PS wise Premises Page Opened.";
            $query = "BEGIN pc2019.PKG_ELECTION.getPSwisePremises(:rc_out); end;";
            $data['pspre_data'] = $this->{$this->model}->getRefCursor($query);
            // pre($data['pspre_data'],1);
            foreach ($data['pspre_data'] as $key => $value) {
                $html .= "<tr align='left'>";
                    $html .= "<td class='tw5'>".$value['PSNAME']."</td>";
                    $html .= "<td class='tw5'>".$value['B1']."</td>";
                    $html .= "<td class='tw5'>".$value['B2']."</td>";
                    $html .= "<td class='tw5'>".$value['B3']."</td>";
                    $html .= "<td class='tw5'>".$value['B4']."</td>";
                    $html .= "<td class='tw5'>".$value['B5']."</td>";
                    $html .= "<td class='tw5'>".$value['B6']."</td>";
                    $html .= "<td class='tw5'>".$value['B7']."</td>";
                    $html .= "<td class='tw5'>".$value['B8']."</td>";
                    $html .= "<td class='tw5'>".$value['B9']."</td>";
                    $html .= "<td class='tw5'>".$value['B10']."</td>";
                    $html .= "<td class='tw5'>".$value['B14']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_PREMISES']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_BOOTHS']."</td>";
                $html .= "</tr>";
            }
            $data['html'] = $html;
            $data['subview'] = $this->load->view('psprelist', $data, true);
            $action = "PS wise Premises Page Opened.";
        }
        $this->{$this->model}->logEntry($action);        
        $this->load->view('layout_main', $data);
    }
}