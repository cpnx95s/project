<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';
if ($_GET['id']) {
  $userid = $_SESSION['user_id'];
  $sql = "UPDATE task SET status_master_id = '3', action_by = $userid WHERE id='" . $_GET['id'] . "'";

  if ($conn->query($sql) === TRUE) {
    
    $selectdata = "SELECT * FROM task 
    WHERE id= '" . $_GET['id'] . "'";
    $result = $conn->query($selectdata);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $userid = $_SESSION['user_id'];
        $task_id = $row['id'];
        $status_id = $row['status_master_id'];
        $action_by = $row['create_by'];
        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d");
        $time = date("h:i:s");
        echo $date;
        echo $time;
        echo $userid;
        $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$date', '$time', '$userid','$task_id', '3')";
    
        if ($conn->query($sql1)) {
          $user_id = $_SESSION["user_id"];
          echo '<script> alert("หยิบงานสำเร็จ")</script>';
        }
      }
    } else {
      echo "0 results";
    }

    $conn->close();
  } else {
    echo "Error Acceptance record: " . $conn->error;
  }
  header('Refresh:0; url=index.php');
}
?> 