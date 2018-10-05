<?php
session_start();

	$db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";

if(isset($_SESSION["id"])) { $user_id = $_SESSION["id"];} else {
	header('Location:../logout_script.php');
}
	$new_email = htmlspecialchars($_POST['email']);
	$old_email = htmlspecialchars($_POST['old_email']);
	$template = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
try {
	if(preg_match($template, $new_email) && preg_match($template, $old_email)) {
			$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
      		$sql_query = $conn->prepare("UPDATE `users` SET `user_email` = '" . $new_email . "' WHERE `users`.`user_id` = " . $user_id . " AND `users`.`user_email` = '" . $old_email . "'"); 
      		$sql_query->execute();
      		if($sql_query->rowCount()>0) {
      			header('Location:../dashboard.php?o=1&e=0');
      		} else { header('Location:../dashboard.php?o=1&e=5'); }
		} else {
			header('Location:../dashboard.php?o=1&e=5');
		}
} catch(PDOException $e) {
	header('Location:../index.php');
}
?>