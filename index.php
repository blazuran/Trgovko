
<?php 
include "header.html"; 
include_once "db.php"; 
?>
<div style=" font-size: 26pt; text-align: center; font-family: 'Comic Sans MS'"> Najbolj popularno!</div><br><br>
<div style="border:1px solid black; font-size: 26pt; text-align: center;"> 
<?php
/* pobrati podatke iz baze ter jih izpisati tukaj v div.
 * vsak izdelek v svojem divu, div poleg diva, 3-4 izdelki v vrsti MAX
 * začnemo z najpopularnejšimi nato vedno manj. 
 */


$sql = "SELECT * FROM `products` ORDER BY Rating DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "<br> Name: ". $row["Title"]. " Cena:" . $row["Price"] . "<br>";
    }
} else {
    echo "0 results";
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
