<?= $this->extend('layoutbackend/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg">

        <p> <?= $judul; ?></p>

        <!-- tombol input edit delete -->
        <div class="mb-3">
            <button class="btn btn-primary btn-sm tambahData"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
            <button class="btn btn-default btn-sm tambahDataBanyak"> <i class="fas fa-plus-circle"></i> Tambah Data
                Banyak</button>
            <button class="btn btn-success btn-sm btnEdit"> <i class="fas fa-edit"></i> Edit</button>
            <button class="btn btn-danger btn-sm btnDelete"> <i class="fas fa-trash"></i> Delete</button>
        </div>


        <!-- <select name="kategori" id="kategori" class="form-control">
                            <option value="0">-PILIH-</option>
                            <?php //foreach($data as $row):
                            ?>
                                <option value="<?php //echo $row['c1'];
                                                ?>"><?php //echo $row['namacategory']
                                                    ?></option>
                            <?php //endforeach;
                            ?>
                        </select> -->


        <div class="card viewcard">

        </div>
    </div>
</div>

<div class="tampilModal" style="display: none;"></div>

<script>
    var data;

    function tampilData() {
        $.ajax({
            url: "<?= base_url('category/tampildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewcard').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {

        tampilData();

        // tombol tambah di klik
        $('.tambahData').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('category/Formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.tampilModal').html(response.data)
                        .show(); //show digunakan karena display none

                    //tampilkan modal dr file lain
                    $('#modalTambah').modal('show');

                    // untuk ngirim data c1 ke form
                    var data = response.c1;
                    var option;
                    option += '<option selected value="0">-- Pilih Category --</option>';
                    $.each(data, function(i, item) {
                        option += '<option value="' + item.c1 + '">' + item
                            .namacategory + '</option>';
                    });
                    $('#cmbcat1').html(option);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            })
        });

        $('.tambahDataBanyak').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('category/FormtambahBanyak') ?>",
                dataType: "json",
                beforeSend: function() {
                    $('.viewcard').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    $('.viewcard').html(response.data)
                        .show(); //show digunakan karena display none
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            })
        });

        //delete function
        $('.btnDelete').click(function(e) {
            var checkbox = [];

            $.each($("input[name=cat]:checked"), function() {
                checkbox.push($(this).val());
            });

            var length = $("input[name=cat]:checked").length;
            if (length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tidak ada data yang dipilih',
                });
            } else {
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
                            url: "<?= base_url('category/delete') ?>",
                            data: {
                                'data': checkbox
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses,
                                });
                                tampilData();
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + '\n' + xhr.responseText + '\n' +
                                    thrownError);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Batal',
                            text: 'Batal hapus data'
                        });
                    }
                });
            }

        });

        //untuk edit data
        $('.btnEdit').click(function(e) {

            var checkbox = [];

            $.each($("input[name=cat]:checked"), function() {
                checkbox.push($(this).val());
            });
            var dataCheck = checkbox.join(",");
            var length = $("input[name=cat]:checked").length;

            if (length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tidak ada data yang dipilih',
                });
            } else if (length > 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hanya pilih 1 data',
                });
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('category/FormEdit') ?>",
                    data: {
                        'id': dataCheck
                    },
                    dataType: "json",
                    success: function(response) {
                        $('.tampilModal').html(response.data)
                            .show(); //show digunakan karena display none


                        //tampilkan modal dr file lain
                        $('#modalEdit').modal('show');

                        var cmb1 = response.cmb1;
                        var option;
                        option += '<option selected value="0">-- Pilih Category --</option>';
                        $.each(cmb1, function(i, item) {
                            option += '<option value="' + item.c1 + '" ' + (response
                                    .value.c1 == item.c1 ? ' selected ' : '') + ' >' +
                                item.namacategory + '</option>';
                        });
                        $('#cmbcat1').html(option);

                        var cmb2 = response.cmb2;
                        var option2;

                        option2 += '<option selected value="0">-- Pilih Category --</option>';
                        $.each(cmb2, function(i, item) {
                            option2 += '<option value="' + item.c2 + '" ' + (response
                                    .value.c2 == item.c2 ? ' selected ' : '') + ' >' +
                                item.namacategory + '</option>';
                        });
                        $('#cmbcat2').html(option2);


                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                    }
                });
            }
        });



    });
</script>

<?= $this->endSection(); ?>