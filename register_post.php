<?php
include_once "db.php"; 

$name = mysqli_real_escape_string($conn, $_POST['name']);
$lastname = mysqli_real_escape_string($conn, $_POST['surname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "INSERT INTO users (name, lastname, email, password) 
  	VALUES('$name', '$lastname', '$email', '$password')";
mysqli_query($conn, $query);


header('Location: login.php');
exit;
?>