$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/olt/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'nama_olt'},
            {data:'lat'},
            {data:'lng'},
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

    $(document).on('click','.map', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        url = "https://www.google.com/maps/search/"+ id;
        window.open(url, '_blank');
    })

    $('.pic').select2({
        dropdownParent: $('#modal_olt'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_pic').select2({
        dropdownParent: $('#modal_edit_olt'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    //add olt
    $(document).on('click','.add_olt', function(e){
        e.preventDefault();
        $('#modal_olt').modal('show');   

    })

     $(document).on('click','.import_olt', function(e){
        e.preventDefault();
        $('#modal_import_olt').modal('show');   

    })

    var excel = $('#form-import-olt')[0];
    $('#import_excel').on('click',function(e){
        e.preventDefault();
        var import_excel  = new FormData(excel);
        // console.log(data);
        $.ajax({
            url: '/import/olt',
            method:'POST',
            data: import_excel,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    // $('#error_nama_olt').html(response.errors.nama_olt);
                    // $('#error_lat').html(response.errors.lat);
                    // $('#error_lng').html(response.errors.lng);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data Berhasil Ditambahkan',
                        icon: 'success'
                    });

                    $('#modal_import_olt').modal('hide');
                    $("#form-import-olt")[0].reset();
                }
            }
        })

    })

    var olt = $('#form-olt')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(olt);
        // console.log(data);
        $.ajax({
            url: '/olt/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_nama_olt').html(response.errors.nama_olt);
                    $('#error_lat').html(response.errors.lat);
                    $('#error_lng').html(response.errors.lng);
                    $('#error_pic').html(response.errors.pic);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Sukses!',
                    text: 'Data Berhasil Ditambahkan',
                    icon: 'success'
                    });

                    $('#modal_olt').modal('hide');
                    $("#form-olt")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_olt').modal('show');
        $.ajax({
            type:"GET",
            url:"/olt/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_olt').val(response.olt.id);
                    $('#edit_nama_olt').val(response.olt.nama_olt);
                    $('#edit_lat').val(response.olt.lat);
                    $('#edit_lng').val(response.olt.lng);
                    $('#edit_pic').val(response.olt.user_id).change();
                }
            }
        })
    })

   $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_olt').val();
        var data = {
            'edit_nama_olt': $('#edit_nama_olt').val(),
            'edit_lat': $('#edit_lat').val(),
            'edit_lng': $('#edit_lng').val(),
            'edit_pic': $('#edit_pic').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/olt/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
              Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_olt').modal('hide');
            
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
                    url: "/olt/delete/" + id,
                   
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