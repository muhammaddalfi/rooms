$(document).ready(function(){
   
    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/cyberkey/fetch',
        autoWidth: false,
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'serial_number'},
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

    //request pop
    $(document).on('click','.add_cyberkey', function(e){
        e.preventDefault();
        $('#modal_cyberkey').modal('show');
        
    })

    var data = $('#form-cyberkey')[0];
    $('#simpan').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/cyberkey/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log('gagal kirim');
                  
                }else{
                    console.log(response);
                    table.draw();
                    Swal.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                        $('#modal_cyberkey').modal('hide');
                        $("#form-cyberkey")[0].reset();
                }
            }
        })

    })

     //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_cyberkey').modal('show');
        $.ajax({
            type:"GET",
            url:"/cyberkey/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_serial_number').val(response.cyber.id);
                    $('#edit_serial_number').val(response.cyber.serial_number);
                }
            }
        })
    })

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var id = $('#id_serial_number').val();
        var data = {
            'edit_serial_number': $('#edit_serial_number').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/cyberkey/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
                
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Diubah',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  
                table.draw();
                  $('#modal_edit_cyberkey').modal('hide');
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
            text: "Mau Hapus nih ?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/cyberkey/delete/" + id,
                   
                    success: function(){
                        table.draw();
                        Swal.fire(
                            'Berhasil!',
                            'Data Berhasil dihapus',
                            'success'
                          )
                    }
                })
            }
        });   

    });
    
});