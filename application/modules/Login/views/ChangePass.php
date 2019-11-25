<div class="content-page text-dark">
    <?php //Start content ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Change Password</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                            <li class="active">Change Password</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row text-dark">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <h4 class="m-t-0 header-title"><b>Change Password</b></h4>
                        </div>
                        <hr/>
                        <div class="row" id="curpass">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="cp" type="password" name="cp" required="required" autocomplete="off">
                                        <span class="input-group-addon"><i class="mdi mdi-eye-off pwdshow toggleCP"></i><i class="mdi mdi-eye pwdoff toggleCP"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        </div>
                        <?php echo form_open(base_url('changepasswd'), array('id'=>'pwdchng', 'data-parsley-validate'=>'')); ?>
                        <div class="row" id="npwd" hidden>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="p" type="password" name="p" required="required" autocomplete="off">
                                        <span class="input-group-addon"><i class="mdi mdi-eye-off pwdshow toggleP"></i><i class="mdi mdi-eye pwdoff toggleP"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        </div>
                        <div class="row" id="rpwd" hidden>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Retype New Password</label>
                                    <div class="input-group">
                                        <input class="form-control" id="rp" type="password" name="rp" required="required" autocomplete="off">
                                        <span class="input-group-addon"><i class="mdi mdi-eye-off rpwdshow toggleRP"></i><i class="mdi mdi-eye rpwdoff toggleRP"></i></span>
                                    </div>
                                    <span class="" id="msg"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="message">
                                <h5 class="text-danger">Password must contain the following:</h5>
                                <span id="letter" class="invalid f15">A <b>Lowercase</b> Letter</span><br>
                                <span id="capital" class="invalid f15">A <b>Capital (Uppercase)</b> Letter</span><br>
                                <span id="number" class="invalid f15">A <b>Number</b></span><br>
                                <span id="special" class="invalid f15">A <b>Special Character (Symbol)</b></span><br>
                                <span id="length" class="invalid f15">Minimum <b>8 Characters</b></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                                <div class="form-group">
                                    <button type="button" id="nxt" class="btn btn-primary btn-rounded waves-effect waves-light">Next&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                                    <button type="submit" id="updt" class="btn btn-success btn-rounded waves-effect waves-light" hidden><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Update</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/contentFooter'); ?>
<script src="<?php echo base_url(); ?>assets/js/pwdcheck.js"></script>
