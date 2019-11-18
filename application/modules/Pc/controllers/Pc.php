<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Pc';
    	$this->model = 'Pcm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
	}

	public function index() {
		$this->loadlist();
	}

    public function loadlist($type=""){
        $data = array();
        $data['title'] = 'PCs';
        $action = "PCs Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPCs(:rc_out); end;";
        $data['pc_data'] = $this->{$this->model}->getRefCursor($query);
        // pre($data['pc_data'],1);
        $this->{$this->model}->logEntry($action);
        if ($type == "ac" || $type == ""){
            $data['subview'] = $this->load->view('acboothlist', $data, true);
        }else{
            $data['subview'] = $this->load->view('divboothlist', $data, true);
        }        
        $this->load->view('layout_main', $data);
    }

    public function getACbyPCID(){
        $id = filterData('pcid');
        // pre($id,1);
        $query = "BEGIN pc2019.PKG_ELECTION.getPCwiseACwise1B2B(".$id.",:rc_out); end;";
        $allACs = $this->{$this->model}->getRefCursor($query);
        // pre($allACs,1);
        $html = "";
        foreach ($allACs as $key => $value) {
            if($value['AC'] == 'Total'){
                // $value['AC'] = 'Total';
                $text = "style=color:red;font-weight:bold;";
            }else{
                $text = "";
            }
            $html .= "<tr align='center'>";
                $html .= "<td ".$text." class='tw5'>".$value['AC']."</td>";
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

    public function getDIVbyPCID(){
        $id = filterData('pcid');
        $query = "BEGIN pc2019.PKG_ELECTION.getPCwiseDivisionwise1B2B(".$id.",:rc_out); end;";
        $allDIVs = $this->{$this->model}->getRefCursor($query);
        //pre($allDIVs);
        $html = "";
        $i = 0;
        foreach ($allDIVs as $key => $value) {
            $i++;
            $text = "style=color:red;font-weight:bold;";
            if($value['DIVNAME'] == "Grand Total"){
                $value['DIVNAME'] = "Total";
                $value['PSNAME'] = '';
            } elseif($value['DIVNAME'] == "Sub-Total"){
                $value['PSNAME'] = 'Total';
                $i = 0;
            } else {
                $text = "";
            }
            
            $html .= "<tr align='center'>";
                $html .= "<td ".$text." class='tw5'>".(($i == 1)?$value['DIVNAME']:'')."</td>";
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