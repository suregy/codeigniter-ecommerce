
<div class="card">
    <div class="card-body">
        <table class="table table-sm table-striped table-bordered table-hover" id="datacategory">
            <thead class="text-center align-middle thead-dark">
                <tr>
                    <th class="align-middle" rowspan="2">No</th>
                    <th class="align-middle" rowspan="2"> <input type="checkbox" name="selectAll[]" id="selectAll"> </th>
                    <th colspan="3">Kode Kategori</th>
                    <th class="w-75 align-middle" rowspan="2">Nama Kategori</th>
                </tr>
                <tr>
                    <th>kat 1</th>
                    <th>kat 2</th>
                    <th>kat 3</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                    foreach($tampildata as $row) : 
                    $no ++?>
                        <tr>
                            <td><?= $no ?></td>
                            <td> <input type="checkbox" class="cat" name="cat" value="<?= $row['id'] ?>"> </td>
                            <td><?= $row['c1'] ?></td>
                            <td><?= $row['c2'] ?></td>
                            <td><?= $row['c3'] ?></td>
                            <td><?= $row['namacategory'] ?></td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    $(document).ready(function(){
        $('#datacategory').dataTable();

        // untuk select all
        $('#selectAll').click(function(e){
            if($(this).is(':checked')){
                $('.cat').prop('checked',true);
            }else{
                $('.cat').prop('checked',false);
            }
        })
    });
</script>