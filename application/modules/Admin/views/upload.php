<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Existing Documents</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="card-box">
                <div class="row">
                  <div class="text-right">
                      <button class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#myAddModal"><i class="fa fa-plus"></i> Add New</button>
                  </div>
                </div>
                <hr/>
                <?php if($this->session->userdata('up_flag') == 'insert'){ ?>
                  <div class="alert alert-success" role="alert">
                      <strong>Data is Inserted Successfully</strong>
                  </div>
                <?php 
                    $flag = '';
                    $this->session->set_userdata('up_flag',$flag);
                  } if($this->session->userdata('flag') == 'update'){ ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Data Updated Successfully</strong>
                    </div>
                <?php 
                    $flag = '';
                    $this->session->set_userdata('flag',$flag);
                } ?>
                <div class="table-responsive">
                  <table id="datatable" class="table table-striped table-colored table-teal firtable">
                      <thead>
                          <tr>
                              <th class="text-center tw5">Sl.No.</th>
                              <th class="tw40">Document Description</th>
                              <th class="tw30">Upload Date</th>
                              <th class="tw10">File Name</th>
                              <th class="text-center tw15">Action</th>
                          </tr>
                      </thead>
                      <tbody class="dlist">
                        <?php foreach($res as $key => $value){ ?>
                        <tr>
                          <td class="text-center tw5"><?php echo $key+1;?></td>
                          <td class="tw40"><?php echo $value['DOCUMENT_DESC'];?></td>
                          <td class="tw30"><?php echo toDisplayDate($value['UPLOAD_DATE']);?></td>
                          <?php 
                            $ext = substr($value['FILE_NAME'], strripos($value['FILE_NAME'], ".")+1);
                            if ($ext == "jpg" || $ext == "JPG" || $ext == "jpeg" || $ext == "JPEG" || $ext == "png" || $ext == "PNG") {
                                  $icon = '<i class="mdi mdi-file-image" style="font-size:20px;"></i>';
                            } elseif ($ext == "pdf" || $ext == "PDF"){
                                  $icon = '<i class="mdi mdi-file-pdf" style="font-size:20px;"></i>';
                            } elseif ($ext == "doc" || $ext == "DOC" || $ext == "docx" || $ext == "DOCX") {
                                  $icon = '<i class="mdi mdi-file-word" style="font-size:20px;"></i>';
                            } elseif ($ext == "xls" || $ext == "XLS" || $ext == "xlsx" || $ext == "XLSX") {
                                  $icon = '<i class="mdi mdi-file-excel" style="font-size:20px;"></i>';
                            } elseif ($ext == "ppt" || $ext == "PPT" || $ext == "pptx" || $ext == "PPTX") {
                                  $icon = '<i class="mdi mdi-file-powerpoint" style="font-size:20px;"></i>';
                            }elseif ($ext == "rar" || $ext == "zip") {
                                  $icon = '<i class="fa fa-file-zip-o (alias)" style="font-size:20px;"></i>';
                            }
                          ?>
                          <td class="tw10"><a target="_blank" href="<?php echo $this->config->item('view_path').'documents/'.$value['FILE_NAME']; ?>"><?php echo $icon;?></a></td>
                          <td class="text-center tw15">
                            <button class="btn btn-rounded btn-warning btn-group btn-sm upEdit" data-target="#myUpdModal" data-toggle="modal" value="<?php echo base64_encode(json_encode($value));?>"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-rounded btn-danger btn-group btn-sm deldoc" value="<?php echo base64_encode(json_encode($value));?>"><i class="fa fa-times"></i></button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>

<!-- ADD MODAL -->

<div id="myAddModal" class="modal fade bs-example-modal-md text-dark" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="header-title m-t-0">Upload</h4>
            </div>
            <br/>
            <?php echo form_open_multipart(base_url('Admin/doUpload'));?>
            <div class="modal-body">
              <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <label>File Description:</label>
                    <input type="text" name="DOCUMENT_DESC" class="form-control max" maxlength="2000">
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <label>Upload File:</label>
                    <br><br>
                    <input type="file" name="uploadFile">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-rounded waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Upload</button>
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
               <div class="row">
                <input type="hidden" name="DOCUMENT_ID" id="DOCUMENT_ID">
                <input type="hidden" name="FILE_NAME" id="FILE_NAME">
                <input type="hidden" name="FILE_TYPE" id="FILE_TYPE">
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>1.Edit File Description:</label>
                       <input type="text" name="DOCUMENT_DESC" class="form-control max" maxlength="2000" id="DOCUMENT_DESC">
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <label>2.File URL:</label>
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