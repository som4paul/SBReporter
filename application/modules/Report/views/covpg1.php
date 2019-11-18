<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Please Select Covering Report Attributes</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
             <?php
                            echo form_open(base_url('Report/Covrepg'));
                        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-border panel-teal hi300" align="center">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">


                            <select class="selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" name="RP_PRIORITY" required>
                                            <option selected="true" disabled="disabled" value="">Select Priority</option>
                                           <option value="Most Urgent">Most Urgent</option>
                                            <option value="Urgent">Urgent</option>
                                            <option value="Normal">Normal</option>
                             </select>
                             <br><br><br><br>




                             <select class="selectpicker" data-live-search="true" data-style="btn-purple" tabindex="-98" name="RP_MODE" required>
                                           <option selected="true"  disabled="disabled" value="">Select Reporting Mode</option>     
                                            <option value="WFR">Write a full Report</option>
                                            <option value="UPR">Upload a Report</option>                                         
                             </select>
                             <br><br><br><br>                                                     
                              <button type="submit" align="midle" class="btn btn-info waves-effect w-md waves-light">Submit</button>
                            <!-- <div class="row" align="center">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control pcidforac" align="center">
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <select class="form-control pcidforac">
                                        <option>Select Reporting Method</option>
                                        
                                            <option value="WFR">Write a full Report</option>
                                            <option value="UPR">Upload a Report</option>                                         
                                        
                                    </select>
                                </div>
                            </div> </br>
                            <button type="submit" align="midle" class="btn btn-info waves-effect w-md waves-light">Submit</button> -->
                        </div><br><br><br><br>
                        
                    </div>
                </div>
            </div>
             <?php
                            echo form_close();
                        ?>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>