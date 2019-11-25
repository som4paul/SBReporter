<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
    function qry($flag = false) {
        $CI =& get_instance();
        echo $CI->db->last_query();
        if($flag == '1')
            die;
    }




 function send_mcc_stack_base($cid=1,$mess,$id = array('fCEMTVdRQmM:APA91bFzr79OjxKyj4V4veTJBpMQyC4IDJLkgYWCIHdFYZC4FVAUHhGR8EBt1Ffq9aid5P50_XX9amMkC9Mp9FRz9LL4DiR9_iyo21g4tBzJfDCAoM5y2fdPRLKLjVSPv0J1mewED6gT',
    'ehO8LBIsQi8:APA91bGRZ3Jj6ONfRac7BZGHrO20eits1FHBCFlClS00zLpqf007okCx85TcHq1NeNb6MnqrJj3WAoxhfibI-KHYn_Tq5S24-dNX60zZWJK5WiOqwYnhlw0Nx0EI0im3HCZ0uW2BewJY',

    'cfhhgH3YsWI:APA91bHMF5YwIkFk6r45Gk2-SjBnJ7KU7Gg3gWxT8njuw4elfCXlbhUXgsnoQ6SC6LCYYVfuejsLz12FkusLhs3np1U6EHQDiTZiPmC2HDEGXqsEHXHtf5ggmCHKrVuUnqv5KrUB9SDv') ){

//FCM-TOKEN IDS
$id ;


$key = "AAAAsGkyK1w:APA91bGHSfyHwWaOSGrXdNAkSZqcqpbdICtyKmVzyw130seFmocWrw37gG5C3txHKMnka42kV8i3CdM9UEged0G214CQ8sbgZKqdvCDniXnfyi4c1BgV8Zj5OyMIz_qOQgIXBmq0OtFm";


//Message has been sent
/*$mess = "1 new MCC Complain has been registered with complain id :- ".$cid."...Election Cell KP";*/


 

$url = 'https://fcm.googleapis.com/fcm/send';
$fields = array (
        'registration_ids' => $id,
        'notification' => array (
                "body" => $mess,
                "title" => "Title",
                "icon" => "myicon"
        )
);
$fields = json_encode ( $fields );
$headers = array (
        'Authorization: key=' . $key,
        'Content-Type: application/json'
);

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, true );
curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

$result = curl_exec ( $ch );
curl_close ( $ch );

