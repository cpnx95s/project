<?php include_once('pages/includes/connect.php') ?>

<?php
session_start();
if (isset($_POST['submit'])) {

  $strSQL = "SELECT * FROM user WHERE username = '" . mysqli_real_escape_string($conn, $_POST['txtUsername']) . "' 
	and password = '" . mysqli_real_escape_string($conn, $_POST['txtPassword']) . "'";
  $objQuery = mysqli_query($conn, $strSQL);
  $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
  if (!$objResult) {
    echo "Username and Password Incorrect!";
  } else {
    $_SESSION["authen_id"] = $objResult["role_master_id"];
    $_SESSION["user_id"] = $objResult["id"];

    session_write_close();

    // if ($objResult["Status"] == "ADMIN") {
    //   header("location:admin_page.php");
    // } else {
    //   header("location:user_page.php");
    // }
  }
  mysqli_close($conn);
  // $_SESSION['authen_id'] = 1;
  if ($objResult["role_master_id"] == 1) {
    header('Location: pages/dashboard');
  } else if ($objResult["role_master_id"] == 2) {
    header('Location: pages/staffdashboard');
  } else if ($objResult["role_master_id"] == 3) {
    header('Location: pages/leaderdashboard');
  }
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="text-center">
      <p><b>ระบบติดตามสำหรับการจัดการ<br/>สื่อโฆษณาบนสังคมออนไลน์</b></p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">ลงชื่อเข้าใช้สู่ระบบ</p>

        <form action="" method="post">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" aria-label="Username" aria-describedby="basic-addon1" name="txtUsername">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"> <i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon1" name="txtPassword">
          </div>

          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">ลงชื่อเข้าใช้</button>
            </div>
            <!-- /.col -->
          </div>

        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>