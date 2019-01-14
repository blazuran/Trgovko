<?php
include "header.php";
include_once "db.php";
$search_value ="";
$price_max = 5000;
$price_min = 0;
//$sql;
    if(isset($_POST['search_value']))
    {
        $search_value = $_POST['search_value'];
        $sql = "SELECT products.Title as produkt, products.ID, products.Price FROM `products` WHERE Title LIKE '%".$search_value."%' AND Price <= ".$price_max." AND Price >= ".$price_min.";";
    }
    if (isset($_GET["search"])) 
    {
    $price_min = isset($_GET["price-min"]) ? $_GET["price-min"] : 0;
    $price_max = isset($_GET["price-max"]) ? $_GET["price-max"] : 5000;
    if(isset($_GET["search_value"]))
    {
      $search_value = $_GET["search_value"];  
    }
    else
    {
        $search_value = $_GET["search"];
    }
        
     $sql = "SELECT products.Title as produkt, products.ID, products.Price FROM `products` WHERE Title LIKE '%".$search_value."%' AND Price <= ".$price_max." AND Price >= ".$price_min."";
    } 
    if(!isset($_POST['search_value']) && !isset($_GET["search"]))
    {
    $search_value = "";
     $sql = "SELECT products.Title as produkt, products.ID, products.Price FROM `products` WHERE Title LIKE '%".$search_value."%' AND Price <= ".$price_max." AND Price >= ".$price_min."";
    }
    if(isset($_GET['arr']))
    {
        $cnt = count($_GET['arr']);
         $sql = "SELECT products.Title as produkt, products.ID, products.Price FROM products INNER JOIN categories ON products.Categories_ID = categories.ID WHERE products.Title LIKE '%".$search_value."%' AND products.Price <= ".$price_max." AND products.Price >= ".$price_min." AND (";
         foreach($_GET['arr'] as $val)
         {
             if( $cnt > 1)
             {
                 $sql = $sql . " categories.Title = '$val' OR";
                 $cnt--;
             }
             else
             {
                 $sql = $sql . " categories.Title = '$val'";
             }
         }
         $sql = $sql . ")";
    }
    
    if (isset($_GET["order"])) {
    $orderby = $_GET["order"];
    $sql =  $sql." ORDER BY products.$orderby;";
    $sql = str_replace(";", "", $sql);
} else {
    $orderby = "Price ASC";
    $sql = $sql." ORDER BY products.$orderby;";
    $sql = str_replace(";", "", $sql);
}
    //echo $sql."<br>";
$result = mysqli_query($conn, $sql)
?>
<p class="hidden">
<div class="wrapper row3">
    <main class="hoc container clear">
        <form method="get" action="">
        <!--STRANSKI FILTER  -->
        <div class="sidebar one_quarter first">
            <!--STRANSKO ISKANJE -->
            <div id="topbar" class="hoc clear">
                <div class="fl_right">
                        <fieldset>
                            <input type="text" name="search_value" value="<?= isset($_GET["search_value"]) ? $_GET["search_value"] : ""; ?>" placeholder="Išči tukaj&hellip;">
                        </fieldset>
                </div>
            </div>
            <!--STRANSKO ISKANJE -->
            <!--STRANSKA CENA-->
            <h1><b> FILTRI</b></h1>
            <div class="dropdown">
                <div data-role="rangeslider">
                    <h6>Cena...</h6>
                    <div class="dropdown-content">
                    <label for="price-min">Min:<span id="demo1"></span></p></label>
                    <input type="range" name="price-min" id="price-min" value="<?= isset($_GET["price-min"]) ? $_GET["price-min"] : 0; ?>" min="0" max="5000">
                    <label for="price-max">Max:<span id="demo2"></span></label>
                    <input type="range" name="price-max" id="price-max" value="<?= isset($_GET["price-max"]) ? $_GET["price-max"] : 5000; ?>" min="0" max="5000">
                </div>
</div>
</div>
<br>
                <div class="dropdown">
                    <h6> Kategorije...</h6>
                    <div class="dropdown-content" style="">
                    <?php 
                    $sql_get_cats = "SELECT * FROM categories";
                    
                    $result1 = mysqli_query($conn, $sql_get_cats);
                    if (mysqli_num_rows($result1) > 0) 
                    {
                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                           echo "<input type='checkbox' name='arr[]' value='".$row1['Title']."'>".$row1['Title']."";
                        }
                    }
                    
                    
                    ?>
                </div>
                </div>
<br>
                <input class="btn" type="submit" data-inline="true" name="search" value="Potrdi">

            <!--STRANSKA CENA-->


            <!--RAM-->


            <!--RAM-->

            <!--STRANSKI FILTER -->
        </div>
        </form>
</p>
<!--STRANSKI FILTER -->
<!-- SREDINA -->

