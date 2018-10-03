<?php
	$db_server_name = "localhost";
	$db_username = "root";
	$db_password = "root";
	$db_name = "chat";


//======================================================================================================
//----------Wyświetlanie dyskusji lub szczegółów rozmowy prywatnej--------------------------------------
//======================================================================================================
	if(isset($_SESSION['privuserid'])) {
		try {
			$privuserid = $_SESSION['privuserid'];

			$conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);	
			$sql_query = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $privuserid;"); 
			$sql_query->execute();

			while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
				$user_name = $result['user_name'];
			}
			echo "Rozmowa prywatna z $user_name";
		} catch(PDOException $e) {
			echo "problem z połączeniem";
		}

    } else {
      echo "Dyskusja";
    }
?>