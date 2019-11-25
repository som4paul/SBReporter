<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premises extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Premises';
    	$this->model = 'Premisesm';
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
            $query = "BEGIN pc2019.PKG_ELECTION.getACwise1B2B(:rc_out); end;";
            $data['preac_data'] = $this->{$this->model}->getRefCursor($query);
            // pre($data['preac_data'],1);
            foreach ($data['preac_data'] as $key => $value) {
                $html .= "<tr align='center'>";
                    $html .= "<td class='tw5'>".$value['AC']."</td>";
                    $html .= "<td class='tw5'>".$value['1-Booth']."</td>";
                    $html .= "<td class='tw5'>".$value['2-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['3-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['4-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['5-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['6-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['7-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['8-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['9-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['10-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['14-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_BOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_PREMISES']."</td>";
                    $html .= "<td class='tw5'>".$value['AUXBOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['HYPERCRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['CRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['NORMAL']."</td>";
                    $html .= "<td class='tw5'>".$value['WPOL']."</td>";
                $html .= "</tr>";
            }
            // pre($html,1);
            $data['html'] = $html;
            $data['subview'] = $this->load->view('acwiselist', $data, true);
            $action = "PS wise ACs Page Opened.";
        }else if($type == "ps"){
            $action = "PS wise Premises Page Opened.";
            $query = "BEGIN pc2019.PKG_ELECTION.getPSwise1B2B(:rc_out); end;";
            $data['preps_data'] = $this->{$this->model}->getRefCursor($query);
            // pre($data['preps_data'],1);
            foreach ($data['preps_data'] as $key => $value) {
                $html .= "<tr align='left'>";
                    $html .= "<td class='tw5'>".$value['PSNAME']."</td>";
                    $html .= "<td class='tw5'>".$value['1-Booth']."</td>";
                    $html .= "<td class='tw5'>".$value['2-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['3-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['4-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['5-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['6-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['7-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['8-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['9-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['10-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['14-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_PREMISES']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_BOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['AUXBOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['HYPERCRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['CRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['NORMAL']."</td>";
                    $html .= "<td class='tw5'>".$value['WPOL']."</td>";
                $html .= "</tr>";
            }
            $data['html'] = $html;
            $data['subview'] = $this->load->view('pswiselist', $data, true);
            $action = "PS wise Premises Page Opened.";
        }else{
            $action = "PS wise Premises Page Opened.";
            $query = "BEGIN pc2019.PKG_ELECTION.getPSwiseFemalePremises(:rc_out); end;";
            $data['prefem_data'] = $this->{$this->model}->getRefCursor($query);
            // pre($data['prefem_data'],1);
            foreach ($data['prefem_data'] as $key => $value) {
                $html .= "<tr align='left'>";
                    $html .= "<td class='tw5'>".$value['PSNAME']."</td>";
                    $html .= "<td class='tw5'>".$value['1-Booth']."</td>";
                    $html .= "<td class='tw5'>".$value['2-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['3-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['4-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['5-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['6-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['7-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['8-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['9-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['10-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['14-Booths']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_BOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['TOTAL_PREMISES']."</td>";
                    $html .= "<td class='tw5'>".$value['AUXBOOTHS']."</td>";
                    $html .= "<td class='tw5'>".$value['HYPERCRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['CRITICAL']."</td>";
                    $html .= "<td class='tw5'>".$value['NORMAL']."</td>";
                $html .= "</tr>";
            }
            $data['html'] = $html;
            $data['subview'] = $this->load->view('female', $data, true);
            $action = "PS wise Premises Page Opened.";
        }
        $this->{$this->model}->logEntry($action);        
        $this->load->view('layout_main', $data);
    }
}