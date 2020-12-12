<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
use function PHPSTORM_META\type;
use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';
if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        $launchdate = $_POST['launchdate'];
        $launchtime = $_POST['launchtime'];
        $taskname = $_POST['taskname'];
        $detail = $_POST['detail'];
        $channel = $_POST['channel'];
        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d");
        $time = date("h:i:s");
        $datepic = date("Ymd");
        $taskid = $_GET['id'];
        $user_id = $_SESSION["user_id"];

        
        date_default_timezone_set("Asia/Bangkok");
        $numrand = (mt_rand());
        $path = "../fileupload/";
        $type = strrchr($_FILES['fileupload']['name'], ".");
        $size = ($_FILES['fileupload']['size']);
        $newname = $datepic . $numrand . $type;
        $path_copy = $path . $newname;
        $path_link = "../fileupload/" . $newname;
    
        move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
        $sql = "UPDATE task SET launch_date = '$launchdate', launch_time = '$launchtime', name = '$taskname', detail = ' $detail', channel_id = '$channel' WHERE id='" . $_GET['id'] . "'";
    
        
        if ($conn->query($sql) === TRUE) {

            $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		VALUES ('$date', '$time','$user_id', '2', '$taskid')";
            if ($conn->query($sql1)) {
                $user_id = $_SESSION["user_id"];
                if ($size > 0 && $size != 0) {
                    $sql_datafile = "SELECT * FROM file_task WHERE task_id = $taskid";
                    $result = $conn->query($sql_datafile);
                    if ($result->num_rows > 0) {

                    }else {

                    }

                    foreach ($result as $key => $value) {
                        echo $value['file_id'];
                        $file_id = $value['file_id'];
                        $sql_files = "SELECT * FROM files WHERE id = $file_id";
                        $result2 = $conn->query($sql_files);
                        if ($result2->num_rows > 0) {
    
                        }else {
    
                        }

                        foreach ($result2 as $key => $value2) {
                            echo $value2['name'];
                            $sql_update_file = "UPDATE files SET path = '$path_copy', name = '$newname', size = '$size' WHERE id = $file_id";
                            if ($conn->query($sql_update_file) === TRUE) {
                                echo '<script> alert("แก้ไขสำเร็จ")</script>';
                            }else {
                                echo "Error Updating record: " . $conn->error;
                            }
                        }

                    }
                    // $sql_file = "INSERT INTO files(path, name, size)
                    // VALUES ('$path_copy', '$newname', '$size')";
                    // if (mysqli_query($conn, $sql_file)) {
                    //     $fileid = mysqli_insert_id($conn);
                    //     $sql_filetask = "INSERT INTO file_task(file_id, task_id)
                    //     VALUES ('$fileid', '$taskid')";
                    //     if (mysqli_query($conn, $sql_filetask)) {
                    //         echo '<script> alert("แก้ไขสำเร็จ")</script>';
                    //     }
                    // }
                } else {

                }

                // echo '<script> alert("แก้ไขสำเร็จ")</script>';
            }
        } else {
            echo "Error Updating record: " . $conn->error;
        }

        header('Refresh:0; url=index.php');
    }
}
$conn->close();

?>