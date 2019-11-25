function getIoDetails(target){
	var target = target;
	$.ajax({
		url:base_url+module+'/getIoDetails',
		type:'POST',
		data:{tar:target},
		success:function(data){
			$('.unitiotable').DataTable().clear().destroy();
			$('.dlist').html(data);
			$('.unitiotable').DataTable().draw();

		}
	});
}

function getOCname(pscode){
	var pscode = pscode;
	$.ajax({
		url:base_url+module+'/getOC',
		type:'POST',
		data:{pscode:pscode},
		success:function(data){
			data = JSON.parse(atob(data));
			$('#OCNAME').val(data);
		}
	});
}

$(document).on('change','.acti_flag',function(){
	var val = $(this).val();
	val = atob(val);

	$.ajax({
		url:base_url+module+'/updateActiFlag',
		type:'POST',
		data:{val:val},
		success:function(data){
			if(data == 1){
				alert('Data Updated Successfully');
			}
		}
	});
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	var target = $(e.target).attr("href");
	getIoDetails(target);
});

$('#PSCODE').change(function(){
	var pscode = $(this).val();
    getOCname(pscode);
});

$(document).ready(function(){
    var target = '#tp';
    getIoDetails(target);

    var pscode = $('#PSCODE').val();
    getOCname(pscode);
});

$(document).on('change','.actIO',function(){
	var val = $(this).val();
	$.ajax({
		url:base_url+module+'/activateIO',
		type:'POST',
		data:{val:val},
		success:function(data){
			if(data == 1){
				alert('Data Updated Successfully');
				location.reload();
			}
		}
	});
});

$(document).on('click','.det',function(){
	var det = $(this).val();
	det = atob(det);
	det = det.split("|");
	$('.ioname').val(det[2]);
	$('.gpfno').val(det[3]);
	var v = btoa(det[0]+"|"+det[1]);
	$('.upio').val(v);
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);