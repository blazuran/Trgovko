<?php 
include "header.php"; 
include_once "db.php";
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">

    <?php
    $id =$_GET['id'];
    //Remove LIMIT 1 to show/do this to all results.
    $sql = 'SELECT * FROM `products` WHERE `ID` = '.$id.' LIMIT 1';
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);

    // Echo page content
    echo $row['Title'];
    
    $id = $row["ID"];
    $UserID = $_SESSION['ID'];
    
    
    
    $query = mysqli_query($conn, "SELECT * FROM favorites WHERE Products_ID='$id' AND Users_ID='$UserID' LIMIT 1");

    if (!$query)
    {
        die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){
    echo "<br> Name: ". $row["Title"]. " Cena:" . $row["Price"] . " Priljubljen izdelek<br>";
    }else{
        echo "<br> Name: ". $row["Title"]. " Cena:" . $row["Price"] . " <a href='addfavorite.php?id=$id'>Dodaj med priljubljene.</a> <br>";
    }
    ?>
</div>
<?php
include "footer.html"; 
?>
