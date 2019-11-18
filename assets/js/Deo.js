$(document).ready(function(){
	$('#deoaclist').hide();
	$("#deodivlist").hide();
});

$(document).on('change','.deoidforac',function(){
	$.ajax({
        url:base_url+module+'/getACbyDeoID',
        type:'POST',
        data:{deoid:$(this).val()},
        beforeSend:function(){
        	$("#deoaclist").hide('slow');
        },
        success:function(data){
          	$("#deoaclist").show('slow');
	        $('#datatable').DataTable().clear().destroy();
	        $('.dlist').html(data);
	        //$('#datatable').DataTable().draw();
			$('#datatable').DataTable( {
				dom: 'Blfrtip',
				buttons: [
		            {
		                extend: 'pdf',
		                orientation: 'landscape',
		                pageSize: 'LEGAL'
		            },
		            {
		                extend: 'excel'
		            }
		        ],
				// scrollY:        "300px",
				scrollX:        true,
				scrollCollapse: true,
				paging:         true,
				fixedColumns:   {
					leftColumns: 1,
					rightColumns: 7
				}
			} ).draw();
		},
	});
});

$(document).on('change','.deoidfordiv',function(){
	$.ajax({
        url:base_url+module+'/getDIVbyDeoID',
        type:'POST',
        data:{deoid:$(this).val()},
        beforeSend:function(){
        	$("#deodivlist").hide('slow');
        },
        success:function(data){
          	$("#deodivlist").show('slow');
	        $('#datatable').DataTable().clear().destroy();
	        $('.divlist').html(data);
	        $('#datatable').DataTable({
	        	"order": [],
	        	dom: 'Blfrtip',
				buttons: [
		            {
		                extend: 'pdfHtml5',
		                orientation: 'landscape',
		                pageSize: 'LEGAL'
		            },
		            {
		                extend: 'excel'
		            }
		        ],
				// scrollY:        "300px",
				scrollX:        true,
				scrollCollapse: true,
				paging:         true,
				fixedColumns:   {
					leftColumns: 2,
					rightColumns: 7
				}
			} ).draw();
        },
    });
});