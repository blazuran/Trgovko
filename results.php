<?php 
include "header.php";
include_once "db.php";

$search_value=$_POST["Search"];

$sql = "SELECT * FROM `products` WHERE Title like '%$search_value%' ORDER BY Rating DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

        $id = $row["ID"];
        $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
        $resultPicture = $conn->query($sqlPicture);
        $rowPicture = $resultPicture->fetch_assoc();
        
        ?>
        <div class="okvir">
        <?php
        echo " Name: <a href='product.php?id=$id'>". $row["Title"]. "</a><br> Cena: " . $row["Price"] . "<br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'>"; //za oceno še zrovn pa sliko po možnosti
        ?>
        </div>
        <?php
    }
} else {
    echo "Ni izdelkov";
}
/*
 * izpis rezultatov glede na iskalni niz.
 * Tukaj ponudimo filtre. 
*/
echo "<div style='float: left; border:1px solid black; text-align: center; width: 15%;' >Filtri <br><br><br><br><br> </div>";
echo "<div style='float: left; border:1px solid black; text-align: center; width: 75%;'> Izpis rezulatov <br><br><br><br><br></div>";
include "footer.html"; ?>
