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

    var data = $('#form-request-cyber')[0];
    $('#simpan').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/request/cyber',
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
                    swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                        $('#modal_request_cyber').modal('hide');
                        $("#form-request-cyber")[0].reset();
                }
            }
        })

    })

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/request/fetch',
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
            {data: function(data){
                if(data.status == '1'){
                    return '<span class="badge bg-primary">Baru</span>';    
                }else if(data.status == '2'){
                    return '<span class="badge bg-success">Digunakan</span>';
                }
                else if(data.status == '3'){
                    return '<span class="badge bg-danger">Selesai</span>';
                }
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

    //request cyberkeys
    $(document).on('click','.request_cyber', function(e){
        e.preventDefault();
        $('#modal_request_cyber').modal('show');
        
        // $(".detail_pekerjaan").addClass('d-none');
        const tgl_pinjam = document.querySelector('.tgl_pinjam');
        const tgl_kembali = document.querySelector('.tgl_kembali');

        if(tgl_pinjam) {
            
            // var date = new Date();
            // var minDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 2);
            const dpDateFormat = new Datepicker(tgl_pinjam, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                // minDate: minDate,
                // maxDate: "+2D,M,Y",
                // minDate: new Date('01/01/1900'),
                // maxDate: '3',
                // minDate: minDate,
                // maxDate: '3',
                autohide: true
            });
        }

        if(tgl_kembali) {
            const dpDateFormat = new Datepicker(tgl_kembali, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true
            });
        }
    })


     //edit button
    $(document).on('click','.edit_permohonan', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_permohonan').modal('show');
        const edit_tgl_pinjam = document.querySelector('.edit_tgl_pinjam');
        const edit_tgl_kembali = document.querySelector('.edit_tgl_kembali');

        if(edit_tgl_pinjam) {
            const dpDateFormat = new Datepicker(edit_tgl_pinjam, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true
            });
        }

        if(edit_tgl_kembali) {
            const dpDateFormat = new Datepicker(edit_tgl_kembali, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true
            });
        }
        $.ajax({
            type:"GET",
            url:"/request/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    console.log(response);
                    $('#edit_permohonan_id').val(response.permohonan.id);
                    let edit_keberangkatan = moment(response.permohonan.start_date).format('DD-MM-YYYY');
                    let edit_kembali = moment(response.permohonan.return_date).format('DD-MM-YYYY');
                    $('#edit_tgl_pinjam').val(edit_keberangkatan);
                    $('#edit_tgl_kembali').val(edit_kembali);
                    $('#edit_penanggung_jawab').val(response.permohonan.penanggung_jawab);
                    $('#edit_lokasi_pop_1').val(response.permohonan.lokasi_pop_1).change();;
                    $('#edit_lokasi_pop_2').val(response.permohonan.lokasi_pop_2).change();;
                    $('#edit_lokasi_pop_3').val(response.permohonan.lokasi_pop_3).change();;
                    $('#edit_jenis_pekerjaan').val(response.permohonan.jenis_pekerjaan).change();
                    $('#edit_petugas_1').val(response.permohonan.petugas_1);
                    $('#edit_petugas_2').val(response.permohonan.petugas_2);
                    $('#edit_petugas_3').val(response.permohonan.petugas_3);
                    $('#edit_petugas_4').val(response.permohonan.petugas_4);
                }
            }
        });
    })

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var id = $('#edit_permohonan_id').val();
        var data = {
            'edit_tgl_pinjam': $('#edit_tgl_pinjam').val(),
            'edit_tgl_kembali': $('#edit_tgl_kembali').val(),
            'edit_penanggung_jawab': $('#edit_penanggung_jawab').val(),
            'edit_lokasi_pop_1': $('#edit_lokasi_pop_1').val(),
            'edit_lokasi_pop_2': $('#edit_lokasi_pop_2').val(),
            'edit_lokasi_pop_3': $('#edit_lokasi_pop_3').val(),
            'edit_jenis_keperluan': $('#edit_jenis_keperluan').val(),
            'edit_petugas_1': $('#edit_petugas_1').val(),
            'edit_petugas_2': $('#edit_petugas_2').val(),
            'edit_petugas_3': $('#edit_petugas_3').val(),
            'edit_petugas_4': $('#edit_petugas_4').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/request/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
               swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_permohonan').modal('hide');
            
            }
        })

    });

    $(document).on('click','.approve', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_approve').modal('show');

         $.ajax({
            type:"GET",
            url:"/request/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log('Data Not Found');
                }else{
                    // console.log(response.permohonan.user.name);
                    let pinjam = moment(response.permohonan.start_date).format('DD-MM-YYYY');
                    let kembali = moment(response.permohonan.return_date).format('DD-MM-YYYY');
                    let tanggal = pinjam +' -> '+ kembali; 

                    $('#req_id').val(response.permohonan.id);
                    $('#req_pic').html(response.permohonan.user.name);
                    $('#req_penanggung_jawab').html(response.permohonan.penanggung_jawab);
                    $('#req_tanggal').html(tanggal);
                     if(response.permohonan.jenis_keperluan == 'gangguan'){
                       $('#req_pekerjaan').html('Recovery Gangguan');
                    }else if(response.permohonan.jenis_keperluan == 'pm'){
                       $('#req_pekerjaan').html('Preventive Maintenance');
                    }else if(response.permohonan.jenis_keperluan == 'aktivasi'){
                        $('#req_pekerjaan').html('Aktivasi');
                    }else if(response.permohonan.jenis_keperluan == 'project'){
                        $('#req_pekerjaan').html('Project');                        
                    }else if(response.permohonan.jenis_keperluan == 'visit'){
                       $('#req_pekerjaan').html('Kunjungan Kerja');
                   }

                   $('#req_detail_pekerjaan').html(response.permohonan.detail_pekerjaan);

                   $('#req_lokasi').html((response.permohonan.lokasi_pop_1 != null ? response.permohonan.lokasi_pop_1 : "") + 
                   (response.permohonan.lokasi_pop_2 != null ? "</br>" + response.permohonan.lokasi_pop_2 : "") + 
                   (response.permohonan.lokasi_pop_3 != null ? "</br>" +response.permohonan.lokasi_pop_3 : ""));

                   $('#req_anggota').html((response.permohonan.petugas_1 != null ? response.permohonan.petugas_1 : "") + 
                   (response.permohonan.petugas_2 != null ? "</br>" + response.permohonan.petugas_2 : "") + 
                   (response.permohonan.petugas_3 != null ? "</br>" + response.permohonan.petugas_3 : "") +
                   (response.permohonan.petugas_4 != null ? response.permohonan.petugas_4 : "" ));

                }
            }
        })
        
    })

    $(document).on('click', '.update_approve', function(e){
        e.preventDefault();
        
        $('#spinner').css("display","inline-block");
        var id = $('#req_id').val();
        var data = {
            'cyberkey': $('#cyberkey').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/approve/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
                console.log(response);
                if(response.status == 400){
                    swalInit.fire({
                    title: 'Gagal!',
                    text: 'Silahkan Pilih SN Cyberkey',
                    icon: 'error'
                    });
                        
                }else if(response.status == 404){
                    swalInit.fire({
                    title: 'Gagal!',
                    text: 'Data gagal disimpan!',
                    icon: 'error'
                    });
                    
                }else{
                    $('#spinner').css("display","none");
                    table.draw();
                    swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                    });
                    $('#modal_approve').modal('hide');
                }
            
            }
        })

    });

    // $('[name="jenis_keperluan"]').change(function(){
    //         if($(this).val() == 'gangguan'){
    //             $(".gangguan").removeClass('d-none');
    //             $(".pm").addClass('d-none');
    //             $(".visit").addClass('d-none');
    //             $(".aktivasi").addClass('d-none');
    //             $(".project").addClass('d-none');
    //         }else if($(this).val() == 'aktivasi'){
    //             $(".aktivasi").removeClass('d-none');
    //             $(".pm").addClass('d-none');
    //             $(".gangguan").addClass('d-none');
    //             $(".project").addClass('d-none');
    //             $(".visit").addClass('d-none');
    //         }else if($(this).val() == 'project'){
    //             $(".project").removeClass('d-none');
    //             $(".pm").addClass('d-none');
    //             $(".gangguan").addClass('d-none');
    //             $(".aktivasi").addClass('d-none');
    //             $(".project").addClass('d-none');
    //         }else if($(this).val() == 'pm'){
    //             $(".pm").removeClass('d-none');
    //             $(".project").addClass('d-none');
    //             $(".gangguan").addClass('d-none');
    //             $(".aktivasi").addClass('d-none');
    //             $(".visit").addClass('d-none');
    //         }

    // });

        
    $('#cyberkey').select2({
        dropdownParent: $('#modal_approve')
    });

    
    $('#jenis_keperluan').select2({
        dropdownParent: $('#modal_request_cyber')
    });

    $('#lokasi_pop_1').select2({
        dropdownParent: $('#modal_request_cyber'),
        allowClear: true
    });

    $('#lokasi_pop_2').select2({
        dropdownParent: $('#modal_request_cyber'),
        allowClear: true
    });

     $('#lokasi_pop_3').select2({
        dropdownParent: $('#modal_request_cyber'),
        allowClear: true
    });

    $('#edit_jenis_keperluan').select2({
        dropdownParent: $('#modal_edit_permohonan')
    });

    $('#edit_lokasi_pop_1').select2({
        dropdownParent: $('#modal_edit_permohonan'),
        allowClear: true
    });

    $('#edit_lokasi_pop_2').select2({
        dropdownParent: $('#modal_edit_permohonan'),
        allowClear: true
    });

     $('#edit_lokasi_pop_3').select2({
        dropdownParent: $('#modal_edit_permohonan'),
        allowClear: true
    });
   
});
