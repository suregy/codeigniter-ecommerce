/*
fungsi tampil data
*/

function tampilData(){
    $.ajax({
        url: "brands/getData", 
        dataType: "json", 
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

    /**untuk handel tambah */
    $('.tambahData').click(function(e){
        e.preventDefault();
        $.ajax({ 
            url: 'brands/formTambah', 
            dataType: 'json', 
            success: function(response) { 
                $('.tampilModal').html(response.data).show();
                $('#modalTambah').modal('show');
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

        $("input[name='brands']:checked").each(function(){
            checkbox.push($(this).val());
        });

        let length = $("input[name='brands']:checked").length;

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
                            url: "brands/delete",
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

    /**untuk handle edit */
    $('.btnEdit').click(function(e){
        e.preventDefault();

        let checkbox = [];

        $("input[name='brands']:checked").each(function(){
            checkbox.push($(this).val());
        });

        let length = $("input[name='brands']:checked").length;

        let dataCheck = checkbox.join(",");

        if(length === 0 || length > 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'harus pilih satu data',
            });
        }else{
            $.ajax({
                url: 'brands/formEdit', 
                dataType: 'json', 
                data: {
                    'id' : dataCheck,
                }, 
                success: function(response) { 
                    $('.tampilModal').html(response.data).show();
                    $('#modalEdit').modal('show');
                    
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        }


    });

});