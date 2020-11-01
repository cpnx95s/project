<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        // $launchdate = $_POST['launchdate'];
        // $launchtime = $_POST['launchtime'];
        $companyname = $_POST['companyname'];
        $description = $_POST['description'];
        date_default_timezone_set("Asia/Bangkok");
        // $date = date("Y-m-d");
        // $time = date("h:i:s");
        // $userid = $_GET['id'];
        // $user_id = $_SESSION["user_id"];
        $sql = "UPDATE company SET name = '$companyname', description = '$description' WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("Finished Updating!")</script>';
            // echo '<script> alert("Finished Updating!")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }
    
        header('Refresh:0; url=../companymanage');
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
$conn->close();

?>