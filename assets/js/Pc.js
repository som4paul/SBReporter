$(document).ready(function(){
	$('#pcaclist').hide();
	$("#pcdivlist").hide();
});

$(document).on('change','.pcidforac',function(){
	$.ajax({
        url:base_url+module+'/getACbyPCID',
        type:'POST',
        data:{pcid:$(this).val()},
        beforeSend:function(){
        	$("#pcaclist").hide('slow');
        },
        success:function(data){
          	$("#pcaclist").show('slow');
	        $('#datatable').DataTable().clear().destroy();
	        $('.aclist').html(data);
	        //$('#datatable').DataTable().draw();
			$('#datatable').DataTable( {
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
					leftColumns: 1,
					rightColumns: 7
				}
			} ).draw();
		},
	});
});

$(document).on('change','.pcidfordiv',function(){
	$.ajax({
        url:base_url+module+'/getDIVbyPCID',
        type:'POST',
        data:{pcid:$(this).val()},
        beforeSend:function(){
        	$("#pcdivlist").hide('slow');
        },
        success:function(data){
          	$("#pcdivlist").show('slow');
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