<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add New</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
              <div class="col-sm-12">
                <div class="card-box">
                  <?php 
                      echo form_open(base_url('Admin/saveData/'.$this->method));
                  ?>
                  <div class="row">
                    <input type="hidden" name="CONTACT_ID" value="<?php echo (isset($res[0]['CONTACT_ID']) ? $res[0]['CONTACT_ID'] : ''); ?>">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="fa fa-user"></i> Contact name</label>
                      <input type="text" name="CONTACT_NAME" class="form-control max" maxlength="100" value="<?php echo (isset($res[0]['CONTACT_NAME']) ? $res[0]['CONTACT_NAME'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label><i class="fa fa-black-tie"></i> Designation</label>
                        <input type="text" name="CONTACT_DESIG" class="form-control max" maxlength="50" value="<?php echo (isset($res[0]['CONTACT_DESIG']) ? $res[0]['CONTACT_DESIG'] : ''); ?>">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <label><i class="fa fa-mobile"></i> Mobile No. 1</label>
                        <input type="text" name="MOBILE_1" class="form-control max number" maxlength="10" value="<?php echo (isset($res[0]['MOBILE_1']) ? $res[0]['MOBILE_1'] : ''); ?>">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <label><i class="fa fa-mobile"></i> Mobile No. 2</label>
                        <input type="text" name="MOBILE_2" class="form-control max number" maxlength="10" value="<?php echo (isset($res[0]['MOBILE_2']) ? $res[0]['MOBILE_2'] : ''); ?>">
                    </div>
                    <?php if(isset($res[0]['CONTACT_CATEGORY'])){ ?>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label> Category</label>
                        <select class="form-control" name="CONTACT_CATEGORY">
                          <option value="" selected="selected" disabled="disabled">Select</option>
                          <?php foreach($con_cat as $val){ ?>
                          <option value="<?php echo $val['CONTACT_CATEGORY'];?>"<?php if($res[0]['CONTACT_CATEGORY'] == $val['CONTACT_CATEGORY']) echo 'selected';?>><?php echo $val['CONTACT_DESC'];?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <?php } else { ?>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label> Category</label>
                        <select class="form-control" name="CONTACT_CATEGORY">
                          <option value="" selected="selected" disabled="disabled">Select</option>
                          <?php foreach($con_cat as $val){ ?>
                          <option value="<?php echo $val['CONTACT_CATEGORY'];?>"><?php echo $val['CONTACT_DESC'];?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="mdi mdi-email-open"></i> Email Address 1</label>
                      <input type="text" name="EMAIL_1" class="form-control max" maxlength="100" value="<?php echo (isset($res[0]['EMAIL_1']) ? $res[0]['EMAIL_1'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label><i class="mdi mdi-email-open"></i> Email Address 2</label>
                        <input type="text" name="EMAIL_2" class="form-control max" maxlength="100" value="<?php echo (isset($res[0]['EMAIL_2']) ? $res[0]['EMAIL_2'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="fa fa-whatsapp"></i> Whatsapp No.</label>
                      <input type="text" name="WHATSAPP_1" class="form-control max number" maxlength="10" value="<?php echo (isset($res[0]['WHATSAPP_1']) ? $res[0]['WHATSAPP_1'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label><i class="mdi mdi-fax"></i> Fax</label>
                        <input type="text" name="FAX_NO" class="form-control max number" maxlength="8" value="<?php echo (isset($res[0]['FAX_NO']) ? $res[0]['FAX_NO'] : ''); ?>">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <label><i class="mdi mdi-phone-classic"></i> Office No. 1</label>
                        <input type="text" name="OFFICE_1" class="form-control max number" maxlength="8" value="<?php echo (isset($res[0]['OFFICE_1']) ? $res[0]['OFFICE_1'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="mdi mdi-phone-classic"></i> Extension 1</label>
                      <input type="text" name="EXTN_1" class="form-control max number" maxlength="6" value="<?php echo (isset($res[0]['EXTN_1']) ? $res[0]['EXTN_1'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="mdi mdi-phone-classic"></i> Office No. 2</label>
                      <input type="text" name="OFFICE_2" class="form-control max number" maxlength="8" value="<?php echo (isset($res[0]['OFFICE_2']) ? $res[0]['OFFICE_2'] : ''); ?>">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <label><i class="mdi mdi-phone-classic"></i> Extension 2</label>
                      <input type="text" name="EXTN_1" class="form-control max number" maxlength="6" value="<?php echo (isset($res[0]['EXTN_1']) ? $res[0]['EXTN_1'] : ''); ?>">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-rounded"><i class="fa fa-floppy-o"></i> Save</button>
                    </div>
                  </div>
                  <?php echo form_close();?>
                </div>
              </div>
            </div>

    </div> <?php //container ?>
</div> <?php //content ?>

<?php $this->load->view('includes/contentFooter'); ?>