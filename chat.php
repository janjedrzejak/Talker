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
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <title>Chat</title>
 
 

  </head>
  <body class="chat-bg">
        <img src="img/pic.png" alt="pic" class="pic" />
		<div class="container">
        <div class="chat-box col-xs-12 col-sm-12 col-md-10 col-lg-10 col-centered">
          <div class="row">
				  <div class="menu col-xs-12 col-sm-12 col-md-4 col-lg-3 no-padding">
                <div class="rooms">
                  <div class="row">
                    <div class="caption">
                    Dostępne kanały
                    </div>
                    <div class="rooms-list" id="scroll-style">
                      <?php
                        require_once('chat_roomslist_script.php');
                      ?>
                      <!--
                      <a href="#" class="room"><img src="img/avatar.png" class="avatar">Programiści</a>
                      <a href="#" class="room"><img src="img/avatar.png" class="avatar">Kawalarze</a>
                      <a href="#" class="room-active"><img src="img/avatar.png" class="avatar">Aktywne kobiety</a>
                      <a href="#" class="room"><img src="img/avatar.png" class="avatar">Programiści</a>
                      <a href="#" class="room"><img src="img/avatar.png" class="avatar">Kawalarze</a>
                      <a href="#" class="room-active"><img src="img/avatar.png" class="avatar">Aktywne kobiety</a>
                    -->
                    </div>
                  </div>
                </div>

                <div class="people">
                  <div class="row">
                    <div class="caption">
                    Osoby w pokoju
                  </div> 
                  <div class="people-list" id="scroll-style">
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Gnój</a>
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Locha</a>
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Gnój</a>
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Locha</a>
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Gnój</a>
                    <a href="#" class="room"><img src="img/avatar.png" class="avatar">Locha</a>
                  </div>
                </div> 
                </div>    
          </div>
          <div class="discus col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="row">
                  <div class="caption">
                  Dyskusja
                    <div class="logout">
                    <a href="logout_script.php" class="logout-link">wyloguj</a>
                    </div>
                  </div>
                  <div class="chat-container" id="scroll-style">
                  <?php
                    //wyswietlanie zawartosci chatu
                    require_once('chat_discus_script.php');
                  ?>
                  <script type="text/javascript">
                    var objDiv = $(".chat-container");
                    var h = objDiv.get(0).scrollHeight;
                      objDiv.animate({scrollTop: h}, 0);
                  </script>
                  </div>   
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <form action="chat_send_script.php" method="POST">
                        <input type="text" placeholder="Wyślij wiadomość" class="chat-message" name="chat_message">
                        <input type="submit" style="display:none"/>
                      </form>
                  </div>
                </div>
          </div>
        </div>
        </div>
		</div>

  </body>

</html>

