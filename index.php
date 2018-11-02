
<?php 
include "header.html"; 
include_once "db.php"; 
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">
<div clss="row">
    <div class="col-md-8 ml-md-auto" style="font-family: 'Comic Sans MS'; font-size:25px; padding-top:10px;">Kaj lahko danes poiscemo za vas?</div>
</div>
<br>
<div clss="row">
    <div class="col-md-3 offset-md-4">
        <form action="results.php" method="post">
            <table>
                <tr>
                    <td><input class="form-control" type="text" placeholder="Danes iscem..." style="width:600px"></td>
                    <td>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 5px" value="Poisci">Poišči</button>
                    </td>
                </tr>
            </table> <br><br>
        </form>
    </div> <br> <br>
</div>
<div style="text-align: center; font-size:26pt; font-family: 'Comic Sans MS'"> Najbolj popularno!</div><br><br>
<div class="col-md-3 offset-md-5" style= padding-bottom:100px;margin-right:20%; width:400px; height:100px; font-size: 26pt; text-align: center;">
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
