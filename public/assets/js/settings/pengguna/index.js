$(document).ready(function(){

// Defaults
    const swalInit = swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light',
                    denyButton: 'btn btn-light',
                    input: 'form-control'
                }
            });

    $(document).on('click','.add_user', function(e){
        e.preventDefault();
         $('#divisi').select2({
        dropdownParent: $('#modal_form_user')
            });

        $('#role').select2({
        dropdownParent: $('#modal_form_user')
            });
        $('#modal_form_user').modal('show');
        
    })
            
    var data = $('#form-users')[0];
    $('#simpan').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/pengguna/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log('gagal kirim');
                  
                }else{
                    table.draw();
                    swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                        $('#modal_form_user').modal('hide');
                        $("#form-users")[0].reset();
                }
            }
        })

    })


    //edit button
    $(document).on('click','.ubah', function(e){
        e.preventDefault();
        $('#modal_edit_user').modal('show');
        $('#edit_divisi').select2({
        dropdownParent: $('#modal_edit_user')
            });
        var id = $(this).data('id');
        $.ajax({
            type:"GET",
            url:"/pengguna/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("User tidak ditemukan");
                }else{
                    $('#id_edit_pengguna').val(response.user.id);
                    $('#edit_nama').val(response.user.name);
                    $('#edit_email').val(response.user.email);
                    $('#edit_divisi').val(response.user.divisi).change();
                    $('#edit_handphone').val(response.user.handphone);
                }
            }
        })
    })

    $(document).on('click', '.btn_edit_ubah', function(e){
        e.preventDefault();
        var id = $('#id_edit_pengguna').val();
        var data = {
            'edit_nama': $('#edit_nama').val(),
            'edit_email': $('#edit_email').val(),
            'edit_divisi': $('#edit_divisi').val(),
            'edit_handphone': $('#edit_handphone').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:`/pengguna/ubah/${id}`,
            data: data,
            dataType:"json",
            success: function(response){
                console.log(response);
                if(response.status == 400){
                    swalInit.fire({
                    title: 'Gagal!',
                    text: '400 Code',
                    icon: 'danger'
                    });
                        
                }else if(response.status == 404){
                    swalInit.fire({
                    title: 'Gagal!',
                    text: 'Data gagal disimpan!',
                    icon: 'danger'
                    });
                    
                }else{
                    table.draw();
                    swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                    });
                    $('#modal_edit_user').modal('hide');
                }
            
            }
        })

    });

// Basic responsive configuration
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
            {data: function(data){
                if(data.divisi == 'opharset'){
                    return 'Opharset';    
                }else if(data.divisi == 'aktivasi'){
                    return 'Aktivasi';
                }else if(data.divisi == 'pembangunan'){
                    return 'Pembangunan';
                }else if(data.divisi == 'retail'){
                    return 'Retail';
                }
            }},
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

});
