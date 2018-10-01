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

    <title>Chat</title>
    
    <link href="reset.css" rel="stylesheet">

  </head>

  <body>
    <?php
      if(isSet($_SESSION['zalogowany']))
      {
          $zalogowany = $_SESSION['zalogowany'];
          if($zalogowany==1) {
            echo "zalogowany";
            echo "<a href=logout_script.php>wyloguj</a>";
          } 
      }  
    ?>
		<h3>zaloguj</h3>
    <form action="login_script.php" method="POST">
      Nick: <input type="text" name="name" value=""><br>
      Hasło: <input type="password" name="password" value=""><br>
      <input type="submit" value="zaloguj">
    </form>
  </body>

</html>

