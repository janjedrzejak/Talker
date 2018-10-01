<?php
	
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$user_id = $_SESSION['id'];

	try {
		//połączenie z bazą
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		//echo "podłączony do serwera";
		//-----------------------------
		$sql_query = $conn->prepare("SELECT * FROM `rooms`;"); 
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$room_id = $result['room_id']; 
				$room_name = $result['room_name'];
				$room_avatar = $result['room_avatar'];

				echo '
				<a href="#" class="room">
				<img src="' . $room_avatar . '" class="avatar">' 
				. $room_name . 
				'</a>';
			}

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
?>