<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if ($_GET['id']) {
  $remark = $_GET['remark'];
  $user_id = $_SESSION["user_id"];

  $sql = "UPDATE task SET status_master_id = '3', action_by = $user_id, remark = '".  $_GET['remark'] ."' WHERE id='" . $_GET['id'] . "'";

  if ($conn->query($sql) === TRUE) {
    $selectdata = "SELECT * FROM task WHERE id= '" . $_GET['id'] . "'";
    $result = $conn->query($selectdata);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $task_id = $row['id'];
        $status_id = $row['status_master_id'];
        $action_by = $row['create_by'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $user_id = $_SESSION["user_id"];
        $sql1 = "INSERT INTO task_history(actiondate, actiontime, remark, action_by, task_id, status_master_id)
            VALUES ('$date', '$time', '$remark', '$user_id', '$task_id', '$status_id')";
        if ($conn->query($sql1)) {
          echo '<script> alert("Finished Denial!")</script>';
        }
      }
    } else {
      echo "0 results";
    }

    $conn->close();
  } else {
    echo "Error record: " . $conn->error;
  }
  header('Refresh:0; url=index.php');
}
?>