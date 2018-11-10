<?php 
include "header.php"; 
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">

    <div  class="login" ">
        <form action="register_post.php" method="POST">

            <div class="form-group">
                <label for="ime">Ime:</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Ime">
            </div>

            <div class="form-group">
                <label for="priimek">Priimek:</label>
                <input type="text" name="surname" class="form-control" id="surname" aria-describedby="surname" placeholder="Priimek">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email:</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Geslo:</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Geslo">
            </div>

            <button type="reset" class="btn btn-outline-danger" value="reset">Nazaj</button>
            <button type="submit" name="reg_user" class="btn btn-outline-primary" value="Potrdi">Potrdi</button> <br>
            <a href="">Ste pozabili geslo?</a>
        </form>
    </div>
</div>
<?php
include "footer.html"; 
?>
