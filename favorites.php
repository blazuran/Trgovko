<?php 
include "header.php"; 
include_once "db.php"; 
?>
<?php 

$UserID = $_SESSION['ID'];
$sql = "SELECT f.ID as favoriteID, p.ID as productID, p.ProductURL as pProductURL, p.Title as pTitle, p.Price as pPrice "
        . "FROM products as p INNER JOIN favorites f ON p.ID = f.Products_ID WHERE f.Users_ID='$UserID' ORDER BY Rating DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // nedela za slike na samo na favorites
    while($row = $result->fetch_assoc()) {
        $id = $row["favoriteID"];
        $idproduct = $row["productID"];
        $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$idproduct' LIMIT 1";
        $resultPicture = $conn->query($sqlPicture);
        $rowPicture = $resultPicture->fetch_assoc();
        
        echo "<br><a href=". $row["pProductURL"] .">". $row["pTitle"]. "</a>  Cena:" . $row["pPrice"] . 
                "<a href='deletefavorite.php?id=$id'> Odstrani iz priljubljenih.</a><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'>";
       
    }
} else {
    echo "Ni izdelkov";
}

?>
<?php 
include "footer.html"; 
?>
