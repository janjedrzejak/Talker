<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex">
	<link rel="icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Chat</title>
 
 

  </head>
  <body>
  <img src="img/pic.png" alt="pic" class="pic" />
		<div class="container">
			<div class="login-box col-xs-12 col-sm-12 col-md-7 col-lg-4 col-centered">
				<img src="img/logo.svg" alt="Logo" width="231" height="56" class="logo">
				<p class="claim">let's talk!</p>
					<div class="login-link">
						<?php
							if(isSet($_GET['e'])) { $e = htmlspecialchars($_GET['e']); } else $e = 5;
							switch ($e) {
								 	case 0:
								 		echo 'Na podany adres zostaną wysłane instrukcje<br>Może to potrwać trochę czasu.';
								 		break;
								 	
								 	default:
								 		echo 'Na podany przez ciebie adres e-mail zostanie wysłana informacja o instrukcji odzyskania hasła dostępu.';
								 		break;
								 } 
						?>
						
					</div>
					<form action="libary/forgot_script.php" method="POST" class="login-form">
						<input type="text" placeholder="e-mail" name="email" />
						<input type="submit" value="wyślij zapytanie" />
					</form>
					<?php
      					if(isSet($_SESSION['zalogowany']))
     					{
          					$zalogowany = $_SESSION['zalogowany'];
          					if($zalogowany==1) {
            				/*echo "zalogowany";
            				echo "<a href=logout_script.php>wyloguj</a>";
            				*/
            				header('Location:chat.php');
          				} 
      					}  
    				?>	
    				<div class="forgot-link">
						<a href="index.php" class="link">wróć na stronę główną</a>
					</div>
			</div>
		</div>
  </body>

</html>

