<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deo extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Deo';
    	$this->model = 'Deom';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
	}

	public function index() {
		$this->loadlist();
	}

    public function loadlist($type=""){
        $data = array();
        $data['title'] = 'DEOs';
        $action = "DEOs Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getDEOs(:rc_out); end;";
        $data['deo_data'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        if ($type == "ac" || $type == ""){
            $data['subview'] = $this->load->view('aclist', $data, true);
        }else{
            $data['subview'] = $this->load->view('divisionlist', $data, true);
        }        
        $this->load->view('layout_main', $data);
    }

    public function getACbyDeoID(){
        $id = filterData('deoid');
        $query = "BEGIN pc2019.PKG_ELECTION.getDEOwiseACwise1B2B(".$id.",:rc_out); end;";
        $allACs = $this->{$this->model}->getRefCursor($query);
        pre($allACs);
        $html = "";
        foreach ($allACs as $key => $value) {
            if($value['AC'] == 'Total'){
                $text = "style=color:red;font-weight:bold;";
            }else{
                $text = "";
            }
            $html .= "<tr align='center'>";
                $html .= "<td ".$text.">".$value['AC']."</td>";
                $html .= "<td ".$text.">".$value['1-Booth']."</td>";
                $html .= "<td ".$text.">".$value['2-Booths']."</td>";
                $html .= "<td ".$text.">".$value['3-Booths']."</td>";
                $html .= "<td ".$text.">".$value['4-Booths']."</td>";
                $html .= "<td ".$text.">".$value['5-Booths']."</td>";
                $html .= "<td ".$text.">".$value['6-Booths']."</td>";
                $html .= "<td ".$text.">".$value['7-Booths']."</td>";
                $html .= "<td ".$text.">".$value['8-Booths']."</td>";
                $html .= "<td ".$text.">".$value['9-Booths']."</td>";
                $html .= "<td ".$text.">".$value['10-Booths']."</td>";
                $html .= "<td ".$text.">".$value['11-Booths']."</td>";
                $html .= "<td ".$text.">".$value['14-Booths']."</td>";
                $html .= "<td ".$text.">".$value['TOTAL_BOOTHS']."</td>";
                $html .= "<td ".$text.">".$value['TOTAL_PREMISES']."</td>";
                $html .= "<td ".$text.">".$value['AUXBOOTHS']."</td>";
                $html .= "<td ".$text.">".$value['HYPERCRITICAL']."</td>";
                $html .= "<td ".$text.">".$value['CRITICAL']."</td>";
                $html .= "<td ".$text.">".$value['NORMAL']."</td>";
                $html .= "<td ".$text.">".$value['WPOL']."</td>";
            $html .= "</tr>";
        }
        echo $html;
    }

    public function getDIVbyDeoID(){
        $id = filterData('deoid');
        $query = "BEGIN pc2019.PKG_ELECTION.getDEOwiseDivisionwise1B2B(".$id.",:rc_out); end;";
        $allDIVs = $this->{$this->model}->getRefCursor($query);
        //pre($allDIVs);
        $html = "";
        
        foreach ($allDIVs as $key => $value) {
            $text = "style=color:red;font-weight:bold;";
            if($value['DIVNAME'] == "Grand Total"){
                $value['DIVNAME'] = "Total";
                $value['PSNAME'] = '';
            } elseif($value['DIVNAME'] == "Sub-Total"){
                $value['DIVNAME'] = $last_divname;
                $value['PSNAME'] = 'Total';
            } else {
                $text = "";
            }
            
            $last_divname = $value['DIVNAME'];

            $html .= "<tr align='center'>";
                $html .= "<td ".$text." class='tw5'>".$value['DIVNAME']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['PSNAME']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['1-Booth']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['2-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['3-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['4-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['5-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['6-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['7-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['8-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['9-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['10-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['11-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['14-Booths']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['TOTAL_BOOTHS']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['TOTAL_PREMISES']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['AUXBOOTHS']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['HYPERCRITICAL']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['CRITICAL']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['NORMAL']."</td>";
                $html .= "<td ".$text." class='tw5'>".$value['WPOL']."</td>";
            $html .= "</tr>";
        }
        echo $html;
    }
}