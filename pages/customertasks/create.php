<?php include_once('../authen.php') ?>
<?php
$mysqli = new mysqli("localhost","root","","myproject");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if(isset($_POST['save']))
{	 
	 $taskname = $_POST['taskname'];
	 $detail = $_POST['detail'];
	 $channel = $_POST['channel'];
	 $status = $_POST['status'];
	 $sql = "INSERT INTO task (name, detail, create_by, channel_id, status_master_id)
	 VALUES ('$taskname','$detail', '1', ' $channel', ' $status')";
	 if (mysqli_query($mysqli, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($mysqli);
	 }
	 mysqli_close($mysqli);
}
// $sql = "INSERT INTO task (name, detail)
// VALUES ('$name', '$detail')";

// if ($mysqli->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $mysqli->error;
// }

// $mysqli->close();


    echo '<script> alert("Finished Creating!")</script>'; 
    header('Refresh:0; url=index.php');
?>