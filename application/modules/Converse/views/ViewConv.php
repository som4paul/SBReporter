<div class="content-page text-dark">
   
    <div class="content">
        <div class="container" >

<div class="col-sm-12">
                                <div class="timeline">
                                    <article class="timeline-item alt">
                                        <div class="text-right">
                                            <div class="time-show first">
                                                <a href="#" class="btn btn-danger w-lg">Conversation(s) for :- <?php echo $rep_log_id[0]['RP_LOG_ID'] ; ?>  </a>
                                            </div>
                                        </div>
                                    </article>


                                <?php foreach($Convdets as $key=>$value){?>
                                        
                                    <?php if($Convdets[$key]['CREATED_BY']==$this->session->userdata('OFID')){ ?>
                                   <article class="timeline-item ">
                                        <div class="timeline-desk">
                                            <div class="panel">
                                                <div class="timeline-box">
                                                    <span class="arrow"></span>
                                                    <span class="timeline-icon bg-success"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                    <h4 class="text-success"><?php echo $Convdets[$key]['CREATED_BY_NAME'] ; ?></h4>
                                                    <p class="timeline-date text-muted"><small><?php echo $Convdets[$key]['CREATED_DATE_TIME'] ; ?></small></p>
                                                    <p><?php echo $Convdets[$key]['CONV_TEXT'] ; ?></p>

                                                    <p>
                                        <?php                                   for($i=0;$i<count($Convdets[$key]['file_path']);$i++) 


                                                    echo "<a href= '".$Convdets[$key]['file_path'][$i]."'> FILE#    ".($i+1)." </a><br>" ; ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                <?php }/*end of if*/else {?> <br><br><br>
                                    <article class="timeline-item alt">
                                        <div class="timeline-desk">
                                            <div class="panel">
                                                <div class="timeline-box">
                                                    <span class="arrow"></span>
                                                    <span class="timeline-icon bg-success"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                    <h4 class="text-success"><?php echo $Convdets[$key]['CREATED_BY_NAME'] ; ?></h4>
                                                    <p class="timeline-date text-muted"><small><?php echo $Convdets[$key]['CREATED_DATE_TIME'] ; ?></small></p>
                                                    <p><?php echo $Convdets[$key]['CONV_TEXT'] ; ?></p>

                                                    <p>
                                        <?php                                   for($i=0;$i<count($Convdets[$key]['file_path']);$i++) 


                                                    echo "<a href= '".$Convdets[$key]['file_path'][$i]."'> FILE#    ".($i+1)." </a><br>" ; ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
 <?php  }//end of else
                                        }//end of foreach?>

                                 <br><br><br>

                                    <?//input article?>
                                     
                                     <article class="timeline-item  ">
                                        <div class="timeline-desk">
                                            <div class="panel">
                                                <div class="timeline-box">
                                                    <span class="arrow"></span>
                                                    <span class="timeline-icon bg-success"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                    <h4 class="text-success">Add your Comment Here</h4>
                                                    <p class="timeline-date text-muted"><small></small></p>

                                                     <?php
                            echo form_open(base_url('Converse/Addconv'));
                        ?>  <input type="hidden" name="REPORT_ID" value="<?php echo $RPID ; ?>">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Comment</label>
                                                    
                                                        <textarea class="form-control max" maxlength="500" required name="CONV_TEXT" rows="5"></textarea>


                                                     <br><br>   
                                                    <label class="col-md-2 control-label">Attach File(s) </label>                                 
                                                                                               
                                                                            
                                                        <input type="file" multiple="" name="images[]">       

                                                        <br><br><br>                           
                                                        <button type="submit" align="midle" class="btn btn-info waves-effect w-md waves-light">Comment</button>               
                                               
                                                    
                                                </div>
                                                        <?php
                            echo form_close();
                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
                            
                                   

                                </div>
                            </div>
                        </div>
                    </div>
                </div>