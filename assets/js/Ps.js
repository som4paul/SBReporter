$('#datatable').DataTable({
	"order": [],
	dom: 'Blfrtip',
	buttons: [
        {
            extend: 'pdfHtml5',
            orientation: 'POTRAIT',
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
		rightColumns: 2
	}
}).draw();