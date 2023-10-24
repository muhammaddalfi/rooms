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

    $("input[type='search']").wrap("<form>");
    $("input[type='search']").closest("form").attr("autocomplete","off");

    $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{ 
                orderable: false,
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });

        $('.datatable-cluster-admin').DataTable({
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
            initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
        });

        $('.datatable-cluster-jenis_kegiatan').DataTable({
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
            initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
            
        });

        $('.datatable-cluster-sales').DataTable({
            scrollX: true,
            scrollY: true,
            scrollCollapse: true,
            fixedColumns: true,
            initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
        });

        $('.datatable-sales-input').DataTable({
            responsive: true,
            searching: false,
            lengthChange: false,
        });


});
