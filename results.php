<?php 
include "header.php";
include_once "db.php";
if(isset($_POST["Search"])){
$search_value=$_POST["Search"];
}else{
$search_value=$_GET["Search"];
}
if(isset($_GET["order"])){
$orderby=$_GET["order"];
$sql = "SELECT * FROM `products` WHERE Title like '%$search_value%' ORDER BY $orderby;";
}else{
$sql = "SELECT * FROM `products` WHERE Title like '%$search_value%' ORDER BY products.Rating DESC";
}
$result = $conn->query($sql);
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
                    <td><input class="form-control" type="text" name="Search" placeholder="Danes iscem..." style="width:470px"></td>
                    <td>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 5px" value="Poisci">Poišči</button>
                    </td>
                </tr>
            </table>
        </form>
    </div> <br> <br>
</div>

<form action="orderByResults.php?">
    <input type="hidden" name="Search" value="<?php echo $search_value; ?>" /> 
    <select name="order" onchange="this.form.submit()">
      <option value="Rating DESC">Ocena</option>
      <option value="Price ASC">Cena (najnižja najprej)</option>
      <option value="Price DESC">Cena (najvišja najprej)</option>
      <option value="Title ASC">Naziv izdelka (A-Z)</option>
      <option value="Title DESC">Naziv izdelka (Z-A)</option>
    </select>
</form>
    <?php
    
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
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
include "footer.html"; ?>
