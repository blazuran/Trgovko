<?php 
include "header.php"; 
include_once "db.php"; 
?>

<div class="wrapper row3">
    <main class="hoc container clear">
        <ul class="nospace group center">


<?php 

$UserID = $_SESSION['ID'];
$sql = "SELECT f.ID as favoriteID, p.ID as productID, p.ProductURL as pProductURL, p.Title as pTitle, p.Price as pPrice "
        . "FROM products as p INNER JOIN favorites f ON p.ID = f.Products_ID WHERE f.Users_ID='$UserID' ORDER BY Rating DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    ?>
            <h6 style="position:center;">Vaši priljubljeni izdelki :</h6>
    <?php
    // nedela za slike na samo na favorites
    while($row = $result->fetch_assoc()) {
        $id = $row["favoriteID"];
        $idproduct = $row["productID"];
        $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$idproduct' LIMIT 1";
        $resultPicture = $conn->query($sqlPicture);
        $rowPicture = $resultPicture->fetch_assoc();
        ?>

    <li class="one_third first btmspace-30">
        <article class="block inspace-30 borderedbox">
            <h6 class="font-x1">

<?php
        echo "<a href=". $row["pProductURL"] .">". $row["pTitle"]. "</a></h6><br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'><br><h6 class=\"font-x1\">  Cena:" . $row["pPrice"]."</h6>".
                "<br><a href='deletefavorite.php?id=$id'> Odstrani iz priljubljenih.</a> </article> </li>";
       
    }
    ?>

      </div>

<?php

} else {
    echo "Ni izdelkov";
}

?>
</ul>
<div class="clear"></div>
</main>
</div>
<?php 
include "footer.php";
?>
