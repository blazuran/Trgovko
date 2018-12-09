<?php
set_time_limit(6000000);

require('simple_html_dom.php');

$zacetni_link = 'http://www.agt.si';

$html = file_get_html('http://www.agt.si/racunalniska-oprema/maticneplosce/index.html');
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
	
	//foreach($html->find('div.item') as $izdelek) { 
	
		$datoteka = fopen("mreznaoprema_ostalo.txt", "a");
		fwrite($datoteka, $ime_mreza2 ->plaintext . "\n" .$cena_mreza2->plaintext. "\n" .$zacetni_link.$linkdostrani_mreza2. "\n");
		fclose($datoteka);
}
}