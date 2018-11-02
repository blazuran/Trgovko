<?php 
include "header.html"; 
//include_once "db.php"; 
?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">

    <div  class="login" style="text-align: center; width:300px; padding: 25px;">
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" name="new_username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vnesite email:">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Geslo:</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Vnesite geslo:">
        </div>
        <button type="reset" class="btn btn-outline-danger" value="reset">Nazaj</button>
        <button type="submit" class="btn btn-outline-primary" value="Potrdi">Potrdi</button> <br>
        <a href="">Ste pozabili geslo?</a>
    </form>
    </div>
</div>

<?php 
include "footer.html"; 
?>
