<?php

include('simple_html_dom.php');
/* 
 * KATEGORIJA: prenosniki
 */

for ($i = 1; $i < 50; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=' . $i); 
    
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

       $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }
        
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
       break;
    }
    
}

/* 
 * KATEGORIJA: monitorji
 */

for ($i = 1; $i < 50; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/monitorji?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/monitorji?p=' . $i); 
    
    if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
       break;
    }
 
   
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }
        
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
       break;
    }
}   

/* 
 * KATEGORIJA: tipkovnice
 */

for ($i = 1; $i < 40; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniska-oprema-in-dodatki/tipkovnice?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniska-oprema-in-dodatki/tipkovnice?p=' . $i); 
    
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title

        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }
        
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
    
     if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
       break;
    }
    
}   

/* 
 * KATEGORIJA: miške
 */

for ($i = 1; $i < 50; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniska-oprema-in-dodatki/miske-in-podloge?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniska-oprema-in-dodatki/miske-in-podloge?p=' . $i); 
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }       
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
    
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
        break;
    }
}   
/* 
 * KATEGORIJA: namizni ralunalniki
 */
for ($i = 1; $i < 40; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=' . $i); 
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }       
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
    
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
        break;
    }
}   
   

/* 
 * KATEGORIJA: grafične kartice 
 */

for ($i = 1; $i < 40; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniske-komponente-in-dodatki/graficne-kartice?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniske-komponente-in-dodatki/graficne-kartice?p=' . $i); 
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }       
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
    
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
        break;
    }
}   

/* 
 * KATEGORIJA: pametni telefoni 
 */

for ($i = 1; $i < 40; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/telefonija/mobilni-telefoni?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/telefonija/mobilni-telefoni?p=' . $i); 
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
 
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 

        $price = $element->find('div.price-box ', 0)->plaintext; //price 
        if(strlen($price) < 400){
            $priceN = explode("€", $price);
            $priceNew = $priceN[0] . "€";
        }else{
           $priceN = explode("€", $price); 
           $priceNew1 = $priceN[2]. "€";
           $priceNew2 = explode(":", $priceNew1);
           $priceNew = $priceNew2[1];
        }       
        $item[] = $priceNew;
      
        $item[] = $element->find('h2.product-name a', 0)->href; //url 

        $item[] = $element->find('a.product-image img', 0)->src; //picture
    }
    
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
        break;
    }
}   

//print_r($item);

?>

