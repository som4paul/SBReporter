//Sidebar function

$('#run_proc').click(function(){
	$.ajax({
		url:base_url+'Admin/run_all',
		type:'post',
		data:{},
		beforeSend:function(){
			$('.ldr').css('display','block');
		},
		success:function(data){
			if (data == 1){
				alert("All Procedure executed successfully....");
			}else{
				alert("Something went wrong....");
			}
			$('.ldr').css('display','none');
		}
	});
});

//Topbar function

$('.advCheck').change(function(){
	if($(this).is(':checked')){
		$('#topadvsearch').show();
		$('#topsearch').hide();
	}else{
		$('#topadvsearch').hide();
		$('#topsearch').show();
	}
});

// Transforming Tables to DataTable
	$(".KPdatatable").dataTable();
	$(".KPdatatable").dataTable();
	// Function I don't know
	$(document).ready(function(){
		$('#topadvsearch').hide();
		$('#topsearch').show();
		$('.ldr').css('display','none');
		$('#datatable').dataTable();
	    $('#datatable-keytable').DataTable({keys: true});
	    $('#datatable-responsive').DataTable();
	    $('#datatable-colvid').DataTable({
	        "dom": 'C<"clear">lfrtip',
	        "colVis": {
	            "buttonText": "Change columns"
	        }
	    });
	    $('#datatable-scroller').DataTable({
	        ajax: "plugins/datatables/json/scroller-demo.json",
	        deferRender: true,
	        scrollY: 380,
	        scrollCollapse: true,
	        scroller: true
	    });
	    var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
	    var table = $('#datatable-fixed-col').DataTable({
	        scrollY: "300px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        fixedColumns: {
	            leftColumns: 1,
	            rightColumns: 1
	        }
	    });
	    TableManageButtons.init();
	    $('.year').datepicker({
	        minViewMode: 'years',
	        autoclose: true,
	        format: 'yyyy'
	    });

    	$(".InActive").hide();
		$('.alertRow').click(function(){
   			var i= $(this).nextUntil('tr.alertRow').slideToggle(1000);
  			console.log(i);
		});

		$('.alertRow').click(function(){
   			var i= $(this).nextUntil('tr.alertRow').slideToggle(1000);
		});

		//GET URL METHOD
		function getMethod(){
			var host = window.location.host;
			var pathArray = window.location.pathname.split( '/' );
			if(host == 'localhost'){
				return pathArray[3];
			} else {
				return pathArray[2];
			}
		}

		function myEncode_js(param){
			var enc_param = btoa(param).replace(/\=/g, '');
			return enc_param;
		};

		$('.max').maxlength({
		    alwaysShow: true,
		    warningClass: "label label-success",
		    limitReachedClass: "label label-danger",
		    separator: ' out of ',
		    preText: 'You typed ',
		    postText: ' chars available.',
		    validate: true
		});

		function numberFiledValidate(event) {
		    if(!(event.which>=48 && event.which<=57) && event.which != 0 && event.which != 8) {
		        event.preventDefault();
		    }
		}

		$(".number").keypress(function(event) {
			numberFiledValidate(event);
		});
	});