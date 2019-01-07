<?php

include('simple_html_dom.php');

/*
 * KATEGORIJA: prenosniki
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/prenosni-racunalniki?pricefrom=190&priceto=4000&pagenumber=' . $i);

    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }

    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

//file_put_contents("laptop.txt", $item); //zapis v datoteko


/*
 * KATEGORIJA: pametni telefoni
 */

for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/pametni-gsm-telefoni?pricefrom=50&priceto=1740&pagenumber=' . $i);

    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }


    foreach ($html->find('div.product-box') as $element) {

        $itemPhone[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $itemPhone[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strpos($price1[1], '10x') !== false) {
            $priceNew = $price1[0];
        } else {
            if (strlen($price[1]) <= 26) {
                $priceNew = $price1[0];
            } else {
                $priceNew = $price1[1];
            }
        }
        $itemPhone[] = $priceNew . '€ ';

        $itemPhone[] = $linkDesc; //url

        $itemPhone[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

//file_put_contents("telefon.txt", $itemPhone); //zapis v datoteko
//print_r($itemPhone);

/*
 * KATEGORIJA: monitorji
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/monitorji?pricefrom=70&priceto=9050&pagenumber=' . $i);

    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }

    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

//print_r($item);

/*
 * KATEGORIJA: miške
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/miske?pricefrom=0&priceto=490&pagenumber=' . $i);

    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }

    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}


/*
 * KATEGORIJA: tipkovnice
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/tipkovnice?pricefrom=0&priceto=200&pagenumber=' . $i);
    
    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }
   
    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

/*
 * KATEGORIJA: namizni računalniki
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/namizni-racunalniki?pricefrom=120&priceto=3020&pagenumber=' . $i);
    
    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }
   
    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

//print_r($item);

/*
 * KATEGORIJA: grafične kartice 
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/graficne-kartice?pricefrom=40&priceto=1400&pagenumber=' . $i);
    
    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
    }
   
    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title

        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 

        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $item[] = $priceNew . '€ ';

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
    }
}

//print_r($item);

?>
