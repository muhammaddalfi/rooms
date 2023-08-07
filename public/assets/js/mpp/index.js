$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
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

    //add mpp
    $(document).on('click','.add_mpp', function(e){
        e.preventDefault();
        $('#modal_mpp').modal('show');   

    })


    $('.role').select2({
        dropdownParent: $('#modal_mpp'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_role').select2({
        dropdownParent: $('#modal_edit_mpp'),
    });

    var olt = $('#form-mpp')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(olt);
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
                   console.log(response); 
                    table.draw();
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

    //  //edit button
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
                    table.draw();
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
                    url: "/mpp/delete/" + id,
                   
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