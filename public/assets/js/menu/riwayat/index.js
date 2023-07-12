$(document).ready(function(){

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/riwayat/fetch',
        autoWidth: false,
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data: function(data){
                return data.start_date + "</br>" + data.return_date;
            }},
            {data:'penanggung_jawab'},
            {data: function(data){
                if(data.jenis_keperluan == 'gangguan'){
                    return 'Recovery Gangguan';    
                }else if(data.jenis_keperluan == 'pm'){
                    return 'Preventive Maintenance';
                }else if(data.jenis_keperluan == 'aktivasi'){
                    return 'Kunjungan Kerja';
                }else if(data.jenis_keperluan == 'project'){
                    return 'Aktivasi';
                }
                else if(data.jenis_keperluan == 'visit'){
                    return 'Aktivasi';
                }
            }},
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

      $(document).on('click','.riwayat', function(e){
        e.preventDefault();
        // console.log('click');
        var id_riwayat = $(this).data('id');
        $('#modal_riwayat').modal('show');

        console.log(id_riwayat);
        $.ajax({
            type:"GET",
            url:"/riwayat/show/" + id_riwayat,
            success: function(response){
                if(response.status == 404){
                    console.log('Data Not Found');
                }else{
                    console.log(response.riwayat.id);
                    let pinjam = moment(response.riwayat.start_date).format('DD-MM-YYYY');
                    let kembali = moment(response.riwayat.return_date).format('DD-MM-YYYY');
                    let tanggal = pinjam +' -> '+ kembali; 

                    $('#id_table_request').val(response.riwayat.id);
                    $('#penanggung_jawab').html(response.riwayat.name);
                    $('#pic').html(response.riwayat.penanggung_jawab);
                    $('#tgl_pinjam').html(tanggal);

                    if(response.riwayat.jenis_keperluan == 'gangguan'){
                       $('#jenis_keperluan').html('Recovery Gangguan');
                    }else if(response.riwayat.jenis_keperluan == 'pm'){
                       $('#jenis_keperluan').html('Preventive Maintenance');
                    }else if(response.riwayat.jenis_keperluan == 'aktivasi'){
                        $('#jenis_keperluan').html('Aktivasi');
                    }else if(response.riwayat.jenis_keperluan == 'project'){
                        $('#jenis_keperluan').html('Project');                        
                    }else if(response.riwayat.jenis_keperluan == 'visit'){
                       $('#jenis_keperluan').html('Kunjungan Kerja');
                   }

                   $('#detail_pekerjaan').html(response.riwayat.detail_pekerjaan);
                    $('#sn_cyberkey').html(response.riwayat.sn_cyberkey);

                   $('#lokasi').html((response.riwayat.lokasi_pop_1 != null ? response.riwayat.lokasi_pop_1 : "") + 
                   (response.riwayat.lokasi_pop_2 != null ? "</br>" + response.riwayat.lokasi_pop_2 : "") + 
                   (response.riwayat.lokasi_pop_3 != null ? "</br>" +response.riwayat.lokasi_pop_3 : ""));

                   $('#anggota').html((response.riwayat.petugas_1 != null ? response.riwayat.petugas_1 : "") + 
                   (response.riwayat.petugas_2 != null ? "</br>" + response.riwayat.petugas_2 : "") + 
                   (response.riwayat.petugas_3 != null ? "</br>" + response.riwayat.petugas_3 : "") +
                   (response.riwayat.petugas_4 != null ? response.riwayat.petugas_4 : "" ));

                   $('#id_gambar_1').attr("src", "storage/files/" + response.riwayat.gambar_1);
                   $('#id_gambar_1_link').attr("href", "storage/files/" + response.riwayat.gambar_1);

                   $('#id_gambar_2').attr("src", "storage/files/" + response.riwayat.gambar_2);
                   $('#id_gambar_2_link').attr("href", "storage/files/" + response.riwayat.gambar_2);
                }
            }
        })
       
    })
   
});
