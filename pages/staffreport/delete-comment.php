<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if ($_GET['id']) {

  $sql = "DELETE FROM comments WHERE id='" . $_GET['id'] . "'";
  if ($conn->query($sql) === TRUE) {
    echo '<script> alert("Finished Deleting!")</script>';
    $conn->close();
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  header('Refresh:0; url=index.php');
}
?>