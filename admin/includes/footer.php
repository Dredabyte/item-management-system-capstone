<script>
  $(document).ready(function() {
    window.viewer_modal = function($src = '') {
      start_loader()
      var t = $src.split('.')
      t = t[1]
      if (t == 'mp4') {
        var view = $("<video src='" + $src + "' controls autoplay></video>")
      } else {
        var view = $("<img src='" + $src + "' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false,
        focus: true
      })
      end_loader()

    }
    window.uni_modal = function($title = '', $url = '', $size = "") {
      start_loader()
      $.ajax({
        url: $url,
        error: err => {
          console.log()
          alert("An error occured")
        },
        success: function(resp) {
          if (resp) {
            $('#uni_modal .modal-title').html($title)
            $('#uni_modal .modal-body').html(resp)
            if ($size != '') {
              $('#uni_modal .modal-dialog').addClass($size + '  modal-dialog-centered')
            } else {
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
            }
            $('#uni_modal').modal({
              show: true,
              backdrop: 'static',
              keyboard: false,
              focus: true
            })
            end_loader()
          }
        }
      })
    }
    window._conf = function($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
    }
  })


  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('HELLO, <?php echo ucwords($_settings->userdata('role') . '-' . $_settings->userdata('firstname') . ' ' . $_settings->userdata('middlename') . ' ' . $_settings->userdata('lastname')) ?> - GOOD DAY! ☻')
    });
  });
</script>

<!--Main Footer-->
<footer class="main-footer">
  <strong>Magnaye Enterprise Capstone Project.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- jQuery -->
<script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.js.map"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.min.js.map"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url ?>plugins/fullcalendar/main.js"></script>

<!-- jQuery Knob Chart -->
<script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>