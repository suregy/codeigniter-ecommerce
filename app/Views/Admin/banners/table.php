
<div class="card">
    <div class="card-body">
        <table class="table table-sm table-striped table-bordered table-hover" id="databrands">
            <thead class="text-center align-middle thead-dark">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 5%"> <input type="checkbox" name="selectAll[]" id="selectAll"> </th>
                    <th style="width: 10%">Created</th>
                    <th style="width: 70%">Nama Banner</th>
                    <th style="width: 5%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                    foreach($getdata as $row) : 
                    $no ++?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><input type="checkbox" class="banner" name="banner" value="<?= $row['id'] ?>"> </td>
                            <td><?= mediumdate_indo($row['date_create']); ?></td>
                            <td><?= $row['banner'] ?></td>
                            <td>
                            <?php if($row['status'] === '1') : ?>
                                Active
                            <?php else : ?>
                                Non Active
                            <?php endif; ?>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    $(document).ready(function(){
        $('#databrands').dataTable();

        // untuk select all
        $('#selectAll').click(function(e){
            if($(this).is(':checked')){
                $('.banner').prop('checked',true);
            }else{
                $('.banner').prop('checked',false);
            }
        })
    });
</script>