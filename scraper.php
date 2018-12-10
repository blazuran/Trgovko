<!DOCTYPE html>
<html>
<head>
<body>
</body>
<meta charset ="UTF-8">

<Title>Web Scraper</Title
<form action="/action_page.php">
Izdelek: <input type="text" name="isci"><br>
<input type="submit" value="Isci">
</form><br><br><br>

<?php
require('simple_html_dom.php');
include "db.php";
$html = file_get_html('https://www.sestavi.si/index.php/items/display/244/245/telefoni');
$html1 = $html -> find('div.view_p1');
$sql_check_if_store_exists = "SELECT ID FROM stores WHERE StoreURL = 'https://www.sestavi.si'";
$query = mysqli_query($conn, $sql_check_if_store_exists);
$store_id = 0;

if(mysqli_num_rows($query) == 0)
{
    mysqli_query($conn, "INSERT INTO stores(Name,StoreURL) VALUES('sestavi.si','https://www.sestavi.si')");
    $query_get_store_id = mysqli_query($conn, "SELECT ID from stores WHERE Name = 'sestavi.si'");
    $row = mysqli_fetch_assoc($query_get_store_id);
    $store_id = $row['ID'];
}
else
{
    $query_get_store_id = mysqli_query($conn, "SELECT ID from stores WHERE Name = 'sestavi.si'");
    $row = mysqli_fetch_assoc($query_get_store_id);
    $store_id = $row['ID'];
}


