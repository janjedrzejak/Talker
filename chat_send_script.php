<?php
session_start();

	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$chat_message = htmlspecialchars($_POST['chat_message']);
	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$user_id = $_SESSION['id'];

	if(isset($_SESSION['roomid'])) { $roomid = $_SESSION['roomid']; } 
	else { $roomid = 0; }
	if(isset($_SESSION['privuserid'])) { $privuserid = $_SESSION['privuserid']; }

	try {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		echo "podłączony do serwera";
		//=============================================================================================
		//sprawdz czy jest prywatna jak jest to musisz dodać prefix do treści wiadomości
		if(isset($_SESSION['privuserid'])) {
			$sql_query = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $privuserid;"); 
			$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$user_name = $result['user_name'];
			}
			$chat_message = '@' . $user_name . ' ' . $chat_message;
		} //jak nie jest prywatna to traktuj jako zwykła wiadomość
		//=============================================================================================
		$sql_query = $conn->prepare("SELECT `message_id` FROM `messages` ORDER BY `message_id` DESC LIMIT 1;"); //wyswietl ostatni indeks
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$last_id = $result['message_id']; //pobierz ostatnie id
			}
			$last_id++;
			
		$sql_query = "INSERT INTO `messages` (`message_id`, `message_from_user_id`, `message_date_time`, `message_content`, `message_room_id`) VALUES ('$last_id', '$user_id', '$datetime', '$chat_message', '$roomid');";

		$statement = $conn->prepare($sql_query); //dodaj do bazy
		$statement->execute(); //wykonaj dodawanie

		if(isset($_SESSION['privuserid'])) {
			header("Location:chat.php?privuserid=$privuserid");
		} else {
			header("Location:chat.php?roomid=$roomid");
		}

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
?>