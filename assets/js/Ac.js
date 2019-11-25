$(document).ready(function(){
	$('#acpslist').hide();
	$("#pcdivlist").hide();
});

$(document).on('change','.acidforps',function(){
	$.ajax({
        url:base_url+module+'/getPSbyACID',
        type:'POST',
        data:{acid:$(this).val()},
        beforeSend:function(){
        	$("#acpslist").hide('slow');
        },
        success:function(data){
          	$("#acpslist").show('slow');
	        $('#datatable').DataTable().clear().destroy();
	        $('.pslist').html(data);
	        //$('#datatable').DataTable().draw();
			$('#datatable').DataTable( {
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
