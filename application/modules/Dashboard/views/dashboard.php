   <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                           <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard </h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                           </div>


                <div class="row">
                        <?php if($this->session->userdata('IS_DO')!=1){?>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?php echo base_url().'Request/Reqc'?>">
                                <div class="card-box widget-box-two widget-two-danger">
                                    <i class="mdi mdi-access-point-network widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Request a Report</p>
                                        <h2 class="text-white"><!-- <span data-plugin="counterup">6352</span>  --><small><i class="mdi  text-success"></i></small></h2>
                                        <!-- <p class="m-0"><b>Last:</b> 30.4k</p> -->
                                    </div>
                                </div>
                                </a>
                            </div><!-- end col -->




                              <div class="col-lg-3 col-md-6">
                                <a href="<?php echo base_url().'Request/ReqV'?>">
                                <div class="card-box widget-box-two widget-two-purple">
                                    <i class="mdi mdi-amplifier widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">View Requests</p>
                                        <h2 class="text-white"> <small><i class="mdi  text-success"></i></small></h2>
                                       <!--  <p class="m-0"><b>Last:</b> 40.33k</p> -->
                                    </div>
                                </div>
                                </a>
                            </div><!-- end col -->

                        <?php }?>
                            

                          
                          <div class="col-lg-3 col-md-6">
                            <a href="<?php echo base_url().'Report/Ongoing_report_fetch'?>">
                                <div class="card-box widget-box-two widget-two-info">
                                    <i class="mdi mdi-av-timer widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Request Per Minute">Ongoing Reports status</p>
                                        <h2 class="text-white"><small><i class="mdi  text-danger"></i></small></h2>
                                       
                                    </div>
                                </div>
                                </a>
                            </div>



                            <div class="col-lg-3 col-md-6">

                                <a href="<?php echo base_url().'Report/complete_report_fetch'?>">
                            
                                <div class="card-box widget-box-two widget-two-teal">
                                    <i class="mdi mdi-cube-outline widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Completed Reports</p>
                                        <h2 class="text-white"> <small><i class="mdi  text-danger"></i></small></h2>
                                      
                                    </div>
                                </div>
                                </a>
                            </div>

                        </div>   
                        <?php //start of pie chart ?>

                       <div id="piechart_3d" style="width: 900px; height: 500px;">
                           <font color="red" bold center>Loading Pie Chart .....Please Wait!!!</font>
                       </div>
                            





                        <?//end of pie chart?>








                    </div>
                </div>    
    </div>                