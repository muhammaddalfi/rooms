$(document).ready(function(){

    $('[name="is_minat"]').change(function(){
            if($(this).val() == 'ya'){
                $(".kategori_minat").removeClass('d-none');
                $(".kategori_bayar").addClass('d-none');
                $(".kategori_tidak").addClass('d-none');
            }else if($(this).val() == 'bayar'){
                $(".kategori_minat").addClass('d-none');
                $(".kategori_bayar").removeClass('d-none');
                $(".kategori_tidak").addClass('d-none');
            }else if($(this).val() == 'tidak'){
                $(".kategori_minat").addClass('d-none');
                $(".kategori_bayar").addClass('d-none');
                $(".kategori_tidak").removeClass('d-none');
            }

        });

    const post_tgl_bayar_ya = document.querySelector('.tgl_bayar_ya');
        if(post_tgl_bayar_ya) {
            const dpAutoHide = new Datepicker(post_tgl_bayar_ya, {
                container: '#modal_fu',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    const post_tgl_bayar_bayar = document.querySelector('.tgl_bayar_bayar');
        if(post_tgl_bayar_bayar) {
            const dpAutoHide = new Datepicker(post_tgl_bayar_bayar, {
                container: '#modal_fu',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    const update_tgl_bayar = document.querySelector('.edit_tgl_bayar');
        if(update_tgl_bayar) {
            const dpAutoHide = new Datepicker(update_tgl_bayar, {
                container: '#modal_edit_beddeb',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    $('.follow_up_ya').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.follow_up_bayar').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.follow_up_tidak').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_fu').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.is_minat').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_is_minat').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.kategori_debt_bayar').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

     $('.kategori_debt_tidak').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.kategori_debt_ya').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

     $('.edit_kategori_debt').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.issue_bayar_ya').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.issue_bayar_bayar').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_issue_bayar').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.select_status_bayar').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_select_status_bayar').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.my_icon').select2({
        dropdownParent: $('#modal_fu'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_my_icon').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    $('.select_layanan').select2({
        dropdownParent: $('#modal_beddeb'),
        allowClear: true,
        placeholder: 'Pilih'
    });


    $('.edit_select_layanan').select2({
        dropdownParent: $('#modal_edit_beddeb')
    });

    var table = $('.datatable-baddeb').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/baddeb/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'nama_pelanggan'},
            {data:'id_pln'},
            {data:'layanan'},
            {data:'status_bayar'},
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

    //add jenis_keluhan
    $(document).on('click','.add_beddeb', function(e){
        e.preventDefault();
        $('#modal_beddeb').modal('show');   

    })


    var beddeb = $('#form-beddeb')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(beddeb);
        // console.log(form);
        $.ajax({
            url: '/baddeb',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_nama').html(response.errors.name);
                    $('#error_id_pln').html(response.errors.name);
                    $('#error_telp').html(response.errors.name);
                    $('#error_nik').html(response.errors.name);
                    $('#error_layanan').html(response.errors.name);
                    $('#error_alamat').html(response.errors.name);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                    });

                    $('#modal_beddeb').modal('hide');
                    $("#form-beddeb")[0].reset();
                }
            }
        })

    })

    $(document).on('click', '.fu', function (e) {
        e.preventDefault();
        var id_pelanggan = $(this).data('id');
        $('#modal_fu').modal('show');
        $.ajax({
            type: "GET",
            url: "/baddeb/" + id_pelanggan,
            success: function (response) {
                if (response.status == 200) {

                    $('#id_pelanggan').val(response.pelanggan_baddeb.id);
                    $('.nama_pelanggan').text(response.pelanggan_baddeb.nama_pelanggan);
                    $('.id_pln').html(response.pelanggan_baddeb.id_pln);
                    $('.nik').html(response.pelanggan_baddeb.nik);
                    $('.telp').html(response.pelanggan_baddeb.telp);
                    if (response.pelanggan_baddeb.layanan == '10') {
                        $('.layanan').html('10 Mbps');
                    } else if (response.pelanggan_baddeb.layanan == '20') {
                        $('.layanan').html('20 Mbps');
                    }else if(response.pelanggan_baddeb.layanan == '35'){
                        $('.layanan').html('20 Mbps');
                    }else if(response.pelanggan_baddeb.layanan == '50'){
                        $('.layanan').html('50 Mbps');
                    }else if(response.pelanggan_baddeb.layanan == '100'){
                        $('.layanan').html('100 Mbps');
                    }
                    $('.alamat').html(response.pelanggan_baddeb.alamat);
                    $('.tagihan').html(response.pelanggan_baddeb.tagihan);
                    $('.status_bayar').html(response.pelanggan_baddeb.status_bayar);
                } else {

                }
            }
        })

    })

    var form_fu = $('#followup')[0];
    var blob_image_1;
    var blob_image_2;
    $(document).on('submit', function (e) {
        e.preventDefault();
        var id_pelanggan = $('#id_pelanggan').val();
        let from_dafa_fu =  new FormData(form_fu);
        from_dafa_fu.append('gambar_1', blob_image_1);
        from_dafa_fu.append('gambar_2', blob_image_2);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: "POST",
            url: "/baddeb/" + id_pelanggan,
            data: from_dafa_fu,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                Swal.fire({
                    title: 'Success!',
                    text: 'Data has been changed',
                    icon: 'success'
                });
                table.draw();
                $('#modal_fu').modal('hide');
                $("#followup")[0].reset();
            }
        })

    });


    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_beddeb').modal('show');
        $.ajax({
            type: "GET",
            url: "/baddeb/" + id,
            success: function (response) {
                if (response.status == 404) {
                    console.log("Data not found");
                } else {
                    console.log(response);
                    // $('#id_daily').val(response.daily.id);
                    let tgl_bayar = moment(response.pelanggan_baddeb.waktu_bayar).format('DD-MM-YYYY');
                    $('#edit_nama').val(response.pelanggan_baddeb.nama_pelanggan);
                    $('#edit_id_pln').val(response.pelanggan_baddeb.id_pln);
                    $('#edit_telp').val(response.pelanggan_baddeb.telp);
                    $('#edit_nik').val(response.pelanggan_baddeb.nik);
                    $('#edit_select_layanan').val(response.pelanggan_baddeb.layanan).change();
                    $('#edit_tagihan').val(response.pelanggan_baddeb.tagihan);
                    $('#edit_alamat').val(response.pelanggan_baddeb.alamat);
                    $('#edit_fu').val(response.pelanggan_baddeb.follow_up).change();
                    $('#edit_tgl_bayar').val(tgl_bayar);
                    $('#edit_kategori_debt').val(response.pelanggan_baddeb.kategori_debt).change();
                    $('#edit_issue_bayar').val(response.pelanggan_baddeb.issue_bayar).change();
                    $('#edit_select_status_bayar').val(response.pelanggan_baddeb.status_bayar).change();
                    
                    $('#edit_my_icon').val(response.pelanggan_baddeb.myicon).change();


                    $('#id_gambar_1').attr("src", "storage/files/" + response.pelanggan_baddeb.gambar_bayar_pelanggan);
                    $('#id_gambar_2').attr("src", "storage/files/" + response.pelanggan_baddeb.gambar_bayar_icrm);

                }
            }
        })
    })

    // var form_edit = $('#editDaily')[0];
    // $(document).on('submit', '#editDaily', function (e) {
    //     e.preventDefault();
    //     var id = $('#id_daily').val();
    //     let editdata = new FormData(form_edit);
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         type: "POST",
    //         url: "/dailys/update/" + id,
    //         data: editdata,
    //         dataType: "json",
    //         processData: false,
    //         contentType: false,
    //         success: function (response) {
    //             console.log(response);
    //             Swal.fire({
    //                 title: 'Success!',
    //                 text: 'Data has been changed',
    //                 icon: 'success'
    //             });
    //             table.draw();
    //             $('#modal_edit_daily').modal('hide');
    //             $("#editDaily")[0].reset();
    //         }
    //     })

    // });

    const MAX_WIDTH = 1080;
    const MAX_HEIGHT = 720;
    const MIME_TYPE = "image/jpeg";
    const QUALITY = 80;

    const input1 = document.getElementById("gambar_1");
    const input2 = document.getElementById("gambar_2");

    input1.onchange = function (ev) {
        const file = ev.target.files[0]; // get the file
        const blobURL = URL.createObjectURL(file);
        const img = new Image();
        img.src = blobURL;
        img.onerror = function () {
            URL.revokeObjectURL(this.src);
            // Handle the failure properly
            console.log("Cannot load image");
        };
        img.onload = function () {
            URL.revokeObjectURL(this.src);
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(
                (blob) => {
                    // Handle the compressed image. es. upload or save in local state
                    blob_image_1 = blob;
                },
                MIME_TYPE,
                QUALITY
            );

        };
    };

    input2.onchange = function (ev) {
        const file = ev.target.files[0]; // get the file
        const blobURL = URL.createObjectURL(file);
        const img = new Image();
        img.src = blobURL;
        img.onerror = function () {
            URL.revokeObjectURL(this.src);
            // Handle the failure properly
            console.log("Cannot load image");
        };
        img.onload = function () {
            URL.revokeObjectURL(this.src);
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(
                (blob) => {
                    // Handle the compressed image. es. upload or save in local state
                    blob_image_2 = blob;
                },
                MIME_TYPE,
                QUALITY
            );

        };
    };

    function calculateSize(img, maxWidth, maxHeight) {
        let width = img.width;
        let height = img.height;

        // calculate the width and height, constraining the proportions
        if (width > height) {
            if (width > maxWidth) {
                height = Math.round((height * maxWidth) / width);
                width = maxWidth;
            }
        } else {
            if (height > maxHeight) {
                width = Math.round((width * maxHeight) / height);
                height = maxHeight;
            }
        }
        return [width, height];
    }

    // Utility functions for demo purpose

    function displayInfo(label, file) {
        const p = document.createElement('p');
        p.innerText = `${label} - ${readableBytes(file.size)}`;
        document.getElementById('view-blob').append(p);
    }

    function readableBytes(bytes) {
        const i = Math.floor(Math.log(bytes) / Math.log(1024)),
            sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
    }

});