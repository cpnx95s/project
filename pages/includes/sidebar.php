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
  $sql = "SELECT * FROM user WHERE id = $userid";
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
          <?php echo $value2['name'];?>
        </a>
      </li>
    </ul>
  <?php } ?>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light text-center d-block">Customer Management</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">User Customer</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../dashboard" class="nav-link <?php echo $name == 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../admin" class="nav-link <?php echo $name == 'admin' ? 'active' : '' ?>">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>Admin Management</p>
            </a>
          </li> -->
        <li class="nav-item">
          <a href="../customerplans" class="nav-link <?php echo $name == 'customerplans' ? 'active' : '' ?>">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>My Plans</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../customertasks" class="nav-link <?php echo $name == 'customertasks' ? 'active' : '' ?>">
            <i class="fas fa-tasks nav-icon"></i>
            <p>My Tasks</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../tasksacceptance" class="nav-link <?php echo $name == 'tasksacceptance' ? 'active' : '' ?>">
            <i class="fas fa-check-square nav-icon"></i>
            <p>Tasks Acceptance</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../customerhistory" class="nav-link <?php echo $name == 'customerhistory' ? 'active' : '' ?>">
            <i class="fas fa-history nav-icon"></i>
            <p>My History Activity</p>
          </a>
        </li>
        <!-- <li class="nav-item">
            <a href="../contacts" class="nav-link <?php echo $name == 'contacts' ? 'active' : '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>Contacts</p>
            </a> -->
        <!-- </li> -->
        <li class="nav-header">Account Settings</li>
        <li class="nav-item">
          <a href="../../logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>