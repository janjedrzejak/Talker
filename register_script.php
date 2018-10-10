<?php
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";

	$name = htmlspecialchars($_POST['name']);
	$password = md5(htmlspecialchars($_POST['password']));
	$email = htmlspecialchars($_POST['email']);
	$datetime = date("Y-m-d H:i:s");//format rrrr-mm-dd hh:mm:ss
	$template = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
		if(preg_match($template, $email) && strlen(htmlspecialchars($_POST['password'])) > 6 && substr_count($name, ' ') == 0) {
				try {
				//połączenie z bazą
					$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
					echo "podłączony do serwera";
					//-----------------------------
					$sql_query = $conn->prepare("SELECT `user_id` FROM `users` ORDER BY `user_id` DESC LIMIT 1;"); //wyswietl ostatni indeks
					$sql_query->execute();

					while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
							$last_id = $result['user_id']; //pobierz ostatnie id
					} $last_id++;
					$sql_query = "INSERT INTO `users` (`user_id`, `user_type_id`, `user_activate`, `user_name`, `user_email`, `user_data_create`, `user_password`, `user_avatar`) VALUES ('" . $last_id . "', '1', '0', '" . $name . "', '" . $email . "', '" . $datetime . "', '" . $password . "', 'img/avatats/default.png');"; //dodaj nowego usera

						$statement = $conn->prepare($sql_query); //dodaj do bazy
						$statement->execute(); //wykonaj dodawanie
						$r = md5("ok");
						//=================================================================================
						$to = "$email";
						$subject = "$name! Zarejestrowałeś się w serwisie talker!";
						$message = "
									<html>
									<head>
									
									<title>Rejestracja w serwisie talker</title>
									<style>
											@import url('https://fonts.googleapis.com/css?family=Nunito');
									</style>
									</head>
									<body style=\"color: #4e4e4e; font-size: 14px; font-family: 'Nunito', sans-serif;\">
										<div style=\"
											width: 400px; 
											height: auto; 
											border-radius: 50px;
											border-color: #48d4dd;
											border-style: solid;
											padding: 20px;
											color: #000;
										\">
										<p>Zarejestrowałeś właśnie konto w serwisie talker</p>
										<p>Logując się na swoje konto możesz korzystać od teraz ze wszystkich funkcji użytkownika. W obrębie kanałów możesz wymieniać wiadomości ze wszystkimi uczestnikami konwersacji, a także pisać wiadomości prywatne.</p>
										<p>Dziękujemy jeszcze raz za rejestrację i zapraszamy do korzystania z aplikacji talker.</p>
										</div>
									</body>
									</html>
									";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: <talker.communication@gmail.com>' . "\r\n";
						$headers .= 'Cc: talker.communication@gmail.com' . "\r\n";
						
						mail($to,$subject,$message,$headers);
						//=================================================================================
						header("Location:index.php?e=0");
				} catch(PDOException $e) {
					echo "problem z połączeniem";
				}
		} else {
			header("Location:index.php");
		}

	
?>