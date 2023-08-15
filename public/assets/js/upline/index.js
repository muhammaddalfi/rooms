$(document).ready(function(){

    var table_leader = $('.datatable-leader').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/upline/fetch',
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

    var table_anggota_leader = $('.datatable-anggota-leader').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/leader/anggota/list',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'email'},
            {data:'handphone'},
            {data:'id_leader'},
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

    //add leader
    $(document).on('click','.add_leader_internal', function(e){
        e.preventDefault();
        $('#modal_leader').modal('show');   

    })

    var leader_leader = $('#form-leader')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(leader_leader);
        // console.log(data);
        $.ajax({
            url: '/upline/store',
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
                    table_leader.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_leader').modal('hide');
                    $("#form-leader")[0].reset();
                }
            }
        })

    })

    $(document).on('click','.edit_leader', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_leader').modal('show');
        $.ajax({
            type:"GET",
            url:"/upline/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_leader').val(response.leader.id);
                    $('#edit_nama_leader').val(response.leader.name);
                    $('#edit_email_leader').val(response.leader.email);
                    $('#edit_handphone_leader').val(response.leader.handphone);
                }
            }
        })
    })

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var id = $('#id_leader').val();
        var data = {
            'edit_nama_leader': $('#edit_nama_leader').val(),
            'edit_email_leader': $('#edit_email_leader').val(),
            'edit_handphone_leader': $('#edit_handphone_leader').val()
        }

        // console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/upline/update/"+ id,
            data: data,
            dataType:"json",

            success: function(response){
                console.log(response);
                if(response.status == 400){

                    $('#error_edit_nama_leader').html(response.errors.edit_nama_leader);
                    $('#error_edit_email_leader').html(response.errors.edit_email_leader);
                    $('#error_edit_handphone_leader').html(response.errors.edit_handphone_leader);

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
                    table_leader.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan!',
                        icon: 'success'
                    });
                    $('#modal_edit_leader').modal('hide');
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
                    url: "/upline/delete/" + id,
                   
                    success: function(){
                        table_leader.draw();
                        table_anggota_leader.draw();
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
        $('#modal_anggota_leader').modal('show');   
        $.ajax({
            type:"GET",
            url:"/upline/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    console.log(response);
                    $('#id_leader').val(response.leader.id);
                }
            }
        })

    })

    var anggota = $('#form-anggota-leader')[0];
    $('#save_anggota').on('click',function(e){
        e.preventDefault();
        var form_anggota  = new FormData(anggota);
        // console.log(form_anggota);
        $.ajax({
            url: '/leader/anggota',
            method:'POST',
            data: form_anggota,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_nama_anggota_leader').html(response.errors.nama_anggota_leader);
                    $('#error_email_anggota_leader').html(response.errors.email_anggota_leader);
                    $('#error_hp_anggota_leader').html(response.errors.hp_anggota_leader);
                  
                }else{
                    table_anggota_leader.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#form-anggota-leader')[0].reset();
                    $('#modal_anggota_leader').modal('hide');
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
            url:"/leader/anggota/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_anggota').val(response.anggota_leader.id);
                    $('#edit_nama_anggota').val(response.anggota_leader.name);
                    $('#edit_email_anggota').val(response.anggota_leader.email);
                    $('#edit_handphone_anggota').val(response.anggota_leader.handphone);
                    $('#edit_leader').val(response.anggota_leader.id_leader).change();
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
            'edit_leader': $('#edit_leader').val()
        }

        // console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/leader/anggota/update/"+ id,
            data: data,
            dataType:"json",

            success: function(response){
                console.log(response);
                if(response.status == 400){

                    $('#error_edit_nama_anggota').html(response.errors.edit_nama_anggota);
                    $('#error_edit_email_anggota').html(response.errors.edit_email_anggota);
                    $('#error_edit_handphone_anggota').html(response.errors.edit_handphone_anggota);
                    $('#error_edit_leader').html(response.errors.edit_leader);

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
                    table_anggota_leader.draw();
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

    $('.edit_leader').select2({
        dropdownParent: $('#modal_edit_anggota'),
        allowClear: true,
        placeholder: 'Pilih'
    });

});