<?php //jQuery  ?>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.js" type="text/javascript"></script>
<!-- <script src="<?php #echo base_url(); ?>plugins/waypoints/jquery.waypoints.min.js"></script> -->
<!-- <script src="<?php #echo base_url(); ?>plugins/counterup/jquery.counterup.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/pages/jquery.todo.js"></script>

<?php //Datatable ?>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
<?php //File Upload ?>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
<?php //Multi Select ?>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<?php //Sweet-Alert  ?>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/jquery.sweet-alert.init.js"></script>
<?php // Select2 js ?>
<script src="<?php echo base_url(); ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<?php //Maxlength ?>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<?php // init ?>
<script src="<?php echo base_url(); ?>assets/pages/jquery.datatables.init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>
<?php //Counter js ?>

<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<?php //Jquery-Ui ?>
<!-- <script src="<?php// echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script> -->
<?php //Calendar js ?>
<script src='<?php echo base_url(); ?>assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
<script src="<?php echo base_url(); ?>assets/pages/jquery.fullcalendar.js"></script>
<?php //App js ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
<?php //Init js ?>
<script src="<?php echo base_url(); ?>assets/pages/jquery.form-pickers.init.js"></script>
<?php //Year Picker ?>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<?php //Password Strength Checker ?>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery-Password-Strength-Checker/password_strength/password_strength_lightweight.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/XHR2.js" type="text/javascript"></script>

<?php //Modal-Effect ?>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/js/custombox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/custombox/js/legacy.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js"></script>
<?php //Custom JavaScript Files ?>
<script type="text/javascript">
	var resizefunc = [];
	var csrfData = {};
	csrfData["<?php echo $this->security->get_csrf_token_name(); ?>"] = "<?php echo $this->security->get_csrf_hash(); ?>";
	$(function() {
        $.ajaxSetup({
           data: csrfData
        });   
	});
	var base_url = "<?php echo base_url(); ?>";
	var view_path = "<?php echo $this->config->item('view_path');?>";
	var module = "<?php echo $this->module; ?>";

	var width = window.screen.width;

	if(width > 768 && width <= 2560 ){
		$(".topsearch").addClass("wid300");
		$(".tsrch").addClass("wid300");
	}
</script>
<script src="<?php echo base_url(); ?>assets/js/<?php echo $this->module; ?>.js?i=<?php echo get_script_md5($this->module); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js?i=<?php echo get_script_md5('custom'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/mapPlot.js"></script>

<?//Bootstrap Multiselect ?>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>

<script src="https://apis.google.com/js/platform.js?onload=myFunc" async defer></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
