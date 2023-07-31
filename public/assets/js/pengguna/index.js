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
        $('#modal_pengguna').modal('show');   

    })

    
    $('.mpp').select2({
        dropdownParent: $('#modal_pengguna'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.mpi').select2({
        dropdownParent: $('#modal_pengguna'),
        allowClear: true,
        placeholder: 'Pilih'
    });

     $('.role').select2({
        dropdownParent: $('#modal_pengguna'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('[name="jenis_pengguna"]').change(function(){
            if($(this).val() == 'mpp'){
                $(".mpp_form").removeClass('d-none');
                $(".mpi_form").addClass('d-none');
            }else{
                $(".mpp_form").addClass('d-none');
                $(".mpi_form").removeClass('d-none');
            }
        });
    
    
    $('.edit_prioritas').select2({
        dropdownParent: $('#modal_edit_olt'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    var olt = $('#form-pengguna')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(olt);
        // console.log(data);
        $.ajax({
            url: '/pengguna/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    // $('#error_name').html(response.errors.name_room);
                    // $('#error_capacity').html(response.errors.capacity_room);
                    // $('#error_facility').html(response.errors.facility_room);
                    // $('#error_images').html(response.errors.images_room);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_pengguna').modal('hide');
                    $("#form-pengguna")[0].reset();
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
                    $('#edit_prioritas').val(response.olt.prioritas).change();
                }
            }
        })
    })

   $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_olt').val();
        var data = {
            'edit_nama_olt': $('#edit_nama_olt').val(),
            'edit_prioritas': $('#edit_prioritas').val()
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
                    title: 'Suksess!',
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