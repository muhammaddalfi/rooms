$(document).ready(function(){

    $('.datatable-cluster-user').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/olt/fetch',
        pageLength : 5,
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false, width:10},
            {data: 'action', name: 'action', className: 'text-center',orderable: false, searchable: false, width: 50},
            {data:'nama_olt'}
        ],
        order: [[ 0, "desc" ]],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
    });

    $(document).on('click','.map', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        url = "https://www.google.com/maps/search/"+ id;
        window.open(url, '_blank');
    })


});