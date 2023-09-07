$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/pengguna/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'email'},
            {data:'handphone'},
            {data: 'action', name: 'action', className: 'text-center',orderable: false, searchable: false, width: 220}
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

    //add olt
    $(document).on('click','.add_pengguna', function(e){
        e.preventDefault();
        $('#modal_marketer').modal('show');   

    })

    $('.role').select2({
        dropdownParent: $('#modal_marketer'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    var marketers = $('#form-marketer')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(marketers);
        // console.log(data);
        $.ajax({
            url: '/pengguna/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                console.log(response);
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_name').html(response.errors.nama);
                    $('#error_email').html(response.errors.email);
                    $('#error_hp').html(response.errors.hp);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_marketer').modal('hide');
                    $("#form-marketer")[0].reset();
                }
            }
        })

    })

     $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_admin').modal('show');
        // $.ajax({
        //     type:"GET",
        //     url:"/upline/edit/" + id,
        //     success: function(response){
        //         if(response.status == 404){
        //             console.log("Data not found");
        //         }else{
        //             $('#id_leader').val(response.leader.id);
        //             $('#edit_nama_leader').val(response.leader.name);
        //             $('#edit_email_leader').val(response.leader.email);
        //             $('#edit_handphone_leader').val(response.leader.handphone);
        //         }
        //     }
        // })
    })

    //delete
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
         // console.log(id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Warning alert
        Swal.fire({
            title: 'Remove data',
            text: "Are you sure ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/pengguna/delete/" + id,
                   
                    success: function(){
                        table.draw();
                        Swal.fire(
                            'Success!',
                            'Data has been removed',
                            'success'
                          )
                    }
                })
            }
        });   

    });
    

});