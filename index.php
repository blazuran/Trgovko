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
                </footer>
            </article>
            <!-- ################################################################################################ -->
        </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div id="nakupovanje" style="text-align: center; font-size:26pt; margin-top: 20px; font-family: 'Arial'"> Najbolj
        popularno! <br>
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
                $sql = "SELECT * FROM `products` ORDER BY Rating DESC limit 6";
                $result = $conn->query($sql);


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
                                    echo "Name: <a href='product.php?id=$id'>".$row['Title']."</a><br>"; if(isset($rowPicture['url'])){echo "<img src=".$rowPicture['url']." alt=".$rowPicture['Title']." height='60' width='100'>";} else{echo  "<img src='../Trgovko/Slike/icon.png'>";}
                            echo "<br> Cena: " . $row["Price"] . " </article> </li>"; //za oceno še zrovn pa sliko po možnosti
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
include "footer.php";
?>