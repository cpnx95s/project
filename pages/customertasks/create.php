<?php

use function PHPSTORM_META\type;

include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['save'])) {
	$taskname = $_POST['taskname'];
	$detail = $_POST['detail'];
	$channel = $_POST['channel'];
	$status = $_POST['status'];
	$user_id = $_SESSION["user_id"];
	$launch_date = $_POST['launchdate'];
	$launch_time = $_POST['launchtime'];
	$fileupload = (isset($_POST['fileupload']) ? $_POST['fileupload'] : '');
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$datepic = date("Ymd");
	$time = date("h:i:s");
	echo $date;
	echo $time;
	$numrand = (mt_rand());
	$path = "../fileupload/";
	$type = strrchr($_FILES['fileupload']['name'],".");

	$newname = $datepic.$numrand.$type;
	$path_copy = $path . $newname;
	$path_link= "../fileupload/". $newname;

	move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);

	$sql = "INSERT INTO task (name, detail, launch_date, launch_time, create_by, channel_id, status_master_id, filepath)
	 VALUES ('$taskname','$detail', '$launch_date', '$launch_time' ,'$user_id', '$channel', '$status','$newname')";

	if (mysqli_query($conn, $sql)) {
		$taskid = mysqli_insert_id($conn);
		$sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		VALUES ('$date', '$time','$user_id', '$status', '$taskid')";
		if (mysqli_query($conn, $sql1)) {
			echo '<script> alert("Finished Creating!")</script>';
		}
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=index.php');
}
$conn->close();

?>