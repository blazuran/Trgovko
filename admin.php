<?php 
include "header.php"; 
include_once "db.php"; 
include_once "session.php";
?>
<?php 
if(isset($_SESSION['Name']) && isset($_SESSION['Surname'])&& $_SESSION['Admin']==1)
{
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
echo "<table border='1'>
<tr>
<th>Ime</th>
<th>Priimek</th>
<th>Email</th>
<th>Administrator</th>
<th>Uredi</th>
<th>Odstrani</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form action='edit.php?edit=<?= ".$row['ID']. "?>' method='POST'>";
        echo "<tr>";
        echo "<td><input type='text' name='Name' value='" . $row['Name'] . "' /><br></td>";
        echo "<td><input type='text' name='LastName' value='" . $row['LastName'] . "' /><br></td>";
        echo "<td><input type='text' name='Email' value='" . $row['Email'] . "' /><br></td>";
        if($row['Admin']==1){
       echo "<td><input type='checkbox' name='Admin' value='true' checked='checked'/><br></td>";
            }
        else{
       echo "<td><input type='checkbox' name='Admin' value='false'/><br></td>";
            }
        echo "<td><input type='submit' value='Spremeni' /></td>";
        echo "<td><a href='deleterow.php?id='".$row['ID']."'>Odstrani</a></td>";
        echo "</tr>";
        echo "</form>";
    }
}
echo "</table>";
}
?>

<?php 
include "footer.html"; 
?>
