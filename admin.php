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
echo "<tr>";
echo "<td>" . $row['Name'] . "</td>";
echo "<td>" . $row['LastName'] . "</td>";
echo "<td>" . $row['Email'] . "</td>";
if($row['Admin']==1){
  echo "<td>" ."Da". "</td>";
    }
else{
    echo "<td>" ."Ne". "</td>";
    }
echo "<td>Uredi</td>";
echo "<td>Odstrani</td>";
echo "</tr>";
}}
echo "</table>";

}
?>
<?php 
include "footer.html"; 
?>
