<?php
    include_once "session.php";
    include_once "db.php";
    if( $_SESSION['Admin']==1){
        $id = $_GET['id'];   
        $Name =$_POST['Name'];   
        $LastName =$_POST['LastName'];   
        $Email =$_POST['Email']; 
        if (isset($_POST['Spremeni'])){
            if (isset($_POST['Admin'])){
            $Admin2 =$_POST['Admin'];   
            $sql = "UPDATE Users
                    SET Name ='".$Name."', LastName ='".$LastName."' , Email='".$Email."' , Admin=1
                    WHERE ID=".$id."; ";
            }
            else
            {
            $sql = "UPDATE Users
                    SET Name ='".$Name."', LastName ='".$LastName."' , Email='".$Email."' , Admin=0
                    WHERE ID=".$id."; ";
            }   
        }
        else{
              $sql = "DELETE FROM Users WHERE ID=".$id."; ";
        }
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header('Location: admin.php');     
    exit;
?>
