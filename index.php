
<?php 
include "header.html"; 
include_once "db.php"; 
?>
<div style="text-align: center; font-size:26pt; font-family: 'Comic Sans MS'"> Najbolj popularno!</div><br><br><hr>
<div class="col-md-3 offset-md-5" style="border:5px solid black; padding-bottom:100px;margin-right:20%; width:400px; height:100px; font-size: 26pt; text-align: center;">
<?php
/* pobrati podatke iz baze ter jih izpisati tukaj v div.
 * vsak izdelek v svojem divu, div poleg diva, 3-4 izdelki v vrsti MAX
 * začnemo z najpopularnejšimi nato vedno manj. 
 */


$sql = "SELECT * FROM `products` ORDER BY Rating DESC limit 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "<br> Name: ". $row["Title"]. " Cena:" . $row["Price"] . "<br>";
    }
} else {
    echo "Ni izdelkov";
}
/* execute query 
 * izpis po 3/4 v vrsto. 
 * podatke dobimo urejeno PADAJOČE
 * 
 * Koliko izdelkov na strani? 
 */
?>
</div>
<?php 
include "footer.html"; 
?>
