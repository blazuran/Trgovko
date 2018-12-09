<?php
    include_once "session.php";
    include_once "db.php";
    if( $_SESSION['Admin']==1){
        $id = $_GET['id'];   
        $Name =$_POST['Name'];   
        $StoreURL =$_POST['StoreURL'];   
        $LogoURL =$_POST['LogoURL']; 
        
        if (isset($_POST['Spremeni'])){
        $sql = "UPDATE Stores
                SET Name ='".$Name."', StoreURL ='".$StoreURL."' , LogoURL='".$LogoURL."'
                WHERE ID=".$id."; ";
        }
        else{
              $sql = "DELETE FROM Stores WHERE ID=".$id."; ";
        }
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
  //  header('Location: admin.php');     
   // exit;
?>
