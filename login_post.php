<?php
include_once 'db.php';
include_once "session.php";
if(isset($_POST['email']) && isset($_POST['pass']))
{
    $mail = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $hash = hash('sha512', $pass);
    print_r($_POST);
    $sql_query = "SELECT * FROM Users WHERE Email ='".$mail."' AND Password = '".$hash."'";

    $query = mysqli_query($conn, $sql_query) or exit(mysqli_error($connectionID));
    if(mysqli_num_rows($query) == 1)
    {
        $row = mysqli_fetch_assoc($query);
        
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Surname'] = $row['LastName'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Admin'] = $row['Admin'];
        
        $_SESSION['Success'] = true;
        print_r($_SESSION);
        header("Location: index.php");
    }
    else
    {
        $_SESSION['Success'] = false;
        header("Location: login.php");
    }
}
else
{
    $_SESSION['Success'] = false;
    header("Location: login.php");
}
