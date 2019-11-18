  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Request';
    	$this->model = 'RequestM';
        parent::__construct($this->module);
       // loggedoutuser();
        $this->load->model($this->model);
        $this->load->helper('string');
	}


public function Reqedit(){


   $posted_data  = $this->input->post() ;
   //pre($posted_data,1);
        $OTHR_DOIDS = $SUP_DOIDS= '' ; 
         

        foreach ($posted_data as $key => $value) {
           # code...
          if($key=='REQ_TO')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_DOIDS.= $value[$i].",";
          }
         } //end of foreach

         //echo $OTHR_OFIDS ; 

         $posted_data['REQ_TO'] = $OTHR_DOIDS ; 
         /*pre ($posted_data,1);*/
         $loggedin_id =  $this->session->userdata('OFID') ; 

         $posted_data['REQ_BY']  = $loggedin_id ; 
         
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['REQ_AT'] = date("d-M-Y H:i")  ; 
         $posted_data['REQ_STATUS'] = 'OPEN';
        
        
         
         


         
         /*$query2 = "BEGIN REPORTER.PKG_OFFICERS.get_req_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);*/
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         /*$posted_data['REQ_LOG_NAME'] = "REQ/SU".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);*/
         
         ///file upload process

         $upload_path = $posted_data['REQ_PATH'] ;
        
         
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

           

          //$posted_data['REQ_PATH'] = $upload_path ;  
         // pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                /*$posted_data['REQ_PATH'] = $upload_path ;*/   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/
                //pre($posted_data,1);
                $this->{$this->model}->update_sup_request($posted_data) ;  
                redirect('Dashboard/index');    
            }              

        


}//end of Reqedit
public function ReqeditV(){

        $supid = $this->session->userdata('OFID') ; 
        $data['title'] = 'Edit Request';
        $action = "Edit Report requests page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reqinq_sup('$supid',:rc_out); end;";
        $requests = $this->{$this->model}->getRefCursor($query);


        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

        $data['requests'] = $requests ;
        $data['subview'] = $this->load->view('ReqeditV', $data, true);
        $this->load->view('layout_main', $data);

}
public function ReqV(){
        $data = array();
        
        //pre($posted_data,1) ; 
        $supid = $this->session->userdata('OFID') ; 
        $data['title'] = 'View Report requests';
        $action = "View Report requests page opened";
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reqinq_sup('$supid',:rc_out); end;";
        $requests = $this->{$this->model}->getRefCursor($query);
        $data['requests'] = $requests ;
        $data['subview'] = $this->load->view('Viewsupreq', $data, true);
     


        $this->load->view('layout_main', $data);
}  

public function close_request(){
  $REQID = filterdata('REQID') ;
  $RP_ID = filterdata('RP_ID') ; //SELECTED REPORT ID FROM DROPDOWN
  //UPDATE REQUEST TABLE FOR COMPLETION
  $do_id = $this->session->userdata('OFID') ;
  $this->db->select('REQ_COM_BY') ; 
  $this->db->where('REQID',$REQID) ;
  $get_req_completedby_ids = $this->db->get('REQUEST') ;
  $get_req_completedby_ids  = $get_req_completedby_ids->result_array() ; 

  

  if(!empty($get_req_completedby_ids[0]['REQ_COM_BY']))
      {//concatenate the DO id to existing resultset

        $updated_data = $get_req_completedby_ids[0]['REQ_COM_BY'].$do_id."," ; 
      } 

      else
      {
        $updated_data = $do_id."," ; 
      }
    /*echo $updated_data; die;  */
    $upd_array = array("REQ_COM_BY"=>$updated_data,"REQ_STATUS"=>"PARTIALLY-COMPLETE");

    //run the update query
    $this->db->where('REQID',$REQID) ;
    $this->db->update('REQUEST',$upd_array) ; 



    $upd_array2 = array("RP_REQ_ID"=>$REQID,"RP_PRESENT_STATUS"=>"COMPLETE");
    //update the REPORT table with the corresponding request ID
    $this->db->where('RP_ID',$RP_ID) ;
    $this->db->update('REPORT',$upd_array2) ;



    return TRUE ;


}  

public function Reqc(){
        $data = array();
        /*$posted_data  = $this->input->post() ;
        //pre($posted_data,1) ; */





        $data['title'] = 'Request Generation';
        $action = "Request Generartion page opened";
        

        $query3 = "BEGIN REPORTER.PKG_OFFICERS.officers_do(:rc_out); end;";
        $data['do_name'] = $this->{$this->model}->getRefCursor($query3);

       
       
        $data['subview'] = $this->load->view('reqpg1', $data, true);


     

        $this->load->view('layout_main', $data);



  }

public function Reqin(){


        $posted_data  = $this->input->post() ;
        $OTHR_DOIDS = $SUP_DOIDS= '' ; 
         

        foreach ($posted_data as $key => $value) {
           # code...
          if($key=='REQ_TO')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_DOIDS.= $value[$i].",";
          }
         } //end of foreach

         //echo $OTHR_OFIDS ; 

         $posted_data['REQ_TO'] = $OTHR_DOIDS ; 
         /*pre ($posted_data,1);*/
         $loggedin_id =  $this->session->userdata('OFID') ; 

         $posted_data['REQ_BY']  = $loggedin_id ; 
         
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['REQ_AT'] = date("d-M-Y H:i")  ; 
         $posted_data['REQ_STATUS'] = 'OPEN';
        
        
         
         


         
         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_req_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         $posted_data['REQ_LOG_NAME'] = "REQ/SU".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);
         
         ///file upload process

         $upload_path = UPLOADVPATH_REQUEST."/".$loggedin_id ."/".$date."/".($rp_id[0]['NEXTVAL']+1) ;
        
         
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

           

          //$posted_data['REQ_PATH'] = $upload_path ;  
         // pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                $posted_data['REQ_PATH'] = $upload_path ;   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/

                $this->{$this->model}->insert_sup_request($posted_data) ;  
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

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
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

        $query5 = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
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


}