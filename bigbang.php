<?php

include('simple_html_dom.php');
include "db.php";

/*
 * KATEGORIJA: prenosniki
 */
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

for ($i = 1; $i < 40; $i++) {
    $html = file_get_html('https://www.bigbang.si/prenosni-racunalniki?pricefrom=190&priceto=4000&pagenumber=' . $i);

    $konec = explode('Ni artiklov, ki bi ustrezali izbranim kriterijem', $html);
    if ( strlen($konec[0]) < 189000) { //pride skoz vse podstrani
        break;
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
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
        $item[] = $priceNew;
        $priceNew = str_replace(",", ".", $priceNew);
        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");
        //echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, SELECT ID FROM categories WHERE Title = 'Telefoni')"."<br>";

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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $itemPhone[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
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
        $priceNew = str_replace(",", ".", $priceNew);

        $itemPhone[] = $linkDesc; //url

        $itemPhone[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
       
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Telefoni'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");
        //echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, SELECT ID FROM categories WHERE Title = 'Telefoni')"."<br>";
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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $priceNew = str_replace(",", ".", $priceNew);
        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
         $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Monitor'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");

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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url
        
        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $priceNew = str_replace(",", ".", $priceNew);

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
         $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Miske'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");

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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $priceNew = str_replace(",", ".", $priceNew);

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
         $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Tipkovnice'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");
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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $priceNew = str_replace(",", ".", $priceNew);

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
         $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Namizni PC'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");
    
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
        $title = $element->find('h3', 0)->plaintext;
        $link = "https://www.bigbang.si";
        $linkDesc = $link . $element->find('h3 a', 0)->href; //url

        $htmlDesc = file_get_html($linkDesc);
        $item[] = $htmlDesc->find('div.productDescription p', 0)->plaintext; //description 
        $description = $htmlDesc->find('div.productDescription p', 0)->plaintext;
        $price = $element->find('div.price', 0)->plaintext; //price 
        $price1 = explode("€", $price);
        if (strlen($price1[1]) == 26){
            $priceNew = $price1[0];
        }else{
            $priceNew = $price1[1];
        }
            
        $priceNew = str_replace(",", ".", $priceNew);

        $item[] = $linkDesc; //url

        $item[] = $htmlDesc->find('div.mainImage a img', 0)->src; //picture
        $img = $htmlDesc->find('div.mainImage a img', 0)->src;
         $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkDesc', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Komponente'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkDesc'))");
    
    }
}

//print_r($item);

?>
