<?php include_once('../authen.php') ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>จัดการรายการงาน</title>
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


      <!-- Main content -->
      <section class="content mt-2">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">สร้างรายการแผนงาน</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="create.php" method="post">
            <div class="card-body">

              <div class="form-group">
                <label for="ชื่องาน">ชื่องาน</label>
                <input type="text" class="form-control" id="taskname" name="taskname" placeholder="ชื่องาน">
              </div>

              <div class="form-group">
                <label>ช่องทางสังคมออนไลน์</label>
                <select class="form-control select2" data-placeholder="Select ช่องทางสังคมออนไลน์" style="width: 100%;" name="channel">
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

              <div class="form-group">
                <label for="ชื่องาน">วันเผยแพร่</label>
                <input type="date" class="form-control" id="launchdate" name="launchdate" placeholder="ชื่องาน">
              </div>

              <div class="form-group">
                <label for="ชื่องาน">เวลาเผยแพร่</label>
                <input type="time" class="form-control" id="launchtime" name="launchtime" placeholder="ชื่องาน">
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" name="save">บันทึก</button>
            </div>
          </form>
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