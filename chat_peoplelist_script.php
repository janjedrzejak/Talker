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
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		//echo "podłączony do serwera";
		//-----------------------------
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
						<a href="#" class="room">
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

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}

?>