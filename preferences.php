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
      echo '<img src=' . $user_avatar . ' class="avatar_preferences">';
      echo '<form enctype="multipart/form-data" method="post" action="libary/upload.php">
            <label for="fileToUpload" class="inputfile_label">wybierz plik</label>
            <input type="file" name="fileToUpload" id="fileToUpload"  class="inputfile" /> 
            <input type="submit" value="wgraj" />
            </form>';
      echo '<span class="descryption">W tym obszarze możesz zmienić swój avatar. Podczas wyboru pamiętaj, aby obrazek nie był obraźliwy dla innych.</span>';
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

    echo '<form action="libary/change_user_email.php" method="POST" class="login-form">
            <input type="text" placeholder="stary adres e-mail" name="old_email" />
            <input type="text" placeholder="nowy adres e-mail" name="email" />
            <input type="submit" value="zmień" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz zmienić dotychczas używany adresu email. Dokonując zmiany akceptujesz to, że Twój adres jest przetrzymywany w bazie danych serwisu. </span>';
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
    echo '<form action="libary/change_user_pass.php" method="POST" class="login-form">
            <input type="password" placeholder="stare hasło" name="old_password" />
            <input type="password" placeholder="nowe hasło" name="password" />
            <input type="password" placeholder="powtórz nowe hasło" name="repeat_password" />
            <input type="submit" value="zmień" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz zmienić aktualnie stosowane hasło dostępu. Pamiętaj, że po zaakceptowaniu zmiany nie masz możliwości logowania przy pomocy starego hasła.</span>';
    break;
  case 3:
    echo '<form action="libary/delete_user.php" method="POST" class="login-form">
            <input type="password" placeholder="podaj hasło" name="password" />
            <input type="password" placeholder="powtórz" name="repeat_password" />
            <input type="submit" value="usuń konto" />
          </form>';
    echo '<span class="descryption">W tym obszarze możesz usunąć konto. Pamiętaj, że po tej operacji nie ma możliwości przywrócenia Twojego konta, a historia Twoich wiadomości zostaje utracona.</span>';
    break;
  default:
    echo '';
}
?>