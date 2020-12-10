<?php

use function PHPSTORM_META\type;

include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;

require '/xampp/htdocs/project/pages/vendor/autoload.php';

if (isset($_POST['save'])) {
	$taskname = $_POST['taskname'];
	$detail = $_POST['detail'];
	$channel = $_POST['channel'];
	//$status = $_POST['status'];
	$user_id = $_SESSION["user_id"];
	$launch_date = $_POST['launchdate'];
	$launch_time = $_POST['launchtime'];
	$fileupload = (isset($_POST['fileupload']) ? $_POST['fileupload'] : '');
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$datepic = date("Ymd");
	$time = date("h:i:s");
	echo $date;
	echo $time;
	$numrand = (mt_rand());
	$path = "../fileupload/";
	$type = strrchr($_FILES['fileupload']['name'],".");
	$size = ($_FILES['fileupload']['size']);
	$newname = $datepic.$numrand.$type;
	$path_copy = $path . $newname;
	$path_link= "../fileupload/". $newname;

	move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);

	$sql = "INSERT INTO task (name, detail, launch_date, launch_time, create_by,action_by, channel_id, status_master_id, filepath)
	 VALUES ('$taskname','$detail', '$launch_date', '$launch_time' ,'$user_id','$user_id', '$channel', '2','$newname')";

	if (mysqli_query($conn, $sql)) {
		$taskid = mysqli_insert_id($conn);
		$sql1 = "INSERT INTO task_history(actiondate, actiontime, action_by, status_master_id, task_id)
		VALUES ('$date', '$time','$user_id', '2', '$taskid')";
		if (mysqli_query($conn, $sql1)) {
			$user_id = $_SESSION["user_id"];
			$sql_file= "INSERT INTO files(path, name, size)
			VALUES ('$path_copy', '$newname', '$size')";
			if (mysqli_query($conn, $sql_file)) {
				$fileid = mysqli_insert_id($conn);
				$sql_filetask = "INSERT INTO file_task(file_id, task_id)
				VALUES ('$fileid', '$taskid')";
				if (mysqli_query($conn, $sql_filetask)) {
			
				}
			}
			$sql2 = "SELECT * FROM user WHERE role_master_id = '2' or role_master_id = '3'";
			$result2 = $conn->query($sql2);
			foreach ($result2 as $key => $value2) {
				$mail = new PHPMailer(true);
				$mail->CharSet = "utf-8";
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 587;
				$mail->SMTPSecure = 'tls';
				$mail->SMTPAuth = true;

				$gmail_username = "cpnx95s@gmail.com"; // gmail ที่ใช้ส่ง
				$gmail_password = "BRPosg81"; // รหัสผ่าน gmail
				// ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1

				$sender = "IBS Support"; // ชื่อผู้ส่ง
				$email_sender = "noreply@ibsone.com"; // เมล์ผู้ส่ง 
				$email_receiver = $value2['email']; // เมล์ผู้รับ ***

				$subject = "สร้างงาน"; // หัวข้อเมล์

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
						ชื่อผู้สร้างงาน: " . $value2['name'] . "
						</h1>
						<div style='padding:20px;'>
							<div>				
								<h2>รายการงาน : " . $taskname . "<strong style='color:#0000ff;'></strong></h2>
								<a href='http://localhost/project/pages/customertasks/view.php?id=". $taskid ."' target='_blank'>
									<h1><strong style='color:#3c83f9;'> >> คลิ๊กที่นี่ เพื่อไปยังรายการงาน<< </strong> </h1>
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
						echo "ระบบได้ส่งอีเมลแจ้งเตือนเรียบร้อยแล้ว";
					}
				}
			}
			echo '<script> alert("สร้างรายการงานสำเร็จ")</script>';
		}
	} else {
		echo "Error Creating record: " . $conn->error;
	}

	header('Refresh:0; url=index.php');
}
$conn->close();

?>