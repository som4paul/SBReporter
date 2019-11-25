// Transforming Tables to DataTable
	// $(".KPdatatable").dataTable();
	// $(".KPdatatable").dataTable();
	// Function I don't know
	$(document).ready(function(){
    	$(".InActive").hide();
		$('.alertRow').click(function(){
   			var i= $(this).nextUntil('tr.alertRow').slideToggle(1000);
  			console.log(i);
		});

		$('.alertRow').click(function(){
   			var i= $(this).nextUntil('tr.alertRow').slideToggle(1000);
		});

		// ARREST JAVASCRIPT

		$(".crimehead").hide();
		$(".ipcsllact").hide();
		$("#msg").hide();
		$(document).on('change', '.arrestagainst', function(){
			var a = $(this).val();
			var mother = $(this).parent().parent().parent().parent();
			if(a == 'FIR' || a == 'SPECIFIC'){
				mother.children().children(".crimehead").show();
				mother.children().children(".ipcsllact").show();
				mother.children("#msg").show();
			}
			else{
				$(".crimehead").hide();	
			}
		});

		// ADD & DELETE div row dynamically
		$(document).on('click','.add',function(){
			var mother = $(this).parent().parent();
			var mother2 = $(this).parent().parent().parent();
			var obj = mother.clone();
			var obj2 = mother2.clone();
			$('.append_panel2').append(obj2);
			$('.append_panel').append(obj);
			obj.find("input, textarea").val("");
			obj.children("#msg").hide();
			obj.children().children(".crimehead").hide();
			obj.children().children(".ipcsllact").hide();
			jQuery('.datepicker-autoclose').datepicker({
		        autoclose: true,
		        todayHighlight: true,
		        format: "dd/mm/yyyy"
		    });
		});

		$(document).on('click','.delete',function(){
			var count = $(this).parent().parent().parent().children().size();
			if(count > 1){
				$(this).parent().parent().remove();
			}
			else{
				alert('Sorry! Cannot remove first row..');
			}
		});

		$(document).on('click','.delete1',function(){
			var count = $(this).parent().parent().parent().parent().children().size();
			console.log(count);
			if(count > 1){
				$(this).parent().parent().parent().remove();
			}
			else{
				alert('Sorry! Cannot remove first row..');
			}
		});


		//ADD & DELETE table row dynamically

		$(document).on('click','.addrow',function(){
			var mother = $(this).parent().parent().parent().parent();
			var obj = mother.children('tbody').children("tr:eq(0)").clone();
			mother.append(obj);
		});

		$(document).on('click','.deleterow',function(){
			var count = $(this).parent().parent().parent().children().size();
			if(count > 1){
				$(this).parent().parent().remove();
			}
			else{
				alert('Sorry! Cannot remove first row..');
			}
		});

		//CASE TRANSFER JAVASCRIPT

		$("#transfer_to_io").hide();
		$("#transfer_to_ps").hide();
		$("#transfer_to_agency").hide();
		$("#section").hide();
		$("#tansfer_type").change(function(){
			var type = $(this).val();
			if(type == 'IO-IO'){
				$("#transfer_to_io").show();
				$("#transfer_to_ps").hide();
				$("#transfer_to_agency").hide();
				$("#section").hide();
			}
			else if(type == 'PS-PS'){
				$("#transfer_to_io").hide();
				$("#transfer_to_ps").show();
				$("#transfer_to_agency").hide();
				$("#section").hide();	
			}
			else if(type == 'PS-OTH'){
				$("#transfer_to_io").hide();
				$("#transfer_to_ps").hide();
				$("#transfer_to_agency").show();
				$("#section").show();	
			}
		});

		//WARRANT OF ARREST JAVASCRIPT

		$("#year").change(function(){
			var val = $(this).val();
			if(val == "")
				$("#type").prop("disabled",true);
			else
				$("#type").prop("disabled",false);
		});

		$("#type").change(function(){
			var val = $(this).val();
			if(val == "")
				$("#stat").prop("disabled",true);
			else
				$("#stat").prop("disabled",false);
		});
		
      	$('#iniDate').change(function(){
        	var dateval = $('#iniDate').val();
          	$.ajax({
              type: 'POST',
              url: 'http://localhost/crskpv2/Login/check_date',
              data: {dateval: dateval},
               success: function(data) {
               	// console.log(data);
                if(data <= 0){
                    $('#IniButton').show();
                }else{
                    $('#IniButton').hide('');
                }                      
              },
           });
      	});
    });