<div class="content three_quarter">
    <!-- VSEBINA -->
    <h6 style="position:center"> Vaše iskane besede : <b><?php echo $search_value; ?></b></h6>
    <!--RAZVRSTI PO -->
    <!--<form class="clear" action="orderByResults.php?">
        <input type="hidden" name="Search" value="<?php echo $search_value; ?>"/>
        <select name="order" onchange="this.form.submit()">
            <option value="Price ASC">Cena (najnižja najprej)</option>
            <option value="Price DESC">Cena (najvišja najprej)</option>
            <option value="Title ASC">Naziv izdelka (A-Z)</option>
            <option value="Title DESC">Naziv izdelka (Z-A)</option>
        </select>
    </form> -->
    <form action="orderByResults.php?">
        <input type="hidden" name="Search" value="<?php echo $search_value; ?>" /> 
        <select name="order" onchange="this.form.submit()">     
            <option <?php
                if ($orderby == "Stores_ID") {
                    echo 'selected';
                }
                ?> value="Stores_ID" <?php
                if ($orderby == "Stores_ID") {
                    echo 'selected';
                }
                ?> >Trgovine</option>
            <option <?php
            if ($orderby == "Price ASC") {
                echo 'selected';
            }
            ?> value="Price ASC">Cena (najnižja najprej)</option>
            <option <?php
            if ($orderby == "Price DESC") {
                echo 'selected';
            }
            ?> value="Price DESC">Cena (najvišja najprej)</option>
            <option <?php
    if ($orderby == "Title ASC") {
        echo 'selected';
    }
    ?> value="Title ASC">Naziv izdelka (A-Z)</option>
            <option <?php
    if ($orderby == "Title DESC") {
        echo 'selected';
    }
    ?> value="Title DESC">Naziv izdelka (Z-A)</option>
        </select>
    </form>
    <script>
                    function prikazi(z) {
                        var x = document.getElementById(z);
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                    }
                </script>
    <div class="elementi">
        <?php
if ($orderby == "Stores_ID") {
    $sqlStores = "SELECT s.* FROM stores s INNER JOIN products p ON p.Stores_ID = s.ID WHERE Title like '%$search_value%' GROUP BY s.Name";
    $resultStores = $conn->query($sqlStores);
    
        if (!$resultStores) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        if ($resultStores->num_rows > 0) {
            // output data of each row

            while ($rowStores = $resultStores->fetch_assoc()) {
            $StoreName=$rowStores["Name"];
            $StoreName=substr($StoreName, 0, 3);

                echo $rowStores["Name"]."<br><button class=\"button button5\"  onclick='prikazi(".'"'.$StoreName.'"'.")'>Prikazi</button><div id=$StoreName style=\"display:none\">";
                $storeID=$rowStores["ID"];
                    $sqlProducts  = "SELECT * FROM `products` WHERE (Title like '%$search_value%') AND ($storeID=Stores_ID)";
                    $resultProducts  = $conn->query($sqlProducts);

                        if (!$resultProducts ) {
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        if ($resultProducts ->num_rows > 0) {
                            // output data of each row
                            $first = true;
                            $ct = 0;        
                            while ($rowProducts = $resultProducts ->fetch_assoc()) {
                                $ct++;
                            $id = $rowProducts["ID"];    
                            $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
                            $resultPicture = $conn->query($sqlPicture);
                            $rowPicture = $resultPicture->fetch_assoc();
                            ?>
                            <div class="one_third <?= $first == true ? "first" : ""; ?> btmspace-30">
                                <div class="block inspace-30 borderedbox">
                                    <h6 class="font-x1">
                            <?php
                            echo " Name: <a href='product.php?id=$id'>" . $rowProducts["Title"] . "</a><br> Cena: " . $rowProducts["Price"] . "<br><img src=" . $rowPicture["url"] . " alt=" . $rowPicture["Title"] . " height='60' width='100'>";
                            ?>
                                        </h6>
                                </div>
                            </div>
                            
                            <?php
                            $first = ($ct % 3 == 0) ? true : false;
                            }
                            
                        }
                echo "</div><br>";
            }
        }
    }
    else
    {
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        if ($result->num_rows > 0) {
            // output data of each row

            $first = true;
            $ct = 0;
            while ($row = $result->fetch_assoc()) {

                $ct++;
                $id = $row["ID"];
                $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
                $resultPicture = $conn->query($sqlPicture);
                $rowPicture = $resultPicture->fetch_assoc();

                ?>

                <div class="one_third <?= $first == true ? "first" : ""; ?> btmspace-30">
                    <div class="block inspace-30 borderedbox">
                        <h6 class="font-x1">
                            <?php
                            echo " <a href='product.php?id=$id'>".$row['produkt']."</a><br>"; if(isset($rowPicture['url'])){echo "<img src=".$rowPicture['url']." alt=".$rowPicture['Title']." height='60' width='100'>";} else{echo  "<img src='../Trgovko/Slike/icon3.png'>";}
                            echo "<br> Najceneje: " ."<h5><b>". $row["Price"]."€</b></h5>" . "</article> </li>"; //za oceno še zrovn pa sliko po možnosti
                            ?>
                        </h6>
                    </div>
                </div>

                <?php
                $first = ($ct % 3 == 0) ? true : false;
            }
        } else {
            echo "Ni izdelkov";
        }
    }
        ?>
    </div>
    <!-- SREDINA -->
</div>
<!-- SREDINA -->
</div>
<!-- KONEC -->
<div class="clear"></div>
</main>
</div>
<?php
include "footer.php"; ?>
