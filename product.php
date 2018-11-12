<?php 
include "header.php"; 
include_once "db.php";
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">

    <?php
    $id =$_GET['id'];
    //Remove LIMIT 1 to show/do this to all results.
    $sql = 'SELECT * FROM products WHERE ID = '.$id.' LIMIT 1';
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);

    // Echo page content
    echo $row['Title'];
    
    $id = $row["ID"];
    $query = mysqli_query($conn, "SELECT * FROM favorites WHERE Products_ID='$id' LIMIT 1");
    
    if (!$query)
    {
        die('Error: ' . mysqli_error($conn));
    }

    $sqlPicture = "SELECT * FROM Pictures INNER JOIN Products ON products.ID = Pictures.Products_ID WHERE Products_ID=$id LIMIT 1";
    $resultPicture = $conn->query($sqlPicture);
    $rowPicture = $resultPicture->fetch_assoc();
    
    if(isset($_SESSION['ID'])){
        if(mysqli_num_rows($query) > 0){
            echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ." Priljubljen izdelek<br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='200' width='200'><br>";
        }else{
            echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ." <a href='addfavorite.php?id=$id'>Dodaj med priljubljene.</a><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='100' width='100'> <br><br>";
        }
    }else
    {
        echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ."<img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='100' width='100'><br><br> ";
    }
    ?>
</div>
<?php
include "footer.html"; 
?>
