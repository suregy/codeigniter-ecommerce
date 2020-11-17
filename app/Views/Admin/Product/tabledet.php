<table class="table table-sm table-striped table-bordered table-hover" id="detail">
    <thead class="text-center align-middle thead-dark">
        <tr>
            <th>No</th>
            <th>Color</th>
            <th>Size</th>
            <th>Stok</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampil as $row) :
            $no++ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $row['color'] ?></td>
            <td><?= $row['size'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><button type="button" value="<?= $row['id'] ?>" class="btn btn-primary eddet"><i
                        class="fas fa-edit"></i></button> |
                <button type="button" value="<?= $row['id'] ?>" class="btn btn-danger eddel"><i
                        class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#detail').dataTable({
        "ordering": false
    });

    $('.eddet').click(function(e) {
        e.preventDefault();

        return false;
    });

    $('.eddel').click(function(e) {
        e.preventDefault();
        let id = $(this).val();
        $.ajax({
            type: 'post',
            url: 'Detprod/destroy',
            dataType: 'json',
            data: {
                'id': id
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.sukses,
                });
                let refid = $('#refid').val();
                load(refid);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
        return false;
    });
});
</script>