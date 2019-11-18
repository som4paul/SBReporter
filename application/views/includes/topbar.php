<?php //Top Bar Start ?>
<div class="topbar">

    <?php //LOGO ?>
    <div class="topbar-left">
        <a href="<?php echo base_url(); ?>" class="logo"><span><img src="<?php echo base_url(); ?>assets/images/sbrms.png"></span><i><img src="<?php echo base_url(); ?>assets/images/logo_sm.png" height="50" width="50"></i></a>
    </div>
    
    <?php //Button mobile view to collapse sidebar menu ?>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <?php //Navbar-left ?>
            <div class="row">
                <ul class="nav navbar-nav navbar-left">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </div>
                    
                       <!--  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                        
                            <li class="hidden-xs hidden-sm" >
                                <div class="btn-switch btn-switch-inverse" style="padding-top: 15px;">
                                    <input type="checkbox" id="input-btn-switch-inverse" class="advCheck">
                                    <label for="input-btn-switch-inverse" class="btn btn-rounded btn-inverse waves-effect waves-light">
                                        <em class="glyphicon glyphicon-ok"></em>
                                        <strong> Advanced Search</strong>
                                    </label>
                                </div>
                            </li>
                        </div> -->
               <!--          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <li class="hidden-xs hidden-sm topsearch" id="topsearch">
                                <?php echo form_open(base_url('Dashboard/getSearchResult'), array('class' => 'app-search', 'role' => 'search'));?>
                                <input type="text" placeholder="Search..." id="tsrch" class="form-control tsrch" name="srchString">
                                <?php echo form_close();?>
                            </li>
                            <li class="hidden-xs hidden-sm topsearch" id="topadvsearch">
                                <?php echo form_open(base_url('Dashboard/advSearch'), array('class' => 'app-search', 'role' => 'search'));?>
                                <input type="text" placeholder="Advanced Search..." id="tsrch" class="form-control tsrch" name="srchString">
                                <?php echo form_close();?>
                            </li>      
                        </div> -->
                    </div>
                </ul>    
            
            

            <?php //Right(Notification) ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden-xs" style="padding-top: 10px;">
                    <h4 class="text-dark"><?php echo $this->session->userdata("USRNAME") ; ?></h4>
                </li>
                <li class="dropdown user-box">
                    <a href="#" class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown" aria-expanded="true">
                        <i class="mdi mdi-account-settings-variant" style="font-size: 30px;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li><a href="<?php echo base_url(); ?>changepass"><i class="ti-key m-r-5"></i> Change Password</a></li>
                        <li><a href="<?php echo base_url(); ?>logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                    </ul>
                </li>
            </ul> <?php //end navbar-right ?>
            </div>
        </div><?php //end container ?>
    </div><?php //end navbar ?>
</div>
<?php //Top Bar End ?>