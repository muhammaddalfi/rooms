$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/pop/fetch',
        autoWidth: false,
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'lokasi'},
            {data: function(data){
                if(data.wilayah_kerja == 'medan'){
                    return 'HO Medan';    
                }else if(data.wilayah_kerja == 'aceh'){
                    return 'KP Banda Aceh';
                }else if(data.wilayah_kerja == 'lhok'){
                    return 'KP Lhokseumawe';
                }else if(data.wilayah_kerja == 'sidempuan'){
                    return 'KP Sidempuan';
                }
            }},
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

    
    //request pop
    $(document).on('click','.add_pop', function(e){
        e.preventDefault();
         $('#wilayah_kerja').select2({
        dropdownParent: $('#modal_pop')
            });
        $('#modal_pop').modal('show');
        
    })


    var data = $('#form-pop')[0];
    $('#simpan').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/pop/store',
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
                $('#modal_pop').modal('hide');
                 $("#form-pop")[0].reset();
                }
            }
        })

    })

      //edit button
    $(document).on('click','.ubah', function(e){
        e.preventDefault();
        $('#edit_wilayah_kerja').select2({
        dropdownParent: $('#edit_modal_pop')
        });

        var id = $(this).data('id');
        $('#edit_modal_pop').modal('show');
       
        $.ajax({
            type:"GET",
            url:"/pop/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    console.log(response);
                    $('#id_pop').val(response.pop.id);
                    $('#edit_lokasi_pop').val(response.pop.lokasi);
                    $('#edit_wilayah_kerja').val(response.pop.wilayah_kerja).change();
                    $('#edit_latitude').val(response.pop.lat);
                    $('#edit_longitude').val(response.pop.lng);
                }
            }
        });
    })

    $(document).on('click', '.simpan_pop', function(e){
        e.preventDefault();
        var id = $('#id_pop').val();
        var data = {
            'edit_lokasi_pop': $('#edit_lokasi_pop').val(),
            'edit_wilayah_kerja': $('#edit_wilayah_kerja').val(),
            'edit_latitude': $('#edit_latitude').val(),
            'edit_longitude': $('#edit_longitude').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/pop/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
              Swal.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#edit_modal_pop').modal('hide');
            
            }
        })

    });

    $(document).on('click', '.delete_pop', function(e){
        e.preventDefault();
        // console.log('click);
         var id = $(this).data('id');

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
                    url: "/pop/delete/" + id,
                   
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
