<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php include_once('../includes/convertstatus.php') ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบติดตามสำหรับการจัดการสื่อโฆษณาบนสังคมออนไลน์</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/0ff79eb7ba.js"></script>
  <!-- Ionicons -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar & Main Sidebar Container -->
    <?php include_once('../includes/sidebar_leader.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content mt-2">

        <!-- Default box -->
        <div class="card-header">
          <!-- <form action="search.php" method="post"> -->
          <form method="post" action="result.php">
            <div class="row">
              <h3>รายงานประสิทธิภาพการทำงานของพนักงาน</h3>
            </div>

            <section class="content">
              <div class="row">


                <div class="col-md-12 col-12">
                  <div class="info-box">


                    <div class="info-box-content">
                      <span class="info-box-text">บัญชีผู้ใช้</span>
                      <span class="info-box-number">
                        <select class="form-control select2" data-placeholder="Select user" name="task-user">
                          <option value="" selected></option>
                          <?php
                          $mysqli = new mysqli("localhost", "root", "", "myproject");

                          // Check connection
                          if ($mysqli->connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                            exit();
                          }
                          $sql = "Select * FROM user where role_master_id = 2";
                          $result = $mysqli->query($sql);
                          if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                              // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                            }
                          } else {
                            echo "0 results";
                          }

                          foreach ($result as $key => $value) { ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['name']); ?></option>
                          <?php } ?>
                        </select></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

              </div>
            </section>

            <div class="row float-right">
              <div class="col">
                <button type="submit" class="btn btn-info" name="search">ค้นหา</button>
              </div>
              <div class="col">
                <button type="submit" class="btn btn-info" name="searchall">ค้นหาทั้งหมด</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer -->
    <?php include_once('../includes/footer.php') ?>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>

  <script>
    $(function() {
      $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true
      });
    });

    function disableItem(id) {
      if (confirm('ยันยันการลบใช่หรือไม่') == true) {
        window.location = `disable.php?id=${id}`;
        // window.location='delete.php?id='+id;
      }
    };
  </script>

  <script>
    $(document).ready(function() {
      $('[data-toggle="popover"]').popover();
    });
  </script>


</body>

</html>