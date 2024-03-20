$(document).ready(function(){

    $('.datatable-laporan-baddeb').daterangepicker({
            parentEl: '.content-inner'
    });

    var start_date = moment().subtract(1,'M');
    var end_date = moment();

    $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

    $('#daterange').daterangepicker({
        startDate : start_date,
        endDate : end_date
    }, function(start_date, end_date){
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
        table.draw();
    });

    var table = $('.datatable-laporan-baddeb').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
                url: '/report/search',
                data: function(data){
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    data.end_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
        },
        autoWidth: false,

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data:'nama_pelanggan'},
            {data:'id_pln'},
            {data:'layanan'},
            {data:'status'},
            // {data:'nama_petugas'},
            // {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false, width: 220 }
        ],
        order: [[0, "desc"]],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        },
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-light'
                }
            },
            buttons: [
                'excelHtml5'
            ]
        }
    });

    // $(document).on('click', '.view', function (e) {
    //     e.preventDefault();
    //     // alert('halo');
    //     var id_pelanggan = $(this).data('id');
    //     $('#modal_view_baddeb').modal('show');
    //     console.log(id_pelanggan);
    //     // console.log(id_kegiatan);
    //     $.ajax({
    //         type: "GET",
    //         url: "/report/baddeb/" + id_pelanggan,
    //         success: function (response) {
    //             if (response.status == 404) {
    //                 console.log('Data Not Found');
    //             } else {

    //                 console.log(response.show.nama_pelanggan);
    //                 // let tanggal = moment(response.show.created_at).format('DD-MM-YYYY h:mm:ss');

    //                 // $('#id_pelanggan').val(response.show.id);
    //                 $('#nama_pelanggan_baddeb').val(response.show.nama_pelanggan);
    //                 // $('#view_tanggal').html(tanggal);
    //                 // $('#view_nama_olt').html(response.show.olt.nama_olt);
    //                 // $('#view_jenis_kegiatan').html(response.show.jenis_kegiatan.jenis_kegiatan);
    //                 // $('#view_catatan').html(response.show.catatan);


    //                 // if (response.show.kategori_dinas == 'Ya') {
    //                 //     $('#view_kategori_dinas').html('Ya');
    //                 // } else if (response.show.kategori_dinas == 'Tidak') {
    //                 //     $('#view_kategori_dinas').html('Tidak');
    //                 // }

    //                 // $('#gambar_bukti').attr("src", "storage/files/" + response.show.gambar);
    //                 // $('#gambar_bukti_link').attr("href", "storage/files/" + response.show.gambar);

    //             }
    //         }
    //     })

    // })

});