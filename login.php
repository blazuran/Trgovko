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


<div class="login">
    <form action="login_post.php" method="POST">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Vnesite email:">
            <label for="exampleInputPassword1">Geslo:</label>
            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Vnesite geslo:"> <br><br>
        <button type="reset" class="btn inverse " value="reset">Nazaj</button>
        <button type="submit" class="btn" value="Potrdi">Potrdi</button> <br><br>
        <a href="">Ste pozabili geslo?</a>
    </form>

    </div>
<br><br>
<?php 
include "footer.php";
?>
