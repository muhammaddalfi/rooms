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

    $(document).on('click','.evidence', function(e){
        e.preventDefault();
        var request_id = $(this).data('id');
        // console.log(request_id);
        $('#modal_evidence').modal('show');
     
        $.ajax({
            type:"GET",
            url:"/request/edit/" + request_id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    console.log(response);
                    $('#request_id').val(response.permohonan.id);
                }
            }
        });
    })


    var riwayat = $('#form-riwayat')[0];
    $('#simpan_riwayat').on('click',function(e){
        e.preventDefault();
        $('#spinner').css("display","inline-block");
        var form_gambar  = new FormData(riwayat);
        $.ajax({
            url: '/evidence/store',
            method:'POST',
            data: form_gambar,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log('gagal kirim');
                  
                }else{
                    $('#spinner').css("display","none");
                    swalInit.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_evidence').modal('hide');
                    $("#form-riwayat")[0].reset();
                }
            }
        })

    })

   
});
