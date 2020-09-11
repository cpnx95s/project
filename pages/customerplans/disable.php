<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if ($_GET['id']) {
  // $selectdata = "SELECT * FROM task WHERE id= '" . $_GET['id'] . "'";
  // $result = $conn->query($selectdata);
  // if ($result->num_rows > 0) {
  //   // output data of each row
  //   while ($row = $result->fetch_assoc()) {
  //     $task_id = $row['id'];
  //     $status_id = $row['status_master_id'];
  //     $action_by = $row['create_by'];
  //     $sql1 = "INSERT INTO task_history(action_by, task_id, status_master_id)
  //           VALUES ('$action_by', '$task_id', '$status_id')";
  //     if ($conn->query($sql1)) {
        
  //     }
  //   }
  // } else {
  //   echo "0 results";
  // }
  $sql = "UPDATE task SET status_master_id =  '11' WHERE id='" . $_GET['id'] . "'";
  
  if ($conn->query($sql) === TRUE) {
    echo '<script> alert("Finished Deleting!")</script>';
    $conn->close();
  } else {
    echo "Error Deleting record: " . $conn->error;
  }
  header('Refresh:0; url=index.php');
}
?>