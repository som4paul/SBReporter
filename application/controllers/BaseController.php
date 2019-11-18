<?php
class BaseController extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->USRNAME = $this->session->userdata('USRNAME');
        $this->USRTYPE = $this->session->userdata('USRTYPE');
        $url = $this->uri->uri_string();
        $param = explode("/", $url);
        $this->method = (isset($param[1])?$param[1]:'');
        $this->load->library("Phpmailer_library");
	}

    public function get_reports_log_id($rpid){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reports_log_id('$rpid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);
          return $requests ;    
    }
    public function get_event_name_by_id($evid){
       $query = "BEGIN REPORTER.PKG_OFFICERS.get_event_name_by_id('$evid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);
          return $requests ;        
    }
    public function get_of_name_by_id($ofid){
      $query = "BEGIN REPORTER.PKG_OFFICERS.get_of_name_by_id('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);
          return $requests ;   
    }

    public function get_subordinates($ofid){

        $query = "BEGIN REPORTER.PKG_OFFICERS.get_subordinates('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);
          return $requests ; 
    }

    public function get_completed_reports_do($ofid){
         $query = "BEGIN REPORTER.PKG_OFFICERS.get_completereport_completed('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 

    }


    public function fetch_reports_forwarded($ofid){
       $query = "BEGIN REPORTER.PKG_OFFICERS.get_reports_forwarded('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ;  
    }


    public function get_reports_details($rpid){

        $rpid = (string) $rpid ;
        
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reportdetails_by_id('$rpid',:rc_out); end;";
        

          $requests = $this->{$this->model}->getRefCursor2($query);

          return $requests ;   
    }

     public function fetch_reports_forwarded_api($ofid){
       $query = "BEGIN REPORTER.PKG_OFFICERS.get_reports_forwarded_api('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ;  
    }

    public function fetch_reports_forwarded_complete($ofid){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reports_forwarded_complete('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 
    }

    public function get_reports_total_ongoing(){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_total_report_ongoing( :rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 

    }

     public function get_reports_total_complete(){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_total_report_complete( :rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 

    }
    public function get_reports_do($ofid){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_completereport_do('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 
    }

       public function get_reports_do_api($ofid){
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_completereport_do_api('$ofid',:rc_out); end;";
          $requests = $this->{$this->model}->getRefCursor($query);

          return $requests ; 
    }
	public function includeScript(){
		$data = 'var resizefunc = [];';
	    $data .= 'var csrfData = {};';
	    $data .= 'csrfData["'.$this->security->get_csrf_token_name().'"] = "'.$this->security->get_csrf_hash().'";';
	    $data .= '$(function() {
	        $.ajaxSetup({
	           data: csrfData
	        });   
	    });';
		$data .= 'var base_url = "'.base_url().'";';
		$data .= 'var module = "'.$this->module.'";';

        if($this->module == 'SpecialReport'){
            $date = $this->getReportDate();
            $date = explode("/",$date); 
            $data .= '$("#iniDate").datepicker({ 
                    format: "dd-M-yyyy",
                    endDate: "'.$date[1].'",
                    autoclose: true
                }).datepicker("setDate", "'.$date[0].'");';
        }
		echo $data;
	}

    public function getReportDate(){
        $str = $this->session->userdata('UNAME');
        $psStr = $this->session->userdata('ACCESSPOINT');
        if($psStr=='PS')
        {
            $str=substr($str, 4);
        }
        $last_record_date = $this->{$this->model}->getLastRecordDate($str);
        $today = date('d-M-Y');
        $last_inserted_date = $last_record_date[0]['LASTDATE'];

        if(!empty($this->session->userdata('LAST_RECORD_DATE'))){
            $last_inserted_date = $this->session->userdata('LAST_RECORD_DATE');
        }elseif(empty($last_inserted_date)){
            $last_inserted_date = date('d-M-Y');
        }
        
        if(strtotime($today)!= strtotime($last_inserted_date)){
            $nextDate = date('d-M-Y', strtotime('+1 day', strtotime($last_inserted_date)));
        }else{
            $nextDate = $today;
        }
        $totalRes = $last_inserted_date."/".$nextDate;
        return $totalRes;
    }

	//Checking the date in PSREPORTS table
    public function check_date(){
        $pstDate = $this->security->xss_clean(strip_tags(trim($this->input->post('dateval'))));
        $pstDate = toDbDate($pstDate);
        $str = $this->session->userdata('UNAME') ;
        $psStr = $this->session->userdata('ACCESSPOINT') ; 
            if($psStr=='PS')
            {
                $str=substr($str, 4) ; 
            }
        $chkDate = $this->{$this->model}->getPsreports($str,$pstDate);
        echo $chkDate['C'];
    }

	//Saving the date in PSREPORTS table
	public function savePsreports(){
        $pstDate = $this->security->xss_clean(strip_tags(trim($this->input->post('dateval'))));
        $pstDate = toDbDate($pstDate);
        $str = $this->session->userdata('UNAME') ;
        $psStr = $this->session->userdata('ACCESSPOINT') ; 
            if($psStr=='PS')
            {
                $str=substr($str, 4) ; 
            }

        $dateArr = array(
            'PS' => $str,
            'REPDATE' => $pstDate
        );
        $res = $this->{$this->model}->savePsreports($dateArr);
        $last_record_date = $this->{$this->model}->getLastRecordDate($str);
        $userdata['LAST_RECORD_DATE'] = $userdata['VIEW_PREF_DATE'] = $last_record_date[0]['LASTDATE'];
        $this->session->set_userdata($userdata);
        echo $res;
    }

    // File Upload
    public function fileUpload($arg, $filename){

        $config = array(
            'upload_path' => $arg['path'],
            'allowed_types' => $arg['types'],
            'overwrite' => TRUE,
            'max_size' => $arg['maxsize']
        );

        $this->upload->initialize($config);
        if (!$this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors()); 
            $resp = array(
                "status" => false,
                "msg" => $error['error']
            );
            $this->session->set_userdata('UPLOAD_FLAG',false);
            return $resp;
        }
        else{ 
            $data = array('upload_data' => $this->upload->data());
            $resp = array(
                "status" => true,
                "msg" => "Succesfully Uploaded"
            );
            $this->session->set_userdata('UPLOAD_FLAG',true);
            return $resp;
        }
    }

    public function save_notif_log($cid){
        /*addMailNoticeLog*/
        $query = "BEGIN pc2019.PKG_MCC.addMailNoticeLog('$cid','Notification',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query); 

        return $res ;      

    }

    public function save_email_log($cid){
        /*addMailNoticeLog*/
        $query = "BEGIN pc2019.PKG_MCC.addMailNoticeLog('$cid','Email',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query); 

        return $res ;      

    }


    function get_reply_datetime($cid){

        $query = "BEGIN pc2019.PKG_MCC.getEnquiryReports('$cid',:rc_out); end;";
        $date_time = $this->{$this->model}->getRefCursor($query);
        $desired_datetime; 
         foreach($date_time as $key => $csd){


            $desired_datetime = $csd['REP_TO_REACH_BY'] ;
                    break ; 
           
        }

        return $desired_datetime ; 

    }

    // MAIL FUNCTION
    public function sendMail($to,$subject,$message){
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        // More headers
        $headers .= 'From: <egovcell@kpolice.gov.in>'."\r\n";

        foreach ($to as $value) {
            mail($value,$subject,$message,$headers);
        }
    }



    public function sendMail_phpmailer($to,$subject,$message,$files_to_attach){
        $email = $this->phpmailer_library->load();
        //$email->SetFrom('egovcell@kpolice.gov.in', 'KP'); //Name is optional
        $email->SetFrom('electioncell@kpolice.gov.in', 'KOLKATA-POLICE'); //Name is optional
        $email->Subject   = $subject;
        $email->Body      = $message;

        $email->IsSMTP();
        //$email->Host = "localhost";
        //$email->SMTPDebug  = 2;

        $email->IsHTML(true);
        $response = array() ;

        //$file_to_attach = APPPATH.'third_party/test.pdf';


        for($u=0;$u<(count($files_to_attach));$u++)    
            {
        $email->AddAttachment($files_to_attach[$u]);
            }//end of for()
           
         foreach ($to as $value) {
            

            $email->AddAddress( $value );
            $response[] =$email->Send();
        }//end of foreach
        return $response;

    }


}