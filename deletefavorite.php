   <?php
    include_once "session.php";
    include_once "db.php";
    
    $id =$_GET['id'];    
    
    $sql = 'DELETE FROM `favorites` WHERE `ID` = '.$id.' AND `Users_ID` = '.$_SESSION['ID'].';';

    if ($conn->query($sql) === TRUE) {
        echo "Deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: favorites.php');     
    exit;
    ?>
