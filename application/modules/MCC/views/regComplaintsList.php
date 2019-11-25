<div id="loadhtml">
<div class="content-page text-dark">
    <?php//Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">List of Complaints</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="row text-dark">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <?php if($this->session->userdata('MCC_ADMIN') == '1'){ 
                                $type_arr = array("Fwd. Pending","Forwarded","Rpt. Received","Disposed","Registered");
                                $selected = "";
                            ?>
                            <div class="row">
                                 <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Filter Status </label>
                                        <select class="form-control" id="STAT">
                                            <option value="" selected="selected" disabled="disabled">Select</option>
                                            <?php foreach ($type_arr as $key => $value) {
                                                if(isset($type)){
                                                    if($type == $value){
                                                        $selected ='selected';
                                                    }
                                                }
                                             ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                            <?php $selected =""; } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-primary btn-rounded waves-effect waves-light" href="<?php echo base_url(); ?>MCC/addNew"><i class="fa fa-plus"></i> Add New</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <hr/>
                        <?php if($this->session->userdata('flag') ==' insert'){  ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is inserted Successfully</strong>
                        </div>
                        <?php 
                        } if($this->session->userdata('flag') == 'update'){  ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is Updated Successfully</strong>
                        </div>
                        <?php 
                            $this->session->set_userdata('flag',"");
                        } ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-colored table-teal respTable">
                                <thead>
                                    <tr>
                                        <th class="tw5">#</th>
                                        <th class="tw10">COMPLAINT DATE</th>
                                        <th class="tw15">RECEIVED FROM</th>
                                        <th class="tw10">MEMO No & DATE</th>
                                        <th class="tw30">GIST of COMPLAINTS</th>
                                        <th class="tw5">COMPLAINT NATURE</th>
                                        <th class="tw5">REPORTABLE/NON-REPORTABLE</th>
                                        <th class="tw20 text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist">
                                    <?php 
                                        foreach ($allComp as $key => $val) {
                                            if($val['COLOR_CODE'] == '1')
                                                $clr='#ea0b25';
                                            if($val['COLOR_CODE'] == '2')
                                                $clr='#f47141';
                                            if($val['COLOR_CODE'] == '3')
                                                $clr='#417ff4';
                                            if($val['COLOR_CODE'] == '4')
                                                $clr='#237714';
                                            if($val['COLOR_CODE'] == '100')
                                                $clr='#000000';
                                            if($val['COLOR_CODE'] == '99')
                                                $clr='#c705ce';
                                    ?>

                                    <tr data-key-1 ="<?php echo $val['REMARKS'];?>">
                                        <td class="tw5" style="color: <?php echo $clr; ?>;"><?php echo $val['COMPLAINT_ID']; ?></td>
                                        <td class="tw15" style="color: <?php echo $clr; ?>;"><?php echo toDisplayDate($val['COMPLAINT_DATE']); ?></td>
                                        <td class="tw15" style="color: <?php echo $clr; ?>;"><?php echo $val['RECEIVED_FROM'];?><br>Received On<br><?php echo $val['RECEIVED_ON']; ?></td>
                                        <td class="tw10" style="color: <?php echo $clr; ?>;"><?php echo $val['MEMO_NO']; ?><br>Dt:<?php echo $val['MEMO_DT']; ?></td>
                                        <td class="tw30" style="color: <?php echo $clr; ?>;"><?php echo $val['BRIEF_FACT']; ?></td>
                                        <td class="tw5" style="color: <?php echo $clr; ?>;"><?php echo $val['COMPLAINT_NATURE']; ?></td>
                                        <td class="tw5 text-center" style="color: <?php echo $clr; ?>;">
                                            <?php if($val['SEND_REPORT']=='Y'){ ?>
                                                <img width="30px" src="<?php echo base_url(); ?>assets/images/R.png" title="Reportable" class="<?php if($clr == "#ea0b25"){ echo 'fa-spin';} ?>">
                                                <br>
                                            <?php if($val['STATUS'] != 'Disposed'){

                                            if(!empty($val['DYS']) && !empty($val['HRS']) && !empty($val['MINS'])){
                                            if(intval($val['DYS']) < 0 || intval($val['HRS']) < 0 || intval($val['MINS']) < 0 ) { 
                                                        $day = abs($val['DYS']);
                                                        $hr = abs($val['HRS']);
                                                        $min = abs($val['MINS']);
                                                    ?>

                                                    <?php echo "Over by ".$day.' day '.$hr.' hr. '.$min.' min.'; ?>

                                                <?php } else { ?>

                                                <?php echo $val['DYS'].' day '.$val['HRS'].' hr. '.$val['MINS'].' min. left'; ?>
                                            <?php }} else{ echo $val['STATUS']; } }else{ echo $val['STATUS']."<br>Memo No.: ".$val['REPLY_MEMONO']."<br>Memo DT.: ".$val['REPLY_MEMODT']; } } else{ echo '<img src="'.base_url().'assets/images/NR.png" title="Non Reportable'.'"><br>'.$val['STATUS']; } ?>
                                        </td>
                                        <td class="tw20">
                                            <?php if($this->session->userdata('MCC_ADMIN') == '1') { ?>
                                            <a title="Edit" href="<?php echo base_url();?>MCC/editComplaint/<?php echo myEncode($val['COMPLAINT_ID']); ?>" class="btn btn-xs btn-warning btn-rounded"> <i class="glyphicon glyphicon-edit text-white f15"> </i></a>

                                            <a title="Notification" href="#" class="btn btn-xs btn-danger btn-rounded"> <i class="glyphicon glyphicon-share text-white f15"  id="<?php echo ($val['COMPLAINT_ID']); ?>" > </i></a>

                                            <a title="Email" href="#" class="btn btn-xs btn-primary btn-rounded"> <i class="glyphicon glyphicon-envelope text-white f15" id="<?php echo ($val['COMPLAINT_ID']); ?>"> </i></a>
                                            <button title="Show Remarks" href="#" class="details-control btn btn-xs btn-teal btn-rounded"> <i class="fa fa-comments text-white f15" > </i></button>
                                            <?php } ?>
                                            <button title="Upload" class="btn btn-xs btn-success btn-rounded uploaddetails" value= "<?php echo $val['COMPLAINT_ID']; ?>" data-toggle="modal" data-target="#uploadmodal"> 
                                                <i class="fa fa-cloud-upload text-white f15"> </i>
                                            </button>

                                            <?php
                                             $style1 = 'hidden="hidden"';
                                             $style2 = 'hidden="hidden"';
                                             $href = '';
                                             $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID(".$val['COMPLAINT_ID'].",:rc_out); end;";
                                             $nooffiles = $this->{$this->model}->getRefCursor($query);
                                             if(sizeof($nooffiles) > 0) { 
                                                $style1 = '';
                                             }  ?>
                                            <button title="View" class="btn btn-xs btn-primary btn-rounded viewdetails" id="view<?php echo $val['COMPLAINT_ID']; ?>" <?php echo $style1; ?> value= "<?php echo $val['COMPLAINT_ID']; ?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye text-white f15"> </i></button> 
                                            
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
</div>
<?php $this->load->view('includes/contentFooter'); ?>


<div id="uploadmodal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Upload Details</h4>
            </div>
            <br/>
            <div class="modal-body">
                <div class="row" id="onsuccess" align="center">
                </div>
                <div class="row">
                    <div class="col-md-6" align="left">
                        <input type="hidden" name="userid" id="userid">
                        <input id="userfile" name="userfile" type="file"/>
                    </div>
                    <div class="col-md-6" align="left">
                        <div class="progress col-md-12" style="width: 100%;">
                            <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" id="pgb" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><span id="pgbtxt">0% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group" ><br>
                    <div class="col-md-3" align="left">
                        <label>Title Of the Document</label>
                    </div>
                    <div class="col-md-9" align="left">
                        <input id="title" class="form-control max" maxlength="200" autocomplete="off" name="title" type="text" required="required" placeholder="Enter The Title Here" /><br>
                    </div>
                </div>
                <div class="row"><br>
                    <div class="col-md-12" align="center">
                        <button type="button" id="pdf_save_button" class="btn cur-p btn-success" value="upload">Upload</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    function format( dataSource){
    var html = '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">';
    for (var key in dataSource){
        html += '<tr>'+
                   '<td>Remarks :</td>'+
                   '<td> ' +dataSource[key]+'</td>'+
                '</tr>';
    }        
    return html += '</table>';  
}

$(function () {

      var table = $('#datatable').DataTable({});

      // Add event listener for opening and closing details
      $('#datatable').on('click', 'button.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format({

                  'Key 1' : tr.attr('data-key-1')
              })).show();
              tr.addClass('shown');
          }
      });
  });
</script>