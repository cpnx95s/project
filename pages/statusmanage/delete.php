<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if ($_GET['id']) {
  $id = $_GET['id'];
  $sql = "DELETE FROM status_master WHERE id= $id";

  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  header('Refresh:0; url=../statusmanage');
  // header('Refresh:0; url=index.php');
}

?>