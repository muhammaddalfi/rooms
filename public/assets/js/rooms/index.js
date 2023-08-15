$(document).ready(function () {

    var table = $('.datatable-responsive').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '/dailys/fetch',
        autoWidth: false,

        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'created_at' },
            { data: 'user.name' },
            { data: 'olt.nama_olt' },
            { data: 'jenis_kegiatan.jenis_kegiatan' },
            { data: 'gambar' },
            { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false, width: 220 }
        ],
        order: [[0, "desc"]],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        }
    });

    //add rooms
    $(document).on('click', '.add_rooms', function (e) {
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
                    $('#modal_daily').modal('show');
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
                    text: `Silahkan Hubungi PIC Aplikasi ${response.responseJSON.message}`,
                    icon: 'error'
                });
            }
        })
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

    $(document).on('click', '.view', function (e) {
        e.preventDefault();
        var id_kegiatan = $(this).data('id');
        $('#modal_view').modal('show');

        // console.log(id_kegiatan);
        $.ajax({
            type: "GET",
            url: "/dailys/show/" + id_kegiatan,
            success: function (response) {
                if (response.status == 404) {
                    console.log('Data Not Found');
                } else {

                    console.log(response);
                        let tanggal = moment(response.show.created_at).format('DD-MM-YYYY');

                        $('#id_kegiatan').val(response.show.id);
                        $('#view_tanggal').html(tanggal);
                        $('#view_nama').html(response.show.user.name);
                        $('#view_nama_olt').html(response.show.olt.nama_olt);
                        $('#view_jenis_kegiatan').html(response.show.jenis_kegiatan.jenis_kegiatan);
                        $('#view_catatan').html(response.show.catatan);


                        if(response.show.kategori_dinas == 'Ya'){
                           $('#view_kategori_dinas').html('SPPD');
                        }else if(response.show.kategori_dinas == 'Tidak'){
                           $('#view_kategori_dinas').html('Tidak SPPD');
                        }

                       $('#gambar_bukti').attr("src", "storage/files/" + response.show.gambar);
                       $('#gambar_bukti_link').attr("href", "storage/files/" + response.show.gambar);

                }
            }
        })

    })


    var daily = $('#form-daily')[0];
    $('#save').on('click', function (e) {
        e.preventDefault();
        $('#spinner').css("display", "inline-block");
        var form = new FormData(daily);
        // console.log(data);
        $.ajax({
            url: '/dailys/store',
            method: 'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == 400) {
                    console.log(response);
                    $('#error_lat').html(response.errors.latNow);
                    $('#error_lng').html(response.errors.lngNow);
                    $('#error_kategori').html(response.errors.kategori);
                    $('#error_olt').html(response.errors.olt);
                    $('#error_kegiatan').html(response.errors.kegiatan);
                    $('#error_images').html(response.errors.catatan);

                } else {

                    $('#spinner').css("display", "none");
                    table.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data Berhasil ditambahkan',
                        icon: 'success'
                    });

                    $('#modal_daily').modal('hide');
                    $("#form-daily")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_daily').modal('show');
        $.ajax({
            type: "GET",
            url: "/dailys/edit/" + id,
            success: function (response) {
                if (response.status == 404) {
                    console.log("Data not found");
                } else {
                    console.log(response);
                    $('#id_daily').val(response.daily.id);
                    $('#edit_kategori').val(response.daily.kategori_dinas).change();
                    $('#edit_olt').val(response.daily.olt.nama_olt).change();
                    $('#edit_kegiatan').val(response.daily.jenis_kegiatan.jenis_kegiatan).change();
                    $('#edit_catatan').val(response.daily.catatan);
                    $('#view_images').attr("src", "storage/files/" + response.daily.gambar);
                    
                }
            }
        })
    })

    var form_edit = $('#editDaily')[0];
    $(document).on('submit', '#editDaily', function (e) {
        e.preventDefault();
        var id = $('#id_daily').val();
        let editdata = new FormData(form_edit);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/dailys/update/" + id,
            data: editdata,
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
                $('#modal_edit_daily').modal('hide');
                $("#editDaily")[0].reset();
            }
        })

    });

    //delete
    $(document).on('click', '.delete', function (e) {
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
            title: 'Hapus Data',
            text: "Apakah Kamu Yakin ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/dailys/delete/" + id,

                    success: function () {
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
        // console.log('Posisi Sekarang', position.coords.latitude, position.coords.longitude);
        var url = window.location.href; 
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

        L.marker([position.coords.latitude, position.coords.longitude],{icon: me})
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