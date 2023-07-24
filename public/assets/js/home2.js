/* ------------------------------------------------------------------------------
 *
 *  # Datatables data sources
 *
 *  Demo JS code for datatable_data_sources.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

const DatatableDataSources = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    const _componentDatatableDataSources = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });


        // HTML sourced data
        if (typeof statusForSearch === 'undefined') {
            $('.datatable-html').dataTable({
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [ 5 ]
                }]
            });
        }
        else{
            $('.datatable-html').dataTable({
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [ 5 ]
                }],
                search: {
                    search: statusForSearch
                }
            });
        }
    };

    return {
        init: function() {
            _componentDatatableDataSources();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    DatatableDataSources.init();
});
