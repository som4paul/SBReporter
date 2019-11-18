  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Report';
    	$this->model = 'ReportM';
        parent::__construct($this->module);
       // loggedoutuser();
        $this->load->model($this->model);
        $this->load->helper('string');
	}

 public function reopen_report(){
  $RP_ID = filterdata('RP_ID') ; //SELECTED REPORT ID FROM DROPDOWN
  //UPDATE REQUEST TABLE FOR COMPLETION
  $sup_id = $this->session->userdata('OFID') ;
         date_default_timezone_set('Asia/Kolkata');
         $cur_time = date("d-M-Y H:i")  ; 
    $upd_array = array("RP_REOPENING_ID"=>$sup_id,"RP_REOPENING_TIME"=>$cur_time,"RP_PRESENT_STATUS"=>'RE-OPENED');

    //run the update query
    $this->db->where('RP_ID',$RP_ID) ;
    $this->db->update('REPORT',$upd_array) ; 



    return TRUE ;

 }


 public function close_report(){

  $RP_ID = filterdata('RP_ID') ; //SELECTED REPORT ID FROM DROPDOWN
  //UPDATE REQUEST TABLE FOR COMPLETION
  $do_id = $this->session->userdata('OFID') ;
         date_default_timezone_set('Asia/Kolkata');
         $cur_time = date("d-M-Y H:i")  ; 
    $upd_array = array("RP_COMPLETED_BY"=>$do_id,"RP_COMPLETE_TIME"=>$cur_time,"RP_PRESENT_STATUS"=>'COMPLETE');

    //run the update query
    $this->db->where('RP_ID',$RP_ID) ;
    $this->db->update('REPORT',$upd_array) ; 



    /*$upd_array2 = array("RP_REQ_ID"=>$REQID);
    //update the REPORT table with the corresponding request ID
    $this->db->where('RP_ID',$RP_ID) ;
    $this->db->update('REPORT',$upd_array2) ;*/



    return TRUE ;
 }
 public function Advrepedit($rpid){

  $repid = ($rpid) ; 
  

  //prefetching data 

  $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
        $query2 = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
        $data['offcr_name'] = $this->{$this->model}->getRefCursor($query2);
          /*pre( $data['offcr_name'],1) ;*/
        
        $data['prog_type']= $prog_type;

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $query4 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['ac_name'] = $this->{$this->model}->getRefCursor($query4);

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['dc_name'] = $this->{$this->model}->getRefCursor($query5);

  //echo $rpid ; die ;
  $query = "BEGIN REPORTER.PKG_OFFICERS.get_completereport_byid('$repid',:rc_out); end;";
         
      $result = $this->{$this->model}->getRefCursor($query);

        //pre($result,1) ;
      $data['repdet']= $result[0] ;



      if($result[0]['RP_MODE']=='WFR' && $result[0]['RP_TYPE']=='ADVANCED' OR $result[0]['RP_TYPE']=='COVERING' )
       {  $data['title'] = 'Advance Full Report Edit';
          $action = "Advance Report Edit page opened";
          $data['subview'] = $this->load->view('advpgedwfr', $data, true);
          }

      else if($result[0]['RP_MODE']=='UPR' && $result[0]['RP_TYPE']=='ADVANCED' OR $result[0]['RP_TYPE']=='COVERING')
          { $action = "Advance Report Edit page opened";
            $data['subview'] = $this->load->view('advpgedupr', $data, true);
          }
          $this->{$this->model}->logEntry($action);
        $this->load->view('layout_main', $data);

 }
  
  public function Advrepc(){
        $data = array();
        

        $data['title'] = 'Advance Report Creation';
        $action = "Advance Report Creation 1st page opened";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('advpg1', $data, true);
        $this->load->view('layout_main', $data);


  }

