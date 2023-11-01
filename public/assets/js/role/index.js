$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/role/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'permission'},
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

    $(document).on('click','.add_role', function(e){
        e.preventDefault();
        $('#modal_role').modal('show');   

    })

     $('.permission').select2({
        dropdownParent: $('#modal_role'),
    });


    var form_role = $('#form-role')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        // console.log('clik');
        var form  = new FormData(form_role);
        $.ajax({
            url: '/role',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    // $('#error_name').html(response.errors.role);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                    });
                    $("#form-role")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_role').modal('show');
        $.ajax({
            type:"GET",
            url:"/role/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_role').val(response.role.id);
                    $('#edit_name').val(response.role.name);
                }
            }
        })
    })

    

//    $(document).on('click', '.save', function(e){
//         e.preventDefault();
//         var id = $('#id_role').val();
        

//         var data = {
//             'role': $('#role').val(),
//             'permission[]': $('#permission[]').val(),
//         }

//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $.ajax({
//             type:"PUT",
//             url:"/role/"+ id,
//             data: data,
//             dataType:"json",
//             success: function(response){
//             table.draw();
//               Swal.fire({
//                     title: 'Suksess!',
//                     text: 'Data berhasil disimpan!',
//                     icon: 'success'
//                 });
//                     $('#modal_edit_role').modal('hide');
            
//             }
//         })

//     });


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
            title: 'Hapus data',
            text: "Apakah kamu yakin ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/role/" + id,
                   
                    success: function(){
                        table.draw();
                        Swal.fire(
                            'Sukses!',
                            'Data berhasil dihapus',
                            'success'
                          )
                    }
                })
            }
        });   

    });
    

});