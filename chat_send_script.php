<?php
session_start();

	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$chat_message = htmlspecialchars($_POST['chat_message']);
	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$user_id = $_SESSION['id'];

	try {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		echo "podłączony do serwera";
		//-----------------------------
		$sql_query = $conn->prepare("SELECT `message_id` FROM `messages` ORDER BY `message_id` DESC LIMIT 1;"); //wyswietl ostatni indeks
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$last_id = $result['message_id']; //pobierz ostatnie id
			}
			$last_id++;
			
		$sql_query = "INSERT INTO `messages` (`message_id`, `message_from_user_id`, `message_date_time`, `message_content`, `message_room_id`) VALUES ('$last_id', '$user_id', '$datetime', '$chat_message', '1');";

		$statement = $conn->prepare($sql_query); //dodaj do bazy
		$statement->execute(); //wykonaj dodawanie
		header("Location:chat.php");

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
?>