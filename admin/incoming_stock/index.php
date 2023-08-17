<!--Title Header-->
<title>Item Management System - Incoming Stocks</title>
</head>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Incoming Stocks</h1>
        <p class="mb-0">Incoming stock entails the receipt of goods as part of a purchase order, ensuring seamless inventory replenishment. It also encompasses the receipt of items previously on backorder, contributing to efficient order fulfillment and inventory management.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Incoming Stocks</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content" id="items">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h3 class="card-title">Incoming Stocks</h3>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Created</th>
                  <th>From</th>
                  <th>Item/s</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $i = 1;
                  $qry = $conn->query("SELECT * FROM `incoming_list` order by `date_created` desc");
                  while($row = $qry->fetch_assoc()):
                      $row['items'] = explode(',',$row['stock_ids']);
                      if($row['from_order'] == 1){
                          $code = $conn->query("SELECT po_code from `purchase_order_list` where id='{$row['form_id']}' ")->fetch_assoc()['po_code'];
                      }else{
                          $code = $conn->query("SELECT bo_code from `backorder_list` where id='{$row['form_id']}' ")->fetch_assoc()['bo_code'];
                      }
                  ?>
                <tr>
                 <td><?php echo $i++; ?></td>
                 <td><?php echo date('F j, Y | g:i A',strtotime($row['date_created'])) ?></td>
                 <td><?php echo $code ?></td>
                 <td><?php echo number_format(count($row['items'])) ?></td>
                 <td>
                 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          Action
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="<?php echo base_url.'admin?page=incoming_stock/view_incoming_stock&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                      <div class="dropdown-divider"></div>
                     <!-- <a class="dropdown-item" href="<?php echo base_url.'admin?page=incoming_stock/manage_incoming_stock&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                      <div class="dropdown-divider"></div> -->
                      <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                  </div>
                 </td>
                </tr>
                <?php endwhile; ?> 
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Incoming Orders permanently?","delete_incoming",[$(this).attr('data-id')])
		})
	
		//$('.table td,.table th').addClass('py-1 px-2 align-middle')
		//$('.table').dataTable();
	})
	function delete_incoming($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_incoming",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>