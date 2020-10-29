<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
$link = $_SERVER['REQUEST_URI'];
$link_array = explode('/', $link);
$name = $link_array[count($link_array) - 2];
?>

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
          <a href="../leaderdashboard" class="nav-link <?php echo $name == 'leaderdashboard' ? 'active' : '' ?>">
            <i class="fa fa-search nav-icon"></i>
            <p>Tasks</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../admin" class="nav-link <?php echo $name == 'admin' ? 'active' : '' ?>">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>Admin Management</p>
            </a>
          </li> -->

        <li class="nav-item">
          <a href="../leaderApproval" class="nav-link <?php echo $name == 'leaderApproval' ? 'active' : '' ?>">
            <i class="fa fa-tasks nav-icon"></i>
            <p>My Approval</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../leaderHistory" class="nav-link <?php echo $name == 'leaderHistory' ? 'active' : '' ?>">
            <i class="fa fa-history nav-icon"></i>
            <p>My Activities</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../leaderReport" class="nav-link <?php echo $name == 'leaderReport' ? 'active' : '' ?>">
            <i class="fa fa-pie-chart nav-icon"></i>
            <p>Report</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../contacts" class="nav-link <?php echo $name == 'contacts' ? 'active' : '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>Contacts</p>
            </a> -->
        <!-- </li> -->
        <li class="nav-header">Connfiguration</li>
        <li class="nav-item">
          <a href="../leaderUserManage" class="nav-link <?php echo $name == 'leaderUserManage' ? 'active' : '' ?>">
            <i class="fa fa-user nav-icon"></i>
            <p>User Management</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../companymanage" class="nav-link <?php echo $name == 'companymanage' ? 'active' : '' ?>">
            <i class="fa fa-building-o nav-icon"></i>
            <p>Company Management</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../channelmanage" class="nav-link <?php echo $name == 'channelmanage' ? 'active' : '' ?>">
            <i class="fa fa-comments-o nav-icon"></i>
            <p>Channel Management</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../statusmanage" class="nav-link <?php echo $name == 'statusmanage' ? 'active' : '' ?>">
            <i class="fa fa-quote-left nav-icon"></i>
            <p>Status Management</p>
          </a>
        </li>
        <li class="nav-header">Account Settings</li>
        <li class="nav-item">
          <a href="../../logout.php" class="nav-link">
            <i class="fa fa-sign-out"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>