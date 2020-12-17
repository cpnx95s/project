<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        // $taskid = $_GET['id'];
        // $user_id = $_SESSION["user_id"];
        $sql = "UPDATE comments SET title = '$title', content = '$content', updated = now()  WHERE id='" . $_GET['id'] . "'";
        if ($conn->query($sql) === TRUE) {
            // $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            // VALUES ('$launchdate', '$launchtime', '$user_id', '$taskid', '$status')";
            // if ($conn->query($sql1)) {
            //     echo '<script> alert("แก้ไขสำเร็จ")</script>';
            // }
            echo '<script> alert("แก้ไขสำเร็จ")</script>';
        } else {
            echo "Error Updating record: " . $conn->error;
        }

        header('Refresh:0; url=index.php');
    }
}
$conn->close();

?>