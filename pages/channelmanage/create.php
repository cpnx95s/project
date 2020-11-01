<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['save'])) {
	$channelname = $_POST['channelname'];
	$description = $_POST['description'];

	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$time = date("h:i:s");
	$sql = "INSERT INTO channel (name, description)
	 VALUES ('$channelname','$description')";

	if (mysqli_query($conn, $sql)) {

		echo '<script> alert("Finished Creating!")</script>';
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=../channelmanage');
}
$conn->close();

?>