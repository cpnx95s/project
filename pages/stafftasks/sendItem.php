<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if ($_GET['id']) {

  $sql = "UPDATE task SET status_master_id =  '4' WHERE id='" . $_GET['id'] . "'";

  if ($conn->query($sql) === TRUE) {
    $selectdata = "SELECT * FROM task 
    WHERE id= '" . $_GET['id'] . "'";
    $result = $conn->query($selectdata);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $task_id = $row['id'];
        $status_id = $row['status_master_id'];
        $action_by = $row['create_by'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        echo $date;
        echo $time;
        $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$date', '$time', '$action_by', '$task_id', '$status_id')";
        if ($conn->query($sql1)) {
          echo '<script> alert("Finished Send!")</script>';
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