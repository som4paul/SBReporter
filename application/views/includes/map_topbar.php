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
                    </div>
                </ul>

            <?php //Right(Notification) ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:void(0);" class="right-bar-toggle right-menu-item">
                        <i class="mdi mdi-filter"></i>
                    </a>
                </li>
            </ul> <?php //end navbar-right ?>
            </div>
        </div><?php //end container ?>
    </div><?php //end navbar ?>
</div>
