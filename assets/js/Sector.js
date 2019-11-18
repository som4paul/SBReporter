$('#datatable').DataTable( {
	"order": [],
	"dom": 'Blfrtip',
	"buttons": [
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL'
        },
        {
            extend: 'excel'
        }
    ]
} ).draw();