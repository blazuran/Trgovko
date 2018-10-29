<?php 
include "header.html"; 
//include_once "db.php"; 
?>
<div style="text-align: center; font-weight: 26pt; border: 1px solid black; float: left; width: 100%; padding: 25px;">
    <form action="" method="POST">
        <div>Name: <input type="text" name="new_name" placeholder="Name..."></div><br>
        <div>Surname: <input type="text" name="new_surname" placeholder="Surname..."></div><br>
        <div>Username: <input type="text" name="new_username" placeholder="Username..."></div><br>
        <div>Password: <input type="password" name="new_password" placeholder="Password..."></div><br>
        <div>Email: <input type="email" name="new_email" placeholder="Email..."></div><br> 
        <input type="submit" value="Potrdi">
    </form>
    
</div>



<?php 
// Uran plz poravnaj to haha
include "footer.html"; 
?>
