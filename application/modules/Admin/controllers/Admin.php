<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
    
    function __construct(){
        $this->module = 'Admin';
        $this->model = 'Adminm';
        parent::__construct($this->module);
        loggedoutuser();
        $this->load->model($this->model);
    }

    public function index() {
        $this->brodMsg();
    }

    public function brodMsg(){
        $data = array();
        $data['title'] = 'Broadcast Messages';
        $action = "Broadcast Messages Page Opened.";
        $query = "BEGIN PKG_ELECTION.getAllBroadcastMessages(:rc_out); end;";
        $data['brdcst_msg'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('BroadcastList', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function on_off(){
        $value = explode("|",myDecode(filterData('val')));
        if($value[1] == 'Y'){
            $value[1] = 'N';
        }
        else if($value[1] == 'N'){
            $value[1] = 'Y';
        }
        $cond = array(
            'MESSAGE_ID' => $value[0]
        );
        $set = array(
            'ON_OFF' => $value[1]
        );
        $res = $this->{$this->model}->setdbData('BROADCAST_MESSAGES',$set,$cond);
        $action = "Message ID. ".$value[0]." is Changed Successfully.";
        $this->{$this->model}->logEntry($action);
        echo $res;

    }

    public function cirMemo() {
        $data = array();
        $data['title'] = 'Circulars and Memos';
        $action = "Circulars and Memos Page Opened.";
        $query = "BEGIN PKG_ELECTION.getCirculars(:rc_out); end;";
        $data['cir_memo'] = $this->{$this->model}->getRefCursor($query);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('CirMemoList', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function address_book(){
        $data = array();
        $data['title'] = 'Address Book';
        $data['addBook'] = $this->{$this->model}->getdbData('ADDRESS_BOOK');
        $action = "Address Book Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('AddBookList', $data, true);
        $this->load->view('layout_main', $data);
    }

    public function addNewAddBook(){
        $data = array();
        $data['title'] = 'Address Book';
        $action = "Address Book Page Opened.";
        $data['con_cat'] = $this->{$this->model}->getdbData('CONTACT_CATEGORY');
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('AddNewAddBook', $data, true);
        $this->load->view('layout_main', $data);   
    }

    public function saveData($method){
        $postData = $this->input->post();
        $id = $postData['CONTACT_ID'];
        $cond = array('CONTACT_ID' => $id);
        unset($postData['CONTACT_ID']);
        $arr = array();
        foreach ($postData as $key => $value) {
            $arr[$key] = $value;
        }
        if($method == 'addNewAddBook'){
            $res = $this->{$this->model}->setdbData('ADDRESS_BOOK',$arr);
        } else if($method == 'editData'){
            $res = $this->{$this->model}->setdbData('ADDRESS_BOOK',$arr,$cond);
        }
        if($res && $method == 'addNewAddBook') {
            $this->session->set_userdata('flag','insert');
        } else if($res && $method == 'editData'){
            $this->session->set_userdata('flag','update');
        }
        redirect('Admin/address_book');
    }

    public function editData($id){
        $data = array();
        $data['title'] = 'Address Book';
        $action = "Address Book Page Opened.";
        $data['con_cat'] = $this->{$this->model}->getdbData('CONTACT_CATEGORY');
        $cond[0]['type'] = 'where';
        $cond[0]['cond'] = array('CONTACT_ID' => myDecode($id));
        $data['res'] = $this->{$this->model}->getdbData('ADDRESS_BOOK',$cond);
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('AddNewAddBook', $data, true);
        $this->load->view('layout_main', $data);   
    }

    public function addNew($method){
        $files = $_FILES;
        if($method == 'brodMsg'){
            $msg_title = filterData('MESSAGE_TITLE');
            $msg_title = (isset($msg_title) ? $msg_title : null);
            $msg_txt = filterData('MESSAGE_TEXT');
            $msg_txt = (isset($msg_txt) ? $msg_txt : null);
            $site = filterData('SITE_URL');
            $site = (isset($site) ? $site : null);
            $filename = $this->doUpload($method,$files);
            $file = (isset($filename) ? $filename : null);
            $query = "BEGIN PKG_ELECTION.addBroadcastMessage('$msg_title','$msg_txt','$site',null,'$file',:rc_out); end;";
        } else if($method == 'cirMemo'){
            $cir_title = filterData('CIRCULAR_TITLE');
            $cir_title = (isset($cir_title) ? $cir_title : null);
            $cir_txt = filterData('CIRCULAR_MESSAGE');
            $cir_txt = (isset($cir_txt) ? $cir_txt : null);
            $site = filterData('SITE_URL');
            $site = (isset($site) ? $site : null);
            $cir_no = filterData('CIRCULAR_NO');
            $cir_no = (isset($cir_no) ? $cir_no : null);
            $cir_date = toDbDate(filterData('CIRCULAR_DATE'));
            $cir_date = (isset($cir_date) ? $cir_date : null);
            $filename = $this->doUpload($method,$files);
            $file = (isset($filename) ? $filename : null);
            $query = "BEGIN PKG_ELECTION.addCirculars('$cir_title','$cir_txt','$site',null,'$file','$cir_no','$cir_date',:rc_out); end;";
        }
        $res = $this->{$this->model}->setRefCursor($query);
        if($res){
            $this->session->set_userdata('flag','insert');
        }
        if($method == 'brodMsg'){
            redirect('Admin/brodMsg');
        }else if($method == 'cirMemo'){
            redirect('Admin/cirMemo');
        }
    }

    public function edit($method){
        $files = $_FILES;
        if($method == 'brodMsg'){
            $msg_id = filterData('MESSAGE_ID');
            $msg_title = filterData('MESSAGE_TITLE');
            $msg_title = (isset($msg_title) ? $msg_title : null);
            $msg_txt = filterData('MESSAGE_TEXT');
            $msg_txt = (isset($msg_txt) ? $msg_txt : null);
            $msg_dt = filterData('MESSAGE_DATE');
            $msg_dt = (isset($msg_dt) ? toDbDate($msg_dt) : null);
            $site = filterData('SITE_URL');
            $site = (isset($site) ? $site : null);
            $exstngFlnm = filterData('FILE_URL');
            $show = filterData('ON_OFF');
            if($show == ''){
                $show = 'N'; 
            } else if($show == 'on'){
                $show = 'Y'; 
            }
            $filename = $this->doUpload($method,$files);
            $file = (isset($filename) ? $filename : $exstngFlnm);
            $query = "BEGIN PKG_ELECTION.editBroadcastMessage($msg_id,'$msg_title','$msg_txt','$msg_dt','$show','$site',null,'$file',:rc_out); end;";
        }else if($method == 'cirMemo'){
            $cir_id = filterData('CIRCULAR_ID');
            $cir_title = filterData('CIRCULAR_TITLE');
            $cir_title = (isset($cir_title) ? $cir_title : null);
            $cir_txt = filterData('CIRCULAR_MESSAGE');
            $cir_txt = (isset($cir_txt) ? $cir_txt : null);
            $site = filterData('SITE_URL');
            $site = (isset($site) ? $site : null);
            $cir_no = filterData('CIRCULAR_NO');
            $cir_no = (isset($cir_no) ? $cir_no : null);
            $cir_dt = filterData('CIRCULAR_DATE');
            $cir_dt = (isset($cir_dt) ? toDbDate($cir_dt) : null);
            $exstngFlnm = filterData('FILE_URL');
            $filename = $this->doUpload($method,$files);
            $file = (isset($filename) ? $filename : $exstngFlnm);
            $query = "BEGIN PKG_ELECTION.editCirculars($cir_id,'$cir_title','$cir_txt','$site',null,'$file','$cir_no','$cir_dt',:rc_out); end;";
        }else if($method == 'upload_imp_doc'){
            $doc_id = filterData('DOCUMENT_ID');
            $doc_dsc = filterData('DOCUMENT_DESC');
            $doc_dsc = (isset($doc_dsc) ? $doc_dsc : null);
            $exstngFlnm = filterData('FILE_NAME');
            $exstngFltyp = filterData('FILE_TYPE');
            $filename = $this->doUpload($method,$files);
            $param = explode(",",$filename);
            $filenm = (isset($filename) ? $param[0] : $exstngFlnm);
            $filetyp = (isset($filename) ? $param[1] : $exstngFltyp);
            $query = "BEGIN PKG_ELECTION.editImportantDocuments($doc_id,'$doc_dsc','$filenm','$filetyp',:rc_out); end;";
        }
        $res = $this->{$this->model}->setRefCursor($query);
        if($res){
            $this->session->set_userdata('flag','update');
        }
        if($method == 'brodMsg'){
            redirect('Admin/brodMsg');
        } else if($method == 'cirMemo'){
            redirect('Admin/cirMemo');
        } else if($method == 'upload_imp_doc'){
            redirect('Admin/upload_imp_doc');
        }
    }

    public function deleteContact(){
        $id = filterData('id');
        $cond = array('CONTACT_ID' => myDecode($id));
        $res = $this->{$this->model}->unsetdbData('ADDRESS_BOOK',$cond);
        echo $res;
    }

    public function deleteFile(){
        $id = filterData('id');
        $file = filterData('file');
        $query = "BEGIN PKG_ELECTION.deleteImportantDocuments($id,:rc_out); end;";
        $res = $this->{$this->model}->setRefCursor($query);
        if($res){
            unlink($this->config->item('upload_path').'documents/'.$file);
        }
        echo $res;
    }

    public function upload_imp_doc(){
        $data = array();
        $data['title'] = 'Upload Documents';
        $data['res'] = $this->{$this->model}->getdbData('IMPORTANT_DOCUMENTS');
        $action = "Upload Documents Page Opened.";
        $this->{$this->model}->logEntry($action);
        $data['subview'] = $this->load->view('upload', $data, true);
        $this->load->view('layout_main', $data);   
    }

    public function doUpload($method ='',$files='',$desc=''){
        if($method == '' || $method == 'upload_imp_doc'){
            $desc = filterData('DOCUMENT_DESC');
            $files = $_FILES;
        }
        if($method == 'brodMsg'){
            $folder = 'broadcasts';
        } elseif($method == 'cirMemo'){
            $folder = 'circulars';
        } elseif($method == '' || $method == 'upload_imp_doc'){
            $folder = 'documents';
        }
        $path = $this->config->item('upload_path');
        $config = array(
            'upload_path'          => $path.$folder,
            'allowed_types'        => 'gif|jpg|png|doc|DOC|docx|DOCX|xls|xlsx|XLSX|ppt|pptx|PPTX|pdf|csv|zip|rar',
            'overwrite'            => TRUE,
            'max_width'            => 1024*3
        );
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('uploadFile')){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            // pre($data,1);
            $filename = $_FILES['uploadFile']['name'];
            $filetype = $_FILES['uploadFile']['type'];
            if($method ==  ''){
                // echo 1;
                // echo $desc;
                // echo $filename;
                // echo $filetype;die;
                $query = "BEGIN PKG_ELECTION.addImportantDocuments('$desc','$filename','$filetype',:rc_out); end;";
                $res = $this->{$this->model}->setRefCursor($query);
                // echo $res;die;
            } elseif($method == 'brodMsg'){
                return $_FILES['uploadFile']['name'];
            } elseif($method == 'cirMemo'){
                return $_FILES['uploadFile']['name'];
            } elseif ($method == 'upload_imp_doc') {
                return $_FILES['uploadFile']['name'].",".$_FILES['uploadFile']['type'];
            }
            if($res){
                $this->session->set_userdata('up_flag','insert');
            }
            redirect('Admin/upload_imp_doc');
        }
    }

    public function run_all(){
        $ret = $this->{$this->model}->runprocedure();
        echo $ret;
    }
}
