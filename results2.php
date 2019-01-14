<?php
include "header.php";
include_once "db.php";

if (isset($_POST["Search"])) {
    $search_value = $_POST["Search"];
} else {
    $search_value = $_GET["Search"];
}
if (isset($_GET["order"])) {
    $orderby = $_GET["order"];
    $sql = "SELECT * FROM `products` WHERE Title like '%$search_value%' ORDER BY $orderby;";
} else {
    $orderby = "Price ASC";
    $sql = "SELECT * FROM `products` WHERE Title like '%$search_value%'";
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
            <option <?php
            if ($orderby == "Rating DESC") {
                echo 'selected';
            }
            ?> value="Rating DESC">Ocena</option>      
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
            $prikazi = "prikazi('".$StoreName."')";
                echo $rowStores["Name"]."<button onclick='prikazi(".'"'.$StoreName.'"'.")'>Prikazi</button><div id=$StoreName>";                
                $storeID=$rowStores["ID"];
                    $sqlProducts  = "SELECT * FROM `products` WHERE (Title like '%$search_value%') AND ($storeID=Stores_ID)";
                    $resultProducts  = $conn->query($sqlProducts);

                        if (!$resultProducts ) {
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        if ($resultProducts ->num_rows > 0) {
                            // output data of each row
                            
                            while ($rowProducts = $resultProducts ->fetch_assoc()) {
                            $id = $rowProducts["ID"];    
                            $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
                            $resultPicture = $conn->query($sqlPicture);
                            $rowPicture = $resultPicture->fetch_assoc();
                            
                            echo " Name: <a href='product.php?id=$id'>" . $rowProducts["Title"] . "</a><br> Cena: " . $rowProducts["Price"] . "<br><img src=" . $rowPicture["url"] . " alt=" . $rowPicture["Title"] . " height='60' width='100'>";
                            }
                            
                        }
                echo "</div>";
            }
        }
    } else {
        if (!$result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {

                $id = $row["ID"];
                $sqlPicture = "SELECT * FROM Pictures WHERE Products_ID='$id' LIMIT 1";
                $resultPicture = $conn->query($sqlPicture);
                $rowPicture = $resultPicture->fetch_assoc();
                //  echo "{$search_value} and {$row["Title"]} = " . similar_text(strtolower($search_value), strtolower($row["Title"]));
                ?>
                <div class="okvir">
                <?php
                echo " Name: <a href='product.php?id=$id'>" . $row["Title"] . "</a><br> Cena: " . $row["Price"] . "<br><img src=" . $rowPicture["url"] . " alt=" . $rowPicture["Title"] . " height='60' width='100'>";
                ?>
                </div>
            <?php
        }
    } else {
        echo "Ni izdelkov";
    }
}
include "footer.html";
?>
