<?php
<<<<<<< HEAD
 


include('simple_html_dom.php');
include_once "db.php";
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
=======
    

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
>>>>>>> 5799ec50e6dd6624494a8c63f68e0d360c58379e
    
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
$store_sql = "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.bigbang.si'";
$query = mysqli_query($conn, $store_sql);
$store_id = 0;
    if(mysqli_num_rows($query) == 0)
    {
        $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('BigBang', 'https://www.bigbang.si')");
        $store_sql1 = "SELECT ID, StoreURL FROM Stores WHERE StoreURL = https://www.bigbang.si";
        $query = mysqli_query($conn, $store_sql1);
        $row = mysqli_fetch_assoc($query);
        $store_id = $row['ID'];
    }
    else 
    {
        $row = mysqli_fetch_assoc($query);
        $store_id = $row['ID'];
    }
<<<<<<< HEAD
foreach ($html->find('div.product-box') as $element) {
    
    //$item[] =  $element->find('h3',0)->plaintext; //title
    ////$item[] = substr($price, 0, strpos($price, '€'));
    //$item[] = $element->find('div.productImage span.imgWrap img',0)->src; //picture
    //$item[]= $link . $element->find('h3 a',0)->href; //url  
   
    $title = $element->find('h3',0)->plaintext;
    
    $price = $element->find('div.price',0)->plaintext; //price
    $priceToInsert = substr($price, 0, strpos($price, '€'));
    $priceToInsert = str_replace(",",".", $priceToInsert);
   
    $img = $element->find('div.productImage span.imgWrap img',0)->src;
    
    $link = "https://www.bigbang.si";
    $url = $link . $element->find('h3 a',0)->href;
    
    $date = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO Products(Title, ProductURL, Price, DateTime, Rating, Stores_ID, Categories_ID) VALUES('$title', '$url', $priceToInsert, '$date', 0, $store_id, 1)";
    $sql_insert_image = "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$url'))";
    echo "<br>".$sql."<br>".$sql_insert_image;
    $query = mysqli_query($conn, $sql);
    $query2 = mysqli_query($conn, $sql_insert_image);
}
=======
>>>>>>> 5799ec50e6dd6624494a8c63f68e0d360c58379e

?>
