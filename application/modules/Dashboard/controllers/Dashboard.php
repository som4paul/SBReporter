<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    
    function __construct(){
        $this->module = 'Dashboard';
        $this->model = 'Dashboardm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
    }

    public function get_rep_dets(){

        $query = "BEGIN PKG_OFFICERS.getreport_counts(:rc_out); end;";
        $repcount = $this->{$this->model}->getRefCursor($query);
        echo json_encode($repcount[0]);

    }

    public function index() {
        $data = array();
        $data['title'] = 'Dashboard';
        $action = "Dashboard Page Opened.";
        
        $this->{$this->model}->logEntry($action);
	    $data['subview'] = $this->load->view('dashboard', $data, true);
	    $this->load->view('layout_main', $data);
    }

    public function getCircularByID(){
        $id = base64_decode(filterData('id'));
        $query = "BEGIN PKG_ELECTION.getCircularByID(".$id.",:rc_out); end;";
        $allCirculars = $this->{$this->model}->getRefCursor($query);
        echo json_encode($allCirculars);
    }

    public function deo(){
        $data = array();
        $data['title'] = 'DEOs';
        $action = "District Election Officer Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getDEOs(:rc_out); end;";
        $deo_data = $this->{$this->model}->getRefCursor($query);
        foreach($deo_data as $deo){
            $dcode = $deo['DEOCODE'];
            $query = "BEGIN pc2019.PKG_ELECTION.getACsByDEO($dcode,:rc_out); end;";
            $ac[$dcode]['DEO'] = $deo;
            $ac[$dcode]['ACS'] = $this->{$this->model}->getRefCursor($query);
        }
        $data['allDetails'] = $ac;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('deolist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function ACDetails($var,$method=''){
        $data = array();
        $data['title'] = 'ACs Details';
        $det = explode("|", myDecode($var));
        $data['acdet'] = $det;
        $acno = $det[1];
        $div_ps_code = $det[6];
        if($method == 'division'){
            $psquery = "BEGIN pc2019.PKG_ELECTION.getDivwiseACwisePSCoverage($acno,'$div_ps_code',:rc_out); end;";
            $data['ps_coverage'] = $this->{$this->model}->getRefCursor($psquery);
            $premisesqry = "BEGIN pc2019.PKG_ELECTION.getDivwiseACwisePremises($acno,'$div_ps_code',:rc_out); end;";
            $data['premises'] = $this->{$this->model}->getRefCursor($premisesqry);
        }elseif($method == 'ps'){
            $premisesqry = "BEGIN pc2019.PKG_ELECTION.getPSwiseACwisePremises($acno,'$div_ps_code',:rc_out); end;";
            $data['premises'] = $this->{$this->model}->getRefCursor($premisesqry);
            $data['method'] = $method;
        } else{
            $psquery = "BEGIN pc2019.PKG_ELECTION.getACwisePSCoverage($acno,:rc_out); end;";
            $data['ps_coverage'] = $this->{$this->model}->getRefCursor($psquery);
            $premisesqry = "BEGIN pc2019.PKG_ELECTION.getACwisePremises($acno,:rc_out); end;";
            $data['premises'] = $this->{$this->model}->getRefCursor($premisesqry);
        }
        $action = "Assembly Constituency Details Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('AC_details', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function pc(){
        $data = array();
        $data['title'] = 'PCs';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPCs(:rc_out); end;";
        $pc_data = $this->{$this->model}->getRefCursor($query);
        foreach($pc_data as $pc){
            $pcode = $pc['PCNO'];
            $query = "BEGIN pc2019.PKG_ELECTION.getACsByPCs($pcode,:rc_out); end;";
            $pcData[$pcode]['PC'] = $pc;
            $pcData[$pcode]['ACS'] = $this->{$this->model}->getRefCursor($query);
        }
        $data['allDetails'] = $pcData;
        $action = "Parliamentary Constituencies Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('pclist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function ac(){
        $data = array();
        $data['title'] = 'ACs';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllACs(:rc_out); end;";
        $data['ac_data'] = $this->{$this->model}->getRefCursor($query);
        $action = "Assembly Constituencies Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('aclist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function division(){
        $data = array();
        $data['title'] = 'Divisions';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllDivisions(:rc_out); end;";
        $div_data = $this->{$this->model}->getRefCursor($query);
        foreach($div_data as $div){
            $divcode = $div['DIV'];
            $query = "BEGIN pc2019.PKG_ELECTION.getACsByDivn('$divcode',:rc_out); end;";
            $divData[$divcode]['DIV'] = $div;
            $divData[$divcode]['ACS']= $this->{$this->model}->getRefCursor($query);
        }
        $data['allDetails'] = $divData;
        $action = "Divisions Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('divisionlist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function ps(){
        $data = array();
        $data['title'] = 'Police Stations';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPSs(:rc_out); end;";
        $ps_data = $this->{$this->model}->getRefCursor($query);
        foreach($ps_data as $ps){
            $pscode = $ps['PS'];
            $query = "BEGIN pc2019.PKG_ELECTION.getACsByPS('$pscode',:rc_out); end;";
            $psData[$pscode]['PS'] = $ps;
            $psData[$pscode]['ACS']= $this->{$this->model}->getRefCursor($query);
        }
        $data['allDetails'] = $psData;
        $action = "Police Stations Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('pslist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function add_book(){
        $data = array();
        $data['title'] = 'Address Book';
        $data['addBook'] = $this->{$this->model}->getdbData('ADDRESS_BOOK');
        $action = "Address Book Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('addressbook', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function premises(){
        $data = array();
        $data['title'] = 'Premises';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllDivisions(:rc_out); end;";
        $data['div_data'] = $this->{$this->model}->getRefCursor($query);
        $action = "Address Book Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('premiseslist', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function getPsByDiv(){
        $dCode = filterData('divcode');
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPSsByDiv('$dCode',:rc_out); end;";
        $psDet = $this->{$this->model}->getRefCursor($query);
        echo json_encode($psDet);
    }

    public function getResByPs(){
        $param = explode("|",filterData('param'));
        $flag = filterData('flag');
        $pscode = $param[0];
        $divcode = $param[1];
        if($flag == 1){
            $query = "BEGIN pc2019.PKG_ELECTION.getDivwisePSwisePremises('$divcode','$pscode','Y',:rc_out); end;";    
        }else{
            $query = "BEGIN pc2019.PKG_ELECTION.getDivwisePSwisePremises('$divcode','$pscode',null,:rc_out); end;";    
        }
        $premDet = $this->{$this->model}->getRefCursor($query);
        $html ="";
        foreach ($premDet as $key => $value) {
            $key = $key+1;
            $html.="<tr>";
            $html.="<td class='text-center tw5'>".$key."</td>";
            $html.="<td>".$value['PPNAME']."<br>".$value['ADDR']."<br>".$value['TELNO']."</td>";
            $html.="<td class='text-center'>".$value['AC']."</td>";
            $html.="<td class='text-center'>".$value['PC']."</td>";
            $html.="<td>".$value['BOOTHSARE']."</td>";
            $html.="<td class='text-center'>".$value['TOTBOOTH']."</td>";
            $html.="<td class='text-center'>";
            if($value['SENSITIVITY'] == 'Hypercritical'){
                $html.= '<img title= "Hypercritical" src="'.base_url().'assets/images/hc.png">';
                } else if($value['SENSITIVITY'] == 'Critical'){
                    $html.= '<img title="Critical" src="'.base_url().'assets/images/c.png">';
                }
            $html.="</td>";
            $html.="<td class='text-center tw5'>";
                if($value['WPOL'] == 'Y'){
                    $html.= '<img title="Women Polling Station" src="'.base_url().'assets/images/wp.png">';
                }
            $html.="</td>";
            $html.="</tr>";
        }
        echo $html;
    }
    
    public function getBMsgByID(){
        $msgid = myDecode(filterData('msgid'));
        $data = array();
        $data['title'] = 'Broadcast Message Details';
        $action = "Broadcast Message Details Page Opened.";
        $query = "BEGIN PKG_ELECTION.getBroadcastMessageByID(".$msgid.",:rc_out); end;";
        $data['msg_det'] = $this->{$this->model}->getRefCursor($query);
        echo json_encode($data['msg_det']);
    }

    public function sectors(){
        $data = array();
        $data['title'] = 'Sectors';
        $action = "Sectors Page Opened.";
        $query = "BEGIN pc2019.PKG_ELECTION.getAllACs(:rc_out); end;";
        $data['ac_data'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('sectors', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function getACwiseSectors(){
        $acno = filterData('acno');
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseSectors('$acno',:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        // pre($res,1);
        $html="";
        foreach($res as $value){
            $html.="<tr>";
            $html.="<td>".$value['SNO']."</td>";
            $html.="<td>".$value['AC']."</td>";
            $html.="<td>".$value['SECTORNO']."</td>";
            $html.="<td>".$value['NAME||CHR(13)||\'PH:\'||TEL']."</td>";
            $html.="<td>".$value['CVSECTORIC||CHR(13)||\'M:\'||CVICMOBILE']."</td>";
            $html.="<td>".$value['PREMISES']."</td>";
            $html.="<td>".$value['BOOTHSARE']."</td>";
            $html.="<td>".$value['TOTBOOTH']."</td>";
            $html.="<td>".$value['PS']."</td>";
            $html.="<td class='text-center'>";
            if($value['SENSITIVITY'] == 'HC'){
                $html.= '<img title= "Hypercritical" src="'.base_url().'assets/images/hc.png">';
                } else if($value['SENSITIVITY'] == 'C'){
                    $html.= '<img title="Critical" src="'.base_url().'assets/images/c.png">';
                }
            $html.="</td>";
            $html.="</tr>";
        }
        echo $html;
    }

    public function getSearchResult(){
        $srchString = filterData('srchString');
        $query = "BEGIN pc2019.PKG_ELECTION.getResult('$srchString',:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);
        $data['str'] = $srchString;
        $action = "Search with ".$srchString." Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['title'] = 'Search';
        $data['subview'] = $this->load->view('searchResult',$data, true);
        $this->load->view('layout_main', $data);
    }

    public function showDetails($id){
        $data = array();
        $param = explode("|",myDecode($id));
        $rc = array('PREMDTLS','PSDTLS','PSDUTY','SUPERVISION','DIV_SUPVN','PS_SUPVN','SECTORS','QRT','RTMOBILE','HRFS','MCPATROL');
        $str = '';
        foreach ($rc as $key => $value) {
            $str .= ":".$value.",";
        }
        $str = substr($str, 0, -1);
        $query = "BEGIN pc2019.PKG_ELECTION.getTotalResult($param[0],".$str."); end;";
        $data['res'] = $this->{$this->model}->getRefCursorMultiple($query,$rc);
        $data['ppno'] = $param[0];
        $data['sens'] = $param[1];
        $data['wp'] = $param[2];
        $data['title'] = "Search Results";
        $data['subview'] = $this->load->view('pollingPremises', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function getLatLongByPPNO(){
        $PPNO = filterData('ppno');
        $query = "BEGIN pc2019.PKG_ELECTION.getLatLong('$PPNO',:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        echo json_encode($res);
    }

    public function advSearch(){
        $str = filterData('srchString');
        $rstr = str_replace(array('\'','"',',',';','','(',')','/','&','-','@'), ' ', $str);
        $a = explode(" ", $rstr);
        $b = "";
        $count = count($a);
        foreach ($a as $key => $value) {
            if($value != " "){
                if($key < $count-1){
                    $b .= $value . " or ";    
                }else{
                    $b .= $value;
                }
            }
        }
        $query = "BEGIN pc2019.PKG_ELECTION.getAdvancedResult('$b',:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);
        $data['str'] = $str;
        $data['title'] = 'Search';
        $data['subview'] = $this->load->view('searchResult', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function viewMap(){
        $data = array();
        $data['title'] = 'All Premises';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllLatLong(:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllPCs(:rc_out); end;";
        $data['pc_data'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllACs(:rc_out); end;";
        $data['ac_data'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllDivisions(:rc_out); end;";
        $data['div_data'] = $this->{$this->model}->getRefCursor($query);
        
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPSs(:rc_out); end;";
        $data['ps_data'] = $this->{$this->model}->getRefCursor($query);
        
        $data['subview'] = $this->load->view('mapPremises', $data, true);
        $this->load->view('map_layout', $data);
    }

    public function showMap(){
        $data = array();
        $data['title'] = 'All Premises';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllLatLong(:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllPCs(:rc_out); end;";
        $data['pc_data'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllACs(:rc_out); end;";
        $data['ac_data'] = $this->{$this->model}->getRefCursor($query);

        $query = "BEGIN pc2019.PKG_ELECTION.getAllDivisions(:rc_out); end;";
        $data['div_data'] = $this->{$this->model}->getRefCursor($query);
        
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPSs(:rc_out); end;";
        $data['ps_data'] = $this->{$this->model}->getRefCursor($query);
        
        $data['subview'] = $this->load->view('mapBoundaries', $data, true);
        $this->load->view('map_layout', $data);
    }

    public function showLocationByFilter(){

        $flag = $this->input->post('flag',true);
        $val = $this->input->post('val',true);
        $hamlet = "";
        $input = $this->input->post();
        if(isset($input["hamlets"])){
            $hamlet = "hamlets";
        }
        $myval = '';

        if ($flag != 'wps' && $flag != 'reset' && $flag != 'sec') {
            foreach ($val as $k => $v) {
                $myval .= $v.',';
            }
            $myval = substr($myval,0,-1);
        } elseif ($flag == 'sec') {
            $myval = $val;
        }
        $run = true;
        $res = array();

        if($flag == '' && $myval == ''){
            $query = "BEGIN pc2019.PKG_ELECTION.getAllLatLong(:rc_out); end;";
        } else if($flag == 'div'){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongByDivPS('$myval','','',:rc_out); end;";
        } else if($flag == 'ps' && $hamlet == ''){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongByDivPS('','$myval','',:rc_out); end;";
        } else if($flag == 'pc'){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongByPCAC('$myval','','',:rc_out); end;";
        } else if($flag == 'ac'){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongByPCAC('','$myval','',:rc_out); end;";
        } else if($flag == 'sec'){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongBySec('$myval',:rc_out); end;";
        } else if($flag == 'wps'){
            $query = "BEGIN pc2019.PKG_ELECTION.getLatLongByWPS(:rc_out); end;";
        } else if($flag == 'reset'){
            $query = "BEGIN pc2019.PKG_ELECTION.getAllLatLong(:rc_out); end;";
        }else if($hamlet != ""){//ekane call korbe
            $query = "BEGIN pc2019.PKG_ELECTION.getPSwiseHamlets('$myval',:rc_out); end;";
        } else {
            $run = false;
        }
        if($run){
            $res = $this->{$this->model}->getRefCursor($query);
        }
        echo json_encode($res);
    }

    public function getSensitiveCount(){
        $query = "BEGIN pc2019.PKG_ELECTION.getSensitiveCount(:rc_out); end;";
        $res['sensitivity'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseAllPremises(:rc_out); end;";
        $res['acPrem'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_ELECTION.getDivWiseHamlets(:rc_out); end;";
        $res['hamlets'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseQRTs(:rc_out); end;";
        $res['qrts'] = $this->{$this->model}->getRefCursor($query);
        // pre($res['qrts'],1);
        echo json_encode($res);
    }

    public function getSensitiveData($pos){
        $data = array();
        $data['title'] = 'Chart Details';
        $query = "BEGIN pc2019.PKG_ELECTION.getDivWisePSWiseSensitiveCount($pos,:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        foreach ($res as $key => $value) {
            $det[$value['DIVNAME']][$value['PSNAME']][] = $value;
        }

        foreach ($det as $key => $value) {
            $count = 0;
            foreach ($value as $k => $val) {
                $s_count = $val[0]['NO_OF_PREMISES'];
                $count += $s_count;
            }
            $det[$key]['COUNT'] = $count;
        }
        $data['div'] = $det;
        if($pos == 0){
            $data["pos"] = "Critical";
        }
        if($pos == 1){
            $data["pos"] = "Hypercritical";
        }
        if($pos == 2){
            $data["pos"] = "Normal";
        }
        $data['subview'] = $this->load->view('chartDetails', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function aCwisePremisesDetails(){
        $data= array();
        $data['title'] = 'Chart Details';
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseAllPremises(:rc_out); end;";
        $data['acPrem'] = $this->{$this->model}->getRefCursor($query);
        $data['subview'] = $this->load->view('aCwisePremisesDetails', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function getDivWisePSWiseHamlets($pos){
        $data= array();
        $data['title'] = 'Chart Details';
        $query = "BEGIN pc2019.PKG_ELECTION.getDivWiseHamlets(:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        $divcode = $res[$pos]['DIV'];
        $query = "BEGIN pc2019.PKG_ELECTION.getDivWisePSWiseHamlets('$divcode',:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);
        $data['subview'] = $this->load->view('getDivWisePSWiseHamlets', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function getACwiseQRTs($pos){
        $data= array();
        $data['title'] = 'Chart Details';
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseQRTs(:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        $acno = $res[$pos]['AC'];
        $query = "BEGIN pc2019.PKG_ELECTION.getACwiseSectorwiseQRTs('$acno',:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);
        //pre($data['res'],1);
        $data['subview'] = $this->load->view('getACwiseQRTs', $data, true);
        $this->load->view('layout_main', $data);
    }

}

