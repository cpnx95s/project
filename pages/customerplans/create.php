<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';

if (isset($_POST['save'])) {
	$taskname = $_POST['taskname'];
	//$detail = $_POST['detail'];
	$channel = $_POST['channel'];
	$status = $_POST['status'];
	$user_id = $_SESSION["user_id"];
	$launch_date = $_POST['launchdate'];
	$launch_time = $_POST['launchtime'];
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$time = date("h:i:s");
	echo $date;
	echo $time;
	$sql = "INSERT INTO task (name, launch_date, launch_time, create_by, channel_id, status_master_id)
	 VALUES ('$taskname', '$launch_date', '$launch_time' ,'$user_id', '$channel', '$status')";

	if (mysqli_query($conn, $sql)) {
		$taskid = mysqli_insert_id($conn);
		$sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		VALUES ('$date', '$time','$user_id', '$status', '$taskid')";
		if (mysqli_query($conn, $sql1)) {
			$user_id = $_SESSION["user_id"];
		
			echo '<script> alert("สร้างสำเร็จ")</script>';
		}
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=index.php');
}
$conn->close();

?>