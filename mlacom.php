<?php
include('simple_html_dom.php');
/* 
 * KATEGORIJA: prenosniki
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/prenosniki-in-oprema/prenosniki?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title

        $item[] = $element->find('p', 0)->plaintext; //description 

        $price = $element->find('div.additional div', 0)->plaintext; //price
        $item[] = str_replace("Spletna cena:", "", $price);

        $linkDesc = $element->find('a', 0)->href; //url
        $item[] = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $item[] = $link . $image1;
    }
}
//
//print_r($item);

/* 
 * KATEGORIJA: monitorji
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/monitorji?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title

        $item[] = $element->find('p', 0)->plaintext; //description 

        $price = $element->find('div.additional div', 0)->plaintext; //price
        $item[] = str_replace("Spletna cena:", "", $price);

        $linkDesc = $element->find('a', 0)->href; //url
        $item[] = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $item[] = $link . $image1;
    }
}

/* 
 * KATEGORIJA: tipkovnice
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/tipkovnice?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title

        $item[] = $element->find('p', 0)->plaintext; //description 

        $price = $element->find('div.additional div', 0)->plaintext; //price
        $item[] = str_replace("Spletna cena:", "", $price);

        $linkDesc = $element->find('a', 0)->href; //url
        $item[] = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $item[] = $link . $image1;
    }
}

//print_r($item);

/* 
 * KATEGORIJA: miške in podlage
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/miske-in-podloge?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title

        $item[] = $element->find('p', 0)->plaintext; //description 

        $price = $element->find('div.additional div', 0)->plaintext; //price
        $item[] = str_replace("Spletna cena:", "", $price);

        $linkDesc = $element->find('a', 0)->href; //url
        $item[] = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $item[] = $link . $image1;
    }
}


/* 
 * KATEGORIJA: grafične kartice
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/graficne-kartice-pcie?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title

        $item[] = $element->find('p', 0)->plaintext; //description 

        $price = $element->find('div.additional div', 0)->plaintext; //price
        $item[] = str_replace("Spletna cena:", "", $price);

        $linkDesc = $element->find('a', 0)->href; //url
        $item[] = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $item[] = $link . $image1;
    }
}

//print_r($item);

?>
