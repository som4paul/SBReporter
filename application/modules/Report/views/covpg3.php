<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Please Select Covering Report Uploading Attributes</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
             <?php
                            echo form_open(base_url('Report/Covrepi'));
                        ?>

                  <input type="hidden" name="RP_PRIORITY" value="<?php echo $RP_PRIORITY ; ?>"> 
                  <input type="hidden" name="RP_MODE" value="<?php echo $RP_MODE ; ?>"> 
                 	    
		<div class="row">
			<div class="col-md-6 m-t-50">
				<div class="panel panel-border panel-teal hi1000 wid1000" align="center">
                   	<div class="panel-heading">
                        </div>
                        <div class="panel-body">				
                        					
	                                           
	                                            

	                                             
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Pogram Type</label>                                           
	                                               
	                                               <!--  <div class="col-md-10"> -->
	                                                       <select class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" id="EVID" name="EVID" required>
                                           <option selected="true" disabled="disabled" value="">Select Event Type</option> 
                                           <?php /*pre($prog_type,1) ;*/ foreach ($prog_type as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['EVID'];?>"><?php echo $value['EVENT_NAME'];?></option>
                                            
                                           <?php  } ?>                                       
                             				</select>
	                                               <!--  </div> -->

	                                                   <span id="othev" name="othev" style="display:none;">
                             					<!-- OPTIONAL TEXT INPUT IN OTHER SELECT -->

	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Other Event Type</label>
                             				 <div class="col-md-10">
                             				<input type="text" class="form-control max" maxlength="50" name="OTHEREVENT" placeholder="please enter other event type" >
	                                                </div>
	                                            </div>

                             				</span>
	                                                
	                                            </div>
	                                            
	                                          
	                                          
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Note</label>
	                                                <div class="col-md-10">
	                                                    <textarea class="form-control max" maxlength="500" name="NOTE" rows="5"></textarea>
	                                                </div>
	                                            </div>
	                                           <div class="form-group">
	                                                <label class="col-md-2 control-label">Concerned Officer Incharge</label>                                 
	                                                                                           
	                                     <select class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98"  name="OFID" >
                                           <option selected="true" disabled="disabled" value="">Select Concerned OCs Name</option> 
                                           <?php  foreach ($offcr_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].") - ".$value['PS_NAME']?></option>
                                            
                                           <?php  } ?>                                       
                             				</select>	                                                
	                                            </div>
	                                            <br><br>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">cc to other DOs </label>                                 
	                                                                                           
	                                     <select class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" required multiple="multiple" name="OTHR_OFIDS[]">
                                           <option selected="true" disabled="disabled" value="" >Select DOs Name</option> 
                                           <?php  foreach ($do_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].") - ".$value['PS_NAME']?></option>
                                            
                                           <?php  } ?>                                       
                             				</select> 	                                                
	                                            </div>
	                                             <br><br>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">cc to other OCs </label>                                 
	                                                                                           
	                                     <select class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" required multiple="multiple" name="OTHR_OFIDS[]">
                                           <option selected="true" disabled="disabled" value="" >Select OCs Name</option> 
                                           <?php  foreach ($offcr_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].") - ".$value['PS_NAME']?></option>
                                            
                                           <?php  } ?>                                       
                             				</select> 	                                                
	                                            </div> 
	                                            <br><br>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">cc to ACs </label>                                 
	                                                                                           
	                                     <select id="dolist"class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" required multiple="multiple" name="OTHR_OFIDS[]">
                                           <option selected="true" disabled="disabled" value="" >Select ACs Name</option> 
                                           <?php  foreach ($ac_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].") - ".$value['DIV_NAME']?></option>
                                            
                                           <?php  } ?>                                       
                             				</select> 	                                                
	                                            </div> 
	                                            <br><br>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">cc to DCs </label>                                 
	                                                                                           
	                                     <select id="dolist"class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" required multiple="multiple" name="OTHR_OFIDS[]">
                                           <option selected="true" disabled="disabled" value="" >Select DCs Name</option> 
                                           
                                             <?php  foreach ($dc_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].")";?></option>
                                            
                                           <?php  } ?>                                       
                             				</select> 	                                                
	                                            </div> 


	       										<div class="form-group">
	                                                <label class="col-md-2 control-label">Upload Reports </label>                                 
	                                                                                           
												                            
											            <input type="file" multiple="" name="images[]">                                           
	                                            </div> 


	                                        </div> 	   
	                         <button type="submit" align="midle" class="btn btn-info waves-effect w-md waves-light">Submit</button>   <br><br>                                 

										</div>
	                                    
	                                                                          
 								<br><br>
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