<?php 
include "header.php"; 
include_once "db.php"; 
?>
<?php 

$UserID = $_SESSION['ID'];
$sql = "SELECT * FROM products INNER JOIN favorites ON products.ID = favorites.Products_ID WHERE Users_ID='$UserID' ORDER BY Rating DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // nedela za slike na samo na favorites
    while($row = $result->fetch_assoc()) {
        $id = $row["ID"];
        $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
        $resultPicture = $conn->query($sqlPicture);
        $rowPicture = $resultPicture->fetch_assoc();
        
        echo "<br><a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "<a href='deletefavorite.php?id=$id'> Odstrani iz priljubljenih.</a><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'>";
       
    }
} else {
    echo "Ni izdelkov";
}

?>
<?php 
include "footer.html"; 
?>
