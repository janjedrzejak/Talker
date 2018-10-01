<?php

	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$user_id = $_SESSION["id"]; //dowiedz sie ktory user jest zalogowany na to konto
	if(isset($_GET['roomid'])) {
		$roomid = htmlspecialchars($_GET['roomid']);
		$_SESSION['roomid'] = $roomid;
	} else {
		$roomid = 0;
		$_SESSION['roomid'] = 0;
	}
	if($user_id!='') {
	//echo $_SESSION["id"];
	try {
		//połączenie z bazą
		error_reporting(0);
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		//echo "podłączony do serwera";	
		//-----------------------------
		$sql_query = $conn->prepare("SELECT * FROM `messages` WHERE `message_room_id` = $roomid"); //wyswietl usera o tych danych
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) { //pobierz dane usera z bazy
				$message_id = $result['message_id']; 
				$message_from_user_id = $result['message_from_user_id'];
				$message_date_time = $result['message_date_time'];
				$message_content = $result['message_content'];
				$message_room_id = $result['message_room_id'];
				//warunki wyświewtlania po stronie lewej i prawej
				
					
					$sql_query_avatar = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $message_from_user_id"); //pobierz avatar
					$sql_query_avatar->execute();
					while($result_user_avatar = $sql_query_avatar->fetch(PDO::FETCH_ASSOC)) {
						$user_avatar = $result_user_avatar['user_avatar'];
					}

					if($user_id == $message_from_user_id) {
						echo '
								<div class="answer_a">
									<img src="' . $user_avatar . '" class="avatar answer_a_avatar">
									<div class="answer_a_text">
         							'. $message_id .  $message_from_user_id . $message_content .'
                        			</div>
								</div>
							';
							
					} else {
						echo '
								<div class="answer_b">
									<div class="answer_b_text">
         							'. $message_id . $message_from_user_id . $message_content .'
                        			</div>
                        			<img src="' . $user_avatar . '" class="avatar answer_b_avatar">
								</div>
							';	
					}

				
			}

			// echo $user_id . ' ' . $user_type_id . ' ' . $user_activate . ' ' . $user_email . ' ' . $user_data_create; //test

	} catch(PDOException $e) {
		echo "problem z połączeniem";

	}
	} else {
		header('Location:index.php');
	}
	
?>