$(document).ready(function(){

   
     var map = L.map('map').setView([3.6334145,98.7079968], 7);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    $.ajax({
        type: 'GET',
        url: 'map/pop',
        dataType: 'json',
        success: function(data){
            $.each(data, function(i){
                var v_la,v_lo;
                if(data[i].lat == "" && data[i].lng == ""){
                     v_la = ""
                     v_lo = "";
                }else{
                    
                 v_la = parseFloat(data[i].lat);
                 v_lo = parseFloat(data[i].lng);
                }
                
            var custom = data[i].lokasi;
            image_marker = L.marker([v_la,v_lo])
                            .addTo(map)
                            .bindPopup(custom);
          
            });
        }  

    });
    

     const swalInit = swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light',
                    denyButton: 'btn btn-light',
                    input: 'form-control'
                }
            });
            

    var table = $('.table-pinjam').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        searching: false, paging: false, info: false,
        ajax: '/dashboard/cyber/fetch',
        autoWidth: false,
        columns:[
            {data:'penanggung_jawab'},
             {data: function(data){
                return (data.lokasi_pop_1 != null ? data.lokasi_pop_1 : "" ) + (data.lokasi_pop_2 != null ? "</br>" + data.lokasi_pop_2 : "") + (data.lokasi_pop_3 !=null ? "</br>" + data.lokasi_pop_3 : "");
            }},
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
    $(document).on('click','.balikin', function(e){
        e.preventDefault();
        var id_balik = $(this).data('id');
        $('#modal_balik').modal('show');
        console.log(id_balik);
        $.ajax({
            type:"GET",
            url:"/dashboard/cyber/edit/" + id_balik,
            success: function(response){
                $(".table-empty , .table-info").removeClass("d-none");
                if(response.status == 404){
                    console.log('Kok Kosong from ajax ?');
                     $(".table-info").addClass("d-none");
                }else{
                    console.log(response.riwayat.request_id);

                    let pinjam = moment(response.riwayat.start_date).format('DD-MM-YYYY');
                    let kembali = moment(response.riwayat.return_date).format('DD-MM-YYYY');
                    let tanggal = pinjam +' -> '+ kembali; 

                    $('#id_balik').val(response.riwayat.request_id);

                    $('#balik_penanggung_jawab').html(response.riwayat.name);
                    $('#balik_pic').html(response.riwayat.penanggung_jawab);
                    $('#balik_tgl_pinjam').html(tanggal);

                    if(response.riwayat.jenis_keperluan == 'gangguan'){
                       $('#balik_jenis_keperluan').html('Recovery Gangguan');
                    }else if(response.riwayat.jenis_keperluan == 'pm'){
                       $('#balik_jenis_keperluan').html('Preventive Maintenance');
                    }else if(response.riwayat.jenis_keperluan == 'aktivasi'){
                        $('#balik_jenis_keperluan').html('Aktivasi');
                    }else if(response.riwayat.jenis_keperluan == 'project'){
                        $('#balik_jenis_keperluan').html('Project');                        
                    }else if(response.riwayat.jenis_keperluan == 'visit'){
                       $('#balik_jenis_keperluan').html('Kunjungan Kerja');
                   }

                   $('#balik_detail_pekerjaan').html(response.riwayat.detail_pekerjaan);

                   $('#balik_lokasi').html((response.riwayat.lokasi_pop_1 != null ? response.riwayat.lokasi_pop_1 : "") + 
                   (response.riwayat.lokasi_pop_2 != null ? "</br>" + response.riwayat.lokasi_pop_2 : "") + 
                   (response.riwayat.lokasi_pop_3 != null ? "</br>" +response.riwayat.lokasi_pop_3 : ""));

                   $('#balik_anggota').html((response.riwayat.petugas_1 != null ? response.riwayat.petugas_1 : "") + 
                   (response.riwayat.petugas_2 != null ? "</br>" + response.riwayat.petugas_2 : "") + 
                   (response.riwayat.petugas_3 != null ? "</br>" + response.riwayat.petugas_3 : "") +
                   (response.riwayat.petugas_4 != null ? response.riwayat.petugas_4 : "" ));

                   $('#id_gambar_1').attr("src", "storage/files/" + response.riwayat.gambar_1);
                   $('#id_gambar_1_link').attr("href", "storage/files/" + response.riwayat.gambar_1);

                   $('#id_gambar_2').attr("src", "storage/files/" + response.riwayat.gambar_2);
                   $('#id_gambar_2_link').attr("href", "storage/files/" + response.riwayat.gambar_2);
                

                   $(".table-empty").addClass("d-none");
                
                }
            }
        })
    })

     $(document).on('click', '.update_balik', function(e){
        e.preventDefault();
        var id = $('#id_balik').val();
        var data = {
            'status': $('#status').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/approve/balik/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
               swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    table.draw();
                    $('#modal_balik').modal('hide');
            
            }
        })

    });


       $('#status').select2({
        dropdownParent: $('#modal_balik')
    });
    
});
