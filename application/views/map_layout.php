<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('includes/header'); ?>
	<body class="fixed-left">
        <?php // Loader ?>
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
        
        <?php //Begin page ?>
        <div id="wrapper">
        	<?php $this->load->view('includes/map_topbar'); ?>
            <?php echo $subview; ?>
        </div>
        <?php //End page ?>
        <?php $this->load->view('includes/footer'); ?>
    </body>
</html>