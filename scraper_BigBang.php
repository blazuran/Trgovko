<?php
 */


include('simple_html_dom.php');

$html = file_get_html('https://www.bigbang.si/prenosni-racunalniki/');

/*
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
 
 */

foreach ($html->find('div.product-box') as $element) {
    
    $item[] =  $element->find('h3',0)->plaintext; //title
    
    $price = $element->find('div.price',0)->plaintext; //price
    $item[] = substr($price, 0, strpos($price, '€'));
    
    $item[] = $element->find('div.productImage span.imgWrap img',0)->src; //picture
   
    $link = "https://www.bigbang.si";
    $item[]= $link . $element->find('h3 a',0)->href; //url   
}

print_r($item); //izpis

?>
