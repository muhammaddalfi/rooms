/* ------------------------------------------------------------------------------
 *
 *  # Fixed Columns extension for Datatables
 *
 *  Demo JS code for datatable_extension_fixed_columns.html page
 *
 * ---------------------------------------------------------------------------- */

$(document).ready(function(){
    $('.bulan').select2({
    });

    $('.tahun').select2({
    });

    // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            dom: '<"datatable-header"fl><"datatable-scroll datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });


        // Cluster
        $('.datatable-cluster').DataTable({
           
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
        });

        // Kegiatan
        $('.datatable-perusahaan').DataTable({
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
            searching: false,
            lengthChange: false
        });

        $('.datatable-kegiatan').DataTable({
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
            searching: false,
            lengthChange: false
        });


        $('.datatable-cluster-leader-internal').DataTable({
           
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
        });


});
