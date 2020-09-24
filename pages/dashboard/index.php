<?php include_once('../authen.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>10</h3>
                <p>New Articles</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>All Contacts</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">

          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title d-inline-block">Tasks List</h3>
            <!-- <a href="form-create.php" class="btn btn-primary float-right ">Add Tasks +</a href=""> -->
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
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $user_id = $_SESSION["user_id"];
                $sql = "select t.id, t.name, t.launch_date, t.launch_time, t.created, t.channel_id, t.create_by,  t.status_master_id,  c.name as channel_name,
                s.status_name  , u.name as username
                FROM task t  
                INNER JOIN channel c ON t.channel_id = c.id 
                INNER JOIN status_master s ON t.status_master_id = s.id
                INNER JOIN user u ON t.create_by = u.id
                ";
            
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
                    <td><a href="view.php?id=<?php echo $value['id']; ?>" ><?php echo $value['name']; ?></a></td>
                    <td><?php echo $value['channel_name']; ?></td>
                    <td><?php echo $value['launch_date']; ?></td>
                    <td><?php echo $value['launch_time']; ?></td>
                    <td><?php echo $value['created']; ?></td>
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['status_name']; ?></td>
                    
                   
                    <td>
                      <a href="view.php?id=<?php echo $value['id']; ?>" >
                        <i class="fas fa-eye"></i>
                      </a>
                    
                    
                      <a href="form-edit.php?id=<?php echo $value['id']; ?>" >
                        <i class="fas fa-edit"></i>
                      </a>
                   
               
                      <a href="#" onclick="disableItem(<?php echo $value['id']; ?>);" >
                        <i class="fas fa-trash-alt"></i>
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

</body>
</html>
