<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Send for Enquiry</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
                <div class="col-sm-12">
                    <div class="card-box">
                        <?php echo form_open(base_url('MCC/saveEnquiry'));?>
                        <div class="row">
                            <input type="hidden" name="COMPLAINT_ID" value="<?php echo $comp_id; ?>">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Select Division</label>
                                    <select name="DIV[]" class="selectpicker form-control" multiple data-size="7" data-selected-text-format="count" data-actions-box="true">
                                        <?php foreach($allDivision as $ad){ ?>
                                        <option value="<?php echo $ad['DIV']; ?>"><?php echo $ad['DIVNAME']; ?></option>
                                        <?php } ?>
                                        <option value="DD">DETECTIVE DEPARTMENT</option>
                                        <option value="SB">SPECIAL BRANCH</option>
                                        <option value="STF">SPECIAL TASK FORCE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Select Police Station</label>
                                    <select name="PS[]" class="selectpicker form-control" multiple data-size="7" data-selected-text-format="count" data-actions-box="true">
                                        <?php foreach($allPs as $ap){ ?>
                                        <option value="<?php echo $ap['PS']; ?>"><?php echo $ap['PSNAME']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Date Sent</label>
                                    <input type="text" class="form-control" value="<?php echo toDisplayDate(date('d-M-Y'));?>" name="DATE_SENT">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Report to be submitted by</label>
                                    <input type="text" data-mask="99/99/9999 99:99" class="form-control" name="REP_TO_REACH_BY">
                                    <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                        <?php echo form_close();?>
                        <br><br><br><br><br><br>
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
                                        <th>SENT TO</th>
                                        <th>DATE SENT</th>
                                        <th>REP TO REACH BY</th>
                                        <th>REP RECVD ON</th>
                                        <th>REPLY MEMO NO</th>
                                        <th>REPLY MEMO DATE</th>
                                        <th>ACTION TAKEN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist">
                                    <?php foreach ($enqRep as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $val['COMPLAINT_ID']; ?></td>
                                        <td><?php echo $val['SENT_TO']; ?></td>
                                        <td><?php echo toDisplayDate($val['DATE_SENT']);?></td>
                                        <td><?php echo toDisplayDate($val['REP_TO_REACH_BY']); ?></td>
                                        <td><?php echo toDisplayDate($val['REP_RECVD_ON']); ?></td>
                                        <td><?php echo $val['REP_MEMO_NO']; ?></td>
                                        <td><?php echo toDisplayDate($val['REP_MEMO_DT']); ?></td>
                                        <td><?php echo $val['ACTION_TAKEN']; ?></td>
                                        <td>
                                            <button id="enq" data-toggle="modal" data-target = "#enqModal" class="btn btn-xs btn-primary btn-rounded" value="<?php echo $val['AUTO_ID']."|".$val['REP_RECVD_ON']."|".$val['ACTION_TAKEN']."|".$val['REP_MEMO_NO']."|".$val['REP_MEMO_DT'];?>"> <i class="fa fa-pencil text-white f15"> </i></button>
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
<?php $this->load->view('includes/contentFooter'); ?>

<div id="enqModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Update Enqury Report</h4>
            </div>
            <br/>
            <?php echo form_open_multipart(base_url('MCC/editSendRep'))?>
            <div class="modal-body">
               <div class="row">
                <input type="hidden" name="AUTO_ID" id="AUTO_ID">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>Rep. Received On</label>
                       <input type="text" data-mask="99/99/9999 99:99" class="form-control" name="REP_RECVD_ON" id="REP_RECVD_ON">
                        <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>Reply Memo No.</label>
                       <input type="text" class="form-control" name="REP_MEMO_NO" id="REP_MEMO_NO">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>Reply Memo Dt.</label>
                       <input type="text" data-mask="99/99/9999 99:99" class="form-control" name="REP_MEMO_DT" id="REP_MEMO_DT">
                    <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>Action Taken</label>
                       <input type="text" name="ACTION_TAKEN" value="" class="form-control" id="ACTION_TAKEN">
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Update</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div