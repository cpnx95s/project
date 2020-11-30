<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/MyPJ/pages/vendor/autoload.php';
if ($_GET['id']) {
  $userid = $_SESSION['user_id'];
  $sql = "UPDATE task SET status_master_id = '3', action_by = $userid WHERE id='" . $_GET['id'] . "'";

  if ($conn->query($sql) === TRUE) {
    
    $selectdata = "SELECT * FROM task 
    WHERE id= '" . $_GET['id'] . "'";
    $result = $conn->query($selectdata);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $userid = $_SESSION['user_id'];
        $task_id = $row['id'];
        $status_id = $row['status_master_id'];
        $action_by = $row['create_by'];
        date_default_timezone_set("Asia/Bangkok");
        $date = date("Y-m-d");
        $time = date("h:i:s");
        echo $date;
        echo $time;
        echo $userid;
        $sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, task_id, status_master_id)
            VALUES ('$date', '$time', '$userid','$task_id', '3')";
    
        if ($conn->query($sql1)) {
          $user_id = $_SESSION["user_id"];
          $sql2 = "SELECT * FROM user WHERE id = $user_id";
          $result2 = $conn->query($sql2);
          foreach ($result2 as $key => $value2) {
              $mail = new PHPMailer(true);
              $mail->CharSet = "utf-8";
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->Port = 587;
              $mail->SMTPSecure = 'tls';
              $mail->SMTPAuth = true;

              $gmail_username = "thetong1911.2@gmail.com"; // gmail ที่ใช้ส่ง
              $gmail_password = "0816068459"; // รหัสผ่าน gmail
              // ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1

              $sender = "IBS Support"; // ชื่อผู้ส่ง
              $email_sender = "noreply@ibsone.com"; // เมล์ผู้ส่ง 
              $email_receiver = $value2['email']; // เมล์ผู้รับ ***

              $subject = "แก้ไขสถานะงาน"; // หัวข้อเมล์

              $mail->Username = $gmail_username;
              $mail->Password = $gmail_password;
              $mail->setFrom($email_sender, $sender);
              $mail->addAddress($email_receiver);
              $mail->Subject = $subject;

              $email_content = "
              <!DOCTYPE html>
              <html>
                  <head>
                      <meta charset=utf-8'/>
                      <title>ทดสอบการส่ง Email</title>
                  </head>
                  <body>
                      <h1>
                      ชื่อผู้แก้ไขงาน: " . $value2['name'] . "
                      </h1>
                      <div style='padding:20px;'>
                          <div>				
                              <h2>ชื่่องานที่แก้ไข : " . $taskname . "<strong style='color:#0000ff;'></strong></h2>
                              <a href='http://localhost/MyPJ/' target='_blank'>
                                  <h1><strong style='color:#3c83f9;'> >> กรุณาคลิ๊กที่นี่ เพื่อตั้งรหัสผ่านใหม่<< </strong> </h1>
                              </a>
                          </div>
                          <div style='margin-top:30px;'>
                              <hr>
                              <address>
                                  <h4>ติดต่อสอบถาม</h4>
                              </address>
                          </div>
                      </div>
                  </body>
              </html>
          ";

              //  ถ้ามี email ผู้รับ
              if ($email_receiver) {
                  $mail->msgHTML($email_content);
                  if (!$mail->send()) {  // สั่งให้ส่ง email

                      // กรณีส่ง email ไม่สำเร็จ
                      echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
                      echo $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
                  } else {
                      // กรณีส่ง email สำเร็จ
                      echo "ระบบได้ส่งข้อความไปเรียบร้อย";
                  }
              }
          }
          echo '<script> alert("Finished Pickup!")</script>';
        }
      }
    } else {
      echo "0 results";
    }

    $conn->close();
  } else {
    echo "Error Acceptance record: " . $conn->error;
  }
  header('Refresh:0; url=index.php');
}
?> 