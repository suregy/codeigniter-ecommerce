/**untuk tampil data */
function tampilData(){
    $.ajax({
        url: 'banners/getData', 
        dataType: 'json', 
        success: function(response) { 
            $('.viewcard').html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        }
    });
}

$(document).ready(function(e){

    tampilData();

    //untuk form tambah data
    $('.tambahData').click(function(e){
        e.preventDefault();

        
        $.ajax({
            url: 'banners/formTambah', 
            dataType: 'json', 
            beforeSend: function(){
                $('.viewcard').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            success: function(response){
                $('.viewcard').html(response.data).show(); //show digunakan karena display none
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    });


    /**untuk handle delete */
    $('.btnDelete').click(function(e){
        e.preventDefault();
        let checkbox = [];

        $("input[name='banner']:checked").each(function(){
            checkbox.push($(this).val());
        });

        let length = $("input[name='banner']:checked").length;

        let dataCheck = checkbox.join(",");

        if(length === 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak ada data yang dipilih',
            });
        }else{
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data ?',
                cancelButtonText: 'No, cancel!',
                reverseButtons: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "banners/delete",
                            data: {'id' : dataCheck},
                            success: function(response){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses,
                                });
                                tampilData();
                            },
                            error: function(xhr, ajaxOptions, thrownError){
                                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Batal',
                            text: 'Batal hapus data'
                        });
                    }
                });
        }
    });


    /**handle untuk edit */
    $('.btnEdit').click(function(e){
        e.preventDefault();
        let checkbox = [];

        $("input[name='banner']:checked").each(function(){
            checkbox.push($(this).val());
        });

        let length = $("input[name='banner']:checked").length;

        let dataCheck = checkbox.join(",");
        if(length === 0 || length > 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'harus pilih satu data',
            });
        }else{
            $.ajax({
                url: 'banners/formEdit', 
                dataType: 'json', 
                data: {
                    'id' : dataCheck,
                }, 
                beforeSend: function(){
                    $('.viewcard').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                success: function(response) { 
                    $('.viewcard').html(response.data).show(); //show digunakan karena display none
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        }
    });

});