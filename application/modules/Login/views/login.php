<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Kolkata Police, Election Monitoring System"/>
        <meta name="description" content="Kolkata Police Election Monitoring System">
        <meta name="author" content="e-Governance Cell">
        <meta name="copyright" content="e-Governance Cell">
        <meta name="theme-color" content="#9DE5F6">
        <?php // App favicon ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo_sm.png">
        <?php // App title ?>
        <title>Kolkata Police Special Branch Reporting System</title>
        <?php // App css ?>
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
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12 loginForm">
                        <div class="col-lg-6 col-md-6 col-sm-5">
                            <div class="imgBox">
                                <div class="text-center">
                                    <h2 class="text-uppercase">
                                        <a href="<?php echo base_url(); ?>" class="text-success">
                                            <span><img src="<?php echo base_url(); ?>assets/images/kplogo.png" alt="KP Logo" class="m-t-120 kpimg" height="200"></span>
                                        </a>
                                    </h2>
                                    <h1 class="text-uppercase loginTxt anton zoomIn">Special Branch Reporting System</h1>
                                    <h3 class="text-dark"><span class="cookie"><em>an Kolkata Police Special Branch initiative</em></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper-page col-lg-4 col-md-4 col-sm-4">
                            <div class="account-pages" style="background: #9DE9FD;">
                                <h5 class="p-t-10 text-center loginTxt">Please Login to Continue</h5>
                                <div class="account-content">
                                    <?php
                                        if(!empty($loginmsg)){
                                    ?>
                                            <h5 class="text-pink text-center"><?php echo $loginmsg;?></h5>
                                    <?php
                                        }
                                        echo form_open(base_url('process'),array('class'=>'form-horizontal'));
                                    ?>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label class="text-dark">Username</label>
                                                <input type="text" class="form-control" name="usrnm" required="required" placeholder="Enter Username">
                                            </div>
                                            <label class="text-orange"><?php echo form_error('usrnm'); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label class="text-dark">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="pwd" type="password" name="pwd" required="required" placeholder="Enter Password" autocomplete="off">
                                                    <span class="input-group-addon"><i class="mdi mdi-eye-off pwdshow toggle"></i><i class="mdi mdi-eye pwdoff toggle"></i></span>
                                                </div>
                                            </div>
                                            <label class="text-orange"><?php echo form_error('pwd'); ?></label>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="col-xs-12">
                                                <span id="captchaImg"><?php echo $image; // this will show the captcha image ?></span>
                                                <a class="btn btn-sm btn-icon waves-effect waves-light btn-pink" data-toggle="tooltip" data-placement="top" title data-original-title="Reload CAPTCHA" id="reloadBtn"><i class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label class="text-dark">CAPTCHA Code</label>
                                                <input class="form-control" type="text" required="required" placeholder="Enter CAPTCHA" autocomplete="off" name="captcha" maxlength="4">
                                            </div>
                                        </div>
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-custom waves-effect waves-light" type="submit">Log In</button>
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
        <?php // jQuery ?>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
        <?php // App js ?>
        <script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Login.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/select2.js" type="text/javascript"></script>
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