$(document).ready(function(){

	$('#scudlist').hide();

	$('#udsrch').click(function(){
      	var psname = $('#ps').val();
      	var date = $('#uddate').val();
	    $.ajax({
	    	type: 'POST',
	    	url: base_url+module+'/getUdData',
	    	data: {
		    	psname: psname,
		    	date: date
	    	},
		    success: function(data){
			    $('#deathdatatable').DataTable().clear().destroy();
			    $('#deathdatatable').show('slow');
			    $('.dlist').html(data);
			    $('#deathdatatable').DataTable().draw();
			    $('#scudlist').show('slow');
			}
	    });
    });

	$(document).on('click','.uddet',function(){
		var details = $(this).val();
		details = atob(details);
		$('#udfileDet').val(btoa(details));
	});

	window.setTimeout(function() {
	    $(".alert").fadeTo(400, 0).slideUp(400, function(){
	        $(this).remove(); 
	    });
	},3000);

});

