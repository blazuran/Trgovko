<?php
include_once "session.php";
include_once 'db.php';
$sql  = "SELECT DateTime FROM Products WHERE ID = 1";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) == 1)
{
   $row = mysqli_fetch_assoc($query);
   $timeFromDB = strtotime($row['DateTIme']);
   if(time()-$timeFromDB >= 43200 )
   {
      //klic webscraperju, ko pride user na spletno stran 
   }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html xmlns:style="http://www.w3.org/1999/xhtml">
<head>
    <title>Trgovko</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- STARS RATING -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- STARS RATING -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"> <img src="./Pics/Logo.png" alt="Logo" style="width:10em;height:3em" ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto" style="margin-left: 88%">
            <?php
            if(isset($_SESSION['Name']) && isset($_SESSION['Surname']))
            {
                echo "<li class='nav-item'>";
                echo "<a href='favorites.php' class='h5'><button type='button' class='btn btn-outline-primary'>Priljubljeno</button></a>";
                echo "</li>";
                echo "<li class='nav-item' style='margin-left: 10px'>";
                echo "<a href='logout.php' class='h5'><button type='button' class='btn btn-outline-secondary'>Odjava</button></a>";
                echo "</li>";
            }
            else
            {
                echo "<li class='nav-item'>";
                echo "<a href='login.php' class='h5'><button type='button' class='btn btn-outline-primary'>Prijava</button></a>";
                echo "</li>";
                echo "<li class='nav-item' style='margin-left: 10px'>";
                echo "<a href='register.php' class='h5'><button type='button' class='btn btn-outline-secondary'> Registracija</button></a>";
                echo "</li>";
            }
            ?>
        </ul>

    </div>
</nav>
