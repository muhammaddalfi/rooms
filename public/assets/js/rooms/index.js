$(document).ready(function(){

    const swalInit = swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light',
                    denyButton: 'btn btn-light',
                    input: 'form-control'
                }
            });

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/rooms/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'name'},
            {data:'capacity'},
            {data:'facility'},
            {data:'images'},
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

    //add rooms
    $(document).on('click','.add_rooms', function(e){
        e.preventDefault();
        $('#modal_rooms').modal('show');
        
    })

    var data = $('#rooms')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/rooms/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    // console.log(response.errors.name_room);
                    $('#error_name').html(response.errors.name_room);
                    $('#error_capacity').html(response.errors.capacity_room);
                    $('#error_facility').html(response.errors.facility_room);
                  
                }else{
                    
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_rooms').modal('hide');
                    $("#rooms")[0].reset();
                }
            }
        })

    })

    //  //edit button
    // $(document).on('click','.edit', function(e){
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     $('#modal_edit_cyberkey').modal('show');
    //     $.ajax({
    //         type:"GET",
    //         url:"/cyberkey/edit/" + id,
    //         success: function(response){
    //             if(response.status == 404){
    //                 console.log("Data not found");
    //             }else{
    //                 $('#id_serial_number').val(response.cyber.id);
    //                 $('#edit_serial_number').val(response.cyber.serial_number);
    //             }
    //         }
    //     })
    // })

    // $(document).on('click', '.update', function(e){
    //     e.preventDefault();
    //     var id = $('#id_serial_number').val();
    //     var data = {
    //         'edit_serial_number': $('#edit_serial_number').val()
    //     }

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         type:"PUT",
    //         url:"/cyberkey/update/"+ id,
    //         data: data,
    //         dataType:"json",
    //         success: function(response){
                
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Data Berhasil Diubah',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //               })
                  
    //             table.draw();
    //               $('#modal_edit_cyberkey').modal('hide');
    //         }
    //     })

    // });


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
                    url: "/rooms/delete/" + id,
                   
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