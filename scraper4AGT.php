<?php
set_time_limit(6000000);

require('simple_html_dom.php');

$zacetni_link = 'http://www.agt.si';
include "db.php";

$html = file_get_html('http://www.agt.si/racunalniska-oprema/multimedija/index.html');

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
	
        $priceToInsert = str_replace(",",".", substr($cena, 0, strpos($cena, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",9)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("multimedija_prva.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena->plaintext. "\n" .$zacetni_link.$linkdostrani. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html2 = file_get_html('http://www.agt.si/racunalniska-oprema/multimedija/index.'.$i.'.html');
	
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
	
        $priceToInsert = str_replace(",",".", substr($cena2, 0, strpos($cena2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime2->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis2."',".$store_id.",9)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika2."', '".$ime2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("multimedija_ostalo.txt", "a");
		fwrite($datoteka, $ime2 ->plaintext . "\n" .$cena2->plaintext. "\n" . $zacetni_link.$linkdostrani2. "\n");
		fclose($datoteka);
}
}

$html_nap = file_get_html('http://www.agt.si/racunalniska-oprema/napajalniki/index.html');
	foreach($html_nap-> find('div.box') as $izdelek_nap){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_nap = $izdelek_nap ->find('a', 0);
	
	$cena_nap = $izdelek_nap ->find('div', 0);

	$linkdostrani_nap = $ime_nap->getAttribute('href');
		
	$html_nap = file_get_html($zacetni_link.$linkdostrani_nap);
	
	$opis_nap = $html_nap->find('p', 0);
		
	$slika_nap = $html_nap ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_nap ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_nap . '<br>';	
	echo 'Cena: ' .$cena_nap->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_nap . '<br>' . '<br>';
	echo 'Opis: ' .$opis_nap. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_nap, 0, strpos($cena_nap, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_nap->plaintext."','".$zacetni_link.$linkdostrani_nap."',".$priceToInsert.", '". $date ."', '".$opis_nap."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_nap."', '".$ime_nap->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_nap->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("napajalniki_prva.txt", "a");
		fwrite($datoteka, $ime_nap ->plaintext . "\n" .$cena_nap->plaintext. "\n" .$zacetni_link.$linkdostrani_nap. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html_nap2 = file_get_html('http://www.agt.si/racunalniska-oprema/napajalniki/index.'.$i.'.html');
	
foreach($html_nap2-> find('div.box') as $izdelek_nap2){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_nap2 = $izdelek_nap2 ->find('a', 0);
	
	$cena_nap2 = $izdelek_nap2 ->find('div', 0);

	$linkdostrani_nap2 = $ime_nap2->getAttribute('href');
		
	$html_nap2 = file_get_html($zacetni_link.$linkdostrani_nap2);
	
	$opis_nap2 = $html_nap2->find('p', 0);
		
	$slika_nap2 = $html_nap2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_nap2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_nap2 . '<br>';	
	echo 'Cena: ' .$cena_nap2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_nap2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_nap2. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_nap2, 0, strpos($cena_nap2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_nap2->plaintext."','".$zacetni_link.$linkdostrani_nap2."',".$priceToInsert.", '". $date ."', '".$opis_nap2."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_nap2."', '".$ime_nap2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_nap2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("napajalniki_ostalo.txt", "a");
		fwrite($datoteka, $ime_nap2 ->plaintext . "\n" .$cena_nap2->plaintext. "\n" .$zacetni_link.$linkdostrani_nap2. "\n");
		fclose($datoteka);
}
}

$html_ohi = file_get_html('http://www.agt.si/racunalniska-oprema/ohisja/index.html');
	foreach($html_ohi-> find('div.box') as $izdelek_ohi){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_ohi = $izdelek_ohi ->find('a', 0);
	
	$cena_ohi = $izdelek_ohi ->find('div', 0);

	$linkdostrani_ohi = $ime_ohi->getAttribute('href');
		
	$html_ohi = file_get_html($zacetni_link.$linkdostrani_ohi);
	
	$opis_ohi = $html_ohi->find('p', 0);
		
	$slika_ohi = $html_ohi ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_ohi ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_ohi . '<br>';	
	echo 'Cena: ' .$cena_ohi->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_ohi . '<br>' . '<br>';
	echo 'Opis: ' .$opis_ohi. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_ohi, 0, strpos($cena_ohi, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_ohi->plaintext."','".$zacetni_link.$linkdostrani_ohi."',".$priceToInsert.", '". $date ."', '".$opis_ohi."',".$store_id.",10)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_ohi."', '".$ime_ohi->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_ohi->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("ohisja_prva.txt", "a");
		fwrite($datoteka, $ime_ohi ->plaintext . "\n" .$cena_ohi->plaintext. "\n" .$zacetni_link.$linkdostrani_ohi. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 15; $i++) {
	$html_ohi2 = file_get_html('http://www.agt.si/racunalniska-oprema/ohisja/index.'.$i.'.html');
	
foreach($html_ohi2-> find('div.box') as $izdelek_ohi2){
	
	$ime_ohi2 = $izdelek_ohi2 ->find('a', 0);
	
	$cena_ohi2 = $izdelek_ohi2 ->find('div', 0);

	$linkdostrani_ohi2 = $ime_ohi2->getAttribute('href');
		
	$html_ohi2 = file_get_html($zacetni_link.$linkdostrani_ohi2);
	
	$opis_ohi2 = $html_ohi2->find('p', 0);
		
	$slika_ohi2 = $html_ohi2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_ohi2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_ohi2 . '<br>';	
	echo 'Cena: ' .$cena_ohi2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_ohi2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_ohi2. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_ohi2, 0, strpos($cena_ohi2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_ohi2->plaintext."','".$zacetni_link.$linkdostrani_ohi2."',".$priceToInsert.", '". $date ."', '".$opis_ohi2."',".$store_id.",10)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_ohi2."', '".$ime_ohi2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_ohi2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("ohisja_ostalo.txt", "a");
		fwrite($datoteka, $ime_ohi2 ->plaintext . "\n" .$cena_ohi2->plaintext. "\n" .$zacetni_link.$linkdostrani_ohi2. "\n");
		fclose($datoteka);
}
}