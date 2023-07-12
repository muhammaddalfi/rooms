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

    var data = $('#form-surat')[0];
    $('#simpan').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(data);
        $.ajax({
            url: '/surat/store',
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
                        $('#modal_buat_surat').modal('hide');
                        $("#form-surat")[0].reset();
                }
            }
        })

    })

    //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_surat').modal('show');
        $.ajax({
            type:"GET",
            url:"/surat/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#edit_surat_id').val(response.surat.id);
                    let keberangkatan = moment(response.surat.start_date).format('DD-MM-YYYY');
                    let kembali = moment(response.surat.return_date).format('DD-MM-YYYY');
                    $('#edit_tgl_pekerjaan').val(keberangkatan);
                    $('#edit_tgl_kembali').val(kembali);
                    $('#edit_penanggung_jawab').val(response.surat.penanggung_jawab);
                    $('#edit_lokasi_pekerjaan').val(response.surat.lokasi);
                    $('#edit_pekerjaan').val(response.surat.deskripsi_pekerjaan);
                    $('#edit_petugas_1').val(response.surat.petugas_1);
                    $('#edit_petugas_2').val(response.surat.petugas_2);
                    $('#edit_petugas_3').val(response.surat.petugas_3);
                    $('#edit_petugas_4').val(response.surat.petugas_4);
                }
            }
        });
    })

    $(document).on('click', '.update', function(e){
        e.preventDefault();
        var id = $('#edit_surat_id').val();
        var data = {
            'edit_nama_pop': $('#edit_nama_pop').val(),
            'edit_tgl_pekerjaan': $('#edit_tgl_pekerjaan').val(),
            'edit_tgl_kembali': $('#edit_tgl_kembali').val(),
            'edit_penanggung_jawab': $('#edit_penanggung_jawab').val(),
            'edit_lokasi_pekerjaan': $('#edit_lokasi_pekerjaan').val(),
            'edit_pekerjaan': $('#edit_pekerjaan').val(),
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
            url:"/surat/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
               swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_surat').modal('hide');
            
            }
        })

    });

    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/surat/fetch',
        autoWidth: false,
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data: function(data){
                return data.start_date + "</br>" + data.return_date;
            }},
            {data:'penanggung_jawab'},
            {data:'deskripsi_pekerjaan'},
            {data:'lokasi'},
            {data: function(data){
                return (data.petugas_1 != null ? data.petugas_1 : "" ) + (data.petugas_2 != null ? "</br>" + data.petugas_2 : "") + (data.petugas_4 !=null ? "</br>" + data.petugas_4 : "");
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
    $(document).on('click','.buat_surat', function(e){
        e.preventDefault();
        $('#modal_buat_surat').modal('show');
        
        const tgl_pekerjaan = document.querySelector('.tgl_pekerjaan');
        const tgl_kembali = document.querySelector('.tgl_kembali');

        if(tgl_pekerjaan) {
            const dpDateFormat = new Datepicker(tgl_pekerjaan, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
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
   
});
