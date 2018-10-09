<?php
session_start();
	$db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";

    $user_id = $_SESSION['id'];
    $user_type_id = $_SESSION['user_type_id'];
    $room_to_del = htmlspecialchars($_GET['r']);

    	if($user_type_id==0 && is_numeric($room_to_del) && $room_to_del >= 0 && $room_to_del <=10) {
			try {
				$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
				$sql_query = $conn->prepare("DELETE FROM `rooms` WHERE `rooms`.`room_id` = $room_to_del");
      			$sql_query->execute();
      			header('Location:../dashboard.php?o=4&e=0');

			} catch(PDOException $e) {
				echo 'błąd połączenia';
				header('../dashboard.php?o=4&e=1');
			}
	}
?>