<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <?php if($title == 'Edit'){ ?>
                            <h4 class="page-title">Edit Complaints</h4>
                        <?php } else { ?>
                            <h4 class="page-title">Register New Complaints</h4>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
                <div class="col-xs-12">
                    <div class="panel panel-color panel-teal">
                        <div class="panel-heading text-right">
                            <a href="<?php echo base_url(); ?>MCC/register" class="f18 text-white"><i class="ion-android-system-back"></i> Back</a>
                        </div>
                        <?php
                            echo form_open(base_url('MCC/setComplaintRecord/'.$this->method));
                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 m-b-10">
                                    <?php 
                                        if(isset($res[0]['SEND_REPORT']) && $res[0]['SEND_REPORT']=='Y'){
                                            $checked ='checked';
                                        }else{
                                            $checked='';
                                        }
                                    ?>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" type="checkbox" name="SEND_REPORT" <?php echo $checked; ?>>
                                        <label for="checkbox2">
                                            Reportable/Non-Reportable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 m-b-10">
                                    <div class="form-group">
                                        <?php 
                                            $readonly= $cls='';
                                            if(isset($res[0]['COMPLAINT_ID'])){
                                                $readonly = 'readonly';
                                                $cls = 'readonly-input';
                                            } else{
                                                $readonly ='id="CID"';
                                            }
                                        ?>
                                        <label>Complaint ID <span class="text-danger">*</span></label>
                                        <input type="text" name="COMPLAINT_ID" required="required" <?php echo $readonly; ?> class="form-control <?php echo $cls; ?>" value="<?php echo (isset($res[0]['COMPLAINT_ID']) ? $res[0]['COMPLAINT_ID'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 m-b-10">
                                    <div class="form-group">
                                        <label>Complaint Date <span class="text-danger">*</span></label>
                                        <input type="text" name="COMPLAINT_DATE" required="required" class="form-control datepicker-autoclose" readonly="readonly" value="<?php echo (isset($res[0]['COMPLAINT_DATE']) ? toDisplayDate($res[0]['COMPLAINT_DATE']) : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 m-b-10">
                                    <div class="input-group">
                                        <label for="rcvFrm">Received From <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control max" id="rcvFrm" required="required" maxlength="30" name="RECEIVED_FROM" autocomplete="off" value="<?php echo (isset($res[0]['RECEIVED_FROM']) ? $res[0]['RECEIVED_FROM'] : ''); ?>">
                                        <span class="input-group-btn">
                                            <input type="hidden" id="val" value="<?php echo $html;?>">
                                            <button class="btn btn-custom btn-xs m-t-42" data-toggle="modal" type="button" data-target="#myModal" id="source">...</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Received on <span class="text-danger">*</span></label>
                                        <input type="text" data-mask="99/99/9999 99:99" class="form-control" required="required" name="RECEIVED_ON" value="<?php echo ((isset($res[0]['RECEIVED_ON']) && $res[0]['RECEIVED_ON'] != 'NIL' ) ? $res[0]['RECEIVED_ON'] : ''); ?>">
                                        <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="compname">Complainant Name <span class="text-danger">*</span></label>
                                        <input type="text" required="required" class="form-control max" maxlength="60" name="COMPALAINANT_NAME" autocomplete="off" value="<?php echo (isset($res[0]['COMPALAINANT_NAME']) ? $res[0]['COMPALAINANT_NAME'] : ''); ?>">
                                    </div>
                                </div>
                                <?php if(!empty($res[0]['POLITICAL_AFFILIATION'])){ ?>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="affl">Affliation </label>
                                        <select class="form-control" name="POLITICAL_AFFILIATION">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allparty as $ap){ ?>
                                            <option value="<?php echo $ap['PARTY_NAME'];?>"<?php if($ap['PARTY_NAME'] == $res[0]['POLITICAL_AFFILIATION']) echo 'selected'; ?>><?php echo $ap['PARTY_NAME'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="affl">Affliation </label>
                                        <select class="form-control" name="POLITICAL_AFFILIATION">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allparty as $ap){ ?>
                                            <option value="<?php echo $ap['PARTY_NAME'];?>"><?php echo $ap['PARTY_NAME'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="memono">Memo/Letter No</label>
                                            <input type="text" class="form-control max" name="MEMO_NO" autocomplete="off" maxlength="50" value="<?php echo ((isset($res[0]['MEMO_NO']) && $res[0]['MEMO_NO'] != 'NIL' ) ? $res[0]['MEMO_NO'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="memodt">Memo/Letter Date </label>
                                        <input type="text" class="form-control datepicker-autoclose" readonly="readonly" name="MEMO_DT" autocomplete="off" value="<?php echo ((isset($res[0]['MEMO_DT']) && $res[0]['MEMO_DT'] != 'NIL' ) ? toDisplayDate($res[0]['MEMO_DT']) : ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($res[0]['COMPLAINT_NATURE'])){ ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="noc">Nature Of Complaint <span class="text-danger">*</span></label>
                                        <select class="form-control" name="COMPLAINT_NATURE" required="required">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allnature as $an){ ?>
                                                <option value="<?php echo $an['COMPLAINT_NATURE'];?>"<?php if($an['COMPLAINT_NATURE'] == $res[0]['COMPLAINT_NATURE']) echo 'selected'; ?>><?php echo $an['COMPLAINT_NATURE'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="noc">Nature Of Complaint <span class="text-danger">*</span></label>
                                        <select class="form-control" name="COMPLAINT_NATURE" required="required">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allnature as $an){ ?>
                                                <option value="<?php echo $an['COMPLAINT_NATURE'];?>"><?php echo $an['COMPLAINT_NATURE'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } if(!empty($res[0]['COMPL_MODE'])){ ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="mode">Mode of Receipt <span class="text-danger">*</span></label>
                                        <select class="form-control" name="COMPL_MODE" required="required">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allmodes as $am){ ?>
                                                <option value="<?php echo $am['COMPL_MODE'];?>"<?php if($am['COMPL_MODE'] == $res[0]['COMPL_MODE']) echo 'selected'; ?>><?php echo $am['COMPL_MODE'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php }else { ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="mode">Mode of Receipt <span class="text-danger">*</span></label>
                                        <select class="form-control" name="COMPL_MODE">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allmodes as $am){ ?>
                                                <option value="<?php echo $am['COMPL_MODE'];?>"><?php echo $am['COMPL_MODE'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="compagnst">Complained Against</label>
                                        <input type="text" class="form-control max" maxlength="60" name="COMPLAINT_AGAINST" autocomplete="off" value="<?php echo (isset($res[0]['COMPLAINT_AGAINST']) ? $res[0]['COMPLAINT_AGAINST'] : ''); ?>">
                                    </div>
                                </div>
                                <?php if(!empty($res[0]['PARTY'])){ ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="affltn">Affliation </label>
                                        <select class="form-control" name="PARTY">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allparty as $allp){ ?>
                                            <option value="<?php echo $allp['PARTY_NAME'];?>"<?php if($allp['PARTY_NAME'] == $res[0]['PARTY']) echo 'selected'; ?>><?php echo $allp['PARTY_NAME'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="affltn">Affliation </label>
                                        <select class="form-control" name="PARTY">
                                            <option selected="selected" value="">Select</option>
                                            <?php foreach($allparty as $allp){ ?>
                                            <option value="<?php echo $allp['PARTY_NAME'];?>"><?php echo $allp['PARTY_NAME'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="brffact">Gist of Complaint </label>
                                        <textarea class="form-control max" name="BRIEF_FACT" maxlength="2000"><?php echo (isset($res[0]['BRIEF_FACT'])?$res[0]['BRIEF_FACT']:''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Report to be sent by</label>
                                        <input type="text" data-mask="99/99/9999 99:99" class="form-control" name="REPLY_TOBE_SENT_BY" value="<?php echo ((isset($res[0]['REPLY_TOBE_SENT_BY']) && $res[0]['REPLY_TOBE_SENT_BY'] != 'NIL' ) ? $res[0]['REPLY_TOBE_SENT_BY'] : ''); ?>">
                                        <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Report to be Prepared by </label>
                                        <input type="text" data-mask="99/99/9999 99:99" class="form-control" name="REPLY_TOBE_PREP_BY" value="<?php echo ((isset($res[0]['REPLY_TOBE_PREP_BY']) && $res[0]['REPLY_TOBE_PREP_BY'] != 'NIL' ) ? $res[0]['REPLY_TOBE_PREP_BY'] : ''); ?>">
                                        <span class="font-13 text-muted">dd/mm/yyyy hh:mm</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <?php if($title == 'Edit'){ ?>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Reply Memo/Letter No.</label>
                                        <input type="text" class="form-control" name="REPLY_MEMONO" value="<?php echo (isset($res[0]['REPLY_MEMONO'])?$res[0]['REPLY_MEMONO']:''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Reply Memo/Letter Date. </label>
                                        <input type="text" class="form-control datepicker-autoclose" name="REPLY_MEMODT" value="<?php echo ((isset($res[0]['REPLY_MEMODT']) && $res[0]['REPLY_MEMODT'] != 'NIL' ) ? toDisplayDate($res[0]['REPLY_MEMODT']) : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class="form-control" name="STATUS">
                                            <?php
                                                $fp='';
                                                $fwd='';
                                                $rr='';
                                                $disp='';
                                                
                                                if($res[0]['STATUS'] == 'Fwd. Pending')
                                                    $fp ='selected';
                                                if($res[0]['STATUS'] == 'Forwarded')
                                                    $fwd ='selected';
                                                if($res[0]['STATUS'] == 'Rpt. Received')
                                                    $rr ='selected';
                                                if($res[0]['STATUS'] == 'Disposed')
                                                    $disp ='selected';
                                            ?>
                                            <option value="" selected="selected">Select</option>
                                            <option value="Fwd. Pending"<?php echo $fp; ?>>Fwd. Pending</option>
                                            <option value="Forwarded"<?php echo $fwd; ?>>Forwarded</option>
                                            <option value="Rpt. Received"<?php echo $rr; ?>>Rpt. Received</option>
                                            <option value="Disposed"<?php echo $disp; ?>>Disposed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="REMARKS">Remarks</label>
                                        <textarea maxlength="4000" class="form-control" placeholder="Enter Remarks Here" name="REMARKS"><?php echo (isset($res[0]['REMARKS']) ? $res[0]['REMARKS'] : ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div> 
                        <!-- BUTTON OUTSIDE PANEL -->
                        <?php 
                            if($title == 'Edit'){ 
                                $btn = 'Update';
                            }else {
                                $btn = 'Save';
                            }
                        ?>
                        <div class="row text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-save"></i> <?php echo $btn; ?></button>
                            </div>
                        </div>
                        <?php
                            echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>

<div id="myModal" class="modal fade text-dark" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">List of Sources</h4>
            </div>
            <div class="modal-body" id="">
                <table class="table table table-hover m-0">
                    <thead>
                        <tr>
                            <th>Source Name</th>
                        </tr>
                    </thead>
                    <tbody id="srcnm">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger btn-rounded">Close</button>
            </div>
        </div>
     </div>
</div>