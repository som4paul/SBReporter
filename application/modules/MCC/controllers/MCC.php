<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCC extends MY_Controller {
    
    function __construct(){
        $this->module = 'MCC';
        $this->model = 'MCCm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
    }

    public function register(){
        $data = array();
        $data['title'] = 'Register Complaints List';
        $action = "Register Complaints List Page Opened.";
        $query = "BEGIN pc2019.PKG_MCC.getAllComplaints(null,0,null,:rc_out); end;";
        $data['allComp'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('regComplaintsList', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function addNew(){
        $data = array();
        $data['title'] = 'Register New Complaints';
        $action = "Register Complaints List Page Opened.";
        $query = "BEGIN pc2019.PKG_MCC.getAllParties(:rc_out); end;";
        $data['allparty'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllModes(:rc_out); end;";
        $data['allmodes'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllNatures(:rc_out); end;";
        $data['allnature'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllSources(:rc_out); end;";
        $allsource = $this->{$this->model}->getRefCursor($query);
        $html = "";
        foreach ($allsource as $key => $value) {
            $id = strtolower(str_replace(array(' ',',','.','/','(',')','&'), "", $value['SOURCE_NAME']));
            $html .= "<tr class='data'>";
            $html .= "<td>";
            $html .= $value['SOURCE_NAME']." <i class='fa fa-check-circle text-success tick' style='text-align:right;font-size:18px;' hidden='hidden' id='".$id."'></i>";
            $html .= "</td>";
            $html .= "</tr>";
        }
        $data['html'] = $html;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('regComplaints', $data, true);
        $this->load->view('layout_main', $data);   
    }

    public function setComplaintRecord($method){
        $COMPLAINT_ID = filterData('COMPLAINT_ID');
        $RECEIVED_ON = toDbDateTime(filterData('RECEIVED_ON'));
        $COMPLAINT_DATE = toDbDate(filterData('COMPLAINT_DATE'));
        $RECEIVED_FROM = filterData('RECEIVED_FROM');
        $COMPALAINANT_NAME = filterData('COMPALAINANT_NAME');
        $POLITICAL_AFFILIATION = filterData('POLITICAL_AFFILIATION');
        $MEMO_NO = filterData('MEMO_NO');
        $MEMO_DT = toDbDate(filterData('MEMO_DT'));
        $COMPLAINT_AGAINST = filterData('COMPLAINT_AGAINST');
        $COMPLAINT_NATURE = filterData('COMPLAINT_NATURE');
        $COMPL_MODE = filterData('COMPL_MODE');
        $PARTY = filterData('PARTY');
        $BRIEF_FACT = filterData('BRIEF_FACT');
        $REPLY_TOBE_SENT_BY = toDbDateTime(filterData('REPLY_TOBE_SENT_BY'));
        $REPLY_TOBE_PREP_BY = toDbDateTime(filterData('REPLY_TOBE_PREP_BY'));
        $SEND_REPORT = filterData('SEND_REPORT');
        $REPLY_MEMONO = filterData('REPLY_MEMONO');
        $REPLY_MEMODT = toDbDate(filterData('REPLY_MEMODT'));
        $STATUS = filterData('STATUS');
        $REMARKS = filterData('REMARKS');
        if($SEND_REPORT == 1 || $SEND_REPORT == 'on'){
            $SEND_REPORT = 'Y';
        }else{
            $SEND_REPORT = 'N';
        }

        if($method == 'editComplaint'){
            $query = "BEGIN pc2019.PKG_MCC.updateComplaint($COMPLAINT_ID,'$COMPLAINT_DATE','$RECEIVED_ON','$RECEIVED_FROM','$MEMO_NO','$MEMO_DT','$COMPALAINANT_NAME','$POLITICAL_AFFILIATION','$COMPLAINT_AGAINST','$PARTY','$BRIEF_FACT','$COMPLAINT_NATURE','$REPLY_MEMONO','$REPLY_MEMODT','$STATUS',null,'$COMPL_MODE','$SEND_REPORT','$REPLY_TOBE_SENT_BY','$REPLY_TOBE_PREP_BY','$REMARKS',:rc_out); end;";
            $res = $this->{$this->model}->setRefCursor($query);
            $this->session->set_userdata('flag','update');
        }else{
            $query = "BEGIN pc2019.PKG_MCC.addComplaint($COMPLAINT_ID,'$COMPLAINT_DATE','$RECEIVED_ON','$RECEIVED_FROM','$MEMO_NO','$MEMO_DT','$COMPALAINANT_NAME','$POLITICAL_AFFILIATION','$COMPLAINT_AGAINST','$PARTY','$BRIEF_FACT','$COMPLAINT_NATURE','$COMPL_MODE','$SEND_REPORT','$REPLY_TOBE_SENT_BY','$REPLY_TOBE_PREP_BY','$REMARKS',:rc_out); end;";
            $res = $this->{$this->model}->setRefCursorReturn($query);
            if($res > 0){
                $complnt_id = $res;
                $query = "BEGIN PKG_ELECTION.getFixedFCM(:rc_out); end;";
                $result = $this->{$this->model}->getRefCursor($query);
                $arr = array($result[0]['FCM_TOKEN'],$result[1]['FCM_TOKEN'],$result[2]['FCM_TOKEN']);
                $msg ="01(one) new MCC Complaint #".$complnt_id." has been received from ".$RECEIVED_FROM." regarding ".$BRIEF_FACT.".&nbsp; Regards. Election(MCC) Cell, KP.";
                $resp = send_mcc_stack_base($complnt_id,$msg,$arr);
                $json_parsed = (json_decode($resp));
                if($json_parsed->success!=0){
                    $log_stat = $this->save_notif_log($complnt_id);
                }
                $this->session->set_userdata('flag','insert');
            }
        }
        redirect('MCC/register');
    }

    public function editComplaint($c_id){
        $data = array();
        $data['title'] = 'Edit';
        $query = "BEGIN pc2019.PKG_MCC.getAllParties(:rc_out); end;";
        $data['allparty'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllModes(:rc_out); end;";
        $data['allmodes'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllNatures(:rc_out); end;";
        $data['allnature'] = $this->{$this->model}->getRefCursor($query);
        $cid = myDecode($c_id);
        $query = "BEGIN pc2019.PKG_MCC.getComplaintByID($cid,:rc_out); end;";
        $data['res'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_MCC.getAllSources(:rc_out); end;";
        $allsource = $this->{$this->model}->getRefCursor($query);
        $html = "";
        foreach ($allsource as $key => $value) {
            $html .= "<tr class='data'>";
            $html .= "<td>";
            $html .= $value['SOURCE_NAME'];
            $html .= "</td>";
            $html .= "</tr>";
        }
        $data['html'] = $html;
        $action = "Edit Complaints Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('regComplaints', $data, true);
        $this->load->view('layout_main', $data);   
    }

    public function filterStatus(){
        $status = filterData('stat');
        if($status == 'all'){
            $query = "BEGIN pc2019.PKG_MCC.getAllComplaints(null,0,null,:rc_out); end;";    
        } else{
            $query = "BEGIN pc2019.PKG_MCC.getAllComplaints(null,0,'$status',:rc_out); end;";
        }
        $res['allComp'] = $this->{$this->model}->getRefCursor($query);
        $res['type'] = $status;
        $html = $this->load->view('regComplaintsList', $res, true);
        echo $html;
    }

    public function complaintList(){
        $data = array();
        $data['title'] = 'Register Complaints List';
        $query = "BEGIN pc2019.PKG_MCC.getAllComplaints(null,0,null,:rc_out); end;";
        $data['allComp'] = $this->{$this->model}->getRefCursor($query);
        $action = "Register Complaints List Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('allComplainList', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function viewSendRep($id){
        $data = array();
        $data['title'] = 'Send Report';
        $query = "BEGIN pc2019.PKG_ELECTION.getAllDivisions(:rc_out); end;";
        $data['allDivision'] = $this->{$this->model}->getRefCursor($query);
        $query = "BEGIN pc2019.PKG_ELECTION.getAllPSs(:rc_out); end;";
        $data['allPs'] = $this->{$this->model}->getRefCursor($query);
        $data['comp_id'] = myDecode($id);
        $comp_id = $data['comp_id'];
        $query = "BEGIN pc2019.PKG_MCC.getEnquiryReports($comp_id,:rc_out); end;";
        $data['enqRep'] = $this->{$this->model}->getRefCursor($query);
        $action = "Send Report Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('sendReport', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function saveEnquiry(){
        $data = array();
        $count = 0;
        if(!empty($_POST['DIV'])){
            foreach ($_POST['DIV'] as $val){
                array_push($data, $val);
            }
        }
        if(!empty($_POST['PS'])){
            foreach ($_POST['PS'] as $val){
                array_push($data, $val);
            }
        }
        $count = count($data);
        $COMPLAINT_ID = filterData('COMPLAINT_ID');
        $DATE_SENT = toDbDate(filterData('DATE_SENT'));
        $REP_TO_REACH_BY = toDbDateTime(filterData('REP_TO_REACH_BY'));
        for($i = 0; $i < $count; $i++ ){
            $query = "BEGIN pc2019.PKG_MCC.addEnquiryReport('$COMPLAINT_ID','$data[$i]','$DATE_SENT','$REP_TO_REACH_BY',:rc_out); end;";
            $res = $this->{$this->model}->setRefCursor($query);
        }
        if($res){
            $this->session->set_userdata('flag','insert');
        }
        redirect('MCC/complaintList');
    }

    public function editSendRep(){
        $AUTO_ID = filterData('AUTO_ID');
        $REP_RECVD_ON = toDbDateTime(filterData('REP_RECVD_ON'));
        $REP_MEMO_DT = toDbDateTime(filterData('REP_MEMO_DT'));
        $REP_MEMO_NO = filterData('REP_MEMO_NO');
        $ACTION_TAKEN = filterData('ACTION_TAKEN');
        $query = "BEGIN pc2019.PKG_MCC.editEnquiryReport($AUTO_ID,'$REP_RECVD_ON','$REP_MEMO_NO','$REP_MEMO_DT','$ACTION_TAKEN',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        if($res){
            $this->session->set_userdata('flag','update');
        }
        redirect('MCC/complaintList');
    }

    public function getfiles(){
        $userid = $this->input->post('USERID');
        $data = array();
        $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID($userid,:rc_out); end;";
        $data['data'] = $this->{$this->model}->getRefCursor($query);
        $html = "";
        if(sizeof($data['data']) > 0){
            foreach ($data['data'] as $key => $value) {
                $html .= '<tr role="row" class="odd" align="center"><td class="sorting_1">'
                .$value['DOCUMENT_TITLE'].'</td><td>'
                .$value['DOCUMENT_NAME'].'</td><td>'.toDisplayDate($value['UPLOAD_DATE'])
                .'</td><td><a target="_blank" href="'.$this->config->item('view_path').'mcc/'.
                $value['DOCUMENT_NAME'].'" class="btn btn-primary">View</a> <button  value="'.$userid."/".$value['DOCUMENT_ID']."/".$value['DOCUMENT_NAME'].'" class="btn btndelete btn-primary">Delete</button></td></tr>';
            }
        }else{
            $html = '<tr align="center"><td colspan="3">No file to show</td></tr>';
        }

        echo $html;
    }

    public function deletefile(){
        $docid = intval($this->input->post('DOCID'));
        $userid = $this->input->post('USERID');
        $docname = intval($this->input->post('DOCNAME'));
        $query = "BEGIN pc2019.PKG_MCC.removeDocument($docid,:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        unlink($this->config->item('upload_path').'mcc/'.$docname);

        $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID($userid,:rc_out); end;";
        $data['data'] = $this->{$this->model}->getRefCursor($query);
        $html = "";
        if(sizeof($data['data']) > 0){
            foreach ($data['data'] as $key => $value) {
                $html .= '<tr role="row" class="odd" align="center"><td class="sorting_1">'
                .$value['DOCUMENT_TITLE'].'</td><td>'
                .$value['DOCUMENT_NAME'].'</td><td>'.toDisplayDate($value['UPLOAD_DATE'])
                .'</td><td><a target="_blank" href="'.$this->config->item('view_path').'mcc/'.
                $value['DOCUMENT_NAME'].'" class="btn btn-primary">View</a> <button  value="'.$userid."/".$value['DOCUMENT_ID']."/".$value['DOCUMENT_NAME'].'" class="btn btn-primary btndelete">Delete</button></td></tr>';
            }
        }else{
            $html = '<tr align="center"><td colspan="3">No file to show</td></tr>';
        }
        echo $html;
    }
    public function getReports(){
        $cid = filterData('cid');
        $query = "BEGIN pc2019.PKG_MCC.getEnquiryReports($cid,:rc_out); end;";
        $res = $this->{$this->model}->getRefCursor($query);
        $html="";
        foreach ($res as $value) {
            $html.="<tr>";
            $html.="<td>".$value['SENT_TO']."</td>";
            $html.="<td>".toDisplayDate($value['DATE_SENT'])."</td>";
            $html.="<td>".$value['REP_TO_REACH_BY']."</td>";
            $html.="<td>".$value['REP_RECVD_ON']."</td>";
            $html.="<td>".$value['ACTION_TAKEN']."</td>";
            $html.="<td>".$value['REP_MEMO_NO']."</td>";
            $html.="<td>".toDisplayDate($value['REP_MEMO_DT'])."</td>";
            $html.="</tr>";
        }
        $data['html'] = $html;
        $query = "BEGIN pc2019.PKG_MCC.getMailNoticeLog($cid,:rc_out); end;";
        $res1 = $this->{$this->model}->getRefCursor($query);
        $html1="";
        foreach ($res1 as $val) {
            $html1.="<tr>";
            $html1.="<td>".$val['COMPLAINT_ID']."</td>";
            $html1.="<td>".$val['LOGDATE']."</td>";
            $html1.="<td>".$val['LOGTYPE']."</td>";
            $html1.="<td>".$val['SENT_TO']."</td>";
            $html1.="</tr>";
        }

        $data['html1'] = $html1;
        echo json_encode($data);
    }

    public function filesave($user_id,$title){
        $title = urldecode($title);
        $config['upload_path'] = $this->config->item('upload_path')."mcc/";
        @mkdir($config['upload_path'],0777,true);
        $config['allowed_types']        = '*';
        $config['max_size']             = 10240;
        $new_name = $user_id.mt_rand(99,1000);
        $config['file_name'] = strtolower($new_name.substr($_FILES['userfile']['name'],(strripos($_FILES['userfile']['name'],'.')),(strlen($_FILES['userfile']['name'])-strripos($_FILES['userfile']['name'],'.')+1)));
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('userfile'))
        {      
                $error = array('error' => $this->upload->display_errors());
                $data = '0'.'/'."File Size Should Be less Than 10 MB.";
                echo '0'.'/'."File Size Should Be less Than 10 MB."; 
        }       
        else //pdf upload Success !!!
        {
        	$user_id = intval($user_id);
        	$name = $config['file_name'];
        	$type = substr($_FILES['userfile']['name'],(strripos($_FILES['userfile']['name'],'.')),(strlen($_FILES['userfile']['name'])-strripos($_FILES['userfile']['name'],'.')+1));
            $query = "BEGIN pc2019.PKG_MCC.uploadDocuments($user_id,'$name','$title','$type',:rc_out); end;";
            $res = $this->{$this->model}->setRefCursor($query);

            if($res == 0){
                $data = '0'.'/'."faild";
            }else{
                $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID($user_id,:rc_out); end;";
                $file = $this->{$this->model}->getRefCursor($query);
                $len = count($file);
                
                if($len == 1){
                    $data = '1'.'/'.$file[0]['DOCUMENT_NAME'];
                    
                }else{
                    $data = $len.'/'.'multiple';
                }
                echo $data;
            }
        }  
    }

    public function isDuplicateID(){
        $cid = filterData('cid');
        $query = "BEGIN pc2019.PKG_MCC.isDuplicateID($cid,:rc_out); end;";
        $res = $this->{$this->model}->getRefCursorReturn($query);
        echo $res;
    }

}

