function textCount(id,len){
	var maxlength = 4000;
	if(id === 'brieffact1'){
		var length = len.length;
		length = maxlength-length;
		$('#char1').text(length);
	}
}

$('#brieffact1').keyup(function() {
	var id = $(this).attr('id');
	var len = $(this).val();
	textCount(id,len);
});

$('#PO_NATURE').change(function() {
	var val = $(this).val();
	if(val == 'Others'){
		$('#ponature').show();
		$('#ponature').prop('required',true);
	}
	else{
		$('#ponature').hide();
		$('#ponature').prop('required',false);
	}
});

$('.approve').click(function(){
	$.ajax({
		url:base_url+module+'/sendApprove',
		type:'POST',
		data:{val:$(this).val()},
		success:function(data){
			if(data == 1)
				alert('Request Sent');
			location.reload();
		}
	})
});

$('#division').change(function(){
 	$('#PS').html('<option>Loading.....</option>');
    var div = $('#division').val();
    $.ajax({
        url:base_url+module+'/getPsByDiv',
        type:'POST',
        data:{divcode:div},
        success:function(data){
        	data = JSON.parse(atob(data));
            $('#PS').html(data);   
        },
    });
});

$('.received').prop('disabled',true);
$('.approval').prop('disabled',true);
$('.rec').show();
$('.rec2').hide();
function dtCng(id){
	$('.receive'+id).prop('disabled',false);
	$('.rec2').show();
	$('.rec').hide();
}

function appdtChg(id){
	$('.apprvd'+id).prop('disabled',false);
}

function statChg(id){
	var child = true;
	if(!($('.DC_MEMO_DT'+id).closest('tr').hasClass('child')) && !($('.DC_MEMONO'+id).closest('tr').hasClass('child'))){
		child = false;
	}
	var memodate = $('.DC_MEMO_DT'+id).val();
	var memono = $('.DC_MEMONO'+id).val();
	if(child){
		memodate = $('.child .DC_MEMO_DT'+id).val();
		memono = $('.child .DC_MEMONO'+id).val();
	}
	var reqid = $('.approval').val();
	$.ajax({
		url:base_url+module+'/getApproval',
		type:'POST',
		data:{
			memodate:memodate,
			memono:memono,
			id:reqid
		},
		success:function(data){
			if(data == 1){
				alert('Approved Successfully');
			} else if(data == 'false'){
				alert('This memo no is already exists');
			}
			location.reload();
		}
	});
}

function statCng(id){
	var child = true;
	if(!$('.VISIT_DATE'+id).closest('tr').hasClass('child')){
		child = false;
	}
	var date = $('.VISIT_DATE'+id).val();
	if(child){
		date = $('.child .VISIT_DATE'+id).val();
	}
	var reqid = $('.received').val();
	$.ajax({
		url:base_url+module+'/getVisited',
		type:'POST',
		data:{
			date:date,
			id:reqid
		},
		success:function(data){
			if(data == 1){
				alert('Visited Successfully');
			}
			location.reload();
		}
	});
}

function statApprvd(id){
	var child = true;
	if(!$('.MFU_RECEIVED_DT'+id).closest('tr').hasClass('child')){
		child = false;
	}
	var reqid = $('.statapp').val();
	$.ajax({
		url:base_url+module+'/getApproved',
		type:'POST',
		data:{id:reqid},
		success:function(data){
			if(data == 1){
				alert('Received Successfully');
			}
			location.reload();
		}
	});
}

function dtChg(id){
	$('.appr'+id).prop('disabled',false);
}

$(document).on('blur','.dcmemo',function(){
	$.ajax({
		url:base_url+module+'/checkMemo',
		type:'post',
		data:{memono:$(this).val()},
		success:function(data){
			if(data == '1'){
				alert('This memo no is already exists');
			}
		}
	});
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);