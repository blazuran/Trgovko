<?php
set_time_limit(6000000);

require('simple_html_dom.php');

$zacetni_link = 'http://www.agt.si';

$html = file_get_html('http://www.agt.si/racunalniska-oprema/tipkovnice/index.html');
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
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("tipkovnice_prva.txt", "a");
		fwrite($datoteka, $ime ->plaintext . "\n" .$cena->plaintext. "\n" .$zacetni_link.$linkdostrani. "\n");
		fclose($datoteka);
}

$html_disk = file_get_html('http://www.agt.si/racunalniska-oprema/trdidiski/index.html');
	foreach($html_disk-> find('div.box') as $izdelek_disk){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_disk = $izdelek_disk ->find('a', 0);
	
	$cena_disk = $izdelek_disk ->find('div', 0);

	$linkdostrani_disk = $ime_disk->getAttribute('href');
		
	$html_disk = file_get_html($zacetni_link.$linkdostrani_disk);
	
	$opis_disk = $html_disk->find('p', 0);
		
	$slika_disk = $html_disk ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_disk ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_disk . '<br>';	
	echo 'Cena: ' .$cena_disk->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_disk . '<br>' . '<br>';
	echo 'Opis: ' .$opis_disk. '</br>';
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("diski_prva.txt", "a");
		fwrite($datoteka, $ime_disk ->plaintext . "\n" .$cena_disk->plaintext. "\n" .$zacetni_link.$linkdostrani_disk. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 10; $i++) {
	$html_disk2 = file_get_html('http://www.agt.si/racunalniska-oprema/trdidiski/index.'.$i.'.html');
	
foreach($html_disk2-> find('div.box') as $izdelek_disk2){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_disk2 = $izdelek_disk2 ->find('a', 0);
	
	$cena_disk2 = $izdelek_disk2 ->find('div', 0);

	$linkdostrani_disk2 = $ime_disk2->getAttribute('href');
		
	$html_disk2 = file_get_html($zacetni_link.$linkdostrani_disk2);
	
	$opis_disk2 = $html_disk2->find('p', 0);
		
	$slika_disk2 = $html_disk2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_disk2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_disk2 . '<br>';	
	echo 'Cena: ' .$cena_disk2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_disk2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_disk2. '</br>';
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("diski_ostalo.txt", "a");
		fwrite($datoteka, $ime_disk2 ->plaintext . "\n" .$cena_disk2->plaintext. "\n" .$zacetni_link.$linkdostrani_disk2. "\n");
		fclose($datoteka);
}
}

$html_hl = file_get_html('http://www.agt.si/racunalniska-oprema/zracnahlajenja/index.html');
	foreach($html_hl-> find('div.box') as $izdelek_hl){
	
	//$zacetni_link = 'http://www.agt.si';
	
	$ime_hl = $izdelek_hl ->find('a', 0);
	
	$cena_hl = $izdelek_hl ->find('div', 0);

	$linkdostrani_hl = $ime_hl->getAttribute('href');
		
	$html_hl = file_get_html($zacetni_link.$linkdostrani_hl);
	
	$opis_hl = $html_hl->find('p', 0);
		
	$slika_hl = $html_hl ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_hl ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_hl . '<br>';	
	echo 'Cena: ' .$cena_hl->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_hl . '<br>' . '<br>';
	echo 'Opis: ' .$opis_hl. '</br>';
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("hlajenja_prva.txt", "a");
		fwrite($datoteka, $ime_hl ->plaintext . "\n" .$cena_hl->plaintext. "\n" .$zacetni_link.$linkdostrani_hl. "\n");
		fclose($datoteka);
}

for ($i = 2; $i < 15; $i++) {
	$html_hl2 = file_get_html('http://www.agt.si/racunalniska-oprema/zracnahlajenja/index.'.$i.'.html');
	
foreach($html_hl2-> find('div.box') as $izdelek_hl2){
	
	$ime_hl2 = $izdelek_hl2 ->find('a', 0);
	
	$cena_hl2 = $izdelek_hl2 ->find('div', 0);

	$linkdostrani_hl2 = $ime_hl2->getAttribute('href');
		
	$html_hl2 = file_get_html($zacetni_link.$linkdostrani_hl2);
	
	$opis_hl2 = $html_hl2->find('p', 0);
		
	$slika_hl2 = $html_hl2 ->find('a.img', 0);
	

	
	echo 'Ime: ' . $ime_hl2 ->plaintext  . '<br>';	
	echo 'Slika: ' . $zacetni_link.$slika_hl2 . '<br>';	
	echo 'Cena: ' .$cena_hl2->plaintext . '<br>';	
	echo 'Link: ' .$zacetni_link.$linkdostrani_hl2 . '<br>' . '<br>';
	echo 'Opis: ' .$opis_hl2. '</br>';
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("hlajenja_ostalo.txt", "a");
		fwrite($datoteka, $ime_hl2 ->plaintext . "\n" .$cena_hl2->plaintext. "\n" .$zacetni_link.$linkdostrani_hl2. "\n");
		fclose($datoteka);
}
}