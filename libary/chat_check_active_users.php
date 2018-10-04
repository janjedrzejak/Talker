<?php
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$datetime = strtotime($datetime); //przerzucacj tekst na czas
	try {
		$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
//--------->sprawdzaj stan innych użytkowników [WCZYTUJ GO AJAXEM]----------------------------
		$sql_query = "SELECT * FROM `user_logs`";
		$statement = $conn->prepare($sql_query); 
		$statement->execute();
			while($result = $statement->fetch(PDO::FETCH_ASSOC)) { //czytaj rekord po rekordzie
				$log_last_active = $result['log_last_active'];
				$log_user_id = $result['log_user_id'];
					$log_last_active = strtotime($log_last_active); //przerzucaj tekst na czas
						if($log_last_active < ($datetime - 5)) {
						//echo "nieaktywny od 5 sekund";
						//jak nieaktywny no to go nie ma online wyrzuć go z bazy
							$sql_query = $conn->prepare("DELETE FROM `user_logs` WHERE `user_logs`.`log_user_id` = $log_user_id;"); //wywal z bazy usera ktory jest nieaktywny
							$sql_query->execute();
						}
			}

//------------------------------------------------------------------------------------------
		} catch(PDOException $e) {
			echo "problem z połączeniem";
		}
	
?>