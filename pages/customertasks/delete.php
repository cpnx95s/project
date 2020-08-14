<?php include_once('../authen.php') ?>
<?php
$mysqli = new mysqli("localhost","root","","myproject");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if($_GET['id']){
    $sql = "DELETE FROM task WHERE id='".$_GET['id']."'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $mysqli->error;
      }
      
    //header("Location: product.php");
}
    echo '<script> alert("Finished Deleting!")</script>'; 
    header('Refresh:0; url=index.php');
    $mysqli->close();

?>