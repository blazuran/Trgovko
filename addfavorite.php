   <?php
   
    include_once "session.php";
    include_once "db.php";
    
    $id =$_GET['id'];
    //Remove LIMIT 1 to show/do this to all results.
    $sql = 'SELECT * FROM `products` WHERE `ID` = '.$id.' LIMIT 1';
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $ProductID = $row["ID"];
    
    $date = date("'Y-m-d H:i:s'", time());
    
    $sql = 'INSERT INTO `favorites`(`Products_ID`, `Users_ID`, `DateTime`) VALUES ('.$ProductID.', '.$_SESSION['ID'].', '.$date.');';

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: product.php?id='.$id.'');     
    exit;
    ?>
