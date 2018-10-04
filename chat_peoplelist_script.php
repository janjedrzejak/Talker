<?php
session_start();
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$user_id = $_SESSION['id'];
	$roomid = $_SESSION['roomid'];

	try {
		if($user_id!='') {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		//echo "podłączony do serwera";
		//=========================================================================================
		//jak jest w sesji to dobrze, ale czy jest w bazie, jak go nie ma w bazie a jest w sesji to dorzuć log do bazy
		//=========================================================================================
		$sql_query = "SELECT * FROM `user_logs` WHERE `log_user_id` = $user_id;";
		$statement = $conn->prepare($sql_query); 
		$statement->execute();
			
		$count_result = $statement->rowCount();
			if($count_result==0) { //jak w tabeli pusto to napisz ze nadal jest online
				$sql_query = $conn->prepare("SELECT `log_id` FROM `user_logs` ORDER BY `log_id` DESC LIMIT 1;"); 
				$sql_query->execute();

				while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
					$last_id = $result['log_id']; //pobierz ostatnie id
				}
				
				$last_id++;

				$sql_query = "INSERT INTO `user_logs` (`log_id`, `log_user_id`, `log_room_id`, `log_datetime`, `log_last_active`) VALUES ('" . $last_id . "', '" . $user_id . "', '0', '" . $datetime . "', '" . $datetime . "');"; //dodaj log usera do bazy

				$statement = $conn->prepare($sql_query); //dodaj do bazy
				$statement->execute(); //wykonaj dodawanie
			}

		//=========================================================================================
		$sql_query = $conn->prepare("SELECT * FROM `user_logs` WHERE `log_room_id` = $roomid;"); 
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$log_user_id = $result['log_user_id'];
			
		$sql_query_2 = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $log_user_id;"); 
		$sql_query_2->execute();

			while($result_2 = $sql_query_2->fetch(PDO::FETCH_ASSOC)) {
				$user_id_from_db = $result_2['user_id'];
				$user_name = $result_2['user_name'];
				$user_avatar = $result_2['user_avatar'];

				if($user_id != $user_id_from_db) {
					echo '
						<a href="chat.php?privuserid=' . $user_id_from_db . '" class="room">
							<img src="' . $user_avatar . '" class="avatar">
							' . $user_name . 
						'</a>';
				} else {
					echo '
					<a href="#" class="room-active">
						<img src="' . $user_avatar . '" class="avatar">
						' . $user_name . 
					'</a>';
				}
			}
			}
		}
	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}

?>