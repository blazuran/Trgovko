<?php 
include "header.php"; 

if(isset($_SESSION['Success']))
{
    if($_SESSION['Success'] == false)
    {
        $message = "Wrong email/password";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}

?>
<div class="bg" class="p-3 mb-2 bg-light text-dark">

    <div  class="login"">
    <form action="login_post.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vnesite email:">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Geslo:</label>
            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Vnesite geslo:">
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
