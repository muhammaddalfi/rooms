$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/radius/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'nama_setting'},
            {data:'value_setting'},
            {data:'kode_setting'},
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

    //add radius
    $(document).on('click','.add_radius', function(e){
        e.preventDefault();
        $('#modal_radius').modal('show');   

    })

    

    var radius = $('#form-radius')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(radius);
        // console.log(data);
        $.ajax({
            url: '/radius/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_nama_setting').html(response.errors.nama_setting);
                    $('#error_value_setting').html(response.errors.value_setting);
                    $('#error_kode_setting').html(response.errors.kode_setting);
                  
                }else{
                   console.log(response); 
                    
                    Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Berhasil Ditambahkan',
                    icon: 'success'
                    });
                    table.draw();
                    $("#form-radius")[0].reset();
                    $('#modal_radius').modal('hide');
                }
            }
        })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_radius').modal('show');
        $.ajax({
            type:"GET",
            url:"/radius/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_radius').val(response.radius.id);
                    $('#edit_nama_setting').val(response.radius.nama_setting);
                    $('#edit_value_setting').val(response.radius.value_setting);
                    $('#edit_kode_setting').val(response.radius.kode_setting);
                }
            }
        })
    })

   $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_radius').val();
        var data = {
            'edit_nama_setting': $('#edit_nama_setting').val(),
            'edit_value_setting': $('#edit_value_setting').val(),
            'edit_kode_setting': $('#edit_kode_setting').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/radius/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
              Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_radius').modal('hide');
            
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
            text: "Kamu Yakin ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/radius/delete/" + id,
                   
                    success: function(){
                        table.draw();
                        Swal.fire(
                            'Success!',
                            'Data Berhasil dihapus',
                            'success'
                          )
                    }
                })
            }
        });   

    });
    

});