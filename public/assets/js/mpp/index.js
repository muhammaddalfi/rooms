$(document).ready(function(){

    var table_perusahaan = $('.datatable-perusahaan').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/mpp/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'email'},
            {data:'handphone'},
            {data: 'anggota', name: 'anggota', className: 'text-center',orderable: false, searchable: false, width: 220},
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

    var table_anggota_perusahaan = $('.datatable-anggota-perusahaan').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/perusahaan/anggota/list',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'email'},
            {data:'handphone'},
            {data:'leader'},
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

    //add perusahaan
    $(document).on('click','.add_mpp', function(e){
        e.preventDefault();
        $('#modal_mpp').modal('show');   

    })

    var leader_perusahaan = $('#form-mpp')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(leader_perusahaan);
        // console.log(data);
        $.ajax({
            url: '/mpp/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_name').html(response.errors.nama);
                    $('#error_email').html(response.errors.email);
                    $('#error_hp').html(response.errors.hp);
                  
                }else{
                    table_perusahaan.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_mpp').modal('hide');
                    $("#form-mpp")[0].reset();
                }
            }
        })

    })

    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_mpp').modal('show');
        $.ajax({
            type:"GET",
            url:"/mpp/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_mpp').val(response.mpp.id);
                    $('#edit_nama').val(response.mpp.name);
                    $('#edit_email').val(response.mpp.email);
                    $('#edit_handphone').val(response.mpp.handphone);
                }
            }
        })
    })

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var id = $('#id_mpp').val();
        var data = {
            'edit_nama': $('#edit_nama').val(),
            'edit_email': $('#edit_email').val(),
            'edit_handphone': $('#edit_handphone').val()
        }

        // console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/mpp/update/"+ id,
            data: data,
            dataType:"json",

            success: function(response){
                console.log(response);
                if(response.status == 400){

                    $('#error_edit_nama').html(response.errors.edit_nama);
                    $('#error_edit_email').html(response.errors.edit_email);
                    $('#error_edit_handphone').html(response.errors.edit_handphone);

                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data gagal disimpan!',
                        icon: 'error'
                    });
                        
                }else if(response.status == 404){
                     Swal.fire({
                        title: 'Gagal!',
                        text: 'Data gagal ditemukan!',
                        icon: 'error'
                    });
                    
                }else{
                    table_perusahaan.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan!',
                        icon: 'success'
                    });
                    $('#modal_edit_mpp').modal('hide');
                }
            
            }
        })

    });

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
                    url: "/mpp/delete/" + id,
                   
                    success: function(){
                        table_anggota_perusahaan.draw();
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
    

    // Add anggota
    $(document).on('click','.anggota', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_anggota_perusahaan').modal('show');   
        $.ajax({
            type:"GET",
            url:"/mpp/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    console.log(response);
                    $('#id_perusahaan').val(response.mpp.id);
                    $('#nama_perusahaan').val(response.mpp.name);
                }
            }
        })

    })

    var anggota = $('#form-anggota-perusahaan')[0];
    $('#save_anggota').on('click',function(e){
        e.preventDefault();
        var form_anggota  = new FormData(anggota);
        // console.log(form_anggota);
        $.ajax({
            url: '/perusahaan/anggota',
            method:'POST',
            data: form_anggota,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_name').html(response.errors.nama);
                    $('#error_email').html(response.errors.email);
                    $('#error_hp').html(response.errors.hp);
                  
                }else{
                    table_anggota_perusahaan.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_anggota_perusahaan').modal('hide');
                    $("#form-anggota-perusahaan")[0].reset();
                }
            }
        })

    })

    $(document).on('click','.edit_anggota', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_anggota').modal('show');
        $.ajax({
            type:"GET",
            url:"/perusahaan/anggota/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_anggota').val(response.anggota_perusahaan.id);
                    $('#edit_nama_anggota').val(response.anggota_perusahaan.name);
                    $('#edit_email_anggota').val(response.anggota_perusahaan.email);
                    $('#edit_handphone_anggota').val(response.anggota_perusahaan.handphone);
                    $('#edit_perusahaan').val(response.anggota_perusahaan.id_leader).change();
                }
            }
        })
    })

      $(document).on('click', '.update_anggota', function(e){
        e.preventDefault();
        var id = $('#id_anggota').val();
        var data = {
            'edit_nama_anggota': $('#edit_nama_anggota').val(),
            'edit_email_anggota': $('#edit_email_anggota').val(),
            'edit_handphone_anggota': $('#edit_handphone_anggota').val(),
            'edit_perusahaan': $('#edit_perusahaan').val()
        }

        // console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/perusahaan/anggota/update/"+ id,
            data: data,
            dataType:"json",

            success: function(response){
                console.log(response);
                if(response.status == 400){

                    $('#error_edit_nama_anggota').html(response.errors.edit_nama_anggota);
                    $('#error_edit_email_anggota').html(response.errors.edit_email_anggota);
                    $('#error_edit_handphone_anggota').html(response.errors.edit_handphone_anggota);
                    $('#error_edit_perusahaan').html(response.errors.edit_perusahaan);

                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Data gagal disimpan!',
                        icon: 'error'
                    });
                        
                }else if(response.status == 404){
                     Swal.fire({
                        title: 'Gagal!',
                        text: 'Data gagal ditemukan!',
                        icon: 'error'
                    });
                    
                }else{
                    table_anggota_perusahaan.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan!',
                        icon: 'success'
                    });
                    $('#modal_edit_anggota').modal('hide');
                }
            
            }
        })

    });

    $('.edit_perusahaan').select2({
        dropdownParent: $('#modal_edit_anggota'),
        allowClear: true,
        placeholder: 'Pilih'
    });


    $('.role').select2({
        dropdownParent: $('#modal_mpp'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_role').select2({
        dropdownParent: $('#modal_edit_mpp'),
    });

});