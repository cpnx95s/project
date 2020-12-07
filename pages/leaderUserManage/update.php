<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        // $launchdate = $_POST['launchdate'];
        // $launchtime = $_POST['launchtime'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $companyid = $_POST['cpid'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        date_default_timezone_set("Asia/Bangkok");
        // $date = date("Y-m-d");
        // $time = date("h:i:s");
        // $userid = $_GET['id'];
        // $user_id = $_SESSION["user_id"];
        $sql = "UPDATE user SET name = '$name', surname = '$surname', username = '$username', email = '$email', company_id = '$companyid', role_master_id = '$role' WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("แก้ไขสำเร็จ")</script>';
            // echo '<script> alert("แก้ไขสำเร็จ")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }
    
        header('Refresh:0; url=../leaderUserManage');
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
$conn->close();

?>