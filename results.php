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

<div class="wrapper row3">
    <main class="hoc container clear">
        <!--STRANSKI FILTER  -->
        <div class="sidebar one_quarter first">
            <!--STRANSKO ISKANJE -->
            <div id="topbar" class="hoc clear">
            <div class="fl_right">
                <form class="clear" method="post" action="results.php">
                    <fieldset>
                        <input type="search" value="" name="Search" placeholder="Išči tukaj&hellip;">
                        <button class="fa fa-search" type="submit" title="Search"></button>
                    </fieldset>
                </form>
            </div>
            </div>
            <!--STRANSKO ISKANJE -->
            <!--RAZVRSTI PO -->
            <form class="clear" action="orderByResults.php?">
                <input type="hidden" name="Search" value="<?php echo $search_value; ?>" />
                <select name="order" onchange="this.form.submit()">
                    <option value="Rating DESC">Ocena</option>
                    <option value="Price ASC">Cena (najnižja najprej)</option>
                    <option value="Price DESC">Cena (najvišja najprej)</option>
                    <option value="Title ASC">Naziv izdelka (A-Z)</option>
                    <option value="Title DESC">Naziv izdelka (Z-A)</option>
                </select>
            </form>
            <!--STRANSKI FILTER -->
        </div>
        <!--STRANSKI FILTER -->
        <!-- SREDINA -->

        <div class="content three_quarter">
            <!-- VSEBINA -->
            <h6 style="position:center"> Vaše iskane besede : <b><?php echo $search_value; ?></b></h6>
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

            <li class="one_third first btmspace-30">
                <article class="block inspace-30 borderedbox">
                    <h6 class="font-x1">
                    <?php
                    echo " Name: <a href='product.php?id=$id'>". $row["Title"]. "</a><br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'><br> Cena: " . $row["Price"] . " </article> </li>"; //za oceno še zrovn pa sliko po možnosti
                    ?>
                    <?php
                }
            } else {
                echo "Ni izdelkov";
            }
            ?>


            <!-- SREDINA -->
            </div>
        <!-- SREDINA -->
        </div>
        <!-- KONEC -->
        <div class="clear"></div>
    </main>
</div>
<?php
include "footer.html"; ?>
