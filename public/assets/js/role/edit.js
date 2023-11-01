$('#form-edit-role').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        var id = $('#id_role').val();
        alert(id);
        // Serialize the form data
        var formData = new FormData(this);

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'PUT', // Use POST or PUT method as needed
            url:"/role/"+ id, // Get the form action URL
            data: formData,
            dataType: "json",
           
            success: function(response) {
                Swal.fire({
                title: 'Suksess!',
                text: 'Data berhasil disimpan!',
                icon: 'success'
            });
                // Handle the success response here, e.g., display a success message
                console.log(response);
            },
            error: function(error) {
                // Handle any errors here, e.g., display validation errors
                console.log(error.responseJSON);
            }
        });
    });