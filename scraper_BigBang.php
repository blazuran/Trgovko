<?php

/* Za samo eden izdelek 
  $html = file_get_html('https://www.bigbang.si/prenosni-racunalniki/macbook-air-13-i5-188gb-apple-128gb-ssdhd6000-601480');

  $title = $html->find('div[id=ratingTitleLogo] h1', 0)->plaintext;

  echo $title;



  foreach ($html->find('table.productSpecsTable tr') as $item) {
  $items[] = $item->plaintext;

  }

  foreach($items as $spec){
  echo "$spec <br>" ;
  }

 */


include('simple_html_dom.php');

$html = file_get_html('https://www.bigbang.si/prenosni-racunalniki/');


foreach ($html->find('div.product-box h3') as $element) {
    $title = $element->plaintext;
    //$opis =  substr($title, 45); brez Prenosni računalnik
    $pc_title[] = $title;
    echo $title . '<br>';
}

foreach ($html->find('div.price') as $element) {
    $price = $element->plaintext;
    $cena = substr($price, 0, strpos($price, '€'));
    $pc_price[] = $cena;
    echo $cena . '<br>';
    
}

foreach ($html->find('div.product-box h3 a') as $element) {
    $link = "https://www.bigbang.si";
    $url = $link . $element->href;
    $pc_url[] = $url;
     echo $url . '<br>';
}

foreach ($html->find('div.product-box div.productImage span.imgWrap img') as $element) {
    $picture = $element->src;
    $pc_picture[] = $picture; 
    echo $picture . '<br>';
}

?>


