<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
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
  <title>Tasks View</title>
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
    <?php include_once('../includes/sidebar_leader.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tasks View</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="../customertasks">Tasks View</a></li>
                <li class="breadcrumb-item active">Tasks</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <!-- <a href="../customertasks" class="btn btn-primary btn-block mb-3">Back to Tasks List</a> -->

              <!-- /. box -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Status</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item mb-2">
                      <?php
                      $id = $_GET['id'];
                      $sql = "select th.actiondate, th.actiontime, u.name as username, s.status_name as statusname FROM task_history th 
                              INNER JOIN user u ON th.action_by = u.id
                              INNER JOIN status_master s ON th.status_master_id = s.id  
                              WHERE th.task_id = $id";
                      $result = $conn->query($sql);
                      // if (!empty($result) && $result->num_rows > 0) {

                      if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                          // echo "id: " . $row["id"] . " - Name: " . $row["channel_name"] . " " . $row["lastname"] . "<br>";
                        }
                      } else {
                        echo "0 results";
                      }
                      // for ($id = 1; $id <= 5; $id++) { 
                      foreach ($result as $key => $value) {
                      ?>
                        <i class="fa fa-info-circle text-second"></i> <b class="text-secondary"><?php echo $value['statusname']; ?></b>
                        By <?php echo $value['username']; ?><br />At <?php echo $value['actiondate']; ?> <?php echo $value['actiontime']; ?>
                    </li>

                  <?php } ?>
                  <!-- <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-second"></i> <b class="text-secondary">Plan</b> By Taeyeon <br />At Today 07.55 น.
                    </li>
                    <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-primary"></i> <b class="text-primary">Open</b> By Taeyeon <br />At Today 08.55 น.
                    </li>
                    <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-info"></i> <b class="text-info">In Process</b> By Tiffany <br />At Today 09.00 น.
                    </li>
                    <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-warning"></i> <b class="text-warning">In Approve</b> By Tiffany <br />At Today 09.20 น.
                    </li>
                    <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-warning"></i> <b class="text-warning">In Commit</b> By Yoon A <br />At Today 09.30 น.
                    </li>
                    <li class="nav-item mb-2">
                      <i class="fa fa-info-circle text-success"></i> <b class="text-success">Done</b> By Taeyeon <br />At Today 10.30 น.
                    </li> -->
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">

              <div class="card card-success card-outline">
                <div class="card-body p-3">
                  <div class="mailbox-read-info">

                  <?php
                      $id = $_GET['id'];
                      $sql2 = "select task.id, task.created, task.name, task.detail, user.name as username
                      from task
                      inner join user on task.create_by = user.id
                      where task.id = $id
                      ";
                      $result2 = $conn->query($sql2);
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

                 

                    <h5><?php echo $value2['name']; ?></h5>
                    <h6 class="text-secondary">Created by <?php echo  $value2['username']; ?> At <?php echo  $value2['created']; ?></h6>
                  </div>
              
                  <div class="mailbox-read-message">
                    <p><?php echo  $value2['detail']; ?></p>
                  </div>
                  <?php } ?>
                </div>
                <div class="card-footer bg-white">
                  <ul class="mailbox-attachments clearfix">
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

                      <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                        <span class="mailbox-attachment-size">
                          1.9 MB
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="card-footer">
                  <div class="float-left">
                    <a href="form-edit.php?id=<?php echo $_GET['id']; ?>" class="btn btn-sm btn-warning text-white">
                      <i class="fa fa-pencil-square-o"></i> edit
                    </a>
                    <a href="#" onclick="deleteItem(<?php echo $_GET['id']; ?>);" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash-o"></i> Delete
                    </a>
                  </div> 
                </div>
              </div>
              <form action="create_comment.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="card card-success ">
                  <div class="card-header">
                    <h3 class="card-title">
                      Comment
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        Subject:
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

                    <!-- <div class="float-left">
                    <a href="form-edit.php?id=<?php echo $_GET['id']; ?>" class="btn btn-sm btn-warning text-white">
                      <i class="fa fa-pencil-square-o"></i> edit
                    </a>
                    <a href="#" onclick="deleteItem(<?php echo $_GET['id']; ?>);" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash-o"></i> Delete
                    </a>
                  </div> -->
                    <div class="float-right">
                      <input type="submit" class="btn btn-success" name="save" value="Comment"></input>

                      <!-- <a href="#" class="btn btn-sm btn-success">
                      <i class="fas fa fa-reply"></i> Comment
                    </a> -->
                    </div>
                  </div>
                </div>
              </form>
              <!-- start comment -->
              <?php
              $id = $_GET['id'];
              $sql = "select c.id, c.title, c.content, c.created, c.task_id, c.user_id, u.name as username
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
                  <?php if($value["user_id"] == $_SESSION["user_id"]) {?>

                    <div class="float-left">
                      <a href="form-comment-edit.php?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-warning text-white">
                        <i class="fa fa-pencil-square-o"></i> edit
                      </a>
                      <a href="#" onclick="deleteItem(<?php echo $value['id']; ?>);" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o"></i> Delete
                      </a>
                    </div>
                  <?php } ?>
                    <!-- <div class="float-left">
                    <button type="button" class="btn btn-warning text-white"><i class="fa fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o-alt"></i> Delete</button>
                  </div> -->
                    <!-- <div class="float-right">
                    <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Reply</button>
                  </div> -->
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
      if (confirm('Are you sure, you want to delete this item?') == true) {
        window.location = `delete-comment.php?id=${id}`;
        // window.location='delete.php?id='+id;
      }
    };
  </script>

</body>

</html>