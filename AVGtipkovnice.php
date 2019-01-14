<?php
set_time_limit(6000000);

require('simple_html_dom.php');
require 'db.php';


$query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.agt.si'");
    $store_id = 0;
        if(mysqli_num_rows($query) == 0)
        {
            $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('agt.si', 'https://www.agt.si')");
            $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.agt.si'");
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        else 
        {
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
$html = file_get_html("TIPKOVNICE1.txt", true); 

//$html1 = $html -> find('div.view_p1');

foreach($html-> find('div.box') as $izdelek){
	
	$zacetni_link = 'http://www.agt.si';
	
	$ime = $izdelek ->find('a', 0);
	
	$cena = $izdelek ->find('div', 0);
        $cena = $cena->plaintext;
        $cena = str_replace("€", "", $cena);
        $cena = str_replace(",", ".", $cena);
	$linkdostrani = $ime->getAttribute('href');
		
	$html3 = file_get_html($zacetni_link.$linkdostrani);
	
	$opis = $html3->find('p', 0);
		
	$slika = $izdelek ->find('a', 1);
	
           
	
	echo 'Ime: ' . $ime ->plaintext  . '<br>';
        $title = $ime->plaintext;
	echo 'Slika: ' . $zacetni_link.$slika->getAttribute('href') . '<br>';
        $img = $zacetni_link.$slika->getAttribute('href');
	echo 'Cena: ' .$cena. '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani . '<br>' . '<br>';
        $linkInsert = $zacetni_link.$linkdostrani;
	echo 'Opis: ' .$opis. '</br>';
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $cena, '$date', '$opis', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Tipkovnice'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
        
}
?>