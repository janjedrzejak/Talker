<?php
	session_start();

  $user_id = $_SESSION["id"];
  if($user_id=='') { header('Location:error_page.php?c=401'); }
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <title>Chat</title>
  </head>
  <body class="chat-bg">
        <img src="img/pic.png" alt="pic" class="pic" />
		<div class="container">
        <div class="chat-box col-xs-12 col-sm-12 col-md-10 col-lg-10 col-centered">
          <div class="row">
				  <div class="menu_dashboard col-xs-12 col-sm-12 col-md-4 col-lg-3 no-padding">
                <div class="rooms">
                  <div class="row">
                    <div class="caption_dashboard">
                    Dashboard
                    </div>
                  </div>
                  <div class="option">
                    <?php
                    if(isset($_SESSION['user_type_id'])) { $user_type_id = $_SESSION['user_type_id']; }

                      switch($user_type_id) {
                        case 0:
                                if(isset($_GET['o'])) { $o = htmlspecialchars($_GET['o']); } else { $o = 0; }
                                switch($o) {
                                    case 0:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt-active">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt">zarządzaj kanałami</a>
                                      ';
                                    break;
                                    case 1:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt-active">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt">zarządzaj kanałami</a>
                                      ';
                                    break;
                                    case 2:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt-active">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt">zarządzaj kanałami</a>
                                      ';
                                    break;
                                    case 3:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt-active">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt">zarządzaj kanałami</a>
                                      ';
                                    break;
                                    case 4:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt-active">zarządzaj kanałami</a>
                                      ';
                                    break;
                                    default:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt-active">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>

                                            <a href="dashboard.php?o=4" id="opt">zarządzaj kanałami</a>
                                      ';
                                  }
                        break;
                        case 1:
                              if(isset($_GET['o'])) { $o = htmlspecialchars($_GET['o']); } else { $o = 0; }
                                switch($o) {
                                    case 0:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt-active">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>
                                      ';
                                    break;
                                    case 1:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt-active">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>
                                      ';
                                    break;
                                    case 2:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt-active">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>
                                      ';
                                    break;
                                    case 3:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt-active">usuń konto</a>
                                      ';
                                    break;
                                    default:
                                      echo '
                                            <a href="dashboard.php?o=0" id="opt">zmień avatar</a>
                                            <a href="dashboard.php?o=1" id="opt-active">zmień e-mail</a>
                                            <a href="dashboard.php?o=2" id="opt">zmień hasło</a>
                                            <a href="dashboard.php?o=3" id="opt">usuń konto</a>
                                      ';
                                  }
                        break;
                        default:
                          header('Location:logout_script.php');
                      }

                      
                    ?>
                    </div>
                </div>

                <div class="people">
                  <div class="row">
                    
                  
                </div> 
                </div>    
          </div>

          <div class="discus col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="row">
                  <div class="caption"> 
                  Zarządzaj kontem
                    <div class="logout">
                    <!-- <a href="logout_script.php" class="logout-link">wyloguj</a> -->
                    <div class="dropdown show">
                      <a class="dropdown-toggle logout-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       ustawienia</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="chat.php?roomid=1">chat</a>
                           <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="logout_script.php">wyloguj</a>
                        </div>
                      </div>
                    
                   
                  </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      
                  </div>
                  <div class="chat-container" id="scroll-style">
                     <!-- <img src="img/loader.gif" class="loader-ico"> -->
                     <div class="preferences">
                      <?php
                        require_once("preferences.php");
                      ?>
                    </div>
                  </div> 

                     
                </div>
          </div>
        </div>
        </div>
		</div>

  </body>

</html>

