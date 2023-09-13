<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add/Edit Inventory Request Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url . '/admin?page=inventory_request' ?>">Inventory Request Lists</a></li>
                    <li class="breadcrumb-item active">Add/Edit Request</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT p.*,s.name as user FROM inventory_request_list p inner join users s on p.users_id = s.id  where p.id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<div class="card card-outline card-purple">
    <div class="card-header">
        <h4 class="card-title"><?php echo isset($id) ? "Inventory Request - " . $ir_code : 'Create New Inventory Request' ?></h4>
    </div>
    <div class="card-body">
        <form action="" id="ir-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">I.R. Code</label>
                        <input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($ir_code) ? $ir_code : '' ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="users_id" class="control-label text-info">Prepared BY</label>
                            <select name="users_id" id="users_id" class="custom-select select2">
                                <option <?php echo !isset($users_id) ? 'selected' : '' ?> disabled></option>
                                <?php
                                $users = $conn->query("SELECT * FROM `users` order by `firstname` asc");
                                while ($row = $users->fetch_assoc()) :
                                ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($users_id) && $users_id == $row['id'] ? "selected" : "" ?>>
                                        <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' (' . $row['role'] . ')' ?>
                                    </option>

                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">Item Form</legend>
                    <div class="row justify-content-center align-items-end">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="item_id" class="control-label">Item</label>
                                <select name="item_id" id="item_id" class="custom-select select1">
                                    <option <?php echo !isset($item_id) ? 'selected' : '' ?> disabled></option>
                                    <?php
                                    $item = $conn->query("SELECT * FROM `item_list` order by `name` asc");
                                    while ($row = $item->fetch_assoc()) :
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo isset($item_id) && $item_id == $row['id'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unit" class="control-label">Unit</label>
                                <input type="text" class="form-control rounded-0" id="unit">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty" class="control-label">Qty</label>
                                <input type="number" step="1" min="0" class="form-control rounded-0" id="qty">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn btn-sm btn-primary" id="add_to_list">Add to List</button>
                            </div>
                        </div>
                </fieldset>
                <hr>
                <table class="table table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr class="text-light bg-navy">
                            <th class="text-center py-1 px-2"></th>
                            <th class="text-center py-1 px-2">Qty</th>
                            <th class="text-center py-1 px-2">Unit</th>
                            <th class="text-center py-1 px-2">Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if (isset($id)) :
                            $qry = $conn->query("SELECT p.*,i.name,i.description FROM `ir_items` p inner join item_list i on p.item_id = i.id where p.ir_id = '$id'");
                            while ($row = $qry->fetch_assoc()) :
                                $total += $row['total']
                        ?>
                                <tr>
                                    <td class="py-1 px-2 text-center">
                                        <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
                                    </td>
                                    <td class="py-1 px-2 text-center qty">
                                        <span class="visible"><?php echo number_format($row['quantity']); ?></span>
                                        <input type="hidden" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                        <input type="hidden" name="unit[]" value="<?php echo $row['unit']; ?>">
                                        <input type="hidden" name="qty[]" value="<?php echo $row['quantity']; ?>">
                                        <input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
                                        <input type="hidden" name="total[]" value="<?php echo $row['total']; ?>">
                                    </td>
                                    <td class="py-1 px-2 text-center unit">
                                        <?php echo $row['unit']; ?>
                                    </td>
                                    <td class="py-1 px-2 item">
                                        <?php echo $row['name']; ?> <br>
                                        <?php echo $row['description']; ?>
                                    </td>
                                    <td class="py-1 px-2 text-right cost">
                                        <?php echo number_format($row['price'], 2); ?>
                                    </td>
                                    <td class="py-1 px-2 text-right total">
                                        <?php echo number_format($row['total'], 2); ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">
                                <input type="hidden" name="amount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 grand-total">0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks" class="text-info control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn btn-primary" type="submit" form="ir-form">Save</button>
        <a class="btn btn btn-dark" href="<?php echo base_url . '/admin?page=purchase_order_list' ?>">Cancel</a>
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

</script>