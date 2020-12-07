<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';
if ($_GET['id']) {
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $sql = "UPDATE task SET launch_date = '$date', launch_time = '$time', status_master_id = '7' WHERE id='" . $_GET['id'] . "'";
  if ($conn->query($sql) === TRUE) {
    $selectdata = "SELECT * FROM task WHERE id= '" . $_GET['id'] . "'";
    $result = $conn->query($selectdata);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $task_id = $row['id'];
        $status_id = $row['status_master_id'];
        $action_by = $row['create_by'];

        $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$date', '$time', '$action_by', '$task_id', '$status_id')";
        if ($conn->query($sql1)) {
          $user_id = $_SESSION["user_id"];
          echo '<script> alert("ลบสำเร็จ")</script>';
          $conn->close();
        } else {
          echo "Error deleting record: " . $conn->error;
        }
      }
    } else {
      echo "0 results";
    }
  } 
  header('Refresh:0; url=index.php');
}
?>