<?php
	session_start();
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$name = htmlspecialchars($_POST['name']);
	$password = md5(htmlspecialchars($_POST['password']));
	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss

	try {
		//połączenie z bazą
		error_reporting(0);
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
		echo "podłączony do serwera";	
		//-----------------------------
		$sql_query = $conn->prepare("SELECT * FROM `users` WHERE `user_name` = '" . $name . "' AND `user_password` = '" . $password . "';"); //wyswietl usera o tych danych
		$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) { //pobierz dane usera z bazy
				$user_id = $result['user_id']; 
				$user_name = $result['user_name'];
				$user_type_id = $result['user_type_id'];
				$user_activate = $result['user_activate'];
				$user_email = $result['user_email'];
				$user_data_create = $result['user_data_create'];
			}
			if($user_id=='') { header('Location:index.php'); } else { //jak nie ma usera to wracaj na strone logowania
				$_SESSION["zalogowany"]=1;
				$_SESSION["id"]=$user_id;
				$_SESSION["user_name"]=$user_name;
				$_SESSION["user_type_id"]=$user_type_id;
				//echo $_SESSION["zalogowany"];
				$sql_query = $conn->prepare("SELECT `log_id` FROM `user_logs` ORDER BY `log_id` DESC LIMIT 1;"); 
				$sql_query->execute();

				while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
					$last_id = $result['log_id']; //pobierz ostatnie id
				}
				
				$last_id++;

				$sql_query = "INSERT INTO `user_logs` (`log_id`, `log_user_id`, `log_room_id`, `log_datetime`, `log_last_active`) VALUES ('" . $last_id . "', '" . $user_id . "', '0', '" . $datetime . "', '" . $datetime . "');"; //dodaj log usera do bazy



				$statement = $conn->prepare($sql_query); //dodaj do bazy
				$statement->execute(); //wykonaj dodawanie

				header('Location:chat.php?roomid=1');
			} 
			// echo $user_id . ' ' . $user_type_id . ' ' . $user_activate . ' ' . $user_email . ' ' . $user_data_create; //test

	} catch(PDOException $e) {
		echo "problem z połączeniem";
	}
?>