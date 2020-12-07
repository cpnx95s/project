<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if(isset($_POST['save']))
{	 
	 $name = $_POST['name'];
	 $surname = $_POST['surname'];
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $email = $_POST['email'];
	 $channel = $_POST['channel'];
	 $company = $_POST['company'];
	 $role = $_POST['role'];
	 $date = date('Y-m-d H:i:s');
	//  $user_id = $_SESSION["user_id"];
	//  $launch_date = $_POST['launchdate'];
	//  $launch_time = $_POST['launchtime'];
	date_default_timezone_set("Asia/Bangkok");
	// $date = date("Y-m-d");
	// $time = date("h:i:s");
	 $sql = "INSERT INTO user (name, surname, username, password, email, channel_id,company_id, role_master_id, created)
	 VALUES ('$name','$surname', '$username', '$password' ,'$email', '$channel','$company', '$role', '$date')";

	 if (mysqli_query($conn, $sql)) {
		// $taskid = mysqli_insert_id($conn);
		// $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		// VALUES ('$date', '$time','$user_id', '$status', '$taskid')";
		// if (mysqli_query($conn, $sql1)) {
		// 	echo '<script> alert("สร้างสำเร็จ")</script>';
		// }
		echo '<script> alert("สร้างสำเร็จ")</script>';
	} else {
		echo "Error Creating record: " . $conn->error;
	}
	header('Refresh:0; url=../leaderUserManage');


	// header('Refresh:0; url=index.php');
}
$conn->close();

?>