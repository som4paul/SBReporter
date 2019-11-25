<div class="content-page text-dark">
   
    <div class="content">
        <div class="container">


<div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Ongoing Reports:-</b></h4>
                                    <p class="text-muted font-13 m-b-30">
                                        Please find below the Ongoing Reports to be completed accordingly
                                    </p>

                                    <table id="view_req" class="table table-striped  table-colored table-info">
                                        <thead>
                                        <tr>
                                            <th>SLNO</th>    
                                            <th>Event Name</th>
                                            <th>Report ID</th>
                                            <th>Report Status</th>
                                            <th>Report Type</th>
                                            <th>Note</th>
                                            <th>Event Date</th>
                                            <th>Event Start Time</th>
                                            <th>Event End Time</th>              
                                            <th>Created on</th>           
                                            <th>Report Priority</th>
                                            <th>Documents Attached</th>

                                            <?php if($this->session->userdata('IS_DO')==1){?>
                                            <th>Edit Report</th>
                                            <th>Mark as Complete</th>
                                          <?php }?>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        

        <?php  if(!empty($reports_details)) { ?>
            <?php for($i=0;$i<count($reports_details);$i++) {?>
                                        <tr>
                                            <td><?php echo ($i+1) ; ?></td>    
                                            <td><?php echo $reports_details[$i]['EVENT_NAME'] ; ?></td>
                                            <td><a href="Report/view_report_details/<?php echo $reports_details[$i]['RP_ID'] +999999999?>"><?php echo $reports_details[$i]['RP_LOG_ID'] ; ?></a></td>                <td><?php echo $reports_details[$i]['RP_PRESENT_STATUS'] ; ?></td>                             
                                             <td><?php echo $reports_details[$i]['RP_TYPE'] ; ?></td>

                                              <td><textarea class="expand" rows="1" cols="10"><?php echo $reports_details[$i]['NOTE'];?></textarea></td>


                                             <td><?php echo $reports_details[$i]['RP_DATE'] ; ?></td>
                                             <td><?php echo date('h:i:s a', strtotime($reports_details[$i]['RP_TIME'])); ?></td>
                                             <td><?php echo date('h:i:s a', strtotime($reports_details[$i]['RP_TIME_END'])); ?></td>
                                             <td><?php echo date('h:i:s a', strtotime($reports_details[$i]['RP_CREATEDON'])); ?></td>

                                             <td><?php echo $reports_details[$i]['RP_PRIORITY'] ; ?></td>                                          
                                            
                            <td><a id="<?php echo $reports_details[$i]['RP_ID']?>" href="#"><i class="glyphicon  glyphicon-download-alt"></i></a></td>




                <?php if($this->session->userdata('IS_DO')==1){?> 
                                             <td><a id="<?php echo $reports_details[$i]['RP_ID']?>" href="<?php echo base_url()."Report/Advrepedit/".$reports_details[$i]['RP_ID'] ;?>"><i class="glyphicon glyphicon-pencil"></i></a></td>

                                       <td><a id="<?php echo $reports_details[$i]['RP_ID']?>" href="#"><i class=" glyphicon glyphicon-check"></i></a></td>
                                           <?php }?>

                                            
                                              </tr>

                                           <?php } }?>
                                            <!-- <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td> -->
                                       
                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
</div>
</div>
</div>



