<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tasks Acceptance</title>
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
    <?php include_once('../includes/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content mt-2">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title d-inline-block">รายการตรวจรับงาน</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>รหัส</th>
                  <th>ชื่องาน</th>
                  <th>ช่องทางสังคมออนไลน์</th>
                  <th>วันเผยแพร่</th>
                  <th>เวลาเผยแพร่</th>
                  <th>วันเวลาที่สร้าง</th>
                  <!-- <th>Created By</th>
                  <th>Created At</th> -->
                  <!-- <th>Status</th> -->
                  <th>จัดการ</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql = "select t.id, t.name, t.launch_date, t.launch_time, t.created, t.channel_id, t.create_by,  t.status_master_id,  c.name as channel_name,
                s.status_name  , u.name as username
                FROM task t  
                INNER JOIN channel c ON t.channel_id = c.id 
                INNER JOIN status_master s ON t.status_master_id = s.id
                INNER JOIN user u ON t.create_by = u.id
                where s.id = 5 ";

                $result = $conn->query($sql);

                // if (!empty($result) && $result->num_rows > 0) {

                if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    // echo "id: " . $row["id"] . " - Name: " . $row["channel_name"] . " " . $row["lastname"] . "<br>";
                  }
                } else {
                  //echo "0 results";
                }
                // for ($id = 1; $id <= 5; $id++) { 
                foreach ($result as $key => $value) {
                ?>
                  <tr>

                    <td><?php echo $value['id']; ?></td>
                    <td><a href="view.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                    <td><?php echo $value['channel_name']; ?></td>
                    <td><?php echo $value['launch_date']; ?></td>
                    <td><?php echo $value['launch_time']; ?></td>
                    <td><?php echo $value['created']; ?></td>
                    <!-- <td><?php echo $value['username']; ?></td>
                    
                    <!-- <td><a href="#" title="Status History" data-toggle="popover" data-placement="left" data-content="Content"><?php echo strtoupper($value['status_name']); ?></li></td> -->
                    <td>
                      <!-- <a href="view.php?id=<?php echo $value['id']; ?>" >
                        <i class="fa fa-eye"></i>
                      </a> -->
                      <a href="#" onclick="acceptItem(<?php echo $value['id']; ?>);">
                        <i class="fa fa-check text-success"></i>
                      </a>
                      <a href="#" onclick="denyItem(<?php echo $value['id']; ?>);">
                        <i class="fa fa-times text-danger"></i>
                      </a>
                    </td>
                  </tr>
                <?php }
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
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
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });

    function acceptItem(id) {
      if (confirm('ยันยันการตรวจรับงานใช่หรือไม่') == true) {
        window.location = `accepttask.php?id=${id}`;
        // window.location='delete.php?id='+id;
      }
    };

    function denyItem(id) {
      var retVal = prompt("เหตุผลที่ไม่ยอมรับงานนี้คือ");
      if (retVal != null) {
        window.location = `denytask.php?id=${id}&remark=${retVal}`;
      }
      // if (confirm('Are you sure, you want to Deny this task?') == true) {
      //   window.location = `denytask.php?id=${id}`;
      // }
    }
  </script>

  <script>
    $(document).ready(function() {
      $('[data-toggle="popover"]').popover();
    });
  </script>


</body>

</html>