<?php
include "header.php";
include_once "db.php";
?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0 bgded" style="background-image:url('../Trgovko/Slike/ozadje1.jpg');">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <div class="overlay inspace-30 btmspace-30">
        <h2 class="heading">Pozdravljeni pri Trgovku</h2>
        <p>Veselo nakupovanje!</p>
      </div>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn inverse" href="#">Consequat</a></li>
          <li><a class="btn" href="#">Scelerisque</a></li>
        </ul>
      </footer>
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
    <div style="text-align: center; font-size:26pt; margin-top: 20px; font-family: 'Arial'"> Najbolj popularno! <br><br>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
    </div>



    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <ul class="nospace group center">

        <?php
/* pobrati podatke iz baze ter jih izpisati tukaj v div.
 * vsak izdelek v svojem divu, div poleg diva, 3-4 izdelki v vrsti MAX
 * začnemo z najpopularnejšimi nato vedno manj.
 */

//LIMIT koliko naj se jih prikaže na prvi strani
$sql = "SELECT * FROM `products` ORDER BY Rating DESC limit 10";
$result = $conn->query($sql);


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
        echo " Name: <a href='product.php?id=$id'>". $row["Title"]. "</a></h6><br> Cena: " . $row["Price"] . "€<br><img src=". $rowPicture["url"] ." alt=". $rowPicture["Title"] ." height='60' width='100'>";
        ?>
      </article>
      </li>
      </div>
        <?php
    }
} else {
    echo "Ni izdelkov";
}
?>
    </ul>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php
include "footer.html";
?>