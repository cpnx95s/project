<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

if (isset($_POST['search'])) {
    $taskname = $_POST['task-name'];
    $taskuser = $_POST['task-user'];
    $taskchannel = $_POST['task-channel'];
    $startDate = $_POST['startDate'];
    $startTime = $_POST['startTime'];
    $status = $_POST['status'];
    echo $taskname;
    echo $taskuser;
    echo $status;
    $sql = "SELECT t.id, t.name, t.launch_date, t.launch_time, t.created, t.channel_id, t.create_by,  t.status_master_id,  c.name as channel_name,
    s.status_name  , u.name as username
    FROM task t  
    INNER JOIN channel c ON t.channel_id = c.id 
    INNER JOIN status_master s ON t.status_master_id = s.id
    INNER JOIN user u ON t.create_by = u.id
    where t.name like '%$taskname%' and t.create_by like '%$taskuser%' and t.channel_id like '%$taskchannel%'
    and t.launch_date like '%$startDate%' and t.launch_time like '%$startTime%' and t.status_master_id like '%$status%'";
    $result = $conn->query($sql);
    // if ($conn->query($sql) === TRUE) {
        foreach ($result as $key => $value) {
            echo $value['username'], "\n";
            echo $value['status_name'];
        }
        // echo '<script> alert("Finished Updating!")</script>';
    // } else {
    //     echo "Select Error: " . $conn->error;
    // }

    header('Refresh:0; url=dashboard.php?".$result."');
}
$conn->close();

?>