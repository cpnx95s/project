<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

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
        $sql = "UPDATE task SET launch_date = '$launchdate', launch_time = '$launchtime', name = '$taskname', detail = ' $detail', channel_id = '$channel' WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$launchdate', '$launchtime', '$user_id', '$taskid', '$status')";
            if ($conn->query($sql1)) {
                echo '<script> alert("Finished Updating!")</script>';
            }
            // echo '<script> alert("Finished Updating!")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }

        header('Refresh:0; url=index.php');
    }
}
$conn->close();

?>