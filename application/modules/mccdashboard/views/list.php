<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">List of Complaints</h4><br>
                        <h6 class="text-primary"><?php echo $type; ?></h6>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-colored table-teal firtable">
                                <thead>
                                    <tr>
                                        <th>COMPLAINT ID</th>
                                        <th>COMPLAINT DATE</th>
                                        <th>RECEIVED FROM</th>
                                        <th>MEMO No & DATE</th>
                                        <th>GIST of COMPLAINTS</th>
                                        <th>COMPLAINT NATURE</th>
                                        <th>REPORTABLE/NON-REPORTABLE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist">
                                    <?php foreach ($details as $key => $val) { 
                                        $colour = "";
                                        ?>
                                        <?php if($val['SEND_REPORT']=='Y'){ 
                                            
                                            if($val['COLOR_CODE'] == '1'){
                                                $colour = "#ea0b25";
                                            } else if($val['COLOR_CODE'] == '2'){
                                                $colour = "#f47141";
                                            } else if($val['COLOR_CODE'] == '3'){
                                                $colour = "#417ff4";
                                            } else if($val['COLOR_CODE'] == '4'){
                                                $colour = "#237714";
                                            } else if($val['COLOR_CODE'] == '100'){
                                                $colour = "#000000";
                                            } else if($val['COLOR_CODE'] == '99'){
                                                $colour = "#c705ce";
                                            }
                                        }
                                        ?>
                                        <tr data-key-1 ="<?php echo $val['REMARKS'];?>">
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo $val['COMPLAINT_ID']; ?></td>
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo toDisplayDate($val['COMPLAINT_DATE']); ?></td>
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo $val['RECEIVED_FROM'];?><br>Received On<br><?php echo $val['RECEIVED_ON']; ?></td>
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo $val['MEMO_NO']; ?><br>Dt:<?php echo $val['MEMO_DT']; ?></td>
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo $val['BRIEF_FACT']; ?></td>
                                        <td style="color:<?php  echo $colour; ?>;"><?php echo $val['COMPLAINT_NATURE']; ?></td>
                                        <td class="tw5 text-center" style="color: <?php echo $colour; ?>;">
                                            <?php if($val['SEND_REPORT']=='Y'){ ?>
                                                <img width="30 px" src="<?php echo base_url(); ?>assets/images/R.png" title="Reportable" class="<?php if($colour == "#ea0b25"){ echo 'fa-spin';} ?>">
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
                                         <td align="center">
                                             <?php
                                             $style1 = 'hidden="hidden"';
                                             $style2 = 'hidden="hidden"';
                                             $href = '';
                                             $query = "BEGIN pc2019.PKG_MCC.getDocumentsByID(".$val['COMPLAINT_ID'].",:rc_out); end;";
                                             $nooffiles = $this->{$this->model}->getRefCursor($query);
                                             if(sizeof($nooffiles) > 1) { 
                                                $style1 = '';
                                             } else if(sizeof($nooffiles) == 1){
                                                $style2 = '';
                                                $href = $this->config->item('view_path').'mcc/'.$nooffiles[0]['DOCUMENT_NAME'];
                                            } ?>
                                            <button title="Show Remarks" href="#" class="details-control btn btn-xs btn-teal btn-rounded"> <i class="fa fa-comments text-white f15" > </i></button>
                                            <a href="<?php echo $href; ?>" title="Show Uploaded files" class="btn btn-xs btn-primary btn-rounded" target="_blank" id="href<?php echo $val['COMPLAINT_ID']; ?>" <?php echo $style2; ?> ><i class="fa fa-eye text-white f15"></i></a>
                                            <button title="Show Uploaded files" class="btn btn-xs btn-primary btn-rounded viewdetails" id="view<?php echo $val['COMPLAINT_ID']; ?>" <?php echo $style1; ?> value= "<?php echo $val['COMPLAINT_ID']; ?>" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye text-white f15"> </i></button>
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