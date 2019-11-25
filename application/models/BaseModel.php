<?php
class Basemodel   extends CI_Model {
    
	public function __construct() {
		parent::__construct();
	}

    public function getdbData($table, $cond = '', $select = '', $group_by = '', $order_by = '', $join = '') {
        $this->db->select($select);
        if($join != '') {
            foreach ($join as $key => $value) {
                if(isset($value[0]) && isset($value[1])){
                    if(isset($value[2])){
                        $this->db->join($value[0],$value[1],$value[2]);    
                    } else {
                        $this->db->join($value[0],$value[1]);
                    }
                }
            }
        }
        if($cond != '') {
            foreach ($cond as $key => $value) {
                if($value['type'] == 'where'){
                    $this->db->where($value['cond']);
                } elseif($value['type'] == 'where_in'){
                    $this->db->where_in($value['cond'][0],$value['cond'][1]);
                } elseif($value['type'] == 'where_not_in'){
                    $this->db->where_not_in($value['cond'][0],$value['cond'][1]);
                }
            }
        }
        $this->db->group_by($group_by);
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        // echo $this->db->last_query();die;
        return ($query->result_array());
    }

    public function getdbDataCustom($sql){
        $query = $this->db->query($sql);
        return ($query->result_array());
    }

    public function setdbData($table, $arr, $cond = '') {
        try {
            if($cond != '') {
                $this->db->where($cond);
                $this->db->update($table,$arr);
            } else {
                $this->db->insert($table,$arr);
            }
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function unsetdbData($table, $cond) {
        try {
            $this->db->delete($table, $cond);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function getPsreports($ps,$date){
        $this->db->select("COUNT(*) AS C");
        $this->db->where('PS',$ps);
        $this->db->where('REPDATE',$date);
        $query = $this->db->get('PSREPORTS');
        $result = $query->result_array();
        if ($result) {
            return $result[0];
        } else {
            return 0;
        }
    }

    public function getSideMenu($menuId = '0'){
    	$menulist = $this->{$this->model}->getdbData('MENU_ACCESS_HMVC',array(array('type' => 'where', 'cond' => array('PSCODE' => $this->session->userdata('UNAME')))),'MENU_ID');
        foreach ($menulist as $key => $value) {
            $bmenu[$key] = $value['MENU_ID'];
        }
        $cond = array();
        $cond[0]['type'] = 'where';
        $cond[0]['cond'] = "DISPLAY_BLOCK != 0";
    	$cond[1]['type'] = 'where';
        $cond[1]['cond'] = array("PARENT" => $menuId);
        foreach ($menulist as $key => $value) {
            $bmenu[$key] = $value['MENU_ID'];
        }
        if(!empty($bmenu)){
	        $cond[2]['type'] = 'where_not_in';
	        $cond[2]['cond'] = array("MENU_ID", $bmenu);
        }
        $res = $this->{$this->model}->getdbData("MENULIST_HMVC",$cond,'','',"MENUORDER");
        return $res;
    }

    public function getChildMenu($menuId) {
    	return $this->getSideMenu($menuId);
    }

    public function getLastRecordDate($ps){
        $this->db->select("TO_CHAR(MAX(REPDATE), 'DD-MON-YYYY') AS LASTDATE");
        $this->db->where('PS',$ps);
        $query = $this->db->get('PSREPORTS');
        $res = $query->result_array();
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }

    public function savePsreports($data){
        $query = $this->db->insert('PSREPORTS',$data);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getPsName($method){
        $this->db->select('PSNAME,PSCODE');
        if($method == 'unitio'){
            $this->db->order_by('PSNAME','ASC');
        }
        else{
            $this->db->like('PSNAME','PS');
            $this->db->order_by('PSNAME','ASC');
        }
        $query = $this->db->get('PS');
        return $query->result_array();
    }

    public function getPSbyCode($pscode){
        $this->db->where('PSCODE',$pscode);
        $query = $this->db->get('PS');
        return $query->result_array();
    }

    public function getSectionByDept($sec){
        $this->db->select('PSNAME,PSCODE');
        $this->db->like('PSNAME','PS');
        $this->db->where('DIVCODE',$sec);
        $this->db->order_by('PSNAME','asc');
        $query=$this->db->get('PS');
        return $query->result_array();
    }

    public function getIOByUnit($unit){
        if($unit == 'PS'){
            $this->db->select('*');
            $this->db->where('PS',$this->session->userdata('PSCODE'));
            $this->db->where('ACTIVE_FLAG IS NULL',null,true);
            $query=$this->db->get('IOMASTER');
        }
        else{
            $this->db->select('I.IONAME,I.IOCODE,P.PSNAME');
            $this->db->where('P.PSCODE = I.PS');
            $this->db->where('P.DIVCODE',$unit);
            $query=$this->db->get('IOMASTER I,PS P');
        }
        return $query->result_array();
    }

    public function logEntry($action){
        // Getting Date and Time
        date_default_timezone_set('Asia/Kolkata');
        $dt = date("d-m-Y");
        $time = date("h:i:sa");

        // Fetching the IP Address
        $ip = get_real_ip_addr();

        // Getting Other Details
        $uname = $this->session->userdata('USRNAME');

        // Fetching Browser Type and Version
        if ($this->agent->is_browser()){
            $agent = $this->agent->browser();
            $brver = $this->agent->version();
        }elseif ($this->agent->is_robot()){
            $agent = $this->agent->robot();
            $brver = $this->agent->version();
        }elseif ($this->agent->is_mobile()){
            $agent = $this->agent->mobile();
            $brver = $this->agent->version();
        }else{
            $agent = 'Unidentified Browser Type';
            $brver = 'Unidentified Browser Version';
        }
        
        // Concatenating Browser Name and Version
        $browser = "Browser: ".$agent." Version: ".$brver;

        // Getting OS Type
        $os = $this->agent->platform();

        $row = array(
                    'uname' => 'Username',
                    'action_done' => 'Action Done',
                    'activity_date' => 'Date',
                    'activity_time' => 'Time',
                    'ip' => 'IP Address',
                    'browser' => 'Browser',
                    'os' => 'OS'
                 );

        $details = array(
                    'uname' => $uname,
                    'action_done' => $action,
                    'activity_date' => $dt,
                    'activity_time' => $time,
                    'ip' => $ip,
                    'browser' => $browser,
                    'os' => $os
                );

        $filename = $this->config->item('log_file_path')."Log_".date('d-m-Y').".csv";

        if (!file_exists($filename)) {
            $file = fopen($filename,"w");
            fputcsv($file, $row);
            fputcsv($file, $details);
            fclose($file);
        } else {
            $file = fopen($filename,"a");
            fputcsv($file, $details);
            fclose($file);
        }
    }

    public function ciCaptcha($flag) {
        $options = array(
            'img_path'      =>  'captcha/',
            'img_url'       =>  base_url().'captcha/',
            'img_width'     =>  '145',
            'img_height'    =>  '30',
            'expiration'    =>  300,
            'word_length'   =>  4,
            'font_size'     =>  18,
            'pool'          =>  '123456789',
            'colors'        =>  array(
                'background'    => array(255,255,255),
                'border'        => array(255,182,193),
                'text'          => array(0,0,128),
                'grid'          => array(255,182,193)
            )
        );
        if(!LIVE){
            $options['pool'] = '1';
        }
        $cap = create_captcha($options);
        // we will store the image html code in a variable
        $image = $cap['image'];
        // ...and store the captcha word in a session
        $this->session->set_userdata('captchaword', $cap['word']);
        
        if (isset($flag)){
            return $image;
        }
    }

    // Send SMS
    public function sendSMS($mob, $msg) {
        $dt = date('Y-m-d H:i:s');
        $smsuser = "egovernance";
        $smspass = "Eg0v@kpd";
        
        // Sender ID
        $approved_senderid = "KPPIIN";
        
        //Create API URL
        $apiurl = 'https://sms.pinnsafe.in/api/api_http.php?' . http_build_query([
            'username' => $smsuser,
            'password' => $smspass,
            'senderid' => $approved_senderid,
            'to' => $mob,
            'route' => 'Informative',
            'text' => $msg,
            'type' => 'text',
            'datetime' => $dt
        ]);
        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $output = curl_exec($ch);
        curl_close($ch);
    }

    /*OLD Function dont use */
    public function insert($table, $data){
        $query = $this->db->insert($table, $data);
        if($query){
            return 1;
        } else {
            return 0;
        }
    }

    /*OLD Function dont use */
    public function updateToDB($cond,$data,$table){
        $this->db->where($cond);
        $query = $this->db->update($table,$data);
        if($query){
            return 1;
        } else {
            return 0;
        }
    }

    function getMstData($key) {
        $table = 'MTOP.MST_DATA';
        $cond = array();
        $cond[0]['type'] = 'where';
        $cond[0]['cond'] = array("KEY" => $key, "STATUS" => 0);
        $data = $this->getDbData($table, $cond);
        return $data;    
    }

    public function getAllDiv(){
        $this->db->select('DIVNAME,DIVCODE');
        $this->db->where_in('DIVCODE',array('CD','ESD','ND','SED','PD','SWD','SSD','SD','ED'));
        $query = $this->db->get('DIVISIONS');
        return $query->result_array();
    }

    #1 CURSOR FUNCTION

    function getRefCursor($query){
        $data = array();
        $curs = $this->db->get_cursor();
        $stid = oci_parse($this->db->conn_id, $query);
        oci_bind_by_name($stid, ":rc_out", $curs, -1, OCI_B_CURSOR);
        oci_execute($stid);
        oci_execute($curs);
        while(($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            $data[] = $row;
        }
        oci_free_statement($stid);
        oci_free_statement($curs);
        return $data;
    }


    function getRefCursor2($query){
        $data = array();
        $curs = $this->db->get_cursor();
        $stid = oci_parse($this->db->conn_id, $query);
        oci_bind_by_name($stid, ":rc_out", $curs, -1, OCI_B_CURSOR);
        oci_execute($stid);
        oci_execute($curs);
        while(($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            $data[] = $row;
        }
        oci_free_statement($stid);
        oci_free_statement($curs);
        return $data;
    }

    function getRefCursorReturn($query){
        $rc_out = 0;
        $stid = oci_parse($this->db->conn_id, $query);
        oci_bind_by_name($stid, ":rc_out", $rc_out);
        oci_execute($stid);
        oci_free_statement($stid);
        return $rc_out;
    }
    
    public function setRefCursor($qry){
        $rc_out = 0;
        $stid = oci_parse($this->db->conn_id, $qry);
        oci_bind_by_name($stid, ":rc_out", $rc_out);
        oci_execute($stid);
        oci_free_statement($stid);        
        return $rc_out;
    }

    public function setRefCursorReturn($qry){
        $rc_out = 0;
        $stid = oci_parse($this->db->conn_id, $qry);
        oci_bind_by_name($stid, ":rc_out", $rc_out, 255);
        oci_execute($stid);
        oci_free_statement($stid);        
        return $rc_out;
    }

    public function getRefCursorMultiple($query, $rc){
        $data = array();
        
        foreach ($rc as $key => $value) {
            $$value = $this->db->get_cursor();
        }

        $stid = oci_parse($this->db->conn_id, $query);
        
        foreach ($rc as $key => $value) {
            oci_bind_by_name($stid, ":".$value, $$value, -1, OCI_B_CURSOR);
        }
        
        oci_execute($stid);

        foreach ($rc as $key => $value) {
            oci_execute($$value);
        }

        foreach ($rc as $key => $value) {
            while(($row = oci_fetch_array($$value, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                $data[$value][] = $row;
            }
        }

        oci_free_statement($stid);

        foreach ($rc as $key => $value) {
            oci_free_statement($$value);
        }

        return $data;
    }

    #2
    // public function fun2(){
    //     $rc_out = 0;
    //     $stid = oci_parse($this->db->conn_id, "BEGIN PKG_SQL_QUERIES.PROCEDURE_NAME($user_id,$request_id,:rc_out); end;");
    //     oci_bind_by_name($stid, ":rc_out", $rc_out);
    //     oci_execute($stid);
    //     oci_free_statement($stid);        
    //     return $rc_out;
    // }
}