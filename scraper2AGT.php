<?php
set_time_limit(6000000);

require('simple_html_dom.php');
include "db.php";
$zacetni_link = 'http://www.agt.si';

$html = file_get_html('http://www.agt.si/racunalniska-oprema/monitorji/index.html');

$sql_check_if_store_exists = "SELECT ID FROM stores WHERE StoreURL = 'http://www.agt.si'";
$query = mysqli_query($conn, $sql_check_if_store_exists);
$store_id = 0;

if(mysqli_num_rows($query) == 0)
{
    mysqli_query($conn, "INSERT INTO stores(Name,StoreURL) VALUES('agt.si','http://www.agt.si')");
    $query_get_store_id = mysqli_query($conn, "SELECT ID from stores WHERE Name = 'agt.si'");
    $row = mysqli_fetch_assoc($query_get_store_id);
    $store_id = $row['ID'];
}
else
{
    $query_get_store_id = mysqli_query($conn, "SELECT ID from stores WHERE Name = 'agt.si'");
    $row = mysqli_fetch_assoc($query_get_store_id);
    $store_id = $row['ID'];
}
//NASLOV, CENA, IMG, LINK
	foreach($html-> find('div.box') as $izdelek){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime = $izdelek ->find('a', 0);
	
	$cena = $izdelek ->find('div', 0);

	$linkdostrani = $ime->getAttribute('href');
		
	$html3 = file_get_html($zacetni_link.$linkdostrani);
	
	$opis = $html3->find('p', 0);
		
	$slika = $html3 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika . '<br>';	
	echo 'Cena: ' .$cena->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani . '<br>' . '<br>';
	echo 'Opis: ' .$opis. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("monitorji_prva.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena->plaintext. "\n" .$zacetni_link.$linkdostrani. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html2 = file_get_html('http://www.agt.si/racunalniska-oprema/monitorji/index.'.$i.'.html');
	
foreach($html2-> find('div.box') as $izdelek2){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime2 = $izdelek2 ->find('a', 0);
	
	$cena2 = $izdelek2 ->find('div', 0);

	$linkdostrani2 = $ime2->getAttribute('href');
		
	$html4 = file_get_html($zacetni_link.$linkdostrani2);
	
	$opis2 = $html4->find('p', 0);
			
	$slika2 = $html4 ->find('a.img', 0);

	
	echo 'Ime: ' . $ime2 ->plaintext  . '<br>';	
	echo 'Slika: ' .$zacetni_link.$slika2 . '<br>';	
	echo 'Cena: ' .$cena2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis2. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena2, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime2->plaintext."','".$zacetni_link.$linkdostrani2."',".$priceToInsert.", '". $date ."', '".$opis2."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika2."', '".$ime2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("monitorji_ostalo.txt", "a");
		fwrite($datoteka, $ime2 ->plaintext . "\n" .$cena2->plaintext. "\n" . $zacetni_link.$linkdostrani2. "\n");
		fclose($datoteka);
}
}

$html_graf = file_get_html('http://www.agt.si/racunalniska-oprema/graficnekartice/index.html');
	foreach($html_graf-> find('div.box') as $izdelek_graf){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_graf = $izdelek_graf ->find('a', 0);
	
	$cena_graf = $izdelek_graf ->find('div', 0);

	$linkdostrani_graf = $ime_graf->getAttribute('href');
		
	$html_graf = file_get_html($zacetni_link.$linkdostrani_graf);
	
	$opis_graf = $html_graf->find('p', 0);
		
	$slika_graf = $html_graf ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_graf ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_graf . '<br>';	
	echo 'Cena: ' .$cena_graf->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_graf . '<br>' . '<br>';
	echo 'Opis: ' .$opis_graf. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_graf, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_graf->plaintext."','".$zacetni_link.$linkdostrani_graf."',".$priceToInsert.", '". $date ."', '".$opis_graf."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_graf."', '".$ime_graf->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_graf->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("graficne_prva.txt", "a");
		fwrite($datoteka, $ime_graf ->plaintext . "\n" .$cena_graf->plaintext. "\n" .$zacetni_link.$linkdostrani_graf. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 15; $i++) {
	$html_graf2 = file_get_html('http://www.agt.si/racunalniska-oprema/graficnekartice/index.'.$i.'.html');
	
foreach($html_graf2-> find('div.box') as $izdelek_graf2){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_graf2 = $izdelek_graf2 ->find('a', 0);
	
	$cena_graf2 = $izdelek_graf2 ->find('div', 0);

	$linkdostrani_graf2 = $ime_graf2->getAttribute('href');
		
	$html_graf2 = file_get_html($zacetni_link.$linkdostrani_graf2);
	
	$opis_graf2 = $html_graf2->find('p', 0);
		
	$slika_graf2 = $html_graf2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_graf2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_graf2 . '<br>';	
	echo 'Cena: ' .$cena_graf2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_graf2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_graf2. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_graf2, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_graf2->plaintext."','".$zacetni_link.$linkdostrani_graf2."',".$priceToInsert.", '". $date ."', '".$opis_graf2."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_graf2."', '".$ime_graf2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_graf->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("graficne_ostalo.txt", "a");
		fwrite($datoteka, $ime_graf2 ->plaintext . "\n" .$cena_graf2->plaintext. "\n" .$zacetni_link.$linkdostrani_graf2. "\n");
		fclose($datoteka);
}
}

$html_ram = file_get_html('http://www.agt.si/racunalniska-oprema/spomin/index.html');
	foreach($html_ram-> find('div.box') as $izdelek_ram){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_ram = $izdelek_ram ->find('a', 0);
	
	$cena_ram = $izdelek_ram ->find('div', 0);

	$linkdostrani_ram = $ime_ram->getAttribute('href');
		
	$html_ram = file_get_html($zacetni_link.$linkdostrani_ram);
	
	$opis_ram = $html_ram->find('p', 0);
		
	$slika_ram = $html_ram ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_ram ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_ram . '<br>';	
	echo 'Cena: ' .$cena_ram->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_ram . '<br>' . '<br>';
	echo 'Opis: ' .$opis_ram. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_ram, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_ram->plaintext."','".$zacetni_link.$linkdostrani_ram."',".$priceToInsert.", '". $date ."', '".$opis_ram."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_ram."', '".$ime_ram->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_ram->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
        
	//foreach($html->find('div.item') as $izdelek) { 
        
		$datoteka = fopen("ram_prva.txt", "a");
		fwrite($datoteka, $ime_ram ->plaintext . "\n" .$cena_ram->plaintext. "\n" .$zacetni_link.$linkdostrani_ram. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 15; $i++) {
	$html_ram2 = file_get_html('http://www.agt.si/racunalniska-oprema/spomin/index.'.$i.'.html');
	
foreach($html_ram2-> find('div.box') as $izdelek_ram2){
	
	$ime_ram2 = $izdelek_ram2 ->find('a', 0);
	
	$cena_ram2 = $izdelek_ram2 ->find('div', 0);

	$linkdostrani_ram2 = $ime_ram2->getAttribute('href');
		
	$html_ram2 = file_get_html($zacetni_link.$linkdostrani_ram2);
	
	$opis_ram2 = $html_ram2->find('p', 0);
		
	$slika_ram2 = $html_ram2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_ram2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_ram2 . '<br>';	
	echo 'Cena: ' .$cena_ram2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_ram2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_ram2. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_ram2, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_ram2->plaintext."','".$zacetni_link.$linkdostrani_ram2."',".$priceToInsert.", '". $date ."', '".$opis_ram2."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_ram2."', '".$ime_ram2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_ram2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("ram_ostalo.txt", "a");
		fwrite($datoteka, $ime_ram2 ->plaintext . "\n" .$cena_ram2->plaintext. "\n" .$zacetni_link.$linkdostrani_ram2. "\n");
		fclose($datoteka);
}
}