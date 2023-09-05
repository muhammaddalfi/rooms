$(document).ready(function(){

    var table = $('.datatable-permission').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/permission/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
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

    //add jenis_keluhan
    $(document).on('click','.add_permission', function(e){
        e.preventDefault();
        $('#modal_permission').modal('show');   

    })


    var permission = $('#form-permission')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form1  = new FormData(permission);
        console.log(form1);
        // $.ajax({
        //     url: '/permission',
        //     method:'POST',
        //     data: form,
        //     processData: false,
        //     contentType: false,

        //     success: function(response){
        //         if(response.status == 400)
        //         {
        //             console.log(response);
        //             $('#error_name').html(response.errors.name);
                  
        //         }else{
        //            console.log(response); 
        //             table.draw();
        //             Swal.fire({
        //             title: 'Success!',
        //             text: 'Data berhasil disimpan',
        //             icon: 'success'
        //             });

        //             $('#modal_permission').modal('hide');
        //             $("#form-permission")[0].reset();
        //         }
        //     }
        // })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_permission').modal('show');
        $.ajax({
            type:"GET",
            url:"/permission/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_permission').val(response.permission.id);
                    $('#edit_name').val(response.permission.name);
                }
            }
        })
    })

   $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_permission').val();
        var data = {
            'edit_name': $('#edit_name').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/permission/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
              Swal.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_permission').modal('hide');
            
            }
        })

    });


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
                    url: "/permission/" + id,
                   
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