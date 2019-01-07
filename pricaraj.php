<?php

include('simple_html_dom.php');
include "db.php";
/* 
 * KATEGORIJA: prenosniki
 */

$query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.pricaraj.si'");
    $store_id = 0;
        if(mysqli_num_rows($query) == 0)
        {
            $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('pricaraj.si', 'https://www.pricaraj.si')");
            $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.pricaraj.si'");
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        else 
        {
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }

for ($i = 1; $i < 50; $i++) {

        if ($i == 1) {
        $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=50');
        $velHtml = str_word_count($html, 0);
    }

    $html = file_get_html('https://www.pricaraj.si/racunalnistvo/racunalniki/namizni-racunalniki?p=' . $i); 
    
    
    foreach ($html->find('li.item') as $element) {
        $item[] = $element->find('h2.product-name', 0)->plaintext; //title
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
        echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Monitor'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
        
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Tipkovnice'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
         echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
    
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Miske'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
         echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
    
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Namizni PC'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
         echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
    
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Komponente'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
         echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
    
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
        $title = $element->find('h2.product-name', 0)->plaintext;
        $item[] = $element->find('h2.product-name', 0)->plaintext; //description 
        $description = $element->find('h2.product-name', 0)->plaintext;
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
        $priceNew = str_replace("€", "", $priceNew);
        $priceNew = str_replace(",", ".", $priceNew);
      
        $linkInsert = $element->find('h2.product-name a', 0)->href; //url 

        $img = $element->find('a.product-image img', 0)->src; //picture
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Telefoni'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
         echo "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $priceNew, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))"."<br>";
    
    }
    
        if ($velHtml == str_word_count($html, 0)) { //pride skoz vse podstrani
        break;
    }
}   

//print_r($item);

?>

