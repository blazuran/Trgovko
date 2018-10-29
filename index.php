
<?php 
include "header.html"; 
//include_once "db.php"; 
?>
<div style="border:1px solid black; font-size: 26pt; text-align: center;"> Najbolj popularno!</div>
<div style="border:1px solid black; font-size: 26pt; text-align: center;"> 
<?php
/* pobrati podatke iz baze ter jih izpisati tukaj v div.
 * vsak izdelek v svojem divu, div poleg diva, 3-4 izdelki v vrsti MAX
 * začnemo z najpopularnejšimi nato vedno manj. 
 */
$products_from_db = sprintf("SELECT pr.Title, pr.Rating, pic.url FROM Products pr INNER JOIN Pictures pic ON pr.ID = pic.Products_ID ORDER BY Rating DESC;");
echo $products_from_db;
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
