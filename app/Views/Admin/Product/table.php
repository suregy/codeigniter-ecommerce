<div class="card">
    <div class="card-body">
        <table class="table table-sm table-striped table-bordered table-hover" id="dataproduct">
            <thead class="text-center align-middle thead-dark">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 5%"> <input type="checkbox" name="selectAll[]" id="selectAll"> </th>
                    <th>Nama Brands</th>
                    <th>Nama Product</th>
                    <th>Harga beli</th>
                    <th>Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($tampildata as $row) :
                    $no++ ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><input type="checkbox" class="product" name="product" value="<?= $row['id'] ?>"> </td>
                    <td><?= $row['namabrands'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td class="text-right"><?= rupiah($row['hrgbeli']); ?></td>
                    <td class="text-right"><?= rupiah($row['hrgjual']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
$(document).ready(function() {
    var table = $('#dataproduct').dataTable({
        "ordering": false
    });

    // untuk select all
    $('#selectAll').click(function(e) {
        if ($(this).is(':checked')) {
            $('.product').prop('checked', true);
        } else {
            $('.product').prop('checked', false);
        }
    });


});
</script>