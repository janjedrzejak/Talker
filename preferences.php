<?php
    $db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";

    if(isset($_GET['o'])) {
      $opt = htmlspecialchars($_GET['o']);
    } else { header('Location:dashboard.php?o=0'); }


switch($opt) {
  case 0:
    try {

      $conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
      $sql_query = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = $user_id;"); 
      $sql_query->execute();

      while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
        $user_avatar = $result['user_avatar'];
      }
      echo '<div style="text-align:center;">';
      echo '<img src=' . $user_avatar . ' class="avatar_preferences">';
      echo '<form enctype="multipart/form-data" method="post" action="libary/upload.php">
            <label for="fileToUpload" class="inputfile_label">wybierz plik</label>
            <input type="file" name="fileToUpload" id="fileToUpload"  class="inputfile" /> 
            <input type="submit" value="wgraj" />
            </form>';
      echo '<span class="descryption">W tym obszarze możesz zmienić swój avatar. Podczas wyboru pamiętaj, aby obrazek nie był obraźliwy dla innych.</span>';
      echo '</div>';
    } catch(PDOException $e) {
      echo "problem z połączeniem";
    }
    break;
  case 1:
    if(isset($_GET['e'])) { 
        $e=htmlspecialchars($_GET['e']);
          switch ($e) {
            case 0:
              echo '<span class="descryption">Adres e-mail został zmieniony</span>';
              break;
            case 5:
              echo '<span class="descryption">Niepoprawny adres e-mail</span>';
              break;
            default:
              break;
          }
    }
    echo '<div style="text-align:center;">';
    echo '<form action="libary/change_user_email.php" method="POST" class="login-form">
            <input type="text" placeholder="stary adres e-mail" name="old_email" />
            <input type="text" placeholder="nowy adres e-mail" name="email" />
            <input type="submit" value="zmień" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz zmienić dotychczas używany adresu email. Dokonując zmiany akceptujesz to, że Twój adres jest przetrzymywany w bazie danych serwisu. </span>';
    echo '</div>';
    break;
  case 2:
    if(isset($_GET['e'])) { 
        $e=htmlspecialchars($_GET['e']);
          switch ($e) {
            case 0:
              echo '<span class="descryption">Hasło zostało zmienione</span>';
              break;
            case 5:
              echo '<span class="descryption">Niepoprawne hasło</span>';
              break;
            default:
              break;
          }
    }
    echo '<div style="text-align:center;">';
    echo '<form action="libary/change_user_pass.php" method="POST" class="login-form">
            <input type="password" placeholder="stare hasło" name="old_password" />
            <input type="password" placeholder="nowe hasło" name="password" />
            <input type="password" placeholder="powtórz nowe hasło" name="repeat_password" />
            <input type="submit" value="zmień" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz zmienić aktualnie stosowane hasło dostępu. Pamiętaj, że po zaakceptowaniu zmiany nie masz możliwości logowania przy pomocy starego hasła.</span>';
    echo '</div>';
    break;
  case 3:
    echo '<div style="text-align:center;">';
    echo '<form action="libary/delete_user.php" method="POST" class="login-form">
            <input type="password" placeholder="podaj hasło" name="password" />
            <input type="password" placeholder="powtórz" name="repeat_password" />
            <input type="submit" value="usuń konto" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz usunąć konto. Pamiętaj, że po tej operacji nie ma możliwości przywrócenia Twojego konta, a historia Twoich wiadomości zostaje utracona.</span>';
    echo '</div>';
    break;
    case 4:
      $db_server_name = "localhost";
      $db_username = "root";
      $db_password = "root";
      $db_name = "chat";

      if(isset($_GET['e'])) { 
          $e=htmlspecialchars($_GET['e']);
            switch ($e) {
               case 0:
                 echo '<span class="descryption">Kanał został poprawnie usunięty</span>';
                 break;
               case 1:
                 echo '<span class="descryption">Błąd w połączeniu z bazą danych</span>';
                 break;
               case 3:
                 echo '<span class="descryption">Nie wybrano nazwy kanału</span>';
                 break;
               case 4:
                 echo '<span class="descryption">Nie wybrano avatara</span>';
                 break;
               default:  
                 break;
             } 
      }
          try {
            //połączenie z bazą
            $conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password);
            //echo "podłączony do serwera";
            //-----------------------------
            echo '<div class="row">';
              echo '<div style="width:50%; float: left;">';
                    $sql_query = $conn->prepare("SELECT * FROM `rooms`;"); 
                    $sql_query->execute();
                    while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
                      $room_id = $result['room_id']; 
                      $room_name = $result['room_name'];
                      $room_avatar = $result['room_avatar'];    
                      echo '
                          <a href="chat.php?roomid=' . $room_id . '" class="room">
                          <img src="' . $room_avatar . '" class="avatar">' 
                          . $room_name .
                          '</a>';
                    } 
                    echo '</div>';
              echo '<div style="width:50%; float: right;">';
                    $sql_query = $conn->prepare("SELECT * FROM `rooms`;"); 
                    $sql_query->execute();
                    while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
                      $room_id = $result['room_id']; 
                      $room_name = $result['room_name'];
                      $room_avatar = $result['room_avatar'];    
                      echo '
                          <a href="libary/delete_room.php?r=' . $room_id . '" class="room" style="padding: 14px; text-align: center; color: red;">usuń kanał'
                          . '</a>';
                    } 
              echo '</div>';
          echo '</div>';
          echo '
                <div style="text-align: center; padding-top: 25px; padding-bottom: 25px;">
                    <a class="room" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                      Dodaj nowy kanał
                    </a>
                </div>  
                    <div class="collapse" id="collapse" style="text-align: center;">
                      <div class="card card-body">      
                      <form enctype="multipart/form-data" method="post" action="libary/add_room_with_avatar.php">
                        <input type="text" placeholder="podaj nazwę kanału" name="name">
                        <label for="fileToUpload" class="inputfile_label">wybierz plik</label>
                        <input type="file" name="fileToUpload" id="fileToUpload"  class="inputfile" /> 
                        <input type="submit" value="twórz kanał!" />
                      </form>
                      </div>
                    </div>';
          
  } catch(PDOException $e) {
    echo "problem z połączeniem";

  }
    echo '<span class="descryption">W tym obszarze możesz zarządzać istniejącymi kanałami oraz dodawać nowe</span>';  
    break;
  default:
    echo '';
}
?>