<?php 
include "header.php"; 
include_once "db.php"; 
?>
<?php 

    $UserID = $_SESSION['ID'];
$sql = "SELECT * FROM `products` INNER JOIN favorites ON products.ID = favorites.Products_ID WHERE Users_ID='$UserID' ORDER BY Rating DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["ID"];
        echo "<br> Name: <a href='product.php?id=$id'>". $row["Title"]. "</a> Cena:" . $row["Price"] . "<br>";
    }
} else {
    echo "Ni izdelkov";
}

?>
<?php 
include "footer.html"; 
?>
