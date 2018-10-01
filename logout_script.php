<?php
	session_start();
		$db_server_name = "localhost";
		$db_username = "root";
		$db_password = "root";
		$db_name = "chat";

		$user_id = $_SESSION['id'];

		try {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		echo "podłączony do serwera";
		//-----------------------------
		$sql_query = $conn->prepare("DELETE FROM `user_logs` WHERE `user_logs`.`log_user_id` = $user_id;"); //wyswietl ostatni indeks
		$sql_query->execute();

		header("Location:index.php");

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}

	session_destroy();
	header('Location:index.php');
?>