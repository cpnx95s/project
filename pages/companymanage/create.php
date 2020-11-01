<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if(isset($_POST['save']))
{	 
	 $companyname = $_POST['companyname'];
	 $description = $_POST['description'];
	//  $channel = $_POST['channel'];
	//  $status = $_POST['status'];
	//  $user_id = $_SESSION["user_id"];
	//  $launch_date = $_POST['launchdate'];
	//  $launch_time = $_POST['launchtime'];
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$time = date("h:i:s");
	 $sql = "INSERT INTO company (name, description)
	 VALUES ('$companyname','$description')";

	 if (mysqli_query($conn, $sql)) {
		// $taskid = mysqli_insert_id($conn);
		// $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		// VALUES ('$date', '$time','$user_id', '$status', '$taskid')";
		// if (mysqli_query($conn, $sql1)) {
		// 	echo '<script> alert("Finished Creating!")</script>';
		// }
		echo '<script> alert("Finished Creating!")</script>';

	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=../companymanage');
}
$conn->close();

?>