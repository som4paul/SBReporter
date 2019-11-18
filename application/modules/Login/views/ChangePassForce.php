<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Kolkata Police, Criminal Record System, Criminal, Record, System, Kolkata, Police"/>
        <meta name="description" content="Kolkata Police Criminal Record System">
        <meta name="author" content="e-Governance Cell">
        <meta name="copyright" content="e-Governance Cell">
        <meta name="theme-color" content="#9DE5F6">
        <title>Kolkata Police Special Branch Reporting System</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo_sm.png">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.css">
        <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
    </head>
    <body class="loginBody">

        <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <section>
            <div class="container-alt text-dark">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages" style="background-color: #8DEAFC">
                                <div class="text-center">
                                    <h2 class="text-uppercase">
                                        <a href="<?php echo base_url(); ?>" class="text-success">
                                            <span><img src="<?php echo base_url(); ?>assets/images/kplogo.png" alt="KP Logo" class="kpimg m-t-10" height="100"></span>
                                        </a>
                                    </h2>
                                    <h4 class="text-uppercase loginTxt anton">Criminal Record System</h4>
                                    <h3 class="text-white"><span class="cookie loginTxt"><em>an SB initiative</em></span></h3>
                                </div>

                                <div class="account-content">
                                    <div class="text-center m-b-20">
                                        <p class="m-b-0 font-15">Your password has not been changed for a long time. Please change your password immediately.</p>
                                    </div>
                                    <?php
                                        if(!empty($loginmsg)){
                                    ?>
                                            <h5 class="text-pink text-center"><?php echo $loginmsg;?></h5>
                                    <?php
                                        }
                                        echo form_open(base_url('updatepassforce'),array('class'=>'form-horizontal','data-parsley-validate'=>''));
                                    ?>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="p">New Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="p" type="password" name="p" required="required" autocomplete="off">
                                                    <span class="input-group-addon"><i class="mdi mdi-eye-off pwdshow toggleP"></i><i class="mdi mdi-eye pwdoff toggleP"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label for="rp">Confirm Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="rp" type="password" name="rp" required="required" autocomplete="off">
                                                    <span class="input-group-addon"><i class="mdi mdi-eye-off rpwdshow toggleRP"></i><i class="mdi mdi-eye rpwdoff toggleRP"></i></span>
                                                </div>
                                                <span class="" id="msg"></span>
                                            </div>
                                        </div>
                                        <div id="message">
                                            <h5 class="text-danger">Password must contain the following:</h5>
                                            <span id="letter" class="invalid f15">A <b>Lowercase</b> Letter</span><br>
                                            <span id="capital" class="invalid f15">A <b>Capital (Uppercase)</b> Letter</span><br>
                                            <span id="number" class="invalid f15">A <b>Number</b></span><br>
                                            <span id="special" class="invalid f15">A <b>Special Character (Symbol)</b></span><br>
                                            <span id="length" class="invalid f15">Minimum <b>8 Characters</b></span>
                                        </div>
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-info waves-effect waves-light" type="submit" id="updt">Change Password</button>
                                            </div>
                                        </div>
                                    <?php
                                        echo form_close();
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Login.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pwdcheck.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ForcePassChange.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/select2.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>
        <script type="text/javascript">
            var resizefunc = [];
            var base_url = "<?php echo base_url(); ?>";
            $(function($) {
                $.ajaxSetup({
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}
                });
            });
        </script>
    </body>
</html>