foreach($html -> find('div.view_p1') as $html1){
foreach($html1->find('div[id]') as $izdelek) {
	
	
	
	$slika = $izdelek ->find('div.item_image', 0);
	
	$cena_spletna = $izdelek ->find('div.price_value_color', 0);
	
	$cena_bitcoin = $izdelek -> find('div.discount_value', 0);
	
	$dobavljivost = $izdelek ->find('div.discount_value', 2);

	$cena_trgovina = $izdelek ->find('div.reg_price_value', 0);
	
	$cena_razlika = $izdelek ->find('div.discount_value', 1);
	
	$link = $izdelek ->find('a.sc1', 0);
	//$odstrani = '">';
	//$samolink = explode(".si/", $link);
	//$samolink2 = explode(' "> ', $link);
	$linkdostrani = $link->getAttribute('href');
	
	/*$naslov = str_split($samolink[1]);
	do{array_pop($naslov);}while 
	(count($naslov)>strpos($samolink[1],'"'));
	$naslov = implode($naslov); */
		
	$firma = $izdelek ->find('div.brand_value' , 0);
	$html2 = file_get_html($linkdostrani);
	
	$garancija = $html2->find('div.discount_value', 4);
	
	$ime = $html2 ->find('h2.item', 0);
	
	$opis = $html2->find('td.desc', 0)->find('o1',0);
	
	$popust = $html2->find('div.discount_value', 0);
	
	echo 'Ime: ' . $ime ->plaintext . '<br>';	
	if ($slika != NULL){
	echo 'Slika: ' . $slika . '<br>';	
	}
	echo 'Znamka: ' . $firma . '<br>';	
	echo 'Cena na spletu: ' .$cena_spletna . '<br>';	
	echo 'Cena v trgovini: ' .$cena_trgovina . '<br>';	
	echo 'Razlika med cenami na spletu in v trgovini: ' .$cena_razlika . '<br>';	
	echo 'Cena v BitCoinih :' . $cena_bitcoin . '</br>';	
	echo 'Dobavljivost: ' . $dobavljivost . '<br>';
	echo 'Link: ' .$link->getAttribute('href') . '<br>' . '<br>';
		
	echo 'Garancija: ' .$garancija . '</br>';
	
	echo 'Opis: ' .$opis. '</br>';
	
	echo $opis . '<br>';
	
	echo 'Popust na spletu: ' .$popust . '<br>';
        $pos = strpos($cena_spletna, " €");
        echo "pos: ". $pos. '<br>';
        
	$priceToInsert = str_replace(",",".", substr($cena_spletna, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$link->getAttribute('href')."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",2)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
       // echo $sql_to_insert. '<br>';
//foreach($html->find('div.item') as $izdelek) {
	
		$datoteka = fopen("telefoni.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena_spletna ->plaintext. "\n" .$slika ->getAttribute('src'). "\n" .$linkdostrani. "\n" .$opis . "\n");
		fclose($datoteka);
	//}
	
	

	
//	$html2 = file_get_html('https://www.sestavi.si/' . $naslov);
	
	
	//$html2 = file_get_html($link);
	

	
}
}
		//TABLICE
$html3 = file_get_html('https://www.sestavi.si/index.php/items/display/226/227/tablet-pc');

foreach($html3->find('div.item') as $izdelek3) {
	
	
	
	$slika = $izdelek3 ->find('div.item_image', 0);
	
	$cena_spletna = $izdelek3 ->find('div.price_value_color', 0);
	
	$cena_bitcoin = $izdelek3 -> find('div.discount_value', 0);
	
	$dobavljivost = $izdelek3 ->find('div.discount_value', 2);

	$cena_trgovina = $izdelek3 ->find('div.reg_price_value', 0);
	
	$cena_razlika = $izdelek3 ->find('div.discount_value', 1);
	
	$link = $izdelek3 ->find('a.sc1', 0);
	$linkdostrani = $link->getAttribute('href');
		
	$firma = $izdelek3 ->find('div.brand_value' , 0);
	$html4 = file_get_html($linkdostrani);
	
	$garancija = $html4->find('div.discount_value', 4);
	
	$ime = $html4 ->find('h2.item', 0);
	
	$opis = $html4->find('td.desc', 0)->find('o1',0);
	
	$popust = $html4->find('div.discount_value', 0);
	
	echo 'Ime: ' . $ime ->plaintext . '<br>';	
	if ($slika != NULL){
	echo 'Slika: ' . $slika . '<br>';	
	}
	echo 'Znamka: ' . $firma . '<br>';	
	echo 'Cena na spletu: ' .$cena_spletna . '<br>';	
	echo 'Cena v trgovini: ' .$cena_trgovina . '<br>';	
	echo 'Razlika med cenami na spletu in v trgovini: ' .$cena_razlika . '<br>';	
	echo 'Cena v BitCoinih :' . $cena_bitcoin . '</br>';	
	echo 'Dobavljivost: ' . $dobavljivost . '<br>';
	echo 'Link: ' .$link->getAttribute('href') . '<br>' . '<br>';		
	echo 'Garancija: ' .$garancija . '</br>';	
	echo 'Opis: ' .$opis. '</br>';	
	echo $opis . '<br>';
	echo 'Popust na spletu: ' .$popust . '<br>';
		
        $priceToInsert = str_replace(",",".", substr($cena_spletna, 0, $pos));
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$link->getAttribute('href')."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",3)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
        
	$datoteka = fopen("tablice.txt", "a");
	fwrite($datoteka, $ime ->plaintext . "\n" .$cena_spletna ->plaintext. "\n" .$slika ->getAttribute('src'). "\n" .$linkdostrani. "\n" .$opis . "\n");
	fclose($datoteka);
}

$htmlM = file_get_html('https://www.sestavi.si/index.php/items/display/219/220/namizni-racunalniki');

foreach($htmlM->find('div.item')as $izdelekM) {
	 
	
	
	$slika = $izdelekM ->find('div.item_image', 0);
	
	$cena_spletna = $izdelekM ->find('div.price_value_color', 0);
	
	$cena_bitcoin = $izdelekM -> find('div.discount_value', 0);
	
	$dobavljivost = $izdelekM ->find('div.discount_value', 2);

	$cena_trgovina = $izdelekM ->find('div.reg_price_value', 0);
	
	$cena_razlika = $izdelekM ->find('div.discount_value', 1);
	
	$link = $izdelekM ->find('a.sc1', 0);
	//$odstrani = '">';
	//$samolink = explode(".si/", $link);
	//$samolink2 = explode(' "> ', $link);
	$linkdostrani = $link->getAttribute('href');
	
	/*$naslov = str_split($samolink[1]);
	do{array_pop($naslov);}while 
	(count($naslov)>strpos($samolink[1],'"'));
	$naslov = implode($naslov); */
		
	$firma = $izdelekM ->find('div.brand_value' , 0);
	$htmlM2 = file_get_html($linkdostrani);
	
	$garancija = $htmlM2->find('div.discount_value', 4);
	
	$ime = $htmlM2 ->find('h2.item', 0);
	
	$opis = $htmlM2->find('td.desc', 0)->find('o1',0);
	
	$popust = $htmlM2->find('div.discount_value', 0);
	
	echo 'Ime: ' . $ime ->plaintext . '<br>';	
	if ($slika != NULL){
	echo 'Slika: ' . $slika . '<br>';	
	}
	echo 'Znamka: ' . $firma . '<br>';	
	echo 'Cena na spletu: ' .$cena_spletna . '<br>';	
	echo 'Cena v trgovini: ' .$cena_trgovina . '<br>';	
	echo 'Razlika med cenami na spletu in v trgovini: ' .$cena_razlika . '<br>';	
	echo 'Cena v BitCoinih :' . $cena_bitcoin . '</br>';	
	echo 'Dobavljivost: ' . $dobavljivost . '<br>';
	echo 'Link: ' .$link->getAttribute('href') . '<br>' . '<br>';
		
	echo 'Garancija: ' .$garancija . '</br>';
	
	echo 'Opis: ' .$opis. '</br>';
	
	echo $opis . '<br>';
	
	echo 'Popust na spletu: ' .$popust . '<br>';
		
        $priceToInsert = str_replace(",",".", substr($cena_spletna, 0, $pos));
        //echo $priceToInsert. '<br>';
        $date = date("Y-m-d H:i:s");
        if($priceToInsert == null)
        {
            $priceToInsert = 0;
        }
        $sql_to_insert = "INSERT INTO products(Title, ProductURL, Price, DateTime, Description, Stores_ID, Categories_ID) VALUES('".$ime->plaintext."','".$link->getAttribute('href')."',".$priceToInsert.", '". $date ."', '".$opis."',".$store_id.",6)";
        $sql_insert_img = "INSERT INTO pictures(url, Title, Products_ID) VALUES('".$slika."', '".$ime->plaintext."', (SELECT ID FROM products WHERE Title  = '".$ime->plaintext."'))";
        mysqli_query($conn, $sql_to_insert);
        mysqli_query($conn, $sql_insert_img);
        
	//foreach($html->find('div.item') as $izdelek) {
	
		$datoteka = fopen("namizni_rac.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena_spletna ->plaintext. "\n" .$slika ->getAttribute('src'). "\n" .$linkdostrani. "\n" .$opis . "\n");
		fclose($datoteka);
}

?>


</body>
</html>