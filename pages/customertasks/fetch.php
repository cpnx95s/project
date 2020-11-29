<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['view'])) {

  // $con = mysqli_connect("localhost", "root", "", "notif");

  if ($_POST["view"] != '') {
    $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
    mysqli_query($conn, $update_query);
  }
  $user_id = $_SESSION["user_id"];
  $query = "SELECT task.id as taskid, task.name as name , sm.status_name as status FROM task INNER JOIN status_master sm ON sm.id = task.status_master_id 
 WHERE task.create_by = $user_id ORDER BY task.id DESC ";
  $result = mysqli_query($conn, $query);
  $output = '';
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $output .= '
   <div class="dropdown-divider"></div>
   <a href="http://localhost/project/pages/customertasks/view.php?id=' . $row["taskid"] . '" class="dropdown-item">
    <strong>ชื่องาน: ' . $row["name"] . '</strong><br />
   <small><em>สถานะของงาน: ' . $row["status"] . '</em></small>
   </a>
   ';
    }
  } else {
    $output .= '
     <div class="dropdown-divider"></div>
   <a href="#" class="dropdown-item">
   ไม่มีการแจ้งเตือน
   </a>';
  }



  $status_query = "SELECT * FROM task WHERE task.create_by = $user_id ";
  $result_query = mysqli_query($conn, $status_query);
  $count = mysqli_num_rows($result_query);
  $data = array(
    'notification' => $output,
    'unseen_notification'  => $count
  );

  echo json_encode($data);
}

?>