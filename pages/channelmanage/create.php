<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['save'])) {
	$ชื่อช่องทางสังคมออนไลน์ = $_POST['ชื่อช่องทางสังคมออนไลน์'];
	$description = $_POST['description'];

	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$time = date("h:i:s");
	$sql = "INSERT INTO channel (name, description)
	 VALUES ('$ชื่อช่องทางสังคมออนไลน์','$description')";

	if (mysqli_query($conn, $sql)) {

		echo '<script> alert("สร้างสำเร็จ")</script>';
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=../channelmanage');
}
$conn->close();

?>