public function Advrepg(){
        $data = array();
        $posted_data  = $this->input->post() ;
        //pre($posted_data,1) ; 



        if($posted_data['RP_MODE']=='WFR')
    {      
        $data['title'] = 'Advance Full Report Generation';
        $action = "Advance Report Generation page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
        $query2 = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
        $data['offcr_name'] = $this->{$this->model}->getRefCursor($query2);
          /*pre( $data['offcr_name'],1) ;*/
        $this->{$this->model}->logEntry($action);
        $data['prog_type']= $prog_type;

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $query4 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['ac_name'] = $this->{$this->model}->getRefCursor($query4);

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_dc(:rc_out); end;";
        $data['dc_name'] = $this->{$this->model}->getRefCursor($query5);
        $data['RP_PRIORITY'] = $posted_data['RP_PRIORITY'] ; 
        $data['RP_MODE'] = $posted_data['RP_MODE'] ; 
        $data['subview'] = $this->load->view('advpg2', $data, true);
      }

      else{

        $data['title'] = 'Advance Report Upload';
        $action = "Advance Report Upload page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
        $query2 = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
        $data['offcr_name'] = $this->{$this->model}->getRefCursor($query2);
          /*pre( $data['offcr_name'],1) ;*/
        $this->{$this->model}->logEntry($action);
        $data['prog_type']= $prog_type;

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $query4 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['ac_name'] = $this->{$this->model}->getRefCursor($query4);

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_dc(:rc_out); end;";
        $data['dc_name'] = $this->{$this->model}->getRefCursor($query5);
        $data['RP_PRIORITY'] = $posted_data['RP_PRIORITY'] ; 
        $data['RP_MODE'] = $posted_data['RP_MODE'] ; 
        $data['subview'] = $this->load->view('advpg3', $data, true);


      }


        $this->load->view('layout_main', $data);



  }

public function Advrepi(){

        /*pre($_FILES) ; die ;*/
        $posted_data  = $this->input->post() ;
        //pre($posted_data,1) ; 


        //insertion of other event type
        if(!empty($posted_data['OTHEREVENT'])){
          $event_name = $posted_data['OTHEREVENT'] ; 
          unset($posted_data['OTHEREVENT']) ; 
         $insert_id =  $this->{$this->model}->insert_event($event_name) ;
         
         $posted_data['EVID'] = $insert_id ; 
        } ; 

        //end of insertion of other event type
        //echo $otherevent ;die; 
        $OTHR_OFIDS = $SUP_OFIDS= '' ; 
        //manipulating android file to php format 
        $mediate = array() ;





        foreach ($posted_data as $key => $value) {
           # code...
          if($key=='OTHR_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_OFIDS.= $value[$i].",";
          }
         } //end of foreach

         //echo $OTHR_OFIDS ; 

         $posted_data['OTHR_OFIDS'] = $OTHR_OFIDS ; 
         $loggedin_id =  $this->session->userdata('OFID') ; 

         $posted_data['RP_CREATED_BY']  = $loggedin_id ; 
         $query = "BEGIN REPORTER.PKG_OFFICERS.get_superiors_do('$loggedin_id',:rc_out); end;";
         
         $posted_data['SUP_OFIDS'] = $this->{$this->model}->getRefCursor($query);

         foreach ($posted_data as $key => $value) {
           # code...
          if($key=='SUP_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $SUP_OFIDS.= $value[$i]['OFID'].",";
          }
         } //end of foreach
         $posted_data['RP_TIME'] = ($posted_data['RP_TIME']) ; 
         $posted_data['SUP_OFIDS'] = $SUP_OFIDS;
         $posted_data['RP_TYPE'] = "ADVANCED";
        
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['RP_CREATEDON'] = date("d-M-Y H:i") ; 


         
         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_report_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         $posted_data['RP_LOG_ID'] = "AR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);
         $posted_data['RP_PRESENT_STATUS'] = 'ONGOING';
         ///file upload process

         $upload_path = UPLOADVPATH_REPORT."/".$loggedin_id ."/".$date."/".($rp_id[0]['NEXTVAL']+1) ;
        
         
         if (!empty($_FILES['images']['name'][0])) {

          //make directory based on actual file input
              if (!is_dir($upload_path))
              {
                  mkdir("$upload_path",0777,true) ; 
              }



                if ($this->upload_files($upload_path,'SBReport', $_FILES['images']) === FALSE) {
                    $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                }
            }

           

          $posted_data['FILE_PATH'] = $upload_path ;  
          //pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                $posted_data['FILE_PATH'] = $upload_path ;   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/

                $this->{$this->model}->insert_adv_report($posted_data) ;  
                redirect('Dashboard/index');    
            }              
}
 public function Advrepeditwfr(){

      $posted_data  = $this->input->post() ;
        $OTHR_OFIDS = $SUP_OFIDS= '' ; 
        

        foreach ($posted_data as $key => $value) {
           # code...
          if($key=='OTHR_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_OFIDS.= $value[$i].",";
          }
         } //end of foreach

         //echo $OTHR_OFIDS ; 
          //insertion of other event type
        if(!empty($posted_data['OTHEREVENT'])){
          $event_name = $posted_data['OTHEREVENT'] ; 
          unset($posted_data['OTHEREVENT']) ; 
         $insert_id =  $this->{$this->model}->insert_event($event_name) ;
         
         $posted_data['EVID'] = $insert_id ; 
        } ; 

        //end of insertion of other event type

         $posted_data['OTHR_OFIDS'] = $OTHR_OFIDS ; 
         $loggedin_id =  $this->session->userdata('OFID') ; 

         $posted_data['RP_CREATED_BY']  = $loggedin_id ; 
         $query = "BEGIN REPORTER.PKG_OFFICERS.get_superiors_do('$loggedin_id',:rc_out); end;";
         
         $posted_data['SUP_OFIDS'] = $this->{$this->model}->getRefCursor($query);

         foreach ($posted_data as $key => $value) {
           # code...
          if($key=='SUP_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $SUP_OFIDS.= $value[$i]['OFID'].",";
          }
         } //end of foreach
         $posted_data['RP_TIME'] = ($posted_data['RP_TIME']) ; 
         $posted_data['SUP_OFIDS'] = $SUP_OFIDS;
         $posted_data['RP_TYPE'] = "ADVANCED";
        
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['RP_CREATEDON'] = date("d-M-Y H:i") ; 


         
         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_report_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         /*$posted_data['RP_LOG_ID'] = "AR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);*/
         $posted_data['RP_PRESENT_STATUS'] = 'ONGOING';

         //pre($posted_data,1);
         ///file upload process       
        $upload_path = $posted_data['FILE_PATH'];
         
         if (!empty($_FILES['images']['name'][0])) {

          //make directory based on actual file input
              if (!is_dir($upload_path))
              {
                  mkdir("$upload_path",0777,true) ; 
              }



                if ($this->upload_files($upload_path,'SBReport', $_FILES['images']) === FALSE) {
                    $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                }
            }
           

                   // pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/
                 
                $this->{$this->model}->update_adv_report($posted_data) ;  
                redirect('Dashboard/index');    
            }         
  }


