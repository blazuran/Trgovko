<?php
set_time_limit(6000000);

require('simple_html_dom.php');

$zacetni_link = 'http://www.agt.si';
include "db.php";



$html = file_get_html('http://www.agt.si/racunalniska-oprema/maticneplosce/index.html');

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
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("maticne_prva.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena->plaintext. "\n" .$zacetni_link.$linkdostrani. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html2 = file_get_html('http://www.agt.si/racunalniska-oprema/maticneplosce/index.'.$i.'.html');
	
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
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime2->plaintext."','".$zacetni_link.$linkdostrani2."',".$priceToInsert.", '". $date ."', '".$opis2."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika2."', '".$ime2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("maticne_ostalo.txt", "a");
		fwrite($datoteka, $ime2 ->plaintext . "\n" .$cena2->plaintext. "\n" . $zacetni_link.$linkdostrani2. "\n");
		fclose($datoteka);
}
}

$html_mis = file_get_html('http://www.agt.si/racunalniska-oprema/miske/index.html');
	foreach($html_mis-> find('div.box') as $izdelek_mis){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_mis = $izdelek_mis ->find('a', 0);
	
	$cena_mis = $izdelek_mis ->find('div', 0);

	$linkdostrani_mis = $ime_mis->getAttribute('href');
		
	$html_mis = file_get_html($zacetni_link.$linkdostrani_mis);
	
	$opis_mis = $html_mis->find('p', 0);
		
	$slika_mis = $html_mis ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_mis ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_mis . '<br>';	
	echo 'Cena: ' .$cena_mis->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_mis . '<br>' . '<br>';
	echo 'Opis: ' .$opis_mis. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_mis, 0, strpos($cena_mis, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_mis->plaintext."','".$zacetni_link.$linkdostrani_mis."',".$priceToInsert.", '". $date ."', '".$opis_mis."',".$store_id.",12)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_mis."', '".$ime_mis->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_mis->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("miske_prva.txt", "a");
		fwrite($datoteka, $ime_mis ->plaintext . "\n" .$cena_mis->plaintext. "\n" .$zacetni_link.$linkdostrani_mis. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html_mis2 = file_get_html('http://www.agt.si/racunalniska-oprema/miske/index.'.$i.'.html');
	
foreach($html_mis2-> find('div.box') as $izdelek_mis2){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_mis2 = $izdelek_mis2 ->find('a', 0);
	
	$cena_mis2 = $izdelek_mis2 ->find('div', 0);

	$linkdostrani_mis2 = $ime_mis2->getAttribute('href');
		
	$html_mis2 = file_get_html($zacetni_link.$linkdostrani_mis2);
	
	$opis_mis2 = $html_mis2->find('p', 0);
		
	$slika_mis2 = $html_mis2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_mis2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_mis2 . '<br>';	
	echo 'Cena: ' .$cena_mis2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_mis2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_mis2. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_mis2, 0, strpos($cena_mis2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_mis2->plaintext."','".$zacetni_link.$linkdostrani_mis2."',".$priceToInsert.", '". $date ."', '".$opis_mis2."',".$store_id.",12)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_mis2."', '".$ime_mis2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_mis2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("miske_ostalo.txt", "a");
		fwrite($datoteka, $ime_mis2 ->plaintext . "\n" .$cena_mis2->plaintext. "\n" .$zacetni_link.$linkdostrani_mis2. "\n");
		fclose($datoteka);
}
}

$html_mreza = file_get_html('http://www.agt.si/racunalniska-oprema/mrezna-oprema/index.html');
	foreach($html_mreza-> find('div.box') as $izdelek_mreza){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_mreza = $izdelek_mreza ->find('a', 0);
	
	$cena_mreza = $izdelek_mreza ->find('div', 0);

	$linkdostrani_mreza = $ime_mreza->getAttribute('href');
		
	$html_mreza = file_get_html($zacetni_link.$linkdostrani_mreza);
	
	$opis_mreza = $html_mreza->find('p', 0);
		
	$slika_mreza = $html_mreza ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_mreza ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_mreza . '<br>';	
	echo 'Cena: ' .$cena_mreza->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_mreza . '<br>' . '<br>';
	echo 'Opis: ' .$opis_mreza. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_mreza, 0, strpos($cena_mreza, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_mreza->plaintext."','".$zacetni_link.$linkdostrani_mreza."',".$priceToInsert.", '". $date ."', '".$opis_mreza."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_mreza."', '".$ime_mreza->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_mreza->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("mreznaoprema_prva.txt", "a");
		fwrite($datoteka, $ime_mreza ->plaintext . "\n" .$cena_mreza->plaintext. "\n" .$zacetni_link.$linkdostrani_mreza. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html_mreza2 = file_get_html('http://www.agt.si/racunalniska-oprema/mrezna-oprema/index.'.$i.'.html');
	
foreach($html_mreza2-> find('div.box') as $izdelek_mreza2){
	
	$ime_mreza2 = $izdelek_mreza2 ->find('a', 0);
	
	$cena_mreza2 = $izdelek_mreza2 ->find('div', 0);

	$linkdostrani_mreza2 = $ime_mreza2->getAttribute('href');
		
	$html_mreza2 = file_get_html($zacetni_link.$linkdostrani_mreza2);
	
	$opis_mreza2 = $html_mreza2->find('p', 0);
		
	$slika_mreza2 = $html_mreza2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_mreza2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_mreza2 . '<br>';	
	echo 'Cena: ' .$cena_mreza2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_mreza2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_mreza2. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_mreza2, 0, strpos($cena_mreza2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_mreza2->plaintext."','".$zacetni_link.$linkdostrani_mreza2."',".$priceToInsert.", '". $date ."', '".$opis_mreza2."',".$store_id.",7)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_mreza2."', '".$ime_mreza2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_mreza2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("mreznaoprema_ostalo.txt", "a");
		fwrite($datoteka, $ime_mreza2 ->plaintext . "\n" .$cena_mreza2->plaintext. "\n" .$zacetni_link.$linkdostrani_mreza2. "\n");
		fclose($datoteka);
}
}