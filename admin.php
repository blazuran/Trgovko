<?php 
include "header.php"; 
include_once "db.php"; 
include_once "session.php";
?>
<?php 
echo "<a href='bigbang.php'> BigBang Scraper </a><a href='mlacom.php'> Mlacom Scraper </a><a href='markosoftscrap.php'> Markosoft Scraper </a> <a href='pricaraj.php'> Pricaraj scraper </a>";
 echo "<h1>Uporabniki</h1>";
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
        echo "<form action='editUsers.php?id=".$row['ID']. "' method='POST'>";
        echo "<tr>";
        echo "<td><input type='text' name='Name' value='" . $row['Name'] . "' /><br></td>";
        echo "<td><input type='text' name='LastName' value='" . $row['LastName'] . "' /><br></td>";
        echo "<td><input type='text' name='Email' value='" . $row['Email'] . "' /><br></td>";
        if($row['Admin']==1){
       echo "<td><input type='checkbox' name='Admin' value='1' checked='checked'/><br></td>";
            }
        else{
       echo "<td><input type='checkbox' name='Admin' value='0'/><br></td>";
            }
        echo "<td><input type='submit' name='Spremeni'  value='Spremeni' /></td>";
        echo "<td><input type='submit' name='Odstrani' value='Odstrani'></td>";
        echo "</tr>";
        echo "</form>";
    }
}
echo "</table>";
}
?>

<?php 
echo "<h1>Trgovine</h1>";
if(isset($_SESSION['Name']) && isset($_SESSION['Surname'])&& $_SESSION['Admin']==1)
{
$sql = "SELECT * FROM Stores";
$result = $conn->query($sql);
echo "<table border='1'>
<tr>
<th>Ime</th>
<th>URL trgovine</th>
<th>URL prikazne slike</th>
<th>Uredi</th>
<th>Odstrani</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form action='editStore.php?id=".$row['ID']. "' method='POST'>";
        echo "<tr>";
        echo "<td><input type='text' name='Name' value='" . $row['Name'] . "' /><br></td>";
        echo "<td><input type='text' name='StoreURL' value='" . $row['StoreURL'] . "' /><br></td>";
        echo "<td><input type='text' name='LogoURL' value='" . $row['LogoURL'] . "' /><br></td>";
        echo "<td><input type='submit' name='Spremeni'  value='Spremeni' /></td>";
        echo "<td><input type='submit' name='Odstrani' value='Odstrani'></td>";
        echo "</tr>";
        echo "</form>";
    }
}
echo "</table>";
}
?>
<?php 
echo "<h1>Izdelki</h1>";
if(isset($_SESSION['Name']) && isset($_SESSION['Surname'])&& $_SESSION['Admin']==1)
{
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
echo "<table border='1'>
<tr>
<th>Naziv</th>
<th>URL</th>
<th>Cena</th>
<th>Ocena</th>
<th>Opis</th>
<th>Kategorija</th>
<th>Uredi</th>
<th>Odstrani</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form action='editProduct.php?id=".$row['ID']. "' method='POST'>";
        echo "<tr>";
        echo "<td><input type='text' name='Title' value='" . $row['Title'] . "' /><br></td>";
        echo "<td><input type='text' name='ProductURL' value='" . $row['ProductURL'] . "' /><br></td>";
        echo "<td><input type='text' name='Price' value='" . $row['Price'] . "' /><br></td>";
        echo "<td><input type='text' name='Rating' value='" . $row['Rating'] . "' /><br></td>";
        echo "<td><input type='text' name='Description' value='" . $row['Description'] . "' /><br></td>";
        echo "<td><input type='text' name='Categories_ID' value='" . $row['Categories_ID'] . "' /><br></td>";
        echo "<td><input type='submit' name='Spremeni'  value='Spremeni' /></td>";
        echo "<td><input type='submit' name='Odstrani' value='Odstrani'></td>";
        echo "</tr>";
        echo "</form>";
    }
}
echo "</table>";
}
?>
<?php 
include "footer.php";
?>
