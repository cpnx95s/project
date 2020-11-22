<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tasks</title>
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <div class="wrapper">

    <!-- Navbar -->
    <?php include_once('../includes/sidebar.php') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Tasks</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tasks</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->


      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <!-- <form action="search.php" method="post"> -->
            <form method="post">
              <div class="row">
                <h3>Search By</h3>
              </div>

              <section class="content">
                <div class="row">
                  <div class="col-md-4 col-12">
                    <div class="info-box">

                      <div class="info-box-content">
                        <span class="info-box-text">Name</span>
                        <input class="form-control" type="input" name="task-name" />
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>


                  <div class="col-md-4 col-12">
                    <div class="info-box">


                      <div class="info-box-content">
                        <span class="info-box-text">User</span>
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
                            $sql = "Select * FROM user";
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

                  <!-- /.col -->
                  <div class="col-md-4 col-12">
                    <div class="info-box">

                      <div class="info-box-content">
                        <span class="info-box-text">Channel</span>
                        <select class="form-control select2" name="task-channel">
                          <option value="" selected></option>
                          <?php
                          $mysqli = new mysqli("localhost", "root", "", "myproject");

                          // Check connection
                          if ($mysqli->connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                            exit();
                          }
                          $sql = "Select * FROM channel";
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
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4 col-12">
                    <div class="info-box">


                      <div class="info-box-content">
                        <span class="info-box-text">Launch Date</span>
                        <input class="form-control" type="date" name="startDate" id="startDate" />
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4 col-12">
                    <div class="info-box">


                      <div class="info-box-content">
                        <span class="info-box-text">Launch Time</span>
                        <input class="form-control" type="time" name="startTime" id="startTime" />
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <!-- /.col -->
                  <div class="col-md-4 col-12">
                    <div class="info-box">


                      <div class="info-box-content">
                        <span class="info-box-text">Status</span>
                        <select class="form-control select" data-placeholder="Select Status_master" style="width: 100%;" name="status">
                          <option value="" selected></option>
                          <?php
                          $mysqli = new mysqli("localhost", "root", "", "myproject");

                          // Check connection
                          if ($mysqli->connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                            exit();
                          }
                          $sql = "Select * FROM status_master";
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
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['status_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                </div>
              </section>

              <div class="row float-right">
                <div class="col">
                  <button type="submit" class="btn btn-info" name="search">Search</button>
                </div>
              </div>
            </form>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <table id="dataTable" class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Task Name</th>
                  <th>Channel</th>
                  <th>Launch Date</th>
                  <th>Launch Time</th>
                  <th>Created At</th>
                  <th>Created By</th>
                  <!-- <th>Updated By</th> -->
                  <th>Status</th>
                 
                </tr>
              </thead>
              <tbody>
                <?php
                //  if($issearch == true){
                if (isset($_POST['search'])) {
                  $taskname = $_POST['task-name'];
                  $taskuser = $_POST['task-user'];
                  $taskchannel = $_POST['task-channel'];
                  $startDate = $_POST['startDate'];
                  $startTime = $_POST['startTime'];
                  $status = $_POST['status'];
                  $sql = "SELECT t.id, t.name, t.launch_date, t.launch_time, t.created, t.channel_id, t.create_by,  t.status_master_id,  c.name as channel_name,
                    s.status_name  , u.name as username
                    FROM task t  
                    INNER JOIN channel c ON t.channel_id = c.id 
                    INNER JOIN status_master s ON t.status_master_id = s.id
                    INNER JOIN user u ON t.create_by = u.id
                    where t.name like '%$taskname%' and t.create_by like '%$taskuser%' and t.channel_id like '%$taskchannel%'
                    and t.launch_date like '%$startDate%' and t.launch_time like '%$startTime%' and t.status_master_id like '%$status%'";
                  $result = $conn->query($sql);
                  $GLOBALS['result1'] = $result;
                  // }

                } else {
                  $user_id = $_SESSION["user_id"];
                  $sql = "select t.id, t.name, t.launch_date, t.launch_time, t.created, t.channel_id, t.create_by, t.status_master_id, c.name as channel_name, s.status_name, u.name as username
                  FROM task t  
                  INNER JOIN channel c ON t.channel_id = c.id 
                  INNER JOIN status_master s ON t.status_master_id = s.id
                  INNER JOIN user u ON t.create_by = u.id
                 
                  ";

                  $result = $conn->query($sql);

                  // if (!empty($result) && $result->num_rows > 0) {

                  if ($result->num_rows > 0) {
                    $GLOBALS['result1'] = $result;
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                      // echo "id: " . $row["id"] . " - Name: " . $row["channel_name"] . " " . $row["lastname"] . "<br>";
                    }
                  } else {
                    //echo "0 results";
                  }
                  // for ($id = 1; $id <= 5; $id++) { 
                }

                foreach ($GLOBALS['result1'] as $key => $value) {
                ?>
                  <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><a href="view.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                    <td><?php echo $value['channel_name']; ?></td>
                    <td><?php echo $value['launch_date']; ?></td>
                    <td><?php echo $value['launch_time']; ?></td>
                    <td><?php echo $value['created']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <!-- <td><?php echo $value['usernamelast']; ?></td> -->
                    <td><?php echo $value['status_name']; ?></td>


                   
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
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });

    function disableItem(id) {
      if (confirm('Are you sure, you want to delete this item?') == true) {
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

  <script>
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: today,
      maxDate: function() {
        return $('#endDate').val();
      }
    });
    $('#endDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: function() {
        return $('#startDate').val();
      }
    });
  </script>


</body>

</html>