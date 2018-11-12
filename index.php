
<?php 
include "header.php"; 
include_once "db.php"; 
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">
<div clss="row">
    <div  style="font-family: 'Arial'; font-size:25px;text-align: center; padding-top:40px;">Kaj lahko danes poiscemo za vas?</div>
</div>
<br>
<div clss="row">
    <div class="col-md-3 offset-md-4">
        <form action="results.php" method="post">
            <table>
                <tr>
                    <td><input class="form-control" type="text" placeholder="Danes iscem..." style="width:470px"></td>
                    <td>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 5px" value="Poisci">Poišči</button>
                    </td>
                </tr>
            </table>
        </form>
    </div> <br> <br>
</div>
    <hr>
<div style="text-align: center; font-size:26pt; font-family: 'Arial'"> Najbolj popularno! <br>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
</div>

    <!-- IZDELKI PRVA STRAN -->
    <div class="container">
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

        $id = $row["ID"];
        echo $id."<br>";
        $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
        $resultPicture = $conn->query($sqlPicture);
        $rowPicture = $resultPicture->fetch_assoc();
        
?>
        <div class="okvir">
        <?php
        echo  $rowPicture["url"]."<br>";
        echo " Name: <a href='product.php?id=$id'>". $row["Title"]. "</a><br> Cena: " . $row["Price"] . "<br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'>"; //za oceno še zrovn pa sliko po možnosti
        ?>
        </div>
        <?php
    }
} else {
    echo "Ni izdelkov";
}
/* execute query 
 * izpis po 3/4 v vrsto. 
 * podatke dobimo urejeno PADAJOČE
 * 
 * Koliko izdelkov na strani? na prvi strani max 6 izdelkov ?
 */
?>
    </div>
<?php 
include "footer.html"; 
?>
