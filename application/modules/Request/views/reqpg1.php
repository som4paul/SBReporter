<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Please Select Request Report Attributes</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
             <?php
                            echo form_open(base_url('Request/Reqin'));
                        ?>

                   
                 	    
		<div class="row">
			<div class="col-md-6 m-t-50">
				<div class="panel panel-border panel-teal hi1000 wid1000" align="center">
                   	<div class="panel-heading">
                        </div>
                        <div class="panel-body">				
                        					
	                                           
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Note:-</label>
	                                                <div class="col-md-10">
	                                                    <textarea class="form-control max" maxlength="500" name="REQ_NOTE" rows="5"></textarea>
	                                                </div>
	                                            </div>
	                                        
	                                            <br><br><br><br><br><br>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Select DOs :- </label>                                 
	                                                                                           
	                                     <select class="col-md-10 selectpicker" data-live-search="true" data-style="btn-teal" tabindex="-98" multiple="multiple" required name="REQ_TO[]">
                                           <option selected="true" disabled="disabled" value="" >Select DO Name</option> 
                                           <?php  foreach ($do_name as $key => $value) {
	                                                	# code...?>    
                                            <option value="<?php echo $value['OFID'];?>"><?php echo $value['OF_NAME']."(".$value['DESIG_NAME'].") - ".$value['PS_NAME']?></option>
                                            
                                           <?php  } ?>                                       
                             				</select> 	                                                
	                                            </div>
	                                             <br><br>
	                                            
	                                            <br><br>
	                                           
	                                            <br><br>
	                                           


	       										<div class="form-group">
	                                                <label class="col-md-2 control-label">Upload Request Documents(if any!) </label>                                 
	                                                                                           
												                            
											            <input type="file" multiple="" name="images[]">                                           
	                                            </div> 


	                                        </div> 	   
	                         <button type="submit" align="midle" class="btn btn-info waves-effect w-md waves-light">Send</button>   <br><br>                                 

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