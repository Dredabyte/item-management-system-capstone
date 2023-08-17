<!--Title Header-->
<title>Item Management System - Total Item Lists</title>

<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Total Item Lists</h1>
        <p class="mb-0">The total items list provides comprehensive details, including specific supplier availability status, ensuring a complete overview of inventory.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Total Item Lists</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>
              <?php
                echo $conn->query("SELECT * FROM `item_list` where id != 1 ")->num_rows;
              ?>
            </h3>
            <p>Items Lists</p>
          </div>
          <div class="icon">
            <i class="fas fa-warehouse"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Items Lists</h3>
            <div class="card-tools">
              <div class="input-group-append">
                <a href="javascript:void(0)" id="create_new" class="btn btn-block btn-outline-dark">
                  Add Items
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-hover table-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date Created</th>
                  <th>Item Name</th>
                  <th>Supplier Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $i = 1;
                $qry = $conn->query("SELECT i.*,s.name as supplier from `item_list` i inner join supplier_list s on i.supplier_id = s.id order by i.name asc,s.name asc ");
                while($row = $qry->fetch_assoc()):
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo date('F j, Y | g:i A',strtotime($row['date_created'])) ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['supplier'] ?></td>
                  <td>
                    <?php if($row['status'] == 1): ?>
                        <span class="badge badge-success rounded-pill">Active</span>
                    <?php else: ?>
                        <span class="badge badge-danger rounded-pill">Inactive</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        Action
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                      <div class="dropdown-divider"></div>
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

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

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
			_conf("Are you sure to delete this Item permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Item","item_list/manage_item_list.php","mid-large")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item Details","item_list/manage_item_list.php?id="+$(this).attr('data-id'),"mid-large")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-box'></i> Item Details","item_list/view_item_list.php?id="+$(this).attr('data-id'),"")
		})
		//$('.table td,.table th').addClass('py-1 px-2 align-middle')
		//$('.table').dataTable();
	})
	function delete_item($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
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