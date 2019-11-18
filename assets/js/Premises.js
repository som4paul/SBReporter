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
		leftColumns: 1,
		rightColumns: 7
	}
}).draw();