<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
if (isset($_GET['id'])) {
    if (isset($_POST['save'])) {
        $content = $_POST['detail'];
        $title = $_POST['title'];
        $taskid = $_GET['id'];
        $user_id = $_SESSION["user_id"];

        $sql = "INSERT INTO comments (title, content, created, task_id, user_id)
         VALUES ('$title', '$content', now() ,'$taskid', '$user_id')";

        if (mysqli_query($conn, $sql)) {

            echo '<script> alert("แสดงความคิดเห็นสำเร็จ")</script>';
        } else {
            echo "Error Creating record: " . $conn->error;
        }

        header('Refresh:0; url=http://localhost/project/pages/stafftasks/view.php?id='.$taskid);
    }
}


$conn->close();

?>