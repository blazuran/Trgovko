<?php
include_once "db.php"; 

if (isset($_POST['reg_user'])&&(
        "" != trim($_POST['name'])&&
        "" != trim($_POST['surname'])&&
        "" != trim($_POST['email'])&&
        "" != trim($_POST['password']))&&
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

    $select = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($connectionID));
    if(mysqli_num_rows($select)) {
        exit('This email is already being used');
    }
    else{
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $lastname = mysqli_real_escape_string($conn, $_POST['surname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash = hash('sha512', $password);

        $query = "INSERT INTO users (name, lastname, email, password) 
                VALUES('$name', '$lastname', '$email', '$hash')";
        mysqli_query($conn, $query);

        header('Location: login.php');
        exit;
    }
}
 else {
    echo 'Neuspešna prijava!';
}

?>