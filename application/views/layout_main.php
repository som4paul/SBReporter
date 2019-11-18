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
        <div class='ldr' style="">
            <div class="loader-wrap">
                <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
            </div>
        </div>
        
        <?php //Begin page ?>
        <div id="wrapper">
        	<?php $this->load->view('includes/topbar'); ?>
        	<?php $this->load->view('includes/sidebar'); ?>
            <?php $this->load->view('includes/modals'); ?>
            <?php echo $subview; ?>
        </div>
        <?php //End page ?>
        <?php $this->load->view('includes/footer'); ?>
    </body>
</html>