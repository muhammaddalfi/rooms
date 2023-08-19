$(document).ready(function(){
    $(document).on('click','.profile', function(e){
        e.preventDefault();
        $('#modal_profile').modal('show');
    })

    $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_user').val();
        var data = {
            'password': $('#password').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/update/password/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Password berhasil diganti!',
                    icon: 'success'
                });
            $('#modal_profile').modal('hide');
            }
        })

    });

})