<?php
set_time_limit(6000000);

require('simple_html_dom.php');


include "db.php";

$zacetni_link = 'http://www.agt.si';

$html = file_get_html('http://www.agt.si/racunalniska-oprema/opticneenote/index.html');


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
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        echo $sql_to_insert."<br>";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("opticne_prva.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena->plaintext. "\n" .$zacetni_link.$linkdostrani. "\n");
		fclose($datoteka);
}


$html_os = file_get_html('http://www.agt.si/racunalniska-oprema/osebni/index.html');
	foreach($html_os-> find('div.box') as $izdelek_os){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_os = $izdelek_os ->find('a', 0);
	
	$cena_os = $izdelek_os ->find('div', 0);

	$linkdostrani_os = $ime_os->getAttribute('href');
		
	$html_os = file_get_html($zacetni_link.$linkdostrani_os);
	
	$opis_os = $html_os->find('p', 0);
		
	$slika_os = $html_os ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_os ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_os . '<br>';	
	echo 'Cena: ' .$cena_os->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_os . '<br>' . '<br>';
	echo 'Opis: ' .$opis_os. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena, 0, strpos($cena, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$zacetni_link.$linkdostrani."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",6)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("osebni_prva.txt", "a");
		fwrite($datoteka, $ime_os ->plaintext . "\n" .$cena_os->plaintext. "\n" .$zacetni_link.$linkdostrani_os. "\n");
		fclose($datoteka);
}


$html_cpu = file_get_html('http://www.agt.si/racunalniska-oprema/procesorji/index.html');
	foreach($html_cpu-> find('div.box') as $izdelek_cpu){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_cpu = $izdelek_cpu ->find('a', 0);
	
	$cena_cpu = $izdelek_cpu ->find('div', 0);

	$linkdostrani_cpu = $ime_cpu->getAttribute('href');
		
	$html_cpu = file_get_html($zacetni_link.$linkdostrani_cpu);
	
	$opis_cpu = $html_cpu->find('p', 0);
		
	$slika_cpu = $html_cpu ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_cpu ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_cpu . '<br>';	
	echo 'Cena: ' .$cena_cpu->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_cpu . '<br>' . '<br>';
	echo 'Opis: ' .$opis_cpu. '</br>';
	
        $priceToInsert = str_replace(",",".", substr($cena_cpu, 0, strpos($cena_cpu, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_cpu->plaintext."','".$zacetni_link.$linkdostrani_cpu."',".$priceToInsert.", '". $date ."', '".$opis_cpu."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_cpu."', '".$ime_cpu->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_cpu->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("procesorji_prva.txt", "a");
		fwrite($datoteka, $ime_cpu ->plaintext . "\n" .$cena_cpu->plaintext. "\n" .$zacetni_link.$linkdostrani_cpu. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 15; $i++) {
	$html_cpu2 = file_get_html('http://www.agt.si/racunalniska-oprema/procesorji/index.'.$i.'.html');
	
foreach($html_cpu2-> find('div.box') as $izdelek_cpu2){
	
	$ime_cpu2 = $izdelek_cpu2 ->find('a', 0);
	
	$cena_cpu2 = $izdelek_cpu2 ->find('div', 0);

	$linkdostrani_cpu2 = $ime_cpu2->getAttribute('href');
		
	$html_cpu2 = file_get_html($zacetni_link.$linkdostrani_cpu2);
	
	$opis_cpu2 = $html_cpu2->find('p', 0);
		
	$slika_cpu2 = $html_cpu2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_cpu2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_cpu2 . '<br>';	
	echo 'Cena: ' .$cena_cpu2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_cpu2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_cpu2. '</br>';
	
        
        $priceToInsert = str_replace(",",".", substr($cena_cpu2, 0, strpos($cena_cpu2, "€")));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime_cpu2->plaintext."','".$zacetni_link.$linkdostrani_cpu2."',".$priceToInsert.", '". $date ."', '".$opis_cpu2."',".$store_id.",8)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$zacetni_link.$slika_cpu2."', '".$ime_cpu2->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime_cpu2->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("procesorji_ostalo.txt", "a");
		fwrite($datoteka, $ime_cpu2 ->plaintext . "\n" .$cena_cpu2->plaintext. "\n" .$zacetni_link.$linkdostrani_cpu2. "\n");
		fclose($datoteka);
}
}