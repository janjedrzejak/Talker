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
						<a href="index.php"class="link">Zaloguj</a>
						<span class="dot">&#xb7</span>
						<a href="register.php" class="link-active">Zarejestruj się</a>
					</div>
					<form action="register_script.php" method="POST" class="login-form">
						<input type="text" placeholder="nazwa użytkownika" name="name" />
						<input type="password" placeholder="hasło" name="password" />
            <input type="text" placeholder="e-mail" name="email" />
						<input type="submit" value="Zarejestruj się" />
					</form>
			</div>
		</div>
  </body>

</html>



