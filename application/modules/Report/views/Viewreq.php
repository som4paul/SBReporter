<div class="content-page text-dark">
   
    <div class="content">
        <div class="container">


<div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Requests in your Queue</b></h4>
                                    <p class="text-muted font-13 m-b-30">
                                        Please find below the requests in your Queue pending to be reported accordingly
                                    </p>

                                    <table id="view_req" class="table table-striped  table-colored table-info">
                                        <thead>
                                        <tr>
                                            <th>SLNO</th>    
                                            <th>Request Id</th>
                                            <th>Requested By</th>
                                            <th>Requested At</th>
                                            <th>Request Note</th>
                                            <th>Documents Attached</th>
                                            <th>Create Advanced Report</th>
                                            <th>Create Covering Report</th>
                                            <th>Mark as Complete</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        

        <?php  if(!empty($requests)) { ?>
            <?php for($i=0;$i<count($requests);$i++) {?>
                                             <tr>
                                            <td><?php echo ($i+1) ; ?></td>    
                                            <td><?php echo $requests[$i]['REQ_LOG_NAME'] ; ?></td>
                                             <td><?php echo $requests[$i]['REQ_BY'] ; ?></td>
                                             <td><?php echo $requests[$i]['REQ_AT'] ; ?></td>
                                             

                                             <td><textarea class="expand" rows="1" cols="10"><?php echo $requests[$i]['REQ_NOTE'];?></textarea></td>
                                             <td><a id="<?php echo $requests[$i]['REQID']?>" href="#"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                                            
                                             <td><a id="<?php echo $requests[$i]['REQID']?>" href="<?php echo base_url()."Report/Advrepc"?>"><i class="glyphicon  glyphicon-text-background"></i></a></td>
                                             
                                             <td><a id="<?php echo$requests[$i]['REQID']?>" href="<?php echo base_url()."Report/Covrepc"?>"><i class="glyphicon glyphicon-copyright-mark"></i></a></td>

                                             <td><a id="<?php echo $requests[$i]['REQID']?>" href="#"?><i class="glyphicon glyphicon-fire"></i></a></td>

                                            
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



