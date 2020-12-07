<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['save'])) {
	$statusname = $_POST['statusname'];
	$description = $_POST['description'];
	$sql = "INSERT INTO status_master (status_name, status_description)
	 VALUES ('$statusname','$description')";

	if (mysqli_query($conn, $sql)) {
		echo '<script> alert("สร้างสำเร็จ")</script>';
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=../statusmanage');
}
$conn->close();

?>