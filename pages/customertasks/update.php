<?php include_once('../authen.php') ?>
<?php
$mysqli = new mysqli("localhost", "root", "", "myproject");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if (isset($_GET['id'])) {
    if (isset($_POST['update'])) {
        $first_name = $_POST['subject'];
        $last_name = $_POST['sub_title'];
        $sql = "UPDATE task set name = '$first_name' , detail = ' $last_name' WHERE id='" . $_GET['id'] . "'";
        if ($mysqli->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }

        //header("Location: product.php");
    }
}
$mysqli->close();

echo '<script> alert("Finished Updating!")</script>';
header('Refresh:0; url=index.php');
?>