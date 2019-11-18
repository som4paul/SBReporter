<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends MY_Controller {
    
    function __construct(){
    	$this->module = 'API';
    	$this->model = 'APIM';
        parent::__construct($this->module);
       // loggedoutuser();
        $this->load->model($this->model);
        $this->load->helper('string');
	}
  

  //standalone API to insert full report or upload report for Advanced/covering
  public function Report_insert(){

    //$cipher= filterdata('cipher') ; 
    $posted_cov_rep = $this->input->post();

    $posted_data  = $posted_cov_rep ; 
   /* print_r($_FILES) ; 
    pre($posted_cov_rep,1) ;*/
    $mediate = array() ;  
    //insertion of other event type
        if(!empty($posted_data['OTHEREVENT'])){
          $event_name = $posted_data['OTHEREVENT'] ; 
          unset($posted_data['OTHEREVENT']) ; 
         $insert_id =  $this->{$this->model}->insert_event($event_name) ;
         
         $posted_data['EVID'] = $insert_id ; 
        } ; 

        //end of insertion of other event type

   /* print_r($_FILES) ; */
     foreach ($_FILES as $key => $value) {
          # code...

          $mediate['images']['name'][]= $value['name']  ;
          $mediate['images']['type'][] = $value['type']  ;
          $mediate['images']['tmp_name'][] = $value['tmp_name']  ;
          $mediate['images']['error'][] = $value['error']  ;
          $mediate['images']['size'][] = $value['size']  ;

        }


        $_FILES = $mediate ;

       /* pre($mediate,1) ; */

    //echo $posted_data['cipher'];  die ;


    if(trim($posted_data['cipher'],'"')=="SBREPORTER")/*&& !empty($mob)&& !empty($pass)*/
   {
      //$posted_data  = $this->input->post() ;
        $OTHR_OFIDS = $SUP_OFIDS= '' ; 
        $loggedin_id = $posted_data['RP_CREATED_BY'];

      /*  foreach ($posted_data as $key => $value) {
           # code...
          if($key=='OTHR_OFIDS')
          {
            for($i=0;$i<count($value);$i++)
            $OTHR_OFIDS.= $value[$i].",";
          }
         } //end of foreach*/

         //echo $OTHR_OFIDS ; 

         /*$posted_data['OTHR_OFIDS'] = $OTHR_OFIDS ; */
         

         /*$posted_data['RP_CREATED_BY']  = $loggedin_id ; */
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
         /*$posted_data['RP_TIME'] = ($posted_data['RP_TIME']) ; */
         $posted_data['SUP_OFIDS'] = $SUP_OFIDS;
         /*$posted_data['RP_TYPE'] = "ADVANCED";*/
        
          date_default_timezone_set('Asia/Kolkata');
         $posted_data['RP_CREATEDON'] = date("d-M-Y H:i") ; 


         
         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_report_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());

        if(trim($posted_data['RP_TYPE'],'"') == "ADVANCED")  
         {$posted_data['RP_LOG_ID'] = "AR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);
            }


            else
            {
              $posted_data['RP_LOG_ID'] = "CR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);

            }
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
                   $return['message'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                }
            }

           

          $posted_data['FILE_PATH'] = $upload_path ;  
          //pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                $posted_data['FILE_PATH'] = $upload_path ;   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/
            /*$return['result'] = array() ;*/
            unset($posted_data['cipher']) ;

            //remove_quotes
            foreach ($posted_data as $key => $value) {
              # code...
              $posted_data[$key] = trim($value,'"');
            }


            $this->{$this->model}->insert_adv_report($posted_data) ;  
            $return['status'] = True ;
            $return['message'] = "Report Upload Successfull !";
                
                   
            }                

      }//end of if


   else{ 
            $return['result'] = print_r($posted_data) ; 
            $return['status'] = False ;
            $return['message'] = "Report Upload Failed !!";
      } 
      echo json_encode($return) ; 





  }

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

  public function get_events(){
    $return = array() ; 
    $cipher= $this->input->post('cipher',true) ;     

    //error_reporting(E_ALL);
    /*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
      $query = "BEGIN REPORTER.PKG_OFFICERS.get_events(:rc_out); end;";
        $prog_type = $this->{$this->model}->getRefCursor($query);
          $return['result'] =$prog_type ; 
        }

      else{
            $return['status'] = False ;
      } 
      echo json_encode($return) ;

  }//enbd of get_events()
  public function get_ac_names() {

    $cipher= $this->input->post('cipher',true) ;     

    //error_reporting(E_ALL);
    /*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.officers_ac(:rc_out); end;";
     $return['result'] = $this->{$this->model}->getRefCursor($query);

      
      $return['status'] = True ;

      }

      else{
            $return['status'] = False ;
      } 
      echo json_encode($return) ;
  }//end of get_oc_names



   public function get_dc_names() {

    $cipher= $this->input->post('cipher',true) ;     

    //error_reporting(E_ALL);
    /*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.officers_dc(:rc_out); end;";
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

public function get_superiors_do(){
$cipher= $this->input->post('cipher',true) ;     
$do_id= $this->input->post('doid', true);
    //error_reporting(E_ALL);
    /*$this->loadlist();*/

     /*print_r($cipher) ;  die ; */


   if($cipher=="SBREPORTER")
   {
    $query = "BEGIN REPORTER.PKG_OFFICERS.get_superiors_do('$do_id',:rc_out); end;";
     $return['result'] = $this->{$this->model}->getRefCursor($query);

      
      $return['status'] = True ;

      }

      else{
            $return['status'] = False ;
      } 
      echo json_encode($return) ;

}


