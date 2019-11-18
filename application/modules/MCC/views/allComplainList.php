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
                        <div class="row">
                        </div>
                        <hr>
                        <?php if($this->session->userdata('flag')=='insert'){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is inserted Successfully</strong>
                        </div>
                        <?php 
                            $flag = '';
                            $this->session->set_userdata('flag',$flag);
                        } if($this->session->userdata('flag')=='update'){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is Updated Successfully</strong>
                        </div>
                        <?php 
                            $flag = '';
                            $this->session->set_userdata('flag',$flag);
                        } ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-colored table-teal firtable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>COMPLAINT DATE</th>
                                        <th>RECEIVED FROM</th>
                                        <th>MEMO No & DATE</th>
                                        <th>GIST of COMPLAINTS</th>
                                        <th>COMPLAINT NATURE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist">
                                    <?php foreach ($allComp as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $val['COMPLAINT_ID']; ?></td>
                                        <td><?php echo toDisplayDate($val['COMPLAINT_DATE']); ?></td>
                                        <td><?php echo $val['RECEIVED_FROM'];?></td>
                                        <td><?php echo $val['MEMO_NO']; ?><br>Dt:<?php echo $val['MEMO_DT']; ?></td>
                                        <td><?php echo $val['BRIEF_FACT']; ?></td>
                                        <td><?php echo $val['COMPLAINT_NATURE']; ?></td>
                                        <td>
                                            <button class="btn btn-teal btn-xs btn-rounded repTo" data-toggle='modal' value="<?php echo $val['COMPLAINT_ID'];?>" data-target='#repModal'><i title="View e-Mail/Notification Log" class="fa fa-send text-white f15"> </i></button>
                                            <a href="<?php echo base_url();?>MCC/viewSendRep/<?php echo myEncode($val['COMPLAINT_ID']); ?>" class="btn btn-xs btn-primary btn-rounded"> <i title="Send for Enquiry" class="fa fa-share text-white f15"> </i></a>
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
<div id="repModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="header-title m-t-0">Report</h4>
            </div> -->
            <br/>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h5><b>Report Log</b></h5>
                        <div class="table-responsive">
                            <table id="repTable" class="table table-striped table-colored table-teal KPdatatable">
                                <thead>
                                    <tr>
                                        <th class="tw5">SENT TO</th>
                                        <th class="tw15">DATE SENT</th>
                                        <th class="tw15">REPLY TO BE REACHED BY</th>
                                        <th class="tw10">REPLY RECEIVED ON</th>
                                        <th class="tw20">ACTION TAKEN</th>
                                        <th class="tw15">REPLY MEMO NO.</th>
                                        <th class="tw20">REPLY MEMO DATE.</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist1">
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
                <br><br><hr>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h5><b>Notofication Log</b></h5>
                        <div class="table-responsive">
                            <table id="reptable1" class="table table-striped table-colored table-teal KPdatatable">
                                <thead>
                                    <tr>
                                        <th class="tw15">COMPLAINT ID</th>
                                        <th class="tw5">LOG DATE</th>
                                        <th class="tw15">LOG TYPE</th>
                                        <th class="tw10">SENT TO</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist2">
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>