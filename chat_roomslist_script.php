<?php
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$user_id = $_SESSION['id'];

	if(isset($_GET['roomid'])) {
		$roomid = htmlspecialchars($_GET['roomid']);
		$_SESSION['roomid'] = $roomid;
		unset ($_SESSION['privuserid']);
	} else {
		$roomid = 0;
		$_SESSION['roomid'] = 0;
	}

	if(isset($_GET['privuserid'])) {
			$privuserid = htmlspecialchars($_GET['privuserid']);
			$_SESSION['privuserid'] = $privuserid;
	}
	//echo $_SESSION['roomid'];
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

				if($room_id != $roomid){
				echo '
				<a href="chat.php?roomid=' . $room_id . '" class="room">
				<img src="' . $room_avatar . '" class="avatar">' 
				. $room_name . 
				'</a>';
				} else {
				echo '
				<a href="chat.php?roomid=' . $room_id . '" class="room-active">
				<img src="' . $room_avatar . '" class="avatar">' 
				. $room_name . 
				'</a>';
				}
			}

		$sql_query = $conn->prepare("UPDATE `user_logs` SET `log_room_id` = '$roomid' WHERE `user_logs`.`log_user_id` = $user_id;"); 
		$sql_query->execute();

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
?>