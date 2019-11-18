$(document).on('change','.bdmsg',function(){
	$.ajax({
		url:base_url+module+'/on_off',
		type:'post',
		data:{val:$(this).val()},
		success:function(data){
			if(data == 1){
				alert('Data Updated Successfully');
				location.reload();
			}
		}
	});
});

$(document).on('click','.bmdet',function(){
	let data = $(this).val();
	data = JSON.parse(atob(data));
	$('#MESSAGE_TITLE').val(data['MESSAGE_TITLE']);
	$('#MESSAGE_TEXT').val(data['MESSAGE_TEXT']);
	$('#SITE_URL').val(data['SITE_URL']);
	$('#FILE_URL').val(data['FILE_URL']);
	$('#MESSAGE_ID').val(data['MESSAGE_ID']);
	$('#MESSAGE_DATE').val(data['MESSAGE_DATE']);
	if(data['ON_OFF'] == 'Y'){
		$('#switch').attr('checked',true);	
	}else{
		$('#switch').attr('checked',false);	
	}
});

$(document).on('click','.cmdet',function(){
	let data = $(this).val();
	data = JSON.parse(atob(data));
	$('#CIRCULAR_ID').val(data['CIRCULAR_ID']);
	$('#CIRCULAR_TITLE').val(data['CIRCULAR_TITLE']);
	$('#CIRCULAR_MESSAGE').val(data['CIRCULAR_MESSAGE']);
	$('#SITE_URL').val(data['SITE_URL']);
	$('#FILE_URL').val(data['FILE_URL']);
	$('#CIRCULAR_NO').val(data['CIRCULAR_NO']);
	$('#CIRCULAR_DATE').val(data['CIRCULAR_DATE']);
});

$(document).on('click','.upEdit',function(){
	let data = $(this).val();
	data = JSON.parse(atob(data));
	$('#DOCUMENT_ID').val(data['DOCUMENT_ID']);
	$('#DOCUMENT_DESC').val(data['DOCUMENT_DESC']);
	$('#FILE_NAME').val(data['FILE_NAME']);
	$('#FILE_TYPE').val(data['FILE_TYPE']);
});

$(document).on('click','.delete',function(){
	$.ajax({
		url:base_url+module+'/deleteContact',
		type:'post',
		data:{id:$(this).val()},
		success:function(data){
			if(data == 1){
				location.reload();
			}
		}
	});
});

$(document).on('click','.deldoc',function(){
	let data = $(this).val();
	data = JSON.parse(atob(data));
	$.ajax({
		url:base_url+module+'/deleteFile',
		type:'post',
		data:{id:data['DOCUMENT_ID'],file:data['FILE_NAME']},
		success:function(data){
			if(data == 1){
				location.reload();
			}
		}
	});
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);