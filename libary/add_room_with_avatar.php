<?php
session_start();

    $db_server_name = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "chat";


if(isset($_SESSION["id"])) {
    $user_id=$_SESSION["id"];
} else { header('Location:../logout_script.php'); }


require_once('ImageManipulator.php');

if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
    header('Location:../dashboard.php?o=4&e=4');
} else {
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    
    if(isset($_POST['name'])) { $name = htmlspecialchars($_POST['name']); } 
    else { header('Location:../dashboard?o=4&e=3'); }
    

    //echo $name;
    
    if (in_array($fileExtension, $validExtensions)) {
        $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        // our dimensions will be 200x130
        $x1 = $centreX - 100; // 200 / 2
        $y1 = $centreY - 100;
 
        $x2 = $centreX + 100; // 200 / 2
        $y2 = $centreY + 100; 
 
        // center cropping to 200x130
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save('../img/avatars/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
        echo 'Done ...';
        $newName = $newNamePrefix . $_FILES['fileToUpload']['name'];
            //===============================================================================================
               try {
                    $conn = new PDO("mysql:host=$db_server_name; dbname=$db_name", $db_username, $db_password); 
                    //=======================================================================================
                    $sql_query = $conn->prepare("SELECT * FROM `rooms` ORDER BY `rooms`.`room_id` ASC");
                    $sql_query->execute();
                        while($result = $sql_query->fetch(PDO::FETCH_ASSOC)) {
                            $last_id = $result['room_id'];      
                        }   $last_id++;
                    //=======================================================================================
                    $sql_query_insert = $conn->prepare("INSERT INTO `rooms` (`room_id`, `room_name`, `room_avatar`) VALUES ('" . $last_id . "', '" . $name . "', 'img/avatars/" . $newName . "')"); //nowy rekord rekord
                    $sql_query_insert->execute();
               } catch(PDOException $e) {
                    header('Location:../dashboard.php?o=4&e=3');
               }
            //===============================================================================================
                header('Location:../dashboard.php?o=4&e=0');
    
    } else {
        header('Location:../dashboard.php?o=4&e=1');
    }
    
}
?>