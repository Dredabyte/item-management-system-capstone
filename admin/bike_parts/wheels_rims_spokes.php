<!--Title Header-->
<title>Item Management System - Bike Parts</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">WHEELS, RIMS and SPOKES</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url ?>admin/?page=bike_parts">Bike Parts & Components</a></li>
                    <li class="breadcrumb-item active">Wheels, Rims and Spokes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-gray">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <style>
                            img#photo {
                                height: 175px;
                                width: 200px;
                                object-fit: cover;
                                display: block;
                                margin: 0 auto;
                            }
                        </style>
                        <table id="" class="table table-bordered">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="50%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Item Image</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectedCategoryIds = [18, 23, 22, 17]; // An array of category IDs

                                $categoryIdsString = implode(',', $selectedCategoryIds);

                                $qry = $conn->query("SELECT i.*, b.name as brand_name FROM `item_list` i INNER JOIN `brand_list` b ON i.brand_id = b.id WHERE i.category_id IN ($categoryIdsString) ORDER BY i.name ASC");

                                if (!$qry) {
                                    die("Query failed: " . $conn->error);
                                }

                                if ($qry->num_rows > 0) {
                                    while ($row = $qry->fetch_assoc()) :
                                ?>
                                        <tr>
                                            <td><img src="<?php echo validate_image(isset($row['image']) ? $row['image'] : ''); ?>" alt="Item Image" id="photo"></td>
                                            <td>
                                                <h3><?php echo $row['name']; ?></h3>
                                                <p>Brand: <?php echo $row['brand_name']; ?></p>
                                            </td>
                                            <td>
                                                <?php echo $row['description']; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                } else {
                                    ?>
                                    <tr style="text-align: center;">
                                        <td colspan="3">No data available</td>
                                    </tr>
                                <?php } ?>
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
    <!-- /.card-footer -->
</section>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->