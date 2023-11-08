$(document).ready(function(){

    
    const MAX_WIDTH = 1080;
    const MAX_HEIGHT = 720;
    const MIME_TYPE = "image/jpeg";
    const QUALITY = 80;

    $('.lokasi').select2({
        dropdownParent: $('#modal_pm'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.lokasi_pm').select2({
        dropdownParent: $('#modal_pm_absen'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    
    $(document).on('click','.add', function(e){
        e.preventDefault();
        $('#modal_pm').modal('show');   

    })
    
    const post_tgl_mulai = document.querySelector('.tgl_mulai');
        if(post_tgl_mulai) {
            const dpAutoHide = new Datepicker(post_tgl_mulai, {
                container: '#modal_pm',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    const post_tgl_selesai = document.querySelector('.tgl_selesai   ');
        if(post_tgl_selesai) {
            const dpAutoHide = new Datepicker(post_tgl_selesai, {
                container: '#modal_pm',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }


    var table = $('.datatable-pm').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/montir/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'tgl_mulai'},
            {data:'lokasi'},
            {data:'olt'},
            {data:'feeder'},
            {data:'fdt'},
            {data:'fat'},
            {data:'petugas'}
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


    var form_pm = $('#form_pm')[0];
    $(".form_input_jadwal").on("submit", function(e){
        e.preventDefault();
        var data_jadwal_form = new FormData(form_pm);
            $.ajax({
            url: '/montir',
            method:'POST',
            data: data_jadwal_form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    // $('#error_name').html(response.errors.role);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                    });
                    $("#form_pm")[0].reset();
                    $('#modal_pm').modal('hide');
                }
            }
        })
    }); 

    // $(document).on("click",".olt", function(){
    //     var id_pm = $(this).data('id');
    //     $('#modal_pm_olt').modal('show');
    //     $.ajax({
    //         type: "GET",
    //         url: "/montir/pm/olt/edit/" + id_pm,
    //         success: function (response) {
    //             if (response.status == 200) {

    //                 console.log(response.pm.id);
    //                 $('#id_pm').val(response.pm.id);
    //             } else {

    //             }
    //         }
    //     })
    // });

    var form_pm_olt = $('#form_pm_olt')[0];
    $(".form_input_olt").on("submit", function(e){
        e.preventDefault();
        var blob_dokumentasi_olt;
        var id_pm = $('#id_pm').val();
        let data_form_olt =  new FormData(form_pm_olt);
        data_form_olt.append('dokumentasi_olt', blob_dokumentasi_olt);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/montir/pm/olt/" + id_pm,
            data: data_form_olt,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400)
                {
                    $('#error_kondisi_modul_olt').text(response.errors.kondisi_modul_olt);
                    $('#error_kondisi_port_olt').text(response.errors.kondisi_port_olt);
                    $('#error_kondisi_sfp_olt').text(response.errors.kondisi_all_sfp_olt);
                    $('#error_kondisi_power_supply').text(response.errors.kondisi_ps_olt);
                    $('#error_kondisi_battery').text(response.errors.kondisi_bat_olt);
                    $('#error_battery_backup').text(response.errors.kondisi_bat_bck_olt);
                    $('#error_kondisi_suhu_kabinet').text(response.errors.kondisi_suhu_kabinet);
                    $('#error_dokumentasi_olt').text(response.errors.dokumentasi_olt);
                  
                }else{
                console.log(response);
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                });
                table.draw();
                $('#modal_pm_olt').modal('hide');
                $("#form_pm_olt")[0].reset();
                }
            }
        })
    });

    $(document).on("click", ".feeder", function(){
        var id_pm_feeder = $(this).data('id');
        $('#modal_pm_feeder').modal('show');

        $.ajax({
            type: "GET",
            url: "/montir/pm/feeder/edit/" + id_pm_feeder,
            success: function (response) {
                if (response.status == 200) {
                    $('#id_pm_feeder').val(response.pm_feeder.id);
                } else {

                }
            }
        })
    });

    var form_pm_feeder = $('#form_pm_feeder')[0];
    $(".form_input_feeder").on("submit", function(e){
        e.preventDefault();
        var blob_dokumentasi_feeder;
        var id_pm_feeder = $('#id_pm_feeder').val();
        let data_form_feeder =  new FormData(form_pm_feeder);
        data_form_feeder.append('dokumentasi_feeder', blob_dokumentasi_feeder);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $.ajax({
            type: "POST",
            url: "/montir/pm/feeder/" + id_pm_feeder,
            data: data_form_feeder,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400)
                {
                    $('#error_kabel_jatuh').text(response.errors.kabel_jatuh);
                    $('#error_kabel_andongan').text(response.errors.kabel_andongan);
                    $('#error_kabel_putus').text(response.errors.kabel_putus);
                    $('#error_kabel_bagus').text(response.errors.kabel_bagus);
                    $('#error_accessoris').text(response.errors.accessoris);
                    $('#error_kondisi_accessoris').text(response.errors.kondisi_accessoris);
                    $('#error_jb').text(response.errors.jb);
                    $('#error_kondisi_jb').text(response.errors.kondisi_jb);
                    $('#error_core').text(response.errors.core);
                    $('#error_posisi_jb').text(response.errors.posisi_jb);
                    $('#error_dokumentasi_feeder').text(response.errors.dokumentasi_feeder);
                  
                }else{
                console.log(response);
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                });
                table.draw();
                $('#modal_pm_feeder').modal('hide');
                $("#form_pm_feeder")[0].reset();
                }
            }
        });
    
    });

    $(document).on("click", ".fdt", function(){
        var id_pm_fdt = $(this).data('id');
        $('#modal_pm_fdt').modal('show');

        $.ajax({
            type: "GET",
            url: "/montir/pm/fdt/edit/" + id_pm_fdt,
            success: function (response) {
                if (response.status == 200) {
                    $('#id_pm_fdt').val(response.pm_fdt.id);
                } else {

                }
            }
        })
    });

    var form_pm_fdt = $('#form_pm_fdt')[0];
    $(".form_input_fdt").on("submit", function(e){
        e.preventDefault();
        var blob_dokumentasi_fdt;
        var id_pm_fdt = $('#id_pm_fdt').val();
        let data_form_fdt =  new FormData(form_pm_fdt);
        data_form_fdt.append('dokumentasi_fdt', blob_dokumentasi_fdt);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $.ajax({
            type: "POST",
            url: "/montir/pm/fdt/" + id_pm_fdt,
            data: data_form_fdt,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400)
                {
                    $('#error_box_fdt').text(response.errors.box_fdt);
                    $('#error_kebersihan_fdt').text(response.errors.kebersihan_fdt);
                    $('#error_all_port_fdt').text(response.errors.all_port_fdt);
                    $('#error_port_fdt_redaman').text(response.errors.port_fdt_redaman);
                    $('#error_dokumentasi_fdt').text(response.errors.dokumentasi_fdt);
                  
                }else{
                console.log(response);
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                });
                table.draw();
                $('#modal_pm_fdt').modal('hide');
                $("#form_pm_fdt")[0].reset();
                }
            }
        });
    
    });

     $(document).on("click", ".fat", function(){
        var id_pm_fat = $(this).data('id');
        $('#modal_pm_fat').modal('show');

        $.ajax({
            type: "GET",
            url: "/montir/pm/fat/edit/" + id_pm_fat,
            success: function (response) {
                if (response.status == 200) {
                    $('#id_pm_fat').val(response.pm_fat.id);
                } else {

                }
            }
        })
    });

    var form_pm_fat = $('#form_pm_fat')[0];
    $(".form_input_fat").on("submit", function(e){
        e.preventDefault();
        var blob_dokumentasi_fat;
        var id_pm_fat = $('#id_pm_fat').val();
        let data_form_fat =  new FormData(form_pm_fat);
        data_form_fat.append('dokumentasi_fat', blob_dokumentasi_fat);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $.ajax({
            type: "POST",
            url: "/montir/pm/fat/" + id_pm_fat,
            data: data_form_fat,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == 400)
                {
                    $('#error_box_fat').text(response.errors.box_fat);
                    $('#error_kebersihan_fat').text(response.errors.kebersihan_fat);
                    $('#error_all_port_fat').text(response.errors.all_port_fat);
                    $('#error_port_fat_redaman').text(response.errors.port_fat_redaman);
                    $('#error_dokumentasi_fat').text(response.errors.dokumentasi_fat);
                  
                }else{
                console.log(response);
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil disimpan',
                    icon: 'success'
                });
                table.draw();
                $('#modal_pm_fat').modal('hide');
                $("#form_pm_fat")[0].reset();
                }
            }
        });
    
    });

     $(document).on('click', '.tombol_olt', function (e) {
        var id_pm = $(this).data('id');
        var form = {
            'lat': $('#latNow').val(),
            'lng': $('#lngNow').val()
        };
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dailys/reload/' + form.lat + '/' + form.lng,
            method: 'GET',

            success: function (response) {

                if (response.status == 404) {
                    console.log('Data Not Found');
                } else {
                    $('#modal_pm_olt').modal('show');
                    $('#id_pm').val(id_pm);
                    $('.olt').html('');
                    $.each(response.olts, function (i, item) {
                        $('.olt').append($('<option>', {
                            value: item.id, text: item.nama_olt
                        }));
                    });
                }
            }, error: function (response) {
                console.log();
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Lokasi Anda Diluar Jangkauan Radius CLuster',
                    icon: 'error'
                });
            }
        })
    })

    const input_dokumentasi_olt = document.getElementById("dokumentasi_olt");
    input_dokumentasi_olt.onchange = function (ev) {
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
                    blob_dokumentasi_olt = blob;
                },
                MIME_TYPE,
                QUALITY
            );

        };
    };

    // const input_dokumentasi_feeder = document.getElementById("dokumentasi_feeder");
    // input_dokumentasi_feeder.onchange = function (ev) {
    //     const file = ev.target.files[0]; // get the file
    //     const blobURL = URL.createObjectURL(file);
    //     const img = new Image();
    //     img.src = blobURL;
    //     img.onerror = function () {
    //         URL.revokeObjectURL(this.src);
    //         // Handle the failure properly
    //         console.log("Cannot load image");
    //     };
    //     img.onload = function () {
    //         URL.revokeObjectURL(this.src);
    //         const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
    //         const canvas = document.createElement("canvas");
    //         canvas.width = newWidth;
    //         canvas.height = newHeight;
    //         const ctx = canvas.getContext("2d");
    //         ctx.drawImage(img, 0, 0, newWidth, newHeight);
    //         canvas.toBlob(
    //             (blob) => {
    //                 // Handle the compressed image. es. upload or save in local state
    //                 blob_dokumentasi_feeder = blob;
    //             },
    //             MIME_TYPE,
    //             QUALITY
    //         );

    //     };
    // };

    // const input_dokumentasi_fdt = document.getElementById("dokumentasi_fdt");
    // input_dokumentasi_fdt.onchange = function (ev) {
    //     const file = ev.target.files[0]; // get the file
    //     const blobURL = URL.createObjectURL(file);
    //     const img = new Image();
    //     img.src = blobURL;
    //     img.onerror = function () {
    //         URL.revokeObjectURL(this.src);
    //         // Handle the failure properly
    //         console.log("Cannot load image");
    //     };
    //     img.onload = function () {
    //         URL.revokeObjectURL(this.src);
    //         const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
    //         const canvas = document.createElement("canvas");
    //         canvas.width = newWidth;
    //         canvas.height = newHeight;
    //         const ctx = canvas.getContext("2d");
    //         ctx.drawImage(img, 0, 0, newWidth, newHeight);
    //         canvas.toBlob(
    //             (blob) => {
    //                 // Handle the compressed image. es. upload or save in local state
    //                 blob_dokumentasi_fdt = blob;
    //             },
    //             MIME_TYPE,
    //             QUALITY
    //         );

    //     };
    // };

    // const input_dokumentasi_fat = document.getElementById("dokumentasi_fat");
    // input_dokumentasi_fat.onchange = function (ev) {
    //     const file = ev.target.files[0]; // get the file
    //     const blobURL = URL.createObjectURL(file);
    //     const img = new Image();
    //     img.src = blobURL;
    //     img.onerror = function () {
    //         URL.revokeObjectURL(this.src);
    //         // Handle the failure properly
    //         console.log("Cannot load image");
    //     };
    //     img.onload = function () {
    //         URL.revokeObjectURL(this.src);
    //         const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
    //         const canvas = document.createElement("canvas");
    //         canvas.width = newWidth;
    //         canvas.height = newHeight;
    //         const ctx = canvas.getContext("2d");
    //         ctx.drawImage(img, 0, 0, newWidth, newHeight);
    //         canvas.toBlob(
    //             (blob) => {
    //                 // Handle the compressed image. es. upload or save in local state
    //                 blob_dokumentasi_fat = blob;
    //             },
    //             MIME_TYPE,
    //             QUALITY
    //         );

    //     };
    // };

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
        document.getElementById('view-blob-olt').append(p);
    }

    function readableBytes(bytes) {
        const i = Math.floor(Math.log(bytes) / Math.log(1024)),
            sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
    }

    var lat, lng;
    $(document).ajaxComplete(function () {
        $("[name=latNow]").val(lat);
        $("[name=lngNow]").val(lng);
    });
    getLocation();


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Geolocation is not supported by this browser');
        }
    }

    function showPosition(position) {
        console.log('Posisi Sekarang', position.coords.latitude, position.coords.longitude);
        var image = '/assets/images/map/pin.png';
        var me = L.icon({
            iconUrl: image,
            iconSize: [38, 38], // size of the icon
        });

        var mymap = L.map("map").setView([position.coords.latitude, position.coords.longitude], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(mymap);

        L.marker([position.coords.latitude, position.coords.longitude], { icon: me })
            .addTo(mymap)
            .bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");


        lat = position.coords.latitude;
        lng = position.coords.longitude;

        $.ajax({
            type: "GET",
            url: '/dailys/reload/' + lat + '/' + lng,
            success: function (response) {

                L.circle([lat, lng], response.setting_radius).addTo(mymap);

                $.each(response.olts, function (index, value) {
                    L.marker([value.lat, value.lng]).addTo(mymap).bindPopup(value.nama_olt);
                });
            }
        });

        $("[name=latNow]").val(position.coords.latitude);
        $("[name=lngNow]").val(position.coords.longitude);


    }

});