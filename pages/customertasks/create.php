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
	 $first_name = $_POST['subject'];
	 $last_name = $_POST['sub_title'];
	//  $city_name = $_POST['city_name'];
	//  $email = $_POST['email'];
	 $sql = "INSERT INTO task (name, detail, create_by, channel_id, status_master_id)
	 VALUES ('$first_name','$last_name', '1', '1', '1')";
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