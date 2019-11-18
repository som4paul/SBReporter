<?php //pre($_SESSION,1);?>
<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Address Book</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-border panel-teal hi150">
                        <div class="panel-heading">
                          <div class="text-right">
                            <a href="<?php echo base_url();?>Admin/addNewAddBook"><button class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New</button></a>
                          </div>
                          <br>
                        </div>
                        <?php if($this->session->userdata('flag') == 'insert'){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data is Inserted Successfully</strong>
                        </div>
                        <?php 
                            $flag = '';
                            $this->session->set_userdata('flag',$flag);
                        } if($this->session->userdata('flag') == 'update'){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Data Updated Successfully</strong>
                        </div>
                        <?php 
                            $flag = '';
                            $this->session->set_userdata('flag',$flag);
                        }?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-colored table-teal">
                                        <thead>
                                            <tr>
                                                <th class="text-center" >SL.NO.</th>
                                                <th>CONTACT DETAILS</th>
                                                <th class="text-center">MOBILE NOs</th>
                                                <th class="text-center">OFFICE NOs</th>
                                                <th>EMAIL ADDRESS</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($addBook as $key => $val){ ?> 
                                           <tr>
                                               <td class="text-center"><?php echo $key+1;?></td>
                                               <td><?php echo $val['CONTACT_NAME'];?><br><?php echo $val['CONTACT_DESIG']?></td>
                                               <td class="text-center">
                                                <?php if(isset($val['MOBILE_1'])){ ?>
                                                <i class="fa fa-phone"></i>&nbsp;<?php echo $val['MOBILE_1'];?><br>
                                                <?php } if(isset($val['MOBILE_2'])){ ?>
                                                <i class="fa fa-phone"></i>&nbsp;<?php echo $val['MOBILE_2']; ?><br>
                                                <?php } if(isset($val['WHATSAPP_1'])){ ?>
                                                <i class="fa fa-whatsapp"></i>&nbsp;<?php echo $val['WHATSAPP_1']; } ?>
                                              </td>
                                               <td class="text-center">
                                                <?php if(isset($val['OFFICE_1'])){ ?>
                                                <i class="mdi mdi-phone-classic"></i>&nbsp;<?php echo $val['OFFICE_1']; echo (isset($val['EXTN_1']) ? '(EXTN-' : ''); echo $val['EXTN_1']; echo (isset($val['EXTN_1']) ? ')' : '');?>
                                                  <br>
                                                  <?php } if(isset($val['OFFICE_2'])){ ?>
                                                  <i class="mdi mdi-phone-classic"></i>&nbsp;<?php echo $val['OFFICE_2']; echo (isset($val['EXTN_2']) ? '(EXTN-' : ''); echo $val['EXTN_2']; echo (isset($val['EXTN_2']) ? ')' : ''); } ?>
                                                  <br>
                                                  <?php if(isset($val['FAX_NO'])){?>
                                                  <i class="mdi mdi-fax"></i>
                                                  <?php echo $val['FAX_NO']; } ?>     
                                                </td>
                                                <td>
                                                  <?php if(isset($val['EMAIL_1'])){ ?>
                                                  <i class="mdi mdi-email-open"></i>&nbsp;<?php echo $val['EMAIL_1'];?><br>
                                                    <?php } if(isset($val['EMAIL_2'])){ ?>
                                                    <i class="mdi mdi-email-open"></i>&nbsp;<?php echo $val['EMAIL_2']; } ?>
                                                  </td>
                                                  <td>
                                                    <a href="<?php echo base_url();?>Admin/editData/<?php echo myEncode($val['CONTACT_ID']);?>" class="btn btn-rounded btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <button value="<?php echo myEncode($val['CONTACT_ID']);?>" class="btn btn-rounded btn-danger btn-sm delete"><i class="fa fa-times"></i></a>
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
            </div>
        </div>
    </div> <?php //container ?>
</div> <?php //content ?>
<?php $this->load->view('includes/contentFooter'); ?>