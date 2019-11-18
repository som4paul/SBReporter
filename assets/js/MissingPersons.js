function numberFiledValidate(event) {
    if(!(event.which>=48 && event.which<=57) && event.which != 0 && event.which != 8) {
        event.preventDefault();
    }
}

$(".number").keypress(function(event) {
	numberFiledValidate(event);
});

function height(){
	var ft = $('#ft').val();
	var inch = $('#inch').val();
	var cms = $('#cms').val();

	if(ft!= '' || inch!= ''){
		$('#cms').prop('readonly','readonly');
	} else if(cms!= ''){
		$('#ft').prop('readonly','readonly');
		$('#inch').prop('readonly','readonly');
	} else{
		$('#ft').prop('readonly','');
		$('#inch').prop('readonly','');
		$('#cms').prop('readonly','');
	}
}

$('#ft,#inch,#cms').blur(function(){
	height();
});

$('#search').click(function(){
	let ps = $('#PS').val();
	$.ajax({
		url:base_url+module+'/getMissingData',
		type:'post',
		data:{ps:ps},
		success:function(data){
			$('.KPdatatable').DataTable().clear().destroy();
			$('.dlist').html(data);
			TableManageButtons.init();
			$('.KPdatatable').DataTable().draw();
		}
	});
});

$('.max').maxlength({
    alwaysShow: true,
    placement: 'bottom'
});

$(document).ready(function(){
	$('#NATIONALITY').change(function(){
		var val = $(this).val();
		if(val == 'Foreign_National'){
			$('.nat').removeClass('readonly-input');
		} else{
			$('.nat').addClass('readonly-input');
		}
	});
});

$(document).on('click','.mis_det',function(){
	$('#missingID').val($(this).val());
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);