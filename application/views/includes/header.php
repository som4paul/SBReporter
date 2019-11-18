<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Kolkata Police, Election Monitoring System"/>
    <meta name="description" content="Kolkata Police Election Monitoring System">
    <meta name="author" content="e-Governance Cell">
    <meta name="copyright" content="e-Governance Cell">
    <meta name="theme-color" content="#9EEDEF">
    <?php //App favicon ?>
    <link href="<?php echo base_url(); ?>assets/images/logo_sm.png" rel="shortcut icon">
    <?php //App title ?>
    <title><?php if(isset($title)) echo $title; ?> | Kolkata Police Special Branch Reporting System</title>
    <?php //Morris Chart CSS ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.css"><?php // Bootstrap Select ?>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <?php //Calendar ?>
    <link href="<?php echo base_url();?>assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
    <?php //DataTable ?>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<!--     <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/> -->
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <?php //Multi Select ?>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

    <?php //Maxlength ?>
    <link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <?php //App css ?>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" >
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <?php //select2 CSS?>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    
    <?php // Sweet Alert ?>
    <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

    <?php //Hover CSS ?>
    <link href="<?php echo base_url(); ?>/assets/css/hover.css" rel="stylesheet">
    <?php //Year Picker ?>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" rel="stylesheet">
    <?php //Custom Stylesheet ?>
    <link href="<?php echo base_url(); ?>assets/css/custom.css?i=<?php echo get_style_md5('custom'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/loader.css" rel="stylesheet">
    <?php /* HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif] */ ?>
    <?php //Password Strength Checker ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jQuery-Password-Strength-Checker/password_strength/password_strength.css">
    
    <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>

        <!-- Google Charts js -->
        <script src="https://www.google.com/jsapi"></script>
        <!-- Init -->
        <script src="<?php echo base_url(); ?>assets/pages/jquery.google-charts.init.js"></script>

</head>