/**********************************Covering Report*************************************/
   public function Covrepc(){
        $data = array();
        
        $data['title'] = 'Covering Report Creation';
        $action = "Covering Report Creation 1st page opened";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('covpg1', $data, true);
        $this->load->view('layout_main', $data);

  }

  public function Covrepg(){
        $data = array();
        $posted_data  = $this->input->post() ;
        //pre($posted_data,1) ; 

        //insertion of other event type
        if(!empty($posted_data['OTHEREVENT'])){
          $event_name = $posted_data['OTHEREVENT'] ; 
          unset($posted_data['OTHEREVENT']) ; 
         $insert_id =  $this->{$this->model}->insert_event($event_name) ;
         
         $posted_data['EVID'] = $insert_id ; 
        } ; 

        //end of insertion of other event type

        if($posted_data['RP_MODE']=='WFR')
    {      
        $data['title'] = 'Covering Full Report Generation';
        $action = "Covering Report Generation page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
        $query2 = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
        $data['offcr_name'] = $this->{$this->model}->getRefCursor($query2);
          /*pre( $data['offcr_name'],1) ;*/
        $this->{$this->model}->logEntry($action);
        $data['prog_type']= $prog_type;

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $query4 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['ac_name'] = $this->{$this->model}->getRefCursor($query4);

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_dc(:rc_out); end;";
        $data['dc_name'] = $this->{$this->model}->getRefCursor($query5);
        $data['RP_PRIORITY'] = $posted_data['RP_PRIORITY'] ; 
        $data['RP_MODE'] = $posted_data['RP_MODE'] ; 
        $data['subview'] = $this->load->view('covpg2', $data, true);
      }

      else{

        $data['title'] = 'Covering Report Upload';
        $action = "Covering Report Upload page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
        $query2 = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
        $data['offcr_name'] = $this->{$this->model}->getRefCursor($query2);
          /*pre( $data['offcr_name'],1) ;*/
        $this->{$this->model}->logEntry($action);
        $data['prog_type']= $prog_type;

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $query4 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
        $data['ac_name'] = $this->{$this->model}->getRefCursor($query4);

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_dc(:rc_out); end;";
        $data['dc_name'] = $this->{$this->model}->getRefCursor($query5);
        $data['RP_PRIORITY'] = $posted_data['RP_PRIORITY'] ; 
        $data['RP_MODE'] = $posted_data['RP_MODE'] ; 
        $data['subview'] = $this->load->view('covpg3', $data, true);


      }


        $this->load->view('layout_main', $data);



  }



  public function Covrepi(){


        $posted_data  = $this->input->post() ;
        $OTHR_OFIDS = $SUP_OFIDS= '' ; 
        

        foreach ($posted_data as $key => $value) {
           # code...
          if($key=='OTHR_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_OFIDS.= $value[$i].",";
          }
         } //end of foreach

         //echo $OTHR_OFIDS ; 

         $posted_data['OTHR_OFIDS'] = $OTHR_OFIDS ; 
         $loggedin_id =  $this->session->userdata('OFID') ;
         $posted_data['RP_CREATED_BY']  = $loggedin_id ;  
         $query = "BEGIN REPORTER.PKG_OFFICERS.get_superiors_do('$loggedin_id',:rc_out); end;";
         
         $posted_data['SUP_OFIDS'] = $this->{$this->model}->getRefCursor($query);

         foreach ($posted_data as $key => $value) {
           # code...
          if($key=='SUP_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $SUP_OFIDS.= $value[$i]['OFID'].",";
          }
         } //end of foreach
         $posted_data['RP_TIME'] = ($posted_data['RP_TIME']) ; 
         $posted_data['SUP_OFIDS'] = $SUP_OFIDS;
         $posted_data['RP_TYPE'] = "COVERING";
         
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['RP_CREATEDON'] = date("d-M-Y H:i") ; 


         
         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_report_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         $posted_data['RP_LOG_ID'] = "CR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);
         $posted_data['RP_PRESENT_STATUS'] = 'ONGOING';
         ///file upload process

        $upload_path = UPLOADVPATH_REPORT."/".$loggedin_id ."/".$date."/".($rp_id[0]['NEXTVAL']+1) ;  
      
         if (!empty($_FILES['images']['name'][0])) {

              //make directory based on actual file input
              if (!is_dir($upload_path))
              {
                  mkdir("$upload_path",0777,true) ; 
              }


                if ($this->upload_files($upload_path,'SBReport', $_FILES['images']) === FALSE) {
                    $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                }
            }

            else 
            {
               unset($data['error']) ;
            }

          $posted_data['FILE_PATH'] = $upload_path ;  
          //pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                $posted_data['FILE_PATH'] = $upload_path ;   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/

                $this->{$this->model}->insert_adv_report($posted_data) ;  
                redirect('Dashboard/index');    
            }              

        

  }
