<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
if ($_GET['id']) {
    $sql = "SELECT * FROM files WHERE id = '" . $_GET['id'] . "'";
    $result2 = $conn->query($sql);

    if ($result2->num_rows > 0) {
        // output data of each row
    } else {
    }
    // for ($id = 1; $id <= 5; $id++) { 
    foreach ($result2 as $key => $value2) {
        $file_name = $value2['name'];
        $file_path = $value2['path'];
        echo $file_name;
        echo $file_path;

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Expires: 0');
            header('Cache-Control: public');
            header('Content-Transfer-Encoding: binary');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($file_path));
            // flush(); // Flush system output buffer
            readfile($file_path);
            die();
        } else {
            http_response_code(404);
            die();
        }
    }
}

?>