<?php
    
    include('simple_html_dom.php');
    include_once 'db.php';
    
    $html = file_get_html('https://www.bigbang.si/prenosni-racunalniki/');
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
     
        $title = $element->find('h3',0)->plaintext;
    
        $price = $element->find('div.price',0)->plaintext; //price
        $priceToInsert = str_replace(",",".", substr($price, 0, strpos($price, '€')));
   
        $img = $element->find('div.productImage span.imgWrap img',0)->src;
        
        $link = "https://www.bigbang.si";
        $url = $link . $element->find('h3 a',0)->href;
        
        $date = date("Y-m-d H:i:s");
        
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Rating, Stores_ID, Categories_ID) VALUES('$title', '$url', $priceToInsert, '$date', 0, $store_id, 1)");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$url'))");
    }
?>