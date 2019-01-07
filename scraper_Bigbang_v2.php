<?php

include('simple_html_dom.php');
include "db.php";
/*
 * KATEGORIJA: prenosniki
 */


for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/prenosni-racunalniki?pricefrom=190&priceto=4000&pagenumber=' . $i);

    $velHtml = str_word_count($html, 0);
    if ($velHtml < 21500) { //pride skoz vse podstrani
        break;
    }

    $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.bigbang.si'");
    $store_id = 0;
        if(mysqli_num_rows($query) == 0)
        {
            $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('BigBang', 'https://www.bigbang.si')");
            $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = https://www.bigbang.si");
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        else 
        {
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
    
    foreach ($html->find('div.product-box') as $element) {

        $item[] = $element->find('h3', 0)->plaintext; //title
        $title = $element->find('h3', 0)->plaintext; 
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strpos($price1[1], '20x') !== false) {
            $priceNew = $price1[0];
        } else {
            if (strlen($price[1]) <= 26) {
                $priceNew = $price1[0];
            } else {
                $priceNew = $price1[1];
            }
        }
        $item[] = $priceNew . '€ ';
        $priceNew = str_replace(",", ".", $priceNew);
        $item[] = $linkDesc; //url

        $item[] = $element->find('div.productImage span.imgWrap img', 0)->src; //picture
        $img = $element->find('div.productImage span.imgWrap img', 0)->src;
        $date = date("Y-m-d H:i:s");        
        echo $img."<br>";
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, 1)");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");

    }
}

file_put_contents("laptop.txt", $item); //zapis v datoteko
echo "Artikli telefon so se  izpisali v datoteko laptop.txt!<br>";
//print_r($item);

/*
 * KATEGORIJA: pametni telefoni
 */

for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/pametni-gsm-telefoni?pricefrom=50&priceto=1740&pagenumber=' . $i);

    $velHtml = str_word_count($html, 0);
    if ($velHtml < 21500) { //pride skoz vse podstrani
        break;
    }


    foreach ($html->find('div.product-box') as $element) {

        $itemPhone[] = $element->find('h3', 0)->plaintext; //title
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $itemPhone[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $descr = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price  
        $price1 = substr($price, 0, strpos($price, ' €'));
        $price1 = str_replace(",", ".", $price1);
        $itemPhone[] = $price1 . '€ ';

        $itemPhone[] = $linkDesc; //url

        $itemPhone[] = $element->find('div.productImage span.imgWrap img', 0)->src; //picture
        $img = $element->find('div.productImage span.imgWrap img', 0)->src;
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $price1, '$date', '$description', 0, $store_id, 2)");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");

    }
}

file_put_contents("telefon.txt", $itemPhone); //zapis v datoteko
//print_r($itemPhone);
echo "Artikli telefon so se  izpisali v datoteko telefon.txt!<br>";
?>
