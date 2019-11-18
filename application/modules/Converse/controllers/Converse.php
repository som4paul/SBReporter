  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Converse extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Converse';
    	$this->model = 'ConverseM';
        parent::__construct($this->module);
       // loggedoutuser();
        $this->load->model($this->model);
        $this->load->helper('string');
	}

 

 public function ViewConverse(){

  $RPID = filterdata('RP_ID') ;

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
  $data['rep_log_id'] = $this->get_reports_log_id($RPID) ; 
  $data['subview'] = $this->load->view('ViewConv', $data, true);
  $this->load->view('layout_main', $data);





 }




 public function Addconv(){

  $datafin = array() ; 
  $datafin['REPORT_ID'] = filterdata('REPORT_ID') ;
  $datafin['CONV_TEXT'] = filterdata('CONV_TEXT') ; 
  //pre($_SESSION,1) ; 
  $datafin['CREATED_BY'] = $this->session->userdata('OFID') ;
  $datafin['CREATED_BY_NAME']  = $this->session->userdata('USRNAME') ; 
  $datafin['REPORT_LOG_ID'] = $this->get_reports_log_id($datafin['REPORT_ID'])[0]['RP_LOG_ID'] ; 

  date_default_timezone_set('Asia/Kolkata');
         $cur_time = date("d-M-Y H:i")  ;

  $datafin['CREATED_DATE_TIME']  = $cur_time ; 
 // pre($datafin,1) ;
  //create the conversation attachment path and upload files 



         $query2 = "BEGIN REPORTER.PKG_OFFICERS.get_conv_id(:rc_out); end;";
         $rp_id = $this->{$this->model}->getRefCursor($query2);
        
         //echo($this->db->last_query()) ; 
         //pre($rp_id,1);
         date_default_timezone_set('Asia/Kolkata');
          $date = date('mdY', time());
         /*$posted_data['RP_LOG_ID'] = "CR/DO".$loggedin_id."/".$date."/".($rp_id[0]['NEXTVAL']+1);
         $posted_data['RP_PRESENT_STATUS'] = 'ONGOING';*/
         ///file upload process

        $upload_path = UPLOADVPATH_CONVERSE."/".$datafin['REPORT_ID']."/".($rp_id[0]['NEXTVAL']+1)/*."/".$date*/ ;  

        
        /*  */
      
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

          $datafin['CONV_FILE_PATH'] = $upload_path ; 
          //pre($posted_data,1) ;
        $avd_report_insert_row = array();   
        if (empty($data['error'])) {
                $datafin['CONV_FILE_PATH'] = $upload_path ;   
                /*$this->session->set_flashdata('suc_msg', 'New real estate added successfully');*/

                $this->{$this->model}->insert_conv($datafin) ;  
                redirect('Report/Ongoing_report_fetch') ;   
            }              
  
 }//end of function 


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


}//end of converse class