return $result ; 

}


    function pre($data, $flag = false) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if($flag == '1')
            die;
    }
    function create_guid() {
        $microTime = microtime();
        list($a_dec, $a_sec) = explode(" ", $microTime);
        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);
        ensure_length($dec_hex, 5);
        ensure_length($sec_hex, 6);
        $guid = "";
        $guid .= $dec_hex;
        $guid .= create_guid_section(3);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= create_guid_section(6);
        return $guid;
    }
    function ensure_length(&$string, $length) {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }
    function create_guid_section($characters) {
        $return = "";
        for ($i = 0; $i < $characters; $i++) {
            $return .= dechex(mt_rand(0, 15));
        }
        return $return;
    }
    function loggedinuser(){
        $CI =& get_instance();
        if(!empty($CI->USRNAME) && !empty($CI->USRTYPE)) {
            redirect('Dashboard');
        }
    }
    function loggedoutuser(){
        $CI =& get_instance();
        if(empty($CI->USRNAME) || empty($CI->USRTYPE)) {
            echo "<script>window.parent.location.href='".base_url()."'</script>";exit;
        }
    }
    function getMoneyFormat($data,$symbol = false){
        setlocale(LC_MONETARY,"en_IN");
        $ret = money_format("%!i", $data);
        if($symbol){
            $ret = "<i class='fa fa-inr'></i>".money_format("%!i", $data);
        }
        return $ret;
    }
    function getUnitnameByUnitcode($unitcode){
        $CI =& get_instance();
        $CI->db->select('UNITNAME');
        $CI->db->where ('UNITCODE',$unitcode);
        $query = $CI->db->get('MTO_UNITS');
        return $query->row()->UNITNAME;
    }
    function get_real_ip_addr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    function myEncode($str){
        $CI =& get_instance();
        $str = $CI->encrypt->encode($str,$CI->config->item('encryption_key'));
        $str = strtr($str, '+/=', '-_~');
        return $str;
    }
    function myDecode($str){
        $CI =& get_instance();
        $str = strtr($str, '-_~', '+/=');
        try {
            $str = $CI->encrypt->decode($str,$CI->config->item('encryption_key'));
        } catch(Exception $e) {
            $str = '';
        }
        return $str;
    }
    function toDisplayDate($dt, $format = 'd/m/Y'){
        $dt = str_replace("/","-",$dt); // to convert dd-mm-yyyy date format
        if($dt == '') return '';
        return date($format,strtotime($dt));
    }
    function toDbDate($dt, $format = 'd-M-Y'){
        $dt = str_replace("/","-",$dt); // to convert dd-mm-yyyy date format
        if($dt == '') return '';
        return date($format,strtotime($dt));
    }

    function toDbDateTime($dt, $format = 'd-M-Y H:i'){
        $dt = str_replace("/","-",$dt); // to convert dd-mm-yyyy date format
        if($dt == '') return '';
        return date($format,strtotime($dt));
    }

    function get_script_md5($js_file){
        return $md5 = md5_file('assets/js/' . $js_file . '.js');
    }
    function get_style_md5($css_file){
        return $md5 = md5_file('assets/css/' . $css_file . '.css');
    }
    function dashboardBlock($link,$text,$count,$total){
        $html = '<a href="'.base_url()."Dashboard/dbCatlist/".$link.'">
                <div class="inbox-item">
                    <span>
                        <span class="dbtext"> '.$text.'</span>';
                        if($link =='WAFY'){
                            $html .= '<span class="pull-right"><span data-plugin="counterup" class="dbbadge  redtext">'.$count.'</span><span class="dbbadge">/</span><span data-plugin="counterup" class="dbbadge">'.$total.'</span>';
                        }
                        else{
                            $html .= '<span data-plugin="counterup" class="dbbadge pull-right">'.$count.'</span>';
                        }                        
                    $html .= '</span>
                </div>
            </a>';
        return $html;
    }

    function dashboardFacts($facts){
        $CI =& get_instance();
        // $link = "";
        $html = dashboardBlock("FIR","FIRs",$facts['fircount'],"");
        $html .= dashboardBlock("ARR","Arrests",$facts['arrestcount'],"");
        $html .= dashboardBlock("WAFY","W/A Failed Yesterday",$facts['wayes_failed'],$facts['wayes_total']);
        $html .= dashboardBlock("WADT","W/A Due today",$facts['wadue_today'],"");
        $html .= dashboardBlock("WAD7","W/A Due in 7 days",$facts['wadue'],"");
        $html .= dashboardBlock("WAE","W/A Executed",$facts['waexe'],"");
        $html .= dashboardBlock("WAR","W/A Recieved",$facts['warecv'],"");
        $html .= dashboardBlock("TWAP","Total W/A Pending",$facts['wapend'],"");
        $html .= dashboardBlock("DIS","Disposal",$facts['disposalcount'],"");
        $html .= dashboardBlock("RTA","RTAs",$facts['rta'],"");
        $html .= dashboardBlock("UD","Unnatural Death",$facts['ud'],"");
        $html .= dashboardBlock("CD","Chargesheet Due",$facts['cs_due'],"");
        return $html;
    }

    function filterData($field){
        $CI =& get_instance();
        return $CI->security->xss_clean(strip_tags(trim($CI->input->post($field))));
    }

    function arrest_notification($label,$count,$details,$type){

        $html = '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="portlet">
                <div class="portlet-heading bg-teal">
                    <h2 class="whtext">';
                        $html .= $label;
                        $html .= '<span class="label label-danger pull-right">'. $count . '</span>';
                    $html .= '</h2>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-primary" class="panel-collapse collapse in">
                    <div class="portlet-body slimscroll-alt" style="min-height: 450px;">';
                    foreach ($details as $details){
                        //echo arr_details($details[1]);
                    //}
                        if($type == 'spe'){
                            $details['BRIEF_FACT'] ="";
                            $details['FIR_STATUS'] ="";
                            $param = "";
                        }
                    
                        $html .= '<div class="media latest-post-item card-box tilebox-two tilebox-teal">
                        <div class="media-left">';
                        $html .= '<a href=""> <img class="media-object img-thumbnail" alt="'.$details['ARRESTEE'].'" src="'.$details['PHOTOS'].'" style="width: 150px; height: auto;"> </a>';
                        $html .= '<div class="row">';
                        $html .= '<div class="col-sm-6"><h4><span class="label label-md label-brown">'.$details['PROV_CRM_NO'].'</span></h4></div>';
                        if($type == 'spe'){
                            if (empty($details['CASEREF']) || empty($details['CASE_YR']) || empty($details['PSCODE'])){
                            $html .= '<div class="col-sm-6"><h4><span class="label label-md label-danger">NA</span></a></h4></div>';    
                            }else{
                                $param = $details['PSCODE']."|".$details['CASE_YR']."|".$details['CASEREF'];
                                $param = myEncode($param);                                
                                $html .= '<div class="col-sm-6"><button class="dtls btn btn-xs btn-success waves-effect waves-light m-t-10" style="cursor:pointer" value='.$param.'>Details</button></div>';
                            }    
                        }else{
                            $html .= '<div class="col-sm-6"><h4><span class="label label-md label-danger">NA</span></a></h4></div>';
                        }
                        
                        $html .= '</div></div>
                        <div class="media-body">
                            <h5 class="media-heading">';
                                // $html .= '<a href="'.base_url()."Dashboard/getcaseDetails/".myEncode($details['CASEREF'])."/".myEncode($details['PSCODE'])."/".myEncode($details['CASEDATE']).'/ARR">';
                                    $html .= '<p>'.$details['ARRESTEE']." (".$details['SEX']." - ".$details['AGE'].")";
                                    $html .= '<p>S/W of '.$details['FATHER_HUSBAND'].'</p>';
                                    $html .= '<p>'.$details['ADDRESS'].'</p>';
                                    $html .= '<p>Vide - '.$details['PSNAME'].' C/No. '.$details['CASEREF'].' of '.$details['CASE_YR'].'</p>';
                                    $html .= '<p>U/S - '.$details['UNDER_SECTION'].', Arrested By - '.$details['PS'].'</p>';
                                $html .= '
                            </h5>
                        </div>
                    </div><hr>';
                }
                    $html .= '</div>
                </div>
            </div>
        </div>';
        
        return $html;
    }

    // function arr_details($details){
        
    //     return $html;
    // }
    
    function sess_date(){
        $CI =& get_instance();
        echo $CI->session->userdata('factdt');
    }
    
    function createlist($type,$name,$listtype,$date,$func,$data,$pscode='',$category='',$bclink1='',$bclink2=''){
        
        if($type == 'RTA'){
            $data = '<center><h2 class=""><span data-plugin="counterup" class="redtext">'.$data['FATAL'].'</span> - <span data-plugin="counterup">'.$data['NON_FATAL'].'</span></h2></center>';
        }elseif($type == 'WAFY'){
            $data = '<center><h2 class=""><span data-plugin="counterup" class="redtext">'.$data['FAILED_CASE'].'</span> - <span data-plugin="counterup">'.$data['TOTAL_CASE'].'</span></h2></center>';
        }
        else{
            $data = '<center><h2 class=""><span data-plugin="counterup">'.$data.'</span></h2></center>';
        }
            $html = '<a href="'.base_url().'Dashboard/'.$func.'/'.$type.'/'.$listtype.'/'.myEncode($date).'/'.myEncode($name).'/'.myEncode($pscode).'/'.myEncode($category).'/'.myEncode($bclink1).'/'.myEncode($bclink2).'">';    
        
        
        
        if($listtype == 'CWPL' ||  $listtype == 'PWCL'){
            $html .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
        }else{
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        }
            $html .= '<div class="portlet-body">';
                $html .= '<div class="card-box tilebox-two tilebox-primary">';
                    $html .= $data;
                    $html .= '<h4 class="text-primary text-uppercase m-b-15 m-t-10 text-center">'.$name.'</h4>';
                    $html .= '</div>
                </div>
            </div>
        </a>';

        return $html;
    }

    function getMstData($key){
        $CI =& get_instance();
        $data = $CI->{$CI->model}->getMstData($key);
        return $data;
    }

    function textMatch($str, $needle, $sep = '', $pos = ''){
        $str = strtoupper(strtolower($str));
        $needle = strtoupper(strtolower($needle));
        $exp_txt = explode($needle, $str);
        $count = count($exp_txt);
        $html = '';
        if($sep != '') {
            $sep_arr = explode($sep, $needle);
            $needle = isset($sep_arr[$pos])?$sep_arr[$pos]:$sep_arr[0];
            $exp_txt = explode($needle, $str);
            $count = count($exp_txt);
            $i = 1;
            foreach ($exp_txt as $key1 => $value1) {
                if($i == $count){
                    $html .= $value1;
                } else {
                    $html .= $value1.'<mark>'.$needle.'</mark>';
                }
                $i++;
            }
        } else {
            $i = 1;
            foreach ($exp_txt as $key => $value) {
                if($i == $count){
                    $html .= $value;
                } else {
                    $html .= $value.'<mark>'.$needle.'</mark>';
                }
                $i++;
            }
        }
        return $html;
    }