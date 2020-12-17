<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php include_once('../includes/convertstatus.php') ?>
<?php
$sql = "SELECT * FROM task WHERE id='" . $_GET['id'] . "'";
$result = $conn->query($sql) or die($conn->error);
// print_r($result);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  header('Location: index.php');
}
?>
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
      <section class="content mt-3">
        <div class="container-fluid">
          <div class="row">

            <!-- /.col -->
            <div class="col-md-12">

              <div class="card card-success card-outline">
                <div class="card-body p-3">
                  <div class="mailbox-read-info">
                    
                  <!--  -->
                     <!-- 
                      
                      inner join files on files.id = file_task.file_id -->
                    <?php
                    $id = $_GET['id'];
                    $sql2 = "select task.id, task.created, task.name, task.detail, 
                      user.id as user_id, user.name as username, status_master.status_name as statusname,
                      files.path as filepath, files.name as filename, files.id as fileid, files.size as sizefile
                      from task
                      inner join user on task.create_by = user.id
                      inner join status_master on task.status_master_id = status_master.id
                      left join file_task on task.id = file_task.task_id
                      left join files on files.id = file_task.file_id
                      where task.id = $id";
                    // $sql2 = "Select * FROM task WHERE id='" . $_GET['id'] . "'";
                    $result2 = $conn->query($sql2);


                    // if (!empty($result) && $result->num_rows > 0) {

                    if ($result2->num_rows > 0) {
                      // output data of each row
                      while ($row = $result2->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: "  . "<br>";
                      }
                    } else {
                      echo "result 0";
                    }
                    // for ($id = 1; $id <= 5; $id++) { 

                    foreach ($result2 as $key => $value2) {
                      $statusth1 = statusth($value2['statusname']);
                    ?>

                      <h5><?php echo $value2['name']; ?></h5>
                      <h6 class="text-secondary">สร้างโดย <?php echo  $value2['username']; ?> วันที่ <?php echo substr($value2['created'], 0, 10); ?> เวลา <?php echo substr($value2['created'], 11, 5); ?> น. | <?php echo  $statusth1; ?>

                  </div>

                  <div class="mailbox-read-message">
                    <p><?php echo  $value2['detail']; ?></p>
                  </div>
                </div>
                <div class="card-footer bg-white">
                  <ul class="mailbox-attachments clearfix">
                    <li>

                      <?php
                      foreach ($result as $key => $value) {
                      ?>
                        <span class=""><img src="../fileupload/<?php echo $value2['filepath']; ?>" width="400" height="400">
                        </span>

                        <div class="mailbox-attachment-info">
                          <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                            <?php echo  $value2['filename']; ?>
                          </a>
                          <span class="mailbox-attachment-size">
                            <?php
                            $size = convertTodigitalStorage($value2['sizefile']);
                            echo $size;
                            ?>
                            <!-- 1,245 KB -->
                            <a href="download_file.php?id=<?php echo $value2['fileid'] ?>" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                          </span>
                        </div>
                      <?php } ?>

                    </li>

                  </ul>
                </div>
                <div class="card-footer">
                  <?php if ($value2["user_id"] == $_SESSION["user_id"]) { ?>

                    <div class="float-left">
                      <a href="form-edit.php?id=<?php echo $value2['id']; ?>" class="btn btn-sm btn-warning text-white">
                        <i class="fa fa-pencil-square-o"></i> แก้ไข
                      </a>
                      <a href="#" onclick="deleteItem(<?php echo $value2['id']; ?>);" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o"></i> ลบ
                      </a>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
              </div>

              <!-- start comment -->

              <form action="create_comment.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="card card-success ">
                  <div class="card-header">
                    <h3 class="card-title">
                      แสดงความคิดเห็น
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        หัวข้อ:
                      </div>
                      <div class="col-md-11">
                        <input type="text" name="title" id="title" style="width: 100%">
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="mb-3">
                      <textarea id="detail" name="detail" style="width: 100%"></textarea>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="float-right">
                      <input type="submit" class="btn btn-success" name="save" value="แสดงความคิดเห็น"></input>
                    </div>
                  </div>
                </div>
              </form>

              <?php
              $id = $_GET['id'];
              $sql = "select c.title, c.content, c.created, c.updated, c.task_id, c.user_id , u.name as username
              FROM comments c 
              INNER JOIN user u ON c.user_id = u.id
              where c.task_id = $id";

              $result = $conn->query($sql);

              // if (!empty($result) && $result->num_rows > 0) {

              if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  // echo "id: " . $row["id"] . " - Name: " . $row["channel_name"] . " " . $row["lastname"] . "<br>";
                }
              } else {
                // echo "0 results";
              }
              // for ($id = 1; $id <= 5; $id++) { 
              foreach ($result as $key => $value) {
              ?>
                <div class="card card-success card-outline">
                  <!-- /.card-header -->
                  <div class="card-body p-3">
                    <div class="mailbox-read-info">
                      <!-- <h5>รบกวนรีวิว Splash Banner ให้หน่อยค่ะ</h5> -->
                      <h5><?php echo $value['title']; ?></h5>
                      <h6 class="text-secondary">Created by <?php echo $value['username']; ?> At <?php echo $value['created']; ?></h6>
                    </div>
                    <!-- /.mailbox-read-info -->

                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                      <?php echo $value['content']; ?>
                      <!-- <p>เรียนหัวหน้าค่ะ,</p>

                    <p>ฟานเซ็ต Splash Banner เรียบร้อยแล้ว <br> รบกวนหัวหน้ารีวิวค่ะ</p>

                    <p>ขอบคุณค่ะ,<br>ทิฟฟานี่</p> -->
                    </div>
                    <!-- /.mailbox-read-message -->
                  </div>
                  <!-- /.card-body -->

                  <!-- /.card-footer -->
                  <div class="card-footer">
                    <?php if ($value["user_id"] == $_SESSION["user_id"]) { ?>

                      <div class="float-left">
                        <a href="form-comment-edit.php?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-warning text-white">
                          <i class="fa fa-pencil-square-o"></i> แก้ไข
                        </a>
                        <a href="#" onclick="deleteItem(<?php echo $value['id']; ?>);" class="btn btn-sm btn-danger">
                          <i class="fa fa-trash-o"></i> ลบ
                        </a>
                      </div>
                    <?php } ?>
                  </div>
                  <!-- /.card-footer -->
                  <!-- /. box -->
                </div>
              <?php } ?>




              <!-- End Comment -->

              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
      </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $conn->close(); ?>
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

    function deleteItem(id) {
      if (confirm('ยันยันการลบใช่หรือไม่') == true) {
        window.location = `delete-comment.php?id=${id}`;
        // window.location='delete.php?id='+id;
      }
    };
  </script>

  <script>
    $(document).ready(function() {
      $('[data-toggle="popover"]').popover();
    });
  </script>

</body>

</html>