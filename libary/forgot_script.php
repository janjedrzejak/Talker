<?php
//sprawdz czy jest w bazie taki email potem na niego wyslij
	$db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";
	$email=htmlspecialchars($_POST['email']);

		try {
			$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
			$sql_query = conn->prepare("SELECT * FROM `users` WHERE `user_email` LIKE '" . $email . "'");
 			$sql_query->execute();
 				if($sql_query->rowCount()>0) { //znalazl w bazie taki rekord
 					$to = "talker.communication@gmail.com";
						$subject = "$email prosi o nowe hasło";
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
										<p>Prośba o nowe hasło</p>
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
						header("Location:../forgot.php?e=0");
 				} else {
 					header("Location:../forgot.php?e=1");
 				}
		} catch(PDOException $e) {
			header('Location:../index.php');
		}

						

?>