/**************************************************Covering report end **********/
  public function login_sb(){

    $cipher= filterdata('cipher') ;   
    $mob = filterdata('mobileno') ; 
    $pass = filterdata('password') ; 
    $md5pass = md5($pass) ; 

    if($cipher=="SBREPORTER"&& !empty($mob)&& !empty($pass))
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.officers_login('$mob','$md5pass','$pass',:rc_out); end;";
     $return['result'] = $this->{$this->model}->getRefCursor($query);
     //echo "<pre>" ; print_r($return) ; 
      if(!empty($return['result']))
      
      {
          $return['message'] = "Success !";
          $return['status'] = True ;
      }
          else
          { $return['result'] = array() ; 
            $return['status'] = False ;
            $return['message'] = "Username / Password Mismatch!";
          }

      }

      else{ 
            $return['result'] = array() ;
            $return['status'] = False ;
            $return['message'] = "POST PARAMS MISSING !";
      } 
      echo json_encode($return) ; 



  } 

    public function get_do_names() {

    $cipher= $this->input->post('cipher',true) ;     

    //error_reporting(E_ALL);
    /*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
     $return['result'] = $this->{$this->model}->getRefCursor($query);

      
      $return['status'] = True ;

      }

      else{
            $return['status'] = False ;
      } 
      echo json_encode($return) ;
  }//end of get_oc_names


	public function get_oc_names() {

    $cipher= $this->input->post('cipher',true) ;     

    //error_reporting(E_ALL);
		/*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.officers_oc(:rc_out); end;";
     $return['result'] = $this->{$this->model}->getRefCursor($query);

      
      $return['status'] = True ;

      }

      else{
            $return['status'] = False ;
      } 
      echo json_encode($return) ;
	}//end of get_oc_names

  public function video_upload(){
            $cipher= urldecode($this->input->post('cipher',true)) ; 
            $video_uploaded = $_FILES['upload_v']; 
         //phpinfo(); 
   if($cipher=="SBREPORTER")
   {
           // echo UPLOADVPATH ; die ;

            $configVideo['upload_path'] = UPLOADVPATH ; # check path is correct
            $configVideo['max_size'] = '102400';
            $configVideo['allowed_types'] = 'mp4'; # add video extenstion on here
            $configVideo['overwrite'] = TRUE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = random_string('numeric', 5);
            $configVideo['file_name'] = $video_name;

            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);

            if (!$this->upload->do_upload('upload_v')) # form input field attribute
            {   $return['message'] =  $this->upload->display_errors();
                # Upload Failed
                 $return['status'] = False ;
            }
            else
            {
                # Upload Successfull
                $url = UPLOADVPATH.$video_name;

                //Insert Status in db set
                //$set1 =  $this->Model_name->uploadData($url);
                $return['status'] = True ;
            }

        }//end of cipher


        else
        {        $return['message'] =  'cipher doesnt matches' ;
                 $return['status'] = False ;//i.e. if cipher doesnt matches 
        }


        echo json_encode($return) ;
  }//end of video_upload()


   public  function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|doc|pdf|xlsx|csv|mp4|3gp',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
         
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {

              $errors = $this->upload->display_errors();
                    echo($errors);
                return false;
            }
        }
        
        return $images;
    }

    public function Viewrequests(){

      $data = array();
        $posted_data  = $this->input->post() ;
        //pre($posted_data,1) ; 
        $doid = $this->session->userdata('OFID') ; 
        $data['title'] = 'View Report requests';
        $action = "View Report requests page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reqinq_do('$doid',:rc_out); end;";
        $requests = $this->{$this->model}->getRefCursor($query);
        $data['requests'] = $requests ;
        $data['subview'] = $this->load->view('Viewreq', $data, true);
     


        $this->load->view('layout_main', $data);


    }//end of view requests


    public function get_reports(){

      $RP_CREATED_BY = $this->session->userdata('OFID') ;

        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reports_do('$RP_CREATED_BY',:rc_out); end;";
        $requests = $this->{$this->model}->getRefCursor($query);

       echo json_encode($requests) ;

    }

    

    public function Ongoing_report_fetch(){

        $data = array();
        $reports_details = array() ; 
        //pre($posted_data,1) ; 
        $ofid = $this->session->userdata('OFID') ; 
        //pre($this->session->userdata(),1) ; 


        if($this->session->userdata('IS_DO')==1)
        {
            //call procedure for do

          $reports_details = $this->get_reports_do($ofid) ; 

         //pre($reports_details,1) ; 
        }

        else if($this->session->userdata('IS_OC')==1)
        {
          //call procedure for DO

         $subordinates =  $this->get_subordinates($ofid) ; 
         

         $subordinates = explode( ',',$subordinates[0]['SUBORDINATES']); 
         $reports_details = array() ; 
         for($i=0;$i<count($subordinates);$i++)
         {  
            $reports_details = array_merge($reports_details,$this->get_reports_do($subordinates[$i])) ; 
         }//end of for()

         // pre($reports_details,1) ; 

        }
        else if($this->session->userdata('IS_AC')==1)
        {
          //call procedure for DO

          //call procedure for DO

         $subordinates =  $this->get_subordinates($ofid) ; 
         

         $subordinates = explode( ',',$subordinates[0]['SUBORDINATES']);
         $subordinates_inter = array() ;


         for($k=0;$k<count($subordinates);$k++)
         {
            $subordinates_comma = $this->get_subordinates($subordinates[$k]) ;

            if(!empty($subordinates_comma))
           {   
            $subordinates_comma = explode( ',',$subordinates_comma[0]['SUBORDINATES']);
            $subordinates_inter = array_merge($subordinates_inter,$subordinates_comma) ; 
            }
         }//end of for($k=0;$k<count($subordinates);$k++)

         /*$subordinates = array_merge($subordinates,$subordinates_inter) ;*/
         $subordinates = $subordinates_inter   ;

         $reports_details = array() ; 
         for($i=0;$i<count($subordinates);$i++)
         {  
            $reports_details = array_merge($reports_details,$this->get_reports_do($subordinates[$i])) ; 
         }//end of for()


         //pre($reports_details,1) ; 
        }


        //else part for superior higher officials


        else // in case of dc, jtcp,adcp and cp
        {
            //$reports_details = $this->get_reports_total_ongoing() ; 
             
        }
      /*   else if($this->session->userdata('IS_DC')==1)
        {
          //call procedure for DO
        }



         else if($this->session->userdata('IS_JTCP')==1)
        {
          //call procedure for DO
        }

         else if($this->session->userdata('IS_ADCP')==1)
        {
          //call procedure for DO
        }

          else if($this->session->userdata('IS_CP')==1)
        {
          //call procedure for DO
        }
*/


        //finally run the procedure to get the reports if assigned to

        $requests_by_id = $this->fetch_reports_forwarded($ofid) ;
        //merging with previous subordinate do list
        $reports_details = array_merge($reports_details,$requests_by_id) ; 
       // pre($reports_details,1) ; 
        $price = array() ; 

        $merged_array = $reports_details ; 
        /*$price = array_column($merged_array, 'RP_CREATEDON'); */ 
        foreach ($merged_array as $key => $row)
                {
                    $price[$key] = $row['RP_ID'];
                }

                

        array_multisort($price, SORT_DESC, $merged_array);
         
        $merged_array = array_unique($merged_array,SORT_REGULAR) ;
        $merged_array_final = array() ; 
        foreach ($merged_array as $key => $value) {
          $merged_array_final[] = $merged_array[$key] ;
          # code...
        }
        //pre($merged_array_final,1)  ;
        $data['title'] = 'View Ongoing requests';
        $action = "View Ongoing requests page opened";
        
        $data['reports_details'] = $merged_array_final ;
        $data['subview'] = $this->load->view('ViewongRep', $data, true);
     


        $this->load->view('layout_main', $data);


    }//end of Ongoing_report_fetch()



    public function complete_report_fetch(){

       $data = array();
        $reports_details = array() ; 
        //pre($posted_data,1) ; 
        $ofid = $this->session->userdata('OFID') ; 
        //pre($this->session->userdata(),1) ; 


        if($this->session->userdata('IS_DO')==1)
        {
            //call procedure for do

          $reports_details = $this->get_completed_reports_do($ofid) ; 

         //pre($reports_details,1) ; 
        }

        else if($this->session->userdata('IS_OC')==1)
        {
          //call procedure for DO

         $subordinates =  $this->get_subordinates($ofid) ; 
         

         $subordinates = explode( ',',$subordinates[0]['SUBORDINATES']); 
         $reports_details = array() ; 
         for($i=0;$i<count($subordinates);$i++)
         {  
            $reports_details = array_merge($reports_details,$this->get_completed_reports_do($subordinates[$i])) ; 
         }//end of for()

         // pre($reports_details,1) ; 

        }
        else if($this->session->userdata('IS_AC')==1)
        {
          //call procedure for DO

          //call procedure for DO

         $subordinates =  $this->get_subordinates($ofid) ; 
         

         $subordinates = explode( ',',$subordinates[0]['SUBORDINATES']);
         $subordinates_inter = array() ;


         for($k=0;$k<count($subordinates);$k++)
         {
            $subordinates_comma = $this->get_subordinates($subordinates[$k]) ;

            if(!empty($subordinates_comma))
           {  
            $subordinates_comma = explode( ',',$subordinates_comma[0]['SUBORDINATES']);
            $subordinates_inter = array_merge($subordinates_inter,$subordinates_comma) ; 
          }
         }//end of for($k=0;$k<count($subordinates);$k++)

         /*$subordinates = array_merge($subordinates,$subordinates_inter) ;*/
         $subordinates = $subordinates_inter   ;

         $reports_details = array() ; 
         for($i=0;$i<count($subordinates);$i++)
         {  
            $reports_details = array_merge($reports_details,$this->get_completed_reports_do($subordinates[$i])) ; 
         }//end of for()


         //pre($reports_details,1) ; 
        }


         else // in case of dc, jtcp,adcp and cp
        {
            //$reports_details = $this->get_reports_total_complete() ; 

        }

        /* else if($this->session->userdata('IS_DC')==1)
        {
          //call procedure for DO
        }



         else if($this->session->userdata('IS_JTCP')==1)
        {
          //call procedure for DO
        }

         else if($this->session->userdata('IS_ADCP')==1)
        {
          //call procedure for DO
        }

          else if($this->session->userdata('IS_CP')==1)
        {
          //call procedure for DO
        }*/




        $requests_by_id = $this->fetch_reports_forwarded_complete($ofid) ;
        //merging with previous subordinate do list
        $reports_details = array_merge($reports_details,$requests_by_id) ; 

        $data['title'] = 'View Completed requests';
        $action = "View Completed requests page opened";
        
        $data['reports_details'] = $reports_details ;
        $data['subview'] = $this->load->view('ViewcompletedRep', $data, true);
     


        $this->load->view('layout_main', $data);



    }//end of complete report fetch

