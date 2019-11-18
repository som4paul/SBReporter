<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends MY_Controller {
    
    function __construct(){
        $this->module = 'Master';
        $this->model = 'Masterm';


        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
        $this->load->library('Firebase') ; 
        $this->load->library('Push') ;
        $this->load->library("phpmailer_library");
        
    }



public function send_mcc_email(){


        $cid = filterData('cid') ; 
        $res = 0 ; 
        $action = "New email Initiated ! for complaint# - ".$cid;

        //EMAIL-IDS

        $query = "BEGIN pc2019.PKG_MCC.getEmailIDs('$cid',:rc_out); end;";
        $source_data = $this->{$this->model}->getRefCursor($query);
        $id  = $source_data; 
        $email_ids = array() ; 
        foreach ($id as $key => $value) {
            # code...

            $email_ids[]= $value['EMAIL'] ; 
        }

        
        //if email ids are fetched 
        //echo 'email-id pre-fetch ' ; 
        if(!empty($email_ids))
             {  
                //echo"email-id non blank" ; 


                //send final email
                $subject  = "New complain has been added with complaint No. -".$cid ; 

                $message = "<html>
                            <head>
                            <title>New Complaint added</title>
                            </head>
                            <body>
                            <p align='left'>01(one) New Complaint #".$cid." has been endorsed to you for enquiry report/action. The same may be replied by- ".$this->get_reply_datetime($cid)."                
                            <p>Regards,<br>Election Cell, <br>Kolkata Police</p>
                            </body>
                            </html>" ;
                 //fetching attachments to send via email--->
                 

        $attach =1 ;  //attachment flag                    
        $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID('$cid',:rc_out); end;";
        $document_name = $this->{$this->model}->getRefCursor($query);
        $docs_as_attachments = array() ; 
        
            foreach ($document_name as $key => $value) {
                
              $docs_as_attachments[] =   '/var/www/html/uploads/ems/mcc/'.
                $value['DOCUMENT_NAME'] ; 
            }//end of foreach

         
               
                //print_r($docs_as_attachments) ; die ; 

            //echo APPPATH.'third_party/test.pdf' ; die ;
          /*  for($u=0;$u<(count($docs_as_attachments));$u++)    
            {*/    
                $resp = $this->sendMail_phpmailer($email_ids,$subject,$message,$docs_as_attachments );
                
           // }//end of for()



                      /* $resp =      $this->sendMail($email_ids,$subject,$message);*/

                       
                       //echo APPPATH.'third_party/test.pdf' ;
                        //print_r($email_ids) ; print_r($resp) ; 
                         

                       /* if(!empty($resp))
                        { */                           
                        $action.= "e-mail sent successfully corresponding to complain# -".$cid;

                        $log_stat = $this->save_email_log($cid);
                        $res = 1 ;  
                        //}//if valid response is returned from mail function

                                /*else
                                {
                                    $action.= "e-mail sending failed corresponding to complain# -".$cid;
                                     $res = 0 ; 
                                }// email sent failed !!*/ 

               }



               else  

               {

                //echo"email-id blank" ; 
                 $action.= "e-mail sending failed corresponding to complain# -".$cid;
                    $res = 0 ; 
   
               }     

                       
             $this->{$this->model}->logEntry($action);
                echo $res ; 


}

public function send_mcc_notification(){
        $cid = filterData('cid') ; 

        $action = "New notification Initiated ! for complaint# - ".$cid;

        //FCM-TOKEN IDS

        $query = "BEGIN pc2019.PKG_MCC.getFCMTokens('$cid',:rc_out); end;";
        $source_data = $this->{$this->model}->getRefCursor($query);
        $id  = $source_data; 
        $fcms = array() ; 
        foreach ($id as $key => $value) {
            # code...

            $fcms[]= $value['FCM_TOKEN'] ; 
        }

        /*$res = $this->send_mcc_main($cid) ; */
        
        $mess = "01(one) New Complaint #".$cid." has been endorsed to you for enquiry report/action. The same may be replied by- "./*toDbDateTime($this->get_reply_datetime($cid))*/$this->get_reply_datetime($cid)." - Regards. Election Cell, Kolkata Police.";

        //echo $mess; die ; 
        $res = send_mcc_stack_base($cid,$mess,$fcms) ; 
           
            
        /// $res=1 successs and 0= failure
        $json_parsed = (json_decode($res));
         

        //print_r($json_parsed) ; echo $json_parsed->success ; die;


            //save_notif_log
        if($json_parsed->success!=0)
                {$action.= $action.= "notification sent successfully corresponding to complain#-".$cid;

                        $log_stat = $this->save_notif_log($cid); 

                        //echo $log_stat ; die ; 

                    //updating log database
                    }//notification sent
                        else
                        {
                            $action.= $action.= "notification sent Failed corresponding to complain#-".$cid;

                        }
        $this->{$this->model}->logEntry($action);
        echo $res ; 
     


}





public function get_polpt(){
        $data = array();
        $comppolpt = array() ; 
        $data['title'] = 'Complaint_source';
        $action = "All Political Parties Fetched";
        $query = "BEGIN pc2019.PKG_MCC.getAllParties(:rc_out); end;";
        $polpt_data = $this->{$this->model}->getRefCursor($query);

        

        foreach($polpt_data as $key => $cpolpt){


            $comppolpt[] = $cpolpt ;
           
        }

        //print_r($compmode) ; die ; 
        $data['allDetails'] = $comppolpt;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('cspolpt', $data, true);
        $this->load->view('layout_main', $data);
    }


public function get_complaint_source(){
        $data = array();
        $compmode = array() ; 
        $data['title'] = 'Complaint_source';
        $action = "All Complaint Sources Fetched";
        $query = "BEGIN pc2019.PKG_MCC.getAllSources(:rc_out); end;";
        $source_data = $this->{$this->model}->getRefCursor($query);

        

        foreach($source_data as $key => $csd){


            $compsrc[] = $csd ;
           
        }

        //print_r($compmode) ; die ; 
        $data['allDetails'] = $compsrc;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('csrclist', $data, true);
        $this->load->view('layout_main', $data);
    }


public function get_complaint_nature(){
        $data = array();
        $compmode = array() ; 
        $data['title'] = 'Complaint_nature';
        $action = "All Complaint Natures Fetched";
        $query = "BEGIN pc2019.PKG_MCC.getAllNatures(:rc_out); end;";
        $nature_data = $this->{$this->model}->getRefCursor($query);

        

        foreach($nature_data as $key => $cna){


            $compnat[] = $cna ;
           
        }

        //print_r($compmode) ; die ; 
        $data['allDetails'] = $compnat;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('cnatlist', $data, true);
        $this->load->view('layout_main', $data);
    }

public function get_complaint_mode(){
        $data = array();
        $compmode = array() ; 
        $data['title'] = 'Complaint_mode';
        $action = "All Complaint Modes Fetched";
        $query = "BEGIN pc2019.PKG_MCC.getAllModes(:rc_out); end;";
        $mode_data = $this->{$this->model}->getRefCursor($query);

        

        foreach($mode_data as $key => $cmd){


            $compmode[] = $cmd ;
           
        }

        //print_r($compmode) ; die ; 
        $data['allDetails'] = $compmode;
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('cmdlist', $data, true);
        $this->load->view('layout_main', $data);
    }



  public function addmode_save(){
  		$p_mode = filterData('p_mode') ; 

  		$action = "New complaint Mode Addition Initiated ! for complaint - ".$p_mode;

  		$p_mode = (isset($p_mode) ? $p_mode : null);
            $query = "BEGIN pc2019.PKG_MCC.addMode('$p_mode',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        
        /// $res=1 successs and 0= failure
        if($res==1)
        {
        	$action.= "complaint Mode ".$p_mode."Added successfully !";
        }

        		else
        		{
        			$action.= "complaint Mode ".$p_mode."Addition Failed !";
        		}
       		 $this->{$this->model}->logEntry($action);
        		echo $res ; 
     
       
  } // end of ad-mode save


  public function addnature_save(){
  		$p_nature = filterData('p_nature') ; 

  		$action = "New complaint Nature Addition Initiated ! for complaint - ".$p_nature;

  		$p_nature = (isset($p_nature) ? $p_nature : null);
            $query = "BEGIN pc2019.PKG_MCC.addNature('$p_nature',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        
        /// $res=1 successs and 0= failure
        if($res==1)
        {
        	$action.= "complaint Nature ".$p_nature."Added successfully !";
        }

        		else
        		{
        			$action.= "complaint Nature ".$p_nature."Addition Failed !";
        		}
       		 $this->{$this->model}->logEntry($action);
        		echo $res ; 
     
       
  } // end of ad-mode save
 



  public function addsource_save(){
        $p_source = filterData('p_source') ; 

        $action = "New complaint Nature Addition Initiated ! for complaint - ".$p_source;

        $p_source = (isset($p_source) ? $p_source : null);
            $query = "BEGIN pc2019.PKG_MCC.addSource('$p_source',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        
        /// $res=1 successs and 0= failure
        if($res==1)
        {
            $action.= "complaint Nature ".$p_source."Added successfully !";
        }

                else
                {
                    $action.= "complaint Nature ".$p_source."Addition Failed !";
                }
             $this->{$this->model}->logEntry($action);
                echo $res ; 
     
       
  } // end of ad-mode save




  // ADD POLITICAL PARTY 



  public function addpolpt_save(){
        $p_polpt = filterData('p_polpt') ; 

        $action = "New Political Party Addition Initiated ! for Party - ".$p_polpt;

        $p_polpt = (isset($p_polpt) ? $p_polpt : null);
            $query = "BEGIN pc2019.PKG_MCC.addParty('$p_polpt',:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        
        /// $res=1 successs and 0= failure
        if($res==1)
        {
            $action.= "Political Party ".$p_polpt."Added successfully !";
        }

                else
                {
                    $action.= "Political Party ".$p_polpt."Addition Failed !";
                }
             $this->{$this->model}->logEntry($action);
                echo $res ; 
     
       
  } // end of ad-mode save




}// end of master controller

