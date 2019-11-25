<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Circulars & Memos</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="text-right">
                                <button class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#myAddModal"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                        </div>
                        <hr/>
                        <?php if($this->session->userdata('flag') == 'insert'){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is Inserted Successfully</strong>
                        </div>
                        <?php 
                            $flag = '';
                            $this->session->set_userdata('flag',$flag);
                        }?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-colored table-teal firtable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl.No.</th>
                                        <th class="text-center">Circular No</th>
                                        <th>Circular Title</th>
                                        <th>Circular Message</th>
                                        <th class="text-center">Site URL</th>
                                        <th class="text-center">File URL</th>
                                        <th class="text-center">Circular Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="dlist">
                                    <?php foreach($cir_memo as $key => $cm){ ?>
                                    <tr>
                                        <td class="text-center"><?php echo $key+1;?></td>
                                        <td><?php echo $cm['CIRCULAR_NO'];?></td>
                                        <td><?php echo $cm['CIRCULAR_TITLE'];?></td>
                                        <td><?php echo $cm['CIRCULAR_MESSAGE'];?></td>
                                        <td class="text-center">
                                          <?php if(isset($cm['SITE_URL'])){ ?> 
                                            <a href="<?php echo $cm['SITE_URL']; ?>" target="_blank"><i class="mdi mdi-web" style="font-size: 20px;"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td class="text-center">
                                          <?php if(isset($cm['FILE_URL'])){ ?> 
                                            <a href="<?php echo $this->config->item('view_path').'circulars/'.$cm['FILE_URL']; ?>" target="_blank"><i class="mdi mdi-file-pdf" style="font-size: 20px;"></i></a>
                                          <?php } ?>
                                        </td>
                                        <td class="text-center"><?php echo toDisplayDate($cm['CIRCULAR_DATE']);?></td>
                                        <td class="text-center">
                                            <button value="<?php echo base64_encode(json_encode($cm));?>" data-target="#myUpdModal" data-toggle="modal" class="btn btn-xs btn-warning btn-rounded cmdet"><i class="glyphicon glyphicon-edit text-white f15"> </i></button>
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

<!-- ADD MODAL -->

<div id="myAddModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Add New Broadcast Messages</h4>
            </div>
            <br/>
            <?php echo form_open_multipart(base_url('Admin/addNew/'.$this->method));?>
            <div class="modal-body">
               <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>1.Circular Title:</label>
                       <input type="text" name="CIRCULAR_TITLE" class="form-control max" maxlength="200" required="required">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>2.Circular Text:</label>
                       <textarea required="required" class="form-control max" maxlength="4000" name="CIRCULAR_MESSAGE"></textarea>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>3.Site URL:</label>
                       <input type="text" name="SITE_URL" class="form-control max" maxlength="200">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>4.Circular No.:</label>
                       <input type="text" name="CIRCULAR_NO" class="form-control max" maxlength="100">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>5.Circular Date:</label>
                       <input type="text" name="CIRCULAR_DATE" class="form-control datepicker-autoclose" readonly="readonly" required="required" placeholder="dd/mm/yyyy">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>6.File URL:</label>
                       <input type="file" name="uploadFile">
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Save</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<!-- UPDATE MODAL -->

<div id="myUpdModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Update Broadcast Messages</h4>
            </div>
            <br/>
            <?php echo form_open_multipart(base_url('Admin/edit/'.$this->method));?>
              <div class="modal-body">
                <input type="hidden" name="CIRCULAR_ID" id="CIRCULAR_ID">
                <input type="hidden" name="FILE_URL" id="FILE_URL">
               <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>1.Circular Title:</label>
                       <input type="text" name="CIRCULAR_TITLE" class="form-control max" maxlength="200" required="required" id="CIRCULAR_TITLE">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>2.Circular Text:</label>
                       <textarea required="required" class="form-control max" maxlength="4000" name="CIRCULAR_MESSAGE" id="CIRCULAR_MESSAGE"></textarea>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>3.Site URL:</label>
                       <input type="text" name="SITE_URL" class="form-control max" maxlength="200" id="SITE_URL">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>4.Circular No.:</label>
                       <input type="text" name="CIRCULAR_NO" class="form-control max" maxlength="100" id="CIRCULAR_NO">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>5.Circular Date:</label>
                       <input type="text" id="CIRCULAR_DATE" name="CIRCULAR_DATE" class="form-control datepicker-autoclose" readonly="readonly" required="required" placeholder="dd/mm/yyyy">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>6.File URL:</label>
                       <input type="file" name="uploadFile">
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Update</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('includes/contentFooter'); ?>