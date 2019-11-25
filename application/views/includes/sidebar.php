<div class="left side-menu text-dark">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Navigation</li>
                        <li class="has_sub">
                            <a href="<?php echo base_url();?>Dashboard" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>
                        <li class="has_sub">

                           <?php if($this->session->userdata('IS_DO')==1){?> 
                            <a href="javascript:void(0);" class="waves-effect"><i class="   glyphicon glyphicon-book"></i> <span> New Report </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Report/Advrepc">Advance Report</a></li>
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Report/Covrepc">Covering Report</a></li>                                  
                                </ul>



                             <?php //create report against request(s)?>
                             
                              <a href="<?php echo base_url();?>Report/ViewRequests" class="waves-effect"><i class="   glyphicon glyphicon-folder-open"></i> <span> Requested Report(s)</span> </a>
                                <!-- <ul class="list-unstyled">
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Report/Advrepc">Advance Report</a></li>
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Report/Covrepc">Covering Report</a></li>                                  
                                </ul>    -->

                            <?php } else{?>

                                   <a href="<?php echo base_url();?>Request/Reqc" class="waves-effect"><i class="   glyphicon glyphicon-bullhorn"></i> <span>Request a Report </span> </a>

                                   <a href="<?php echo base_url();?>Request/ReqV" class="waves-effect"><i class="   glyphicon glyphicon-bell"></i> <span>View Requests</span> </a>



                            <?php } //end of OC & above ?>   

                            <a href="<?php echo base_url();?>Report/Ongoing_report_fetch" class="waves-effect" title="Ongoing Report"><i class="glyphicon glyphicon-dashboard"></i> <span> Ongoing Report </span> </a>
                              <!--   <ul class="list-unstyled">
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Dashboard/pc">Details</a></li>
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Pc">AC-wise Booths</a></li>
                                    <li><a class="waves-effect" href="<?php echo base_url(); ?>Pc/loadlist/div">PS-wise Booths </a></li>
                                </ul> -->
                            <a href="<?php echo base_url();?>Report/complete_report_fetch" class="waves-effect" title="Completed reports"><i class="glyphicon glyphicon-ok-circle"></i> <span> Completed Report</span> </a>
                                
                           
                          
                         
                               
                        </li>
                     
                   
                        <?php if(($this->session->userdata('MCC_ADMIN') == '1') || ($this->session->userdata('MCC_USER') == '1')) { ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-book-open-page-variant"></i> <span>Complaints </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a class="waves-effect" href="<?php echo base_url(); ?>mccdashboard"> Dashboard </a></li>
                                <li><a class="waves-effect" href="<?php echo base_url();?>MCC/register"> Complaint Register </a></li>
                                <?php if($this->session->userdata('MCC_ADMIN') == '1') { ?>
                                <li><a class="waves-effect" href="<?php echo base_url();?>MCC/complaintList"> Send for Enquiry </a></li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"> <span> Master </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a class="waves-effect" href="<?php echo base_url(); ?>Master/get_complaint_source"> Source </a></li>
                                        <li><a class="waves-effect" href="<?php echo base_url(); ?>Master/get_complaint_nature"> Nature </a></li>
                                        <li><a class="waves-effect" href="<?php echo base_url(); ?>Master/get_complaint_mode"> Mode </a></li>
                                        <li><a class="waves-effect" href="<?php echo base_url(); ?>Master/get_polpt"> Political Parties </a></li>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="clearfix"></div>

                <div class="help-box">
                    <h5 class="text-muted m-t-0">Need Help?</h5>
                    <p class="m-b-0"><span class="text-dark"><i class="fa fa-phone"></i>&nbsp;<b>Special Branch Technical Cell</b></span><br /> (033) 2283 - 2084</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="exampleModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Document Details</h4>
            </div>
            <br/>
            <div class="modal-body">
                <table id="dataTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="dataTable_info" >
                   <thead>
                      <tr>
                        <th>
                            Document Title
                        </th>
                        <th>
                            Document Name
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Action
                        </th>
                      </tr>
                   </thead>
                   <tbody id='docdetails'>
                      
                   </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>