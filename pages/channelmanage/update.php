<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        // $launchdate = $_POST['launchdate'];
        // $launchtime = $_POST['launchtime'];
        $ชื่อช่องทางสังคมออนไลน์ = $_POST['ชื่อช่องทางสังคมออนไลน์'];
        $description = $_POST['description'];
        date_default_timezone_set("Asia/Bangkok");
        // $date = date("Y-m-d");
        // $time = date("h:i:s");
        // $userid = $_GET['id'];
        // $user_id = $_SESSION["user_id"];
        $sql = "UPDATE channel SET name = '$ชื่อช่องทางสังคมออนไลน์', description = '$description' WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("แก้ไขสำเร็จ")</script>';
            // echo '<script> alert("แก้ไขสำเร็จ")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }
    
        header('Refresh:0; url=../channelmanage');
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
$conn->close();

?>