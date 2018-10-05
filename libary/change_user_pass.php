<?php
session_start();

	$db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";

if(isset($_SESSION["id"])) { $user_id = $_SESSION["id"];} else {
	header('Location:../logout_script.php');
}
	$old_password = md5(htmlspecialchars($_POST['old_password']));
	$new_original_password = htmlspecialchars($_POST['password']);
	$new_password = md5($new_original_password);
	$repeat_password = md5(htmlspecialchars($_POST['repeat_password']));

try {
	if($new_password == $repeat_password && strlen($new_original_password)>5) {
			$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
      		$sql_query = $conn->prepare("UPDATE `users` SET `user_password` = '" . $new_password . "' WHERE `users`.`user_password` = '" . $old_password . "'"); 
      		$sql_query->execute();
      		if($sql_query->rowCount()>0) {
      			header('Location:../dashboard.php?o=2&e=0');
      		} else { header('Location:../dashboard.php?o=1&e=5');
      		 }
		} else {
			header('Location:../dashboard.php?o=2&e=5');
		}
} catch(PDOException $e) {
	header('Location:../index.php');
}
?>