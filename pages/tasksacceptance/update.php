<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';
if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        $launchdate = $_POST['launchdate'];
        $launchtime = $_POST['launchtime'];
        $taskname = $_POST['taskname'];
        $detail = $_POST['detail'];
        $channel = $_POST['channel'];
        $status = $_POST['status'];
        $taskid = $_GET['id'];
        $user_id = $_SESSION["user_id"];
        $sql = "UPDATE task SET launch_date = '$launchdate', launch_time = '$launchtime', name = '$taskname', detail = ' $detail', status_master_id = '$status' WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$launchdate', '$launchtime', '$user_id', '$taskid','$status')";
            if ($conn->query($sql1)) {
                $user_id = $_SESSION["user_id"];
                echo '<script> alert("แก้ไขสำเร็จ")</script>';
            }
            // echo '<script> alert("แก้ไขสำเร็จ")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }

        header('Refresh:0; url=index.php');
    }
}
$conn->close();

?>