<?php include_once('../authen.php') ?>
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="../customertasks">User Management</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php
          $mysqli = new mysqli("localhost", "root", "", "myproject");

          // Check connection
          if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
          }
          if ($_GET['id']) {
           
            $sql = " SELECT u.id, u.name, u.surname, u.username, u.email, u.created,  u.company_id, 
            u.role_master_id, cp.id as cpid, rm.id as roleid FROM user u
             INNER JOIN company cp ON cp.id = u.company_id
             INNER JOIN role_master rm ON rm.id = u.role_master_id WHERE u.id='" . $_GET['id'] . "'";

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
              }
            } else {
              // echo "0 results";
            }
          }
          foreach ($result as $key => $value) { ?>
            <form role="form" action="update.php?id=<?php echo $value['id']; ?>" method="post">
              <div class="card-body">

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $value['name']; ?>">
                </div>

                <div class="form-group">
                  <label for="surname">SurName</label>
                  <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $value['surname']; ?>">
                </div>

                <div class="form-group">
                  <label for="username">User Name</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $value['username']; ?>">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $value['email']; ?>">
                </div>
                <div class="form-group">
                  <label>Select Companys</label>
                  <select class="form-control select2" data-placeholder="Select Companys" style="width: 100%;" name="cpid">
                    <?php
                    $mysqli = new mysqli("localhost", "root", "", "myproject");
                    // Check connection
                    if ($mysqli->connect_errno) {
                      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                      exit();
                    }
                    $sql = "Select * FROM company";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        if ($row["id"] == $value['cpid']) {
                          $company_name = $row["name"];
                          $cp_id = $row["id"];
                        }
                      }
                    } else {
                      echo "0 results";
                    }
                    $sql2 = "Select * FROM company where NOT id = '" . $value['cpid'] . "'";
                    $result2 = $mysqli->query($sql2);
                    if ($result2->num_rows > 0) {
                      // output data of each row
                      while ($row1 = $result2->fetch_assoc()) {
                      }
                    } else {
                      echo "0 results";
                    }
                    ?>
                    <option value="<?php echo $cp_id ?>" selected><?php echo $company_name ?></option>
                    <?php foreach ($result2 as $key => $value2) { ?>
                      <option value="<?php echo $value2["id"] ?>"><?php echo $value2["name"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <!--field ของ channel -->
                <div class="form-group">
                  <label>Select Roles</label>
                  <select class="form-control select2" data-placeholder="Select Roles" style="width: 100%;" name="role">
                    <?php
                    $mysqli = new mysqli("localhost", "root", "", "myproject");
                    // Check connection
                    if ($mysqli->connect_errno) {
                      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                      exit();
                    }
                    $sql = "Select * FROM role_master";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                        if ($row["id"] == $value['roleid']) {
                          $role_description = $row["role_description"];
                          $role_id = $row["id"];
                        }
                      }
                    } else {
                      echo "0 results";
                    }
                    $sql2 = "Select * FROM role_master where NOT id = '" . $value['roleid'] . "'";
                    $result2 = $mysqli->query($sql2);
                    if ($result2->num_rows > 0) {
                      // output data of each row
                      while ($row1 = $result2->fetch_assoc()) {
                      }
                    } else {
                      echo "0 results";
                    }
                    ?>
                    <option value="<?php echo $role_id ?>" selected><?php echo $role_description ?></option>
                    <?php foreach ($result2 as $key => $value2) { ?>
                      <option value="<?php echo $value2["id"] ?>"><?php echo $value2["role_description"] ?></option>
                    <?php } ?>
                  </select>
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="update">Submit</button>
              </div>
            </form>
          <?php }
          $mysqli->close();
          ?>
        </div>
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
  <!-- CK Editor -->
  <script src="../../plugins/ckeditor/ckeditor.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/select2.full.min.js"></script>

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

      $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop()
        $(this).siblings('.custom-file-label').html(fileName)
        if (this.files[0]) {
          var reader = new FileReader()
          $('.figure').addClass('d-block')
          reader.onload = function(e) {
            $('#imgUpload').attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0])
        }
      })

      ClassicEditor
        .create(document.querySelector('#detail'))
        .then(function(editor) {
          // The editor instance
        })
        .catch(function(error) {
          console.error(error)
        })

      //Initialize Select2 Elements
      $('.select2').select2()

    });
  </script>

</body>

</html>