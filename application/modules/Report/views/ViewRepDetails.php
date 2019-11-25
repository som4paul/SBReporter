<div class="content-page text-dark">
   
    <div class="content">
        <div class="container">

<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Report Details :-
                                        <?php if(!empty($reports_details)) {
                                            echo $reports_details[0]['RP_LOG_ID'] ; ?></b></h4>
									<p class="text-muted m-b-30 font-13">
										Please Find the report dertails below 
									</p>

									<table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               <!--  <th></th>
                                                <th>
                                                    Extra small devices
                                                    <small>Phones (&lt;768px)</small>
                                                </th>
                                                <th>
                                                    Small devices
                                                    <small>Tablets (≥768px)</small>
                                                </th>
                                                <th>
                                                    Medium devices
                                                    <small>Desktops (≥992px)</small>
                                                </th>
                                                <th>
                                                    Large devices
                                                    <small>Desktops (≥1200px)</small>
                                                </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php foreach($reports_details[0] as $key =>$value){?>
                                            <tr>
                                              
                                                <th><?php 
                                                if($key=='RP_ID')
                                                    echo 'Report#' ; 
                                                    else if($key=='RP_TYPE')
                                                        echo 'Report Type' ; 


                                                    else if($key=='OFID')
                                                        echo 'Assigned Officer' ;
                                                    else if($key=='SUP_OFIDS')
                                                        echo 'Superiors assigned' ;     else if($key=='OTHR_OFIDS')
                                                        echo 'Other Officers assigned' ; 
                                                            else 
                                                               echo $key  ;      




                                                ?></th>
                                                <td><?php if($key=='SUP_OFIDS'||$key=='OTHR_OFIDS'||$key=='FILE_PATH') 
                                                {
                                                    
                                                    if($key=='FILE_PATH'){

                                                        for($i=0;$i<count($value);$i++){
                                                       echo "<a href='". $value[$i]."'>".$value[$i]."</a><br>" ; }//end of for
                                                    }

                                                 else{   
                                                    for($i=0;$i<count($value);$i++){
                                                        echo $value[$i]."<br>" ; 
                                                    }} //end of else
                                                }


                                                else
                                                    echo $value;?></td>

                                          
                                               <!--  <td colspan="3">Collapsed to start, horizontal above breakpoints</td> -->
                                            </tr>
                                              <?php }?>
                                            
                                        </tbody>
                                    </table>

                                    <?php
                            echo form_open(base_url('Converse/ViewConverse'));
                        ?>

                                <input type="hidden" value="<?php echo $reports_details[0]['RP_ID']?>" name="RP_ID">
                                   <center> <button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light">View Conversation(s)</button></center>

                                    <?php
                            echo form_close();
                        }
                                            ?>
                                
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
