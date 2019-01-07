<?php 
include "header.php"; 
?>

    <div  class="login" ">
        <form action="register_post.php" method="POST">
                <label for="ime">Ime:</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Ime">

                <label for="priimek">Priimek:</label>
                <input type="text" name="surname" class="form-control" id="surname" aria-describedby="surname" placeholder="Priimek">

                <label for="exampleInputEmail1">Email:</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">

                <label for="exampleInputPassword1">Geslo:</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Geslo"> <br> <br>

            <button type="reset" class="btn inverse" value="reset">Nazaj</button>
            <button type="submit" name="reg_user" class="btn" value="Potrdi">Potrdi</button> <br> <br>
            <a href="">Ste pozabili geslo?</a>
        </form>
</div>
</div>
<br><br>
<?php
include "footer.php";
?>
