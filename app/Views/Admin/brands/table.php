<div class="card">
    <div class="card-body">
        <table class="table table-sm table-striped table-bordered table-hover" id="databrands">
            <thead class="text-center align-middle thead-dark">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 5%"> <input type="checkbox" name="selectAll[]" id="selectAll"> </th>
                    <th style="width: 90%">Nama Brands</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($getdata as $row) :
                    $no++ ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><input type="checkbox" class="tag" name="brands" value="<?= $row['id'] ?>"> </td>
                        <td><?= $row['namabrands'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#databrands').dataTable();

        // untuk select all
        $('#selectAll').click(function(e) {
            if ($(this).is(':checked')) {
                $('.tag').prop('checked', true);
            } else {
                $('.tag').prop('checked', false);
            }
        })
    });
</script>