$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/dailys/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'created_at'},
            {data:'nama_olt'},
            {data:'kegiatan_id'},
            {data:'gambar'},
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
        $('#modal_daily').modal('show');   

    })

    
    $('.kategori').select2({
        dropdownParent: $('#modal_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });
    
    $('.olt').select2({
        dropdownParent: $('#modal_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.kegiatan').select2({
        dropdownParent: $('#modal_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_kategori').select2({
        dropdownParent: $('#modal_edit_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });
    
    $('.edit_olt').select2({
        dropdownParent: $('#modal_edit_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_kegiatan').select2({
        dropdownParent: $('#modal_edit_daily'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $(document).on('click','.view', function(e){
        e.preventDefault();
        var id_kegiatan = $(this).data('id');
        $('#modal_view').modal('show');

        console.log(id_kegiatan);
        $.ajax({
            type:"GET",
            url:"/dailys/show/" + id_kegiatan,
            success: function(response){
                if(response.status == 404){
                    console.log('Data Not Found');
                }else{

                    // console.log(response.daily);
                    let tanggal = moment(response.daily.created_at).format('DD-MM-YYYY');

                    $('#id_kegiatan').val(response.daily.id);
                    $('#view_tanggal').html(tanggal);
                    $('#view_nama').html(response.daily.user.name);
                    $('#view_nama_olt').html(response.daily.nama_olt);
                    $('#view_jenis_kegiatan').html(response.daily.jenis_kegiatan.jenis_kegiatan);
                    $('#view_catatan').html(response.daily.catatan);

            
                    if(response.daily.kategori_dinas == 'Ya'){
                       $('#view_kategori_dinas').html('SPPD');
                    }else if(response.daily.kategori_dinas == 'Tidak'){
                       $('#view_kategori_dinas').html('Tidak SPPD');
                    }

                   $('#gambar_bukti').attr("src", "storage/files/" + response.daily.gambar);
                   $('#gambar_bukti_link').attr("href", "storage/files/" + response.daily.gambar);

                }
            }
        })
       
    })


    var daily = $('#form-daily')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        $('#spinner').css("display","inline-block");
        var form  = new FormData(daily);
        // console.log(data);
        $.ajax({
            url: '/dailys/store',
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
                    
                   $('#spinner').css("display","none");
                //    console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_daily').modal('hide');
                    $("#form-daily")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_daily').modal('show');
        $.ajax({
            type:"GET",
            url:"/dailys/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_daily').val(response.daily.id);
                    $('#edit_kategori').val(response.daily.kategori_dinas).change();
                    $('#edit_olt').val(response.daily.nama_olt).change();
                    $('#edit_kegiatan').val(response.daily.jenis_kegiatan).change();
                    $('#edit_catatan').val(response.daily.catatan);
                    $('#view_images').attr("src", "storage/files/" + response.daily.gambar);
                }
            }
        })
    })

    var form_edit = $('#editDaily')[0];
    $(document).on('submit', '#editDaily', function(e){
        e.preventDefault();
        var id = $('#id_daily').val();
        let editdata =  new FormData(form_edit);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url:"/dailys/update/"+ id,
            data: editdata,
            dataType:"json",
            processData: false,
            contentType: false,
            success: function(response){
                console.log(response);
                  Swal.fire({
                    title: 'Success!',
                    text: 'Data has been changed',
                    icon: 'success'
                    });
                  
                  table.draw();
                  $('#modal_edit_daily').modal('hide');
                  $("#editDaily")[0].reset();
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
                    url: "/dailys/delete/" + id,
                   
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
    


    getLocation();
    
    function getLocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);
        }else{
            alert('Geolocation is not supported by this browser');
        }
    }

    function showPosition(position){
        console.log('Posisi Sekarang', position.coords.latitude, position.coords.longitude);
        
        var mymap = L.map("map").setView([position.coords.latitude, position.coords.longitude],13);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
        }).addTo(mymap);

        L.marker([position.coords.latitude, position.coords.longitude])
        .addTo(mymap)
        .bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");
        
        $("[name=latNow]").val(position.coords.latitude);
        $("[name=lngNow]").val(position.coords.longitude);


    }

});