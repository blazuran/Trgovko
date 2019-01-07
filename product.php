<?php 
include "header.php"; 
include_once "db.php";
?>


    <div class="wrapper row3">

        <main class="hoc container clear">

            <ul class="nospace group center">
                <h6 style="position:center;">Trgovanje</h6>
                <li class="quarter first btmspace-30">
                    <article class="block inspace-30 borderedbox">
                        <h6 class="font-x1">

    <?php
    $id =$_GET['id'];
    //Remove LIMIT 1 to show/do this to all results.
    $sql = 'SELECT * FROM products WHERE ID = '.$id.' LIMIT 1';
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);

    // Echo page content
    echo $row['Title'];
    
    $id = $row["ID"];
    $query = mysqli_query($conn, "SELECT * FROM favorites WHERE Products_ID='$id' LIMIT 1");
    
    if (!$query)
    {
        die('Error: ' . mysqli_error($conn));
    }


    if(isset($_SESSION['ID'])){
        if(mysqli_num_rows($query) > 0){
            echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ." Priljubljen izdelek<br><br>";
        }else{
            echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ." <a href='addfavorite.php?id=$id'>Dodaj med priljubljene.</a> <br><br>";
        }
    }else
    {
        echo "<br> Name:<a href=". $row["ProductURL"] .">". $row["Title"]. "</a>  Cena:" . $row["Price"] . "\n\nOpis: " . $row["Description"] ." <br><br> ";
    }
    
        $sqlPicture = "SELECT * FROM Pictures INNER JOIN Products ON products.ID = Pictures.Products_ID WHERE Products_ID=$id ";
    $resultPicture = $conn->query($sqlPicture);
    
    
    if ($resultPicture->num_rows > 0) {
        // nedela za slike na samo na favorites
        while($rowPicture = $resultPicture->fetch_assoc()) {
            echo "<img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='200' width='200'>";
        }
    }
    
    ?>
    </div>
</article> </li>
</ul>
<div class="clear"></div>
</main>
</div>
<?php
include "footer.php";
?>