public function view_report_details($RPID)

{
      $RPID = $RPID - 999999999 ;  //DECRYPT to original report id 
      $dummy = 1 ;
        
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reportdetails_by_real_id('$dummy','$RPID',:rc_out); end;";
        

          $requests = $this->{$this->model}->getRefCursor($query);


 if(!empty($requests)) 
   {  
      $reports_details = $requests ; 


       //$RPID =    $reports_details[0]['RP_ID'] ; 
       // get files to display
       
       $query = "BEGIN REPORTER.PKG_OFFICERS.get_download_path_report('$RPID',:rc_out); end;";
        $down_directory = $this->{$this->model}->getRefCursor($query);

        //print_r($down_directory) ;
        $filenames = array() ; 
        //read the directory to get the folder contents
        if(!empty($down_directory))
        {
          $dir = $down_directory[0]['FILE_PATH'];

          // Open a directory, and read its contents
          if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != "." && $file != "..") 
                    {
                        $filenames[] =  /*$dir."/".*/$file ;
                    }
              }//end of while
              closedir($dh);
            }
          }
        
     
        }//end ofif(!empty($down_directory)) 

         $SUP_OFIDS =  array_filter(explode(',',$reports_details[0]['SUP_OFIDS']) );


         for($i=0;$i<count($SUP_OFIDS);$i++)
         {
          $SUP_OFIDS[$i] = $this->get_of_name_by_id($SUP_OFIDS[$i])[0]['OF_NAME'] ; 
         }

         $reports_details[0]['SUP_OFIDS'] = ($SUP_OFIDS) ; 



         $reports_details[0]['OFID'] = $this->get_of_name_by_id($reports_details[0]['OFID'])[0]['OF_NAME'] ; 


         $OTHR_OFIDS =  array_filter(explode(',',$reports_details[0]['OTHR_OFIDS']) );


         for($i=0;$i<count($OTHR_OFIDS);$i++)
         {
          $OTHR_OFIDS[$i] = $this->get_of_name_by_id($OTHR_OFIDS[$i])[0]['OF_NAME'] ; 
         }

         $reports_details[0]['OTHR_OFIDS'] = ($OTHR_OFIDS) ; 

         $reports_details[0]['EVID'] = $this->get_event_name_by_id($reports_details[0]['EVID'])[0]['EVENT_NAME'] ; 

          for($i=0;$i<count($filenames);$i++)

           {  $filenames[$i] = base_url()."Filecontroller/get_file_contents_report/".$RPID."/".$filenames[$i] ; 
              }

         $reports_details[0]['FILE_PATH'] = ($filenames) ;    
          //pre($reports_details,1);
           /*array_multisort($price, SORT_DESC, $merged_array);
        $merged_array = array_unique($merged_array,SORT_REGULAR) ;*/
           
        $return['result'] = $reports_details;
        $return['status'] = True ; 


        }//END OF IF TRUE


        else
        {
            $return['result'] = [] ;
            $return['status'] = False ;
            $return['message'] ="Report Does not Exists !!"  ;
        }
            
        $data['title'] = 'View Report Details';
        $action = "View Report Details page opened";
        
        $data['reports_details'] = $return['result'] ;
        $data['subview'] = $this->load->view('ViewRepDetails', $data, true);
     


        $this->load->view('layout_main', $data);



    }//end of view_report_Details


}