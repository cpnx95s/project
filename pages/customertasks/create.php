<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if(isset($_POST['save']))
{	 
	 $taskname = $_POST['taskname'];
	 $detail = $_POST['detail'];
	 $channel = $_POST['channel'];
	 $status = $_POST['status'];
	 $sql = "INSERT INTO task (name, detail, create_by, channel_id, status_master_id)
	 VALUES ('$taskname','$detail', '1', ' $channel', ' $status')";
	 
	 if (mysqli_query($conn, $sql)) {
		echo '<script> alert("Finished Creating!")</script>';
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=index.php');
}
$conn->close();

?>