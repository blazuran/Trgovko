<?php 
include "header.html"; 
//include_once "db.php"; 
?>
<div style="text-align: center; font-weight: 26pt; border: 1px solid black; float: left; width: 100%; padding: 25px;">
    <form action="register_post.php" method="POST">
        <div>Name: <input type="text" name="name" placeholder="Name..."></div><br>
        <div>Surname: <input type="text" name="surname" placeholder="Surname..."></div><br>
        <div>Email: <input type="email" name="email" placeholder="Email..."></div><br> 
        <div>Password: <input type="password" name="password" placeholder="Password..."></div><br>
        <input type="submit" name="reg_user" value="Potrdi">
    </form>
    
</div>



<?php 
// Uran plz poravnaj to haha
include "footer.html"; 
?>
