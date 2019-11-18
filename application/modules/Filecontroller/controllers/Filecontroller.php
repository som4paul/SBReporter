  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filecontroller extends MY_Controller {
    
    function __construct(){
    	$this->module = 'Filecontroller';
    	$this->model = 'FilecontrollerM';
        parent::__construct($this->module);
       // loggedoutuser();
        $this->load->model($this->model);
        $this->load->helper('string');
	}


  public function get_file_contents_converse($RPID,$convid_temp,$filename){
      $this->load->helper('download');
      $RPID = ($RPID) ; 
      

      $filename =  ($filename) ; 

      //echo $reqid.$filename ; die ; 
      $query = "BEGIN REPORTER.PKG_OFFICERS.get_download_path_conv('$convid_temp',:rc_out); end;";
        $down_directory = $this->{$this->model}->getRefCursor($query);

        //print_r($down_directory) ;
        $filenames = array() ; 
        //read the directory to get the folder contents
        if(!empty($down_directory))
        {
          $dir = $down_directory[0]['CONV_FILE_PATH'];

          // Open a directory, and read its contents
          if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != "." && $file != ".." && $file==$filename) 
                    {
                        $filename =  $dir."/".$file ;
                        force_download($filename, NULL);
                    }
              }//end of while
              closedir($dh);
            }
          }
        
     
        }//end ofif(!empty($down_directory)) 

        


    }



  public function get_file_contents_report($RPID,$filename){
      $this->load->helper('download');
      $RPID = ($RPID) ; 

      $filename =  ($filename) ; 

      //echo $reqid.$filename ; die ; 
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
                if ($file != "." && $file != ".." && $file==$filename) 
                    {
                        $filename =  $dir."/".$file ;
                        force_download($filename, NULL);
                    }
              }//end of while
              closedir($dh);
            }
          }
        
     
        }//end ofif(!empty($down_directory)) 

        


    }


   
    public function get_file_contents($reqid,$filename){
      $this->load->helper('download');
      $reqid = ($reqid) ; 

      $filename =  ($filename) ; 

      //echo $reqid.$filename ; die ; 
      $query = "BEGIN REPORTER.PKG_OFFICERS.get_download_path('$reqid',:rc_out); end;";
        $down_directory = $this->{$this->model}->getRefCursor($query);

        //print_r($down_directory) ;
        $filenames = array() ; 
        //read the directory to get the folder contents
        if(!empty($down_directory))
        {
          $dir = $down_directory[0]['REQ_PATH'];

          // Open a directory, and read its contents
          if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != "." && $file != ".." && $file==$filename) 
                    {
                        $filename =  $dir."/".$file ;
                        force_download($filename, NULL);
                    }
              }//end of while
              closedir($dh);
            }
          }
        
     
        }//end ofif(!empty($down_directory)) 

        


    }

    public function get_download_contents(){

        $data = array();
        $REQID  = $this->input->post('REQID') ;
        //pre($posted_data,1) ; 
        
        
        $query = "BEGIN REPORTER.PKG_OFFICERS.get_download_path('$REQID',:rc_out); end;";
        $down_directory = $this->{$this->model}->getRefCursor($query);

        //print_r($down_directory) ;
        $filenames = array() ; 
        //read the directory to get the folder contents
        if(!empty($down_directory))
        {
          $dir = $down_directory[0]['REQ_PATH'];

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

        


         echo json_encode($filenames) ; 



    }//end of view requests



    public  function get_download_contents_report(){

      $data = array();
        $RPID  = $this->input->post('RP_ID') ;
        //pre($posted_data,1) ; 
        
        
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

        


         echo json_encode($filenames) ; 


    }





}