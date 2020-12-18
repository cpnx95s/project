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


      <!-- Main content -->
      <section class="content mt-2">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">แก้ไขรายการงาน</h3>
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
            $sql = "select task.launch_date,task.launch_time,task.id, task.created, task.name, task.detail, files.path as filepath, files.name as filename, files.id as fileid, user.name as username, status_name as statusname,
            user.id as user_id, files.size as sizefile, task.channel_id
            from task
            inner join user on task.create_by = user.id
            inner join status_master on task.status_master_id = status_master.id
            inner join file_task on task.id = file_task.task_id
            inner join files on files.id = file_task.file_id
            WHERE task.id='" . $_GET['id'] . "'";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $row["detail"] . "<br>";
              }
            } else {
              // echo "0 results";
            }
          }
          foreach ($result as $key => $value) { ?>
            <form role="form" action="update.php?id=<?php echo $value['id']; ?>" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="taskname">ชื่องาน</label>
                  <input type="text" class="form-control" id="taskname" name="taskname" value="<?php echo $value['name']; ?>">
                </div>

                <!--field ของ channel -->
                <div class="form-group">
                  <label>ช่องทางสังคมออนไลน์</label>
                  <select class="form-control select2" data-placeholder="ช่องทางสังคมออนไลน์" style="width: 100%;" name="channel">
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
                        if ($row["id"] == $value['channel_id']) {
                          $channel_name = $row["name"];
                          $channel_id = $row["id"];
                        }
                      }
                    } else {
                      echo "0 results";
                    }
                    $sql2 = "Select * FROM channel where NOT id = '" . $value['channel_id'] . "'";
                    $result2 = $mysqli->query($sql2);
                    if ($result2->num_rows > 0) {
                      // output data of each row
                      while ($row1 = $result2->fetch_assoc()) {
                      }
                    } else {
                      // echo "0 results";
                    }
                    ?>
                    <option value="<?php echo $channel_id ?>" selected><?php echo $channel_name ?></option>
                    <?php foreach ($result2 as $key => $value2) { ?>
                      <option value="<?php echo $value2["id"] ?>"><?php echo $value2["name"] ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="taskname">รายละเอียด</label>
                  <textarea id="detail" name="detail" style="width: 100%"><?php echo $value['detail']; ?></textarea>
                </div>

                <div class="form-group">
                  <label>อัปโหลดไฟล์</label>
                  <div class="custom-file">

                    <input type="file" class="custom-file-input" name="fileupload" id="customFile" multiple>
                    <label class="custom-file-label" for="customFile">เลือกไฟล์</label>

                  </div>
                  <img id="imgUpload" src="../fileupload/<?php echo $value['filepath'] ?>" class="figure-img img-fluid rounded" >

                  <!-- <figure class="figure text-center d-none mt-2">
                  </figure> -->
                </div>

                <div class="form-group">
                  <label for="launchdate">วันเผยแพร่</label>
                  <input type="date" class="form-control" id="launchdate" name="launchdate" value="<?php echo $value['launch_date']; ?>">
                </div>

                <div class="form-group">
                  <label for="launchtime">เวลาเผยแพร่</label>
                  <input type="time" class="form-control" id="launchtime" name="launchtime" value="<?php echo $value['launch_time']; ?>">
                </div>

                <!-- field ของ status
                <div class="form-group">
                  <label>สถานะงาน_master</label>
                  <select class="form-control select" style="width: 100%;" name="status">
                  <?php
                  $mysqli = new mysqli("localhost", "root", "", "myproject");
                  // Check connection
                  if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    exit();
                  }
                  $sql = "Select * FROM status_master";
                  $result3 = $mysqli->query($sql);
                  if ($result3->num_rows > 0) {
                    // output data of each row
                    while ($row = $result3->fetch_assoc()) {
                      // echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
                      if ($row["id"] == $value['status_master_id']) {
                        $status_name = $row["status_name"];
                        $status_id = $row["id"];
                      }
                    }
                  } else {
                    // echo "0 results";
                  }
                  $sql2 = "Select * FROM status_master where NOT id = '" . $value['status_master_id'] . "'";
                  $result4 = $mysqli->query($sql2);
                  if ($result4->num_rows > 0) {
                    // output data of each row
                    while ($row1 = $result4->fetch_assoc()) {
                    }
                  } else {
                    // echo "0 results";
                  }
                  ?>
                      <option value="<?php echo $status_id ?>" selected><?php echo $status_name ?></option>
                      <?php foreach ($result4 as $key => $value3) { ?>
                      <option value="<?php echo $value3["id"] ?>"><?php echo $value3["status_name"] ?></option>
                      <?php } ?>
                  </select>
                </div>  -->

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="update">บันทึก</button>
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