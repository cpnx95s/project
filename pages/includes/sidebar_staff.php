<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
$link = $_SERVER['REQUEST_URI'];
$link_array = explode('/', $link);
$name = $link_array[count($link_array) - 2];
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tasks Management</title>
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
  <link rel="stylesheet" href="../../dist/css/adminlte.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>

<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-success">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <?php
  $userid = $_SESSION['user_id'];
  $sql = "SELECT * FROM user u 
  INNER JOIN role_master rm ON rm.id = u.role_master_id 
  WHERE u.id = $userid
  ";
  $result2 = $conn->query($sql);
  // if (!empty($result) && $result->num_rows > 0) {

  if ($result2->num_rows > 0) {
    // output data of each row
    while ($row = $result2->fetch_assoc()) {
      // echo "id: " . $row["id"] . " - Name: " . $row["channel_name"] . " " . $row["lastname"] . "<br>";
    }
  } else {
    echo "0 results";
  }
  // for ($id = 1; $id <= 5; $id++) { 
  foreach ($result2 as $key => $value2) {
  ?>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-user" aria-hidden="true"></i> <?php echo strtoupper($value2['surname']); ?> <?php echo strtoupper($value2['name']); ?>
        </a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-danger navbar-badge count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right scrollable-bootstrap-menu">
        </div>
      </li> -->
    </ul>
  <?php } ?>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="../../dist/img/avatar.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight text-center d-block"><?php echo ucwords($value2['role_name']); ?> Panel</span>
  </a>
  <!-- <a href="#" class="brand-link">
    <span class="brand-text font-weight-light text-center d-block"><?php echo ucwords($value2['role_name']); ?> Panel</span>
  </a> -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $value2['surname'] . ' ' . $value2['name']; ?></a>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../staffdashboard" class="nav-link <?php echo $name == 'staffdashboard' ? 'active' : '' ?>">
            <i class="fa fa-search nav-icon"></i>
            <p>หยิบงาน</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../admin" class="nav-link <?php echo $name == 'admin' ? 'active' : '' ?>">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>Admin Management</p>
            </a>
          </li> -->

        <li class="nav-item">
          <a href="../stafftasks" class="nav-link <?php echo $name == 'stafftasks' ? 'active' : '' ?>">
            <i class="fa fa-tasks nav-icon"></i>
            <p>งานของฉัน</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../staffhistory" class="nav-link <?php echo $name == 'staffhistory' ? 'active' : '' ?>">
            <i class="fa fa-history nav-icon"></i>
            <p>ดูประวัติงาน</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="../staffreport" class="nav-link <?php echo $name == 'staffreport' ? 'active' : '' ?>">
            <i class="fa fa-pie-chart nav-icon"></i>
            <p>Report</p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
            <a href="../contacts" class="nav-link <?php echo $name == 'contacts' ? 'active' : '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>Contacts</p>
            </a> -->
        <!-- </li> -->
        <li class="nav-header">ตั้งค่าบัญชี</li>
        <li class="nav-item">
          <a href="../../logout.php" class="nav-link">
            <i class="fa fa-sign-out"></i>
            <p>ลงชื่อออก</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- <script>
  $(document).ready(function() {

    function load_unseen_notification(view = '') {
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          view: view
        },
        dataType: "json",
        success: function(data) {
          $('.dropdown-menu').html(data.notification);
          if (data.unseen_notification > 0) {
            $('.count').html(data.unseen_notification);
          }
        }
      });
    }

    load_unseen_notification();

    $('#comment_form').on('submit', function(event) {
      event.preventDefault();
      if ($('#subject').val() != '' && $('#comment').val() != '') {
        var form_data = $(this).serialize();
        $.ajax({
          url: "insert.php",
          method: "POST",
          data: form_data,
          success: function(data) {
            $('#comment_form')[0].reset();
            load_unseen_notification();
          }
        });
      } else {
        alert("Both Fields are Required");
      }
    });

    $(document).on('click', '.dropdown-toggle', function() {
      $('.count').html('');
      load_unseen_notification('yes');
    });

    setInterval(function() {
      load_unseen_notification();;
    }, 5000);

  });
</script> -->