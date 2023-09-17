<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">View Inventory Request</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url.'admin?page=inventory_request' ?>">Inventory Request List</a></li>
          <li class="breadcrumb-item active">View Inventory Request</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<?php
$qry = $conn->query("SELECT i.*, u.firstname, u.lastname, u.role FROM inventory_request_list i INNER JOIN users u ON i.users_id = u.id WHERE i.id = '{$_GET['id']}'");

if ($qry->num_rows > 0) {
    $row = $qry->fetch_assoc();

    foreach ($row as $k => $v) {
        $$k = $v;
    }
}
?>
<div class="card card-outline card-purple">
    <div class="card-header">
        <h4 class="card-title">I.R Record - <?php echo $ir_code ?></h4>
    </div>
    <div class="card-body" id="print_out">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label text-info">I.R. Code</label>
                    <div><?php echo isset($ir_code) ? $ir_code : '' ?></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="client" class="control-label text-info">Prepared By</label>
                        <div><?php echo isset($firstname) ? $firstname . ' ' . $lastname . ' (' . $role . ')' : '' ?></div>
                    </div>
                </div>
            </div>
            <h4 class="text-info">Items</h4>
            <table class="table table-striped table-bordered" id="list">
                <colgroup>
                    <col width="10%">
                    <col width="10%">
                    <col width="30%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr class="text-light bg-navy">
                        <th class="text-center py-1 px-2">Qty</th>
                        <th class="text-center py-1 px-2">Unit</th>
                        <th class="text-center py-1 px-2">Item</th>
                        <th class="text-center py-1 px-2">Cost</th>
                        <th class="text-center py-1 px-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    $qry = $conn->query("SELECT s.*,i.name,i.description FROM `ir_stock_list` s inner join item_list i on s.item_id = i.id where s.id in ($ir_stock_ids)");
                    while($row = $qry->fetch_assoc()):
                        $total += $row['total']
                    ?>
                    <tr>
                        <td class="py-1 px-2 text-center"><?php echo number_format($row['quantity']) ?></td>
                        <td class="py-1 px-2 text-center"><?php echo ($row['unit']) ?></td>
                        <td class="py-1 px-2">
                            <?php echo $row['name'] ?> <br>
                            <?php echo $row['description'] ?>
                        </td>
                        <td class="py-1 px-2 text-right">₱ <?php echo number_format($row['price'],2) ?></td>
                        <td class="py-1 px-2 text-right">₱ <?php echo number_format($row['total'],2) ?></td>
                    </tr>

                    <?php endwhile; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right py-1 px-2" colspan="4">Total</th>
                        <th class="text-right py-1 px-2 grand-total">₱ <?php echo isset($amount) ? number_format($amount,2) : 0 ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remarks" class="text-info control-label">Remarks</label>
                        <p><?php echo isset($remarks) ? $remarks : '' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-success" type="button" id="print">Print</button>
        <a class="btn btn-primary" href="<?php echo base_url.'/admin?page=inventory_request/manage_inventory_request&id='.(isset($id) ? $id : '') ?>">Edit</a>
        <a class="btn btn-dark" href="<?php echo base_url.'/admin?page=inventory_request' ?>">Back To List</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center qty">
            <span class="visible"></span>
            <input type="hidden" name="item_id[]">
            <input type="hidden" name="unit[]">
            <input type="hidden" name="qty[]">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center unit">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right cost">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table>
<script>
    
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Inventory Request Record - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Inventory Request</h4>'+
                      '</div>'+
                      '<div class="col-1 text-right">'+
                      '</div>'+
                      '</div><hr/>')
            _el.append(p.html())
            var nw = window.open("","","width=1200,height=900,left=250,location=no,titlebar=yes")
                     nw.document.write(_el.html())
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                            nw.close()
                            end_loader()
                         }, 200);
                     }, 500);
        })
    })
</script>