public  function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => '*',
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





//ongoing report fetch 

 public function Ongoing_report_fetch(){

        $data = array();
        $reports_details = array() ; 

        $cipher  =$this->input->post('cipher',true) ;
        //pre($posted_data,1) ; 
        $ofid = $this->input->post('OFID',true)  ; 
        //pre($this->input->post(),1) ; 

  if($cipher=="SBREPORTER")
   {
        if($this->input->post('IS_DO',true)==1)
        {
            //call procedure for do

          $reports_details = $this->get_reports_do_api($ofid) ; 

         //pre($reports_details,1) ; 
        }

        else if($this->input->post('IS_OC',true)==1)
        {
          //call procedure for DO

         $subordinates =  $this->get_subordinates($ofid) ; 
         

         $subordinates = explode( ',',$subordinates[0]['SUBORDINATES']); 
         $reports_details = array() ; 
         for($i=0;$i<count($subordinates);$i++)
         {  
            $reports_details = array_merge($reports_details,$this->get_reports_do_api($subordinates[$i])) ; 
         }//end of for()

         // pre($reports_details,1) ; 

        }
        else if($this->input->post('IS_AC',true)==1)
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
            $reports_details = array_merge($reports_details,$this->get_reports_do_api($subordinates[$i])) ; 
         }//end of for()


         //pre($reports_details,1) ; 
        }


        //else part for superior higher officials


        else // in case of dc, jtcp,adcp and cp
        {
            //$reports_details = $this->get_reports_total_ongoing() ; 
             
        }
      /*   else if($this->input->post('IS_DC')==1)
        {
          //call procedure for DO
        }



         else if($this->input->post('IS_JTCP')==1)
        {
          //call procedure for DO
        }

         else if($this->input->post('IS_ADCP')==1)
        {
          //call procedure for DO
        }

          else if($this->input->post('IS_CP')==1)
        {
          //call procedure for DO
        }
*/


        //finally run the procedure to get the reports if assigned to

        $requests_by_id = $this->fetch_reports_forwarded_api($ofid) ;
        //merging with previous subordinate do list
        $reports_details = array_merge($reports_details,$requests_by_id) ; 

        //trimming and manipulating $report_details as per requirement 

        $final_array = array() ; 
        $merged_array = array() ; 

        for($i=0;$i<count($reports_details);$i++)
        {
           foreach ($reports_details[$i] as $key => $value) {
             # code...

            if($key=='RP_ID'||$key=='RP_TYPE'||$key=='RP_LOG_ID'||$key=='RP_PRIORITY'||$key=='EVENT_NAME'||$key=='RP_CREATEDON'||$key=='OF_NAME' )
            {
              $final_array[$key] = $value ; 
            }//end of if
           }//end of foreach()

           $merged_array[] = $final_array ; 
        }//end of for()
        $price = array() ; 
        /*$price = array_column($merged_array, 'RP_CREATEDON'); */ 
        foreach ($merged_array as $key => $row)
                {
                    $price[$key] = $row['RP_ID'];
                }

                

        array_multisort($price, SORT_DESC, $merged_array);
        $merged_array = array_unique($merged_array,SORT_REGULAR) ;
           
        $return['result'] = array_values($merged_array);
        $return['status'] = True ; 
     


       
      } //end of if cipher 

    else{ 
            $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Report fetch failed !!";
      } 
      echo json_encode($return) ; 

    }//end of Ongoing_report_fetch()


    //ongoing report fetch 

 public function reportdetails_by_id(){

        $data = array();
        $reports_details = array() ; 

        $cipher  =$this->input->post('cipher',true) ;
        //pre($posted_data,1) ; 
        $rpid = $this->input->post('RPID',true)  ; 

        //echo $rpid ; die; 
        //pre($this->input->post(),1) ; 

  if($cipher=="SBREPORTER")
   {
        
        $dummy = 1 ;
        
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_reportdetails_by_id('$dummy','$rpid',:rc_out); end;";
        

          $requests = $this->{$this->model}->getRefCursor($query);

 if(!empty($requests)) 
   {  
      $reports_details = $requests ; 


       $RPID =    $reports_details[0]['RP_ID'] ; 
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


         $result = $this->get_of_name_by_id($reports_details[0]['OFID']) ; 

         if(!empty($result))
         {
         $reports_details[0]['OFID'] =$result[0]['OF_NAME'] ; 
          }

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


       
      } //end of if cipher 

    else{ 
            $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Report fetch failed !!";
      } 
      echo json_encode($return) ; 

    }//end of REPORT DETIALS ()



 public function view_conversation(){


  $cipher  =$this->input->post('cipher',true) ;
  $RPID = filterdata('RPID') ;


if($cipher=="SBREPORTER")
   {
     
  //echo $RPID ; die() ; 
  $data = array() ;
  $data['RPID'] = $RPID ;  
  $query = "BEGIN REPORTER.PKG_OFFICERS.get_conv_dets('$RPID',:rc_out); end;";
  $data['Convdets']  = $this->{$this->model}->getRefCursor($query);
  /*pre($data,1)  ;*/
  //iterating the conversation array 


for($k=0;$k<count($data['Convdets']);$k++)
{ $convid_temp = $data['Convdets'][$k]['CONV_ID'] ; 
  foreach ($data['Convdets'][$k] as $key => $value) {


    if($key=='CONV_FILE_PATH'){
        /*echo $value ; die;*/ 
        $down_directory = $value;

        //print_r($down_directory) ;
        $filenames = array() ; 
        //read the directory to get the folder contents
        if(!empty($down_directory))
        {
          $dir = $value;

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
    

     for($i=0;$i<count($filenames);$i++)

           {  $filenames[$i] = base_url()."Filecontroller/get_file_contents_converse/".$RPID."/".$convid_temp."/".$filenames[$i] ; 
              }

         


    }//end of if CONV_FILE_PATH
    # code...
  }//end of foreach()
   $data['Convdets'][$k]['file_path'] = $filenames;
}//end of outermost for()

  //pre($data,1)    ;
 // $data['rep_log_id'] = $this->get_reports_log_id($RPID)[0]['RP_LOG_ID'] ; 
  /*$data['subview'] = $this->load->view('ViewConv', $data, true);
  $this->load->view('layout_main', $data);
*/       
    unset($data['RPID']);  
     if(!empty($data['Convdets']))
            {
            $return['result'] = $data ; 
            $return['status'] = True ;
            $return['message'] = "Conversation fetched successfully !!";
            }



            else
            {
            $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Empty Conversation fetched !!";

            }
 } //end of if cipher 

    else{ 
            $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Conversation fetch failed !!";
      } 
      echo json_encode($return) ; 




 }  //end of view_conversaton   

public function mark_complete(){

  $cipher  =$this->input->post('cipher',true) ;
  $RPID = filterdata('RPID') ;
  $do_id = filterdata('OFID') ;

if($cipher=="SBREPORTER")
   {

  /*$RP_ID = filterdata('RP_ID') ; //SELECTED REPORT ID FROM DROPDOWN*/
  //UPDATE REQUEST TABLE FOR COMPLETION
  /*$do_id = $this->session->userdata('OFID') ;*/
         date_default_timezone_set('Asia/Kolkata');
         $cur_time = date("d-M-Y H:i")  ; 
    $upd_array = array("RP_COMPLETED_BY"=>$do_id,"RP_COMPLETE_TIME"=>$cur_time,"RP_PRESENT_STATUS"=>'COMPLETE');

    //run the update query
    $this->db->where('RP_ID',$RPID) ;
    $this->db->update('REPORT',$upd_array) ; 



    /*$upd_array2 = array("RP_REQ_ID"=>$REQID);
    //update the REPORT table with the corresponding request ID
    $this->db->where('RP_ID',$RP_ID) ;
    $this->db->update('REPORT',$upd_array2) ;*/

        if($this->db->affected_rows()>0)
        {
                    //$return['result'] = $data ; 
                    $return['status'] = True ;
                    $return['message'] = "Report Mark completed !!";
         }  

         else
         {
            $return['status'] = False ;
            $return['message'] = "No further Update Possible !!";
         } 
  }//end of if 

  else{ 
           // $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Report Mark complete Failed !!";
      } 
      echo json_encode($return) ; 



 }//end of close_report


//Completed report fetch 
public function complete_report_fetch(){

       $data = array();
        $reports_details = array() ; 

        $cipher  =$this->input->post('cipher',true) ;
        //pre($posted_data,1) ; 
        $ofid = $this->input->post('OFID',true)  ; 
        //pre($this->input->post(),1) ; 

  if($cipher=="SBREPORTER")
   {
      

        if($this->input->post('IS_DO')==1)
        {
            //call procedure for do

          $reports_details = $this->get_completed_reports_do($ofid) ; 

         //pre($reports_details,1) ; 
        }

        else if($this->input->post('IS_OC')==1)
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
        else if($this->input->post('IS_AC')==1)
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

       //trimming and manipulating $report_details as per requirement 

        $final_array = array() ; 
        $merged_array = array() ; 

        for($i=0;$i<count($reports_details);$i++)
        {
           foreach ($reports_details[$i] as $key => $value) {
             # code...

            if($key=='RP_ID'||$key=='RP_TYPE'||$key=='RP_LOG_ID'||$key=='RP_PRIORITY'||$key=='EVENT_NAME'||$key=='RP_CREATEDON'||$key=='OF_NAME'/*||$key=='RP_COMPLETED_BY'||$key=='RP_COMPLETE_TIME'*/ )
            {
              $final_array[$key] = $value ; 
            }//end of if
           }//end of foreach()

           $merged_array[] = $final_array ; 
        }//end of for()
        $price = array() ; 
        /*$price = array_column($merged_array, 'RP_CREATEDON'); */ 
        foreach ($merged_array as $key => $row)
                {
                    $price[$key] = $row['RP_ID'];
                }

                

        array_multisort($price, SORT_DESC, $merged_array);
        $merged_array = array_unique($merged_array,SORT_REGULAR) ;
           
        $return['result'] = array_values($merged_array);
        $return['status'] = True ; 
     


       
      } //end of if cipher 

    else{ 
            $return['result'] = [] ; 
            $return['status'] = False ;
            $return['message'] = "Report fetch failed !!";
      } 
      echo json_encode($return) ; 



    }//end of complete report fetch

}//end of API class
