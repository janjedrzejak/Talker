<?php
session_start();

	$db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";

if(isset($_SESSION["id"])) { $user_id = $_SESSION["id"];} else {
	header('Location:../logout_script.php');
}
	$password = md5(htmlspecialchars($_POST['password']));
	$repeat_password = md5(htmlspecialchars($_POST['repeat_password']));
try {
	if($password == $repeat_password) {
			$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
      		$sql_query = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $user_id AND `user_password` LIKE '$password'"); 
      		$sql_query->execute();
      			if($sql_query->rowCount() == 1) {
      				$sql_query = $conn->prepare("DELETE FROM `users` WHERE `users`.`user_id` = $user_id");
      				$sql_query->execute();
      				header('Location:../logout_script.php');
      			}
      		 }
} catch(PDOException $e) {
	header('Location:../index.php');
}
?>