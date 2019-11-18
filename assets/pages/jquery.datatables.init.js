/**
 * Theme: Zircos Admin Template
 * Author: Coderthemes
 * Component: Datatable
 * 
 */
var handleDataTableButtons = function() {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            }, {
                extend: "csv",
                className: "btn-sm"
            }, {
                extend: "excel",
                className: "btn-sm"
            }, {
                extend: "pdf",
                className: "btn-sm"
            }, {
                extend: "print",
                className: "btn-sm"
            }],
            responsive: !0
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
    }();





    var handleDataTableButtons = function() {
        "use strict";
        0 !== $("#TMdatatable").length && $("#TMdatatable").DataTable({
            "lengthMenu":[[10,25,50,100,500,-1],[10,25,50,100,500,"All"]],
            dom: "Blfrtip",
            buttons: [{
                extend: "excel",
                className: "btn-sm btn-purple"
            },{
                extend: "pdf",
                className: "btn-sm btn-info"
            }],
            responsive: !0
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
    }();