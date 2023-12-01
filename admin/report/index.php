<!--Title Header-->
<title>Item Management System - Reports</title>
<!--Title Header ends-->

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reports</h1>
        <p class="mb-0">A stock report is a document or presentation that provides a summary and analysis of a company's or individual's stock holdings, detailing key information such as quantity, value, and performance of the stocks in a portfolio.</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active">Reports</li>
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
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Generate Report</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="reportForm" action="" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label for="reportType">Select Report Type</label>
                <select class="custom-select form-control-border" id="reportType" name="reportType">
                  <option value="incoming">Incoming Stock</option>
                  <option value="outgoing">Outgoing Stock</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label>Date Start:</label>
                <div class="input-group date" id="start_reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" name="startDate" data-target="#start_reservationdate" placeholder="mm/dd/yyyy">
                  <div class="input-group-append" data-target="#start_reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label>Date End:</label>
                <div class="input-group date" id="end_reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" name="endDate" data-target="#end_reservationdate" placeholder="mm/dd/yyyy">
                  <div class="input-group-append" data-target="#end_reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body  -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Generate Report</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.row -->

    <!-- start-row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Report</h3>
          </div>
          <div class="card-body" id="print_out">
            <div class="container-fluid">
              <table class="table table-striped table-bordered" id="list">
                <colgroup>
                  <col width="30%">
                  <col width="40%">
                  <col width="30%">
                </colgroup>
                <thead>
                  <tr class="text-light bg-success">
                    <th class="text-center py-1 px-2">Ordered Date</th>
                    <th class="text-center py-1 px-2">Stocks IDs</th>
                    <th class="text-center py-1 px-2">Grand Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once '../config.php';

                  if ($_POST) {
                    $startDate = $_POST['startDate'];
                    $date = DateTime::createFromFormat('m/d/Y', $startDate);
                    $start_date = $date->format("Y-m-d");

                    $endDate = $_POST['endDate'];
                    $format = DateTime::createFromFormat('m/d/Y', $endDate);
                    $end_date = $format->format("Y-m-d");

                    $reportType = $_POST['reportType'];

                    if ($reportType === 'incoming') {
                      $tableName = 'incoming_list';
                      $tableTitle = 'Incoming Report';
                    } elseif ($reportType === 'outgoing') {
                      $tableName = 'outgoing_list';
                      $tableTitle = 'Outgoing Report';
                    } else {
                      // Handle invalid report type here
                      echo 'Invalid report type selected';
                      exit;
                    }

                    $sql = "SELECT * FROM $tableName WHERE DATE(date_created) BETWEEN '$start_date' AND '$end_date' ORDER BY DATE(date_created) ASC";
                    $query = $conn->query($sql);

                    // Check if any records were found
                    if ($query->num_rows > 0) {
                      $totalAmount = 0; // Initialize the total amount variable

                      echo '<h3>' . $tableTitle . '</h3>';

                      while ($row = $query->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td class="py-1 px-2 text-center">' . date('F j, Y g:i A', strtotime($row['date_created'])) . '</td>';
                        echo '<td class="py-1 px-2 text-center">' . $row['stock_ids'] . '</td>';
                        echo '<td class="py-1 px-2 text-center">₱ ' . number_format($row['amount'], 2) . '</td>';
                        echo '</tr>';

                        // Accumulate the grand total for each row
                        $totalAmount += $row['amount'];
                      }

                      echo '<tfoot>';
                      echo '<tr>';
                      echo '<td colspan="2" class="py-1 px-2 text-center">Total Amount</td>';
                      echo '<td>₱ ' . number_format($totalAmount, 2) . '</td>';
                      echo '</tr>';
                      echo '</tfoot>';
                    } else {
                      // No records found message
                      echo '<p>No records found for the selected date range.</p>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer py-1 text-right">
            <button class="btn btn-success" type="button" id="print">Print</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end-row -->
  </div>
  <!-- /.container-fluid -->
  </div>
</section>
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

    //Date picker
    $('#start_reservationdate').datetimepicker({
      format: 'L'
    });

    //Date picker
    $('#end_reservationdate').datetimepicker({
      format: 'L'
    });

    $('#print').click(function() {
      start_loader()
      var _el = $('<div>')
      var _head = $('head').clone()
      _head.find('title').text("Report Order Details - Print View")
      var p = $('#print_out').clone()
      p.find('tr.text-light').removeClass("text-light bg-info")
      _el.append(_head)
      _el.append('<div class="d-flex justify-content-center">' +
        '<div class="col-1 text-right">' +
        '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />' +
        '</div>' +
        '<div class="col-10">' +
        '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>' +
        '<h4 class="text-center">Report</h4>' +
        '<h5 class="text-left">Printed by: <?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname') . ' - ' . $_settings->userdata('role')) ?></h5>' +
        '</div>' +
        '<div class="col-1 text-right">' +
        '</div>' +
        '</div><hr/>')
      _el.append(p.html())
      var nw = window.open("", "", "width=1200,height=900,left=250,location=no,titlebar=yes")
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