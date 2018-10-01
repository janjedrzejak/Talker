<?php
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$name = htmlspecialchars($_POST['name']);
	$password = md5(htmlspecialchars($_POST['password']));
	$email = htmlspecialchars($_POST['email']);
	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss

	try {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		echo "podłączony do serwera";
		//-----------------------------
		$sql_query = $conn->prepare("SELECT `user_id` FROM `users` ORDER BY `user_id` DESC LIMIT 1;"); //wyswietl ostatni indeks
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$last_id = $result['user_id']; //pobierz ostatnie id
			}
			$last_id++;
			
		$sql_query = "INSERT INTO `users` (`user_id`, `user_type_id`, `user_activate`, `user_name`, `user_email`, `user_data_create`, `user_password`) VALUES ('" . $last_id . "', '1', '0', '" . $name . "', '" . $email . "', '" . $datetime . "', '" . $password . "');"; //dodaj nowego usera

		$statement = $conn->prepare($sql_query); //dodaj do bazy
		$statement->execute(); //wykonaj dodawanie
		$r = md5("ok");
		header("Location:index.php");

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
?>