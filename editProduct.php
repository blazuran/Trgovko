<?php
    include_once "session.php";
    include_once "db.php";
    if( $_SESSION['Admin']==1){
        $id = $_GET['id'];   
        $Title =$_POST['Title'];   
        $ProductURL =$_POST['ProductURL'];   
        $Price =$_POST['Price'];    
        $Rating =$_POST['Rating'];    
        $Description =$_POST['Description'];    
        $Categories =$_POST['Categories_ID']; 
        
        
        if (isset($_POST['Spremeni'])){
        $sql = "UPDATE Products
                SET Title ='".$Title."', ProductURL ='".$ProductURL."', Price=".$Price.", Rating=".$Rating.", Description='".$Description."',  Categories_ID=".$Categories."
                WHERE ID=".$id."; ";
        }
        else{
               $query = mysqli_query($conn, "DELETE FROM pictures WHERE Products_ID = $id");
              $sql = "DELETE FROM Products WHERE ID=".$id."; ";
        }
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    //header('Location: admin.php');     
    //exit;
?>
