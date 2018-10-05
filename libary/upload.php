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
    header('Location:../dashboard.php?e=4');
} else {
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    
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
                    $sql_query = $conn->prepare("UPDATE `users` SET `user_avatar` = 'img/avatars/" . $newName . "' WHERE `users`.`user_id` = " . $user_id . ";"); //edytuj rekord
                    $sql_query->execute();

               } catch(PDOException $e) {
                    header('Location:../dashboard.php?e=3');
               }
            //===============================================================================================
            header('Location:../dashboard.php?e=0');
    
    } else {
        header('Location:../dashboard.php?e=1');
    }
}
?>